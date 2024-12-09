<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::factory()->create();

        return [
            'category_id' => $category->id,
            'product_name' => $this->faker->word,
            'buy_price' => $this->faker->randomFloat(2, 100, 1000),
            'sell_price' => $this->faker->randomFloat(2, 100, 1000),
            'product_image' => $this->faker->word,
            'product_description' => $this->faker->sentence(2),
            'parent_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
