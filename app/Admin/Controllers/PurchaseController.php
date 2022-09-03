<?php

namespace App\Admin\Controllers;

use App\Models\Purchase;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PurchaseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Purchase';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Purchase());

        $grid->column('id', __('Id'));
        $grid->column('invoice_number', __('Invoice number'));
        $grid->column('invoice_date', __('Invoice date'));
        $grid->column('provider_id', __('Provider id'));
        $grid->column('supplier_id', __('Supplier id'));
        $grid->column('price', __('Price'));
        $grid->column('tax', __('Tax'));
        $grid->column('discount', __('Discount'));
        $grid->column('total_price', __('Total price'));
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
        $show = new Show(Purchase::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('invoice_number', __('Invoice number'));
        $show->field('invoice_date', __('Invoice date'));
        $show->field('provider_id', __('Provider id'));
        $show->field('supplier_id', __('Supplier id'));
        $show->field('price', __('Price'));
        $show->field('tax', __('Tax'));
        $show->field('discount', __('Discount'));
        $show->field('total_price', __('Total price'));
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
        $form = new Form(new Purchase());

        $form->text('invoice_number', __('Invoice number'));
        $form->date('invoice_date', __('Invoice date'))->default(date('Y-m-d'));
        $form->number('provider_id', __('Provider id'));
        $form->number('supplier_id', __('Supplier id'));
        $form->decimal('price', __('Price'));
        $form->decimal('tax', __('Tax'));
        $form->decimal('discount', __('Discount'));
        $form->decimal('total_price', __('Total price'));

        return $form;
    }
}
