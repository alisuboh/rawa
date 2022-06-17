<?php

namespace App\Admin\Controllers;

use App\Models\ProvidersEmployee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmployeeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProvidersEmployee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProvidersEmployee());

        $grid->column('id', __('Id'));
        $grid->column('provider_id', __('Provider id'));
        $grid->column('seq', __('Seq'));
        $grid->column('full_name', __('Full name'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('mobile_number', __('Mobile number'));
        $grid->column('status', __('Status'));
        $grid->column('type', __('Type'));
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
        $show = new Show(ProvidersEmployee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('provider_id', __('Provider id'));
        $show->field('seq', __('Seq'));
        $show->field('full_name', __('Full name'));
        $show->field('phone_number', __('Phone number'));
        $show->field('mobile_number', __('Mobile number'));
        $show->field('status', __('Status'));
        $show->field('type', __('Type'));
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
        $form = new Form(new ProvidersEmployee());

        $form->number('provider_id', __('Provider id'));
        $form->number('seq', __('Seq'));
        $form->text('full_name', __('Full name'));
        $form->text('phone_number', __('Phone number'));
        $form->text('mobile_number', __('Mobile number'));
        $form->text('status', __('Status'))->default('2');
        $form->number('type', __('Type'))->default(1);
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
