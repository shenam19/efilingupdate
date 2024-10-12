<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReadStatus extends Component
{   
    public $recipients;
    public $message_id;


    public function render()
    {   
        $not_read = $this->recipients->whereNull('last_read')->count();
        return view('livewire.read-status',compact('not_read'));
    }
}
