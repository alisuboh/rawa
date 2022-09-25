<?php

namespace App\Observers;

use App\Models\ProvidersEmployee;

class ProvidersEmployeeObserver
{
    public function retrieved(ProvidersEmployee $providersEmployee){

    }

    public function creating(ProvidersEmployee $providersEmployee){
        if($provider_id = auth()->user()->provider_id){
            $providersEmployee->provider_id = $provider_id;
        }
    }

    public function created(ProvidersEmployee $providersEmployee){

    }

    public function updating(ProvidersEmployee $providersEmployee){

    }

    public function updated(ProvidersEmployee $providersEmployee){

    }

    public function saving(ProvidersEmployee $providersEmployee){

    }

    public function saved(ProvidersEmployee $providersEmployee){

    }

    public function deleting(ProvidersEmployee $providersEmployee){

    }

    public function deleted(ProvidersEmployee $providersEmployee){

    }

    public function trashed(ProvidersEmployee $providersEmployee){

    }

    public function forceDeleted(ProvidersEmployee $providersEmployee){

    }

    public function restoring(ProvidersEmployee $providersEmployee){

    }

    public function restored(ProvidersEmployee $providersEmployee){

    }

    public function replicating(ProvidersEmployee $providersEmployee){

    }
}
