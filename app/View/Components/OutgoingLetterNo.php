<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OutgoingLetterNo extends Component
{   
    public $outgoingNo;
    public $outgoingWord;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($outgoingNo, $outgoingWord = null)
    {
        //
        $this->outgoingNo = $outgoingNo;
        $this->outgoingWord = $outgoingWord;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.outgoing-letter-no');
    }
}
