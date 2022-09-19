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
        dd('sss');
        if($provider_id = auth()->user()->provider_id)
            $expenseItem->provider_id = $provider_id;

        if(!empty($expenseItem->beneficiary_id) && is_numeric($expenseItem->beneficiary_id)){

            // $expenseItem->beneficiary_name = $expenseItem->beneficiary->name;

        }else if(!empty($expenseItem->beneficiary_id) && !is_numeric($expenseItem->beneficiary_id)){
            $expenseItem->beneficiary_name = $expenseItem->beneficiary_id;
            $expenseItem->beneficiary_id = null;

        }
    }

    public function created(ExpenseItem $expenseItem){
        if(empty($expenseItem->transaction_date)){
            $expenseItem->transaction_date = $expenseItem->created_at;
            $expenseItem->save();
        }
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
     * Handle the ExpenseItem "saving" event.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return void
     */
    public function saving(ExpenseItem $expenseItem)
    {
        
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return void
     */
    public function updating(ExpenseItem $purchase){

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
