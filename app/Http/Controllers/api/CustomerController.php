<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return CustomerResource::collection(Customer::where('default_provider_id', '=', auth()->user()->provider_id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(CustomerRequest $request)
    {
        if($request->validated()){
            if($order = Customer::create($request->all()))
                return [
                    "success" => true,
                    "message" => "Customer added successfully!",
                    "order" => new CustomerResource($order)
                ];
            else
                return [
                    "success" => false,
                    "message" => "Customer not added!",
                    "order" => null
                ];
        }


        return new CustomerResource(Customer::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\Customer $customer
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\Customer $customer
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
    }
}
