<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Spatie\QueryBuilder\QueryBuilder;

class SupplierController extends Controller
{
    // public function __construct()
    // {
    //      $this->authorizeResource(Supplier::class);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $perPage = request()->get('perPage');
        $supplier = QueryBuilder::for(Supplier::where('provider_id', '=', auth()->user()->provider_id)->where('is_active','1'))
        ->defaultSort('-created_at')        
        ->allowedFilters([
            'phone',
            'name',
            ])
        ->paginate($perPage); 

        return SupplierResource::collection($supplier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(SupplierRequest $request)
    {
        return new SupplierResource(Supplier::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return new SupplierResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
    }
}
