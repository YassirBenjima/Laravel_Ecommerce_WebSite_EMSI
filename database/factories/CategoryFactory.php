<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), // Randomly generate a name.
            'status' => rand(0, 1), // Randomly generate a status, either 0 or 1.
            'slug' => $this->faker->name(), // Randomly generate a slug.
        ];
    }
}
