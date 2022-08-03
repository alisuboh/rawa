<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property integer $provider_id
 * @property mixed $order_products
 * @property string $full_name
 * @property string $phone_number
 * @property integer $customer_address_id
 * @property float $total_price
 * @property string $order_delivery_date
 * @property string $status
 * @property integer $app_source
 * @property string $note
 * @property string $reason_note
 * @property float $vat
 * @property float $price_discount
 * @property float $shipping_fees
 * @property integer $provider_employee_id
 * @property float $price
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 * @property Provider $provider
 */
class CustomerOrder extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'provider_id', 'order_products', 'full_name', 'phone_number', 'customer_address_id', 'total_price', 'order_delivery_date', 'status', 'app_source', 'note', 'reason_note', 'vat', 'price_discount', 'shipping_fees', 'provider_employee_id', 'price', 'created_at', 'updated_at'];
    public $customer_adress ;
    const STATUS = [
        1 => 'Pending',
        2 => 'Start',
        3 => 'completed',
        0 => 'Canceled'

    ];
    const APP_SOURCE = [
        1 => 'web',
        2 => 'app',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }

    public function getOrderProductsAttribute($value)
    {
        
        $orders = [];
        foreach(array_values(json_decode($value, true)) as $key => $order){
            $providerProduct = ProviderProduct::find([ 'provider_product_id' => $order['provider_product_id']])->first();
            if($providerProduct){
                $orders[$key] = $providerProduct->toArray();
                $pro = [];
                if(!empty($orders[$key]['product_id']))
                    $pro = Product::find($orders[$key]['product_id'])->toArray();
                $orders[$key]['total'] =$order['qty']*$orders[$key]['price']; 
                $orders[$key] = array_merge($orders[$key],$order);
                $orders[$key] = array_merge($orders[$key],$pro);
            }
           

        }
        return $orders;
    }
    public function disableDynamicAccessors()
    {
        $this->getOrderProductsAttribute([]);
    }

    public function setOrderProductsAttribute($value)
    {
        $this->attributes['order_products'] = json_encode(array_values($value));
    }
    public function getCustomerAddresses()
    {
                
     return $this->customer->customersAddresses()->find($this->customer_address_id);
    }
}
