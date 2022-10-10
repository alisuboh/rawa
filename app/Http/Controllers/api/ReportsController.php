<?php

namespace App\Http\Controllers\api;

use App\Constants\TransCode;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\ExpenseItem;
use App\Models\ProvidersEmployee;
use App\Models\Purchase;
use App\Models\RevenueItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function accountStatement(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'filter_id' => 'required',
            'from' => 'required',
            'to' => 'required',            
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $type = $input['type'];
        $filter_id = $input['filter_id'];
        $from = date('Y-m-d', strtotime($input['from']));
        $to = date('Y-m-d', strtotime($input['to']));
        $old_balance = 0;
        $final_balance = 0;
        $type_name = TransCode::BENEFICIARY[$type];
        $result = [];
        switch ($type_name) {
            case "supplier":
                break;
            case "customer":
                $old_revenue = RevenueItem::where('provider_id', auth()->user()->provider_id)->where('customer_id', $filter_id)->where('transaction_date', '<', $from)->where('source', 1)->sum('total_price');
                // $old_order_cash = CustomerOrder::where('provider_id',auth()->user()->provider_id)->where('customer_id',$filter_id)->where('created_at','<',$from)->where('payment_type',1)->sum('total_price');
                $old_order_postponed = CustomerOrder::where('provider_id', auth()->user()->provider_id)->where('customer_id', $filter_id)->where('created_at', '<', $from)->where('payment_type', 3)->sum('total_price');
                // $total_order_old = $old_order_cash - $old_order_postponed;
                // $old_balance = $old < 0 ? $old : 0.00;

                $old_balance = $cal = $old_revenue - $old_order_postponed;
                // dd($old_revenue,$old_order_postponed);

                $data = RevenueItem::select(DB::raw('YEAR(transaction_date) year'), 'revenue_categories.description', 'transaction_date', 'bond_no', 'total_price', 'code')
                    ->where('provider_id', auth()->user()->provider_id)
                    ->where('customer_id', $filter_id)
                    ->where('transaction_date', '>=', $from)
                    ->where('transaction_date', '<=', $to)
                    ->leftjoin('revenue_categories', 'revenue_items.rev_cat_id', '=', 'revenue_categories.id')
                    // ->groupby('year','transaction_date','revenue_categories.description','bond_no','total_price','code')
                    ->paginate(100);


                $final_balance = (RevenueItem::where('provider_id', auth()->user()->provider_id)
                    ->where('customer_id', $filter_id)
                    ->where('transaction_date', '>=', $from)
                    ->where('transaction_date', '<=', $to)
                    ->sum('total_price')) + $old_balance;
                foreach ($data as $row) {
                    $row['remaining'] = $cal = floor(($row['total_price'] + $cal) * 100) / 100;
                    $row['total_price'] = floor(($row['total_price'] ) * 100) / 100;
                    $result[$row['year']][] = $row;
                }

                break;
            case "employee":
                break;
        }


        return response()->json([
            "success" => true,
            "message" => "Order updated successfully.",
            "data" => [
                'data' =>  $result,
                'old_balance' => floor($old_balance * 100) / 100,
                'final_balance' => floor($final_balance * 100) / 100,

            ],
        ]);
    }
}
