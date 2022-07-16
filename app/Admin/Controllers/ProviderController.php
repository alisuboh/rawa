<?php

namespace App\Admin\Controllers;

use App\Http\Middleware\CheckRole;
use App\Models\AdminRolePermissions;
use App\Models\AdminRoleUsers;
use App\Models\City;
use App\Models\Provider;
use App\Models\ProviderProduct;
use App\Models\SysAdmin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;


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
        // $grid->column('logo_path')->carousel();
        // $grid->column('logo_path')->carousel( 300, 200,null);
        //     $grid->column('logo_path')->display(function ($pictures) {
        // // return Storage::url("/storage/app/{$this->logo_path}");

        //         return asset($this->logo_path);

        //     })->image();

        $grid->column('logo_path', __('Logo'))->image('', 50, 50);
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('city_id',  __('City'))->display(function () {
            return $this->city->name ?? '';
        });

        $grid->column('status', __('Status'))->bool();
        $grid->column('contact_phone', __('Contact phone'));

        $grid->column('is_on_top_search', __('Is on top search'))->bool();
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
            // <a class='btn btn-sm btn-danger'  href='".route('admin.providers.edit',[$this->id])."'><i class='fa fa-trash'></i><span class='hidden-xs'> Delete</span></a> 
            // <a href='javascript:void(0);' class='btn btn-sm btn-danger 629fe004a4442-delete' title='Delete'><i class='fa fa-trash'></i><span class='hidden-xs'>  Delete</span></a>

        });
        $grid->disableActions();
        return $grid;
    }

    // public function show($id, Content $content)
    // {


    //     // return Admin::content(function (Content $content) use ($id) {

    //     //     $content->header('Post');
    //     //     $content->description('Detail');

    //     //     $content->body(Admin::show(Provider::findOrFail($id), function (Show $show) {
    //     //         $show->field('id', 'ID');
    //     //         $show->field('name', 'name');
    //     //         $show->field('rate');
    //     //         $show->field('created_at');
    //     //     }));
    //     // });



    //     // Admin::css(asset('adminDetailsCSS.css'));
    //     $data =  Admin::content(function (Content $content) use ($id) {

    //         $content->header('Post');
    //         $content->description('Detail');

    //         $content->row(Admin::form(Provider::findOrFail($id), function (Form $form) use ($id) {


    //             $form->footer()->disableReset()
    //                 ->disableSubmit();
    //             $form->header()->disableList();
    //             $form->setTitle('user id : ' . $id);
    //             $form->html('<h3>user detalis</h3>')->setWidth(12, 0);



    //             $amind = Admin::show(Provider::findOrFail($id));
    //             $amind->field('id');
    //             $amind->field('id', __('Id'));
    //             $amind->field('name', __('Name'));
    //             $amind->field('email', __('Email'));
    //             $amind->field('city_id',  __('City'))->as(function () {
    //                 return $this->city->name ?? '';
    //             });
    //             $amind->field('address_line_1', __('Address line 1'));
    //             $amind->field('address_line_2', __('Address line 2'));
    //             $amind->field('location_lat', __('Location lat'));
    //             $amind->field('location_lng', __('Location lng'));
    //             $amind->panel()
    //                 ->style('')
    //                 ->title('')->tools(function ($tools) {
    //                     $tools->disableEdit();
    //                     $tools->disableList();
    //                     $tools->disableDelete();
    //                 });

    //             $form->html($amind->render())->setGroupClass('detalissssss')->setWidth(12, 0);







    //             $form->html('<h3>info</h3>')->setWidth(12, 0);
    //             $show = Admin::show(Provider::findOrFail($id));
    //             $show->field('contact_name', __('Contact name'));
    //             $show->field('contact_phone', __('Contact phone'));
    //             $show->field('contact_mobile', __('Contact mobile'));
    //             $show->field('has_branches', __('Has branches'));
    //             $show->field('is_on_top_search', __('Is on top search'));
    //             $show->field('rate', __('Rate'));

    //             $show->field('code', __('Code'));
    //             $show->field('commercial_name', __('Commercial name'));

    //             $show->field('name');
    //             // ->setWidth(4,2);
    //             $show->panel()
    //                 ->style('')

    //                 ->title('')->tools(function ($tools) {
    //                     $tools->disableEdit();
    //                     $tools->disableList();
    //                     $tools->disableDelete();
    //                 });

    //             $form->html($show->render())->setGroupClass('infoooooo')->setWidth(12, 0);

    //             $relation = Admin::show(Provider::findOrFail($id));
    //             $relation->fields(['']);

    //             $relation->providersEmployees('My Employees', function ($employees) {

    //                 $employees->resource('/admin/employees');

    //                 $employees->id();
    //                 $employees->full_name('Name'); //->limit(10);
    //                 $employees->phone_number();
    //                 $employees->status();
    //                 $employees->type();
    //                 $employees->created_at();
    //                 // $employees->updated_at();
    //                 $employees->paginate(10);

    //                 $employees->filter(function ($filter) {
    //                     $filter->disableIdFilter();
    //                     $filter->like('full_name');
    //                 });
    //             });

    //             $relation->providerProducts('My Product', function ($providerProducts) {

    //                 $providerProducts->resource('/admin/provider-products');

    //                 $providerProducts->provider_product_id('Id');
    //                 $providerProducts->provider_product_name(); //->limit(10);
    //                 $providerProducts->is_active();
    //                 $providerProducts->discount();
    //                 $providerProducts->price();
    //                 $providerProducts->created_at();
    //                 // $providerProducts->updated_at();
    //                 $providerProducts->paginate(10);

    //                 $providerProducts->filter(function ($filter) {
    //                     $filter->disableIdFilter();
    //                     $filter->like('provider_product_name');
    //                 });
    //             });


    //             $form->html($relation->render())->setWidth(12, 0);
    //         }));
    //     });
      
    //     return view('provider.index',['provider' => Provider::findOrFail($id)]);

    // }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        // dd($id);
        if($id == 'profile'){
            if (!empty(auth()->user()->provider_id)) {
                $id = auth()->user()->provider_id;
            }else{
                return redirect('/',302);

            }
        }
 
// $locale = App::currentLocale();
// App::setLocale("ar");
//  dd($locale);
// if (App::isLocale('en')) {
//     //
// }

        return view('provider.index',['provider' => Provider::findOrFail($id)]);

        // $show = new Show(Provider::findOrFail($id));
        // // $show->divider();

        // $show->field('id', __('Id'));
        // $show->field('name', __('Name'));
        // $show->field('email', __('Email'));
        // $show->field('city_id',  __('City'))->as(function () {
        //     return $this->city->name ?? '';
        // });
        // $show->field('address_line_1', __('Address line 1'));
        // $show->field('address_line_2', __('Address line 2'));
        // $show->field('location_lat', __('Location lat'));
        // $show->field('location_lng', __('Location lng'));



        // $show->field('contact_name', __('Contact name'));
        // $show->field('contact_phone', __('Contact phone'));
        // $show->field('contact_mobile', __('Contact mobile'));
        // $show->field('has_branches', __('Has branches'));
        // $show->field('is_on_top_search', __('Is on top search'));
        // $show->field('rate', __('Rate'));

        // $show->field('code', __('Code'));
        // $show->field('commercial_name', __('Commercial name'));

        // $show->status()->using(Provider::STATUS);

        // // $show->field('image_name', __('Image name'));

        // $show->logo_path()->image();
        // $show->image_name()->image();

        // // $show->field('logo_path', __('Logo path'));

        // $show->field('created_at', __('Created at'))->date('Y-m-d');
        // $show->field('updated_at', __('Updated at'))->date('Y-m-d');

        // $show->providersEmployees('My Employees', function ($employees) {

        //     $employees->resource('/admin/employees');

        //     $employees->id();
        //     $employees->full_name('Name'); //->limit(10);
        //     $employees->phone_number();
        //     $employees->status();
        //     $employees->type();
        //     $employees->created_at();
        //     // $employees->updated_at();
        //     $employees->paginate(10);

        //     $employees->filter(function ($filter) {
        //         $filter->disableIdFilter();
        //         $filter->like('full_name');
        //     });
        // });

        // $show->providerProducts('My Product', function ($providerProducts) {

        //     $providerProducts->resource('/admin/provider-products');

        //     $providerProducts->provider_product_id('Id');
        //     $providerProducts->provider_product_name(); //->limit(10);
        //     $providerProducts->is_active();
        //     $providerProducts->discount();
        //     $providerProducts->price();
        //     $providerProducts->created_at();
        //     // $providerProducts->updated_at();
        //     $providerProducts->paginate(10);

        //     $providerProducts->filter(function ($filter) {
        //         $filter->disableIdFilter();
        //         $filter->like('provider_product_name');
        //     });
        // });



        // return $show;
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
        // $form->saved(function (Form $form) {
        //     $admin = new SysAdmin();
        //     $admin->username = $form->model()->name;
        //     $admin->email = $form->model()->email;
        //     $admin->password = $form->model()->password;
        //     $admin->active = $form->model()->status;
        //     $admin->name = $form->model()->commercial_name??$form->model()->name;
        //     $admin->phone_number = $form->model()->contact_mobile??$form->model()->contact_phone;
        //     $admin->provider_id = $form->model()->id;
        //     $admin->api_token = Str::random(60);

        //     // $admin->setRelations(['roles' => [2],'permissions'=>[2]]);
        //     $admin->save();
        //     $roles = new AdminRoleUsers(['user_id'=>$admin->id, 'role_id'=>2]);
        //     $admin->roles()->save($roles);
        //     // $permissions = new AdminRolePermissions(['user_id'=>$admin->id, 'permission_id'=>2]);
        //     // $admin->permissions()->save($permissions);
        //     // $roles = $admin->roles()->create([
        //     //     'role_id' => 2
        //     // ]);
        // });
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
