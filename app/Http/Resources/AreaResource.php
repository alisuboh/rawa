<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "active" => $this->active,
            "code" => $this->code,
            "order" => $this->order,
            "city_id" => $this->city_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
