<?php

namespace App\Admin\Controllers;

use App\Models\Area;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AreaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Area';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Area());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('active', __('Active'));
        $grid->column('code', __('Code'));
        $grid->column('order', __('Order'));
        $grid->column('city_id', __('City id'));
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
        $show = new Show(Area::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('active', __('Active'));
        $show->field('code', __('Code'));
        $show->field('order', __('Order'));
        $show->field('city_id', __('City id'));
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
        $form = new Form(new Area());

        $form->text('name', __('Name'));
        $form->switch('active', __('Active'))->default(1);
        $form->text('code', __('Code'));
        $form->number('order', __('Order'));
        $form->number('city_id', __('City id'));

        return $form;
    }
}
