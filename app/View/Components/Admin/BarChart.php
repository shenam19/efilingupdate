<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class BarChart extends Component
{
    public $labels;
    public $chartData;

    public function __construct($labels, $chartData)
    {
        $this->labels = $labels;
        $this->chartData = $chartData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.bar-chart');
    }
}
