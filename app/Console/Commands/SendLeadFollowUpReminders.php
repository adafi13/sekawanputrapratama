<?php

namespace App\Console\Commands;

use App\Models\Lead;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class SendLeadFollowUpReminders extends Command
{
    protected $signature = 'leads:send-followup-reminders';

    protected $description = 'Notify the sales team about leads that breached the contact/follow-up SLA';

    public function handle(): int
    {
        $notified = 0;

        // SLA: a brand new lead must be contacted within 24 hours.
        $newLeads = Lead::where('status', Lead::STATUS_NEW)
            ->where('created_at', '<=', now()->subHours(24))
            ->get();

        foreach ($newLeads as $lead) {
            $this->notifyLead(
                $lead,
                'Lead belum dihubungi dalam 24 jam',
                "{$lead->company_name} ({$lead->contact_person}) masuk lebih dari 24 jam lalu dan belum dihubungi."
            );
            $notified++;
        }

        // SLA: a sent quotation needs a follow-up within 3-5 days.
        $quotationSentLeads = Lead::where('status', Lead::STATUS_QUOTATION_SENT)
            ->whereNotNull('quotation_sent_at')
            ->where('quotation_sent_at', '<=', now()->subDays(3))
            ->get();

        foreach ($quotationSentLeads as $lead) {
            $this->notifyLead(
                $lead,
                'Follow-up quotation tertunda',
                "Quotation untuk {$lead->company_name} sudah dikirim lebih dari 3 hari lalu tanpa follow-up."
            );
            $notified++;
        }

        $this->info("Done. {$notified} reminder(s) sent.");

        return self::SUCCESS;
    }

    protected function notifyLead(Lead $lead, string $title, string $body): void
    {
        Notification::make()
            ->title($title)
            ->body($body)
            ->warning()
            ->sendToDatabase($this->resolveRecipients($lead));
    }

    /**
     * @return Collection<int, User>
     */
    protected function resolveRecipients(Lead $lead): Collection
    {
        if ($lead->assigned_to) {
            return User::where('id', $lead->assigned_to)->get();
        }

        // Guard against environments where these roles haven't been seeded yet.
        $existingRoles = Role::whereIn('name', ['Super Admin', 'Sales'])->pluck('name');

        if ($existingRoles->isEmpty()) {
            return new Collection();
        }

        return User::role($existingRoles->all())->get();
    }
}
