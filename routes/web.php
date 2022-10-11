<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// view
Route::view( "/", "client.index" )->name( "home" );
Route::view( "account", "client.profile" )->name( "profile" )->middleware( "checkInfo" );

// account
Route::view( "dang-nhap", "client.auth.login" )->name( "dangnhap" );
Route::post( "dang-nhap" , [ AuthController::class,  "checkLogin" ] )->name("account.checkLogin");
Route::view( "dang-ky" , "client.auth.register" )->name( "dangky" );;
Route::post( "dang-ky", [ AuthController::class, "register" ] )->name( "account.register");
Route::view( "vertify/email", "client.auth.vertify_email" )->name("account.vertifyEmail");
Route::post( "vertify/email/{user}", [ AuthController::class, "vertify" ] )->name( "account.vertify" );

Route::group([ "middleware" => "auth", "prefix" => "account"],function () {
    Route::view( "password" ,'client.auth.change_password' )->name( "account.changepassword" )->middleware( "checkInfo" );
    Route::post( "password" , [ AuthController::class, "password" ] )->name( "account.changePassword" );
    Route::view( "changeinfo" ,'client.auth.change_info' )->name( "account.changeinfo" )->middleware( "checkInfo" );
    Route::post( "changeinfo" , [ AuthController::class, "info" ] )->name( "account.changeinfo" );
    Route::view( "confirm", "client.auth.confirm" );
    Route::post( "confirm/{user}", [ AuthController::class,  "confirm" ] )->name( "account.confirm" );
    Route::post( "changeAvata/{user}", [ AuthController::class, "changeAvata" ] )->name( "changeAvata" );
});

// Route::view("check", "client.auth.email");
// login social
Route::get( 'auth/google', [ GoogleAuthController::class, 'redirectToGoogle' ] );
Route::get( 'auth/google/callback', [ GoogleAuthController::class, 'handleGoogleCallback' ] );
Route::get( 'auth/github', [ GithubAuthController::class, 'gitRedirect' ] );
Route::get( 'auth/github/callback', [ GithubAuthController::class, 'gitCallback' ] );

Auth::routes();

// admin
Route::group([ "prefix" => "admin",  "middleware" => "admin" ], function () {
    Route::view( "/", "admin.index" );
    Route::resource( "user", UserController::class );
    Route::resource( "category", CategoryController::class );
    Route::resource( "post", PostController::class );
    Route::post( "post/import", [ PostController::class, "uploadFile" ] )->name( "post.import" );
    Route::get( "export/post", [ PostController::class, "exportFile" ] )->name( "post.export" );
});
