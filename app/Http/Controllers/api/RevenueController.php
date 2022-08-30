<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RevenueResource;
use App\Models\RevenueItem;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider_id = auth()->user()->provider_id??request()->provider_id;
        
        if($provider_id){
            $listOfRevenue = RevenueItem::where('provider_id', '=', auth()->user()->provider_id)->paginate();
        }else{
            return response()->json([
                "success" => false,
                "message" => "provider id missing",
                "data" =>  [],
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Revenue List",
            "data" =>  RevenueResource::collection($listOfRevenue),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return \Illuminate\Http\Response
     */
    public function show(RevenueItem $revenueItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return \Illuminate\Http\Response
     */
    public function edit(RevenueItem $revenueItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RevenueItem $revenueItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RevenueItem  $revenueItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevenueItem $revenueItem)
    {
        //
    }
    
}
 