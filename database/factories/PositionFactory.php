<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->randomPosition(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function randomPosition(): string
    {
        $prefixes = ['Junior', 'Senior', 'Lead', 'Chief', 'Assistant', 'Executive'];
        $roles = ['Developer', 'Manager', 'Designer', 'Analyst', 'Engineer', 'Coordinator'];
        $prefix = $this->faker->randomElement($prefixes);
        $role = $this->faker->randomElement($roles);
        return $prefix . ' ' . $role;
    }
}
