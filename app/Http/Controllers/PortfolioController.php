<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioController extends Controller
{
    /**
     * Display portfolio listing
     */
    public function index()
    {
        $portfolios = Portfolio::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = PortfolioCategory::withCount('portfolios')->get();

        return view('frontend.portfolio.index', compact('portfolios', 'categories'));
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
            ->take(3)
            ->get();

        return view('frontend.portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}
