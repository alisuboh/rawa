<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseCollection extends ResourceCollection
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

            "keys" => [
                'رقم الفاتورة' ,
                'التاريخ',
                'المورد',
                'المجموع',
                'تاريخ الانشاء',
            ],
            "rows" => [
                parent::toArray($request)
            ]
        ];


    }
}
