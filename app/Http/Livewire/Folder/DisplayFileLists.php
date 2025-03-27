<?php

namespace App\Http\Livewire\Folder;

use Livewire\Component;
use App\Models\Folder;
use Livewire\Attributes\On;

class DisplayFileLists extends Component
{
    public $file;
    public $sections;
    public $section;
    //public $folders;
    public $delete_id;
    public $parent_id;
    public $orgs;
    public $fileEdit;
    public $filename;
    // protected $listeners = ['deleteFile', 'setSection'];

    public function mount($orgs, $sections, $file = null)
    {
        $this->sections = $sections;
        $this->delete_id = null;
        $this->parent_id = null;
    }
    #[On('setSection')]
    public function setSection($data)
    {
        $this->section = $data;
    }

    public function showRecords($id)
    {
        //$file = Folder::with('records')->whereIn('organization_id',$this->orgs)->find($id);
        $this->dispatch('setFile', $id);
    }


    #[On('deleteFile')]
    public function deleteFile()
    {
        Folder::whereIn('organization_id', $this->orgs)->findOrFail($this->delete_id)->delete();
        $this->dispatch('toastr:success', [
            'message' => 'Success! Selected records removed from the file successfully.'
        ]);

        $this->reset('delete_id');
    }

    public function setEditFile($id)
    {
        $this->fileEdit = Folder::find($id);
        $this->dispatch('EditFile');
    }

    public function render()
    {
        $search = false;
        if (!empty($this->filename) || !empty($this->section)) {
            $search = true;
            $folders = Folder::withCount('subfolders')
                ->with('subfolders')
                ->when(!empty($this->section), function ($query) {
                    return $query->where('organization_id', $this->section);
                }, function ($query) {
                    return $query->whereIn('organization_id', $this->orgs);
                })
                ->when(!empty($this->filename), function ($query) {
                    return $query->where(function ($q) {
                        $q->where('name', 'LIKE', '%' . $this->filename . '%')
                            ->orWhere('file_no', 'LIKE', '%' . $this->filename . '%');
                    });
                })
                ->get();
        } else {

            $folders = Folder::withCount('subfolders')
                ->with('subfolders')
                ->whereIn('organization_id', $this->orgs)
                ->whereNull('parent_id')
                ->get();
        }

        return view('livewire.folder.display-file-lists', compact('folders', 'search'));
    }
}
