<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderHd>
 */
class OrderHdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(1),
            'name' => $this->faker->name(),
            'total_product' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->randomFloat(2, 100, 1000),
            'payment_method' => $this->faker->randomElement(['BCA', 'Mandiri', 'BNI', 'BRI'])
        ];
    }
}
