<?php

namespace App\Admin\Controllers;

use App\Admin\api\Driver;
use App\Admin\api\DriverApiController;
use App\Models\CustomerOrder;
use App\Models\Provider;
use App\Models\ProviderProduct;
use App\Models\ProvidersEmployee;
use App\Models\Trip;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
Use Encore\Admin\Widgets\Table;

class TripController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Trip';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
            $grid = new Grid(new Trip());
        } else {
            $provider_id = auth()->user()->provider_id ?? null;
            $grid = new Grid(new Trip(), function ($build) use ($provider_id) {
                $build->model()->where("provider_id", "=", $provider_id);
            });
        }
        
        


        $grid->column('id', __('Id'));

        $grid->column('trip_name', __('Trip name'))->expand(function ($model)  {

            $orders = $model->orders()->map(function ($order) {
                return $order->only(['id','customer_id', 'full_name', 'phone_number','total_price','note','status','order_products']);
            });
            $orders = $orders->toArray();
            $order_products = [];
            // $provider_product_id = [];
            foreach($orders as $key => $order){
                foreach($order['order_products'] as $index => $product){
                    $order_id = $order['id'];
                    // $provider_product_id []= $product['provider_product_id'];
                    $order_products[$order_id][$index]["provider_product_name"] = $product["provider_product_name"];
                    $order_products[$order_id][$index]["price"] = $product["price"];
                    $order_products[$order_id][$index]["total"] = $product["total"];
                    $order_products[$order_id][$index]["qty"] = $product["qty"];
                }
                unset($orders[$key]['order_products']);

                //////////////////TODO
                // $grid = new Grid(new ProviderProduct(), function ($build) use ($provider_product_id) {
                //     $build->model()->whereIn("provider_product_id", $provider_product_id);
                // });
                // $products = $grid->column('provider_product_name', __('Product name'))->modal(function ($model) use ($order_products) {

                //     return new Table(["product Name","price" ,"total" ,"qty" ], $order_products);
                // });
                //        $value = new Table(["product Name","price" ,"total" ,"qty" ], $order_products);
                // dd($value->view("product.index"));
                // $orders[$key]['products'] = $products;
                // dd($products->link());
                ////////////
                
            }
            return new Table(["Order Id","Customer Id" ,"Name" ,"Phone" ,"Total Price" ,"Note" ,"Status" ,"Details"], $orders);
        });

        $grid->column('provider_id',  __('Provider'))->display(function () {
            return $this->provider->name??'';
        });
        $grid->column('driver_id',  __('Driver'))->display(function () {
            return $this->providersEmployee->full_name??'';
        });
        $grid->column('driver_name', __('Driver name'));
        $grid->column('driver_phone', __('Driver phone'));
        $grid->column('status', __('Status'))->using(Trip::STATUS);
        $grid->column('total_price', __('Total price'));
        $grid->column('trip_delivery_date', __('Trip delivery date'));
        $grid->column('app_source', __('App source'))->using(Trip::APP_SOURCE);
        $grid->column('note', __('Note'));
        $grid->column('created_at', __('Created at'))->display(function () {
            return date('d-m-Y H:i:s', strtotime($this->created_at));
        });
        

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
        Admin::css(asset('adminGrid.css'));
        $mod = Trip::findOrFail($id);
        $show = new Show($mod);
        $show->field('id', __('Id'));
        $show->field('trip_name', __('Trip name'));
        // $show->field('orders_ids', __('Orders'))->json();
        $show->field('provider_id', __('Provider'))->as(function () {
            return $this->provider->name??'';
        });
        // $show->field('driver_id',  __('Driver'))->as(function () {
        //     return $this->customer->name??'';
        // });
       
        $show->field('driver_name', __('Driver name'));
        $show->field('driver_phone', __('Driver phone'));
        $show->status()->using(Trip::STATUS);

        $show->field('total_price', __('Total price'));
        $show->field('trip_delivery_date', __('Trip delivery date'));
        $show->app_source()->using(Trip::APP_SOURCE);
        $show->field('note', __('Note'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        // $show->orders('My Address', function ($order) {

        //     $order->resource('/admin/orders');


        //     $order->id('Id');
        //     $order->address_name('Address name');
        //     $order->location_lat('Location lat');
        //     $order->location_lng('Location lng');
        //     $order->is_default('Is default');
        //     $order->address_description('Address description');
        //     $order->created_at('Created at')->display(function () {
        //         return date('d-m-Y H:i:s', strtotime($this->created_at));
        //     });



        //     $order->filter(function ($filter) {
        //         $filter->disableIdFilter();

        //         $filter->like('address_name');
        //     });
        // });

        return view('trip.index',['data'=>$show,'orders'=>$mod->orders()]);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Trip());

        $form->table('orders_ids', __('Orders'), function ($table) {
            // dd(CustomerOrder::all()->pluck('full_name','id'));
            $table->select('orders_id',  __('Order'))->options(CustomerOrder::all()->pluck('full_name','id'));
        });
        $form->text('trip_name', __('Trip name'));
        if(auth()->user()->roles()->where('name', 'Administrator')->exists())
            $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'));
        else
            $form->decimal('provider_id',_('Provider'))->value(auth()->user()->provider_id);
      
        if(auth()->user()->roles()->where('name', 'Administrator')->exists())
            $form->select('driver_id', 'Choose a Driver')->rules('required')->options(ProvidersEmployee::all()->pluck('full_name', 'id'));
        else
            $form->select('driver_id', 'Choose a Driver')->rules('required')->options(ProvidersEmployee::where(["provider_id" => auth()->user()->provider_id])->pluck('full_name', 'id'));

        $form->text('driver_name', __('Driver name'));

        $form->text('driver_phone', __('Driver phone'));
        $form->select('status',  __('Status'))->options(Trip::STATUS);
        $form->decimal('total_price', __('Total price'));
        $form->datetime('trip_delivery_date', __('Trip delivery date'))->default(date('Y-m-d H:i:s'));
        $form->select('app_source', __('App source'))->options(Trip::APP_SOURCE);

        $form->text('note', __('Note'));
        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();
        
            // disable submit btn
            // $footer->disableSubmit();
        
            // disable `View` checkbox
            $footer->disableViewCheck();
        
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();
        
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        
        });
        return $form;
    }
}
