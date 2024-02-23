<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->app->call(
            function () {
                $categories = Category::with('subCategories')->get();
                View::share('categories', $categories);
            }
        );
    }
}