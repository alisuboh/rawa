<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $rev_cat_id
 * @property integer $provider_id
 * @property string $description
 * @property boolean $is_active
 * @property double $total_price
 * @property string $bond_no
 * @property string $transaction_date
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property RevenueCategory $revenueCategory
 */
class RevenueItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['rev_cat_id', 'description','provider_id', 'is_active', 'transaction_date','code','total_price','bond_no', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revenueCategory()
    {
        return $this->belongsTo('App\Models\RevenueCategory', 'rev_cat_id');
    }

    public function setTransactionDateAttribute($value)
    {
        // dd(date('Y-m-d', $value));
        $this->attributes['transaction_date'] = date('Y-m-d', $value);
    }
    public function getTransactionDateAttribute($value)
    {
        // dd(date('Y-m-d', $value));
        $this->attributes['transaction_date'] = strtotime($value);
    }
}
