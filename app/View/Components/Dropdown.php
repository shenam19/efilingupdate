<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public $option;
    public $id;
    public $selected;
    public $multiSelect;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($option, $id, $selected=null, $multiSelect = 1)
    {
        $this->option       = $option; 
        $this->id           = $id;
        $this->selected     = $selected;
        $this->multiSelect  = $multiSelect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropdown');
    }
}
