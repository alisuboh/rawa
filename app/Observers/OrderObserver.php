<?php

namespace App\Observers;

use App\Models\CustomerOrder;

class OrderObserver
{
    /**
     * Handle the CustomerOrder "created" event.
     *
     * @param  \App\Models\CustomerOrder  $customerOrder
     * @return void
     */
    public function created(CustomerOrder $customerOrder)
    {
        //
    }

    /**
     * Handle the CustomerOrder "updated" event.
     *
     * @param  \App\Models\CustomerOrder  $customerOrder
     * @return void
     */
    public function updated(CustomerOrder $customerOrder)
    {
        //
    }

    /**
     * Handle the CustomerOrder "deleted" event.
     *
     * @param  \App\Models\CustomerOrder  $customerOrder
     * @return void
     */
    public function deleted(CustomerOrder $customerOrder)
    {
        //
    }

    /**
     * Handle the CustomerOrder "restored" event.
     *
     * @param  \App\Models\CustomerOrder  $customerOrder
     * @return void
     */
    public function restored(CustomerOrder $customerOrder)
    {
        //
    }

    /**
     * Handle the CustomerOrder "force deleted" event.
     *
     * @param  \App\Models\CustomerOrder  $customerOrder
     * @return void
     */
    public function forceDeleted(CustomerOrder $customerOrder)
    {
        //
    }
}
