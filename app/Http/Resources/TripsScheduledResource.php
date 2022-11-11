<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripsScheduledResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "provider_id" => $this->provider_id,
            "orders_ids" => $this->orders_ids,
            "customer_id" => $this->customer_id,
            "driver_id" => $this->driver_id,
            "delivery_date" => $this->delivery_date,
            "days" => $this->days,
            "status" => $this->status,
            "note" => $this->note,
            "app_source" => $this->app_source,
            "areas" => $this->getArea(),
            "city_id"=>$this->city_id,
            "city"=>$this->city->name??'',
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,

        ];
    }
}
