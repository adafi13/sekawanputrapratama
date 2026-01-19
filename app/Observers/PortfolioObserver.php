<?php

namespace App\Observers;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Cache;

class PortfolioObserver
{
    /**
     * Handle the Portfolio "saved" event.
     */
    public function saved(Portfolio $portfolio): void
    {
        $this->clearCache($portfolio);
    }

    /**
     * Handle the Portfolio "deleted" event.
     */
    public function deleted(Portfolio $portfolio): void
    {
        $this->clearCache($portfolio);
    }

    /**
     * Clear all related cache.
     */
    protected function clearCache(Portfolio $portfolio): void
    {
        // Clear specific portfolio cache
        Cache::forget("portfolio_{$portfolio->slug}");

        // Clear portfolio listing cache
        Cache::forget('portfolio_listing');

        // Clear related portfolios cache
        if ($portfolio->category_id) {
            Cache::forget("portfolio_related_{$portfolio->category_id}");
        }

        // Clear home page cache (contains featured portfolios)
        Cache::forget('home_page_data');
    }
}


