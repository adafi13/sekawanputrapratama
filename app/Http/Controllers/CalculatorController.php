<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    /**
     * Display Project Cost Estimator calculator page.
     */
    public function index()
    {
        $platforms = [
            'web_company' => [
                'name' => 'Website Company Profile',
                'icon' => 'fas fa-globe',
                'base_price' => 3500000,
                'base_days' => 10,
                'description' => 'Website profesional perusahaaan, responsive & SEO-friendly.',
            ],
            'web_ecommerce' => [
                'name' => 'Toko Online / E-Commerce',
                'icon' => 'fas fa-shopping-cart',
                'base_price' => 7500000,
                'base_days' => 20,
                'description' => 'Toko online lengkap dengan katalog produk, keranjang, & ongkir.',
            ],
            'mobile_app' => [
                'name' => 'Aplikasi Mobile (Android & iOS)',
                'icon' => 'fas fa-mobile-alt',
                'base_price' => 15000000,
                'base_days' => 30,
                'description' => 'Aplikasi mobile native/hybrid untuk Play Store & App Store.',
            ],
            'server_infra' => [
                'name' => 'Setup Server & IT Infrastructure',
                'icon' => 'fas fa-server',
                'base_price' => 5000000,
                'base_days' => 7,
                'description' => 'Instalasi server kantor, cloud VPS, security firewall, & jaringan.',
            ],
            'custom_system' => [
                'name' => 'Sistem Custom / ERP / SaaS',
                'icon' => 'fas fa-cogs',
                'base_price' => 20000000,
                'base_days' => 45,
                'description' => 'Sistem informasi kustom kompleks sesuai alur bisnis spesifik.',
            ],
        ];

        $features = [
            'auth' => ['name' => 'Multi-User & Hak Akses (Role-based)', 'price' => 1500000, 'days' => 3],
            'payment' => ['name' => 'Integrasi Payment Gateway (Midtrans/Xendit)', 'price' => 2500000, 'days' => 4],
            'multilang' => ['name' => 'Multi-Language (Bahasa Indonesia & English)', 'price' => 1200000, 'days' => 2],
            'notification' => ['name' => 'WhatsApp & Email Auto Notification', 'price' => 1800000, 'days' => 3],
            'dashboard' => ['name' => 'Custom Admin Dashboard Analytics', 'price' => 3000000, 'days' => 5],
            'api' => ['name' => 'API Integration Third-party System', 'price' => 2500000, 'days' => 4],
            'seo_pro' => ['name' => 'SEO Optimization Pro & Schema Markup', 'price' => 1500000, 'days' => 2],
            'sla' => ['name' => 'Garansi & Maintenance SLA 1 Tahun', 'price' => 4000000, 'days' => 0],
        ];

        return view('frontend.calculator', compact('platforms', 'features'));
    }
}
