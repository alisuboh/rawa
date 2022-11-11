<?php

namespace App\Observers;

use App\Models\TripsScheduled;

class TripsScheduledObserver
{
    public function retrieved(TripsScheduled $tripsScheduled){

    }

    public function creating(TripsScheduled $tripsScheduled){
        // if($provider_id = auth()->user()->provider_id){
            $tripsScheduled->provider_id = auth()->user()->provider_id;
        // }
    }

    public function created(TripsScheduled $tripsScheduled){

    }

    public function updating(TripsScheduled $tripsScheduled){

    }

    public function updated(TripsScheduled $tripsScheduled){

    }

    public function saving(TripsScheduled $tripsScheduled){

    }

    public function saved(TripsScheduled $tripsScheduled){

    }

    public function deleting(TripsScheduled $tripsScheduled){

    }

    public function deleted(TripsScheduled $tripsScheduled){

    }

    public function trashed(TripsScheduled $tripsScheduled){

    }

    public function forceDeleted(TripsScheduled $tripsScheduled){

    }

    public function restoring(TripsScheduled $tripsScheduled){

    }

    public function restored(TripsScheduled $tripsScheduled){

    }

    public function replicating(TripsScheduled $tripsScheduled){

    }
}
