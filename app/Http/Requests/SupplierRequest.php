<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class SupplierRequest extends MainRequest
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
            'name' => "sometimes", "string", "max:255",
            'phone' => "sometimes", "integer",
            'address' => "sometimes", "string", "max:255",
            'description' => "sometimes", "string", "max:255",
            'type' => "sometimes", "integer",
            'is_active' => "sometimes", "integer",

        ];
    }
}
