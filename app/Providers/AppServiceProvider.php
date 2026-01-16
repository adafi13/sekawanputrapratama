<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Observers\BlogPostObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register model observers for cache invalidation
        BlogPost::observe(BlogPostObserver::class);
    }
}
