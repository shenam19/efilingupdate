<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Draft;

class WriteMessage extends Component
{   
    public $users;
    public $draft = array();

    public function mount()
    {
        $this->users = User::where('id','!=',auth()->id())->get();
    }

    public function saveAsDraft()
    {
        dd($this->draft);
    }

    public function render()
    {
        return view('livewire.write-message');
    }
}
