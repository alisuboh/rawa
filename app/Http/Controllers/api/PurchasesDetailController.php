<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchasesDetailRequest;
use App\Http\Resources\PurchasesDetailResource;
use App\Models\PurchasesDetail;

class PurchasesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return PurchasesDetailResource::collection(PurchasesDetail::paginate());
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
     * @param \Hyperpay\reporting\Models\PurchasesDetail $purchasesDetail
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
     * @param \Hyperpay\reporting\Models\PurchasesDetail $purchasesDetail
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
     * @param \Hyperpay\reporting\Models\PurchasesDetail $purchasesDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasesDetail $purchasesDetail)
    {
        $purchasesDetail->delete();
    }
}
