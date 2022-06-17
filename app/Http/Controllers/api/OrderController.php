<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CustomersAddress;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function getAddressByUser($customer_id){

        return CustomersAddress::where('custmoer_id',$customer_id)->get()->pluck('address_name', 'id');

    }

}
