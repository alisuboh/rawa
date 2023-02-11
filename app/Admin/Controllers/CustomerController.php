<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
            $grid = new Grid(new Customer());
        } else {
            $provider_id = auth()->user()->provider_id ?? null;
            $grid = new Grid(new Customer(), function ($build) use ($provider_id) {
                $build->model()->where("default_provider_id", "=", $provider_id);
            });
        }

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('user_name', __('User name'));
        $grid->column('mobile_number', __('Mobile number'));
        $grid->column('email', __('Email'));
        $grid->column('has_branches', __('Has branches'))->bool();
        $grid->column('default_provider_id', __('provider'))->display(function(){
            return $this->provider->name??'';
        });
        $grid->column('can_recive_any_time', __('Any Time'))->bool();
        $grid->column('on_days', __('On days'));
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
        // dd('sasa');
        Admin::css(asset('adminGrid.css'));
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('user_name', __('User name'));
        $show->field('mobile_number', __('Mobile number'));
        $show->field('email', __('Email'));
        $show->field('password', __('Password'));
        $show->field('has_branches', __('Has branches'))->using([0 => 'No', 1 => 'Yes']);
        $show->field('default_provider_id', __('Default provider'))->as(function () {
            return $this->provider->name ?? '';
        });
        $show->field('can_recive_any_time', __('Any Time'))->using([0 => 'No', 1 => 'Yes']);
        $show->field('on_days', __('On days'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        // customer-avalabilities
        // 
        $show->customersAddresses('My Address', function ($address) {

            $address->resource('/admin/customer-address');


            $address->id('Id');
            $address->address_name('Address name');
            $address->location_lat('Location lat');
            $address->location_lng('Location lng');
            $address->is_default('Is default');
            $address->address_description('Address description');
            $address->created_at('Created at')->display(function () {
                return date('d-m-Y H:i:s', strtotime($this->created_at));
            });



            $address->filter(function ($filter) {
                $filter->disableIdFilter();

                $filter->like('address_name');
            });
        });

        $show->customerAvalabilities('My Avalabilities', function ($avalabilities) {

            $avalabilities->resource('/admin/customer-avalabilities');

            $avalabilities->id('Id');
            $avalabilities->day('Day');
            $avalabilities->seq('Seq');
            $avalabilities->from_time('From time')->display(function () {
                return date('d-m-Y H:i:s', strtotime($this->from_time));
            });
            $avalabilities->to_time('To time')->display(function () {
                return date('d-m-Y H:i:s', strtotime($this->to_time));
            });
            $avalabilities->created_at('Created at')->display(function () {
                return date('d-m-Y H:i:s', strtotime($this->created_at));
            });
            $avalabilities->disableFilter();

            // $avalabilities->filter->disableIdFilter();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Customer());

        $form->text('name', __('Name'));
        $form->textarea('user_name', __('User name'));
        $form->text('mobile_number', __('Mobile number'));
        $form->email('email', __('Email'));
        $form->password('password', __('Password'));
        $form->switch('has_branches', __('Has branches'));
        $form->number('default_provider_id', __('Default provider id'));
        $form->switch('can_recive_any_time', __('Can recive any time'));
        $form->text('on_days', __('On days'));
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
