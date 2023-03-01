<?php

namespace Database\Seeders;

use App\Models\WebPermission;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addWebPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      WebPermission::query()->truncate();

        $permissions = [
            "view-orders",
            "edit-orders",
            "view-trips",
            "edit-trips",
            "view-scheduledTrips",
            "edit-scheduledTrips",
            "view-revenues",
            "add-revenues",
            "edit-revenues",
            "delete-revenues",
            "view-expenses",
            "add-expenses",
            "edit-expenses",
            "delete-expenses",
            "view-purchases",
            "add-purchases",
            "edit-purchases",
            "delete-purchases",
            "view-suppliers",
            "add-suppliers",
            "edit-suppliers",
            "delete-suppliers",
            "view-clients",
            "add-clients",
            "edit-clients",
            "delete-clients",
            "view-employees",
            "add-employees",
            "edit-employees",
            "delete-employees",
            "view-report",
            "pos",
            "add-trips", 
            'add-scheduledTrips', 
            'change-password',
            "view-product",
            "add-product",
            "edit-product",
            "delete-product",
          ];
          foreach($permissions as $per){
            DB::table('web_permission')->insert([
                'slug' => $per,
                'name' => $per,
                // 'route' => '',
                'role_id' => '[2]',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    
            ]);
          }
        
    }
}
