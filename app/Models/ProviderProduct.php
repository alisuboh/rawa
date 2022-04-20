<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $provider_products_id
 * @property integer $provider_id
 * @property integer $product_id
 * @property float $price
 * @property boolean $is_active
 * @property float $discount
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 * @property Provider $provider
 */
class ProviderProduct extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'provider_products_id';

    /**
     * @var array
     */
    protected $fillable = ['provider_id', 'product_id', 'price', 'is_active', 'discount', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', null, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }
}
