<?php

use Encore\Admin\Grid\Column;


/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

// Column::extend('order', function ($value) {
//     return "<span >$value</span>";
// });
// $grid->column('order_products', __('Order products'))->display(function ($order_products) {

//     $order_products = array_map(function ($product) {
//         // dd($product);
//         // return "<span class='label label-success'>{$product['product_id']}</span>";
//         return "<span class='label label-warning'>sssss</span>";

//     }, $order_products);

//     return join('&nbsp;', $order_products);
// });