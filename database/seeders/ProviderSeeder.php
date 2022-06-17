<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\ProviderProduct;
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
        $provider = Provider::factory()
        // ->count(5)
        // ->providerProducts(1)
        ->create();

        // $provider_product = ProviderProduct::factory()
        //     ->count(3)
        //     ->for($provider)
        //     ->create();
    }
}
