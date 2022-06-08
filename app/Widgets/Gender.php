<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Gender extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    const COLUMN_NAME = 'gender';

    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $column = $this->config['column'];
        if($column == self::COLUMN_NAME)
        return view('widgets.gender', [
            'column' => $column,
        ]);
        return '';
    }
}
