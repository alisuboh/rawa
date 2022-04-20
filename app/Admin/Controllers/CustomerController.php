<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Controllers\AdminController;
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
        $grid = new Grid(new Customer());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('user_name', __('User name'));
        $grid->column('mobile_number', __('Mobile number'));
        $grid->column('email', __('Email'));
        $grid->column('has_branches', __('Has branches'));
        $grid->column('default_provider_id', __('Default provider id'));
        $grid->column('can_recive_any_time', __('Can recive any time'));
        $grid->column('on_days', __('On days'));
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
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('user_name', __('User name'));
        $show->field('mobile_number', __('Mobile number'));
        $show->field('email', __('Email'));
        $show->field('password', __('Password'));
        $show->field('has_branches', __('Has branches'));
        $show->field('default_provider_id', __('Default provider id'));
        $show->field('can_recive_any_time', __('Can recive any time'));
        $show->field('on_days', __('On days'));
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

        return $form;
    }
}
