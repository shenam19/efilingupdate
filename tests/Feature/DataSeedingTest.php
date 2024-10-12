<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class DataSeedingTest extends TestCase
{   

    use WithFaker;

    public function test_seeding()
    {   
        $user = User::find(20); //kashag   
        $recipient = array('12','28');  

        for($i = 0 ; $i < 20; $i++)
        {
            $media = $user->addMediaFromUrl($this->faker->imageUrl(640, 480, true))
                ->sanitizingFileName(function($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection($user->organization->name_short);
            
            $outgoing_register = $user->organization->outgoingRegisterValue() + 1;

            $response = $this->actingAs($user)->post('/mail/send', [
                "recipients" => $this->faker->randomElement($recipient),
                "message_type_id" => rand(1,4),
                "subject" => $this->faker->sentence(),
                "record" => ["letter_number" => "kashag","outgoing_no" => $outgoing_register],
                "media" => $media->id,
                "remarks" => $this->faker->sentence(),
                "status" => "sent",
            ]);
        }
        dd("done");
    }
}
