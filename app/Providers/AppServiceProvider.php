<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\CategoryReponsitory;
use App\Repositories\PostReponsitory;
use App\Services\CategoryService;
use App\Services\PostService;
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
        $categories = ( new CategoryService( new CategoryReponsitory( new Category() ) ) )->allCategory();
        $recent_posts = ( new PostService( new PostReponsitory( new Post() ) ) )->recentPost();
        View::share(['categories'=> $categories, "recent_posts" => $recent_posts ]);
    }
}
