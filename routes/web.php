<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view( "/", "client.index" )->name( "home" );
Route::view( "profile", "client.profile" )->name( "profile" );


// Route::get( "user/register" , [ AuthController::class,  "register" ] )->name("user.register");
// Route::post( "user/register" , [ AuthController::class,  "store" ] )->name("user.store");
// Route::post( "user/edit" , [ AuthController::class,  "store" ] )->name("user.store");

Route::view( "account/password" ,'client.auth.change_password' )->name( "account.changepassword" );
Route::post( "account/password" , [ AuthController::class, "password" ] )->name( "account.changePassword" );

Route::view( "account/info" ,'client.auth.change_info' )->name( "account.changeinfo" );
Route::post( "account/info" , [ AuthController::class, "info" ] )->name( "account.changeinfo" );

Route::post( "account/checkLogin" , [ AuthController::class,  "checkLogin" ] )->name("account.checkLogin");
Route::view( "dangnhap", "client.auth.login" )->name( "dangnhap" );
Route::resource( "account", AuthController::class );

Auth::routes();

Route::group([ "prefix" => "admin",  "middleware" => "admin" ], function () {
    Route::view( "/", "admin.index" );
    Route::resource( "user", UserController::class );
    Route::resource( "category", CategoryController::class );
    Route::resource( "post", PostController::class );
    Route::post( "post/import", [ PostController::class, "uploadFile" ] )->name( "post.import" );
    Route::get( "export/post", [ PostController::class, "exportFile" ] )->name( "post.export" );
});


Route::get( 'auth/google', [ GoogleAuthController::class, 'redirectToGoogle' ] );
Route::get( 'auth/google/callback', [ GoogleAuthController::class, 'handleGoogleCallback' ] );
Route::get( 'auth/github', [ GithubAuthController::class, 'gitRedirect' ] );
Route::get( 'auth/github/callback', [ GithubAuthController::class, 'gitCallback' ] );
