<?php

namespace App\Console\Commands;

use App\Models\Quotation;
use Illuminate\Console\Command;

class ExpireQuotations extends Command
{
    protected $signature = 'quotations:expire';

    protected $description = 'Mark quotations as expired once their valid_until date has passed';

    public function handle(): int
    {
        $quotations = Quotation::whereNotNull('valid_until')
            ->where('valid_until', '<', now()->toDateString())
            ->whereIn('status', [Quotation::STATUS_DRAFT, Quotation::STATUS_SENT, Quotation::STATUS_REVISED])
            ->get();

        foreach ($quotations as $quotation) {
            $quotation->update(['status' => Quotation::STATUS_EXPIRED]);
            $this->line("Expired {$quotation->quotation_number}");
        }

        $this->info("Done. {$quotations->count()} quotation(s) marked as expired.");

        return self::SUCCESS;
    }
}
