<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvidersEmployeeResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            // "provider_id" => $this->provider_id,
            "seq" => $this->seq,
            "full_name" => $this->full_name,
            "name" => $this->full_name,
            "phone_number" => $this->phone_number,
            "phone" => $this->phone_number??$this->mobile_number,
            "mobile_number" => $this->mobile_number,
            "status" => $this->status,
            "type" => $this->type,
            "password" => $this->password,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
