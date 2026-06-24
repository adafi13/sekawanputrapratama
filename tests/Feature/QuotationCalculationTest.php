<?php

use App\Models\Quotation;
use App\Models\QuotationItem;

test('quotation item total is price minus discount', function () {
    $quotation = Quotation::factory()->create();

    $item = QuotationItem::factory()->for($quotation)->create([
        'unit_price' => 1000000,
        'discount_percent' => 10,
    ]);

    expect((float) $item->fresh()->total)->toBe(900000.0);
});

test('quotation grand total sums items, applies discount and tax', function () {
    $quotation = Quotation::factory()->create([
        'discount_percentage' => 10,
        'include_tax' => true,
        'tax_percentage' => 11,
    ]);

    QuotationItem::factory()->for($quotation)->create([
        'unit_price' => 1000000,
        'discount_percent' => 0,
    ]);

    QuotationItem::factory()->for($quotation)->create([
        'unit_price' => 500000,
        'discount_percent' => 0,
    ]);

    $quotation->refresh();

    // subtotal: 1,500,000 ; discount 10% = 150,000 ; after discount = 1,350,000 ; tax 11% = 148,500
    expect((float) $quotation->subtotal)->toBe(1500000.0)
        ->and((float) $quotation->discount_amount)->toBe(150000.0)
        ->and((float) $quotation->tax_amount)->toBe(148500.0)
        ->and((float) $quotation->grand_total)->toBe(1498500.0);
});

test('deleting a quotation item recalculates the quotation total', function () {
    $quotation = Quotation::factory()->create();

    $item = QuotationItem::factory()->for($quotation)->create(['unit_price' => 1000000]);
    QuotationItem::factory()->for($quotation)->create(['unit_price' => 500000]);

    $item->delete();

    expect((float) $quotation->refresh()->subtotal)->toBe(500000.0);
});
