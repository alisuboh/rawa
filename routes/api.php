<?php

use App\Http\Controllers\api\TripController;
use App\Http\Resources\DriverResource;
use App\Http\Resources\Order;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Resources\TripResource;
use App\Models\CustomerOrder;
use App\Models\ProvidersEmployee;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/provider/login', [App\Http\Controllers\api\AuthController::class, 'login']);
Route::get('/provider/validateToken', [App\Http\Controllers\api\AuthController::class, 'validateToken']);



//Protecting Routes
Route::group(['middleware' => ['auth:sanctum', 'abilities:check-status'], 'prefix' => 'provider'], function () {
    Route::get('/profile', function () {
        return auth()->user();
    });

    // API route for logout user
    Route::get('/logout', [App\Http\Controllers\api\AuthController::class, 'logout']);
});
Route::get('/unauthorized', function () {
    response()
        ->json(['message' => 'These credentials do not match our records'], 401);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/orders', function () {
        return orderResource::collection(CustomerOrder::where('provider_id', '=', auth()->user()->provider_id)->paginate());
    });
    Route::get('/order/{id}', function ($id) {
        return new OrderResource(CustomerOrder::findOrFail($id));
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('trips', TripController::class);
});
