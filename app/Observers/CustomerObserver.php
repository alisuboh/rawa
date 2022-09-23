<?php

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerObserver
{

     /**
     * Handle the ExpenseItem "creating" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function creating(Customer $customer)
    {
        if($provider_id = auth()->user()->provider_id){
            $customer->default_provider_id = $provider_id;
            $customer->password = Hash::make("password");
            $customer->seq = $customer->getLastSeq();
             
        }
    }

    /**
     * Handle the Customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        //
    }
    /**
     * Handle the Customer "saving" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function saving(Customer $customer)
    {
      
        // dd($customer);
            
    }
    /**
     * Handle the Customer "updating" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updating(Customer $purchase){

    }

    public function retrieved(Customer $customer){

    }


    public function created(Customer $customer){

    }

    public function saved(Customer $customer){

    }

    public function deleting(Customer $customer){

    }

    public function deleted(Customer $customer){

    }

    public function trashed(Customer $customer){

    }

    public function forceDeleted(Customer $customer){

    }

    public function restoring(Customer $customer){

    }

    public function restored(Customer $customer){

    }

    public function replicating(Customer $customer){

    }
}
