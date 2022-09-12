<?php

namespace App\Observers;

use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\ProviderProduct;
use App\Models\RevenueItem;

class CustomerOrderObserver
{
    /**
     * Handle the ExpenseItem "saving" event.
     *
     * @param  \App\Models\CustomerOrder  $expenseItem
     * @return void
     */
    public function saving(CustomerOrder $customerOrder)
    {

        if($provider_id = auth()->user()->provider_id)
            $customerOrder->provider_id = $provider_id;

        $customerOrder->status = 1;

        if($customerOrder->type == 1){
            $customerOrder->full_name = 'direct';
            $customerOrder->payment_type = 1;

        }else if($customerOrder->type == 2){
            $customer = Customer::find($customerOrder->customer_id);
            $customerOrder->full_name = $customer->name;
            $customerOrder->phone_number = $customer->mobile_number;

        }
        $price = 0;
        foreach($customerOrder->order_products as $product){
            $item = ProviderProduct::find($product->provider_product_id);
            $price += $item->price * $product->qty;
          
        }

        $customerOrder->price = $price;
        $customerOrder->total_price = $price;
        // $revenueItem = new RevenueItem();
        // switch ($customer->payment_type){
        //     case 1://cash
        //         $revenueItem
        //         break;
        //     case 2://coupon

        //         break;
        //     case 3://postponed

        //         break;
        //     default:

        // }


        
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\CustomerOrder  $expenseItem
     * @return void
     */
    public function updating(CustomerOrder $customerOrder){

    }
    /**
     * Handle the ExpenseItem "saved" event.
     *
     * @param  \App\Models\CustomerOrder  $expenseItem
     * @return void
     */
    public function saved(CustomerOrder $purchase){

    }

    public function retrieved(CustomerOrder $customerOrder){

    }

    public function creating(CustomerOrder $customerOrder){

    }

    public function created(CustomerOrder $customerOrder){

    }

    public function updated(CustomerOrder $customerOrder){

    }


    public function deleting(CustomerOrder $customerOrder){

    }

    public function deleted(CustomerOrder $customerOrder){

    }

    public function trashed(CustomerOrder $customerOrder){

    }

    public function forceDeleted(CustomerOrder $customerOrder){

    }

    public function restoring(CustomerOrder $customerOrder){

    }

    public function restored(CustomerOrder $customerOrder){

    }

    public function replicating(CustomerOrder $customerOrder){

    }
}
