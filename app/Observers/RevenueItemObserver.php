<?php

namespace App\Observers;

use App\Constants\TransCode;
use App\Models\CustomerOrder;
use App\Models\RevenueItem;

class RevenueItemObserver
{
     /**
     * Handle the ExpenseItem "saving" event.
     *
     * @param  \App\Models\RevenueItem  $expenseItem
     * @return void
     */
    public function saving(RevenueItem $revenueItem)
    {
        
            
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\RevenueItem  $expenseItem
     * @return void
     */
    public function updating(RevenueItem $revenueItem){

    }
    /**
     * Handle the ExpenseItem "saved" event.
     *
     * @param  \App\Models\RevenueItem  $expenseItem
     * @return void
     */
    public function saved(RevenueItem $revenueItem){
      

    }
    
    public function retrieved(RevenueItem $revenueItem){
    }

    public function creating(RevenueItem $revenueItem){
        if($provider_id = auth()->user()->provider_id){
            $revenueItem->provider_id = $provider_id;
            $revenueItem->seq = $revenueItem->getLastSeq();
            if(!empty($revenueItem->customer_id)){
                $tabular_order = CustomerOrder::getLastSeqNumber(2);
                $revenueItem = TransCode::CODES_ARRAY["tabular_order"]. str_repeat('0',7 - $this->countDigits($tabular_order) ). $tabular_order;
            }else if(!empty($revenueItem->rev_cat_id) && $revenueItem->rev_cat_id == 1){
                $cash_order = CustomerOrder::getLastSeqNumber(1);
                $revenueItem = TransCode::CODES_ARRAY["direct_order"]. str_repeat('0',7 - $this->countDigits($cash_order) ). $cash_order;
            }

        }
    }

    public function created(RevenueItem $revenueItem){
        if(empty($revenueItem->transaction_date)){
            $revenueItem->transaction_date = $revenueItem->created_at;
            $revenueItem->save();
        }
    }


    public function updated(RevenueItem $revenueItem){

    }


    public function deleting(RevenueItem $revenueItem){

    }

    public function deleted(RevenueItem $revenueItem){

    }

    public function trashed(RevenueItem $revenueItem){

    }

    public function forceDeleted(RevenueItem $revenueItem){

    }

    public function restoring(RevenueItem $revenueItem){

    }

    public function restored(RevenueItem $revenueItem){

    }

    public function replicating(RevenueItem $revenueItem){

    }
    function countDigits($MyNum){
        $MyNum = (int)abs($MyNum);
        $MyStr = strval($MyNum);
        return strlen($MyStr);
      }
}
