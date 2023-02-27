<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ProviderProductResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->provider_product_id,
            "name" => $this->provider_product_name,
            "price" => $this->price,
            "img" => App::make('url')->to(Storage::url($this->icon_path)),
            "product_id" => $this->product_id,
            "discount" => $this->discount,
            "measurement" => $this->measurement,
            "is_active" => $this->is_active,
            "created_at" => $this->created_at,

        ];
    }
}
