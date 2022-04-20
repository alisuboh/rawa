<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $sub_category_id
 * @property integer $category_id
 * @property string $sub_category_name
 * @property string $description
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property ProductsCategory $productsCategory
 */
class ProductsSubCategory extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'sub_category_id';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'sub_category_name', 'description', 'is_active', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productsCategory()
    {
        return $this->belongsTo('App\Models\ProductsCategory', 'category_id', 'category_id');
    }
}
