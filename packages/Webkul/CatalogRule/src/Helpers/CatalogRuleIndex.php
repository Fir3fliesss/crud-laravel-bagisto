<?php

namespace Webkul\CatalogRule\Helpers;

use Carbon\Carbon;
use Webkul\CatalogRule\Repositories\CatalogRuleRepository;

class CatalogRuleIndex
{
    /**
     * Create a new helper instance.
     *
     * @param  \Webkul\CatalogRuleProduct\Helpers\CatalogRuleProduct  $catalogRuleProductHelper
     * @param  \Webkul\CatalogRuleProduct\Helpers\CatalogRuleProductPrice  $catalogRuleProductPriceHelper
     * @return void
     */
    public function __construct(
        protected CatalogRuleRepository $catalogRuleRepository,
        protected CatalogRuleProduct $catalogRuleProductHelper,
        protected CatalogRuleProductPrice $catalogRuleProductPriceHelper
    ) {
    }

    /**
     * Full re-index
     *
     * @return void
     */
    public function reIndexComplete()
    {
        try {
            $this->cleanProductIndices();

            foreach ($this->getCatalogRules() as $rule) {
                $this->catalogRuleProductHelper->insertRuleProduct($rule);
            }

            $this->catalogRuleProductPriceHelper->indexRuleProductPrice(1000);
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Re-index rule indices
     *
     * @param  \Webkul\CatalogRule\Contracts\CatalogRule  $rule
     * @return void
     */
    public function reIndexRule($rule)
    {
        $this->cleanRuleIndices($rule);

        $startsFrom = $rule->starts_from ? Carbon::createFromTimeString($rule->starts_from.' 00:00:01') : null;

        $endsTill = $rule->ends_till ? Carbon::createFromTimeString($rule->ends_till.' 23:59:59') : null;

        if (
            (
                ! $startsFrom
                || $startsFrom <= Carbon::now()
            )
            && (
                ! $endsTill
                || $endsTill >= Carbon::now()
            )
        ) {
            $this->catalogRuleProductHelper->insertRuleProduct($rule);
        }

        $this->catalogRuleProductPriceHelper->indexRuleProductPrice(1000);
    }

    /**
     * Re-index single product
     *
     * @param  \Webkul\Product\Contracts\Product  $product
     * @return void
     */
    public function reIndexProduct($product)
    {
        try {
            if (! $product->getTypeInstance()->priceRuleCanBeApplied()) {
                return;
            }

            $productIds = $product->getTypeInstance()->isComposite()
                ? $product->getTypeInstance()->getChildrenIds()
                : [$product->id];

            $this->cleanProductIndices($productIds);

            foreach ($this->getCatalogRules() as $rule) {
                $this->catalogRuleProductHelper->insertRuleProduct($rule, 1000, $product);
            }

            $this->catalogRuleProductPriceHelper->indexRuleProductPrice(1000, $product);
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Clean rule indices
     *
     * @param  \Webkul\CatalogRule\Contracts\CatalogRule  $rule
     * @return void
     */
    public function cleanRuleIndices($rule)
    {
        $this->catalogRuleProductHelper->cleanRuleIndices($rule);

        $this->catalogRuleProductPriceHelper->cleanProductPriceIndices();
    }

    /**
     * Clean products indices
     *
     * @param  array  $productIds
     * @return void
     */
    public function cleanProductIndices($productIds = [])
    {
        $this->catalogRuleProductHelper->cleanProductIndices($productIds);

        $this->catalogRuleProductPriceHelper->cleanProductPriceIndices($productIds);
    }

    /**
     * Returns catalog rules
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCatalogRules()
    {
        $catalogRules = $this->catalogRuleRepository->scopeQuery(function ($query) {
            return $query->where(function ($query1) {
                $query1->where('catalog_rules.starts_from', '<=', Carbon::now()->format('Y-m-d'))
                    ->orWhereNull('catalog_rules.starts_from');
            })
                ->where(function ($query2) {
                    $query2->where('catalog_rules.ends_till', '>=', Carbon::now()->format('Y-m-d'))
                        ->orWhereNull('catalog_rules.ends_till');
                })
                ->orderBy('sort_order', 'asc');
        })->findWhere(['status' => 1]);

        return $catalogRules;
    }
}
