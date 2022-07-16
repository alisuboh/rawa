<?php
use App\Models\CustomerOrder;
echo $data; 
// 0 => "customer_id"
// 1 => "provider_id"
// 2 => "order_products"
// 3 => "full_name"
// 4 => "phone_number"
// 5 => "customer_address_id"
// 6 => "total_price"
// 7 => "order_delivery_date"
// 8 => "status"
// 9 => "app_source"
// 10 => "note"
// 11 => "reason_note"
// 12 => "vat"
// 13 => "price_discount"
// 14 => "shipping_fees"
// 15 => "provider_employee_id"
// 16 => "price"
// 17 => "created_at"
// 18 => "updated_at"
// dd($orders);
?>
<div class="">
    <h2>Order in Trip</h2>
    {{-- <p>The .table-striped class adds zebra-stripes to a table:</p>             --}}
    <table class="table  table-bordered">
      <thead>
        <tr>
          <th>Customer Id</th>
          <th>Customer Name</th>
          <th>Customer Phone</th>
          <th>Customer Address</th>
          <th>Total Price</th>
          <th>Status</th>
          <th>note</th>
          <th>Created At</th>

        </tr>
      </thead>
      <tbody>
          @foreach ($orders as $order)
          <tr>
            <td>{{$order->customer_id}}</td>
            <td>{{$order->full_name}}</td>
            <td>{{$order->phone_number}}</td>
            <td>{{$order->customer_address_id}}</td>
            <td>{{$order->total_price}}</td>
            <td>{{ CustomerOrder::STATUS[$order->status]}}</td>
            <td>{{$order->note}}</td>
            <td>{{$order->created_at}}</td>

          </tr>         
          @endforeach
     
       
      </tbody>
    </table>
  </div>