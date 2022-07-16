<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomersAddress>
 */
class CustomersAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'customer_id' => Customer::all()->random()->id,
            'location_lat' => $this->faker->latitude(),
            'location_lng' => $this->faker->longitude(),
            'is_default' => 1 ,
            'address_name' => $this->faker->address(),
            'address_description' => $this->faker->streetAddress()
        ];
    }
}
