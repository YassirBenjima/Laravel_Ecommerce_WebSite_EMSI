<?php

namespace Database\Factories;

use App\Models\ShippingCharge;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingCharge>
 */
class ShippingChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ShippingCharge::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(10, 56),
            'country_id' => $this->faker->numberBetween(6, 241),
            'amount' => $this->faker->numberBetween(10, 50),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
