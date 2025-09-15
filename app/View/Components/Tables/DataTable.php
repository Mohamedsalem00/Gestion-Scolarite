<?php

namespace App\View\Components\Tables;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public $headers;
    public $data;
    public $actions;
    public $striped;
    public $bordered;
    public $hover;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $headers = [],
        $data = [],
        $actions = true,
        $striped = true,
        $bordered = false,
        $hover = true
    ) {
        $this->headers = $headers;
        $this->data = $data;
        $this->actions = $actions;
        $this->striped = $striped;
        $this->bordered = $bordered;
        $this->hover = $hover;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.data-table');
    }
}
