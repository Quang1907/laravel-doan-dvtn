<?php

use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// view client
Route::controller( HomeController::class )->group( function () {
    Route::get( "/", "home" )->name( "home" );
    Route::get( "/hoat-dong/{slug?}", "categoryPost" )->name( "category.post.slug" );
    Route::get( "/hoat-dong/bai-viet/{slug}", "viewPost" )->name( "viewPost" );

    Route::get( "san-pham", "shop" )->name( "shop" );
    Route::get( "/san-pham/{cateSlug}", "categoryProducts" )->name( "category.product.slug" );
    Route::get( "/san-pham/{cateSlug}/{slugProduct}", "viewProduct" )->name( "viewProduct" );

    Route::middleware( ["auth"] )->group( function () {
        Route::get( "wishlists", "wishlistProduct" )->name( "product.wishlist" );
        Route::get( "carts", "cartsProduct" )->name( "product.cart" );
        Route::get( "checkout", "checkout" )->name( "checkout" );
        Route::get( "orders", "orders" )->name( "orders" );
        Route::get( "order/{order}", "orderDetail" )->name( "order.detail" );
        Route::get( "thank-you", "thankYou" )->name( "thank-you" );
        Route::get( "lich",  "calendar" )->name( "calendar" );
        Route::get( "refuse", "refuse" )->name( "refuse" );
    });

    Route::get( "account", "account" )->name( "profile" )->middleware( "checkInfo" );

}) ;


// mini game
Route::view( "sipping-wheel", "client.game.sipping-wheel");

// account
Route::view( "dang-nhap", "client.auth.login" )->name( "dangnhap" )->middleware( "checkAuth" );
Route::post( "dang-nhap" , [ AuthController::class,  "checkLogin" ] )->name("account.checkLogin");
Route::view( "dang-ky" ,  [ AuthController::class,  "dangky" ] )->name( "dangky" )->middleware( "checkAuth" );
Route::post( "dang-ky", [ AuthController::class, "register" ] )->name( "account.register");
Route::get( "vertify/email/{email}/{user}", [AuthController::class, "vertifyEmail"] )->name("account.vertifyEmail"); // ->middleware( "auth" )
Route::post( "vertify/email/{user}", [ AuthController::class, "vertify" ] )->name( "account.vertify" );
Route::view( "forget/password", "client.auth.forget_password" )->name( "forget" );
Route::post( "forget/password", [ AuthController::class, "forget" ] )->name( "forget.password" );
Route::get( "vertify/password/{user}",[ AuthController::class, "confirmMail"] )->name( "vertify.password.view" );
Route::post( "vertify/password/{user}",   [ AuthController::class, "vertifyPassword" ]  )->name( "vertify.password" );

Route::group([ "middleware" => "auth", "prefix" => "account"],function () {
    Route::view( "password" ,'client.auth.change_password' )->name( "account.changePassword" )->middleware( "checkInfo" );
    Route::post( "password" , [ AuthController::class, "password" ] )->name( "account.postChangePassword" );
    Route::view( "changeinfo" ,'client.auth.change_info' )->middleware( "checkInfo" )->name( "account.changeinfo" );
    Route::post( "changeinfo" , [ AuthController::class, "info" ] )->name( "account.postChangeInfo" );
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
    Route::get( "/", [ DashboardController::class, "index" ] );

    Route::get( "setting", [ SettingController::class, "setting" ] )->name( "admin.setting" );
    Route::post( "setting/store", [ SettingController::class, "store" ] )->name( "setting.store" );

    Route::resource( "user", UserController::class );
    Route::get( "user/restoreDelete/{user}", [ UserController::class, "restoreDelete" ] )->name( "user.restoreDelete" );
    Route::delete( "user/softDelete/{user}", [ UserController::class, "softDelete" ] )->name( "user.softDelete" );
    Route::post( "user/active", [ UserController::class, "active"] )->name( "user.active" );

    Route::resource( "category-posts", CategoryPostController::class );
    Route::get( "category-products/brands/{category_id}", [ CategoryProductController::class, "brands" ] )->name( "brands.category");
    Route::resource( "category-products", CategoryProductController::class );

    Route::resource( "post", PostController::class );
    Route::post( "post/import", [ PostController::class, "uploadFile" ] )->name( "post.import" );
    Route::get( "export/post", [ PostController::class, "exportFile" ] )->name( "post.export" );

    Route::resource( "calendar", CalendarController::class );
    Route::get( "timekeeping", [ CalendarController::class,"timekeeping" ] )->name( "timekeeping" );
    Route::get( "timekeeping/{event}", [ CalendarController::class, "showEvent" ] )->name( "timekeeping.detail" );
    Route::post( "timekeeping/active", [ CalendarController::class, "active"])->name( "user_event.active" );
    Route::get( "timekeeping/refuse", [ CalendarController::class, "refuse"])->name( "user_event.refuse" );

    Route::resource( "product", ProductController::class );
    Route::get( "product-image/{id}/delete", [ ProductController::class, "deleteImage" ] )->name( "product-image.delete" );
    Route::resource( "color", ColorController::class );
    Route::get( "brand", App\Http\Livewire\Admin\Brand\Index::class )->name( "brand.index" );
    Route::resource( "orders", OrderController::class);

    Route::get( "invoice/{order}", [ OrderController::class, "viewInvoice" ])->name( "viewInvoice" );
    Route::get( "invoice/{order}/generateInvoice", [ OrderController::class, "generateInvoice" ])->name( "generateInvoice" );

    Route::resource( "slider", SliderController::class );
});

// fileManager
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
