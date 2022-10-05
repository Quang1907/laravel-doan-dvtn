<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('client.index');
});

Auth::routes();
Route::post( "login/checkLogin" , [ AuthController::class,  "checkLogin" ] )->name("login.checkLogin");
Route::get( "user/register" , [ AuthController::class,  "register" ] )->name("user.register");
Route::post( "user/register" , [ AuthController::class,  "store" ] )->name("user.store");

Route::group([ "prefix" => "admin",  "middleware" => "admin" ], function () {
    Route::resource( "user", UserController::class );
    Route::resource( "category", CategoryController::class );
    Route::resource( "post", PostController::class );
    Route::post( "post/import", [ PostController::class, "uploadFile" ] )->name( "post.import" );
    Route::get( "export/post", [ PostController::class, "exportFile" ] )->name( "post.export" );
});
