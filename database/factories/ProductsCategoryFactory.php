<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductsCategory>
 */
class ProductsCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
                'category_name' => $this->faker->unique()->numerify('CAT###'),
                 'category_type' => $this->faker->randomDigitNotZero(),
                  'description' => $this->faker->realText(20),
                   'is_active' => true,
            
    
        ];
    }
}