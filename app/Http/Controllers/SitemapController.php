<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $sitemap = Sitemap::create();

        // Homepage
        $sitemap->add(Url::create(route('home'))
            ->setPriority(1.0)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        // Static pages
        $sitemap->add(Url::create(route('about'))
            ->setPriority(0.8)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        $sitemap->add(Url::create(route('contact'))
            ->setPriority(0.8)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        $sitemap->add(Url::create(route('services.index'))
            ->setPriority(0.9)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

        $sitemap->add(Url::create(route('portfolio.index'))
            ->setPriority(0.9)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

        $sitemap->add(Url::create(route('blog.index'))
            ->setPriority(0.8)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));

        // Services
        Service::where('is_active', true)
            ->each(function (Service $service) use ($sitemap) {
                $sitemap->add(Url::create(route('services.show', $service->slug))
                    ->setPriority(0.7)
                    ->setLastModificationDate($service->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
            });

        // Portfolios
        Portfolio::whereNull('deleted_at')
            ->each(function (Portfolio $portfolio) use ($sitemap) {
                $sitemap->add(Url::create(route('portfolio.show', $portfolio->slug))
                    ->setPriority(0.7)
                    ->setLastModificationDate($portfolio->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
            });

        // Blog posts
        BlogPost::where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->each(function (BlogPost $post) use ($sitemap) {
                $sitemap->add(Url::create(route('blog.show', $post->slug))
                    ->setPriority(0.6)
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
            });

        return response($sitemap->render(), 200)
            ->header('Content-Type', 'text/xml');
    }
}
