<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvidersEmployeeRequest;
use App\Http\Resources\ProvidersEmployeeResource;
use App\Models\ProvidersEmployee;
use Spatie\QueryBuilder\QueryBuilder;

class ProvidersEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $perPage = request()->get('perPage');
        $employee = QueryBuilder::for(ProvidersEmployee::where('provider_id', '=', auth()->user()->provider_id)->where('status', '1'))
            ->defaultSort('-created_at')
            ->allowedFilters([
                'full_name', 'phone_number', 'mobile_number','type',
            ])
            ->paginate($perPage);

        return ProvidersEmployeeResource::collection($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProvidersEmployeeRequest $request)
    {
        return new ProvidersEmployeeResource(ProvidersEmployee::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\ProvidersEmployee $providersEmployee
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($providersEmployee_id)
    {
        $providersEmployee = ProvidersEmployee::find($providersEmployee_id);
        return new ProvidersEmployeeResource($providersEmployee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\ProvidersEmployee $providersEmployee
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProvidersEmployeeRequest $request, $providersEmployee_id)
    {
        $providersEmployee = ProvidersEmployee::find($providersEmployee_id);
        $providersEmployee->update($request->validated());
        return new ProvidersEmployeeResource($providersEmployee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\ProvidersEmployee $providersEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProvidersEmployee $providersEmployee_id)
    {
        $providersEmployee = ProvidersEmployee::find($providersEmployee_id)->delete();
    }
}
