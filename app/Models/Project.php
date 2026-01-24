<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'customer_id',
        'contract_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'budget',
        'assigned_to',
        'completion_percentage',
        'contract_signed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
        'completion_percentage' => 'integer',
        'contract_signed_at' => 'datetime',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    // Status constants - Aligned with Payment Terms Workflow
    public const STATUS_AWAITING_DP = 'awaiting_dp';           // After contract signed, waiting for DP payment
    public const STATUS_PLANNING = 'planning';                  // After DP paid, project planning phase
    public const STATUS_DEVELOPMENT_PHASE_1 = 'dev_phase_1';   // Initial development (30-50% completion)
    public const STATUS_DEVELOPMENT_PHASE_2 = 'dev_phase_2';   // Advanced development (50-90% completion)
    public const STATUS_UAT = 'uat';                            // User Acceptance Testing
    public const STATUS_DEPLOYMENT = 'deployment';              // Waiting for final payment to deploy
    public const STATUS_COMPLETED = 'completed';                // Project delivered and completed
    public const STATUS_ON_HOLD = 'on_hold';                    // Project paused
    public const STATUS_CANCELLED = 'cancelled';                // Project cancelled
    
    // Legacy status for backward compatibility
    public const STATUS_AWAITING_CONTRACT = 'awaiting_contract'; // Deprecated: use AWAITING_DP
    public const STATUS_IN_PROGRESS = 'in_progress';             // Deprecated: use DEV_PHASE_1 or DEV_PHASE_2

    public static function getStatuses(): array
    {
        return [
            self::STATUS_AWAITING_DP => 'Awaiting DP Payment',
            self::STATUS_PLANNING => 'Planning',
            self::STATUS_DEVELOPMENT_PHASE_1 => 'Development - Phase 1',
            self::STATUS_DEVELOPMENT_PHASE_2 => 'Development - Phase 2',
            self::STATUS_UAT => 'UAT (Testing)',
            self::STATUS_DEPLOYMENT => 'Ready for Deployment',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_ON_HOLD => 'On Hold',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    /**
     * Get the next sequential status for this project.
     */
    public function getNextStatus(): ?string
    {
        return match($this->status) {
            self::STATUS_AWAITING_CONTRACT => self::STATUS_AWAITING_DP, // Legacy support
            self::STATUS_AWAITING_DP => self::STATUS_PLANNING,
            self::STATUS_PLANNING => self::STATUS_DEVELOPMENT_PHASE_1,
            self::STATUS_DEVELOPMENT_PHASE_1 => self::STATUS_DEVELOPMENT_PHASE_2,
            self::STATUS_DEVELOPMENT_PHASE_2 => self::STATUS_UAT,
            self::STATUS_UAT => self::STATUS_DEPLOYMENT,
            self::STATUS_DEPLOYMENT => self::STATUS_COMPLETED,
            self::STATUS_IN_PROGRESS => self::STATUS_UAT, // Legacy support
            default => null, // Terminal states or manual states
        };
    }

    /**
     * Get the previous status for this project (for backward movement).
     */
    public function getPreviousStatus(): ?string
    {
        return match($this->status) {
            self::STATUS_PLANNING => self::STATUS_AWAITING_DP,
            self::STATUS_DEVELOPMENT_PHASE_1 => self::STATUS_PLANNING,
            self::STATUS_DEVELOPMENT_PHASE_2 => self::STATUS_DEVELOPMENT_PHASE_1,
            self::STATUS_UAT => self::STATUS_DEVELOPMENT_PHASE_2,
            self::STATUS_DEPLOYMENT => self::STATUS_UAT,
            self::STATUS_COMPLETED => self::STATUS_DEPLOYMENT,
            // Legacy support
            self::STATUS_IN_PROGRESS => self::STATUS_PLANNING,
            default => null,
        };
    }

    /**
     * Check if this project can advance to next stage.
     * Now includes payment gating logic.
     */
    public function canAdvanceToNextStage(): bool
    {
        // Cannot advance if no next status
        if ($this->getNextStatus() === null) {
            return false;
        }

        // Legacy: Cannot advance from Awaiting Contract if contract not signed
        if ($this->status === self::STATUS_AWAITING_CONTRACT) {
            return $this->contract && $this->contract->status === Contract::STATUS_ACTIVE;
        }
        
        // Payment gating logic
        return match($this->status) {
            // Termin 1 (DP 30%): Must be paid before starting Planning
            self::STATUS_AWAITING_DP => $this->hasInvoicePaid('dp'),
            
            // Termin 2 (Progress 40%): Must be paid before starting UAT
            self::STATUS_DEVELOPMENT_PHASE_2 => $this->hasInvoicePaid('progress'),
            
            // Termin 3 (Final 30%): Must be paid before Deployment
            self::STATUS_UAT => $this->hasInvoicePaid('final'),
            
            // Other stages don't require payment to advance
            default => true,
        };
    }
    
    /**
     * Check if specific payment stage invoice is paid.
     */
    public function hasInvoicePaid(string $stage): bool
    {
        return $this->invoices()
            ->where('payment_stage', $stage)
            ->where('status', Invoice::STATUS_PAID)
            ->exists();
    }
    
    /**
     * Get payment stage for invoice generation based on project status.
     * Generates invoice when entering the stage that requires payment.
     */
    public function getPaymentStageForInvoice(): ?string
    {
        return match($this->status) {
            // DP invoice: Generated when project created (awaiting DP payment)
            self::STATUS_AWAITING_DP => 'dp',
            
            // Progress invoice: Generated at Phase 1 completion (need payment before UAT)
            self::STATUS_DEVELOPMENT_PHASE_2 => 'progress',
            
            // Final invoice: Generated when UAT ready (need payment before deployment)
            self::STATUS_UAT => 'final',
            
            default => null,
        };
    }

    /**
     * Check if project can create invoice (contract must be signed).
     */
    public function canCreateInvoice(): bool
    {
        return $this->contract && $this->contract->status === Contract::STATUS_ACTIVE;
    }
}
