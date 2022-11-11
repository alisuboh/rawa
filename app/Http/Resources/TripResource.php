<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "trip_name" => $this->trip_name,
            "orders_ids" => $this->orders_ids,
            "customer_ids" => $this->customer_ids,
            "provider_id" => $this->provider_id,
            "driver_id" => $this->driver_id,
            "driver_name" => $this->driver_name,
            "driver_phone" => $this->driver_phone,
            "status" => $this->status,
            "total_price" => $this->total_price,
            "trip_delivery_date" => $this->trip_delivery_date,
            "app_source" => $this->app_source,
            "note" => $this->note,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];

        
        return parent::toArray($request);
    }
}
