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

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // Status constants
    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_QUOTATION_SENT = 'quotation_sent';
    public const STATUS_NEGOTIATION = 'negotiation';
    public const STATUS_DEAL = 'deal';
    public const STATUS_LOST = 'lost';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New Lead',
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
}
