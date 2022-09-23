<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phone" => $this->phone,
            "address" => $this->address,
            "description" => $this->description,
            "type" => $this->type,
            // 'provider_id' => $this->provider_id,
            'is_active' => $this->is_active,
            "created_at" => $this->created_at,
            // "updated_at" => $this->updated_at,

        ];
    }
}
