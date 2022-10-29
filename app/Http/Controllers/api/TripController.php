<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Http\Resources\TripCollection;
use App\Http\Resources\TripResource;
use App\Models\ProvidersEmployee;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver_id = auth()->user()->driver_id??request()->driver_id;
        $perPage = request()->get('perPage');
        if($driver_id){
            $listOfTrip = Trip::where('provider_id', '=', auth()->user()->provider_id)->where('driver_id', '=', $driver_id)->whereIn('status',  [1,2])->orderBy('created_at','desc')->paginate($perPage);
        }else{
            $listOfTrip = Trip::where('provider_id', '=', auth()->user()->provider_id)->orderBy('created_at','desc')->paginate($perPage);
        }
        return new TripCollection($listOfTrip);
        // return response()->json([
        //     "success" => true,
        //     "message" => "Trip List",
        //     "data" => [
        //         'trips' => new TripCollection($listOfTrip),
        //         'drivers' => DriverResource::collection(ProvidersEmployee::where('provider_id', '=', auth()->user()->provider_id)->where('type', '=', 1)->get())
        //     ]
        // ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'trip_name' => 'required',
            "orders_ids"    => "required|array",
            'orders_ids.*.orders_id' => 'required|numeric|distinct|exists:customer_orders,id',
            'driver_id' => 'nullable|numeric|exists:providers_employees,id',
            'status' => 'nullable',
            'note' => 'nullable',
            'trip_delivery_date'=> 'nullable'


        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input["provider_id"] = auth()->user()->provider_id;
        if (!empty($input['driver_id'])) {
            $driver = ProvidersEmployee::find($input['driver_id']);
            $input['driver_id'] = $driver->id;
            $input['driver_name'] = $driver->full_name;
            $input['driver_phone'] = $driver->phone_number ?? $driver->mobile_number;
            if(empty($input['status']))
                $input["status"] = '1';
        }
        $trip = Trip::create($input);
        return response()->json([
            "success" => true,
            "message" => "Trip created successfully.",
            "data" => $trip
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::find($id);
        if (is_null($trip)) {
            return $this->sendError('Product not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Trip retrieved successfully.",
            "data" => new TripResource($trip)
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        $input = $request->all();
        Log::alert("request for update: ".json_encode($input));
        $validator = Validator::make($input, [
            'trip_name' => 'nullable',
            "orders_ids"    => "nullable|array",
            'orders_ids.*.orders_id' => 'required|numeric|distinct|exists:customer_orders,id',
            'driver_id' => 'nullable|numeric|exists:providers_employees,id',
            'status' => 'nullable',
            'note' => 'nullable'

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if (!empty($input['trip_name']))
            $trip->trip_name = $input['trip_name'];

        if (!empty($input['orders_ids']))
            $trip->orders_ids = $input['orders_ids'];

        if (!empty($input['trip_delivery_date']))
            $trip->trip_delivery_date = $input['trip_delivery_date'];
        if (!empty($input['status']))
            $trip->status = $input['status'];
        if (!empty($input['note']))
            $trip->note = $input['note'];
        if (!empty($input['driver_id'])) {
            $driver = ProvidersEmployee::find($input['driver_id']);
            $trip->driver_id = $driver->id;
            $trip->driver_name = $driver->full_name;
            $trip->driver_phone = $driver->phone_number ?? $driver->mobile_number;
        }

        $trip->save();
        return response()->json([
            "success" => true,
            "message" => "Trip updated successfully.",
            "data" => $trip
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return response()->json([
            "success" => true,
            "message" => "Trip deleted successfully.",
            "data" => $trip
        ]);
    }
    
}
