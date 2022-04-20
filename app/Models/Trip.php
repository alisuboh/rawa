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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
}
