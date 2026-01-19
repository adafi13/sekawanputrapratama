<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceObserver
{
    /**
     * Handle the Service "saved" event.
     */
    public function saved(Service $service): void
    {
        $this->clearCache($service);
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        $this->clearCache($service);
    }

    /**
     * Clear all related cache.
     */
    protected function clearCache(Service $service): void
    {
        Cache::forget('services_listing');
        Cache::forget("service_{$service->slug}");
        Cache::forget('home_page_data');
    }
}


