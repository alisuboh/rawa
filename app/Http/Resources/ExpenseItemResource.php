<?php

namespace App\Http\Resources;

use App\Constants\TransCode;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseItemResource extends MainResource
{
    public function combinedAttrs()
    {
        if (strpos(request()->path(), 'expense/')) {
            return [
                "expense_parant" => $this->expenseCategory->expenseParant->id ?? '',
                "expense_category" => $this->expenseCategory->id ?? '',
                'transaction_date' => date('Y-m-d H:i:s', strtotime($this->invoice_date)),
                'total_price' => $this->total_price ?? '',
                'bond_no' => $this->bond_no ?? '',
                'beneficiary_id' => $this->beneficiary_id ?? '',
                'beneficiary_name' => $this->beneficiary_name ?? '',
                'beneficiary_type' => $this->beneficiary_type ?? '',
                'beneficiary_mobile' => $this->beneficiary_mobile ?? '',
                "expense_parant" => $this->expenseCategory->expenseParant->id ?? '',
                "description" => $this->description ?? '',
                "id" => $this->id
            ];
        }
        return [
            "expense_parant" => $this->expenseCategory->expenseParant->name ?? "لا يوجد",
            "expense_category" => $this->expenseCategory->description ?? "لا يوجد",
            'transaction_date' => date('Y-m-d H:i:s', strtotime($this->invoice_date)),
            'total_price' => $this->total_price ?? "لا يوجد",
            'bond_no' => $this->bond_no ?? "لا يوجد",
            'beneficiary_type' => $this->beneficiary_type ? TransCode::BENEFICIARY_AR[$this->beneficiary_type] : "لا يوجد",
            'beneficiary_name' => $this->beneficiary_name ?? "لا يوجد",
            'beneficiary_mobile' => $this->beneficiary_mobile ?? "لا يوجد",
            "id" => $this->id

        ];
    }
}
