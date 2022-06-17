<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProviderProduct>
 */
class ProviderProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // dd($this->id);        
        // foreach($this->for as $provider){
        //     dd($provider->attributes);
        // }
        // 'provider_id','provider_product_name', 'product_id', 'price', 'is_active', 'discount'
        return [
            // 'product_id' => Product::all()->random()->id
            //
        ];
    }
}
