<?php

namespace Webkul\Admin\DataGrids\Customers;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class ReviewDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return string
     */
    protected $primaryColumn = 'product_review_id';

    /**
     * Review status "approved".
     */
    const STATUS_APPROVED = 'approved';

    /**
     * Review status "pending", indicating awaiting approval or processing.
     */
    const STATUS_PENDING = 'pending';

    /**
     * Review status "disapproved", indicating rejection or denial.
     */
    const STATUS_DISAPPROVED = 'disapproved';

    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('product_reviews as pr')
            ->leftJoin('product_flat as pf', 'pr.product_id', '=', 'pf.product_id')
            ->leftJoin('customers as c', 'pr.customer_id', '=', 'c.id')
            ->select(
                'pr.id as product_review_id',
                'pr.title',
                'pr.comment',
                'pr.name as customer_full_name',
                'pf.name as product_name',
                'pr.status as product_review_status',
                'pr.rating',
                'pr.created_at',
            )
            ->where('channel', core()->getCurrentChannelCode())
            ->where('locale', app()->getLocale());

        $this->addFilter('product_review_id', 'pr.id');
        $this->addFilter('product_review_status', 'pr.status');
        $this->addFilter('product_name', 'pf.name');
        $this->addFilter('created_at', 'pr.created_at');

        return $queryBuilder;
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        // Customer Name
        $this->addColumn([
            'index'      => 'customer_full_name',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.customer-names'),
            'type'       => 'string',
            'searchable' => false,
            'filterable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'product_name',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.product'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'product_review_status',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.status'),
            'type'       => 'dropdown',
            'options'    => [
                'type' => 'basic',

                'params' => [
                    'options' => [
                        [
                            'label' => trans('admin::app.customers.reviews.index.datagrid.approved'),
                            'value' => self::STATUS_APPROVED,
                        ],
                        [
                            'label' => trans('admin::app.customers.reviews.index.datagrid.pending'),
                            'value' => self::STATUS_PENDING,
                        ],
                        [
                            'label' => trans('admin::app.customers.reviews.index.datagrid.disapproved'),
                            'value' => self::STATUS_DISAPPROVED,
                        ],
                    ],
                ],
            ],

            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
            'closure'    => function ($row) {
                switch ($row->product_review_status) {
                    case self::STATUS_APPROVED:
                        return '<p class="label-active">'.trans('admin::app.customers.reviews.index.datagrid.approved').'</p>';

                    case self::STATUS_PENDING:
                        return '<p class="label-pending">'.trans('admin::app.customers.reviews.index.datagrid.pending').'</p>';

                    case self::STATUS_DISAPPROVED:
                        return '<p class="label-canceled">'.trans('admin::app.customers.reviews.index.datagrid.disapproved').'</p>';
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'rating',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.rating'),
            'type'       => 'integer',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'product_review_id',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'title',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.title'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'comment',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.comment'),
            'type'       => 'string',
            'searchable' => false,
            'filterable' => false,
            'sortable'   => false,
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.customers.reviews.index.datagrid.date'),
            'type'       => 'date_range',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        if (bouncer()->hasPermission('customers.reviews.edit')) {
            $this->addAction([
                'index'  => 'edit',
                'icon'   => 'icon-edit',
                'title'  => trans('admin::app.customers.reviews.index.datagrid.edit'),
                'method' => 'GET',
                'url'    => function ($row) {
                    return route('admin.customers.customers.review.edit', $row->product_review_id);
                },
            ]);
        }

        if (bouncer()->hasPermission('customers.reviews.delete')) {
            $this->addAction([
                'index'  => 'delete',
                'icon'   => 'icon-delete',
                'title'  => trans('admin::app.customers.reviews.index.datagrid.delete'),
                'method' => 'DELETE',
                'url'    => function ($row) {
                    return route('admin.customers.customers.review.delete', $row->product_review_id);
                },
            ]);
        }
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        if (bouncer()->hasPermission('customers.reviews.delete')) {
            $this->addMassAction([
                'title'  => trans('admin::app.customers.reviews.index.datagrid.delete'),
                'url'    => route('admin.customers.customers.review.mass_delete'),
                'method' => 'POST',
            ]);
        }

        if (bouncer()->hasPermission('customers.reviews.edit')) {
            $this->addMassAction([
                'title'   => trans('admin::app.customers.reviews.index.datagrid.update-status'),
                'method'  => 'POST',
                'url'     => route('admin.customers.customers.review.mass_update'),
                'options' => [
                    [
                        'label' => trans('admin::app.customers.reviews.index.datagrid.pending'),
                        'value' => 'pending',
                    ],
                    [
                        'label' => trans('admin::app.customers.reviews.index.datagrid.approved'),
                        'value' => 'approved',
                    ],
                    [
                        'label' => trans('admin::app.customers.reviews.index.datagrid.disapproved'),
                        'value' => 'disapproved',
                    ],
                ],
            ]);
        }
    }
}
