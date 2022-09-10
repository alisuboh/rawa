<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CustomerRequest extends MainRequest
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
            'name' => "required", "string", "max:100",
            'user_name' => "required", "max:65535",
            'mobile_number' => "required", "string", "max:50",
            'email' => "sometimes", "string", "max:200",
            'password' => "required", "string", "max:255",
            'has_branches' => "sometimes", "boolean",
            'default_provider_id' => "sometimes", "integer",
            'can_recive_any_time' => "sometimes", "boolean",
            'on_days' => "sometimes", "string",

        ];
    }
}
