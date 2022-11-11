<?php

namespace App\Console\Commands;

use App\Models\Trip;
use App\Models\TripsScheduled;
use Carbon\Carbon;
use Illuminate\Console\Command;

class createTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:trip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create trip from trip_scheduled';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $day = [
            'All'  => 0 ,
            'Sunday'  => 1 ,
            'Monday'  => 2 ,
            'Tuesday'  => 3 ,
            'Wednesday'  => 4 ,
            'Thursday'  => 5 ,
            'Friday'  => 6 ,
            'Saturday'  => 7 ,
    
        ]; 
              
        $day_arabic = [
             0 => 'يوميا' ,
             1 => 'الاحد' ,
             2 => 'الاثنين' ,
             3 => 'الثلاثاء' ,
             4 => 'الاربعاء' ,
             5 => 'الخميس' ,
             6 => 'الجمعة' ,
             7 => 'السبت' 
        ];
        $today = $day_arabic[$day[Carbon::today()->format('l')]];
        $scheduled_all = TripsScheduled::where("days",'like',"%$today%")->get();
        foreach($scheduled_all as $scheduled){
            $trip = new Trip();
            $trip->trip_name =$scheduled->name;
            $trip->provider_id =$scheduled->provider_id;
            $trip->orders_ids =$scheduled->orders_ids;
            $trip->customer_ids =$scheduled->customer_ids;
            $trip->driver_id =$scheduled->driver_id;
            $trip->trip_delivery_date =$scheduled->delivery_date;
            $trip->status =1;
            $trip->note =$scheduled->note;
            $trip->driver_name = $scheduled->driver->full_name??'';
            $trip->driver_phone = $scheduled->driver->phone_number??'';
            $trip->total_price = 0;
            $trip->app_source = 3;
            $trip->save();
        }

        return 0;
    }
}
