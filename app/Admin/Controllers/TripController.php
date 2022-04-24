<?php

namespace App\Admin\Controllers;

use App\Admin\api\Driver;
use App\Admin\api\DriverApiController;
use App\Models\CustomerOrder;
use App\Models\Provider;
use App\Models\ProvidersEmployee;
use App\Models\Trip;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid = new Grid(new Trip());

        $grid->column('id', __('Id'));
        $grid->column('orders_ids', __('Orders ids'));
        // $grid->column('provider_id', __('Provider id'));
        // $grid->column('driver_id', __('Driver id'));
    
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
        $show = new Show(Trip::findOrFail($id));
        $mod = Trip::findOrFail($id);
        $show->field('id', __('Id'));
        $show->field('orders_ids', __('Orders'))->json();
        $show->field('provider_id', __('Provider'))->as(function () {
            return $this->provider->name??'';
        });
        $show->field('driver_id',  __('Driver'))->as(function () {
            return $this->customer->name??'';
        });
       
        $show->field('driver_name', __('Driver name'));
        $show->field('driver_phone', __('Driver phone'));
        $show->status()->using(Trip::STATUS);

        $show->field('total_price', __('Total price'));
        $show->field('trip_delivery_date', __('Trip delivery date'));
        $show->app_source()->using(Trip::APP_SOURCE);
        $show->field('note', __('Note'));
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
        $form = new Form(new Trip());

        $form->table('orders_ids', __('Orders'), function ($table) {
            $table->select('orders_id',  __('Order'))->options(CustomerOrder::all()->pluck('full_name','id'));
            $table->text('desc');
        });
        if(auth()->user()->roles()->where('name', 'Administrator')->exists())
            $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'));
        else
            $form->number('provider_id',_('Provider'))->value(auth()->user()->provider_id)->disabled();
      
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

        return $form;
    }
}
