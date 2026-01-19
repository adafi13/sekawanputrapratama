<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Partner 1',
                'website_url' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Partner 2',
                'website_url' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Partner 3',
                'website_url' => null,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Partner 4',
                'website_url' => null,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Partner 5',
                'website_url' => null,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Partner 6',
                'website_url' => null,
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['name' => $brand['name']],
                $brand
            );
        }
    }
}
