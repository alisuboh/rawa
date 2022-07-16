<?php

namespace Database\Factories;

use App\Models\ProductsCategory;
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
            'product_name' => $this->faker->unique()->numerify('###ABC###'),
            'product_description' => $this->faker->realText(50),
            'product_code' => $this->faker->unique()->numerify('ABC###'),
            'category_id' => ProductsCategory::all()->random()->category_id,
            'size' => $this->faker->randomDigitNotZero(),
            'icon_path' =>  $this->faker->imageUrl(),
            
        ];
    }
}
