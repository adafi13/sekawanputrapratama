<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Artikel seputar teknologi dan perkembangan IT',
            ],
            [
                'name' => 'Server',
                'slug' => 'server',
                'description' => 'Tips dan tutorial seputar server dan networking',
            ],
            [
                'name' => 'App Dev',
                'slug' => 'app-dev',
                'description' => 'Artikel tentang pengembangan aplikasi',
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}


