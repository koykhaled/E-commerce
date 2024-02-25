<?php

namespace Database\Factories;

use App\Models\SubCategory;
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
        return [
            'name' => $this->faker->unique()->words($nb = 2, $asText = true),
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(100, 5000),
            'sale_price' => $this->faker->numberBetween(100, 5000) * 0.1,
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100, 200),
            'SKU' => "DIGI-" . $this->faker->unique()->numberBetween(100, 500),
            'image' => 'digital_' . $this->faker->numberBetween(1, 22) . '.jpg',
            'category_id' => function () {
                return SubCategory::all()->random()->id;
            }
        ];
    }
}