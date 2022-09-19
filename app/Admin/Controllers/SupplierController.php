<?php

namespace App\Admin\Controllers;

use App\Models\Provider;
use App\Models\Supplier;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SupplierController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Supplier';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Supplier());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('phone', __('Phone'));
        $grid->column('address', __('Address'));
        $grid->column('description', __('Description'));
        $grid->column('type', __('Type'))->display(function () {
            return Supplier::TYPE[$this->type];
        });        $grid->column('provider_id', __('provider'))->display(function(){
            return $this->provider->name??'';
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
        $show = new Show(Supplier::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('phone', __('Phone'));
        $show->field('address', __('Address'));
        $show->field('description', __('Description'));
        $show->type()->using(Supplier::TYPE);

        $show->field('provider_id', __('provider'))->as(function () {
            return $this->provider->name ?? '';
        });        
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
        $form = new Form(new Supplier());

        $form->text('name', __('Name'));
        $form->text('phone', __('Phone'));
        $form->text('address', __('Address'));
        $form->text('description', __('Description'));
        $form->select('type', __('Type'))->options(Supplier::TYPE);
        if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
            $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'))->rules('required');
        } else {
            $form->hidden('provider_id');
        }

        $form->saving(function (Form $form) {
            // $form->model()->name
            if (empty($form->provider_id)) {
                $form->provider_id = auth()->user()->provider_id;
            }
           
        });

        return $form;
    }
}
