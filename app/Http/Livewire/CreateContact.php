<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\OrganizationType as OrgType;
use App\Models\OrganizationHierarchy as Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;

class CreateContact extends Component
{    
    public $contact = array();
    public $type;
    public $selected;

    protected $listeners = ['setParentContact','removeParentContact'];
        
    public function mount($type, $selected = null)
    {   
        $this->type = $type;
        $this->selected = $selected;
    }

    public function removeParentContact()
    {
        $this->contact['parent_id'] = null;
    }

    public function setParentContact($data)
    {
        $this->contact['parent_id'] = $data;
    }

    public function createContact()
    {   
        $validator = Validator::make($this->contact, [            
            'name'  => ['required', 'string', 'max:125'],
            'email' => ['email','max:125'],        
            'phone' => ['max:15'],
            'parent_id' => ['exists:contacts,id'],
            'address' => ['max:200']
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessages = implode(', ',$errors->all());            
            $this->emit('error',$errorMessages);
            return;
        }        

        $this->contact['org_id'] = auth()->user()->organization->getRoot()->id;
        $newContact = Contact::create($this->contact);
        $this->reset('contact');

        $contactsTree = Contact::select('id','name as label')
            ->where('org_id',auth()->user()->organization->getRoot()->id)
            ->orWhereNull('org_id')
            ->get();
        
        $this->emit('addedUser',$contactsTree, $newContact);

    }

    public function render()
    {   
        $contactsTree = Contact::getContactTree();
    
        return view('livewire.create-contact',compact('contactsTree'));
    }
}
