<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProductRequest extends MainRequest
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
            'product_id' => ["required", "integer"],
            'category_id' => ["required", "integer"],
            'product_code' => ["sometimes", "string", "max:45"],
            'product_name' => ["required", "string", "max:200"],
            'product_description' => ["required", "string", "max:65535"],
            'size' => ["sometimes", "integer"],
            'icon_path' => ["required", "string", "max:1000"],
            'picture' => ["sometimes", "string", "max:100"],

        ];
    }
}
