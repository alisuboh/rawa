<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsCategoryResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "category_id" => $this->category_id,
            "category_name" => $this->category_name,
            "category_type" => $this->category_type,
            "created_at" => $this->created_at,
            "description" => $this->description,
            "is_active" => $this->is_active,
            "updated_at" => $this->updated_at,
            "products" => $this->products,

        ];
    }
}
