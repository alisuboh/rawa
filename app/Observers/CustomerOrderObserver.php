<?php

namespace App\Observers;

use App\Constants\TransCode;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\ProviderProduct;
use App\Models\RevenueCategory;
use App\Models\RevenueItem;
use Illuminate\Support\Facades\Log;

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
    }
    /**
     * Handle the ExpenseItem "updating" event.
     *
     * @param  \App\Models\CustomerOrder  $expenseItem
     * @return void
     */
    public function updating(CustomerOrder $customerOrder)
    {
    }
    /**
     * Handle the ExpenseItem "saved" event.
     *
     * @param  \App\Models\CustomerOrder  $expenseItem
     * @return void
     */
    public function saved(CustomerOrder $purchase)
    {
    }

    public function retrieved(CustomerOrder $customerOrder)
    {
    }

    public function creating(CustomerOrder $customerOrder)
    {
        if ($provider_id = auth()->user()->provider_id)
            $customerOrder->provider_id = $provider_id;

        $customer_id = null;
        $customerOrder->status = 3;
        $customerOrder->seq = $customerOrder->seq ?? $customerOrder->getLastSeq($customerOrder->type);
        if ($customerOrder->type == 1) {
            $customerOrder->full_name = 'direct';
            $customerOrder->payment_type = 1;
            $rev_cat_id = RevenueCategory::where(['description' => 'مبيعات مباشرة'])->first()->id;
            // $code = TransCode::DIRECT_ORDER;
            $code= TransCode::CODES_ARRAY["direct_order"].str_repeat('0',7 - $this->countDigits($customerOrder->seq) ). $customerOrder->seq;
            $description = 'مبيعات مباشرة';
            $payment_type = 1;
        } else if ($customerOrder->type == 2) {
            $customerOrder->status = 1;
            // $customer = Customer::find($customerOrder->customer_id);
            // $customer_id = $customer->id;
            // $customerOrder->full_name = $customer->name;
            // $customerOrder->phone_number = $customer->mobile_number;
            // $rev_cat_id = RevenueCategory::where(['description' => 'مبيعات طلبات'])->first()->id;
            // $code = TransCode::CODES_ARRAY["tabular_order"]. str_repeat('0',7 - $this->countDigits($customerOrder->seq) ). $customerOrder->seq;
            // $description = 'مبيعات طلبات';
            // $payment_type = $customerOrder->payment_type;
        } else if ($customerOrder->type == 3) {
            $customerOrder->full_name = 'car';
            $customerOrder->payment_type = 1;
            $rev_cat_id = RevenueCategory::where(['description' => 'مبيعات سيارة'])->first()->id;
            $code= TransCode::CODES_ARRAY["car_order"].str_repeat('0',7 - $this->countDigits($customerOrder->seq) ). $customerOrder->seq;
            $description = 'مبيعات سيارة';
            $payment_type = 1;
        }
        $price = 0;
        foreach ($customerOrder->order_products as $product) {
            $item = ProviderProduct::find($product['provider_product_id']);
            $price += $item->price * $product['qty'];
        }
        $price = floor(($price ) * 100)/100;
        $customerOrder->price = $customerOrder->total_price = $price;

        if($customerOrder->type == 1 || $customerOrder->type ==3){

            $revenueItem = [
                'is_active' => 1,
                'provider_id' => $provider_id,
                'rev_cat_id' => $rev_cat_id,
                'code' => $code,
                'description' => $description,
                'source' => 2,
                'customer_id' => $customer_id
            ];

            switch ($payment_type) {
                case 1: //cash
                    $revenueItem['total_price'] = $price;
                    break;
                case 2: //coupon
                    $revenueItem['total_price'] = 0;

                    break;
                case 3: //postponed
                    $revenueItem['total_price'] = -$price;

                    break;
                default:
                    $revenueItem['total_price'] = $price;
            }
            RevenueItem::create($revenueItem);
        }
        Log::info("order data on create:".json_encode($customerOrder));
    }

    public function created(CustomerOrder $customerOrder)
    {
    }

    public function updated(CustomerOrder $customerOrder)
    {
        try{
            if ($customerOrder->type == 2 && $customerOrder->status == 3) {
                $code = TransCode::CODES_ARRAY["tabular_order"]. str_repeat('0',7 - $this->countDigits($customerOrder->seq) ). $customerOrder->seq;
                $rev = RevenueItem::where("provider_id",auth()->user()->provider_id)->where('code',$code)->first();
                if($rev){
                    $price = 0;
                    foreach ($customerOrder->order_products as $product) {
                        $item = ProviderProduct::find($product['provider_product_id']);
                        $price += $item->price * $product['qty'];
                    }
                    $price = floor(($price ) * 100)/100;
                    $customerOrder->price = $customerOrder->total_price = $price;

                    switch ($customerOrder->payment_type) {
                        case 1: //cash
                            $rev->total_price = $price;
                            break;
                        case 2: //coupon
                            $rev->total_price = 0;
                            break;
                        case 3: //postponed
                            $rev->total_price = -$price;
                            break;
                        default:
                            $rev->total_price = $price;
                    }
                    $rev->save();
            
                }else{
                    $rev_cat_id = RevenueCategory::where(['description' => 'مبيعات طلبات'])->first()->id;
                    $code = TransCode::CODES_ARRAY["tabular_order"]. str_repeat('0',7 - $this->countDigits($customerOrder->seq) ). $customerOrder->seq;
                    $description = 'مبيعات طلبات';
                    $payment_type = $customerOrder->payment_type;
                    $revenueItem = [
                        'is_active' => 1,
                        'provider_id' => $customerOrder->provider_id,
                        'rev_cat_id' => $rev_cat_id,
                        'code' => $code,
                        'description' => $description,
                        'source' => 2,
                        'customer_id' => $customerOrder->customer_id
                    ];
                    $price = $customerOrder->total_price;

                    switch ($payment_type) {
                        case 1: //cash
                            $revenueItem['total_price'] = $price;
                            break;
                        case 2: //coupon
                            $revenueItem['total_price'] = 0;
            
                            break;
                        case 3: //postponed
                            $revenueItem['total_price'] = -$price;
            
                            break;
                        default:
                            $revenueItem['total_price'] = $price;
                    }
            
                    RevenueItem::create($revenueItem);
                }
            } 
        }catch(\Exception $e){
            
        }
    }


    public function deleting(CustomerOrder $customerOrder)
    {
    }

    public function deleted(CustomerOrder $customerOrder)
    {
    }

    public function trashed(CustomerOrder $customerOrder)
    {
    }

    public function forceDeleted(CustomerOrder $customerOrder)
    {
    }

    public function restoring(CustomerOrder $customerOrder)
    {
    }

    public function restored(CustomerOrder $customerOrder)
    {
    }

    public function replicating(CustomerOrder $customerOrder)
    {
    }
    function countDigits($MyNum){
        $MyNum = (int)abs($MyNum);
        $MyStr = strval($MyNum);
        return strlen($MyStr);
      }
}
