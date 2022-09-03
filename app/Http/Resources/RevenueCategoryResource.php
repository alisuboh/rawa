<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevenueCategoryResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "parant_id" => $this->parant_id,
            "description" => $this->description,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
