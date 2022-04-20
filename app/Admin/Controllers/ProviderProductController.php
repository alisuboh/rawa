<?php

namespace App\Admin\Controllers;

use App\Models\ProviderProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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

        $grid->column('provider_products_id', __('Provider products id'));
        $grid->column('provider_id', __('Provider id'));
        $grid->column('product_id', __('Product id'));
        $grid->column('price', __('Price'));
        $grid->column('is_active', __('Is active'));
        $grid->column('discount', __('Discount'));
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
        $show = new Show(ProviderProduct::findOrFail($id));

        $show->field('provider_products_id', __('Provider products id'));
        $show->field('provider_id', __('Provider id'));
        $show->field('product_id', __('Product id'));
        $show->field('price', __('Price'));
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

        $form->number('provider_id', __('Provider id'));
        $form->number('product_id', __('Product id'));
        $form->decimal('price', __('Price'));
        $form->switch('is_active', __('Is active'));
        $form->decimal('discount', __('Discount'));

        return $form;
    }
}
