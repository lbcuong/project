<?php

namespace App\DataTables;

use App\Models\ReorderGuideline;
use Yajra\DataTables\Services\DataTable;

class ReordersDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function ($model) {
                return
                    "<input value='{$model->id}' class='select-param' type='checkbox'>";
            })->editColumn('is_approve', function ($model) {
                return __(getLabelApprove($model->is_approve));
            })->rawColumns(['checkbox']);
    }

    public function query(ReorderGuideline $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        $params = getTableParameters();
        return $this->builder()
            ->columns([
                'checkbox' => ['title'=>'<input id="select-all" type="checkbox" value="0">','sorting' => false,'class'=>'dt-checkboxes-cell dt-checkboxes-select-all sorting_disabled filter-disable'],
                'code'  => ['title' => 'Mã phiếu'],
                'comment'  => ['title' => 'Ngày cần nhập'],
                'is_approve'  => ['title' => 'Tình trạng']
            ])->parameters($params);
    }

}
