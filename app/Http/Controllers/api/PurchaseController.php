<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Spatie\QueryBuilder\QueryBuilder;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $purchase = QueryBuilder::for(Purchase::where('provider_id', '=', auth()->user()->provider_id))
            ->defaultSort('-created_at')
            ->allowedFilters([
                'invoice_number',
                'invoice_date',
                'supplier_id',
                'created_at'
            ])
            ->allowedSorts([
                'invoice_number',
                'invoice_date',
                'price',
                'total_price',
                'created_at'
            ])
            ->paginate(); 
        return PurchaseResource::collection($purchase);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(PurchaseRequest $request)
    {
        return new PurchaseResource(Purchase::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\Purchase $purchase
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Purchase $purchase)
    {
        return new PurchaseResource($purchase);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\Purchase $purchase
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $purchase->update($request->validated());
        return new PurchaseResource($purchase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
    }
}
