<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Setting::set('contact.address', 'Perum Mega Regency Blok G3 No. 38, RT 002 / RW 020, Sukaragam, Kec. Serang Baru, Kab. Bekasi, Jawa Barat 17330');
        Setting::set('contact.phone', '+62 851-5641-2702');
        Setting::set('contact.email', 'sekawanputrapratama@gmail.com');
        Setting::set('site.company_name', 'PT Sekawan Putra Pratama');
        
        Setting::set('legal.nib', '0505260088735');
        Setting::set('legal.npwp', '100000009488824');
        Setting::set('legal.kpp', 'KPP Pratama Cikarang Selatan');
        Setting::set('legal.status', 'PT RESMI TERVERIFIKASI OSS BKPM RI & DJP');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
