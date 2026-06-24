<?php

namespace App\Console\Commands;

use App\Mail\InvoicePaymentReminder;
use App\Models\Invoice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendInvoicePaymentReminders extends Command
{
    protected $signature = 'invoices:send-reminders';

    protected $description = 'Email customers a payment reminder for invoices due in 3 days';

    public function handle(): int
    {
        $invoices = Invoice::with('project.customer')
            ->whereIn('status', [Invoice::STATUS_PENDING, Invoice::STATUS_SENT])
            ->whereDate('due_date', now()->addDays(3)->toDateString())
            ->get();

        $sent = 0;

        foreach ($invoices as $invoice) {
            $email = $invoice->customer?->email;

            if (! $email) {
                $this->warn("Skipped {$invoice->invoice_number}: customer has no email on file");
                continue;
            }

            Mail::to($email)->send(new InvoicePaymentReminder($invoice));
            $this->line("Reminder queued for {$invoice->invoice_number} -> {$email}");
            $sent++;
        }

        $this->info("Done. {$sent} reminder(s) sent.");

        return self::SUCCESS;
    }
}
