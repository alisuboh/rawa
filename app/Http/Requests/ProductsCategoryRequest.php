<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProductsCategoryRequest extends MainRequest
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
            'category_id' => ["required", "integer"],
            'category_name' => ["required", "string", "max:100"],
            'category_type' => ["required", "integer"],
            'description' => ["required", "string", "max:65535"],
            'is_active' => ["sometimes", "boolean"],

        ];
    }
}
