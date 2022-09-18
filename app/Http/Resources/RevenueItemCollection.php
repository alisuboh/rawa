<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RevenueItemCollection extends ResourceCollection
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
                'التاريخ',
                'فئة الايراد',
                'نوع الايراد',
                'القيمة',
                // 'نوع العميل',
                // 'العميل',
                'رقم السند',
            ],
            "rows" => [
                parent::toArray($request)         
            ],
            "id" => $request->id,
        ];

        return parent::toArray($request);
    }
}
