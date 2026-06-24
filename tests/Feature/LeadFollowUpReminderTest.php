<?php

use App\Models\Lead;
use App\Models\User;
use Spatie\Permission\Models\Role;

test('an unassigned stale new lead notifies sales users', function () {
    Role::firstOrCreate(['name' => 'Sales']);
    $salesUser = User::factory()->create();
    $salesUser->assignRole('Sales');

    $staleLead = Lead::factory()->create([
        'status' => Lead::STATUS_NEW,
        'created_at' => now()->subHours(30),
    ]);

    $this->artisan('leads:send-followup-reminders')->assertExitCode(0);

    expect($salesUser->fresh()->unreadNotifications()->count())->toBe(1);
});

test('an assigned stale lead notifies only the assigned user', function () {
    $assignee = User::factory()->create();
    $otherSalesUser = User::factory()->create();

    Lead::factory()->create([
        'status' => Lead::STATUS_NEW,
        'created_at' => now()->subHours(30),
        'assigned_to' => $assignee->id,
    ]);

    $this->artisan('leads:send-followup-reminders')->assertExitCode(0);

    expect($assignee->fresh()->unreadNotifications()->count())->toBe(1)
        ->and($otherSalesUser->fresh()->unreadNotifications()->count())->toBe(0);
});

test('a fresh new lead does not trigger a reminder', function () {
    $assignee = User::factory()->create();

    Lead::factory()->create([
        'status' => Lead::STATUS_NEW,
        'created_at' => now(),
        'assigned_to' => $assignee->id,
    ]);

    $this->artisan('leads:send-followup-reminders')->assertExitCode(0);

    expect($assignee->fresh()->unreadNotifications()->count())->toBe(0);
});

test('a quotation sent lead overdue for follow-up notifies the assignee', function () {
    $assignee = User::factory()->create();

    Lead::factory()->create([
        'status' => Lead::STATUS_QUOTATION_SENT,
        'quotation_sent_at' => now()->subDays(4),
        'assigned_to' => $assignee->id,
    ]);

    $this->artisan('leads:send-followup-reminders')->assertExitCode(0);

    expect($assignee->fresh()->unreadNotifications()->count())->toBe(1);
});
