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

    // Status constants
    public const STATUS_AWAITING_CONTRACT = 'awaiting_contract';
    public const STATUS_PLANNING = 'planning';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_ON_HOLD = 'on_hold';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_AWAITING_CONTRACT => 'Awaiting Contract',
            self::STATUS_PLANNING => 'Planning',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_ON_HOLD => 'On Hold',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    /**
     * Get the next sequential status for this project.
     */
    public function getNextStatus(): ?string
    {
        return match($this->status) {
            self::STATUS_AWAITING_CONTRACT => self::STATUS_PLANNING,
            self::STATUS_PLANNING => self::STATUS_IN_PROGRESS,
            self::STATUS_IN_PROGRESS => self::STATUS_COMPLETED,
            default => null, // Terminal states or manual states
        };
    }

    /**
     * Get the previous status for this project (for backward movement).
     */
    public function getPreviousStatus(): ?string
    {
        return match($this->status) {
            self::STATUS_PLANNING => self::STATUS_AWAITING_CONTRACT,
            self::STATUS_IN_PROGRESS => self::STATUS_PLANNING,
            self::STATUS_COMPLETED => self::STATUS_IN_PROGRESS,
            default => null,
        };
    }

    /**
     * Check if this project can advance to next stage.
     */
    public function canAdvanceToNextStage(): bool
    {
        // Cannot advance if no next status
        if ($this->getNextStatus() === null) {
            return false;
        }

        // Cannot advance from Awaiting Contract if contract not signed
        if ($this->status === self::STATUS_AWAITING_CONTRACT) {
            return $this->contract && $this->contract->status === Contract::STATUS_ACTIVE;
        }

        return true;
    }

    /**
     * Check if project can create invoice (contract must be signed).
     */
    public function canCreateInvoice(): bool
    {
        return $this->contract && $this->contract->status === Contract::STATUS_ACTIVE;
    }
}
