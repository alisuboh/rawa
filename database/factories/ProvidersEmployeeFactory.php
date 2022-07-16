<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\ProvidersEmployee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProvidersEmployee>
 */
class ProvidersEmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $phone = $this->faker->phoneNumber();
        return [
            'provider_id'=>Provider::all()->random(),
            'seq'=>$this->faker->randomDigitNotZero(),
            'full_name'=>$this->faker->name(),
            'phone_number'=> $phone,
            'mobile_number'=>$phone,
            'status'=>1,
            'type' => array_key_first($this->faker->randomElements(ProvidersEmployee::TYPE,1,true))
        ];
    }
}
