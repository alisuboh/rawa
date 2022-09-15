<?php

namespace App\Observers;

use App\Constants\TransCode;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\ProviderProduct;
use App\Models\RevenueCategory;
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
            $rev_cat_id = RevenueCategory::where(['description' => 'مبيعات مباشرة'])->first()->id;
            $code = TransCode::DIRECT_ORDER;
            $description = 'مبيعات مباشرة';
            $payment_type = 1;

        }else if($customerOrder->type == 2){
            $customer = Customer::find($customerOrder->customer_id);
            $customerOrder->full_name = $customer->name;
            $customerOrder->phone_number = $customer->mobile_number;
            $rev_cat_id = RevenueCategory::where(['description' => 'مبيعات طلبات'])->first()->id;
            $code = TransCode::TABULAR_ORDER;
            $description = 'مبيعات طلبات';
            $payment_type = $customerOrder->payment_type;


        }
        $price = 0;
        foreach($customerOrder->order_products as $product){
            $item = ProviderProduct::find($product['provider_product_id']);
            $price += $item->price * $product['qty']; 
        }

        $customerOrder->price = $price;
        $customerOrder->total_price = $price;
        
        $revenueItem = [
                    'is_active' => 1, 
                    'provider_id' => $provider_id,
                    'rev_cat_id' => $rev_cat_id,
                    'code' => $code,
                    'description' => $description
        ];

        switch ($payment_type){
            case 1://cash
                $revenueItem['total_price'] = $price;
                break;
            case 2://coupon
                $revenueItem['total_price'] = 0;

                break;
            case 3://postponed
                $revenueItem['total_price'] = -$price;

                break;
            default:
                $revenueItem['total_price'] = $price;

        }

        RevenueItem::create($revenueItem);
        
        
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
