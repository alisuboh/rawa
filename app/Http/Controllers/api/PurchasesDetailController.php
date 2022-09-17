<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchasesDetailRequest;
use App\Http\Resources\PurchasesDetailResource;
use App\Models\PurchasesDetail;
use Spatie\QueryBuilder\QueryBuilder;

class PurchasesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $purchaseDetail = QueryBuilder::for(PurchasesDetail::where('provider_id', '=', auth()->user()->provider_id))
        ->defaultSort('-created_at')
        ->allowedFilters([
            'description',
            'note',
            'created_at'
        ])
        ->allowedSorts([
            'total_price',
            'created_at'
        ])
        ->paginate(); 
        return PurchasesDetailResource::collection($purchaseDetail);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(PurchasesDetailRequest $request)
    {
        return new PurchasesDetailResource(PurchasesDetail::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PurchasesDetail $purchasesDetail
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(PurchasesDetail $purchasesDetail)
    {
        return new PurchasesDetailResource($purchasesDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PurchasesDetail $purchasesDetail
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(PurchasesDetailRequest $request, PurchasesDetail $purchasesDetail)
    {
        $purchasesDetail->update($request->validated());
        return new PurchasesDetailResource($purchasesDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PurchasesDetail $purchasesDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasesDetail $purchasesDetail)
    {
        $purchasesDetail->delete();
    }
}
