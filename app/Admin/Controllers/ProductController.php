<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\ProductsCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('product_id', __('Product id'));
        $grid->column('icon_path', __('Icon path'))->image('',50,50);
        $grid->column('category_id',  __('Category'))->display(function () {
            return $this->productsCategory->category_name??'';
        });
        $grid->column('product_code', __('Product code'));
        $grid->column('product_name', __('Product name'));
        $grid->column('product_description', __('Product description'));
        $grid->column('size', __('Size'));
        // $grid->column('picture', __('Picture'))->image();
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
        Admin::css(asset('adminGrid.css'));

        // return "<h1>sasasasas</h1>";
        $show = new Show(Product::findOrFail($id));
        $show->field('product_id', __('Product id'));
        $show->field('icon_path', __('Icon path'))->image('',50,50);

        
        $show->field('category_id',  __('Category'))->as(function () {
            return $this->productsCategory->category_name??'';
        });
        $show->field('product_code', __('Product code'));
        $show->field('product_name', __('Product name'));
        $show->field('product_description', __('Product description'));
        $show->field('size', __('Size'));
        $show->field('picture', __('Picture'))->image();
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
        $form = new Form(new Product());

        $form->select('category_id',  __('Category'))->options(ProductsCategory::all()->pluck('category_name', 'category_id'));

        $form->text('product_code', __('Product code'));
        $form->text('product_name', __('Product name'));
        $form->textarea('product_description', __('Product description'));
        $form->number('size', __('Size'));
        $form->image('icon_path', __('Icon path'));
        $form->image('picture', __('Picture'));
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
