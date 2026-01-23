<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'invoice_number',
        'stage',
        'amount',
        'due_date',
        'status',
        'paid_at',
        'notes',
        'payment_method',
        'payment_proof_path',
        'bank_account',
        'paid_by',
        'payment_notes',
        'pdf_path',
        'pdf_generated_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'pdf_generated_at' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')
            ->withDefault(function () {
                return $this->project?->customer;
            });
    }

    // Payment method constants
    public const PAYMENT_BANK_TRANSFER_BCA = 'bank_transfer_bca';
    public const PAYMENT_BANK_TRANSFER_MANDIRI = 'bank_transfer_mandiri';
    public const PAYMENT_CASH = 'cash';
    public const PAYMENT_CHECK = 'check';
    public const PAYMENT_CREDIT_CARD = 'credit_card';

    public static function getPaymentMethods(): array
    {
        return [
            self::PAYMENT_BANK_TRANSFER_BCA => 'Bank Transfer - BCA',
            self::PAYMENT_BANK_TRANSFER_MANDIRI => 'Bank Transfer - Mandiri',
            self::PAYMENT_CASH => 'Cash',
            self::PAYMENT_CHECK => 'Check',
            self::PAYMENT_CREDIT_CARD => 'Credit Card',
        ];
    }

    // Stage constants
    public const STAGE_DP = 'dp';
    public const STAGE_PROGRESS = 'progress';
    public const STAGE_FINAL = 'final';

    public static function getStages(): array
    {
        return [
            self::STAGE_DP => 'Down Payment (DP)',
            self::STAGE_PROGRESS => 'Progress Payment',
            self::STAGE_FINAL => 'Final Payment',
        ];
    }

    // Status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_SENT = 'sent';
    public const STATUS_PAID = 'paid';
    public const STATUS_OVERDUE = 'overdue';
    public const STATUS_CANCELLED = 'cancelled';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_SENT => 'Sent',
            self::STATUS_PAID => 'Paid',
            self::STATUS_OVERDUE => 'Overdue',
            self::STATUS_CANCELLED => 'Cancelled',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = self::generateInvoiceNumber();
            }
        });
    }

    public static function generateInvoiceNumber(): string
    {
        $year = now()->format('Y');
        $month = now()->format('m');
        $lastInvoice = self::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->orderBy('id', 'desc')
            ->first();

        $number = $lastInvoice ? (int) substr($lastInvoice->invoice_number, -4) + 1 : 1;

        return sprintf('INV-%s%s-%04d', $year, $month, $number);
    }
}
