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
    public function saving(Purchase $Purchase)
    {
        if($provider_id = auth()->user()->provider_id)
            $Purchase->provider_id = $provider_id;
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\Purchase  $expenseItem
     * @return void
     */
    public function updating(Purchase $Purchase){

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
