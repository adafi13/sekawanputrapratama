<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// CRM workflow automation - requires a cron entry calling `schedule:run` every minute (see docs/DEPLOY_CPANEL.md).
Schedule::command('invoices:mark-overdue')->daily();
Schedule::command('invoices:send-reminders')->dailyAt('08:00');
Schedule::command('quotations:expire')->daily();
Schedule::command('leads:send-followup-reminders')->dailyAt('09:00');
