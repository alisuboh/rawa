<?php

namespace App\Admin\Controllers;

use App\Models\AdminRolePermissions;
use App\Models\AdminRoleUsers;
use App\Models\City;
use App\Models\Provider;
use App\Models\SysAdmin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


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
        $grid->filter(function($filter){
            $filter->like('name');
            $filter->like('email');
            $filter->like('contact_phone');
            $filter->between('created_at')->datetime();


        });


        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('name', __('Name'));
        $grid->column('code', __('Code'));
        $grid->column('commercial_name', __('Commercial name'));
        $grid->column('address_line_1', __('Address line 1'));
        $grid->column('address_line_2', __('Address line 2'));
        $grid->column('city_id',  __('City'))->display(function () {
            return $this->city->name??'';
        });
        $grid->column('status', __('Status'))->bool();;
        // $grid->column('status', __('Status'))->using(Provider::STATUS);
        $grid->column('image_name', __('Image name'))->image();
        $grid->column('location_lat', __('Location lat'));
        $grid->column('location_lng', __('Location lng'));
        $grid->column('logo_path', __('Logo path'))->image();
        $grid->column('contact_name', __('Contact name'));
        $grid->column('contact_phone', __('Contact phone'));
        $grid->column('contact_mobile', __('Contact mobile'));
        $grid->column('has_branches', __('Has branches'));
        $grid->column('is_on_top_search', __('Is on top search'));
        $grid->column('rate', __('Rate'));
        $grid->column('created_at', __('Created at'))->date('Y-m-d');
        $grid->column('updated_at', __('Updated at'))->date('Y-m-d');

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
        $show = new Show(Provider::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        $show->field('name', __('Name'));
        $show->field('code', __('Code'));
        $show->field('commercial_name', __('Commercial name'));
        $show->field('address_line_1', __('Address line 1'));
        $show->field('address_line_2', __('Address line 2'));
        $show->field('city_id',  __('City'))->as(function () {
            return $this->city->name??'';
        });
        $show->status()->using(Provider::STATUS);

        $show->field('image_name', __('Image name'));
        $show->field('location_lat', __('Location lat'));
        $show->field('location_lng', __('Location lng'));
        $show->field('logo_path', __('Logo path'));
        $show->field('contact_name', __('Contact name'));
        $show->field('contact_phone', __('Contact phone'));
        $show->field('contact_mobile', __('Contact mobile'));
        $show->field('has_branches', __('Has branches'));
        $show->field('is_on_top_search', __('Is on top search'));
        $show->field('rate', __('Rate'));
        $show->field('created_at', __('Created at'))->date('Y-m-d');
        $show->field('updated_at', __('Updated at'))->date('Y-m-d');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Provider());

        $form->email('email', __('Email'));
        $form->text('name', __('Name'));
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
        $form->text('contact_name', __('Contact name'));
        $form->text('contact_phone', __('Contact phone'));
        $form->text('contact_mobile', __('Contact mobile'));
        $form->switch('has_branches', __('Has branches'));
        $form->switch('is_on_top_search', __('Is on top search'));
        $form->decimal('rate', __('Rate'));
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });
        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });
        $form->saved(function (Form $form) {
            $admin = new SysAdmin();
            $admin->username = $form->model()->name;
            $admin->email = $form->model()->email;
            $admin->password = $form->model()->password;
            $admin->active = $form->model()->status;
            $admin->name = $form->model()->commercial_name??$form->model()->name;
            $admin->phone_number = $form->model()->contact_mobile??$form->model()->contact_phone;
            $admin->provider_id = $form->model()->id;
            $admin->api_token = Str::random(60);

            // $admin->setRelations(['roles' => [2],'permissions'=>[2]]);
            $admin->save();
            $roles = new AdminRoleUsers(['user_id'=>$admin->id, 'role_id'=>2]);
            $admin->roles()->save($roles);
            // $permissions = new AdminRolePermissions(['user_id'=>$admin->id, 'permission_id'=>2]);
            // $admin->permissions()->save($permissions);
            // $roles = $admin->roles()->create([
            //     'role_id' => 2
            // ]);
        });
        return $form;
    }


}
