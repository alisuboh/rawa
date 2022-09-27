<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RevenueItemRequest;
use App\Http\Resources\RevenueItemCollection;
use App\Http\Resources\RevenueItemResource;
use App\Models\RevenueItem;
use Spatie\QueryBuilder\AllowedFilter;
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
            ->allowedFilters([
                'description',
                'created_at',
                AllowedFilter::scope('created'),
                ])
            ->allowedSorts('transaction_date','created_at','total_price')
            ->paginate(); 
            
        return new RevenueItemCollection($revenueItem);
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(RevenueItemRequest $request)
    {
        if($request->validated()){
            if($revenue = RevenueItem::create(array_merge($request->all())))
                return [
                    "success" => true,
                    "message" => "Revenue added successfully!",
                    "data" => new RevenueItemResource($revenue)
                ];
            else
                return [
                    "success" => false,
                    "message" => "Revenue not added!",
                    "data" => null
                ];
        }


        // return new RevenueItemResource(RevenueItem::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\RevenueItem $revenueItem
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($revenueItem_id)
    {
        return new RevenueItemResource(RevenueItem::find($revenueItem_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RevenueItem $revenueItem
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(RevenueItemRequest $request, $revenueItem_id)
    {
        $revenueItem = RevenueItem::find($revenueItem_id);
        $revenueItem->update($request->validated());
        return new RevenueItemResource($revenueItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RevenueItem $revenueItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($revenueItem_id)
    {
        $revenueItem = RevenueItem::find($revenueItem_id);

        $revenueItem->delete();
    }
}
