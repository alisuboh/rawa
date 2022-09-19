<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "invoice_number" => $this->invoice_number,
            "invoice_date" => $this->invoice_date,
            "provider_id" => $this->provider_id,
            "supplier_id" => $this->supplier_id,
            "price" => $this->price,
            "tax" => $this->tax,
            "discount" => $this->discount,
            "total_price" => $this->total_price,
            "purchase_details" => $this->purchasesDetail,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
