<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     * Note: DP invoice is generated when contract is signed, not when project is created.
     */
    public function created(Project $project): void
    {
        // DP invoice will be generated when contract is signed via Sign Contract action
        // So we don't generate invoice here anymore
        Log::info("Project {$project->id} created with status {$project->status}. Invoice will be generated after contract signing.");
    }

    /**
     * Handle the Project "updated" event.
     * Auto-generate invoices when project advances to payment stages.
     */
    public function updated(Project $project): void
    {
        // Check if status has changed
        if ($project->isDirty('status')) {
            $this->generateInvoiceIfNeeded($project);
        }
    }
    
    /**
     * Generate invoice if project is at a payment stage and invoice doesn't exist yet.
     */
    protected function generateInvoiceIfNeeded(Project $project): void
    {
        // Get payment stage for current status
        $paymentStage = $project->getPaymentStageForInvoice();
        
        // Only proceed if this status requires invoice
        if (!$paymentStage) {
            return;
        }
        
        // Check if invoice already exists for this payment stage
        $existingInvoice = $project->invoices()
            ->where('payment_stage', $paymentStage)
            ->first();
            
        if ($existingInvoice) {
            Log::info("Invoice already exists for project {$project->id} payment stage {$paymentStage}");
            return;
        }
        
        // Get contract to determine invoice amount
        $contract = $project->contract;
        
        // Calculate invoice amount from payment terms
        $paymentTerms = $contract->payment_terms ?? [];
        $invoiceAmount = 0;
        $termDescription = '';
        
        // If contract exists, use payment terms from contract
        if ($contract && !empty($paymentTerms)) {
            foreach ($paymentTerms as $index => $term) {
                // DP = first term, Progress = second term, Final = third term
                if (($paymentStage === 'dp' && $index === 0) ||
                    ($paymentStage === 'progress' && $index === 1) ||
                    ($paymentStage === 'final' && $index === 2)) {
                    
                    $percentage = $term['percentage'] ?? 0;
                    $invoiceAmount = ($contract->contract_value * $percentage) / 100;
                    $termDescription = $term['description'] ?? "Termin " . ($index + 1);
                    break;
                }
            }
        } else {
            // Fallback: Use project budget with standard percentages if no contract
            Log::info("No contract found for project {$project->id}, using project budget with standard terms");
            
            $baseAmount = $project->budget ?? 0;
            $standardPercentages = [
                'dp' => ['percentage' => 30, 'description' => 'Down Payment (DP)'],
                'progress' => ['percentage' => 40, 'description' => 'Progress Payment'],
                'final' => ['percentage' => 30, 'description' => 'Final Payment'],
            ];
            
            if (isset($standardPercentages[$paymentStage])) {
                $invoiceAmount = ($baseAmount * $standardPercentages[$paymentStage]['percentage']) / 100;
                $termDescription = $standardPercentages[$paymentStage]['description'];
            }
        }
        
        if ($invoiceAmount <= 0) {
            Log::warning("Cannot generate invoice for project {$project->id}: Invalid amount");
            return;
        }
        
        // Generate invoice number
        $invoiceNumber = $this->generateInvoiceNumber();
        
        // Create invoice
        $invoice = Invoice::create([
            'project_id' => $project->id,
            'invoice_number' => $invoiceNumber,
            'payment_stage' => $paymentStage,
            'amount' => $invoiceAmount,
            'status' => Invoice::STATUS_PENDING,
            'issue_date' => now(),
            'due_date' => now()->addDays(14), // 14 days payment term
            'notes' => "Pembayaran {$termDescription}",
        ]);
        
        Log::info("Auto-generated invoice {$invoiceNumber} for project {$project->id}, stage {$paymentStage}, amount {$invoiceAmount}");
    }
    
    /**
     * Generate unique invoice number.
     */
    protected function generateInvoiceNumber(): string
    {
        $year = date('Y');
        $month = date('m');
        
        // Count invoices this month
        $count = Invoice::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count() + 1;
            
        return sprintf('INV-%s%s-%04d', $year, $month, $count);
    }
}
