<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\PurchaseResource;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\PurchasesDetail;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
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
        $perPage = request()->get('perPage');
        $purchase = QueryBuilder::for(Purchase::where('provider_id', '=', auth()->user()->provider_id))
            // ->defaultSort('-created_at')
            // ->allowedFilters([
            //     'invoice_number',
            //     'invoice_date',
            //     'supplier_id',
            //     'created_at'
            // ])
            // ->allowedSorts([
            //     'invoice_number',
            //     'invoice_date',
            //     'price',
            //     'total_price',
            //     'created_at'
            // ])
            ->defaultSort('-created_at')
            ->allowedFilters([
                'invoice_number',
                'supplier_id',
                AllowedFilter::scope('created'),
            ])
            ->allowedSorts('transaction_date', 'created_at', 'total_price')
            ->paginate($perPage);
        return new PurchaseCollection($purchase);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        // Pre-Tax Price  =  TP – [(TP / (1 + r) x r]
        $purchase_data = $request->get("purchase");
        $purchase_detail_data = $request->get("purchase_details");
        $total_price = 0;
        $tax = 0;
        $discount = 0;
        $db_details = [];
        $provider = Provider::find(auth()->user()->provider_id);
        $tax_included = $provider->tax_included;
        foreach ($purchase_detail_data as $key => $detail) {
            unset($detail['id']);
            $price = number_format((float)$detail['unit_price'], 2, '.', '');
            if ($tax_included) {
                $detail['discount'] = number_format((float)$detail['discount'], 2, '.', '');
                $price_without_tax  =  $price - ($price / (1 + 0.16) * 0.16);
                $detail['total_price'] = ($detail['unit_price'] * $detail['quantity']) - $detail['discount'];
                $detail['unit_price'] = number_format((float)$price_without_tax, 2, '.', '');
                $taaax = $price - $price_without_tax;
                $detail['tax'] = number_format((float)$taaax, 2, '.', '') * $detail['quantity'];
            } else {
                $detail['discount'] = number_format((float)$detail['discount'], 2, '.', '');
                $detail['unit_price'] = number_format((float)$detail['unit_price'], 2, '.', '');
                $taxes = ($detail['unit_price'] * 0.16) * $detail['quantity'];
                $detail['tax'] = number_format((float)$taxes, 2, '.', '');
                $detail['total_price'] = (($detail['unit_price']  * $detail['quantity'] )+ $detail['tax']) - $detail['discount'];

            }

            $total_price += $detail['total_price'];
            $tax += $detail['tax'];
            $discount += $detail['discount'];
            $db_details[$key] = $detail;
        }

        // Pre-Tax Price  =  TP – [(TP / (1 + r) x r]
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
                "message" => "Purchase added successfully!",
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
    public function destroy( $purchase_id)
    {
        $purchase = Purchase::find($purchase_id);
        if($purchase)
            return [
                "success" => true,
                "message" => "Purchase deleted successfully!",
                "data" => ['deleted' => $purchase->delete()]
            ];
            
        else{
            return [
                "success" => false,
                "message" => "Purchase not found!",
                "data" => []
            ];
        }
    }
}
