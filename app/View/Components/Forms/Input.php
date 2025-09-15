<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    public $placeholder;
    public $required;
    public $disabled;
    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $label = null,
        $type = 'text',
        $value = null,
        $placeholder = null,
        $required = false,
        $disabled = false,
        $class = ''
    ) {
        $this->name = $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder ?? $this->label;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}
