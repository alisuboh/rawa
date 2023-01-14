<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('providers', ProviderController::class);
    $router->resource('sys-admins', SysAdminController::class);
    $router->resource('cities', CityController::class);
    $router->resource('customers', CustomerController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('products', ProductController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('revenue-items', RevenueItemController::class);
    $router->resource('revenue-categories', RevenueCategoryController::class);
    $router->resource('expense-items', ExpenseItemController::class);
    $router->resource('expense-categories', ExpenseCategoryController::class);
    $router->resource('provider-products', ProviderProductController::class);
    $router->resource('trips', TripController::class);
    $router->resource('employees', EmployeeController::class);
    // $router->get("api/drivers", "DriverApiController@drivers");
    $router->resource('customer-address', CustomerAddressController::class);
    $router->resource('customer-avalabilities', CustomerAvalabilitesController::class);
    $router->resource('purchases', PurchaseController::class);
    $router->resource('suppliers', SupplierController::class);
    $router->resource('areas', AreaController::class);
    $router->resource('trips-scheduleds', TripsScheduledController::class);
    $router->resource('reject-reasons', RejectReasonController::class);
    $router->resource('web-permissions', WebPermissionController::class);


});


