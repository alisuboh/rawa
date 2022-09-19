<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchasesDetailResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "description" => $this->description,
            "quantity" => $this->quantity,
            "unit_price" => $this->unit_price,
            "discount" => $this->discount,
            "total_price" => $this->total_price,
            "tax" => $this->tax,
            "id" => $this->id,
            // "purchas_id" => $this->purchas_id,


        ];
    }
}
