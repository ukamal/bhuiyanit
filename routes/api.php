<?php

use App\Http\Controllers\API\ApiController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/all_products/{type}',[ApiController::class, 'getProducts']);
Route::get('/product/{id}',[ApiController::class, 'getProduct']);

Route::get('/customers',[ApiController::class, 'customers']);
Route::get('/order_no',[ApiController::class, 'order_no']);
Route::post('/customer/store',[ApiController::class, 'customerStore']);
Route::get('/customer/show/{id}',[ApiController::class, 'customerShow']);

Route::get('/suppliers',[ApiController::class, 'suppliers']);
Route::post('/supplier/store',[ApiController::class, 'supplierStore']);
Route::get('/supplier/show/{id}',[ApiController::class, 'supplierShow']);

