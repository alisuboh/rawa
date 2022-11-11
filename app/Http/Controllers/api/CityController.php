<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return CityResource::collection(City::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(CityRequest $request)
    {
        return new CityResource(City::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\City $city
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\City $city
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        return new CityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
    }
}
