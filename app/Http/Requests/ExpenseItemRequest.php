<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ExpenseItemRequest extends MainRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->checkRequest();
    }

    protected function rulesArray(): array
    {
        return [
            'exp_cat_id' => "sometimes", "integer",
            'description' => "sometimes", "max:65535",
            'is_active' => "sometimes", "boolean",
            // 'provider_id' => "required", "integer",
            'transaction_date' => "sometimes", "string", "max:50",
            'code' => "sometimes", "string", "max:50",
            'total_price' => "sometimes",'numeric',
            'bond_no' => "sometimes", "string", "max:50",
            'beneficiary_id' => "sometimes", "integer",
            'beneficiary_name'=> "sometimes", "string", "max:50",
            'beneficiary_type'=> "sometimes", "integer",
            'beneficiary_mobile'=> "sometimes", "string", "max:50",
        ];
    }
}
