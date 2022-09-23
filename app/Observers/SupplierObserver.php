<?php

namespace App\Observers;

use App\Models\Supplier;

class SupplierObserver
{
     /**
     * Handle the ExpenseItem "saving" event.
     *
     * @param  \App\Models\Supplier  $expenseItem
     * @return void
     */
    public function saving(Supplier $supplier)
    {
       
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\Supplier  $expenseItem
     * @return void
     */
    public function updating(Supplier $supplier){

    }
    /**
     * Handle the ExpenseItem "saved" event.
     *
     * @param  \App\Models\Supplier  $expenseItem
     * @return void
     */
    public function saved(Supplier $purchase){

    }
    public function retrieved(Supplier $supplier){

    }

    public function creating(Supplier $supplier){
        if($provider_id = auth()->user()->provider_id){
            $supplier->seq = $supplier->getLastSeq();
            $supplier->provider_id = $provider_id;
        }
    }

    public function created(Supplier $supplier){

    }

    public function updated(Supplier $supplier){

    }


    public function deleting(Supplier $supplier){

    }

    public function deleted(Supplier $supplier){

    }

    public function trashed(Supplier $supplier){

    }

    public function forceDeleted(Supplier $supplier){

    }

    public function restoring(Supplier $supplier){

    }

    public function restored(Supplier $supplier){

    }

    public function replicating(Supplier $supplier){

    }
}
