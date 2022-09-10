<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "customer_id" => $this->customer_id,
            "provider_id" => $this->provider_id,
            "order_products" => $this->order_products,
            "full_name" => $this->full_name,
            "phone_number" => $this->phone_number,
            "customer_address_id" => $this->customer_address_id,
            "total_price" => $this->total_price,
            "order_delivery_date" => $this->order_delivery_date,
            "status" => $this->status,
            "app_source" => $this->app_source,
            "note" => $this->note,
            "reason_note" => $this->reason_note,
            "vat" => $this->vat,
            "price_discount" => $this->price_discount,
            "shipping_fees" => $this->shipping_fees,
            "provider_employee_id" => $this->provider_employee_id,
            "price" => $this->price,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "type" => $this->type,

        ];
    }
}
