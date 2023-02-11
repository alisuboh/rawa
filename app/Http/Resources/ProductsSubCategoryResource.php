<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsSubCategoryResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "category_id" => $this->category_id,
            "created_at" => $this->created_at,
            "description" => $this->description,
            "is_active" => $this->is_active,
            "sub_category_id" => $this->sub_category_id,
            "sub_category_name" => $this->sub_category_name,
            "updated_at" => $this->updated_at,

        ];
    }
}
