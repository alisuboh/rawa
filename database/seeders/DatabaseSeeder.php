<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // ProviderSeeder::class,
            // ExpenseSeeder::class,
            // RevenueSeeder::class,
            // addCarOrder::class,
            addWebPermission::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
