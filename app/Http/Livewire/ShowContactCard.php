<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;

class ShowContactCard extends Component
{   
    public $contact;
    protected $listeners = ['selectionChange'];

    public function mount()
    {
        $this->contact = null;
    }  
      
    public function selectionChange(Contact $contact)
    {        
        $this->contact = $contact;                        
    }

    public function render()
    {
        $contactsTree = Contact::getContactTree();
        return view('livewire.show-contact-card', compact('contactsTree'));
    }
}
