<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Post;
use App\Models\Setting;
use App\Repositories\CategoryPostReponsitory;
use App\Repositories\CategoryProductRepository;
use App\Repositories\PostReponsitory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categoryPosts =  ( new CategoryPostReponsitory( new Category ))->allCategory();
        $recent_posts = ( new PostReponsitory( new Post() ) )->orderByAndLimit( "DESC", 5 );
        $categoryProducts = ( new CategoryProductRepository( new CategoryProduct() ) )->allCateProduct();
        $websiteSetting  = Setting::first();
        View::share([
            'categoryPosts'=> $categoryPosts,
            "recent_posts" => $recent_posts,
            "categoryProducts" => $categoryProducts,
            "websiteSetting" => $websiteSetting,
        ]);
    }
}
