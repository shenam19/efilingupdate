<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Folder;

class FolderFactory extends Factory
{

    protected $model = Folder::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file_no' => $this->faker->randomDigit(),
            'name' => $this->faker->word(),
            'organization_id' => 14, //TCRC
            'date_opened' => $this->faker->date(),
            'file_type' => 'general',
        ];
    }
}
