<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PurchasesDetailRequest extends MainRequest
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
            'purchas_id' => "required", "integer",
            'description' => "required", "string", "max:255",
            'unit_price' => "required",
            'quantity' => "required", "integer",
            'total_price' => "required",
            'tax' => "sometimes",'numeric',
            'discount' => "sometimes",'numeric',
            'note' => "sometimes", "string", "max:255",

        ];
    }
}
