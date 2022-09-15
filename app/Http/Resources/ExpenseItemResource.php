<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseItemResource extends MainResource
{
    public function combinedAttrs()
    {
        return [
            "id" => $this->id,
            "exp_cat_id" => $this->exp_cat_id,
            "description" => $this->description,
            "is_active" => $this->is_active,
            "provider_id" => $this->provider_id,
            'transaction_date' => $this->transaction_date,
            'code' => $this->code,
            'total_price' => $this->total_price,
            'bond_no' => $this->bond_no,
            "created_at" => $this->created_at

        ];
    }
}
