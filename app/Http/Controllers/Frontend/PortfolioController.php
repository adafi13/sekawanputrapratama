<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $categories = PortfolioCategory::orderBy('order')->get();
        
        $portfolios = Portfolio::with('category')
            ->orderBy('order', 'asc')
            ->get();

        $featuredPortfolios = Portfolio::with('category')
            ->where('is_featured', true)
            ->orderBy('order', 'asc')
            ->take(6)
            ->get();

        return view('frontend.portfolio.index', compact('categories', 'portfolios', 'featuredPortfolios'));
    }

    public function show(string $slug): View
    {
        $cacheKey = "portfolio_{$slug}";

        $portfolio = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($slug) {
            return Portfolio::with(['category:id,name,slug', 'media'])
                ->where('slug', $slug)
                ->firstOrFail();
        });

        // Get related portfolios
        $relatedPortfolios = Cache::remember("portfolio_related_{$portfolio->category_id}", now()->addMinutes(60), function () use ($portfolio) {
            return Portfolio::with('media')
                ->where('category_id', $portfolio->category_id)
                ->where('id', '!=', $portfolio->id)
                ->orderBy('order')
                ->select(['id', 'title', 'slug', 'category_id'])
                ->limit(3)
                ->get();
        });

        return view('frontend.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}

