<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'threads' => Thread::factory(),
            'is_user' => $this->faker()->boolean(),
            'user_id' => User::factory(),
            'contact_id' => Contact::factory(),
            'remarks' => $this->faker->text()
        ];
    }
}
