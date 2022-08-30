<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseResource;
use App\Models\ExpenseItem;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver_id = auth()->user()->driver_id??request()->driver_id;
        
        if($driver_id){
            $listOfExpense = ExpenseItem::where('provider_id', '=', auth()->user()->provider_id)->where('driver_id', '=', $driver_id)->paginate();
        }else{
            return response()->json([
                "success" => false,
                "message" => "driver id missing",
                "data" =>  [],
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Expense List",
            "data" =>  ExpenseResource::collection($listOfExpense),
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
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseItem $expenseItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseItem $expenseItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseItem $expenseItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseItem  $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseItem $expenseItem)
    {
        //
    }
}
