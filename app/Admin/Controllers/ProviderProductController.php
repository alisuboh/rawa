<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\ProviderProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
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
    protected function grid()
    {
        $grid = new Grid(new ProviderProduct());

        $grid->column('provider_product_id', __('products id'));
        if(auth()->user()->roles()->where('name', 'Administrator')->exists())
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
        $show = new Show(ProviderProduct::findOrFail($id));

        $show->field('provider_product_id', __('Provider products id'));
        $show->field('provider_id', __('Provider'))->as(function () {
            return $this->provider->name ?? '';
        });
        $show->field('provider_product_name', __('product Name'));
        $show->field('product_id', __('Product id'));
        $show->field('price', __('Price'));
        $show->field('measurement', __('Measurement'));
        $show->field('is_active', __('Is active'));
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
        $form = new Form(new ProviderProduct());


        // $form->column(1/2, function ($form) {
            $form->text('provider_product_name', __('Product Name'));

            if(auth()->user()->roles()->where('name', 'Administrator')->exists()){
                $form->select('provider_id', __('Provider'))->options(Provider::all()->pluck('name', 'id'))->rules('required')->setWidth(2, 2);
            }else{
                $form->hidden('provider_id');
    
            }
            $form->select('product_id', __('Product'))->options(Product::all()->pluck('product_name', 'product_id'))->setWidth(2, 2);
    
            $form->decimal('price', __('Price'));
        // });
        // $form->column(1/2, function ($form) {

            $form->select('measurement', __('Measurement'))->options(ProviderProduct::MEASUREMENT)->setWidth(2, 2);
            $form->switch('is_active', __('Is active'));
            $form->decimal('discount', __('Discount'))->rules(['required']);
            $form->image('icon_path', __('Icon path'))->setWidth(2, 2);

        // });

            $form->saving(function (Form $form) {
                // $form->model()->name
                if(empty($form->provider_id)){
                    $form->provider_id = auth()->user()->provider_id;
                }
                if(empty($form->discount)){
                    $form->discount = '0';
                }
            
            });

            $form->saved(function (Form $form) {
                // $form->model()->name
       
                // dd(Product::find($form->product_id)->icon_path);
                if(empty($form->icon_path)){
                    $saved = ProviderProduct::find($form->model()->provider_product_id);
                    $saved->icon_path = Product::find($saved->product_id)->icon_path;
                    $saved->save();
                }
            });
        // });
        // $form->tab('view tab',function($form) use ($grid){
            $grid = $this->grid();

            $form->html('</br></br></br></br>');
            $grid->disableActions(true);
            $grid->disableFilter();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableTools();
            $grid->disableRowSelector();
            $grid->disablePagination();
            $grid->paginate(100);
            $form->html($grid->render(),'My Product')
                // ->setLabelClass(['pull-left'],true)
                ->setGroupClass("pull-left col-sm-12");
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
