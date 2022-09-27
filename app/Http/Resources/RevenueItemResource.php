<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevenueItemResource extends MainResource
{
    public function combinedAttrs()
    {
        if(strpos(request()->path(),'revenue/')){
            return [
                'transaction_date' => date('Y-m-d H:i:s', strtotime($this->invoice_date)),
                "revenue_parant" => $this->revenueCategory->revenueParant->id??'',
                "revenue_category" => $this->revenueCategory->id??'',
                'total_price' => $this->total_price??'',
                "description" => $this->description??'',
                'customer_id' => $this->customer_id,
                'customer_name' => $this->customer?$this->customer->name:'',
                'bond_no' => $this->bond_no??'',                
                "id" => $this->id
        ];
        }
        return [
                'transaction_date' => date('Y-m-d H:i:s', strtotime($this->invoice_date)),
                "revenue_parant" => $this->revenueCategory->revenueParant->name??"لا يوجد",
                "revenue_category" => $this->revenueCategory->description??"لا يوجد",
                'total_price' => $this->total_price??"لا يوجد",
                'customer_name' => $this->customer?$this->customer->name:'لا يوجد',
                'bond_no' => $this->bond_no??"لا يوجد",   
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),            
                "id" => $this->id
        ];
    }
}
