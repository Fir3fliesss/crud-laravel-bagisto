<?php

namespace Webkul\Admin\DataGrids\Settings\DataTransfer;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class ImportDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('imports')
            ->addSelect(
                'id',
                'state',
                'file_path',
                'error_file_path',
                'started_at',
                'completed_at',
                'summary',
            );

        return $queryBuilder;
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.settings.data-transfer.imports.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'state',
            'label'      => trans('admin::app.settings.data-transfer.imports.index.datagrid.state'),
            'type'       => 'text',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'file_path',
            'label'      => trans('admin::app.settings.data-transfer.imports.index.datagrid.uploaded-file'),
            'type'       => 'text',
            'searchable' => false,
            'filterable' => false,
            'sortable'   => false,
            'closure'    => function ($row) {
                return '<a href="'.route('admin.settings.data_transfer.imports.download', $row->id).'" class="text-blue-600 hover:underline cursor-pointer">'.$row->file_path.'<a>';
            },
        ]);

        $this->addColumn([
            'index'      => 'error_file_path',
            'label'      => trans('admin::app.settings.data-transfer.imports.index.datagrid.error-file'),
            'type'       => 'text',
            'searchable' => false,
            'filterable' => false,
            'sortable'   => false,
            'closure'    => function ($row) {
                if (empty($row->error_file_path)) {
                    return '';
                }

                return '<a href="'.route('admin.settings.data_transfer.imports.download_error_report', $row->id).'" class="text-blue-600 hover:underline cursor-pointer">'.$row->error_file_path.'<a>';
            },
        ]);

        $this->addColumn([
            'index'      => 'started_at',
            'label'      => trans('admin::app.settings.data-transfer.imports.index.datagrid.started-at'),
            'type'       => 'date_range',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'completed_at',
            'label'      => trans('admin::app.settings.data-transfer.imports.index.datagrid.completed-at'),
            'type'       => 'date_range',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'summary',
            'label'      => trans('admin::app.settings.data-transfer.imports.index.datagrid.summary'),
            'type'       => 'text',
            'searchable' => false,
            'filterable' => false,
            'sortable'   => false,
            'closure'    => function ($row) {
                if (empty($row->summary)) {
                    return '';
                }

                $summary = json_decode($row->summary, true);

                $stats = [];

                foreach ($summary as $type => $value) {
                    $stats[] = trans('admin::app.settings.data-transfer.imports.index.datagrid.'.$type).': '.$summary[$type];
                }

                return implode(', ', $stats);
            },
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        if (bouncer()->hasPermission('settings.data_transfer.imports.import')) {
            $this->addAction([
                'index'  => 'import',
                'icon'   => 'icon-import',
                'title'  => trans('admin::app.settings.data-transfer.imports.index.datagrid.import'),
                'method' => 'GET',
                'url'    => function ($row) {
                    return route('admin.settings.data_transfer.imports.import', $row->id);
                },
            ]);
        }

        if (bouncer()->hasPermission('settings.data_transfer.imports.edit')) {
            $this->addAction([
                'index'  => 'edit',
                'icon'   => 'icon-edit',
                'title'  => trans('admin::app.settings.data-transfer.imports.index.datagrid.edit'),
                'method' => 'GET',
                'url'    => function ($row) {
                    return route('admin.settings.data_transfer.imports.edit', $row->id);
                },
            ]);
        }

        if (bouncer()->hasPermission('settings.data_transfer.imports.delete')) {
            $this->addAction([
                'index'  => 'delete',
                'icon'   => 'icon-delete',
                'title'  => trans('admin::app.settings.data-transfer.imports.index.datagrid.delete'),
                'method' => 'DELETE',
                'url'    => function ($row) {
                    return route('admin.settings.data_transfer.imports.delete', $row->id);
                },
            ]);
        }
    }
}
