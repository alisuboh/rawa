<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $provider_id
 * @property string $subscription_start_date
 * @property string $subscription_end_date
 * @property string $record_insert_date
 * @property integer $recored_insert_by
 * @property integer $subscription_type
 * @property string $notes
 * @property boolean $is_free
 * @property integer $package_price
 * @property integer $discount_price
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property Provider $provider
 */
class ProvidersSubscription extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['provider_id', 'subscription_start_date', 'subscription_end_date', 'record_insert_date', 'recored_insert_by', 'subscription_type', 'notes', 'is_free', 'package_price', 'discount_price', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
}
