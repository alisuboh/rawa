<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripsScheduledRequest;
use App\Http\Resources\TripsScheduledResource;
use App\Models\TripsScheduled;

class TripsScheduledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return TripsScheduledResource::collection(TripsScheduled::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(TripsScheduledRequest $request)
    {
        return new TripsScheduledResource(TripsScheduled::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\TripsScheduled $tripsScheduled
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(TripsScheduled $tripsScheduled)
    {
        return new TripsScheduledResource($tripsScheduled);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\TripsScheduled $tripsScheduled
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(TripsScheduledRequest $request, TripsScheduled $tripsScheduled)
    {
        $tripsScheduled->update($request->validated());
        return new TripsScheduledResource($tripsScheduled);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\TripsScheduled $tripsScheduled
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripsScheduled $tripsScheduled)
    {
        $tripsScheduled->delete();
    }
}
