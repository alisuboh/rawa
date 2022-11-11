<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return AreaResource::collection(Area::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(AreaRequest $request)
    {
        return new AreaResource(Area::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\Area $area
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Area $area)
    {
        return new AreaResource($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\Area $area
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->validated());
        return new AreaResource($area);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $area->delete();
    }
}
