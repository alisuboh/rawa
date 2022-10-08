<?php

namespace App\Http\Resources;

use App\Models\ProvidersEmployee;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TripCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "success" => true,
            "message" => "Trip List",
            "data" => [
                'trips' => parent::toArray($request),
                'drivers' => DriverResource::collection(ProvidersEmployee::where('provider_id', '=', auth()->user()->provider_id)->where('type', '=', 1)->where('status','=','1')->get())
            ]
            ];
        // return parent::toArray($request);
    }
}
