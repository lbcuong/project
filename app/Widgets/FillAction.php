<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class FillAction extends AbstractWidget
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

        return view('widgets.fill_action', [
            'table' => $table,
        ]);
    }
}
