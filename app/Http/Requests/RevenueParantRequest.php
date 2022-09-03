<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class RevenueParantRequest extends MainRequest
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
            'name' => "required", "string", "max:255",
            // 'created_by' => "required", "integer",

        ];
    }
}
