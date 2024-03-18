<?php

namespace Webkul\Product\Helpers\Indexers;

use Illuminate\Support\Facades\Schema;
use Webkul\Core\Repositories\ChannelRepository;
use Webkul\Product\Helpers\ProductType;
use Webkul\Product\Repositories\ProductFlatRepository;

class Flat
{
    /**
     * Attribute codes that can be fill during flat creation.
     *
     * @var string[]
     */
    protected $fillableAttributeCodes = [
        'sku',
        'name',
        'price',
        'weight',
        'status',
    ];

    /**
     * @var array
     */
    protected $flatColumns = [];

    /**
     * Channels
     *
     * @var array
     */
    protected $channels = [];

    /**
     * Family Attributes
     *
     * @var array
     */
    protected $familyAttributes = [];

    /**
     * Create a new listener instance.
     *
     * @return void
     */
    public function __construct(
        protected ChannelRepository $channelRepository,
        protected ProductFlatRepository $productFlatRepository
    ) {
        $this->flatColumns = Schema::getColumnListing('product_flat');
    }

    /**
     * Refresh product flat indices
     *
     * @param  \Webkul\Product\Contracts\Product  $product
     * @return void
     */
    public function refresh($product)
    {
        $this->updateOrCreate($product);

        if (! ProductType::hasVariants($product->type)) {
            return;
        }

        foreach ($product->variants()->get() as $variant) {
            $this->updateOrCreate($variant);
        }
    }

    /**
     * Creates product flat
     *
     * @param  \Webkul\Product\Contracts\Product  $product
     * @return void
     */
    public function updateOrCreate($product)
    {
        $familyAttributes = $this->getCachedFamilyAttributes($product);

        $channelCodes = $product['channels'] ?? [];

        if (! empty($channelCodes)) {
            foreach ($channelCodes as $channel) {
                $channels[] = $this->getCachedChannel($channel)->code;
            }
        } else {
            $channels[] = core()->getDefaultChannelCode();
        }

        $attributeValues = $product->attribute_values()->get();

        foreach (core()->getAllChannels() as $channel) {
            if (in_array($channel->code, $channels)) {
                foreach ($channel->locales as $locale) {
                    $productFlat = $this->productFlatRepository->updateOrCreate([
                        'product_id'          => $product->id,
                        'channel'             => $channel->code,
                        'locale'              => $locale->code,
                    ], [
                        'type'                => $product->type,
                        'sku'                 => $product->sku,
                        'attribute_family_id' => $product->attribute_family_id,
                    ]);

                    foreach ($familyAttributes as $attribute) {
                        if (
                            ! in_array($attribute->code, $this->flatColumns)
                            || $attribute->code == 'sku'
                        ) {
                            continue;
                        }

                        $productAttributeValues = $attributeValues->where('attribute_id', $attribute->id);

                        if ($attribute->value_per_channel) {
                            if ($attribute->value_per_locale) {
                                $productAttributeValues = $productAttributeValues
                                    ->where('channel', $channel->code)
                                    ->where('locale', $locale->code);
                            } else {
                                $productAttributeValues = $productAttributeValues->where('channel', $channel->code);
                            }
                        } else {
                            if ($attribute->value_per_locale) {
                                $productAttributeValues = $productAttributeValues->where('locale', $locale->code);
                            }
                        }

                        $productAttributeValue = $productAttributeValues->first();

                        $productFlat->{$attribute->code} = $productAttributeValue[$attribute->column_name] ?? null;
                    }

                    $productFlat->save();
                }
            } else {
                if (request()->route()?->getName() == 'admin.catalog.products.update') {
                    $productFlat = $this->productFlatRepository->findWhere([
                        'product_id' => $product->id,
                        'channel'    => $channel->code,
                    ]);

                    if ($productFlat) {
                        foreach ($productFlat as $productFlatByChannelLocale) {
                            $this->productFlatRepository->delete($productFlatByChannelLocale->id);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param  \Webkul\Product\Contracts\Product  $product
     * @return mixed
     */
    public function getCachedFamilyAttributes($product)
    {
        if (array_key_exists($product->attribute_family_id, $this->familyAttributes)) {
            return $this->familyAttributes[$product->attribute_family_id];
        }

        return $this->familyAttributes[$product->attribute_family_id] = $product->attribute_family->custom_attributes;
    }

    /**
     * @param  string  $id
     * @return mixed
     */
    public function getCachedChannel($id)
    {
        if (isset($this->channels[$id])) {
            return $this->channels[$id];
        }

        return $this->channels[$id] = $this->channelRepository->findOrFail($id);
    }
}
