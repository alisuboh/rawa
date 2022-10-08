<?php

use App\Models\CustomersAddress;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
// Auth::routes();

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/', [App\Admin\Controllers\HomeController::class, 'index'])->name('home');

//     // Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// });

Route::get('/', function () {
    return redirect('admin');
});
Route::get('.well-known/pki-validation/AF5501DA92567D7EE44AAFC356BB1D26.txt','App\Http\Controllers\MainController@index');

Route::get('/unauthorized', function () {
    response()
    ->json(['message' => 'These credentials do not match our records'], 401);});
    Route::get('/customerId/{customer_id}', function ($customer_id) {
        return CustomersAddress::where('customer_id',$customer_id)->get()->pluck('address_name', 'id');

    });