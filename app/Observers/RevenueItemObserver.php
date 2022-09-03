<?php

namespace App\Observers;

use App\Models\RevenueItem;

class RevenueItemObserver
{
    public function retrieved(RevenueItem $revenueItem){
    }

    public function creating(RevenueItem $revenueItem){
   
    }

    public function created(RevenueItem $revenueItem){

    }

    public function updating(RevenueItem $revenueItem){

    }

    public function updated(RevenueItem $revenueItem){

    }

    public function saving(RevenueItem $revenueItem){
        if(auth()->user()->provider_id)
            $revenueItem->provider_id = auth()->user()->provider_id;

    }

    public function saved(RevenueItem $revenueItem){

    }

    public function deleting(RevenueItem $revenueItem){

    }

    public function deleted(RevenueItem $revenueItem){

    }

    public function trashed(RevenueItem $revenueItem){

    }

    public function forceDeleted(RevenueItem $revenueItem){

    }

    public function restoring(RevenueItem $revenueItem){

    }

    public function restored(RevenueItem $revenueItem){

    }

    public function replicating(RevenueItem $revenueItem){

    }
}
