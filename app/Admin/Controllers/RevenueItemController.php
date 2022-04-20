<?php

namespace App\Admin\Controllers;

use App\Models\RevenueItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RevenueItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RevenueItem';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RevenueItem());

        $grid->column('id', __('Id'));
        $grid->column('rev_cat_id', __('Rev cat id'));
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
        $show = new Show(RevenueItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('rev_cat_id', __('Rev cat id'));
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
        $form = new Form(new RevenueItem());

        $form->number('rev_cat_id', __('Rev cat id'));
        $form->textarea('description', __('Description'));
        $form->switch('is_active', __('Is active'));

        return $form;
    }
}
