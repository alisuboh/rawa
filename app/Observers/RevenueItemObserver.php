<?php

namespace App\Observers;

use App\Models\RevenueItem;

class RevenueItemObserver
{
     /**
     * Handle the ExpenseItem "saving" event.
     *
     * @param  \App\Models\RevenueItem  $expenseItem
     * @return void
     */
    public function saving(RevenueItem $revenueItem)
    {
        if($provider_id = auth()->user()->provider_id){
            $revenueItem->provider_id = $provider_id;
        }
            
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\RevenueItem  $expenseItem
     * @return void
     */
    public function updating(RevenueItem $revenueItem){

    }
    /**
     * Handle the ExpenseItem "saved" event.
     *
     * @param  \App\Models\RevenueItem  $expenseItem
     * @return void
     */
    public function saved(RevenueItem $purchase){

    }
    
    public function retrieved(RevenueItem $revenueItem){
    }

    public function creating(RevenueItem $revenueItem){
   
    }

    public function created(RevenueItem $revenueItem){

    }


    public function updated(RevenueItem $revenueItem){

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
