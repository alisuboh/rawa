<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class WebPermissionRequest extends MainRequest
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
            'slug' => "required", "string", "max:255",
            'name' => "required", "string", "max:255",
            'route' => "sometimes", "string", "max:255",
            'role_id' => "sometimes",

        ];
    }
}
