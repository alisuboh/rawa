<?php

namespace App\Admin\Controllers;

use App\Models\WebPermission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WebPermissionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'WebPermission';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WebPermission());

        $grid->column('id', __('Id'));
        $grid->column('slug', __('Slug'));
        $grid->column('name', __('Name'));
        $grid->column('route', __('Route'));
        $grid->column('role_id', __('Role id'))->display(function () {
            $roleModel = config('admin.database.roles_model');
            $role = $roleModel::whereIn('id',$this->role_id);
            return $role->pluck('name');
        });
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
        $show = new Show(WebPermission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('slug', __('Slug'));
        $show->field('name', __('Name'));
        $show->field('route', __('Route'));
        $show->field('role_id', __('Role id'))->as(function ($roles) {
            $roleModel = config('admin.database.roles_model');
            $role = $roleModel::whereIn('id',$roles);
            return $role->pluck('name');
        })->label();
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
        $form = new Form(new WebPermission());
        $roleModel = config('admin.database.roles_model');

        $form->text('slug', __('Slug'));
        $form->text('name', __('Name'));
        $form->text('route', __('Route'));
        $form->multipleSelect('role_id',  __('Role id'))->options($roleModel::all()->pluck('name', 'id'));

        // $form->checkbox('role_id', __('Role id'))->options(function () {

        //     return [1 => 'foo', 2 => 'bar', 'val' => 'Option name'];
        // });
        // $form->text('role_id', __('Role id'));

        return $form;
    }
}
