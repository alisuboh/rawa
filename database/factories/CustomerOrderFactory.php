<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Provider;
use App\Models\ProviderProduct;
use App\Models\ProvidersEmployee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class CustomerOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $customer = Customer::all()->random();
        $provider = Provider::where('id',$customer->default_provider_id)->first()??Provider::all()->random();
        $qty = $this->faker->randomDigitNotZero();
        $product = ProviderProduct::where('provider_id' ,$provider->id)->first();
        if(!empty($product->price))
        $price = $qty*$product->price;
        else
        $price = $this->faker->randomFloat(2,0.15,5.0);
        $eee = ProvidersEmployee::where('provider_id' , $provider->id)->where('type',1)->get();
        if($eee->count() > 0){
            // dd($eee);
            $employee = $eee->random();
        }
        else{
            ProvidersEmployee::where('type',1)->first();

        }
        // $employee = ProvidersEmployee::where('provider_id' , $provider->id)->where('type',1)->get()->random()??ProvidersEmployee::where('type',1)->random();
        return [
            'customer_id' => $customer->id,
            'provider_id' => $provider->id,
            'order_products' => [
                'provider_product_id' => $product->provider_product_id,
                'qty' => $qty
            ],
            'full_name' => $customer->name,
            'phone_number' => $customer->mobile_number,
            'customer_address_id' => $customer->CustomersAddress->address_name??'',
            'total_price' => $price,
            'order_delivery_date' => $this->faker->date('Y-m-d H:i:s'),
            'status' => array_key_first($this->faker->randomElements(CustomerOrder::STATUS,1,true)),
            'app_source' => 'web',
            'note' => $this->faker->realText(10),
            'reason_note' => '',
            'vat' => 0,
            'price_discount' => 0,
            'shipping_fees' => 0.5,
            'provider_employee_id' => $employee->id,
            'price' => $price + 0.5
        ];
    }
}
