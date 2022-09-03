<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseParantResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "created_by" => $this->created_by,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
