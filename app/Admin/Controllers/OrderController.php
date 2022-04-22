<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\Product;
use App\Models\Provider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CustomerOrder';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CustomerOrder());

        $grid->column('id', __('Id'));
        // $grid->column('order_products', __('Order products'))->table((['key' => 'key', 'val' => 'value']));

        // $grid->column('order_products', __('Order products'))->display(function ($order_products) {

        //     $order_products = array_map(function ($product) {
        //         // dd($product);
        //         // return "<span class='label label-success'>{$product['product_id']}</span>";
        //         return json_encode($product);

        //     }, $order_products);
        
        //     return join('&nbsp;', $order_products);
        // });
        // $grid->column('order_products', __('Order products'))->display(function ($order_products) {
        //     // dd($order_products);
        //     $count = count($order_products);
        //     return $count;
        // })->order();
        

        $grid->column('order_products', __('Order products'));
        $grid->column('customer_id',  __('Customer'))->display(function () {
            return $this->customer->name??'';
        });
        $grid->column('provider_id',  __('Provider'))->display(function () {
            return $this->provider->name??'';
        });
        $grid->column('full_name', __('Full name'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('customer_address_id', __('Customer address id'));
        $grid->column('total_price', __('Total price'));
        $grid->column('order_delivery_date', __('Order delivery date'));
        $grid->column('status', __('Status'))->using(CustomerOrder::STATUS);
        $grid->column('app_source', __('App source'))->using(CustomerOrder::APP_SOURCE);
        $grid->column('note', __('Note'));
        $grid->column('reason_note', __('Reason note'));
        $grid->column('vat', __('Vat'));
        $grid->column('price_discount', __('Price discount'));
        $grid->column('shipping_fees', __('Shipping fees'));
        $grid->column('provider_employee_id', __('Provider employee id'));
        $grid->column('price', __('Price'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(CustomerOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_products', __('Order products'))->json();
        $show->field('customer_id',  __('Customer'))->as(function () {
            return $this->customer->name??'';
        });
        $show->field('provider_id', __('Provider'))->as(function () {
            return $this->provider->name??'';
        });
        $show->field('full_name', __('Full name'));
        $show->field('phone_number', __('Phone number'));
        $show->field('customer_address_id', __('Customer address id'));
        $show->field('total_price', __('Total price'));
        $show->field('order_delivery_date', __('Order delivery date'));
        $show->status()->using(CustomerOrder::STATUS);
        $show->app_source()->using(CustomerOrder::APP_SOURCE);


        $show->field('note', __('Note'));
        $show->field('reason_note', __('Reason note'));
        $show->field('vat', __('Vat'));
        $show->field('price_discount', __('Price discount'));
        $show->field('shipping_fees', __('Shipping fees'));
        $show->field('provider_employee_id', __('Provider employee id'));
        $show->field('price', __('Price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CustomerOrder());

        // $form->text('order_products', __('Order products'));
        // $form->embeds('order_products', __('Order products'), function ($form) {
        //     $form->select('product_id',  __('Product Id'))->options(Product::all()->pluck('product_name','product_id'));

        //     $form->number('qty')->rules('required');
        //     // $form->email('key2')->rules('required');
        //     // $form->datetime('key3');

        //     // $form->dateRange('key4','key5','Range')->rules('required');
        // });
        $form->table('order_products', __('Order products'), function ($table) {
            $table->select('product_id',  __('Product Id'))->options(Product::all()->pluck('product_name','product_id'));
            $table->number('qty')->rules('required');
            $table->text('desc');
        });
        $form->select('customer_id', __('Customer'))->options(Customer::all()->pluck('name', 'id'));
        $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'));


        $form->text('full_name', __('Full name'));
        $form->text('phone_number', __('Phone number'));
        $form->number('customer_address_id', __('Customer address id'));
        $form->decimal('total_price', __('Total price'));
        $form->datetime('order_delivery_date', __('Order delivery date'))->default(date('Y-m-d H:i:s'));
        $form->select('status',  __('Status'))->options(CustomerOrder::STATUS);
        $form->select('app_source',  __('App source'))->options(CustomerOrder::APP_SOURCE)->default(CustomerOrder::APP_SOURCE[1]);
        $form->text('note', __('Note'));
        $form->text('reason_note', __('Reason note'));
        $form->decimal('vat', __('Vat'));
        $form->decimal('price_discount', __('Price discount'));
        $form->number('shipping_fees', __('Shipping fees'));
        $form->number('provider_employee_id', __('Provider employee id'));
        $form->decimal('price', __('Price'));

        return $form;
    }
}
