<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Livewire\Attributes\On;

class ShowContactCard extends Component
{
    public $contact;
    // protected $listeners = ['selectionChange'];

    public function mount()
    {
        $this->contact = null;
    }
    #[On('selectionChange')]
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
