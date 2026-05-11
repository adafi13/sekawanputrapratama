<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(\Illuminate\Http\Request $request): View
    {
        $categories = PortfolioCategory::orderBy('order')->get();
        
        $query = Portfolio::with(['category', 'media']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $portfolios = $query->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $featuredPortfolios = Portfolio::with(['category', 'media'])
            ->where('is_featured', true)
            ->orderBy('order', 'asc')
            ->take(6)
            ->get();

        return view('frontend.portfolio.index', compact('categories', 'portfolios', 'featuredPortfolios'));
    }

    public function show(string $slug): View
    {
        $portfolio = Portfolio::with(['category', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related portfolios
        $relatedPortfolios = Portfolio::with(['category', 'media'])
            ->where('category_id', $portfolio->category_id)
            ->where('id', '!=', $portfolio->id)
            ->orderBy('order', 'asc')
            ->limit(3)
            ->get();

        return view('frontend.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}

