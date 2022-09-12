<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseItemRequest;
use App\Http\Resources\ExpenseItemResource;
use App\Models\ExpenseItem;
use Spatie\QueryBuilder\QueryBuilder;

class ExpenseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $expenseItem = QueryBuilder::for(ExpenseItem::where('provider_id', '=', auth()->user()->provider_id))
            ->defaultSort('-created_at')
            ->allowedFilters(['description','created_at'])
            ->allowedSorts('created_at')
            ->paginate(); 
        return ExpenseItemResource::collection($expenseItem);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ExpenseItemRequest $request)
    {
        return new ExpenseItemResource(ExpenseItem::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param \Hyperpay\reporting\Models\ExpenseItem $expenseItem
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(ExpenseItem $expenseItem)
    {
        return new ExpenseItemResource($expenseItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Hyperpay\reporting\Models\ExpenseItem $expenseItem
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ExpenseItemRequest $request, ExpenseItem $expenseItem)
    {
        $expenseItem->update($request->validated());
        return new ExpenseItemResource($expenseItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Hyperpay\reporting\Models\ExpenseItem $expenseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseItem $expenseItem)
    {
        $expenseItem->delete();
    }
}
