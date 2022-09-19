<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PurchaseRequest extends MainRequest
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
            'invoice_number' => "required", "string", "max:255",
            'invoice_date' => "required", "date",
            // 'provider_id' => "required", "integer",
            'supplier_id' => "sometimes", "integer",
            'price' => "sometimes",'numeric',
            'tax' => "sometimes",'numeric',
            'discount' => "sometimes",'numeric',
            'total_price' => "required",

        ];
    }
}
