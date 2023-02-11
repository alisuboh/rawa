<?php

namespace App\Admin\Controllers;

use App\Models\TripsScheduled;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TripsScheduledController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TripsScheduled';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TripsScheduled());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('provider_id', __('Provider id'));
        $grid->column('orders_ids', __('Orders ids'));
        $grid->column('customer_id', __('Customer id'));
        $grid->column('driver_id', __('Driver id'));
        $grid->column('delivery_date', __('Delivery date'));
        $grid->column('days', __('Days'));
        $grid->column('status', __('Status'));
        $grid->column('note', __('Note'));
        $grid->column('app_source', __('App source'));
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
        if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
            $show = new Show(TripsScheduled::findOrFail($id));
        } else {
            $provider_id = auth()->user()->provider_id ?? null;
            $grid = new Grid(new TripsScheduled(), function ($build) use ($provider_id) {
                $build->model()->where("provider_id", "=", $provider_id);
            });
        }

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('provider_id', __('Provider id'));
        $show->field('orders_ids', __('Orders ids'));
        $show->field('customer_id', __('Customer id'));
        $show->field('driver_id', __('Driver id'));
        $show->field('delivery_date', __('Delivery date'));
        $show->field('days', __('Days'));
        $show->field('status', __('Status'));
        $show->field('note', __('Note'));
        $show->field('app_source', __('App source'));
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
        $form = new Form(new TripsScheduled());

        $form->text('name', __('Name'));
        $form->number('provider_id', __('Provider id'));
        $form->text('orders_ids', __('Orders ids'));
        $form->number('customer_id', __('Customer id'));
        $form->number('driver_id', __('Driver id'));
        $form->date('delivery_date', __('Delivery date'))->default(date('Y-m-d'));
        $form->text('days', __('Days'));
        $form->number('status', __('Status'))->default(1);
        $form->text('note', __('Note'));
        $form->number('app_source', __('App source'));

        return $form;
    }
}
