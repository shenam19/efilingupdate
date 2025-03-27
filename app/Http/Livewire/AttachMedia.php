<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use Livewire\Attributes\On;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class AttachMedia extends Component
{

    public $user;
    public $selected_media = array();
    public $attachments = [];
    // protected $listeners = ['setSelectedMedia'];

    public function mount(Message $message = null)
    {
        $this->user = auth()->user();
        if ($message != null) {
            $this->attachments = $message->attachments()->get();
            $this->selected_media = $message->attachments()->pluck('id')->toArray();
        }
    }

    // public function setSelectedMedia($arr)
    // {
    //     is_array($arr) ? $this->selected_media = array_merge($this->selected_media, $arr) : $this->selected_media[] = $arr;
    // }
    #[On('setSelectedMedia')]
    public function setSelectedMedia($arr = [])
    {
        if (!is_array($arr)) {
            $arr = [$arr];
        }

        $this->selected_media = array_unique(array_merge($this->selected_media, $arr));
    }

    public function attach()
    {
        $this->attachments = $this->user->getAllMedia()->whereIn('id', $this->selected_media);
        // $this->emitUp('setAttachments', $this->selected_media);

        // $this->dispatch('setAttachments', $this->selected_media);
    }

    public function removeMedia($id)
    {
        unset($this->selected_media[array_search($id, $this->selected_media)]);
        $this->attach();
    }

    public function render()
    {

        // if (auth()->user()->hasRole(['admin', 'front desk'])) {
        //     $medias =  BaseMedia::where('collection_name', auth()->user()->organization->name_short)->paginate();
        // } else {
        //     $medias = auth()->user()->getMedia(auth()->user()->organization->getRoot()->name_short);
        // }

        // $shared = Message::sharedMedia();

        // return view('livewire.attach-media', compact('medias', 'shared'));
        return view('livewire.attach-media');
    }
}
