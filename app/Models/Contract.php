<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    use HasFactory;

    // Status constants
    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_SIGNED = 'signed';
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_TERMINATED = 'terminated';

    // Project type constants
    const TYPE_BUY_OUT = 'buy_out';
    const TYPE_MANAGED_SERVICE = 'managed_service';

    // Maintenance cycle constants
    const CYCLE_MONTHLY = 'monthly';
    const CYCLE_YEARLY = 'yearly';

    protected $fillable = [
        'contract_number',
        'project_id',
        'customer_id',
        'quotation_id',
        'contract_value',
        'start_date',
        'end_date',
        'terms',
        'file_path',
        'status',
        'signed_at',
        'project_type',
        'warranty_period',
        'estimated_duration',
        'payment_terms',
        'maintenance_fee',
        'maintenance_cycle',
        'deliverables',
    ];

    protected $casts = [
        'contract_value' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'signed_at' => 'datetime',
        'maintenance_fee' => 'decimal:2',
        'payment_terms' => 'array',
        'warranty_period' => 'integer',
        'estimated_duration' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contract) {
            if (empty($contract->contract_number)) {
                $contract->contract_number = $contract->generateContractNumber();
            }
        });
    }

    /**
     * Generate unique contract number in format CTR-YYYYMM-0001
     */
    public function generateContractNumber(): string
    {
        $prefix = 'CTR-' . now()->format('Ym') . '-';
        
        $lastContract = static::where('contract_number', 'like', $prefix . '%')
            ->orderBy('contract_number', 'desc')
            ->first();

        if ($lastContract) {
            $lastNumber = (int) substr($lastContract->contract_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get the project that owns this contract.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the customer that owns this contract.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the quotation that this contract is based on.
     */
    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Get all available statuses.
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_SENT => 'Sent to Client',
            self::STATUS_SIGNED => 'Signed',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_TERMINATED => 'Terminated',
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
            self::STATUS_SIGNED => 'info',
            self::STATUS_ACTIVE => 'success',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_TERMINATED => 'danger',
            default => 'gray',
        };
    }

    /**
     * Get default contract terms template.
     */
    public static function getDefaultTerms(Customer $customer): string
    {
        $companyName = $customer->company_name;
        
        return <<<EOT
PERJANJIAN KERJA SAMA
Antara PT Sekawan Putra Pratama dan {$companyName}

PASAL 1: RUANG LINGKUP PEKERJAAN
Pihak Kedua setuju untuk menyediakan layanan sesuai dengan spesifikasi yang telah disepakati dalam penawaran.

PASAL 2: JANGKA WAKTU
Pekerjaan ini akan dimulai pada tanggal yang ditentukan dan diselesaikan sesuai dengan timeline yang telah disepakati.

PASAL 3: NILAI KONTRAK
Nilai total kontrak ini adalah sebagaimana yang tertera dalam sistem, yang akan dibayarkan sesuai dengan termin pembayaran yang disepakati.

PASAL 4: PEMBAYARAN
- Down Payment (DP): 30% dari nilai kontrak
- Progress Payment: 40% dari nilai kontrak
- Final Payment: 30% dari nilai kontrak

PASAL 5: HAK DAN KEWAJIBAN
Kedua belah pihak setuju untuk melaksanakan tugas dan tanggung jawab masing-masing dengan itikad baik.

PASAL 6: PENYELESAIAN PERSELISIHAN
Setiap perselisihan akan diselesaikan secara musyawarah. Jika tidak tercapai kesepakatan, akan diselesaikan melalui jalur hukum yang berlaku.

PASAL 7: PENUTUP
Perjanjian ini dibuat dalam rangkap 2 (dua) dan memiliki kekuatan hukum yang sama.
EOT;
    }
}
