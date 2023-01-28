<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ProvidersEmployeeRequest extends MainRequest
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
            'provider_id' => "sometimes", "integer",
            'seq' => "sometimes", "integer",
            'full_name' => "sometimes", "string", "max:45","unique:providers_employees,full_name,".$this->full_name,
            'phone_number' => "sometimes", "string", "max:45",
            'mobile_number' => "sometimes", "string", "max:45",
            'status' => "sometimes", "boolean",
            'type' => "sometimes", "integer",
            'password' => "sometimes", "string", "max:255",

        ];
    }
}
