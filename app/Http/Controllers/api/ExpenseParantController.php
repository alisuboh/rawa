<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseParantRequest;
use App\Http\Resources\ExpenseParantResource;
use App\Models\ExpenseParant;

class ExpenseParantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $perPage = request()->get('perPage');
        return ExpenseParantResource::collection(ExpenseParant::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ExpenseParantRequest $request)
    {
        return new ExpenseParantResource(ExpenseParant::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ExpenseParant $expenseParant
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ExpenseParant $expenseParant)
    {
        return new ExpenseParantResource($expenseParant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ExpenseParant $expenseParant
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ExpenseParantRequest $request, ExpenseParant $expenseParant)
    {
        $expenseParant->update($request->validated());
        return new ExpenseParantResource($expenseParant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ExpenseParant $expenseParant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseParant $expenseParant)
    {
        $expenseParant->delete();
    }
}
