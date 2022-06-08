<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class TabComponents extends AbstractWidget
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

        return view('widgets.tab_components', [
            'table' => $table,
        ]);
    }
}
