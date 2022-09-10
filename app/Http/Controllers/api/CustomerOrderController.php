<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerOrderRequest;
use App\Http\Resources\CustomerOrderResource;
use App\Models\CustomerOrder;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
           
        $driver_id = auth()->user()->driver_id??request()->driver_id;
        if($driver_id){
            $order = QueryBuilder::for(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id)->where('provider_employee_id', '=', $driver_id))
            ->allowedFilters(['phone_number','full_name'])
            ->paginate(); 
            return CustomerOrderResource::collection(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id)->where('provider_employee_id', '=', $driver_id)->paginate());

        }

            $order = QueryBuilder::for(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id))
            ->allowedFilters(['phone_number','full_name'])
            ->paginate(); 


        return CustomerOrderResource::collection($order);
        // return CustomerOrderResource::collection(CustomerOrder::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(CustomerOrderRequest $request)
    {
        // dd(auth()->user()->provider_id);
        // $request->request->set('provider_id',auth()->user()->provider_id);
        // $request->request->add(['provider_id',auth()->user()->provider_id]);
        // $request->merge([
        //     'provider_id' => auth()->user()->provider_id,
        // ]);
        // dd(array_merge($request->all(), ['provider_id' => auth()->user()->provider_id]));
        if($request->validated()){
            if($order = CustomerOrder::create(array_merge($request->all(), ['provider_id' => auth()->user()->provider_id])))
                return [
                    "success" => true,
                    "message" => "Order added successfully!",
                    "order" => new CustomerOrderResource($order)
                ];
            else
                return [
                    "success" => false,
                    "message" => "Order not added!",
                    "order" => null
                ];
        }
             
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\CustomerOrder $customerOrder
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(CustomerOrder $customerOrder)
    {
        return new CustomerOrderResource($customerOrder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\CustomerOrder $customerOrder
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(CustomerOrderRequest $request, CustomerOrder $customerOrder)
    {
        $customerOrder->update($request->validated());
        return new CustomerOrderResource($customerOrder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\CustomerOrder $customerOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerOrder $customerOrder)
    {
        $customerOrder->delete();
    }
}
