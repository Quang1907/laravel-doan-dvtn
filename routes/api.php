<?php

use App\Http\Controllers\Api\AddressApiController;
use App\Http\Controllers\Api\ApiUserManagerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ "prefix" => "address" ], function () {
    Route::get( "province", [ AddressApiController::class, "province" ])->name( "api.province" );
    Route::get( "district", [ AddressApiController::class, "district" ])->name( "api.district" );
    Route::get( "ward", [ AddressApiController::class, "ward" ])->name( "api.ward" );
});

Route::get( "userManager", [ ApiUserManagerController::class, "admin" ])->name( "api.userManager" );
