<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\ProviderProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;

class ProviderProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProviderProduct';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($provider_id = '')
    {

        $grid = new Grid(new ProviderProduct(), function ($build) use ($provider_id) {
            return $build->model()->where('provider_id', $provider_id);
        });



        $grid->column('provider_product_id', __('products id'));
        if (auth()->user()->roles()->where('name', 'Administrator')->exists())
            $grid->column('provider_id',  __('Provider'))->display(function () {
                return $this->provider->name ?? '';
            });
        $grid->column('provider_product_name', __('Product Name'));
        $grid->column('price', __('Price'));
        $grid->column('is_active', __('Is active'))->using(ProviderProduct::ACTIVE);
        $grid->column('discount', __('Discount'));


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
        $show = new Show(ProviderProduct::findOrFail($id));

        $show->panel()->tools(function ($tools) {
            // $tools->disableEdit();
            $tools->disableList();
            // $tools->disableDelete();
        });



        $show->field('provider_product_id', __('products id'));
        $show->field('provider_id', __('Provider'))->as(function () {
            return $this->provider->name ?? '';
        });
        $show->field('provider_product_name', __('product Name'));
        $show->field('product_id', __('Product id'));
        $show->field('price', __('Price'));
        $show->field('measurement', __('Measurement'))->as(function () {
            return ProviderProduct::MEASUREMENT[$this->measurement] ?? '';
        });
        $show->field('is_active', __('Is active'))->as(function () {
            return ProviderProduct::ACTIVE[$this->is_active];
        });
        $show->field('discount', __('Discount'));
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
        $form = new Form(new ProviderProduct());
        $form->tools(function ($tools) {
            // $tools->disableEdit();
            $tools->disableList();
            // $tools->disableDelete();
        });

        $form->column(6, function ($form) {
            $form->text('provider_product_name', __('Product Name'));

            if (auth()->user()->roles()->where('name', 'Administrator')->exists()) {
                $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'))->rules('required');
            } else {
                $form->hidden('provider_id');
            }
            $form->select('product_id', __('Product'))->options(Product::all()->pluck('product_name', 'product_id'));
            $form->select('measurement', __('Measurement'))->options(ProviderProduct::MEASUREMENT);

            
        });
        $form->column(6, function ($form) {

            $form->image('icon_path', __('Icon path'));
            $form->decimal('price', __('Price'));
            $form->decimal('discount', __('Discount'))->rules(['required']);
            $form->switch('is_active', __('Is active'));
        });

        $form->saving(function (Form $form) {
            // $form->model()->name
            if (empty($form->provider_id)) {
                $form->provider_id = auth()->user()->provider_id;
            }
            if (empty($form->discount)) {
                $form->discount = '0';
            }
        });

        $form->saved(function (Form $form) use ($provider_id) {
            // $form->model()->name

            // dd(Product::find($form->product_id)->icon_path);
            if (empty($form->icon_path)) {
                $saved = ProviderProduct::find($form->model()->provider_product_id);
                $saved->icon_path = Product::find($saved->product_id)->icon_path;
                $saved->save();
            }
            return redirect("/admin/providers/$provider_id");
        });
        // });
        // $form->tab('view tab',function($form) use ($grid){
        $form->column(12, function ($form) use ($provider_id) {
            $form->html('<button type="submit" class="btn btn-primary">Submit</button>');
// dd($provider_id);
            $grid = $this->grid($provider_id);

            $form->html('</br></br></br></br>');
            $grid->disableActions(true);
            $grid->disableFilter();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableTools();
            $grid->disableRowSelector();
            $grid->disablePagination();
            $grid->paginate(100);
            $form->html('<h3 >My Product</h3>');
            $form->html($grid->render(), '')
                // ->setLabelClass(['pull-left'],true)
                ->setGroupClass("pull-left col-sm-12");
        });




        $form->footer(function ($footer) {

            // disable reset btn
            $footer->disableReset();

            // disable submit btn
            $footer->disableSubmit();

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
