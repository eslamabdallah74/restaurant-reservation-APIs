<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ReservationsController;
use App\Http\Controllers\Api\TablesController;
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

Route::post('/create-table',[TablesController::class,'store']);
Route::post('/create-customer',[CustomerController::class,'store']);
Route::post('/reserve_table',[ReservationsController::class,'store']);
