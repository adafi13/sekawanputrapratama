<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class MarkOverdueInvoices extends Command
{
    protected $signature = 'invoices:mark-overdue';

    protected $description = 'Mark unpaid invoices as overdue once their due_date has passed';

    public function handle(): int
    {
        $invoices = Invoice::where('due_date', '<', now()->toDateString())
            ->whereIn('status', [Invoice::STATUS_PENDING, Invoice::STATUS_SENT])
            ->get();

        foreach ($invoices as $invoice) {
            $invoice->update(['status' => Invoice::STATUS_OVERDUE]);
            $this->line("Marked {$invoice->invoice_number} as overdue");
        }

        $this->info("Done. {$invoices->count()} invoice(s) marked as overdue.");

        return self::SUCCESS;
    }
}
