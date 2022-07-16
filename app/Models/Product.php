<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $product_id
 * @property integer $category_id
 * @property string $product_code
 * @property string $product_name
 * @property string $product_description
 * @property integer $size
 * @property string $icon_path
 * @property string $picture
 * @property string $created_at
 * @property string $updated_at
 * @property ProductsCategory $productsCategory
 * @property ProviderProduct[] $providerProducts
 */
class Product extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'product_code', 'product_name', 'product_description', 'size', 'icon_path', 'picture', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productsCategory()
    {
        return $this->belongsTo('App\Models\ProductsCategory', 'category_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providerProducts()
    {
        return $this->hasMany('App\Models\ProviderProduct', null, 'product_id');
    }
}
