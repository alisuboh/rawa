<?php

namespace App\Observers;

use App\Models\RevenueItem;

class RevenueItemObserver
{
    /**
     * Handle the RevenueItem "creating" event.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return void
     */
    public function creating(RevenueItem $revenueItem)
    {
        if(auth()->user()->provider_id)
            $revenueItem->provider_id = auth()->user()->provider_id;

    }

    /**
     * Handle the RevenueItem "updated" event.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return void
     */
    public function updated(RevenueItem $revenueItem)
    {
        //
    }

    /**
     * Handle the RevenueItem "deleted" event.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return void
     */
    public function deleted(RevenueItem $revenueItem)
    {
        //
    }

    /**
     * Handle the RevenueItem "restored" event.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return void
     */
    public function restored(RevenueItem $revenueItem)
    {
        //
    }

    /**
     * Handle the RevenueItem "force deleted" event.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return void
     */
    public function forceDeleted(RevenueItem $revenueItem)
    {
        //
    }
}
