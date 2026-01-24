<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationItem extends Model
{
    use HasFactory;

    // Item type constants
    const TYPE_SERVICE = 'service';
    const TYPE_PRODUCT = 'product';
    const TYPE_CUSTOM = 'custom';

    protected $fillable = [
        'quotation_id',
        'item_type',
        'name',
        'description',
        'unit_price',
        'discount_percent',
        'total',
        'sort_order',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'discount_percent' => 'decimal:2',
        'total' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Auto-calculate total before saving
        static::saving(function ($item) {
            $subtotal = $item->quantity * $item->unit_price;
            $discount = $subtotal * ($item->discount_percent / 100);
            $item->total = $subtotal - $discount;
        });

        // Recalculate quotation totals after save/delete
        static::saved(function ($item) {
            $item->quotation->calculateTotals();
        });

        static::deleted(function ($item) {
            $item->quotation->calculateTotals();
        });
    }

    /**
     * Get the quotation that owns this item.
     */
    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Get all available item types.
     */
    public static function getItemTypes(): array
    {
        return [
            self::TYPE_SERVICE => 'Service',
            self::TYPE_PRODUCT => 'Product',
            self::TYPE_CUSTOM => 'Custom Item',
        ];
    }
}
