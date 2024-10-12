<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Message;
use App\Models\OrganizationHierarchy;
use App\Models\Folder;

class MessageTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $selected = [];
    public $type;

    protected $listeners = ['addedToFolder' => 'resetSelected'];

    public function updatedSelected()
    {
        $this->emitTo('add-to-folder','selectedMessage',$this->selected);
    }

    public function resetSelected()
    {
        $this->reset('selected');
    }

    public function render()
    {   
        $query = match ($this->type) {
            'inbox' => Message::forUser(),
            'sent' => Message::sentByUser(),
            'draft' => Message::myDraft(),
        };
        
        $messages = $query->whereLike(['subject','remarks','sender.name','contactSender.name'],$this->search ?? '')
        ->with(['type','sender','prevPullBack','recipients.user','contactSender'])      
        ->withCount('attachments')        
        ->paginate(15);

        $orgs = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();
        $orgsFolder = Folder::whereIn('organization_id',$orgs)->pluck('id')->toArray();
        return view('livewire.message-table',compact('messages','orgs','orgsFolder'));
    }
}
