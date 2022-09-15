<?php

namespace App\Http\Resources;

use App\Models\RevenueCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class RevenueParantResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "category" => RevenueCategoryResource::collection($this->revenueCategory),
            "created_by" => $this->created_by,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
