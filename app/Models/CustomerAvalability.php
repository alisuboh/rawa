<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $customer_id
 * @property integer $seq
 * @property string $day
 * @property string $from_time
 * @property string $to_time
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 */
class CustomerAvalability extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'seq', 'day', 'from_time', 'to_time', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
