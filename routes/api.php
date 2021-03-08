<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/add_case',[ApiController::class,'add_case']);
Route::get('/emp_show_case',[ApiController::class,'emp_show_case']);


// User fetch Case
Route::get('/user_show_case',[ApiController::class,'user_show_case']);

// Order
Route::post('/order',[ApiController::class,'order']);
Route::post('/set_gstin',[ApiController::class,'set_gstin']);
Route::post('/get_points',[ApiController::class,'get_points']);
Route::post('/get_bill_address',[ApiController::class,'get_bill_address']);


