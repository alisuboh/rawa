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
            'rev_cat_id' => "sometimes", "integer",
            'description' => "required", "max:65535",
            'is_active' => "sometimes", "boolean",
            // 'provider_id' => "required", "integer",

        ];
    }
}
