<?php

namespace App\Relation;


Trait ProductsCategoryRelation
{
    
     public function products()
     {
         return $this->hasMany(\App\Models\Product::class, 'category_id');
     }
}
