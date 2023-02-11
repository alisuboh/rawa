<?php

namespace App\Relation;


Trait ProductsSubCategoryRelation
{
    
     public function productsCategory()
     {
           return $this->belongsTo(\App\Models\ProductsCategory::class, 'category_id');
     }
}
