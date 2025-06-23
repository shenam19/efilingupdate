<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Message;
use App\Models\OrganizationHierarchy;
use Livewire\Livewire;
use App\Http\Livewire\ForwardMessage;

class RegisterUpdateTest extends TestCase
{
  //use RefreshDatabase;
  use WithFaker;

  public function test_incoming_register_should_update_when_message_is_received_from_outside()
  {
    $user = User::find(33);     //TCRC
    $recipient = User::find(20); //Kashag
    $outgoing_register = $user->organization->outgoingRegisterValue() + 1;
    $expected = $recipient->organization->incomingRegisterValue() + 1;

    $response = $this->actingAs($user)->post('/mail/send', [
      "recipients" => ['20'],
      "message_type_id" => "1",
      "subject" => $this->faker->sentence(),
      "record" => ["letter_number" => "TCRC", "outgoing_no" => $outgoing_register],
      "media" => null,
      "remarks" => $this->faker->sentence(),
      "status" => "sent",
    ]);

    $actual = OrganizationHierarchy::find(1)->incoming_register; //Kashag
    $this->assertEquals($expected, $actual);
  }

  public function test_incoming_register_should_not_update_when_message_is_sent_from_inside()
  {
    $kashag_front = User::find(20);     //Kashag
    $kashag_admin = User::find(4);      //Admin Kashag
    $outgoing_register = $kashag_front->organization->outgoingRegisterValue() + 1;
    $expected = $kashag_admin->organization->incomingRegisterValue() + 1;

    $response = $this->actingAs($kashag_front)->post('/mail/send', [
      "recipients" => [4],
      "message_type_id" => "1",
      "subject" => $this->faker->sentence(),
      "record" => ["letter_number" => "TCRC", "outgoing_no" => $outgoing_register],
      "media" => null,
      "remarks" => $this->faker->sentence(),
      "status" => "sent",
    ]);

    $actual = OrganizationHierarchy::find(1)->incoming_register;
    $this->assertLessThan($expected, $actual);
  }

  public function test_incoming_register_should_not_update_when_message_is_saved_as_draft()
  {
    $user = User::find(33);     //TCRC
    $recipient = User::find(20); //Kashag
    $outgoing_register = $user->organization->outgoingRegisterValue() + 1;
    $expected = $recipient->organization->incomingRegisterValue() + 1;

    $response = $this->actingAs($user)->post('/mail/send', [
      "recipients" => ['20'],
      "message_type_id" => "1",
      "subject" => $this->faker->sentence(),
      "record" => ["letter_number" => "TCRC", "outgoing_no" => $outgoing_register],
      "media" => null,
      "remarks" => $this->faker->sentence(),
      "status" => "draft",
    ]);

    $actual = OrganizationHierarchy::find(1)->incoming_register;
    $this->assertLessThan($expected, $actual);
  }

  public function test_outgoing_register_should_update_when_message_is_sent_to_outside()
  {
    $user = User::find(20); //Kashag

    $outgoing_register = $user->organization->outgoingRegisterValue() + 1;

    $response = $this->actingAs($user)->post('/mail/send', [
      "recipients" => ["22", "25"],
      "message_type_id" => "1",
      "subject" => $this->faker->sentence(),
      "record" => ["letter_number" => "Kashag", "outgoing_no" => $outgoing_register],
      "media" => null,
      "remarks" => $this->faker->sentence(),
      "status" => "sent",
    ]);

    $actual = OrganizationHierarchy::find(1)->outgoing_register;
    $this->assertEquals($outgoing_register, $actual);
  }

  public function test_outgoing_register_should_not_update_when_message_is_sent_to_inside()
  {

    $user = User::find(20); //Kashag

    $outgoing_register = $user->organization->outgoingRegisterValue() + 1;

    $response = $this->actingAs($user)->post('/mail/send', [
      "recipients" => ["4"],
      "message_type_id" => "1",
      "subject" => $this->faker->sentence(),
      "record" => ["letter_number" => "Kashag", "outgoing_no" => $outgoing_register],
      "media" => null,
      "remarks" => $this->faker->sentence(),
      "status" => "sent",
    ]);

    $actual = OrganizationHierarchy::find(1)->outgoing_register;
    $this->assertLessThan($outgoing_register, $actual);
  }

  public function test_outgoing_register_should_not_update_when_message_is_saved_as_draft()
  {
    $user = User::find(20); //Kashag

    $outgoing_register = $user->organization->outgoingRegisterValue() + 1;

    $response = $this->actingAs($user)->post('/mail/send', [
      "recipients" => ["28"],
      "message_type_id" => "1",
      "subject" => $this->faker->sentence(),
      "record" => ["letter_number" => "Kashag", "outgoing_no" => $outgoing_register],
      "media" => null,
      "remarks" => $this->faker->sentence(),
      "status" => "draft",
    ]);

    $actual = OrganizationHierarchy::find(1)->outgoing_register;
    $this->assertLessThan($outgoing_register, $actual);
  }
}
