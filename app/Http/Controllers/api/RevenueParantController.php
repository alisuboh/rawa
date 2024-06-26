<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RevenueParantRequest;
use App\Http\Resources\RevenueParantResource;
use App\Models\RevenueParant;

class RevenueParantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $perPage = request()->get('perPage');
        return RevenueParantResource::collection(RevenueParant::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(RevenueParantRequest $request)
    {
        return new RevenueParantResource(RevenueParant::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\RevenueParant $revenueParant
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(RevenueParant $revenueParant)
    {
        return new RevenueParantResource($revenueParant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RevenueParant $revenueParant
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(RevenueParantRequest $request, RevenueParant $revenueParant)
    {
        $revenueParant->update($request->validated());
        return new RevenueParantResource($revenueParant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RevenueParant $revenueParant
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevenueParant $revenueParant)
    {
        $revenueParant->delete();
    }
}
