<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RevenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('revenue_parants')->insert([
            'name' => 'مبيعات',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('revenue_parants')->insert([
            'name' => 'اخرى',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);

        //seed category

        DB::table('revenue_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'مبيعات مباشرة',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('revenue_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'مبيعات طلبات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);

        DB::table('revenue_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'بدل اتلافات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('revenue_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'خصومات مكتسبة',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
    
    }
    
}
