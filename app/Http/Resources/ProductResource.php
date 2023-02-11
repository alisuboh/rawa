<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "product_id" => $this->product_id,
            "product_name" => $this->product_name,
            "product_description" => $this->product_description,
            "icon_path" => $this->icon_path,

            "category_id" => $this->category_id,
            // "created_at" => $this->created_at,
            // "picture" => $this->picture,
            "product_code" => $this->product_code,

            "size" => $this->size,
            // "updated_at" => $this->updated_at,
            // "providerProducts" => $this->providerProducts,
            // "productsCategory" => $this->productsCategory,

        ];
    }
}
