<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use Livewire\WithPagination;
use App\Models\Media;

class ShowMedia extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $type;
    public $edit_media;
    public $name = '';
    public $action;
    public $user;
    public $selected_media = array();
    public $attachments = [];
    public $sort = 'DESC';
    public $year, $month, $sharedBy;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(Message $message = null, $action)
    {
        $this->type = 'mine';
        $this->user = auth()->user();
        $this->year = "";
        $this->month = "";
        if($message != null)
        {
            $this->attachments = $message->attachments()->get();
            $this->selected_media = $message->attachments()->pluck('id')->toArray();
        }   
    }

    public function updatedType()
    {
        $this->reset('sharedBy','year','month','sort');
        $this->resetPage();
    }

    public function setEditMedia($id)
    {
        $this->edit_media = auth()->user()->getAllMedia()->where('collection_name',auth()->user()->organization->name_short)->find($id);
        $this->name = $this->edit_media->name;
    }

    public function edit()
    {
        $this->edit_media->name = $this->name;
        $this->edit_media->save();

        session()->flash('success', 'Media name successfully updated.');
    }

    public function setSelectedMedia($arr)
    {
        $this->selected_media = $arr;
    }

    public function attach()
    {   
        $this->attachments = $this->user->getAllMedia()->whereIn('id',$this->selected_media);
    }

    public function removeMedia($id)
    {
        unset($this->selected_media[array_search($id,$this->selected_media)]);
        $this->attach();
    }

    public function render()
    {   
        $orgs = [];
        if($this->type === 'shared')
        {
            $media = Media::whereHas('messages', function($query){
                $query->whereRelation('recipients','user_id', auth()->id());
            });
            $orgs = $media->pluck('collection_name')->unique()->toArray();
        }
        else
        {
            if(auth()->user()->hasRole(['admin','front desk']))
            {
                $media = Media::where('collection_name',auth()->user()->organization->name_short);
            }
            else{
                $media = Media::where('model_id',auth()->id());
            }
        }

        $media = $media->when(!empty($this->sharedBy),function($query){
                $query->where('collection_name',$this->sharedBy);
            })
            ->when(!empty($this->year),function($query){
                $query->whereYear('created_at',$this->year);
            })
            ->when(!empty($this->month),function($query){
                $query->whereMonth('created_at',$this->month);
            })
            ->orderBy('created_at',$this->sort)
            ->paginate(10);

        return view('livewire.show-media',compact('media','orgs'));
    }

}
