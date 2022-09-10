<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderProductResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "provider_product_id" => $this->provider_product_id,
            "provider_id" => $this->provider_id,
            "product_id" => $this->product_id,
            "provider_product_name" => $this->provider_product_name,
            "price" => $this->price,
            "measurement" => $this->measurement,
            "is_active" => $this->is_active,
            "discount" => $this->discount,
            "icon_path" => $this->icon_path,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
