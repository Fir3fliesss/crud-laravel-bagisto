<?php

namespace Webkul\Product\Helpers;

class BundleOption
{
    /**
     * Product
     *
     * @var \Webkul\Product\Contracts\Product
     */
    protected $product;

    /**
     * Returns bundle option config
     *
     * @param  \Webkul\Product\Contracts\Product  $product
     * @return array
     */
    public function getBundleConfig($product)
    {
        $this->product = $product;

        return [
            'options' => $this->getOptions(),
        ];
    }

    /**
     * Returns bundle options
     *
     * @return array
     */
    public function getOptions()
    {
        $options = [];

        // eager load all inventories for bundle options
        $this->product->bundle_options->load('bundle_option_products.product.inventories');

        foreach ($this->product->bundle_options as $option) {
            $data = $this->getOptionItemData($option);

            if (
                ! $option->is_required
                && ! count($data['products'])
            ) {
                continue;
            }

            $options[$option->id] = $data;
        }

        usort($options, function ($a, $b) {
            if ($a['sort_order'] == $b['sort_order']) {
                return 0;
            }

            return ($a['sort_order'] < $b['sort_order']) ? -1 : 1;
        });

        return $options;
    }

    /**
     * Get formed data from bundle option
     *
     * @param  \Product\Product\Contracts\ProductBundleOption  $option
     * @return array
     */
    private function getOptionItemData($option)
    {
        return [
            'id'          => $option->id,
            'label'       => $option->label,
            'type'        => $option->type,
            'is_required' => $option->is_required,
            'products'    => $this->getOptionProducts($option),
            'sort_order'  => $option->sort_order,
        ];
    }

    /**
     * Get formed data from bundle option product
     *
     * @param  \Product\Product\Contracts\ProductBundleOption  $option
     * @return array
     */
    private function getOptionProducts($option)
    {
        $products = [];

        foreach ($option->bundle_option_products as $index => $bundleOptionProduct) {
            if (! $bundleOptionProduct->product->getTypeInstance()->isSaleable()) {
                continue;
            }

            $products[$bundleOptionProduct->id] = [
                'id'         => $bundleOptionProduct->id,
                'qty'        => $bundleOptionProduct->qty,
                'price'      => $bundleOptionProduct->product->getTypeInstance()->getProductPrices(),
                'name'       => $bundleOptionProduct->product->name,
                'product_id' => $bundleOptionProduct->product_id,
                'is_default' => $bundleOptionProduct->is_default,
                'sort_order' => $bundleOptionProduct->sort_order,
                'in_stock'   => $bundleOptionProduct->product->inventories->sum('qty') >= $bundleOptionProduct->qty,
                'inventory'  => $bundleOptionProduct->product->inventories->sum('qty'),
            ];
        }

        usort($products, function ($a, $b) {
            if ($a['sort_order'] == $b['sort_order']) {
                return 0;
            }

            return ($a['sort_order'] < $b['sort_order']) ? -1 : 1;
        });

        return $products;
    }
}
