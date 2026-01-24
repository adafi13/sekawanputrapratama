<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display portfolio listing
     */
    public function index(Request $request)
    {
        $query = Portfolio::query()->with('category');

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

        $categories = PortfolioCategory::withCount('portfolios')->get();
        
        $featuredPortfolios = Portfolio::where('is_featured', true)
            ->orderBy('order', 'asc')
            ->take(6)
            ->get();

        return view('frontend.portfolio.index', compact('portfolios', 'categories', 'featuredPortfolios'));
    }

    /**
     * Display single portfolio
     */
    public function show($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        $relatedPortfolios = Portfolio::where('category_id', $portfolio->category_id)
            ->where('id', '!=', $portfolio->id)
            ->orderBy('order', 'asc')
            ->take(3)
            ->get();

        return view('frontend.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}
