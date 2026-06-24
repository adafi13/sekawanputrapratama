<?php

use App\Models\Quotation;

test('sent quotations past valid_until are marked expired', function () {
    $expired = Quotation::factory()->create([
        'status' => Quotation::STATUS_SENT,
        'valid_until' => now()->subDay()->toDateString(),
    ]);

    $stillValid = Quotation::factory()->create([
        'status' => Quotation::STATUS_SENT,
        'valid_until' => now()->addDays(5)->toDateString(),
    ]);

    $this->artisan('quotations:expire')->assertExitCode(0);

    expect($expired->refresh()->status)->toBe(Quotation::STATUS_EXPIRED)
        ->and($stillValid->refresh()->status)->toBe(Quotation::STATUS_SENT);
});

test('accepted quotations are never auto-expired', function () {
    $accepted = Quotation::factory()->create([
        'status' => Quotation::STATUS_ACCEPTED,
        'valid_until' => now()->subDays(10)->toDateString(),
    ]);

    $this->artisan('quotations:expire')->assertExitCode(0);

    expect($accepted->refresh()->status)->toBe(Quotation::STATUS_ACCEPTED);
});
