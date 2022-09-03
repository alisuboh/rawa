<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchasesDetailResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "purchas_id" => $this->purchas_id,
            "description" => $this->description,
            "unit_price" => $this->unit_price,
            "quantity" => $this->quantity,
            "tax" => $this->tax,
            "discount" => $this->discount,
            "total_price" => $this->total_price,
            "note" => $this->note,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
