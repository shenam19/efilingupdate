<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Folder;

class FolderStatus extends Component
{   
    public $message;
    public $folderArr;
    
    public function render()
    {
        $folders = $this->message->folders()->whereIn('folder_id',$this->folderArr)->get();
        return view('livewire.folder-status',compact('folders'));
    }
}
