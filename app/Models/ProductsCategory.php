<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $category_id
 * @property string $category_name
 * @property integer $category_type
 * @property string $description
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property Product[] $products
 * @property ProductsSubCategory[] $productsSubCategories
 */
class ProductsCategory extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'category_id';

    /**
     * @var array
     */
    protected $fillable = ['category_name', 'category_type', 'description', 'is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productsSubCategories()
    {
        return $this->hasMany('App\Models\ProductsSubCategory', 'category_id', 'category_id');
    }
}
