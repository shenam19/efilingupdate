<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Media as MediaModel;
use App\Models\OrganizationHierarchy;

class Media extends Component
{
    public $departments = array();
    
    public function mount()
    {
        $this->departments = OrganizationHierarchy::whereNull('belongs_to_id')->select('id','name_short')->get();
    }

    public function render()
    {
        foreach($this->departments as $dept)
        {
            $labels[] = $dept->name_short;
            $data[] = number_format(MediaModel::where('collection_name',$dept->name_short)->sum('size')/(1000 * 1000), 2, '.', '');
        }
        return view('livewire.admin.media',compact('labels','data'));
    }
}
