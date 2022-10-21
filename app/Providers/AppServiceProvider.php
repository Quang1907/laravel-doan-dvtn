<?php

namespace App\Providers;

use App\Libs\CustomHash\Sha1Hasher;
use App\Models\Category;
use App\Repositories\CategoryReponsitory;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $categories = ( new CategoryService( new CategoryReponsitory( new Category() )) )->allCategory();
        View::share(['categories'=> $categories ]);
    }
}
