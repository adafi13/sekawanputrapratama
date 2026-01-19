<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $cacheKey = 'home_page_data';

        $data = Cache::remember($cacheKey, now()->addMinutes(30), function () {
            // Eager load media untuk menghindari N+1 queries
            $featuredPortfolios = Portfolio::with(['media', 'category'])
                ->where('is_featured', true)
                ->orderBy('order')
                ->select(['id', 'title', 'slug', 'category_id', 'is_featured', 'order'])
                ->limit(4)
                ->get();

            $services = Service::with('media')
                ->where('is_active', true)
                ->orderBy('order')
                ->select(['id', 'title', 'slug', 'description', 'icon', 'order'])
                ->limit(3)
                ->get();

            $testimonials = Testimonial::with('media')
                ->where('is_featured', true)
                ->orderBy('order')
                ->select(['id', 'client_name', 'client_company', 'testimonial', 'rating', 'order'])
                ->get();

            $brands = Brand::with('media')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();

            $teamMembers = TeamMember::with('media')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();

            // Get banner settings
            $bannerSettings = [
                'title' => Setting::get('banner.home_title', 'Transformasi Digital'),
                'subtitle' => Setting::get('banner.home_subtitle', 'Solusi Teknologi Yang Terintegrasi'),
                'description' => Setting::get('banner.home_description', 'Kami membantu bisnis Anda berkembang melalui layanan Web Development, App Development, dan Infrastruktur Server yang handal.'),
            ];

            // Get stats
            $stats = [
                'projects_completed' => Setting::get('stats.projects_completed', '50+'),
                'happy_clients' => Setting::get('stats.happy_clients', '20+'),
                'years_experience' => Setting::get('stats.years_experience', '5+'),
            ];

            return [
                'categories' => PortfolioCategory::orderBy('order')
                    ->select(['id', 'name', 'slug', 'order'])
                    ->take(3)
                    ->get(),
                'featuredPortfolios' => $featuredPortfolios,
                'services' => $services,
                'testimonials' => $testimonials,
                'brands' => $brands,
                'teamMembers' => $teamMembers,
                'bannerSettings' => $bannerSettings,
                'stats' => $stats,
            ];
        });

        return view('frontend.home', $data);
    }
}

