<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebPermissionResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "name" => $this->name,
            "route" => $this->route,
            "role_id" => $this->role_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
