<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;

class CreateContact extends Component
{
    public $contact = [];
    public $type;
    public $selected;

    public function mount($type = null, $selected = null)
    {
        $this->type = $type;
        $this->selected = $selected;
        \Log::info('Mounting CreateContact', ['type' => $type, 'selected' => $selected]);
    }

    #[On('removeParentContact')]
    public function removeParentContact()
    {
        $this->contact['parent_id'] = null;
    }

    #[On('setParentContact')]
    public function setParentContact($data)
    {
        $this->contact['parent_id'] = $data;
    }

    public function createContact()
    {
        $validator = Validator::make($this->contact, [
            'name'  => ['required', 'string', 'max:125'],
            'email' => ['email', 'max:125'],
            'phone' => ['max:15'],
            'parent_id' => ['sometimes', 'nullable', 'exists:contacts,id'],
            'address' => ['max:200']
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(', ', $errors->all());
            $this->dispatch('error', $errorMessages);
            return;
        }

        $this->contact['org_id'] = auth()->user()->organization->getRoot()->id;
        $newContact = Contact::create($this->contact);
        $this->reset('contact');

        $contactsTree = Contact::select('id', 'name as label')
            ->where('org_id', auth()->user()->organization->getRoot()->id)
            ->orWhereNull('org_id')
            ->get();

        \Log::info('Contact created', [
            'tree' => $contactsTree->toArray(),
            'new' => $newContact->toArray()
        ]);

        // $this->emit('addedUser', $contactsTree, $newContact);
        // Updated event dispatch with named parameters
        $this->dispatch('addedUser', contactsTree: $contactsTree, newContact: $newContact);
    }

    public function render()
    {
        $contactsTree = Contact::getContactTree();
        return view('livewire.create-contact', compact('contactsTree'));
    }
}
