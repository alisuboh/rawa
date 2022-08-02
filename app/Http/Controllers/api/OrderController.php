<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\CustomersAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function getAddressByUser($customer_id){

        return CustomersAddress::where('custmoer_id',$customer_id)->get()->pluck('address_name', 'id');

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $order = CustomerOrder::findOrFail($id);
        $validator = Validator::make($input, [
            'status' => 'nullable',
            "note"   => "nullable",
            "driver_id" => "nullable"
          
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (!empty($input['order_delivery_date']))
            $order->order_delivery_date = $input['order_delivery_date'];

        if (!empty($input['note']))
            $order->note = $input['note'];
            
        if (!empty($input['driver_id']))
            $order->provider_employee_id = $input['driver_id'];

        $order->save();
        return response()->json([
            "success" => true,
            "message" => "Order updated successfully.",
            "data" => $order
        ]);
    }

}
