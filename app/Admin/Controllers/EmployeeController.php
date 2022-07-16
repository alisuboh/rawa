<?php

namespace App\Admin\Controllers;

use App\Models\Provider;
use App\Models\ProvidersEmployee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
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
        $grid->column('provider_id', __('Provider id'))->display(function () {
            return $this->provider->name ?? '';
        });
        $grid->column('seq', __('Seq'));
        $grid->column('full_name', __('Full name'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('mobile_number', __('Mobile number'));
        $grid->column('status', __('Status'))->display(function () {
            return ProvidersEmployee::ACTIVE[$this->status];
        });
        $grid->column('type', __('Type'))->display(function () {
            return ProvidersEmployee::TYPE[$this->type ?? 0];
        });;
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
        Admin::style("

         .box.box-info .fields-group .form-group {
            width: 50%;
            float: left;
        }
        .box.box-info .control-label{
            text-align: left !important;
        } 
        
        .removeLabelClass{
            width: 0 !important;
        } 
        
 
        ");
        $show = new Show(ProvidersEmployee::findOrFail($id));
        $show->panel()
            ->tools(function ($tools) {
                // $tools->disableEdit();
                $tools->disableList();
                // $tools->disableDelete();
            });;
        $show->field('id', __('Id'));
        $show->field('provider_id', __('Provider'))->as(function () {
            // dd($this->provider);
            return $this->provider->name ?? '';
        });
        $show->field('seq', __('Seq'));
        $show->field('full_name', __('Full name'));
        $show->field('phone_number', __('Phone number'));
        $show->field('mobile_number', __('Mobile number'));
        $show->field('status', __('Status'))->as(function () {
            return ProvidersEmployee::ACTIVE[$this->status];
        });
        $show->field('type', __('Type'))->as(function () {
            return ProvidersEmployee::TYPE[$this->type];
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
        $provider_id = auth()->user()->provider_id??request()->provider_id;

        $form = new Form(new ProvidersEmployee());
        $form->tools(function ($tools) {
            // $tools->disableEdit();
            $tools->disableList();
            // $tools->disableDelete();
        });
        $form->column(1 / 2, function ($form) {
            if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
                $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'))->rules('required');
            } else {
                $form->hidden('provider_id');
            }
            $form->text('full_name', __('Full name'));
            $form->text('status', __('Status'))->default('2');
            $form->number('seq', __('Seq'));
        });
        $form->column(1 / 2, function ($form) {

            $form->text('phone_number', __('Phone number'));
            $form->text('mobile_number', __('Mobile number'));
            $form->select('type', __('Type'))->options(ProvidersEmployee::TYPE);
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

        $form->saving(function (Form $form) use($provider_id) {
            // $form->model()->name
            if (empty($form->provider_id)) {
                $form->provider_id = $provider_id;
            }
            return redirect("/admin/providers/$provider_id");

        });

        return $form;
    }
}
