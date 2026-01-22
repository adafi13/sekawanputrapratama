<?php

namespace App\Filament\Resources\Quotations\Schemas;

use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Services\QuotationTemplateService;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class QuotationForm
{
    public static function getSchema(): array
    {
        return [
            // WADAH KERTAS A4 - Document Mode
            Section::make()
                ->schema([
                    // 1. KOP SURAT
                    Placeholder::make('letterhead')
                        ->hiddenLabel()
                        ->content(new \Illuminate\Support\HtmlString('
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 3px solid #2563eb; padding-bottom: 20px; margin-bottom: 30px;">
                                <div>
                                    <h1 style="font-size: 28px; font-weight: bold; color: #2563eb; margin: 0;">PT. SEKAWAN PUTRA PRATAMA</h1>
                                    <p style="margin: 8px 0 0 0; color: #64748b; font-size: 13px;">
                                        Jl. Contoh Alamat No. 123, Jakarta<br>
                                        Phone: +62 21 1234567 | Email: info@spp.com
                                    </p>
                                </div>
                                <div style="text-align: right;">
                                    <h2 style="font-size: 36px; font-weight: bold; color: #2563eb; margin: 0;">QUOTATION</h2>
                                    <p style="color: #94a3b8; font-size: 12px; margin: 5px 0 0 0;">Auto-generated</p>
                                </div>
                            </div>
                        ')),

                    // 2. META DATA
                    Grid::make(3)
                        ->schema([
                            TextInput::make('quotation_number')
                                ->label('Quotation No.')
                                ->disabled()
                                ->dehydrated(false)
                                ->placeholder('Auto-generated')
                                ->helperText('System will generate automatically'),
                            DatePicker::make('valid_until')
                                ->label('Valid Until')
                                ->default(now()->addDays(30))
                                ->required()
                                ->native(false)
                                ->displayFormat('d F Y')
                                ->minDate(now())
                                ->helperText('Default 30 days from today'),
                            Select::make('status')
                                ->label('Status')
                                ->options(Quotation::getStatuses())
                                ->default(Quotation::STATUS_DRAFT)
                                ->required()
                                ->helperText('Current quotation status'),
                        ]),

                    Grid::make(2)
                        ->schema([
                            Select::make('lead_id')
                                ->label('From Lead')
                                ->relationship('lead', 'company_name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->live()
                                ->helperText('Select lead to auto-fill customer')
                                ->afterStateUpdated(function (Set $set, $state) {
                                    if ($state) {
                                        $lead = \App\Models\Lead::find($state);
                                        if ($lead && $lead->customer_id) {
                                            $set('customer_id', $lead->customer_id);
                                            \Filament\Notifications\Notification::make()
                                                ->title('Customer auto-filled')
                                                ->success()
                                                ->send();
                                        }
                                    }
                                }),
                            Select::make('customer_id')
                                ->label('To Customer')
                                ->relationship('customer', 'company_name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->helperText('Final recipient of quotation'),
                        ]),

                    // 3. OPENING CONTENT
                    \Filament\Forms\Components\RichEditor::make('opening_content')
                        ->label('Opening Message')
                        ->toolbarButtons(['bold', 'italic', 'underline', 'bulletList', 'orderedList', 'h2', 'h3'])
                        ->default('<p>Kepada Yth. <strong>[Nama Client]</strong>,</p><p>Dengan hormat,</p><p>Kami dari <strong>PT. Sekawan Putra Pratama</strong> mengajukan penawaran harga untuk project yang Bapak/Ibu rencanakan dengan detail sebagai berikut:</p>')
                        ->helperText('Professional opening greeting - edit to match client name')
                        ->columnSpanFull(),

                    // 4. ITEMS TABLE
                    Placeholder::make('items_header')
                        ->hiddenLabel()
                        ->content(new \Illuminate\Support\HtmlString('
                            <div style="margin-top: 35px; margin-bottom: 15px;">
                                <h3 style="font-weight: 700; font-size: 14px; color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">
                                    📋 BILL OF QUANTITIES
                                </h3>
                            </div>
                        ')),

                    Select::make('template_selector')
                        ->label('Quick Load Template')
                        ->options(QuotationTemplateService::getTemplateOptions())
                        ->placeholder('Select template to auto-fill items...')
                        ->helperText('Save time by loading pre-defined item lists')
                        ->live()
                        ->afterStateUpdated(function ($state, Set $set) {
                            if (!$state) return;
                            $templates = QuotationTemplateService::getTemplates();
                            $template = $templates[$state] ?? null;
                            if ($template) {
                                $set('items', $template['items']);
                                \Filament\Notifications\Notification::make()
                                    ->title('Template loaded successfully')
                                    ->body(count($template['items']) . ' items added to quotation')
                                    ->success()
                                    ->send();
                            }
                        })
                        ->dehydrated(false),
                    
                    Repeater::make('items')
                        ->relationship()
                        ->hiddenLabel()
                        ->schema([
                            Grid::make(12)->schema([
                                Select::make('item_type')
                                    ->hiddenLabel()
                                    ->options(QuotationItem::getItemTypes())
                                    ->default(QuotationItem::TYPE_SERVICE)
                                    ->required()
                                    ->columnSpan(2),
                                TextInput::make('name')
                                    ->hiddenLabel()
                                    ->placeholder('Item / Service Name')
                                    ->required()
                                    ->columnSpan(4),
                                TextInput::make('unit_price')
                                    ->hiddenLabel()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->placeholder('Price')
                                    ->required()
                                    ->minValue(0)
                                    ->maxValue(999999999999)
                                    ->live()
                                    ->columnSpan(2),
                                TextInput::make('discount_percent')
                                    ->hiddenLabel()
                                    ->numeric()
                                    ->suffix('%')
                                    ->default(0)
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->placeholder('Disc')
                                    ->live()
                                    ->columnSpan(2),
                                Placeholder::make('item_total')
                                    ->hiddenLabel()
                                    ->content(function (Get $get) {
                                        $unitPrice = floatval($get('unit_price') ?? 0);
                                        $discountPercent = floatval($get('discount_percent') ?? 0);
                                        $discount = $unitPrice * ($discountPercent / 100);
                                        $total = $unitPrice - $discount;
                                        return new \Illuminate\Support\HtmlString('<div style="text-align: right; font-weight: 600;">Rp ' . number_format($total, 0, ',', '.') . '</div>');
                                    })
                                    ->columnSpan(2),
                            ]),
                            Textarea::make('description')
                                ->hiddenLabel()
                                ->placeholder('Detail description (optional)...')
                                ->rows(1)
                                ->columnSpanFull(),
                        ])
                        ->reorderable('sort_order')
                        ->collapsible()
                        ->collapsed(false)
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'New Item')
                        ->addActionLabel('Add New Item')
                        ->defaultItems(1)
                        ->minItems(1)
                        ->live()
                        ->columnSpanFull()
                        ->cloneable(),

                    // 5. PRICING SUMMARY
                    Section::make()
                        ->schema([
                            Grid::make(2)->schema([
                                Grid::make(1)->schema([
                                    TextInput::make('discount_percentage')
                                        ->label('Global Discount (%)')
                                        ->numeric()
                                        ->default(0)
                                        ->suffix('%')
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->helperText('Applied after item discounts')
                                        ->live(),
                                    Toggle::make('include_tax')
                                        ->label('Include Tax (PPN)')
                                        ->default(false)
                                        ->live()
                                        ->inline(false)
                                        ->helperText('Toggle to add tax calculation'),
                                    TextInput::make('tax_percentage')
                                        ->label('Tax Rate (%)')
                                        ->numeric()
                                        ->default(12)
                                        ->suffix('%')
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->helperText('Default PPN 12%')
                                        ->live()
                                        ->visible(fn (Get $get) => $get('include_tax')),
                                ]),
                                Grid::make(1)->schema([
                                    Placeholder::make('subtotal_display')
                                        ->label('Subtotal')
                                        ->content(function (Get $get) {
                                            $items = $get('items') ?? [];
                                            $subtotal = 0;
                                            foreach ($items as $item) {
                                                $price = floatval($item['unit_price'] ?? 0);
                                                $disc = floatval($item['discount_percent'] ?? 0);
                                                $itemTotal = $price - ($price * ($disc / 100));
                                                $subtotal += $itemTotal;
                                            }
                                            return new \Illuminate\Support\HtmlString('<div style="text-align: right;">Rp ' . number_format($subtotal, 0, ',', '.') . '</div>');
                                        }),
                                    Placeholder::make('discount_display')
                                        ->label('Discount')
                                        ->content(function (Get $get) {
                                            $items = $get('items') ?? [];
                                            $subtotal = 0;
                                            foreach ($items as $item) {
                                                $price = floatval($item['unit_price'] ?? 0);
                                                $disc = floatval($item['discount_percent'] ?? 0);
                                                $itemTotal = $price - ($price * ($disc / 100));
                                                $subtotal += $itemTotal;
                                            }
                                            $discountPercent = floatval($get('discount_percentage') ?? 0);
                                            $discount = $subtotal * ($discountPercent / 100);
                                            return new \Illuminate\Support\HtmlString('<div style="text-align: right; color: #ef4444;">- Rp ' . number_format($discount, 0, ',', '.') . '</div>');
                                        }),
                                    Placeholder::make('tax_display')
                                        ->label('Tax')
                                        ->content(function (Get $get) {
                                            if (!$get('include_tax')) return new \Illuminate\Support\HtmlString('<div style="text-align: right;">-</div>');
                                            $items = $get('items') ?? [];
                                            $subtotal = 0;
                                            foreach ($items as $item) {
                                                $price = floatval($item['unit_price'] ?? 0);
                                                $disc = floatval($item['discount_percent'] ?? 0);
                                                $itemTotal = $price - ($price * ($disc / 100));
                                                $subtotal += $itemTotal;
                                            }
                                            $discountPercent = floatval($get('discount_percentage') ?? 0);
                                            $afterDiscount = $subtotal - ($subtotal * ($discountPercent / 100));
                                            $taxPercent = floatval($get('tax_percentage') ?? 12);
                                            $tax = $afterDiscount * ($taxPercent / 100);
                                            return new \Illuminate\Support\HtmlString('<div style="text-align: right;">+ Rp ' . number_format($tax, 0, ',', '.') . '</div>');
                                        })
                                        ->visible(fn (Get $get) => $get('include_tax')),
                                    Placeholder::make('grand_total_display')
                                        ->label('')
                                        ->content(function (Get $get) {
                                            $items = $get('items') ?? [];
                                            $subtotal = 0;
                                            foreach ($items as $item) {
                                                $price = floatval($item['unit_price'] ?? 0);
                                                $disc = floatval($item['discount_percent'] ?? 0);
                                                $itemTotal = $price - ($price * ($disc / 100));
                                                $subtotal += $itemTotal;
                                            }
                                            $discountPercent = floatval($get('discount_percentage') ?? 0);
                                            $afterDiscount = $subtotal - ($subtotal * ($discountPercent / 100));
                                            $grandTotal = $afterDiscount;
                                            if ($get('include_tax')) {
                                                $taxPercent = floatval($get('tax_percentage') ?? 12);
                                                $tax = $afterDiscount * ($taxPercent / 100);
                                                $grandTotal += $tax;
                                            }
                                            return new \Illuminate\Support\HtmlString('<div style="text-align: right; font-size: 20px; font-weight: 700; color: white; background: #2563eb; padding: 12px 16px; border-radius: 8px; margin-top: 10px;">
                                                        <div style="font-size: 12px; font-weight: 400; margin-bottom: 4px;">GRAND TOTAL</div>
                                                        Rp ' . number_format($grandTotal, 0, ',', '.') . '
                                                    </div>');
                                        }),
                                ]),
                            ]),
                        ])
                        ->extraAttributes(['style' => 'background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;']),

                    // 6. PAYMENT TERMS
                    Placeholder::make('payment_terms_header')
                        ->hiddenLabel()
                        ->content(new \Illuminate\Support\HtmlString('
                            <div style="margin-top: 35px; margin-bottom: 15px;">
                                <h3 style="font-weight: 700; font-size: 14px; color: #1e293b; border-bottom: 2px solid #fbbf24; padding-bottom: 8px;">PAYMENT TERMS</h3>
                            </div>
                        ')),
                    Section::make()
                        ->schema([
                            Grid::make(3)->schema([
                                TextInput::make('payment_term_1_percentage')
                                    ->label('Termin 1 (%)')
                                    ->numeric()
                                    ->default(30)
                                    ->suffix('%')
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->helperText('Down Payment'),
                                TextInput::make('payment_term_2_percentage')
                                    ->label('Termin 2 (%)')
                                    ->numeric()
                                    ->default(40)
                                    ->suffix('%')
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->helperText('Progress Payment'),
                                TextInput::make('payment_term_3_percentage')
                                    ->label('Termin 3 (%)')
                                    ->numeric()
                                    ->default(30)
                                    ->suffix('%')
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->helperText('Final Payment'),
                            ]),
                            Textarea::make('payment_term_1_description')
                                ->label('Termin 1 Details')
                                ->placeholder('e.g., Down Payment after agreement signed')
                                ->rows(2)
                                ->columnSpanFull(),
                            Textarea::make('payment_term_2_description')
                                ->label('Termin 2 Details')
                                ->placeholder('e.g., Progress Payment at 50% project completion')
                                ->rows(2)
                                ->columnSpanFull(),
                            Textarea::make('payment_term_3_description')
                                ->label('Termin 3 Details')
                                ->placeholder('e.g., Final Payment upon project completion & handover')
                                ->rows(2)
                                ->columnSpanFull(),
                        ])
                        ->extraAttributes(['style' => 'background: #fffbeb; padding: 20px; border-radius: 8px; border: 2px solid #fbbf24;']),

                    // 7. REVISION POLICY
                    Placeholder::make('revision_header')
                        ->hiddenLabel()
                        ->content(new \Illuminate\Support\HtmlString('
                            <div style="margin-top: 35px; margin-bottom: 15px;">
                                <h3 style="font-weight: 700; font-size: 14px; color: #1e293b; border-bottom: 2px solid #3b82f6; padding-bottom: 8px;">REVISION POLICY</h3>
                            </div>
                        ')),
                    Section::make()
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('revision_rounds')
                                    ->label('Maximum Revision Rounds')
                                    ->numeric()
                                    ->default(3)
                                    ->minValue(0)
                                    ->maxValue(10)
                                    ->helperText('Free revisions included'),
                                TextInput::make('validity_days')
                                    ->label('Revision Period (Days)')
                                    ->numeric()
                                    ->default(14)
                                    ->minValue(1)
                                    ->maxValue(365)
                                    ->suffix('days')
                                    ->helperText('Valid within X days of delivery'),
                            ]),
                        ])
                        ->extraAttributes(['style' => 'background: #eff6ff; padding: 20px; border-radius: 8px; border: 2px solid #3b82f6;']),

                    // 8. TERMS & CONDITIONS
                    Placeholder::make('terms_header')
                        ->hiddenLabel()
                        ->content(new \Illuminate\Support\HtmlString('
                            <div style="margin-top: 35px; margin-bottom: 15px;">
                                <h3 style="font-weight: 700; font-size: 14px; color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">TERMS & CONDITIONS</h3>
                            </div>
                        ')),
                    CheckboxList::make('terms_and_conditions')
                        ->hiddenLabel()
                        ->options(Quotation::getDefaultTerms())
                        ->default(array_keys(Quotation::getDefaultTerms()))
                        ->columns(1)
                        ->bulkToggleable(),
                    Textarea::make('revision_notes')
                        ->label('Additional Terms')
                        ->placeholder('Any special terms or conditions not covered above...')
                        ->helperText('Optional: Add custom terms specific to this quotation')
                        ->rows(3),

                    // 9. CLOSING CONTENT
                    \Filament\Forms\Components\RichEditor::make('closing_content')
                        ->label('Closing Message & Signature')
                        ->toolbarButtons(['bold', 'italic', 'underline', 'bulletList', 'orderedList', 'h2', 'h3'])
                        ->default('<p>Demikian surat penawaran ini kami sampaikan. Besar harapan kami untuk dapat bekerja sama dengan Bapak/Ibu.</p><p>Apabila ada hal yang perlu didiskusikan lebih lanjut, kami siap untuk mengadakan pertemuan.</p><br><p>Hormat kami,</p><br><br><p><strong>PT. Sekawan Putra Pratama</strong><br>[Nama Sales]<br>[Position]<br>[Contact]</p>')
                        ->helperText('Professional closing statement & contact info')
                        ->columnSpanFull(),

                    // 10. SIGNATURE
                    Placeholder::make('signature_header')
                        ->hiddenLabel()
                        ->content(new \Illuminate\Support\HtmlString('
                            <div style="margin-top: 35px; margin-bottom: 15px;">
                                <h3 style="font-weight: 700; font-size: 14px; color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px;">SIGNATURE & APPROVAL</h3>
                            </div>
                        ')),
                    Grid::make(2)->schema([
                        TextInput::make('prepared_by')
                            ->label('Prepared By (Name)')
                            ->default(auth()->user()->name ?? 'Sales Team')
                            ->placeholder('Full Name')
                            ->helperText('Name of person preparing this quotation'),
                        TextInput::make('prepared_by_position')
                            ->label('Position/Title')
                            ->default('Sales Manager')
                            ->placeholder('Job Title')
                            ->helperText('Official position in company'),
                    ]),
                    Grid::make(2)->schema([
                        Placeholder::make('prepared_signature')
                            ->label('Prepared By Signature')
                            ->content(new \Illuminate\Support\HtmlString('<div style="border: 1px dashed #cbd5e1; padding: 40px; text-align: center; background: white; border-radius: 8px;"><span style="color: #94a3b8;">Signature Area</span></div>')),
                        Placeholder::make('approved_signature')
                            ->label('Approved By Signature')
                            ->content(new \Illuminate\Support\HtmlString('<div style="border: 1px dashed #cbd5e1; padding: 40px; text-align: center; background: white; border-radius: 8px;"><span style="color: #94a3b8;">Client Signature</span></div>')),
                    ]),
                ])
                ->extraAttributes([
                    'class' => 'quotation-document-container',
                    'style' => 'max-width: 320mm; margin: 0 auto; background: white; padding: 30px; min-height: 297mm; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);'
                ])
                ->columnSpanFull(),
        ];
    }
}
