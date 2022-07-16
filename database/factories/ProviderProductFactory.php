<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Provider;
use App\Models\ProviderProduct;
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
        // 'provider_id','provider_product_name', 'product_id', 'price', 'is_active', 'discount' measurement','icon_path
        $product = Product::all()->random();
        return [
            'provider_id' => Provider::all()->random()->id,
            'product_id' => $product->product_id,
            'provider_product_name' => $product->product_name,
            'price' => $this->faker->randomFloat(null,0.15,5.0), 
            'is_active' => true,
            'discount' => 0,
            'measurement' => array_key_first($this->faker->randomElements(ProviderProduct::MEASUREMENT,1,true)),
            'icon_path' => $product->icon_path


        ];
    }
}
