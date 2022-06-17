<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('123456'), // password
            'status' => 1,
            'city_id' => 1,
            'address_line_1' =>  $this->faker->address(),
            'has_branches' => 0,
            'is_on_top_search' => 0,
            'rate'=>0,
            'contact_phone' => $this->faker->phoneNumber()


        ];
    }
}
