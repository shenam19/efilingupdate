<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SectionTreeDropDown extends Component
{

    public $orgs;
    public $id;
    public $name;
    public $selected;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $orgs, $name, $selected = null)
    {
        $this->orgs = $orgs;
        $this->id   = $id;
        $this->name = $name;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.section-tree-dropdown');
    }
}
