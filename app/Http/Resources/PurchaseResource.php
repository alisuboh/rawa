<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends MainResource
{
    public function combinedAttrs()
    {

        if (strpos(request()->path(), 'purchase/')) {
            return [
                "id" => $this->id,
                "invoice_number" => $this->invoice_number,
                "invoice_date" => $this->invoice_date??$this->created_at,
                "provider_id" => $this->provider_id,
                "supplier_id" => $this->supplier_id,
                "price" => $this->price,
                "tax" => $this->tax,
                "discount" => $this->discount,
                "total_price" => $this->total_price,
                "purchase_details" => $this->purchasesDetail,
            ];
        }
        return [
            "invoice_number" => $this->invoice_number?? "لا يوجد",
            "invoice_date" => $this->invoice_date?? $this->created_at,
            "supplier_id" => $this->supplier->name?? "لا يوجد",
            "total_price" => $this->total_price?? "لا يوجد",
            "id" => $this->id,

        ];

        // return [
        //     "id" => $this->id,
        //     "invoice_number" => $this->invoice_number,
        //     "invoice_date" => $this->invoice_date,
        //     "provider_id" => $this->provider_id,
        //     "supplier_id" => $this->supplier_id,
        //     "price" => $this->price,
        //     "tax" => $this->tax,
        //     "discount" => $this->discount,
        //     "total_price" => $this->total_price,
        //     "purchase_details" => $this->purchasesDetail,
        //     "created_at" => $this->created_at,
        //     "updated_at" => $this->updated_at,

        // ];
    }
}
