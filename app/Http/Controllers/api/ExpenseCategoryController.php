<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseCategoryRequest;
use App\Http\Resources\ExpenseCategoryResource;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $perPage = request()->get('perPage');
        return ExpenseCategoryResource::collection(ExpenseCategory::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ExpenseCategoryRequest $request)
    {
        return new ExpenseCategoryResource(ExpenseCategory::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ExpenseCategory $expenseCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        return new ExpenseCategoryResource($expenseCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ExpenseCategory $expenseCategory
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        $expenseCategory->update($request->validated());
        return new ExpenseCategoryResource($expenseCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ExpenseCategory $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();
    }
}
