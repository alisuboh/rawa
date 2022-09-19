<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Models\PurchasesDetail;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $purchase = QueryBuilder::for(Purchase::where('provider_id', '=', auth()->user()->provider_id))
            ->defaultSort('-created_at')
            ->allowedFilters([
                'invoice_number',
                'invoice_date',
                'supplier_id',
                'created_at'
            ])
            ->allowedSorts([
                'invoice_number',
                'invoice_date',
                'price',
                'total_price',
                'created_at'
            ])
            ->paginate();
        return PurchaseResource::collection($purchase);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        $purchase_data = $request->get("purchase");
        $purchase_detail_data = $request->get("purchase_details");
        $total_price = 0;
        $tax = 0;
        $discount = 0;
        $db_details = [];
        foreach ($purchase_detail_data as $key => $detail) {
            unset($detail['id']);
            $detail['total_price'] = number_format((float)$detail['total_price'], 2, '.', '');
            $detail['tax'] = number_format((float)$detail['tax'], 2, '.', '');
            $detail['discount'] = number_format((float)$detail['discount'], 2, '.', '');

            $total_price += $detail['total_price'];
            $tax += $detail['tax'];
            $discount += $detail['discount'];
            $db_details[$key] = $detail;
        }
        $purchase_data['total_price'] = $total_price;
        $purchase_data['tax'] = $tax;
        $purchase_data['discount'] = $discount;

        if ($purchase = Purchase::create($purchase_data)) {
            foreach ($db_details as $row => $detail) {
                $db_details[$row]['purchas_id'] = $purchase->id;
            }
            PurchasesDetail::insert($db_details);

            return [
                "success" => true,
                "message" => "Revenue added successfully!",
                "data" => new PurchaseResource($purchase)
            ];
        } else {
            return [
                "success" => false,
                "message" => "Purchase not added!",
                "data" => null
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Purchase $purchase)
    {
        return new PurchaseResource($purchase);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $purchase->update($request->validated());
        return new PurchaseResource($purchase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
    }
}
