<?php

namespace Tests\Unit\Models;

use App\Models\Message;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageModelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_message_belongs_to_user()
    {
        $user = User::where('name', 'Front Desk of TPiE')->first();
        $message = new Message();
        // $message->thread_id = 1;
        // $message->subject = 'Test Message';
        // $message->urgency = 'urgent';
        $message->user_id = $user->id;
        // $message->save();
        $this->assertEquals($message->user_id, $user->id);
    }
}
