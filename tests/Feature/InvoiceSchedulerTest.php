<?php

use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;

test('invoices past due_date are marked overdue', function () {
    $project = Project::factory()->create();

    $overdue = Invoice::factory()->for($project)->create([
        'status' => Invoice::STATUS_PENDING,
        'due_date' => now()->subDays(2)->toDateString(),
    ]);

    $notYetDue = Invoice::factory()->for($project)->create([
        'status' => Invoice::STATUS_PENDING,
        'due_date' => now()->addDays(5)->toDateString(),
    ]);

    $this->artisan('invoices:mark-overdue')->assertExitCode(0);

    expect($overdue->refresh()->status)->toBe(Invoice::STATUS_OVERDUE)
        ->and($notYetDue->refresh()->status)->toBe(Invoice::STATUS_PENDING);
});

test('paid invoices are never marked overdue', function () {
    $project = Project::factory()->create();

    $paid = Invoice::factory()->for($project)->create([
        'status' => Invoice::STATUS_PAID,
        'due_date' => now()->subDays(10)->toDateString(),
    ]);

    $this->artisan('invoices:mark-overdue')->assertExitCode(0);

    expect($paid->refresh()->status)->toBe(Invoice::STATUS_PAID);
});

test('payment reminder is emailed for invoices due in 3 days', function () {
    Mail::fake();

    $customer = \App\Models\Customer::factory()->create(['email' => 'client@example.com']);
    $project = Project::factory()->create(['customer_id' => $customer->id]);

    $dueSoon = Invoice::factory()->for($project)->create([
        'status' => Invoice::STATUS_PENDING,
        'due_date' => now()->addDays(3)->toDateString(),
    ]);

    Invoice::factory()->for($project)->create([
        'status' => Invoice::STATUS_PENDING,
        'due_date' => now()->addDays(10)->toDateString(),
    ]);

    $this->artisan('invoices:send-reminders')->assertExitCode(0);

    // InvoicePaymentReminder implements ShouldQueue, so Mail::send() queues it.
    Mail::assertQueued(\App\Mail\InvoicePaymentReminder::class, function ($mail) use ($dueSoon) {
        return $mail->invoice->is($dueSoon);
    });
    Mail::assertQueuedCount(1);
});
