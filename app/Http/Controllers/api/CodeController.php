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
use Spatie\QueryBuilder\QueryBuilder;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        $direct_order = CustomerOrder::getLastSeqNumber(1);
        $tabular_order = CustomerOrder::getLastSeqNumber(2);
        $purchase = Purchase::getLastSeqNumber();
        $revenue = RevenueItem::getLastSeqNumber();
        $expense = ExpenseItem::getLastSeqNumber();
        $employee = ProvidersEmployee::getLastSeqNumber();
        $customer = Customer::getLastSeqNumber();
        $supplier = Supplier::getLastSeqNumber();
        return [
            "direct_order" =>  TransCode::CODES_ARRAY["direct_order"].str_repeat('0',7 - $this->countDigits($direct_order) ). $direct_order,
            "tabular_order" =>  TransCode::CODES_ARRAY["tabular_order"]. str_repeat('0',7 - $this->countDigits($tabular_order) ). $tabular_order,
            "purchase" =>  TransCode::CODES_ARRAY["purchase"]. str_repeat('0',7 - $this->countDigits($purchase) ). $purchase,
            "revenue" =>  TransCode::CODES_ARRAY["revenue"]. str_repeat('0',7 - $this->countDigits($revenue) ). $revenue,
            "expense" =>  TransCode::CODES_ARRAY["expense"]. str_repeat('0',7 - $this->countDigits($expense) ). $expense,
            "employee" =>  TransCode::CODES_ARRAY["employee"]. str_repeat('0',6 - $this->countDigits($employee) ). $employee,
            "customer" =>  TransCode::CODES_ARRAY["customer"]. str_repeat('0',6 - $this->countDigits($customer) ). $customer,
            "supplier" =>  TransCode::CODES_ARRAY["supplier"]. str_repeat('0',6 - $this->countDigits($supplier) ). $supplier,
        ];
        return TransCode::CODES_ARRAY;
      
    }

    function countDigits($MyNum){
        $MyNum = (int)abs($MyNum);
        $MyStr = strval($MyNum);
        return strlen($MyStr);
      }
}