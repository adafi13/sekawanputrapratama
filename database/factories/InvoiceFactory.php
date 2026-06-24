<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'stage' => Invoice::STAGE_DP,
            'payment_stage' => Invoice::STAGE_DP,
            'amount' => 1000000,
            'due_date' => now()->addDays(14)->toDateString(),
            'status' => Invoice::STATUS_PENDING,
        ];
    }
}
