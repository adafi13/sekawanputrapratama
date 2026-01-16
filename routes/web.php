<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/services', function () {
    return view('frontend.services.index');
})->name('services.index');

Route::get('/portfolio', function () {
    return view('frontend.portfolio.index');
})->name('portfolio.index');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');

// NOTE: Admin routes sekarang menggunakan Filament
// Semua admin panel ada di /admin (Filament)
// Custom admin controllers dan views sudah digantikan dengan Filament Resources
