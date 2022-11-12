<?php

namespace App\Console\Commands;

use App\Models\CustomerOrder;
use App\Models\Trip;
use Illuminate\Console\Command;

class addOrderScheduledToTrip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add order to exiset trip';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = CustomerOrder::where('scheduled',true)->where('status',1)->get();
        foreach($orders as $order){
            $customer = $order->customer;
            // $trip = Trip::where('status',1)->where()
        }
        return 0;
    }
}
