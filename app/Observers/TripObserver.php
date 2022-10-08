<?php

namespace App\Observers;

use App\Models\Trip;

class TripObserver
{
    public function creating(Trip $trip){
        if($provider_id = auth()->user()->provider_id){
            $trip->provider_id = $provider_id;
        }

        $total_price=0;
        foreach($trip->orders() as $order){
            $total_price += (float)$order->total_price; 
        }
        $trip->total_price = $total_price;
        if(empty($trip->trip_delivery_date))
            $trip->trip_delivery_date = date('Y-m-d');
       
    }

    public function created(Trip $trip){

    }

    public function updating(Trip $trip){
        $total_price=0;
        foreach($trip->orders() as $order){
            $total_price += (float)$order->total_price; 
        }
        $trip->total_price = $total_price;
    }

    public function updated(Trip $trip){

    }

    public function saving(Trip $trip){

    }

    public function saved(Trip $trip){

    }

    public function deleting(Trip $trip){

    }

    public function deleted(Trip $trip){

    }

    public function trashed(Trip $trip){

    }

    public function forceDeleted(Trip $trip){

    }

    public function restoring(Trip $trip){

    }

    public function restored(Trip $trip){

    }

    public function replicating(Trip $trip){

    }
    
}
