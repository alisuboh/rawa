<?php

namespace App\Observers;

use App\Models\Purchase;

class PurchaseObserver
{
     /**
     * Handle the ExpenseItem "saving" event.
     *
     * @param  \App\Models\Purchase  $expenseItem
     * @return void
     */
    public function saving(Purchase $purchase)
    {
        
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\Purchase  $expenseItem
     * @return void
     */
    public function updating(Purchase $purchase){

    }
    /**
     * Handle the ExpenseItem "saved" event.
     *
     * @param  \App\Models\Purchase  $expenseItem
     * @return void
     */
    public function saved(Purchase $purchase){

    }
    public function retrieved(Purchase $purchase){

    }

    public function creating(Purchase $purchase){
        if($provider_id = auth()->user()->provider_id)
            $purchase->provider_id = $provider_id;
    }

    public function created(Purchase $purchase){

    }



    public function updated(Purchase $purchase){

    }



    public function deleting(Purchase $purchase){

    }

    public function deleted(Purchase $purchase){

    }

    public function trashed(Purchase $purchase){

    }

    public function forceDeleted(Purchase $purchase){

    }

    public function restoring(Purchase $purchase){

    }

    public function restored(Purchase $purchase){

    }

    public function replicating(Purchase $purchase){

    }
}
