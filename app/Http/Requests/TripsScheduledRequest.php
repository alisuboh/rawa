<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TripsScheduledRequest extends MainRequest
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
            'provider_id' => "required", "integer",
            'orders_ids' => "sometimes",
            'customer_id' => "sometimes", "integer",
            'driver_id' => "sometimes", "integer",
            'delivery_date' => "sometimes", "date",
            'days' => "sometimes",
            'status' => "sometimes", "integer",
            'note' => "sometimes", "string", "max:255",
            'app_source' => "sometimes", "integer",
            'area_ids' => "sometimes",
            'city_id' => "sometimes", "integer",

        ];
    }
}
