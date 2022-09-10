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
            "measurement" => $this->measurement,
            "discount" => $this->discount,
            "img" => App::make('url')->to(Storage::url($this->icon_path))
        ];
    }
}
