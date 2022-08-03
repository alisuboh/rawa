<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $trip_name
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
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['trip_name','provider_id', 'orders_ids', 'driver_id', 'driver_name', 'driver_phone', 'status', 'total_price', 'trip_delivery_date', 'app_source', 'note', 'created_at', 'updated_at'];

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
        $orders = [];
        foreach(array_values(json_decode($value, true)) as $key => $order){
            // dd(CustomerOrder::find([ 'id' => $order['orders_id']])->first()->toArray());
            try{
                if($model = CustomerOrder::with('customer','address')->find([ 'id' => $order['orders_id']])->first())
                    $orders[$key] = $model->toArray();

            }catch(\Exception $e){
                return [];
            }
        }
        // dd($orders);

        return $orders;
    }

    public function setOrdersIdsAttribute($value)
    {
        $this->attributes['orders_ids'] = json_encode($value);
    }
    public function orders(){
        // dd(array_column($this->orders_ids, 'id'));
        return CustomerOrder::whereIn('id',array_column($this->orders_ids, 'id'))->get();

    }

   
}
