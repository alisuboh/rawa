<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RejectReasonRequest;
use App\Http\Resources\RejectReasonResource;
use App\Models\RejectReason;

class RejectReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return RejectReasonResource::collection(RejectReason::where("active",1)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(RejectReasonRequest $request)
    {
        return new RejectReasonResource(RejectReason::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\RejectReason $rejectReason
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(RejectReason $rejectReason)
    {
        return new RejectReasonResource($rejectReason);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\RejectReason $rejectReason
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(RejectReasonRequest $request, RejectReason $rejectReason)
    {
        $rejectReason->update($request->validated());
        return new RejectReasonResource($rejectReason);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\RejectReason $rejectReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(RejectReason $rejectReason)
    {
        $rejectReason->delete();
    }
}
