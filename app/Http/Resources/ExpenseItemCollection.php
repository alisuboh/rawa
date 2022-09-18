<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseItemCollection extends ResourceCollection
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
                'نوع المصروف',
                'التاريخ',
                'القيمة',
                // 'نوع العميل',
                // 'العميل',
                'رقم السند',
                'نوع المستفيد',
                'المستفيد',
                'رقم جوال المستفيد',
            ],
            "rows" => [
                parent::toArray($request)
            ],
            "id" => $request->id,
        ];
    }
}
