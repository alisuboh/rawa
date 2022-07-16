<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomersAddress;
use App\Models\Product;
use App\Models\Provider;
use App\Models\ProviderProduct;
use App\Models\ProvidersEmployee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

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
        $grid->column('customer_id',  __('Customer name'))->display(function () {
            return $this->customer->name ?? '';
        });
        if (auth()->user()->roles()->where('name', 'Administrator')->exists())
            $grid->column('provider_id',  __('Provider'))->display(function () {
                return $this->provider->name ?? '';
            }); // Todo show for admin only
        $grid->column('phone_number', __('Phone number'));
        // $grid->column('customer_address_id', __('Customer address id'));
        // $grid->column('total_price', __('Total price'));
        $grid->column('status', __('Status'))->using(CustomerOrder::STATUS);
        $grid->column('created_at', __('Created at'))->display(function () {
            return date('d-m-Y H:i:s', strtotime($this->created_at));
        });

        $grid->column(__('Action'))->display(function () {
            return "
            <div class='btn-group'>
                <a class='btn btn-sm btn-primary' style='margin-right: 10px;' href='" . route('admin.orders.show', [$this->id]) . "' > <i class='fa fa-eye'></i><span class='hidden-xs'> View</span></a>
                <a class='btn btn-sm btn-primary'  href='" . route('admin.orders.edit', [$this->id]) . "'><i class='fa fa-edit'></i><span class='hidden-xs'> Edit</span></a> 
            </div>
            ";
            // <a data-_key='$this->id' href='javascript:void(0);' class='grid-row-action-62acd540c1d535617'>Delete</a>

        });

        $grid->disableActions();
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

        $order = CustomerOrder::findOrFail($id);
        return view('order.show_order',['order'=>$order]);


        
        $show = new Show(CustomerOrder::findOrFail($id));


        $show->field('customer_id',  __('Customer'))->as(function () {
            return $this->customer->name ?? '';
        });
        $show->field('provider_id', __('Provider'))->as(function () {
            return $this->provider->name ?? '';
        });

        // $show->setParent('ss');





        // $show->html()
        // ->setLabelClass(['removeLabelClass'],true)
        // ->setGroupClass("providerProductTable");

        // });

        $show->field('id', __('Id'));
        // $show->field('order_products', __('Order products'))->json();

        // $show->field('full_name', __('Full name'));



        $show->field('phone_number', __('Phone number'));
        $show->field('customer_address_id', __('Customer address'))->unescape()->as(function () {

            // table 1
            $headers = ['Id', 'Email', 'Name', 'Company'];
            $rows = [
                [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica'],
                [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar'],
                [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC'],
                [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
                [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.'],
            ];

            $table = new Table($headers, $rows, ['table-striped', 'table-responsive']);

            return $table->render();
        });
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
        $show->escape = false;
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

        // $form->column(1 / 2, function ($form) {

        $form->select('customer_id', __('Customer'))->options(Customer::all()->pluck('name', 'id'));
        if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
            $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'))->rules('required');
            // ->load('pid', 'district')->loadOne('pid', 'district');//The load method comes with the framework, defined in the vendor=>encore=>laravel-admin=>src=>Form=>Field=>Select file, the loadone is written by itself, and the code district is given to define the method for itself, and the pid is the name of the drop-down list box that changes depending on the city, which is this one below.
            // $form->select('pid','region')->options(array(0 =>'Please select a region'));

        } else {
            $form->hidden('provider_id');
        }
        $form->text('full_name', __('Full name'));
        $form->text('phone_number', __('Phone number'));

        $form->select('customer_address_id', __('Customer Address'))->options(function () {
            // if($this->customer_id)
            return CustomersAddress::where('customer_id', $this->customer_id)->get()->pluck('address_name', 'id');
            // return [];
        });


        $form->select('provider_employee_id', __('Driver'))->options(ProvidersEmployee::where('type', 1)->where(function ($query) {
            if (!empty(auth()->user()->provider_id)) {
                $query->where('provider_id', '=', auth()->user()->provider_id);
            }
        })->get()->pluck('full_name', 'id'));
        $form->text('note', __('Note'));
        $form->datetime('order_delivery_date', __('Order delivery date'))->default(date('Y-m-d H:i:s'));
        $form->decimal('shipping_fees', __('Shipping fees'));

        // $form->rows( function ($form) {

        // });
        // });

        // $form->column(1 / 2, function ($form) {

        $form->table('order_products', __('products'), function ($table) {
            $table->select('provider_product_id',  __('Product'))->options(ProviderProduct::where(
                function ($query) {
                    if (!empty(auth()->user()->provider_id)) {
                        $query->where('provider_id', '=', auth()->user()->provider_id);
                    } else {
                        $query->get();
                    }
                }
            )->pluck('provider_product_name', 'provider_product_id'))->rules(["required"]);
            $table->number('qty')->creationRules('required|min:1')->default(1);
            $table->text('desc');
        });
        $form->hidden('app_source');
        $form->hidden('status');
        $form->hidden('price');
        $form->hidden('total_price');



        // $form->decimal('vat', __('Vat'));
        // $form->decimal('price_discount', __('Price discount'));
        // $form->decimal('price', __('Price'));

        // });


        // $form->select('status',  __('Status'))->options(CustomerOrder::STATUS);
        // $form->select('app_source',  __('App source'))->options(CustomerOrder::APP_SOURCE)->default(CustomerOrder::APP_SOURCE[1]);
        // $form->decimal('total_price', __('Total price'));
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
        $form->saving(function (Form $form) {

            // $form->model()->name
            if (empty($form->provider_id)) {
                $form->provider_id = auth()->user()->provider_id;
            }

            $form->status = "1";
            $form->app_source = 1;
            $price = 0;
            foreach ($form->order_products as $key => $product) {
                $p = ProviderProduct::where('provider_product_id', $product['provider_product_id'])->first();
                $price += $p->price * $product['qty'];
            }

            $form->price = $price;
            $form->total_price = $price + $form->shipping_fees;

            // dd('sasas');



        });
        return $form;
    }
}
