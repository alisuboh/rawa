<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "user_name" => $this->user_name,
            "mobile_number" => $this->mobile_number,
            "phone" => $this->mobile_number,
            "email" => $this->email,
            "password" => $this->password,
            "has_branches" => $this->has_branches,
            "default_provider_id" => $this->default_provider_id,
            "can_recive_any_time" => $this->can_recive_any_time,
            "on_days" => $this->on_days,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "location_lat" => $this->location_lat,
            "location_lng" => $this->location_lng,
            "address_description" => $this->address_description,

        ];
    }
}
