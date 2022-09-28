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
                "invoice_date" => date('Y-m-d H:i:s', strtotime($this->invoice_date)),
                "provider_id" => $this->provider_id,
                "supplier_id" => $this->supplier_id,
                "supplier_name" => $this->supplier?$this->supplier->name:'',
                "price" => $this->price,
                "tax" => $this->tax,
                "discount" => $this->discount,
                "total_price" => $this->total_price,
                "purchase_details" => PurchasesDetailResource::collection($this->purchasesDetail),
            ];
        }
        return [
            "invoice_number" => $this->invoice_number?? "لا يوجد",
            "invoice_date" => date('Y-m-d H:i:s', strtotime($this->invoice_date)),
            "supplier_id" => $this->supplier?$this->supplier->name: "لا يوجد",
            "total_price" => $this->total_price?? "لا يوجد",
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
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
