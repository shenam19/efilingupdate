<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use App\Models\Thread; 
use App\Models\Participant;
use Illuminate\Support\Str;
use App\Http\Services\ThreadService;
use App\Http\Services\MessageService;
use App\Http\Services\RecordService;

class ForwardMessage extends Component
{   
    public $message;
    public $external; //Other organization users
    public $internal; //Within organization users 
    public $recipients = array();
    public $record = array();
    public $remarks;
    public $attachments;
    protected $listeners = ['setRecipients','setAttachments','removeRecipient'];
    
    public function mount(Message $message)
    {
        $this->message          = $message;  
        $this->external         = User::role('front desk')->where('id','!=',auth()->id())->get();
        $this->internal         = User::InternalUser()->select('id','name as label')->where('id','!=',auth()->id())->get();
        $this->attachments      = null;
    }

    public function removeRecipient($data)
    {
        $this->recipients = array_diff($this->recipients,array($data));
    }

    public function setRecipients($data)
    {
        if(!empty($data))
        {
            array_push($this->recipients,$data);
        }
    }

    public function setAttachments($data)
    {
        $this->attachments = $data;
    }

    public function forward(ThreadService $threadservice, MessageService $messageservice, RecordService $recordservice)
    {   
       
        $data = [
            'subject'           => $this->message->forward_id ? $this->message->subject : 'Fwd: '.$this->message->subject ,
            'message_type_id'   => $this->message->message_type_id,
            'recipients'        => $this->recipients,
            'remarks'           => $this->remarks,
            'status'            => 'sent',
            'forward_id'        => $this->message->id,
            'record'            => $this->record,
            'media'             => $this->attachments ?  implode(",",$this->attachments) : null,
        ];
        
        abort_if(!$this->message->hasAccess(),403);
        $message   = $messageservice->create($data, 'outgoing');
        //$recordservice->create($message, $data['record'], $data['status']);

        return redirect()->route('show',$message->uuid)->with('success', 'Message forwarded.');    
    }

    public function render()
    {
        return view('livewire.forward-message');
    }
}
