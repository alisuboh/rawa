<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RevenueItemRequest extends MainRequest
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
            'rev_cat_id' => "required", "integer",
            'description' => "sometimes", "max:65535",
            'is_active' => "sometimes", "boolean",
            'transaction_date' => "sometimes", "string", "max:50",
            'code' => "sometimes", "string", "max:50",
            'total_price' => "sometimes",'numeric',
            'bond_no' => "sometimes", "string", "max:50",
            // 'provider_id' => "required", "integer",

        ];
    }
}
