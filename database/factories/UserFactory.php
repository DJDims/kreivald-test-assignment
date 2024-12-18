<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => '+380' . $this->faker->numerify('#########'),
            'photo' => 'storage/user_photos/'.$this->faker->numberBetween(0,9).'.jpg',
            'position_id' => Position::get()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
