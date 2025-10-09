<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoCard extends Component
{
    public $title;
    public $value;
    public $icon;
    public $color;
    public $trend;
    public $trendDirection;
    public $href;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $value,
        $icon = 'fas fa-info-circle',
        $color = 'primary',
        $trend = null,
        $trendDirection = null,
        $href = null
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->color = $color;
        $this->trend = $trend;
        $this->trendDirection = $trendDirection;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.info-card');
    }

    /**
     * Get the appropriate trend icon
     */
    public function getTrendIcon()
    {
        return match($this->trendDirection) {
            'up' => 'fas fa-arrow-up',
            'down' => 'fas fa-arrow-down',
            default => 'fas fa-minus'
        };
    }

    /**
     * Get the appropriate trend color
     */
    public function getTrendColor()
    {
        return match($this->trendDirection) {
            'up' => 'success',
            'down' => 'danger',
            default => 'secondary'
        };
    }
}
