<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hard-Skill>
 */
class HardSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'homework' => $this->faker->numberBetween(1, 50),
            'participation' => $this->faker->numberBetween(1, 50),
        ];
    }
}
