<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevenueItemResource extends MainResource
{
    public function combinedAttrs()
    {
        if(strpos(request()->path(),'revenue/')){
            return [
                'transaction_date' => $this->transaction_date??$this->created_at,
                "revenue_parant" => $this->revenueCategory->revenueParant->id??'',
                "revenue_category" => $this->revenueCategory->id??'',
                'total_price' => $this->total_price??'',
                "description" => $this->description??'',
                //customer
                //customer name
                'bond_no' => $this->bond_no??'',                
                "id" => $this->id
        ];
        }
        return [
                'transaction_date' => $this->transaction_date??$this->created_at,
                "revenue_parant" => $this->revenueCategory->revenueParant->name??"لا يوجد",
                "revenue_category" => $this->revenueCategory->description??"لا يوجد",
                'total_price' => $this->total_price??"لا يوجد",
                // "description" => $this->description,
                //customer
                //customer name
                'bond_no' => $this->bond_no??"لا يوجد",               
                "id" => $this->id
        ];
    }
}
