<?php

namespace App\Relation;


Trait ProductRelation
{
    

     public function providerProducts()
     {
         return $this->hasMany(\App\Models\ProviderProduct::class, 'provider_product_id');
     }
     public function product()
     {
           return $this->belongsTo(\App\Models\Product::class, 'product_id');
     }
     public function productsCategory()
     {
           return $this->belongsTo(\App\Models\ProductsCategory::class, 'category_id');
     }

}