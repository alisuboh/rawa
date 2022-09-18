<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseItemResource extends MainResource
{
    public function combinedAttrs()
    {



        if(strpos(request()->path(),'expense/')){
            return [
                'transaction_date' => $this->transaction_date??$this->created_at,
                "expense_parant" => $this->expenseCategory->expenseParant->id??'',
                "expense_category" => $this->expenseCategory->id??'',
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
                "expense_parant" => $this->expenseCategory->expenseParant->name??"لا يوجد",
                "expense_category" => $this->expenseCategory->description??"لا يوجد",
                'total_price' => $this->total_price??"لا يوجد",
                // "description" => $this->description,
                //customer
                //customer name
                'bond_no' => $this->bond_no??"لا يوجد",               
                "id" => $this->id
        ];




    }
}
