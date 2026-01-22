<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'status',
        'source',
        'notes',
        'quotation_notes',
        'deal_value',
        'assigned_to',
        'contacted_at',
        'quotation_sent_at',
        'deal_closed_at',
    ];

    protected $casts = [
        'deal_value' => 'decimal:2',
        'contacted_at' => 'datetime',
        'quotation_sent_at' => 'datetime',
        'deal_closed_at' => 'datetime',
    ];

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    // Status constants
    public const STATUS_NEW = 'new';
    public const STATUS_QUALIFIED = 'qualified';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_QUOTATION_SENT = 'quotation_sent';
    public const STATUS_NEGOTIATION = 'negotiation';
    public const STATUS_DEAL = 'deal';
    public const STATUS_LOST = 'lost';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New Lead',
            self::STATUS_QUALIFIED => 'Qualified',
            self::STATUS_CONTACTED => 'Contacted',
            self::STATUS_QUOTATION_SENT => 'Quotation Sent',
            self::STATUS_NEGOTIATION => 'Negotiation',
            self::STATUS_DEAL => 'Deal Won',
            self::STATUS_LOST => 'Lost',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::getStatuses()[$this->status] ?? $this->status;
    }

    /**
     * Get the next sequential status for this lead.
     */
    public function getNextStatus(): ?string
    {
        return match($this->status) {
            self::STATUS_NEW => self::STATUS_QUALIFIED,
            self::STATUS_QUALIFIED => self::STATUS_CONTACTED,
            self::STATUS_CONTACTED => self::STATUS_QUOTATION_SENT,
            self::STATUS_QUOTATION_SENT => self::STATUS_NEGOTIATION,
            self::STATUS_NEGOTIATION => self::STATUS_DEAL,
            default => null, // Terminal states: deal, lost
        };
    }

    /**
     * Get the previous status for this lead (for backward movement).
     */
    public function getPreviousStatus(): ?string
    {
        return match($this->status) {
            self::STATUS_QUALIFIED => self::STATUS_NEW,
            self::STATUS_CONTACTED => self::STATUS_QUALIFIED,
            self::STATUS_QUOTATION_SENT => self::STATUS_CONTACTED,
            self::STATUS_NEGOTIATION => self::STATUS_QUOTATION_SENT,
            self::STATUS_DEAL => self::STATUS_NEGOTIATION,
            default => null, // Cannot go back from new or lost
        };
    }

    /**
     * Check if this lead can advance to next stage.
     */
    public function canAdvanceToNextStage(): bool
    {
        return $this->getNextStatus() !== null;
    }

    /**
     * Check if status change is valid (sequential or backward).
     */
    public function isValidStatusChange(string $newStatus): bool
    {
        // Allow moving to lost from any status except deal
        if ($newStatus === self::STATUS_LOST && $this->status !== self::STATUS_DEAL) {
            return true;
        }

        // Allow moving forward to next status
        if ($newStatus === $this->getNextStatus()) {
            return true;
        }

        // Allow moving backward to previous status
        if ($newStatus === $this->getPreviousStatus()) {
            return true;
        }

        return false;
    }
}
