<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    use HasFactory;

    // Status constants
    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_REVISED = 'revised';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'quotation_number',
        'lead_id',
        'customer_id',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'valid_until',
        'status',
        'file_path',
        'notes',
        // Rich Text Content
        'opening_content',
        'closing_content',
        // PDF Quotation Fields
        'discount_percentage',
        'include_tax',
        'tax_percentage',
        'grand_total',
        'payment_term_1_percentage',
        'payment_term_1_description',
        'payment_term_2_percentage',
        'payment_term_2_description',
        'payment_term_3_percentage',
        'payment_term_3_description',
        'revision_rounds',
        'revision_notes',
        'validity_days',
        'prepared_by',
        'prepared_by_position',
        'sales_pic',
        'terms_and_conditions',
        'pdf_path',
        'pdf_generated_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'valid_until' => 'date',
        'discount_percentage' => 'decimal:2',
        'include_tax' => 'boolean',
        'tax_percentage' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'payment_term_1_percentage' => 'decimal:2',
        'payment_term_2_percentage' => 'decimal:2',
        'payment_term_3_percentage' => 'decimal:2',
        'revision_rounds' => 'integer',
        'validity_days' => 'integer',
        'terms_and_conditions' => 'array',
        'pdf_generated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            if (empty($quotation->quotation_number)) {
                $quotation->quotation_number = $quotation->generateQuotationNumber();
            }
        });
    }

    /**
     * Generate unique quotation number in format QUO-YYYYMM-0001
     */
    public function generateQuotationNumber(): string
    {
        $prefix = 'QUO-' . now()->format('Ym') . '-';
        
        $lastQuotation = static::where('quotation_number', 'like', $prefix . '%')
            ->orderBy('quotation_number', 'desc')
            ->first();

        if ($lastQuotation) {
            $lastNumber = (int) substr($lastQuotation->quotation_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Calculate totals from quotation items
     */
    public function calculateTotals(): void
    {
        $items = $this->items;
        
        $this->subtotal = $items->sum('total');
        $this->tax_amount = $this->subtotal * 0.11; // 11% PPN
        $this->total_amount = $this->subtotal + $this->tax_amount - $this->discount_amount;
        
        $this->save();
    }

    /**
     * Get the lead that owns this quotation.
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the customer that owns this quotation.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get all items for this quotation.
     */
    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class)->orderBy('sort_order');
    }

    /**
     * Get all available statuses.
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_SENT => 'Sent to Client',
            self::STATUS_REVISED => 'Revised',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    /**
     * Get status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'gray',
            self::STATUS_SENT => 'blue',
            self::STATUS_REVISED => 'yellow',
            self::STATUS_ACCEPTED => 'success',
            self::STATUS_REJECTED => 'danger',
            default => 'gray',
        };
    }

    /**
     * Get default terms and conditions.
     */
    public static function getDefaultTerms(): array
    {
        return [
            'payment' => 'Payment terms as specified in the payment schedule',
            'validity' => 'This quotation is valid for 30 days from the date of issue',
            'changes' => 'Changes to project scope may affect the quoted price',
            'warranty' => 'All work comes with a standard warranty period',
            'cancellation' => 'Cancellation policy applies as per agreement',
        ];
    }
}
