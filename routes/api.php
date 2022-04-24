<?php

use App\Http\Resources\Order;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Resources\TripResource;
use App\Models\CustomerOrder;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:api')->get('/provider', function(Request $request) {
//     dd($request);
//     return $request->user();
// });



//API route for register new user
// Route::post('/register', [App\Http\Controllers\api\AuthController::class, 'register']);
//API route for login user
Route::post('/provider/login', [App\Http\Controllers\api\AuthController::class, 'login']);
Route::get('/provider/validateToken', [App\Http\Controllers\api\AuthController::class, 'validateToken']);



//Protecting Routes
Route::group(['middleware' => ['auth:sanctum','abilities:check-status'],'prefix' => 'provider'], function () {
    Route::get('/profile', function() {
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
        // return new OrderCollection(CustomerOrder::paginate());
        // dd(auth()->user()->provider_id);
        // dd(auth()->user()->provider_id);
        return orderResource::collection(CustomerOrder::where('provider_id','=',auth()->user()->provider_id)->paginate());
    });
Route::get('/order/{id}', function ($id) {
    return new OrderResource(CustomerOrder::findOrFail($id));
});

});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/trips', function () {
        // return new OrderCollection(CustomerOrder::paginate());
        // dd(auth()->user()->provider_id);
        // dd(auth()->user()->provider_id);
        // dd(Trip::where('provider_id','=',auth()->user()->provider_id)->get());
        return TripResource::collection(Trip::where('provider_id','=',auth()->user()->provider_id)->paginate());
    });
Route::get('/trip/{id}', function ($id) {
    return new TripResource(Trip::findOrFail($id));
});

});
