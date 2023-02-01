<?php

namespace App\Admin\Controllers;

use App\Models\City;
use App\Models\Provider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;


class ProviderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Provider';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Provider());
        $grid->expandFilter();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $filter->column(1 / 3, function ($filter) {
                $filter->like('name', __('Name'));
                $filter->between('created_at', __('Created'))->datetime();
            });
            // $filter->column(1 / 3, function ($filter) {
            // });
            $filter->column(1 / 3, function ($filter) {
                $filter->like('email', __('Email'));

                $filter->like('contact_phone', __('Phone'));
            });
        });


        $grid->column('id', __('Id'));
        $grid->column('logo_path', __('Logo'))->image('', 50, 50);
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('city_id',  __('City'))->display(function () {
            return $this->city->name ?? '';
        });

        $grid->column('status', __('Status'))->bool();
        $grid->column('contact_phone', __('Contact phone'));

        $grid->column('is_on_top_search', __('Is on top search'))->bool();
        $grid->column('tax_included', __('Tax Included'))->bool();
        $grid->column('created_at', __('Created at'))->display(function () {
            return date('d-m-Y H:i:s', strtotime($this->created_at));
        });

        $grid->column(__('Action'))->display(function () {
            return "
            <div class='btn-group'>
                <a class='btn btn-sm btn-primary' style='margin-right: 10px;' href='" . route('admin.providers.show', [$this->id]) . "' > <i class='fa fa-eye'></i><span class='hidden-xs'> View</span></a>
                <a class='btn btn-sm btn-primary'  href='" . route('admin.providers.edit', [$this->id]) . "'><i class='fa fa-edit'></i><span class='hidden-xs'> Edit</span></a> 
            </div>
            ";
        });
        $grid->disableActions();
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
        if($id == 'profile'){
            if (!empty(auth()->user()->provider_id)) {
                $id = auth()->user()->provider_id;
            }else{
                return redirect('/',302);

            }
        }

        return view('provider.index',['provider' => Provider::findOrFail($id)]);

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Provider());

        $form->email('email', __('Email'))->creationRules('required');
        $form->text('name', __('Name'))->creationRules('required');
        $form->text('code', __('Code'));
        $form->text('commercial_name', __('Commercial name'));
        $form->text('address_line_1', __('Address line 1'));
        $form->text('address_line_2', __('Address line 2'));
        $form->select('city_id',  __('City'))->options(City::all()->pluck('name', 'id'));
        $form->select('status',  __('Status'))->options(Provider::STATUS);
        $form->image('image_name', __('Image name'));
        $form->decimal('location_lat', __('Location lat'));
        $form->decimal('location_lng', __('Location lng'));
        $form->image('logo_path', __('Logo path'));
        $form->text('contact_name', __('Contact name'))->creationRules('required');
        $form->text('contact_phone', __('Contact phone'))->creationRules('required|min:10');
        $form->text('contact_mobile', __('Contact mobile'))->creationRules('required|min:10');
        $form->switch('has_branches', __('Has branches'));
        $form->switch('is_on_top_search', __('Is on top search'));
        $form->decimal('rate', __('Rate'));
        $form->switch('tax_included', __('Tax Included'));
        
        $form->password('password', trans('admin.password'))->creationRules('required|min:6|confirmed')->updateRules('nullable|min:6|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'));
        $form->submitted(function (Form $form) {
            $form->ignore(['password_confirmation']);
         });
        $form->saving(function (Form $form) {
            $form->ignore(['password_confirmation']);
            if($form->password){
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = Hash::make($form->password);
                }
            }else{
                $form->ignore(['password']);

            }
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
