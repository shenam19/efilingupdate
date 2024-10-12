<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class LineChart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $labels;
    public $chartData;
    public $label;

    public function __construct($labels,$chartData,$label)
    {
        $this->labels = $labels;
        $this->chartData = $chartData;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.line-chart');
    }
}
