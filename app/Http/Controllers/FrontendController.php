<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\ContactMessage;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    /**
     * Display the homepage
     */
    public function home()
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $portfolioCategories = PortfolioCategory::with(['portfolios' => function($query) {
            $query->take(4);
        }])->get();

        $latestBlogs = BlogPost::where('status', 'published')
            ->with('category')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.home', compact('portfolios', 'portfolioCategories', 'latestBlogs'));
    }

    /**
     * Display about page
     */
    public function about()
    {
        return view('frontend.about');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('frontend.contact');
    }

    /**
     * Handle contact form submission
     */
    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service' => 'nullable|string|max:100',
            'message' => 'required|string',
        ]);

        try {
            // Save as Contact Message
            ContactMessage::create($validated);

            // Create Lead from contact form
            Lead::create([
                'company_name' => $validated['company_name'],
                'contact_person' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'status' => 'new',
                'source' => 'website',
                'notes' => "Layanan: " . ($validated['service'] ?? '-') . "\n\nPesan:\n" . $validated['message'],
            ]);

            return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim kami akan menghubungi Anda segera.');
        } catch (\Exception $e) {
            return back()->with('error', 'Maaf, terjadi kesalahan. Silakan coba lagi atau hubungi kami melalui WhatsApp.');
        }
    }
}
