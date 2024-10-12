<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IncomingLetterNo extends Component
{
    public $incomingNo;
    public $outgoingWord;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($incomingNo, $outgoingWord = null)
    {
        //
        $this->incomingNo = $incomingNo;
        $this->outgoingWord = $outgoingWord; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.incoming-letter-no');
    }
}
