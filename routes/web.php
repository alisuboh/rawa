<?php

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
Route::get('/unauthorized', function () {
    response()
    ->json(['message' => 'These credentials do not match our records'], 401);});
