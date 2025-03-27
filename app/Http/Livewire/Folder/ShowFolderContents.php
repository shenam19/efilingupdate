<?php

namespace App\Http\Livewire\Folder;

use Livewire\Component;
use App\Models\Message;
use Livewire\WithPagination;
use Illuminate\Support\Arr;
use App\Models\Folder;
use Carbon\Carbon;
use App\Models\OrganizationHierarchy;
use Livewire\Attributes\On;

class ShowFolderContents extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $file;
    public $orgs;
    public string $fiscalYear;
    public $sections;
    public $selected = [];
    public $selectAll = false;
    public $selectedToAdd = [];
    public $date, $search, $type; //search variable

    // protected $listeners = ['setFile', 'detachRecord' => 'removeRecord'];

    public function mount()
    {
        $this->file = null;
        $this->fiscalYear = fiscalYear();
    }

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function getSelectedToAddCountProperty()
    {
        return count($this->selectedToAdd);
    }
    #[On('detachRecord')]
    public function removeRecord()
    {
        $this->file->records()->detach($this->selected);
        $this->reset('selected');
        $this->file = Folder::find($this->file->id);
    }
    #[On('setFile')]
    public function setFile($id)
    {
        $this->file = Folder::find($id);
        $this->reset('selectedToAdd', 'selected', 'search', 'date', 'type');
        $this->resetPage();
        $this->dispatch('EditFile', $this->file->organization_id);
    }

    public function addToFolder()
    {
        foreach ($this->selectedToAdd as $selected) {
            if (!in_array($selected, $this->file->records->pluck('id')->toArray())) {
                $this->file->records()->attach($selected, ['user_id' => auth()->id()]);
            }
        };
        $this->file = Folder::find($this->file->id);
        $this->reset('selectedToAdd');

        $this->dispatch('toastr:success', [
            'message' => 'Success! Message added to file successfully.'
        ]);
    }

    public function updatedSelectAll($value)
    {
        if ($this->selectAll) {
            $this->selected = $this->file->records->pluck('id');
        } else {
            $this->selected = [];
        }
    }

    public function render()
    {
        if ($this->file) {
            $messages = $this->file->records()
                ->whereLike(['subject', 'record.outgoing_no', 'remarks', 'recipients.incoming_no', 'sender.name'], $this->search ?? '')
                ->when($this->type === 'outgoing', function ($query) {
                    return $query->whereIn('organization_id', $this->orgs);
                })
                ->when($this->type === 'incoming', function ($query) {
                    return $query->whereNotIn('organization_id', $this->orgs);
                })
                ->when($this->date, function ($query) {
                    return $query->whereHas('record', function ($q) {
                        return $q->whereDate('received_date', $this->date)
                            ->orWhereDate('dispatched_date', $this->date);
                    });
                })
                ->whereRelation('record', 'fiscal_year', $this->fiscalYear)
                ->latest()
                ->paginate(12);

            $message_lists = Message::AllRecords()
                ->whereNotIn('id', $messages->pluck('id')->toArray())
                ->has('record')
                ->with(['record', 'thread'])
                ->paginate(10);

            $myOrgs = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();
            return view('livewire.folder.show-folder-contents', compact('messages', 'message_lists', 'myOrgs'));
        }

        return view('livewire.folder.show-folder-contents');
    }
}
