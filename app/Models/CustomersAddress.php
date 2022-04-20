<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property float $location_lat
 * @property float $location_lng
 * @property boolean $is_default
 * @property string $address_name
 * @property string $address_description
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 */
class CustomersAddress extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'location_lat', 'location_lng', 'is_default', 'address_name', 'address_description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
