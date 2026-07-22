<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Public Frontend Routes
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/api/system-health', [FrontendController::class, 'systemHealth'])->name('system-health');
Route::post('/api/recommend-architecture', [FrontendController::class, 'recommendArchitecture'])->name('recommend-architecture');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/company-profile', [FrontendController::class, 'companyProfile'])->name('company-profile');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');
Route::post('/newsletter-subscribe', [FrontendController::class, 'newsletterStore'])->name('newsletter.store');
Route::get('/newsletter/unsubscribe/{subscriber}', [FrontendController::class, 'newsletterUnsubscribe'])
    ->name('newsletter.unsubscribe')
    ->middleware('signed');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Portfolio Routes
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Services Routes
Route::get('/services', [FrontendController::class, 'services'])->name('services.index');
Route::get('/services/{slug}', [FrontendController::class, 'serviceShow'])->name('services.show');

use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CareerController;

// Calculator Route
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');

// Careers Routes
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{slug}', [CareerController::class, 'show'])->name('careers.show');
Route::post('/careers/{slug}/apply', [CareerController::class, 'apply'])->name('careers.apply');

// Legal Routes
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');

// Sitemap Route
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

// Quotation PDF Download Route (Admin authenticated)
Route::middleware(['auth'])->group(function () {
    Route::get('/quotations/{quotation}/download', [QuotationController::class, 'download'])->name('quotations.download');
});

// Admin Panel handled by Filament at /admin

// Client Portal Routes
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Client\ClientPortalController;

Route::prefix('client')->name('client.')->group(function () {
    // Auth Routes
    Route::get('/login', [ClientAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [ClientAuthController::class, 'login']);
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');

    // Authenticated Portal Routes
    Route::middleware(['auth:customer'])->group(function () {
        Route::get('/dashboard', [ClientPortalController::class, 'dashboard'])->name('dashboard');
        Route::get('/projects', [ClientPortalController::class, 'projects'])->name('projects.index');
        Route::get('/projects/{project}', [ClientPortalController::class, 'projectShow'])->name('projects.show');
        Route::get('/contracts', [ClientPortalController::class, 'contracts'])->name('contracts.index');
        Route::get('/contracts/{contract}/download', [ClientPortalController::class, 'contractDownload'])->name('contracts.download');
        Route::get('/invoices', [ClientPortalController::class, 'invoices'])->name('invoices.index');
        Route::get('/invoices/{invoice}', [ClientPortalController::class, 'invoiceShow'])->name('invoices.show');
        Route::post('/invoices/{invoice}/upload-proof', [ClientPortalController::class, 'uploadPaymentProof'])->name('invoices.upload-proof');
        Route::get('/profile', [ClientPortalController::class, 'profile'])->name('profile');
        Route::post('/profile', [ClientPortalController::class, 'profileUpdate'])->name('profile.update');
    });
});
