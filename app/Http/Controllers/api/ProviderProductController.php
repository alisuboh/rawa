<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderProductRequest;
use App\Http\Resources\ProviderProductResource;
use App\Models\ProviderProduct;

class ProviderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return ProviderProductResource::collection(ProviderProduct::where('provider_id', '=', auth()->user()->provider_id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProviderProductRequest $request)
    {
        return new ProviderProductResource(ProviderProduct::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ProviderProduct $providerProduct)
    {
        return new ProviderProductResource($providerProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProviderProductRequest $request, ProviderProduct $providerProduct)
    {
        $providerProduct->update($request->validated());
        return new ProviderProductResource($providerProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\ProviderProduct $providerProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderProduct $providerProduct)
    {
        $providerProduct->delete();
    }
}
