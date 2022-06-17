<?php

namespace App\Admin\Controllers;

use App\Models\CustomersAddress;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerAddressController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CustomersAddress';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CustomersAddress());

        $grid->column('id', __('Id'));
        $grid->column('customer_id', __('Customer id'));
        $grid->column('location_lat', __('Location lat'));
        $grid->column('location_lng', __('Location lng'));
        $grid->column('is_default', __('Is default'));
        $grid->column('address_name', __('Address name'));
        $grid->column('address_description', __('Address description'));
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
        $show = new Show(CustomersAddress::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('customer_id', __('Customer id'));
        $show->field('location_lat', __('Location lat'));
        $show->field('location_lng', __('Location lng'));
        $show->field('is_default', __('Is default'));
        $show->field('address_name', __('Address name'));
        $show->field('address_description', __('Address description'));
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
        $form = new Form(new CustomersAddress());

        $form->number('customer_id', __('Customer id'));
        $form->decimal('location_lat', __('Location lat'));
        $form->decimal('location_lng', __('Location lng'));
        $form->switch('is_default', __('Is default'));
        $form->text('address_name', __('Address name'));
        $form->textarea('address_description', __('Address description'));
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
