<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Models\Portfolio;
use App\Models\Service;
use App\Observers\BlogPostObserver;
use App\Observers\PortfolioObserver;
use App\Observers\ServiceObserver;
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
        Service::observe(ServiceObserver::class);
        Portfolio::observe(PortfolioObserver::class);
    }
}
