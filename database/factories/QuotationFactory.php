<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    protected $model = Quotation::class;

    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'status' => Quotation::STATUS_DRAFT,
            'valid_until' => now()->addDays(30)->toDateString(),
            'include_tax' => false,
            'discount_percentage' => 0,
        ];
    }
}
