<?php

namespace App\Observers;

use App\Models\PurchasesDetail;

class PurchasesDetailObserver
{
     /**
     * Handle the ExpenseItem "saving" event.
     *
     * @param  \App\Models\PurchasesDetail  $expenseItem
     * @return void
     */
    public function saving(PurchasesDetail $purchasesDetail)
    {
        
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\PurchasesDetail  $expenseItem
     * @return void
     */
    public function updating(PurchasesDetail $purchasesDetail){

    }
    /**
     * Handle the ExpenseItem "saved" event.
     *
     * @param  \App\Models\PurchasesDetail  $expenseItem
     * @return void
     */
    public function saved(PurchasesDetail $purchase){

    }
    public function retrieved(PurchasesDetail $purchasesDetail){

    }

    public function creating(PurchasesDetail $purchasesDetail){

    }

    public function created(PurchasesDetail $purchasesDetail){

    }


    public function updated(PurchasesDetail $purchasesDetail){

    }

    public function deleting(PurchasesDetail $purchasesDetail){

    }

    public function deleted(PurchasesDetail $purchasesDetail){

    }

    public function trashed(PurchasesDetail $purchasesDetail){

    }

    public function forceDeleted(PurchasesDetail $purchasesDetail){

    }

    public function restoring(PurchasesDetail $purchasesDetail){

    }

    public function restored(PurchasesDetail $purchasesDetail){

    }

    public function replicating(PurchasesDetail $purchasesDetail){

    }
}
