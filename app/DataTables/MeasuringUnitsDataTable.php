<?php

namespace App\DataTables;

use App\Models\MeasuringUnit;
use Yajra\DataTables\Services\DataTable;

class MeasuringUnitsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function ($model) {
                return
                    "<input value='{$model->id}' class='select-param' type='checkbox'>";
            })->rawColumns(['checkbox']);
    }

    public function query(MeasuringUnit $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                'checkbox' => ['title'=>'<input id="select-all" type="checkbox" value="0">','sorting' => false,'class'=>'dt-checkboxes-cell dt-checkboxes-select-all sorting_disabled filter-disable'],
                'code'  => ['title'=> 'Mã đơn vị'],
                'name' => ['title'=> 'Tên đơn vị'],
            ])->parameters(getTableParameters());
    }
}
