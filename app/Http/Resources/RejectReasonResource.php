<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RejectReasonResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "reason" => $this->reason,
            "active" => $this->active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
