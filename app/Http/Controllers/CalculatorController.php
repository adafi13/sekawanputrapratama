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
                'badge' => 'Populer untuk Bisnis',
                'icon' => 'fas fa-globe',
                'base_price' => 3500000,
                'base_days' => 10,
                'description' => 'Website profesional perusahaan, responsive, modern & SEO-friendly.',
                'features' => [
                    'seo_pro' => ['name' => 'SEO Optimization Pro & Schema Markup', 'price' => 1500000, 'days' => 2, 'icon' => 'fas fa-search-dollar'],
                    'multilang' => ['name' => 'Multi-Language (Bahasa Indonesia & English)', 'price' => 1200000, 'days' => 2, 'icon' => 'fas fa-language'],
                    'contact_wa' => ['name' => 'Floating WhatsApp CTA & Form Lead Auto Email', 'price' => 800000, 'days' => 1, 'icon' => 'fab fa-whatsapp'],
                    'cms_blog' => ['name' => 'Modul CMS Artikel Blog & Berita Perusahaan', 'price' => 1500000, 'days' => 2, 'icon' => 'fas fa-newspaper'],
                    'domain_hosting' => ['name' => 'Free High-Speed Cloud VPS & Domain .COM/.ID 1 Thn', 'price' => 1000000, 'days' => 0, 'icon' => 'fas fa-hdd'],
                    'sla' => ['name' => 'Garansi Technical Support & Maintenance 1 Tahun', 'price' => 2500000, 'days' => 0, 'icon' => 'fas fa-shield-alt'],
                ],
            ],
            'web_ecommerce' => [
                'name' => 'Toko Online / E-Commerce',
                'badge' => 'Siap Jualan',
                'icon' => 'fas fa-shopping-cart',
                'base_price' => 7500000,
                'base_days' => 20,
                'description' => 'Toko online lengkap dengan katalog produk, keranjang, & payment gateway.',
                'features' => [
                    'payment' => ['name' => 'Integrasi Payment Gateway (Midtrans/Xendit/QRIS)', 'price' => 2500000, 'days' => 4, 'icon' => 'fas fa-credit-card'],
                    'shipping' => ['name' => 'Automasi Cek Ongkir Real-time (JNE, TIKI, POS, J&T)', 'price' => 1800000, 'days' => 3, 'icon' => 'fas fa-truck-loading'],
                    'inventory' => ['name' => 'Manajemen Stok Produk & Alert Stok Menipis', 'price' => 1500000, 'days' => 2, 'icon' => 'fas fa-boxes'],
                    'discounts' => ['name' => 'Modul Kupon Diskon, Voucher & Flash Sale', 'price' => 1500000, 'days' => 2, 'icon' => 'fas fa-tags'],
                    'wa_invoice' => ['name' => 'Auto Notification Invoice & Resi ke WhatsApp Klien', 'price' => 1800000, 'days' => 3, 'icon' => 'fab fa-whatsapp'],
                    'sla' => ['name' => 'Garansi Security E-Commerce & Maintenance SLA 1 Tahun', 'price' => 3500000, 'days' => 0, 'icon' => 'fas fa-lock'],
                ],
            ],
            'mobile_app' => [
                'name' => 'Aplikasi Mobile (Android & iOS)',
                'badge' => 'Mobile First',
                'icon' => 'fas fa-mobile-alt',
                'base_price' => 15000000,
                'base_days' => 30,
                'description' => 'Aplikasi mobile Flutter/Native modern untuk Google Play & App Store.',
                'features' => [
                    'push_notif' => ['name' => 'Push Notification System (Firebase FCM)', 'price' => 2000000, 'days' => 3, 'icon' => 'fas fa-bell'],
                    'gps_map' => ['name' => 'Real-time Location Tracking & Google Maps API', 'price' => 2500000, 'days' => 4, 'icon' => 'fas fa-map-marked-alt'],
                    'payment_app' => ['name' => 'In-App Payment Gateway & E-Wallet Integration', 'price' => 3000000, 'days' => 5, 'icon' => 'fas fa-wallet'],
                    'biometric' => ['name' => 'Biometric Security Login (Fingerprint / Face ID)', 'price' => 1500000, 'days' => 2, 'icon' => 'fas fa-fingerprint'],
                    'playstore' => ['name' => 'Upload & Rilis ke Google Play Store & Apple App Store', 'price' => 2000000, 'days' => 3, 'icon' => 'fab fa-google-play'],
                    'sla' => ['name' => 'Garansi Update OS Mobile & SLA Support 1 Tahun', 'price' => 4500000, 'days' => 0, 'icon' => 'fas fa-tools'],
                ],
            ],
            'server_infra' => [
                'name' => 'Setup Server & Infrastructure',
                'badge' => 'High Reliability',
                'icon' => 'fas fa-server',
                'base_price' => 5000000,
                'base_days' => 7,
                'description' => 'Instalasi server kantor, cloud VPS, security firewall, & jaringan.',
                'features' => [
                    'firewall' => ['name' => 'High-Security Firewall & Anti-DDoS Mitigation', 'price' => 2500000, 'days' => 3, 'icon' => 'fas fa-shield-virus'],
                    'backup_auto' => ['name' => 'Automatic Daily Cloud Backup & Disaster Recovery', 'price' => 2000000, 'days' => 2, 'icon' => 'fas fa-cloud-upload-alt'],
                    'vpn_office' => ['name' => 'Private Office VPN & Secure Remote Employee Access', 'price' => 1800000, 'days' => 2, 'icon' => 'fas fa-user-lock'],
                    'monitoring' => ['name' => '24/7 Real-time Server Uptime & Resource Monitoring', 'price' => 2500000, 'days' => 3, 'icon' => 'fas fa-chart-line'],
                    'domain_ssl' => ['name' => 'Custom SSL Wildcard Certificate & DNS Cluster Management', 'price' => 1200000, 'days' => 1, 'icon' => 'fas fa-key'],
                    'sla' => ['name' => 'Technical On-Site Support & SLA Maintenance 1 Tahun', 'price' => 4000000, 'days' => 0, 'icon' => 'fas fa-headset'],
                ],
            ],
            'custom_system' => [
                'name' => 'Sistem Custom / ERP / SaaS',
                'badge' => 'Enterprise Grade',
                'icon' => 'fas fa-cogs',
                'base_price' => 20000000,
                'base_days' => 45,
                'description' => 'Sistem informasi kustom kompleks sesuai alur proses bisnis spesifik.',
                'features' => [
                    'auth_role' => ['name' => 'Multi-Role Permission & Hierarchical Security Access', 'price' => 2500000, 'days' => 4, 'icon' => 'fas fa-user-shield'],
                    'analytics' => ['name' => 'Executive BI Analytics Dashboard & Report PDF/Excel Export', 'price' => 3500000, 'days' => 5, 'icon' => 'fas fa-chart-pie'],
                    'api_gateway' => ['name' => 'Custom RESTful API Gateway for Third-Party Systems', 'price' => 3000000, 'days' => 4, 'icon' => 'fas fa-network-wired'],
                    'audit_log' => ['name' => 'Activity Audit Log System & Data Integrity Tracking', 'price' => 2000000, 'days' => 3, 'icon' => 'fas fa-history'],
                    'wa_gateway' => ['name' => 'Automated Corporate WhatsApp Notification Gateway', 'price' => 2500000, 'days' => 3, 'icon' => 'fab fa-whatsapp'],
                    'sla' => ['name' => 'Enterprise 24/7 Support SLA & User Training Karyawan', 'price' => 6000000, 'days' => 0, 'icon' => 'fas fa-graduation-cap'],
                ],
            ],
        ];

        return view('frontend.calculator', compact('platforms'));
    }
}
