<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * @property integer $id
 * @property string $trip_name
 * @property integer $provider_id
 * @property mixed $orders_ids
 * @property mixed $customer_ids
 * @property integer $driver_id
 * @property string $driver_name
 * @property string $driver_phone
 * @property string $status
 * @property float $total_price
 * @property string $trip_delivery_date
 * @property integer $app_source
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property Provider $provider
 */
class Trip extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['trip_name','provider_id', 'orders_ids','customer_ids', 'driver_id', 'driver_name', 'driver_phone', 'status', 'total_price', 'trip_delivery_date', 'app_source', 'note', 'created_at', 'updated_at'];

    const STATUS = [
        1 => 'Pending',
        2 => 'Start',
        3 => 'completed',
        0 => 'Canceled'

    ];
    const APP_SOURCE = [
        1 => 'web',
        2 => 'app',
        3 => 'system',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function providersEmployee()
    {
        return $this->belongsTo('App\Models\ProvidersEmployee','driver_id');
    }

    public function getOrdersIdsAttribute($value)
    {
        $orders = [];
        // dd($value);
        if(!empty($value) && $value != "null"){
            // dd($this);
            foreach(array_values(json_decode($value, true)) as $key => $order){
                // dd(CustomerOrder::find([ 'id' => $order['orders_id']])->first()->toArray());
                try{
                    if(!empty(auth()->user()->driver_id)){
                        if($model = CustomerOrder::where('status', '=', "1")->where( 'id' ,"=", $order['orders_id'])->with('customer','address')->get()->first())
                            $orders[$key] = $model->toArray();
                    }else
                        if($model = CustomerOrder::with('customer','address')->find([ 'id' => $order['orders_id']])->first())
                            $orders[$key] = $model->toArray();
    
                }catch(\Exception $e){
                    return [];
                }
            }
        }

        // dd($orders);

        return $orders;
    }

    public function setOrdersIdsAttribute($value)
    {
        $this->attributes['orders_ids'] = $value?json_encode($value):null;
    }
    public function orders(){

        return CustomerOrder::whereIn('id',array_column($this->orders_ids, 'id'))->get();

    }
    public function getCustomerIdsAttribute($value)
    {
        $customers = [];
        if(!empty($value) && $value != "null"){
            foreach(array_values(json_decode($value, true)) as $key => $customer){
                // dd(CustomerOrder::find([ 'id' => $order['customers_id']])->first()->toArray());
                try{
                    // dd($customer);

                        if($model = Customer::with('customersAddresses')->find([ 'id' => $customer])->first())
                            $customers[$key] = $model->toArray();

                }catch(\Exception $e){
                    return [];
                }
            }
        }
        // dd($orders);
        return $customers;
    }
    public function setCustomerIdsAttribute($value)
    {
        $this->attributes['customer_ids'] =$value? json_encode($value):null;
    }
    public function customers(){

        if(empty($this->customer_ids))
            return [];
            // foreach()
        Log::info(json_encode($this->customer_ids));
        return [];//Customer::whereIn('id',$this->customer_ids)->get();

    }
    public function setTripDeliveryDateAttribute($value)
    {
        $this->attributes['trip_delivery_date'] = date('Y-m-d', strtotime($value));
    }
   
}
