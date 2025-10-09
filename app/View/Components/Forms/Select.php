<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $label;
    public $options;
    public $selected;
    public $placeholder;
    public $required;
    public $disabled;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $options = [],
        $label = null,
        $selected = null,
        $placeholder = 'Sélectionnez une option',
        $required = false,
        $disabled = false
    ) {
        $this->name = $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
        $this->options = $options;
        $this->selected = $selected;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
