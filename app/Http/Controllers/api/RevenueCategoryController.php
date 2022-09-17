<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RevenueCategoryRequest;
use App\Http\Resources\RevenueCategoryResource;
use App\Models\RevenueCategory;

class RevenueCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return RevenueCategoryResource::collection(RevenueCategory::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(RevenueCategoryRequest $request)
    {
        return new RevenueCategoryResource(RevenueCategory::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\RevenueCategory $revenueCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(RevenueCategory $revenueCategory)
    {
        return new RevenueCategoryResource($revenueCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RevenueCategory $revenueCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(RevenueCategoryRequest $request, RevenueCategory $revenueCategory)
    {
        $revenueCategory->update($request->validated());
        return new RevenueCategoryResource($revenueCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RevenueCategory $revenueCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevenueCategory $revenueCategory)
    {
        $revenueCategory->delete();
    }
}
