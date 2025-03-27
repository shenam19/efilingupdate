<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\OrganizationHierarchy;
use App\Models\Folder;
use Livewire\Attributes\On;

class AddToFolder extends Component
{

    public $myOrg;
    public $folders = [];
    public $selected = [];

    // protected $listeners = ['selectData' => 'selectedFolder', 'unsetData' => 'unselectFolder', 'selectedMessage'];

    protected $messages = [
        'folder.required' => "You need to select a folder"
    ];

    public function mount($myOrgs = null)
    {
        $this->myOrg = $myOrgs ? $myOrgs : OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();
    }
    #[On('selectedMessage')]
    public function selectedMessage($selected)
    {
        $this->selected = $selected;
    }

    #[On('selectData')]
    public function selectedFolder(array $selected)
    {

        //$this->folders[] = $selected;
        // array_push($this->folders, $selected);
        foreach ($selected as $item) {
            array_push($this->folders, $item);
        }
    }
    #[On('unsetData')]
    public function unselectFolder($selected)
    {
        foreach ($selected as $item) {
            $this->folders = array_diff($this->folders, array($item));
        }
    }

    public function addToFolder()
    {

        if (empty($this->selected)) {
            $this->dispatch('toastr:warning', [
                'message' => 'Please select some messages first!'
            ]);
        } elseif (empty($this->folders)) {
            $this->dispatch('toastr:warning', [
                'message' => 'Please select folders!'
            ]);
        } else {

            foreach ($this->folders as $id) {
                $folder = Folder::find($id);
                $records = $folder->records()->pluck('id')->toArray();

                collect($this->selected)->each(function ($selected) use ($folder, $records) {
                    if (!in_array($selected, $records)) {
                        $folder->records()->attach($selected, ['user_id' => auth()->id()]);
                    }
                });
            }
            $this->dispatch('toastr:success', [
                'message' => 'Success! Message added to file successfully.'
            ]);
        }

        $this->reset('folders', 'selected');
        // $this->emitTo('message-table', 'addedToFolder');
        // $this->emitTo('record-table', 'addedToFolder');
        $this->dispatch('addedToFolder')->to('message-table');
        $this->dispatch('addedToFolder')->to('record-table');

        //$folder->records()->attach($this->selected,['user_id'=>auth()->id()]);
    }

    public function render()
    {
        $fileTree = auth()->user()->hasRole(['front desk', 'admin'])
            ? (new Folder())->getFolderTree($this->myOrg)
            : (new Folder())->getFolderTree(array(auth()->user()->works_at));


        return view('livewire.add-to-folder', compact('fileTree'));
    }
}
