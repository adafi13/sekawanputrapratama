<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Site Info
            [
                'key' => 'site.company_name',
                'value' => 'Sekawan Putra Pratama',
                'type' => 'text',
                'group' => 'site',
                'description' => 'Nama perusahaan',
            ],
            [
                'key' => 'site.description',
                'value' => 'Jasa Pembuatan Website, Aplikasi Android/iOS, dan Instalasi Server Kantor Terpercaya. Solusi IT Terintegrasi untuk bisnis dan enterprise dengan dukungan teknisi onsite.',
                'type' => 'textarea',
                'group' => 'site',
                'description' => 'Deskripsi perusahaan',
            ],
            [
                'key' => 'site.tagline',
                'value' => 'Transformasi Digital untuk Bisnis Anda',
                'type' => 'text',
                'group' => 'site',
                'description' => 'Tagline perusahaan',
            ],

            // Contact Info
            [
                'key' => 'contact.phone',
                'value' => '0851-5641-2702',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Nomor telepon utama',
            ],
            [
                'key' => 'contact.email',
                'value' => 'sekawanputrapratama@gmail.com',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Email utama',
            ],
            [
                'key' => 'contact.address',
                'value' => 'Sekawan Office - Bekasi, Jawa Barat',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Alamat kantor',
            ],
            [
                'key' => 'contact.office_hours',
                'value' => 'Senin - Jumat: 09:00 - 17:00 WIB',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Jam operasional',
            ],

            // Social Media
            [
                'key' => 'social.whatsapp_url',
                'value' => 'https://wa.me/6285156412702?text=Halo%20Sekawan%20Putra%20Pratama,%20saya%20tertarik%20untuk%20konsultasi%20proyek.',
                'type' => 'url',
                'group' => 'social',
                'description' => 'Link WhatsApp',
            ],
            [
                'key' => 'social.instagram_url',
                'value' => 'https://www.instagram.com/sekawanputrapratama',
                'type' => 'url',
                'group' => 'social',
                'description' => 'Link Instagram',
            ],
            [
                'key' => 'social.linkedin_url',
                'value' => null,
                'type' => 'url',
                'group' => 'social',
                'description' => 'Link LinkedIn',
            ],
            [
                'key' => 'social.facebook_url',
                'value' => null,
                'type' => 'url',
                'group' => 'social',
                'description' => 'Link Facebook',
            ],
            [
                'key' => 'social.twitter_handle',
                'value' => null,
                'type' => 'text',
                'group' => 'social',
                'description' => 'Twitter handle',
            ],

            // Banner Content
            [
                'key' => 'banner.home_title',
                'value' => 'Transformasi Digital',
                'type' => 'text',
                'group' => 'banner',
                'description' => 'Judul banner homepage',
            ],
            [
                'key' => 'banner.home_subtitle',
                'value' => 'Solusi Teknologi Yang Terintegrasi',
                'type' => 'text',
                'group' => 'banner',
                'description' => 'Subtitle banner homepage',
            ],
            [
                'key' => 'banner.home_description',
                'value' => 'Kami membantu bisnis Anda berkembang melalui layanan Web Development, App Development, dan Infrastruktur Server yang handal. Dukungan teknisi onsite untuk solusi IT terintegrasi.',
                'type' => 'textarea',
                'group' => 'banner',
                'description' => 'Deskripsi banner homepage',
            ],

            // Stats
            [
                'key' => 'stats.projects_completed',
                'value' => '50+',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Jumlah proyek selesai',
            ],
            [
                'key' => 'stats.happy_clients',
                'value' => '20+',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Jumlah klien puas',
            ],
            [
                'key' => 'stats.years_experience',
                'value' => '5+',
                'type' => 'text',
                'group' => 'stats',
                'description' => 'Tahun pengalaman',
            ],

            // Footer
            [
                'key' => 'footer.description',
                'value' => 'Sekawan Putra Pratama adalah tim konsultan IT dan pengembang perangkat lunak yang berfokus pada solusi digital terintegrasi untuk bisnis dan enterprise. Kami menyediakan layanan Web Development, App Development, Server Setup, dan dukungan teknisi onsite.',
                'type' => 'textarea',
                'group' => 'footer',
                'description' => 'Deskripsi footer',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
