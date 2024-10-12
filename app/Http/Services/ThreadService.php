<?php

namespace App\Http\Services;
use App\Models\Thread;
use App\Http\Services\MessageService;

class ThreadService
{   
    protected $message;

    public function __construct(MessageService $message)
    {
        $this->message = $message;
    }

    public function create($data)
    {   
        //creates a thread
        $thread = Thread::create([
            'subject' => $data['subject'],
        ]);

        //Adding participants to the newly created thread
        $participants = is_array($data['recipients']) ? $data['recipients'] : array($data['recipients']);
        array_push($participants, auth()->id());
        $thread->addParticipant($participants);

        return $thread;
    }
    public function update(Thread $thread, $data)
    {                
        
        Thread::find($thread->id)
        ->update([
            'subject' => $data['subject'],
        ]);
        
        $participants = is_array($data['recipients']) ? $data['recipients'] : array($data['recipients']);
        array_push($participants, auth()->id());
        
        $thread->removeAllParticipants();
        $thread->addParticipant($participants);

        return $thread;
    }
}