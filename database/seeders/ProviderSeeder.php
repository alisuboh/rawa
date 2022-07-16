<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomersAddress;
use App\Models\Product;
use App\Models\ProductsCategory;
use App\Models\Provider;
use App\Models\ProviderProduct;
use App\Models\ProvidersEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::factory()
        ->has(ProvidersEmployee::factory()->count(3))
        ->count(10)
        // ->providerProducts(1)
        ->create();
        ProductsCategory::factory()
        ->count(15)
        ->create();

        Product::factory()
        ->count(15)
        ->create();

        ProviderProduct::factory()
        ->count(15)
        ->create();

        Customer::factory()
        ->count(50)
        ->has(CustomersAddress::factory()->count(1))
        ->has(CustomerOrder::factory()->count(2))
        ->create();

        // $provider_product = ProviderProduct::factory()
        //     ->count(3)
        //     ->for($provider)
        //     ->create();
    }
}
