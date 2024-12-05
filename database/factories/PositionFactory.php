<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->jobTitle(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
