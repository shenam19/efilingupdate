<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\OrganizationHierarchy;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class Users extends Component
{   
    use WithPagination;

    public $departments = array();
    
    public function mount()
    {
        $this->departments = OrganizationHierarchy::whereNull('belongs_to_id')->select('id','name_short')->get();
    }

    public function render()
    {   
        $activity = UserActivity::has('user.organization')
            ->where('activity','login')
            ->latest()
            ->paginate('10');
            
        return view('livewire.admin.users',compact('activity'));
    }
}
