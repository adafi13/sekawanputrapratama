<?php

namespace App\Observers;

use App\Models\Lead;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\Project;
use App\Models\Contract;
use App\Services\QuotationTemplateService;
use Filament\Notifications\Notification;

class LeadObserver
{
    /**
     * Handle the Lead "updated" event.
     * Auto-create entities when status changes.
     */
    public function updated(Lead $lead): void
    {
        // Check if status was changed
        if (!$lead->wasChanged('status')) {
            return;
        }

        $oldStatus = $lead->getOriginal('status');
        $newStatus = $lead->status;

        // Note: Quotation creation removed - user creates manually via "Create Quotation" button
        // This prevents conflicts with manual quotation creation in CreateQuotation page

        // Auto-create Customer, Project, and Contract when advancing to deal
        if ($newStatus === Lead::STATUS_DEAL && $oldStatus !== Lead::STATUS_DEAL) {
            $this->convertToDeal($lead);
        }
    }

    /**
     * Convert lead to deal: create Customer and Project only.
     * Contract creation moved to manual action with modal confirmation.
     */
    protected function convertToDeal(Lead $lead): void
    {
        // Check if project already exists for this lead
        if ($lead->projects()->exists()) {
            // Project already exists, just notify
            Notification::make()
                ->title('Lead Marked as Deal')
                ->body("Project already exists for this lead.")
                ->info()
                ->send();
            return;
        }
        
        // Create or get customer
        $customer = $this->getOrCreateCustomer($lead);
        
        // Update lead with customer
        if (!$lead->customer_id) {
            $lead->update(['customer_id' => $customer->id]);
        }

        // Create project only (Contract will be created manually via "Create Contract" action)
        $project = Project::create([
            'lead_id' => $lead->id,
            'customer_id' => $customer->id,
            'name' => "Project for {$customer->company_name}",
            'description' => $lead->notes,
            'status' => Project::STATUS_AWAITING_CONTRACT,
            'budget' => $lead->deal_value,
            'assigned_to' => $lead->assigned_to,
            'start_date' => now(),
        ]);

        Notification::make()
            ->title('Project Created Successfully')
            ->body("Project has been created for {$customer->company_name}. **Next: Create Contract** via Actions button.")
            ->success()
            ->duration(10000) // Show for 10 seconds
            ->send();
    }

    /**
     * Get or create customer from lead data.
     */
    protected function getOrCreateCustomer(Lead $lead): Customer
    {
        // Check if lead already has a customer
        if ($lead->customer_id) {
            return $lead->customer;
        }

        // Try to find existing customer by email
        $customer = Customer::where('email', $lead->email)->first();

        if ($customer) {
            return $customer;
        }

        // Create new customer
        return Customer::create([
            'company_name' => $lead->company_name,
            'contact_person' => $lead->contact_person,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'notes' => "Converted from Lead #{$lead->id}",
        ]);
    }
}
