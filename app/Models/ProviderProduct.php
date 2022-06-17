<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $provider_product_id
 * @property string $provider_product_name
 * @property integer $provider_id
 * @property integer $product_id
 * @property float $price
 * @property boolean $is_active
 * @property float $discount
 * @property string $measurement
 * @property string $icon_path
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 * @property Provider $provider
 */
class ProviderProduct extends Model
{
    use HasFactory;

    const ACTIVE = [
        1 => 'Active',
        0 => 'In Active',
    
    ];

    const MEASUREMENT = [
        'bottle',
        'glass',
        'ml',
        'liter',
        'flask',  
    ];
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'provider_product_id';

    /**
     * @var array
     */
    protected $fillable = ['provider_id','provider_product_name', 'product_id', 'price', 'is_active', 'discount','measurement','icon_path', 'created_at', 'updated_at'];

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
