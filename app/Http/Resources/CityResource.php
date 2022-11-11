<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "active" => $this->active,
            "order" => $this->order,
            "code" => $this->code,
            "areas" => $this->area,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
