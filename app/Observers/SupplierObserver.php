<?php

namespace App\Observers;

use App\Models\Supplier;

class SupplierObserver
{
    public function retrieved(Supplier $supplier){

    }

    public function creating(Supplier $supplier){

    }

    public function created(Supplier $supplier){

    }

    public function updating(Supplier $supplier){

    }

    public function updated(Supplier $supplier){

    }

    public function saving(Supplier $supplier){
        if(auth()->user()->provider_id)
            $supplier->provider_id = auth()->user()->provider_id;
    
    
    }

    public function saved(Supplier $supplier){

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
