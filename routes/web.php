<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// view client
Route::get( "/", [ HomeController::class, "home" ] )->name( "home" );
Route::get( "account", [ HomeController::class, "account" ] )->name( "profile" )->middleware( "checkInfo" );
Route::get( "hoat-dong", [ HomeController::class, "activity" ] )->name( "activity" );
Route::get( "hoat-dong/{slug}", [ HomeController::class, "post" ] )->name( "activity" );
Route::get( "lich", [ HomeController::class, "calendar" ] )->name( "calendar" );

// account
Route::view( "dang-nhap", "client.auth.login" )->name( "dangnhap" )->middleware( "checkAuth" );
Route::post( "dang-nhap" , [ AuthController::class,  "checkLogin" ] )->name("account.checkLogin");
Route::view( "dang-ky" , "client.auth.register" )->name( "dangky" )->middleware( "checkAuth" );
Route::post( "dang-ky", [ AuthController::class, "register" ] )->name( "account.register");
Route::get( "vertify/email/{email}/{user}", [AuthController::class, "vertifyEmail"] )->name("account.vertifyEmail"); // ->middleware( "auth" )
Route::post( "vertify/email/{user}", [ AuthController::class, "vertify" ] )->name( "account.vertify" );
Route::view( "forget/password", "client.auth.forget_password" )->name( "forget.password" );
Route::post( "forget/password", [ AuthController::class, "forget" ] )->name( "forget.password" );
Route::get( "vertify/password/{user}",[ AuthController::class, "confirmMail"] )->name( "vertify.password" );
Route::post( "vertify/password/{user}",   [ AuthController::class, "vertifyPassword" ]  )->name( "vertify.password" );

Route::group([ "middleware" => "auth", "prefix" => "account"],function () {
    Route::view( "password" ,'client.auth.change_password' )->name( "account.changePassword" )->middleware( "checkInfo" );
    Route::post( "password" , [ AuthController::class, "password" ] )->name( "account.changePassword" );
    Route::view( "changeinfo" ,'client.auth.change_info' )->name( "account.changeinfo" )->middleware( "checkInfo" );
    Route::post( "changeinfo" , [ AuthController::class, "info" ] )->name( "account.changeinfo" );
    Route::view( "confirm", "client.auth.confirm" );
    Route::post( "confirm/{user}", [ AuthController::class,  "confirm" ] )->name( "account.confirm" );
    Route::post( "changeAvata/{user}", [ AuthController::class, "changeAvata" ] )->name( "changeAvata" );
});

// login social
Route::get( 'auth/google', [ GoogleAuthController::class, 'redirectToGoogle' ] );
Route::get( 'auth/google/callback', [ GoogleAuthController::class, 'handleGoogleCallback' ] );
Route::get( 'auth/github', [ GithubAuthController::class, 'gitRedirect' ] );
Route::get( 'auth/github/callback', [ GithubAuthController::class, 'gitCallback' ] );

Auth::routes();

// admin
Route::group([ "prefix" => "admin",  "middleware" => "admin" ], function () {
    Route::view( "/", "admin.index" );
    Route::view( "chat", "admin.chat" );
    Route::post( "carousel",  [ HomeController::class, "carousel" ] )->name( "carousel" );

    Route::resource( "user", UserController::class );
    Route::get( "user/restoreDelete/{user}", [ UserController::class, "restoreDelete" ] )->name( "user.restoreDelete" );
    Route::delete( "user/softDelete/{user}", [ UserController::class, "softDelete" ] )->name( "user.softDelete" );
    Route::post( "user/active", [ UserController::class, "active"] )->name( "user.active" );

    Route::resource( "category", CategoryController::class );
    Route::resource( "post", PostController::class );
    Route::post( "post/import", [ PostController::class, "uploadFile" ] )->name( "post.import" );
    Route::get( "export/post", [ PostController::class, "exportFile" ] )->name( "post.export" );

    Route::resource( "calendar", CalendarController::class );
    Route::get( "timkeeping", [ CalendarController::class,"timekeeping" ] )->name( "timkeeping" );
    Route::get( "timkeeping/{event}", [ CalendarController::class, "showEvent" ] )->name( "timkeeping.detail" );
    Route::post( "timekeeping/active", [ CalendarController::class, "active"])->name( "user_event.active" );
});

// fileManager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
