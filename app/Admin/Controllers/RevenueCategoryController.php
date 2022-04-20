<?php

namespace App\Admin\Controllers;

use App\Models\RevenueCategory;
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
        $grid->column('paerant_id', __('Paerant id'));
        $grid->column('description', __('Description'));
        $grid->column('is_active', __('Is active'));
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
        $show = new Show(RevenueCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('paerant_id', __('Paerant id'));
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

        $form->number('paerant_id', __('Paerant id'));
        $form->textarea('description', __('Description'));
        $form->switch('is_active', __('Is active'));

        return $form;
    }
}
