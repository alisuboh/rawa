<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CustomerOrderRequest extends MainRequest
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
            'type' => "required", "integer",
            'customer_id' => 'required_if:type,2|integer',
            'payment_type' => 'required_if:type,2|integer',
            // 'provider_id' => "required", "integer",
            'order_products' => "sometimes",
            'full_name' => "sometimes", "string", "max:100",
            'phone_number' => "sometimes|numeric|min:10",
            'customer_address_id' => "sometimes", "integer",
            'total_price' => "sometimes",
            'order_delivery_date' => "sometimes", "date_format:Y-m-d H:i:s",
            'status' => "sometimes", "in:0,1,2,3",
            'app_source' => "sometimes", "integer",
            'note' => "sometimes", "string", "max:1000",
            'reason_note' => "sometimes", "string", "max:1000",
            'vat' => "sometimes",
            'price_discount' => "sometimes",
            'shipping_fees' => "sometimes",
            'provider_employee_id' => "sometimes", "integer",
            'price' => "sometimes",
            'days' => "sometimes",
            'from' => "sometimes",
            'to' => "sometimes",
            'scheduled' => "sometimes",

        ];
    }

     /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment_type.required_if' => 'payment_type is required when type 2',
            'customer_id.required_if' => 'customer_id is required when type 2',
            'type.required' => 'type is required',

        ];
    }
}
