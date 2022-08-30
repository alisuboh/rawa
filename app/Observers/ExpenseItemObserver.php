<?php

namespace App\Observers;

use App\Models\ExpenseItem;

class ExpenseItemObserver
{
    /**
     * Handle the ExpenseItem "creating" event.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return void
     */
    public function creating(ExpenseItem $expenseItem)
    {
        if(auth()->user()->provider_id)
            $expenseItem->provider_id = auth()->user()->provider_id;
    }

    /**
     * Handle the ExpenseItem "updated" event.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return void
     */
    public function updated(ExpenseItem $expenseItem)
    {
        //
    }

    /**
     * Handle the ExpenseItem "deleted" event.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return void
     */
    public function deleted(ExpenseItem $expenseItem)
    {
        //
    }

    /**
     * Handle the ExpenseItem "restored" event.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return void
     */
    public function restored(ExpenseItem $expenseItem)
    {
        //
    }

    /**
     * Handle the ExpenseItem "force deleted" event.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return void
     */
    public function forceDeleted(ExpenseItem $expenseItem)
    {
        //
    }
}
