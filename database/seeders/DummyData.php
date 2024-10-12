<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Thread;
use App\Models\Message;
use App\Http\Services\ThreadService;
use App\Http\Services\MessageService;
use App\Http\Services\RecordService;

class DummyData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(ThreadService $thread, MessageService $message, RecordService $record)
    {
        $status = ['send','unsent','draft'];
        $sender = rand(20,35);
        /*
        $data["recipients"] => array:8 [▶]
        $data["message_type_id"] => "3"
        $data["subject"] => "Facilis sunt esse vo"
        $data["record"] => array:2 [▶]
        $data["media"] => null
        $data["remarks"] => "Odio enim odio tempo"
        $data["status"] => "sent" */

        $threads = Thread::factory()
            ->count(5)
            ->has(Recipient::factory()->count(rand(2, 10)),'participants')
            ->has(Message::factory()
                ->has(Recipient::factory()->count(rand(1, 10)),'recipients')
                ->make(),'messages')
            ->create(); 

        foreach($threads as $thread)
        {   
            $empty = [];

            $thread->addParticipant([1,2,3]);

            $thread->getLatestMessageAttribute()->addRecipient([2,3]);

            $thread->getLatestMessageAttribute()->storeRecord($empty);

        }
       
    }
}
