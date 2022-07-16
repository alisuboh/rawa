<?php

namespace App\Admin\Controllers;

use App\Models\CustomerAvalability;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerAvalabilitesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CustomerAvalability';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CustomerAvalability());

        $grid->column('id', __('Id'));
        $grid->column('customer_id', __('Customer id'));
        $grid->column('seq', __('Seq'));
        $grid->column('day', __('Day'));
        $grid->column('from_time', __('From time'));
        $grid->column('to_time', __('To time'));
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
        $show = new Show(CustomerAvalability::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('customer_id', __('Customer id'));
        $show->field('seq', __('Seq'));
        $show->field('day', __('Day'));
        $show->field('from_time', __('From time'));
        $show->field('to_time', __('To time'));
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
        $form = new Form(new CustomerAvalability());

        $form->number('seq', __('Seq'));
        $form->multipleSelect('day', __('Day'))->options(CustomerAvalability::DAY)->setWidth(4, 2);
        
        $form->time('from_time', __('From time'))->format('HH:mm:ss')->required();
        
        $form->time('to_time', __('To time'))->format('HH:mm:ss')->required();

        $form->saving(function (Form $form) {
                $form->customer_id = $_GET['customer_id']??null;
        });
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
