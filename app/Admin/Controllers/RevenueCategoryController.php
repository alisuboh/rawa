<?php

namespace App\Admin\Controllers;

use App\Models\RevenueCategory;
use App\Models\RevenueParant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RevenueCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RevenueCategory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RevenueCategory());

        $grid->column('id', __('Id'));
        $grid->column('parant_id',  __('Parant'))->display(function () {
            return $this->revenueParant->name ?? '';
        });
        $grid->column('description', __('Description'));
        $grid->column('is_active', __('Is active'))->display(function () {
            return RevenueCategory::ACTIVE[$this->is_active];
        });
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
        $show = new Show(RevenueCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parant_id', __('Parant id'));
        $show->field('description', __('Description'));
        $show->field('is_active', __('Is active'));
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
        $form = new Form(new RevenueCategory());

        // $form->number('parant_id', __('Parant id'));
        $form->column(6, function ($form) {

            $form->select('parant_id', __('Parant'))->options(RevenueParant::all()->pluck('name', 'id'));

            $form->textarea('description', __('Description'));
            $form->switch('is_active', __('Is active'));
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
