<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Urgency extends Component
{
    public $urgencyText;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value)
    {
        $this->urgencyText = match ($value) {
            "gray" => 'གལ་ཆུང་བ།',
            "yellow" => 'གལ་འབྲིང་བ།',
            "orange" => 'གལ་ཆེ་བ།',
            "red"=>'ཛ་དྲག',
            default => '',
        };

        $this->class = match ($value) {
            "gray" => 'badge-secondary',
            "yellow" => 'badge-info',
            "orange" => 'badge-warning',
            "red"=>'badge-danger',
            default => '',
        };
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.urgency');
    }
}
