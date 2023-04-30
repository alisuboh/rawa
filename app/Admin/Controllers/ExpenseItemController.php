<?php

namespace App\Admin\Controllers;

use App\Models\ExpenseItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExpenseItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ExpenseItem';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
            $grid = new Grid(new ExpenseItem());
        } else {
            $provider_id = auth()->user()->provider_id ?? null;
            $grid = new Grid(new ExpenseItem(), function ($build) use ($provider_id) {
                $build->model()->where("provider_id", "=", $provider_id);
            });
        }

        $grid->column('id', __('Id'));
        $grid->column('exp_cat_id', __('Expense Category'))->display(function(){
            return $this->expenseCategory->expenseParant->name ?? ''; 
        });
        $grid->column('description', __('Description'));
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
        $show = new Show(ExpenseItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('exp_cat_id', __('Exp cat id'));
        $show->field('description', __('Description'));
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
        $form = new Form(new ExpenseItem());

        $form->number('exp_cat_id', __('Exp cat id'));
        $form->textarea('description', __('Description'));
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
