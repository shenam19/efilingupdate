<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UnreadCount extends Component
{
    public function render()
    {
        $count = auth()->user()->unreadMessagesCount();
        return view('livewire.unread-count',compact('count'));
    }
}
