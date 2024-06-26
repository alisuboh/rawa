<?php

namespace App\Http\Controllers\api;

use App\Constants\TransCode;
use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\ExpenseItem;
use App\Models\Purchase;
use App\Models\RevenueItem;
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

                $old_expense = ExpenseItem::where('provider_id', auth()->user()->provider_id)->where('beneficiary_id', $filter_id)->where('transaction_date', '<', $from)->sum('total_price');
                $old_purchas = Purchase::where('provider_id', auth()->user()->provider_id)->where('supplier_id', $filter_id)->where('invoice_date', '<', $from)->sum('total_price');
                $old_balance = $cal = ($old_purchas - $old_expense) * -1;

                $data_expense = ExpenseItem::select(DB::raw('YEAR(transaction_date) year'), 'expense_categories.description', 'transaction_date', 'bond_no', 'total_price', 'code', 'expense_items.created_at')
                    ->where('provider_id', auth()->user()->provider_id)
                    ->where('beneficiary_id', $filter_id)
                    ->where('transaction_date', '>=', $from)
                    ->where('transaction_date', '<=', $to)
                    ->leftjoin('expense_categories', 'expense_items.exp_cat_id', '=', 'expense_categories.id')
                    // ->groupby('year','transaction_date','revenue_categories.description','bond_no','total_price','code')
                    ->paginate(100);
                $data_purchase = Purchase::select(DB::raw('YEAR(invoice_date) year'), 'invoice_date as transaction_date', 'invoice_number as bond_no', 'total_price', 'seq as code', 'created_at')
                    ->where('provider_id', auth()->user()->provider_id)
                    ->where('supplier_id', $filter_id)
                    ->where('invoice_date', '>=', $from)
                    ->where('invoice_date', '<=', $to)
                    ->paginate(100);

                foreach ($data_expense as $row) {
                    // $row['remaining'] = $cal = floor(($row['total_price'] + $cal) * 100) / 100;
                    $row['total_price'] = floor(($row['total_price']) * 100) / 100;
                    $result[$row['year']][] = $row;
                }
                foreach ($data_purchase as $row) {
                    // $row['remaining'] = $cal = floor(($row['total_price'] + $cal) * 100) / 100;
                    $row['total_price'] = -floor(($row['total_price']) * 100) / 100;
                    $row['description'] = 'مشتريات';
                    $result[$row['year']][] = $row;
                }
                if (!empty($result)) {
                    foreach ($result as $year => $data_row) {

                        foreach ($data_row as $key => $row) {
                            // $date= date('M-d', strtotime($result[$year][$key]['transaction_date']));
                            $result[$year][$key]['date_view'] = date('M-d', strtotime($result[$year][$key]['transaction_date']));
                            // $result[$year][$key]['transaction_date'] = $result[$year][$key]['date_view'];
                            $result[$year][$key]['remaining'] = $cal = floor(($result[$year][$key]['total_price'] + $cal) * 100) / 100;
                            $final_balance = $result[$year][$key]['remaining'];
                        }
                    }
                    $this->array_sort_by_column($result[$year], 'transaction_date');
                }

                // $result[$year][$key]['btata'] = $date;
                // dd($result[$year][$key]['transaction_date']);

                break;
            case "customer":
                $old_revenue = RevenueItem::where('provider_id', auth()->user()->provider_id)->where('customer_id', $filter_id)->where('transaction_date', '<', $from)->where('source', 1)->sum('total_price');
                // $old_order_cash = CustomerOrder::where('provider_id',auth()->user()->provider_id)->where('customer_id',$filter_id)->where('created_at','<',$from)->where('payment_type',1)->sum('total_price');
                $old_order_postponed = CustomerOrder::where('provider_id', auth()->user()->provider_id)->where('customer_id', $filter_id)->where('created_at', '<', $from)->where('payment_type', 3)->sum('total_price');
                // $total_order_old = $old_order_cash - $old_order_postponed;
                // $old_balance = $old < 0 ? $old : 0.00;

                $old_balance = $cal = $old_revenue - $old_order_postponed;

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
                    $row['total_price'] = floor(($row['total_price']) * 100) / 100;
                    $row['date_view'] = date('M-d', strtotime($row['transaction_date']));
                    // $row['transaction_date'] = $row['date_view'];
                    $result[$row['year']][] = $row;
                }

                break;
            case "employee":
                $data = ExpenseItem::select(DB::raw('YEAR(transaction_date) year'), 'expense_categories.description', 'transaction_date', 'bond_no', 'total_price', 'code')
                    ->where('provider_id', auth()->user()->provider_id)
                    ->where('beneficiary_id', $filter_id)
                    ->where('transaction_date', '>=', $from)
                    ->where('transaction_date', '<=', $to)
                    ->leftjoin('expense_categories', 'expense_items.exp_cat_id', '=', 'expense_categories.id')
                    ->paginate(100);

                $start_month = date('Y-m', strtotime($input['from'])) . '-01';
                $old_balance = $cal = ExpenseItem::where('provider_id', auth()->user()->provider_id)->where('beneficiary_id', $filter_id)->where('transaction_date', '>=', $start_month)->where('transaction_date', '<', $from)->sum('total_price');

                $final_balance = (ExpenseItem::where('provider_id', auth()->user()->provider_id)
                    ->where('beneficiary_id', $filter_id)
                    ->where('transaction_date', '>=', $from)
                    ->where('transaction_date', '<=', $to)
                    ->sum('total_price')) + $old_balance;

                foreach ($data as $row) {
                    $row['remaining'] = $cal = floor(($row['total_price'] + $cal) * 100) / 100;
                    $row['total_price'] = floor(($row['total_price']) * 100) / 100;
                    $row['date_view'] = date('M-d', strtotime($row['transaction_date']));
                    // $row['transaction_date'] = $row['date_view'];
                    $result[$row['year']][] = $row;
                }
                break;
        }


        return response()->json([
            "success" => true,
            "message" => "Statement $type_name fetch successfully.",
            "data" => [
                'data' =>  $result,
                'old_balance' => floor($old_balance * 100) / 100,
                'final_balance' => floor($final_balance * 100) / 100,

            ],
        ]);
    }

    function array_sort_by_column(&$array, $column, $direction = SORT_ASC)
    {
        $reference_array = array();

        foreach ($array as $key => $row) {
            $reference_array[$key] = $row[$column];
        }

        array_multisort($reference_array, $direction, $array);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function revenueReport(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'revenue_cat' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $rev_cat_id = $input['revenue_cat'];
        $from = date('Y-m-d', strtotime($input['from']));
        $to = date('Y-m-d', strtotime($input['to']));
        $final_balance = 0;
        $result = [];

        $data = RevenueItem::select(DB::raw('YEAR(transaction_date) year'), 'revenue_categories.description', 'transaction_date', 'bond_no', 'total_price', 'code')
            ->where('provider_id', auth()->user()->provider_id)
            ->where('transaction_date', '>=', $from)
            ->where('transaction_date', '<=', $to)
            ->where('rev_cat_id', '=', $rev_cat_id)
            ->leftjoin('revenue_categories', 'revenue_items.rev_cat_id', '=', 'revenue_categories.id')
            // ->groupby('year','transaction_date','revenue_categories.description','bond_no','total_price','code')
            ->orderBy('transaction_date','asc')
            ->paginate(100);
        foreach ($data as $row) {
            // $row['remaining'] = $cal = floor(($row['total_price'] + $cal) * 100) / 100;
            $row['total_price'] = floor(($row['total_price']) * 100) / 100;
            if($row['total_price'] > 0)
                $final_balance += $row['total_price'];
            else if($row['total_price'] == 0)
                $row['description'] .= "(كوبون)";
            else
                $row['description'] .= "(ذمم)";
            $row['date_view'] = date('M-d', strtotime($row['transaction_date']));

            // $row['transaction_date'] = $row['date_view'];
            $result[$row['year']][] = $row;
        }

        return response()->json([
            "success" => true,
            "message" => "Reports for Revenue fetch successfully.",
            "data" => [
                'data' =>  $result,
                'final_balance' => floor($final_balance * 100) / 100,

            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function expenseReport(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'expense_cat' => 'required',
            // 'revenue_type' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        // $type = $input['revenue_type'];
        $exp_cat_id = $input['expense_cat'];
        $from = date('Y-m-d', strtotime($input['from']));
        $to = date('Y-m-d', strtotime($input['to']));
        $final_balance = 0;
        // $type_name = ExpenseItem::SOURCE[$type];
        $result = [];

        $data = ExpenseItem::select(DB::raw('YEAR(transaction_date) year'), 'expense_categories.description', 'transaction_date', 'bond_no', 'total_price', 'code')
            ->where('provider_id', auth()->user()->provider_id)
            ->where('transaction_date', '>=', $from)
            ->where('transaction_date', '<=', $to)
            ->where('exp_cat_id', '=', $exp_cat_id)
            // ->where('source', '<=', $type)
            ->leftjoin('expense_categories', 'expense_items.exp_cat_id', '=', 'expense_categories.id')
            // ->groupby('year','transaction_date','revenue_categories.description','bond_no','total_price','code')
            ->paginate(100);
        foreach ($data as $row) {
            // $row['remaining'] = $cal = floor(($row['total_price'] + $cal) * 100) / 100;
            $row['total_price'] = floor(($row['total_price']) * 100) / 100;
            $final_balance += $row['total_price'];
            $row['date_view'] = date('M-d', strtotime($row['transaction_date']));

            // $row['transaction_date'] = $row['date_view'];
            $result[$row['year']][] = $row;
        }


        return response()->json([
            "success" => true,
            "message" => "Reports for Expense fetch successfully.",
            "data" => [
                'data' =>  $result,
                'final_balance' => floor($final_balance * 100) / 100,

            ],
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function purchaseReport(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'from' => 'required',
            'to' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $from = date('Y-m-d', strtotime($input['from']));
        $to = date('Y-m-d', strtotime($input['to']));
        $result = [];
        $final_balance = 0;

        $data = Purchase::select(DB::raw('YEAR(purchases.invoice_date) year'), 'purchases.invoice_date as transaction_date', 'purchases.invoice_number as bond_no', 'purchases.total_price', 'purchases.seq as code', 'suppliers.name as description', 'purchases.created_at')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->where('purchases.provider_id', auth()->user()->provider_id)
            ->where('purchases.invoice_date', '>=', $from)
            ->where('purchases.invoice_date', '<=', $to)
            ->paginate(100);


        foreach ($data as $row) {
            // $row['remaining'] = $cal = floor(($row['total_price'] + $cal) * 100) / 100;
            $row['total_price'] = floor(($row['total_price']) * 100) / 100;
            $final_balance += $row['total_price'];
            $row['date_view'] = date('M-d', strtotime($row['transaction_date']));

            // $row['transaction_date'] = $row['date_view'];
            $result[$row['year']][] = $row;
        }

        return response()->json([
            "success" => true,
            "message" => "Reports for Purchase fetch successfully.",
            "data" => [
                'data' =>  $result,
                'final_balance' => floor($final_balance * 100) / 100,

            ],
        ]);
    }
}
