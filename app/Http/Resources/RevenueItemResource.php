<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevenueItemResource extends MainResource
{
    public function combinedAttrs()
    {
        // dd(request()->path());
        if(strpos(request()->path(),'revenue/')){
            return [
                'transaction_date' => $this->transaction_date??$this->created_at,
                "revenue_parant" => $this->revenueCategory->revenueParant->id??null,
                "revenue_category" => $this->revenueCategory->id??null,
                'total_price' => $this->total_price,
                "description" => $this->description,
                //customer
                //customer name
                'bond_no' => $this->bond_no,                
                "id" => $this->id,
        ];
        }
        return [
                'transaction_date' => $this->transaction_date??$this->created_at,
                "revenue_parant" => $this->revenueCategory->revenueParant->name??"لا يوجد",
                "revenue_category" => $this->revenueCategory->description??"لا يوجد",
                'total_price' => $this->total_price,
                // "description" => $this->description,
                //customer
                //customer name
                'bond_no' => $this->bond_no,                
                "id" => $this->id,
        ];
    }
}
