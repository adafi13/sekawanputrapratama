<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Route;

// Public routes (with response caching for static pages)
Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])
    ->name('home')
    ->middleware('cache.headers:public;max_age=1800'); // 30 minutes

Route::get('/about', [\App\Http\Controllers\Frontend\AboutController::class, 'index'])
    ->name('about')
    ->middleware('cache.headers:public;max_age=3600'); // 1 hour

Route::get('/services', [\App\Http\Controllers\Frontend\ServiceController::class, 'index'])
    ->name('services.index')
    ->middleware('cache.headers:public;max_age=3600'); // 1 hour

Route::get('/services/{slug}', [\App\Http\Controllers\Frontend\ServiceController::class, 'show'])
    ->name('services.show')
    ->middleware('cache.headers:public;max_age=3600'); // 1 hour

Route::get('/portfolio', [\App\Http\Controllers\Frontend\PortfolioController::class, 'index'])
    ->name('portfolio.index')
    ->middleware('cache.headers:public;max_age=3600'); // 1 hour

Route::get('/portfolio/{slug}', [\App\Http\Controllers\Frontend\PortfolioController::class, 'show'])
    ->name('portfolio.show')
    ->middleware('cache.headers:public;max_age=3600'); // 1 hour

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');

// Sitemap
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// NOTE: Admin routes sekarang menggunakan Filament
// Semua admin panel ada di /admin (Filament)
// Custom admin controllers dan views sudah digantikan dengan Filament Resources
