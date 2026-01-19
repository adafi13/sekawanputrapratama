<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $cacheKey = 'services_listing';

        $services = Cache::remember($cacheKey, now()->addMinutes(60), function () {
            return Service::with('media')
                ->where('is_active', true)
                ->orderBy('order')
                ->select(['id', 'title', 'slug', 'description', 'icon', 'order'])
                ->get();
        });

        return view('frontend.services.index', compact('services'));
    }

    public function show(string $slug): View
    {
        $cacheKey = "service_{$slug}";

        $service = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($slug) {
            return Service::with('media')
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        // Get all services for sidebar
        $allServices = Cache::remember('services_listing', now()->addMinutes(60), function () {
            return Service::where('is_active', true)
                ->orderBy('order')
                ->select(['id', 'title', 'slug'])
                ->get();
        });

        return view('frontend.services.show', compact('service', 'allServices'));
    }
}

