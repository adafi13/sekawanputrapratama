<?php

namespace Database\Factories;

use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuotationItem>
 */
class QuotationItemFactory extends Factory
{
    protected $model = QuotationItem::class;

    public function definition(): array
    {
        return [
            'quotation_id' => Quotation::factory(),
            'item_type' => QuotationItem::TYPE_SERVICE,
            'name' => fake()->words(3, true),
            'unit_price' => 1000000,
            'discount_percent' => 0,
        ];
    }
}
