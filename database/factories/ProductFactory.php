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
    public function definition()
    {
        return [
            'category_id' => Category::all()->random(),
            'title' => fake()->unique()->text(50),
            'description' => fake()->text(),
            'short_description' => fake()->text('120'),
            'SKU' => fake()->unique()->ean13(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'discount' => fake()->numberBetween(0, 50),
            'in_stock' => fake()->numberBetween(0, 30)
        ];
    }
}
