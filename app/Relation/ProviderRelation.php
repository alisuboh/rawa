<?php

namespace App\Relation;


Trait ProviderRelation
{
    
           public function providers()
           {
              return $this->belongsToMany(\App\Models\Provider::class);
           }
}
