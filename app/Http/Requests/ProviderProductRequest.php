<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProviderProductRequest extends MainRequest
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
            'provider_product_id' => "required", "integer",
            'provider_id' => "required", "integer",
            'product_id' => "required", "integer",
            'provider_product_name' => "required", "string", "max:200",
            'price' => "required",
            'measurement' => "sometimes", "string", "max:45",
            'is_active' => "sometimes", "boolean",
            'discount' => "sometimes",
            'icon_path' => "sometimes", "string", "max:1000",

        ];
    }
}
