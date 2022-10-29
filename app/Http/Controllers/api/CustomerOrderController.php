<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerOrderRequest;
use App\Http\Resources\CustomerOrderResource;
use App\Http\Resources\OrderResource;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\Log;
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
        $perPage = request()->get('perPage');
        $driver_id = auth()->user()->driver_id??request()->driver_id;
        if($driver_id){
            $order = QueryBuilder::for(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id)->where('provider_employee_id', '=', $driver_id)->where('type',2))
            ->allowedFilters(['phone_number','full_name'])
            ->orderBy('created_at','desc')
            ->paginate(); 
            // return CustomerOrderResource::collection(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id)->where('provider_employee_id', '=', $driver_id)->paginate($perPage));

        }else{
            $trip_id = request()->get('trip_id');
            if($trip_id === '0'){
                $order = QueryBuilder::for(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id)->where('type',2)->whereNull('trip_id'))
                ->allowedFilters(['phone_number','full_name'])
                ->orderBy('created_at','desc')
                ->paginate($perPage); 
    
            }else{
                $order = QueryBuilder::for(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id)->where('type',2))
                ->allowedFilters(['phone_number','full_name'])
                ->orderBy('created_at','desc')
                ->paginate($perPage); 
    
            }
            
        }

 

        return OrderResource::collection($order);
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
                    "data" => new CustomerOrderResource($order)
                ];
            else
                return [
                    "success" => false,
                    "message" => "Order not added!",
                    "data" => null
                ];
        }
             
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CustomerOrder $customerOrder
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
     * @param \App\Models\CustomerOrder $customerOrder
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(CustomerOrderRequest $request, CustomerOrder $customerOrder)
    {

        $customerOrder->update($request->validated());
        $input = $request->all();
        Log::alert("request for update order: ".json_encode($input));

        // if(!empty[$input['update']])
        return new CustomerOrderResource($customerOrder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CustomerOrder $customerOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerOrder $customerOrder)
    {
        $customerOrder->delete();
    }
}
