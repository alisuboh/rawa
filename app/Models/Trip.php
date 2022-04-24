<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $provider_id
 * @property mixed $orders_ids
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
    /**
     * @var array
     */
    protected $fillable = ['provider_id', 'orders_ids', 'driver_id', 'driver_name', 'driver_phone', 'status', 'total_price', 'trip_delivery_date', 'app_source', 'note', 'created_at', 'updated_at'];

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
        // return array_values(json_decode($value, true) ?: []);
        $orders = [];
        foreach(array_values(json_decode($value, true)) as $key => $order){
            // dd($order);
            $orders[$key] = CustomerOrder::find([ 'id' => $order['orders_id']])->first()->toArray();
            // $pro = Product::find($order['product_id'])->toArray();
            // $orders[$key]['total'] =$order['qty']*$orders[$key]['price']; 
            // $orders[$key] = array_merge($orders[$key],$order);
            // $orders[$key] = array_merge($orders[$key],$pro);

        }
        // dd($orders);
        return $orders;
    }

    public function setOrdersIdsAttribute($value)
    {
        $this->attributes['orders_ids'] = json_encode(array_values($value));
    }

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function customerOrders()
    // {
    //     return $this->hasMany('App\Models\CustomerOrder', null, 'orders_ids.');
    //     return $this->hasManyThrough(
    //         CustomerOrder::class,
    //         Environment::class,
    //         'project_id', // Foreign key on the environments table...
    //         'environment_id', // Foreign key on the deployments table...
    //         'id', // Local key on the projects table...
    //         'id' // Local key on the environments table...
    //     );
    // }
}
