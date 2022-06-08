<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class TransactionBreadcrumb extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $table = $this->config['table'];

        if(in_array($table,tableTransaction()))
            return view('widgets.transaction_breadcrumb');
        return '';
    }
}
