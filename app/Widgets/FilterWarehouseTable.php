<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class FilterWarehouseTable extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    const FILTER_WAREHOUSE = array('containers','overviews','location_warehouses');

    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $table = $this->config['table'];
        if(in_array($table,self::FILTER_WAREHOUSE)){
            $paramSelects = $this->config['paramSelects'];
            $checkCountWarehouse = checkCountWarehouse($paramSelects['warehouse_id']);
            return view('widgets.filter_warehouse_table', [
                'checkCountWarehouse' =>$checkCountWarehouse,
                'paramSelects' => $paramSelects
            ]);
        }
        return '';
    }
}
