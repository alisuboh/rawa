<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RevenueItemRequest;
use App\Http\Resources\RevenueItemResource;
use App\Models\RevenueItem;
use Spatie\QueryBuilder\QueryBuilder;

class RevenueItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $revenueItem = QueryBuilder::for(RevenueItem::where('provider_id', '=', auth()->user()->provider_id))
            ->defaultSort('-created_at')        
            ->allowedFilters(['description','created_at'])
            ->allowedSorts('created_at')
            ->paginate(); 
        return RevenueItemResource::collection($revenueItem);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(RevenueItemRequest $request)
    {
        return new RevenueItemResource(RevenueItem::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\RevenueItem $revenueItem
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(RevenueItem $revenueItem)
    {
        return new RevenueItemResource($revenueItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\RevenueItem $revenueItem
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(RevenueItemRequest $request, RevenueItem $revenueItem)
    {
        $revenueItem->update($request->validated());
        return new RevenueItemResource($revenueItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\RevenueItem $revenueItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevenueItem $revenueItem)
    {
        $revenueItem->delete();
    }
}
