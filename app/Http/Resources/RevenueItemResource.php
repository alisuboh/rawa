<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevenueItemResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "rev_cat_id" => $this->rev_cat_id,
            "description" => $this->description,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "provider_id" => $this->provider_id,

        ];
    }
}
