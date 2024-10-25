<?php

// namespace Tests\Feature;
// use App\Models\Message;
// use App\Models\MessageType;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\User;
// class DataSeedingTest extends TestCase
// {
//     use RefreshDatabase;
//     use WithFaker;

//     public function setUp(): void
//     {
//         parent::setUp();
//         $this->seed();
//     }

//     public function test_seeding()
//     {
//         $user = User::where('name', 'Front Desk of Kashag')->first(); //kashag

//         $UserStartId = User::where('name','Head of Kashag')->first();
//         $UserEndId = User::where('name','Front Desk of KAS')->first();

//         $recipient = array($UserStartId->id,$UserEndId->id);

//         $MessageStartId = MessageType::where('name_tibetan','སྤྱིར་བཏང་།')->first();
//         $MessageEndId = MessageType::where('name_tibetan','སྙན་ཞུ།')->first();

//         for($i = 0 ; $i < 5; $i++)
//         {
//             $nameShort = strtolower(str_replace(['#', '/', '\\', ' '], '-', $user->organization->name_short));
//             $imageUrl = $this->faker->imageUrl(640, 480, true) ?? 'path/to/default-image.png';
//             $media = $user->addMediaFromUrl($imageUrl)
//                          ->sanitizingFileName(function($fileName) {
//                              return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
//                          })
//                          ->toMediaCollection($nameShort);
//             $outgoing_register = $user->organization->outgoingRegisterValue() + 1;

//             $response = $this->actingAs($user)->post('/mail/send', [
//                 "recipients" => $this->faker->randomElement($recipient),
//                 "message_type_id" => rand($MessageStartId->id,$MessageEndId->id),
//                 "subject" => $this->faker->sentence(),
//                 "record" => ["letter_number" => "kashag","outgoing_no" => $outgoing_register],
//                 "media" => $media->id,
//                 "remarks" => $this->faker->sentence(),
//                 "status" => "sent",
//             ]);
//         }
//         $this->assertEquals(5, Message::all()->count());
//     }
// }
