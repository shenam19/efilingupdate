<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use Livewire\WithPagination;
use App\Models\OrganizationHierarchy;
use App\Models\MessageType;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use App\Models\Folder;
use Livewire\Attributes\On;

class RecordTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $type;
    public $search, $fiscal_year;
    public $msg_types, $msg_type;
    public $urgency;
    public $senders = [];
    public $recipients = [];
    public $selected = [];
    public $date1, $date2, $showAccess;

    // protected $listeners = ['setData', 'addedToFolder' => 'resetSelected'];

    public function mount($type)
    {
        $this->showAccess = false;
        $this->type = $type;
        $this->msg_types = MessageType::select('id', 'name_tibetan')->get();
        $this->fiscal_year = fiscalYear();
    }

    public function updatedSelected()
    {
        // $this->emitTo('add-to-folder', 'selectedMessage', $this->selected);
        $this->dispatch('selectedMessage', $this->selected)->to('add-to-folder');
        // $this->dispatchTo('add-to-folder', 'selectedMessage', $this->selected);
    }
    #[On('addedToFolder')]
    public function resetSelected()
    {
        $this->reset('selected');
    }
    #[On('setData')]
    public function setData($data = [])
    {
        $data = is_array($data) ? $data : [$data];

        $this->type === 'incoming'
            ? $this->senders    = $data
            : $this->recipients = $data;

        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Don't call fullOrganization() again. Reuse the same $myOrgs
        $myOrgs = OrganizationHierarchy::fullOrganization()->pluck('id')->toArray();

        $contacts = [];
        $relationshipsArr = [
            'record',
            'type',
            'sender:id,name,works_at',
            'contactSender:id,name',
            'recipients.user:id,name',
            'recipients.contact:id,name',
            'prevPullBack'
        ];

        $msgQuery = $this->type === 'incoming'
            ? Message::forOrganization($myOrgs)
            : Message::sentByOrganization($myOrgs);

        $messages = $msgQuery->whereLike(['subject', 'record.outgoing_no', 'remarks', 'recipients.incoming_no'], $this->search ?? '')
            ->when($this->msg_type, function ($query, $msg_type) {
                return $query->where('message_type_id', $msg_type);
            })
            ->when(!empty($this->senders), function ($query) {
                return $query->where(function ($query) {
                    $query->whereIn('messages.user_id', $this->senders)
                        ->orWhereIn('messages.contact_id', $this->senders);
                });
            })
            ->when(!empty($this->urgency), function ($query) {
                return $query->where('urgency', $this->urgency);
            })
            ->when(!empty($this->recipients), function ($query) {

                return $query->whereHas('recipients', function ($q) {
                    return $q->where(function ($qq) {
                        $qq->whereIn('user_id', $this->recipients)
                            ->orWhereIn('contact_id', $this->recipients);
                    });
                });
            })
            ->when($this->date1 || $this->date2, function ($query) {
                return $query->whereHas('record', function ($q) {
                    //Returns the date if entered else returns  first April of 2022
                    $fromDate = $this->date1 ? Carbon::create($this->date1) : new Carbon('first day of April 2022');
                    //Returns the date at 6:00pm time else returns current datetime
                    $toDate   = $this->date2 ? Carbon::create($this->date2)->addHours(23) : Carbon::now();

                    if ($toDate > $fromDate) {
                        return $q->whereBetween($this->type === 'outgoing' ? 'dispatched_date' : 'received_date', [$fromDate, $toDate]);
                    } else {
                        return $q->whereBetween($this->type === 'outgoing' ? 'dispatched_date' : 'received_date', [$toDate, $fromDate]);
                    }
                });
            })
            ->whereRelation('record', 'fiscal_year', $this->fiscal_year)
            ->whereAccess($this->showAccess, auth()->id())
            ->where('status', 'sent')
            ->has('record')
            ->with($relationshipsArr)
            ->withCount('attachments')
            ->paginate(12);

        /**
         * TODO: sort incoming records by incoming number
         * TODO: sort outgoing records letter number
         *
         */

        if ($this->type === 'incoming') {
            $incomingMessages  = Message::with(['sender', 'contactSender'])
                ->whereNotIn('messages.organization_id', $myOrgs)
                ->whereHas('recipients', function ($query) use ($myOrgs) {
                    $query->whereIn('organization_id', $myOrgs);
                })
                ->where('status', 'sent')
                ->select('messages.is_user', 'messages.user_id', 'messages.contact_id')
                ->get();

            $incomingMessages = $incomingMessages->unique('user_id', 'contact_id');


            foreach ($incomingMessages  as $msg) {
                $contacts[] = $msg->is_user ? $msg->sender : $msg->contactSender;
            }
        } else {

            $outgoingMessages  = Message::with('recipients.user', 'recipients.contact')
                ->whereIn('organization_id', $myOrgs)
                ->whereHas('recipients', function ($query) use ($myOrgs) {
                    $query->whereNotIn('organization_id', $myOrgs);
                })
                ->where('status', 'sent')
                ->distinct()
                ->get();


            foreach ($outgoingMessages as $msg) {
                $recipients = $msg->recipients;

                foreach ($recipients as $recipient) {
                    $contacts[] = $recipient->is_user ? $recipient->user : $recipient->contact;
                }
            }
        }

        //Removes duplicate and changes name key to label key for vue tree select display
        $contacts =  str_replace('name', 'label', (collect($contacts)->unique()->values()->toJSon()));
        $orgsFolder = Folder::whereIn('organization_id', $myOrgs)->pluck('id')->toArray();
        return view('livewire.record-table', compact('messages', 'myOrgs', 'contacts', 'orgsFolder', 'myOrgs'));
    }
}
