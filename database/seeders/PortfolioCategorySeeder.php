<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;

class PortfolioCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Website',
                'slug' => 'website',
                'description' => 'Portfolio website yang telah kami buat',
                'order' => 1,
            ],
            [
                'name' => 'Apps',
                'slug' => 'apps',
                'description' => 'Portfolio aplikasi mobile dan desktop',
                'order' => 2,
            ],
            [
                'name' => 'Server',
                'slug' => 'server',
                'description' => 'Portfolio instalasi dan konfigurasi server',
                'order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            PortfolioCategory::create($category);
        }
    }
}


