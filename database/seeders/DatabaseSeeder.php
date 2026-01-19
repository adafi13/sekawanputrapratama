<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            PortfolioCategorySeeder::class,
            BlogCategorySeeder::class,
            ServiceSeeder::class,
            TeamMemberSeeder::class,
            BrandSeeder::class,
            FaqSeeder::class,
            TestimonialSeeder::class,
            PortfolioSeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}
