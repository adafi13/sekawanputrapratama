<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolios = Portfolio::with('category')->latest()->paginate(15);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create(): View
    {
        $categories = PortfolioCategory::orderBy('name')->get();
        return view('admin.portfolio.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:portfolios,slug'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:portfolio_categories,id'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'project_date' => ['nullable', 'date'],
            'project_url' => ['nullable', 'url'],
            'technologies' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ]);

        if (isset($validated['technologies']) && is_string($validated['technologies'])) {
            $validated['technologies'] = array_filter(array_map('trim', explode(',', $validated['technologies'])));
        }

        $portfolio = Portfolio::create($validated);

        if ($request->hasFile('featured_image')) {
            $portfolio->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_image');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $portfolio->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio created successfully.');
    }

    public function edit(Portfolio $portfolio): View
    {
        $categories = PortfolioCategory::orderBy('name')->get();
        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:portfolios,slug,' . $portfolio->id],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:portfolio_categories,id'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'project_date' => ['nullable', 'date'],
            'project_url' => ['nullable', 'url'],
            'technologies' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'order' => ['nullable', 'integer'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ]);

        if (isset($validated['technologies']) && is_string($validated['technologies'])) {
            $validated['technologies'] = array_filter(array_map('trim', explode(',', $validated['technologies'])));
        }

        $portfolio->update($validated);

        if ($request->hasFile('featured_image')) {
            $portfolio->clearMediaCollection('featured_image');
            $portfolio->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_image');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $portfolio->addMedia($image)->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Portfolio deleted successfully.');
    }
}
