<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation #{{ $quotation->quotation_number }}</title>
    <style>
        /* --- PAGE SETUP --- */
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #333;
            line-height: 1.4;
        }

        /* --- UTILITY CLASSES --- */
        .w-full { width: 100%; }
        .w-half { width: 50%; vertical-align: top; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .text-blue { color: #2563eb; }
        .text-gray { color: #666; }
        .mb-2 { margin-bottom: 8px; }
        .mt-4 { margin-top: 20px; }
        .valign-top { vertical-align: top; }

        /* --- HEADER --- */
        .header-table {
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }
        .company-name { font-size: 14pt; font-weight: bold; color: #2563eb; margin-bottom: 5px; }
        .company-info { font-size: 8pt; color: #555; }
        .doc-title { font-size: 18pt; font-weight: bold; color: #333; letter-spacing: 1px; }
        .doc-meta { margin-top: 10px; font-size: 9pt; }
        .doc-meta span { display: inline-block; width: 80px; font-weight: bold; color: #555; }

        /* --- RECIPIENT --- */
        .recipient-box { margin-bottom: 30px; }
        .recipient-label { font-size: 7pt; font-weight: bold; color: #888; text-transform: uppercase; margin-bottom: 3px; letter-spacing: 0.5px; }
        .recipient-name { font-size: 11pt; font-weight: bold; color: #000; }
        .recipient-detail { font-size: 9pt; color: #555; margin-top: 2px; }

        /* --- OPENING MESSAGE --- */
        .opening-message {
            margin-bottom: 25px;
            font-size: 9pt;
            text-align: justify;
            color: #444;
            line-height: 1.5;
        }

        /* --- ITEMS TABLE --- */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            text-align: left;
            padding: 8px 5px;
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #555;
            border-bottom: 2px solid #2563eb;
        }
        .items-table td {
            padding: 8px 5px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }
        .items-table tr:last-child td { border-bottom: 1px solid #ccc; }
        .item-name { font-weight: bold; color: #222; }
        .item-desc { font-size: 8pt; color: #666; font-style: italic; margin-top: 2px; }

        /* --- TOTALS --- */
        .summary-table { width: 100%; border-collapse: collapse; page-break-inside: avoid; }
        .summary-label { text-align: right; padding: 5px 15px; font-weight: bold; color: #555; }
        .summary-value { text-align: right; padding: 5px 0; width: 130px; font-family: 'Courier New', monospace; }
        .total-row td { padding-top: 10px; font-size: 11pt; font-weight: bold; color: #2563eb; border-top: 2px solid #eee; }

        /* --- TERMS & PAYMENT --- */
        .terms-container { margin-top: 10px; }
        .section-title { font-size: 8pt; font-weight: bold; text-transform: uppercase; color: #333; margin-bottom: 5px; border-bottom: 1px solid #eee; display: inline-block; padding-bottom: 2px; }
        .terms-list { padding-left: 15px; margin: 0; font-size: 8pt; color: #555; }
        .terms-list li { margin-bottom: 3px; }
        
        .payment-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 8pt; }
        .payment-table td { padding: 4px 0; border-bottom: 1px dashed #eee; color: #555; }

        /* --- ACCEPTANCE BOX (QUOTATION STYLE) --- */
        .acceptance-box {
            margin-top: 40px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            padding: 20px;
            page-break-inside: avoid;
        }
        .acceptance-title { font-weight: bold; font-size: 10pt; color: #2563eb; margin-bottom: 5px; text-transform: uppercase; }
        .acceptance-text { font-size: 8pt; color: #555; margin-bottom: 25px; font-style: italic; }
        .sig-label { font-size: 8pt; color: #888; margin-bottom: 40px; }
        .sig-line { border-bottom: 1px solid #333; width: 95%; margin-bottom: 5px; }
        .sig-name { font-weight: bold; font-size: 9pt; }
        .sig-date { font-size: 8pt; color: #555; margin-top: 2px; }

        /* --- FOOTER --- */
        .footer { 
            position: fixed; bottom: 0; left: 0; right: 0; height: 1cm; 
            text-align: center; font-size: 7pt; color: #aaa; 
            border-top: 1px solid #eee; line-height: 1cm; 
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="w-half valign-top">
                @if($company['logo'])
                    <img src="{{ public_path('storage/' . $company['logo']) }}" style="height: 45px; margin-bottom: 8px;" alt="Logo">
                @else
                    <div class="company-name">{{ $company['name'] }}</div>
                @endif
                
                <div class="company-info">
                    {{ $company['address'] ?? 'Jakarta, Indonesia' }}<br>
                    {{ $company['phone'] ?? '' }} | {{ $company['email'] ?? '' }}<br>
                    {{ $company['website'] ?? '' }}
                </div>
            </td>
            <td class="w-half text-right valign-top">
                <div class="doc-title">QUOTATION</div>
                <div class="doc-meta">
                    <span>Number:</span> #{{ $quotation->quotation_number }}<br>
                    <span>Date:</span> {{ $quotation->created_at->format('d M Y') }}<br>
                    <span style="color: #dc2626;">Valid Until:</span> {{ $quotation->valid_until->format('d M Y') }}
                </div>
            </td>
        </tr>
    </table>

    <div class="recipient-box">
        <table class="w-full">
            <tr>
                <td class="w-half valign-top">
                    <div class="recipient-label">Quotation Prepared For:</div>
                    <div class="recipient-name">{{ $quotation->customer->company_name ?? $quotation->lead->company_name ?? 'Client Name' }}</div>
                    <div class="recipient-detail">
                        Attn: {{ $quotation->customer->contact_name ?? 'Purchasing Dept' }}<br>
                        {{ $quotation->customer->address ?? '' }}<br>
                        {{ $quotation->customer->phone ?? '' }}
                    </div>
                </td>
                <td class="w-half valign-top text-right">
                    @if($quotation->lead)
                    <div class="recipient-label">Project Reference:</div>
                    <div class="recipient-detail">
                        {{ $quotation->lead->title ?? 'New Project Implementation' }}
                    </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    @if($quotation->opening_content)
        <div class="opening-message">
            {!! $quotation->opening_content !!}
        </div>
    @endif

    <table class="items-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="50%">Description</th>
                <th width="22%" class="text-right">Unit Price</th>
                <th width="10%" class="text-center">Disc</th>
                <th width="23%" class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotation->items as $index => $item)
                @php
                    $price = (float) ($item->unit_price ?? 0);
                    $discPercent = (float) ($item->discount_percent ?? 0);
                    $discAmount = $price * ($discPercent / 100);
                    $total = $price - $discAmount;
                @endphp
                <tr>
                    <td class="text-center text-gray">{{ $index + 1 }}</td>
                    <td>
                        <div class="item-name">{{ $item->name }}</div>
                        @if($item->description)
                            <div class="item-desc">{{ $item->description }}</div>
                        @endif
                    </td>
                    <td class="text-right">Rp {{ number_format($price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($discPercent, 0) }}%</td>
                    <td class="text-right text-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="w-full" style="page-break-inside: avoid;">
        <tr>
            <td class="w-half valign-top" style="padding-right: 20px;">
                @if(!empty($calculations['payment_terms']))
                    <div class="section-title">Payment Schedule</div>
                    <table class="payment-table">
                        @foreach($calculations['payment_terms'] as $term)
                            <tr>
                                <td>{{ $term['description'] }}</td>
                                <td class="text-right text-bold">Rp {{ number_format($term['amount'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif

                <div class="section-title mt-4">Terms & Conditions</div>
                <ul class="terms-list">
                    @if($quotation->terms_and_conditions && is_array($quotation->terms_and_conditions))
                        @foreach($quotation->terms_and_conditions as $term)
                            @if(is_string($term))
                                <li>{{ $term }}</li>
                            @elseif(is_array($term) && isset($term['checked']) && $term['checked'])
                                <li>{{ $term['label'] ?? '' }}</li>
                            @endif
                        @endforeach
                    @else
                        <li>Prices exclude tax unless stated otherwise.</li>
                        <li>Valid for 30 days from date of issue.</li>
                    @endif
                </ul>
            </td>

            <td class="w-half valign-top">
                <table class="summary-table">
                    <tr>
                        <td class="summary-label">Subtotal</td>
                        <td class="summary-value">Rp {{ number_format($calculations['subtotal'], 0, ',', '.') }}</td>
                    </tr>
                    @if($calculations['discount_percentage'] > 0)
                    <tr>
                        <td class="summary-label text-gray">Discount ({{ $calculations['discount_percentage'] }}%)</td>
                        <td class="summary-value text-gray">- Rp {{ number_format($calculations['discount_amount'], 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    @if(isset($quotation->include_tax) && $quotation->include_tax)
                    <tr>
                        <td class="summary-label">PPN ({{ $calculations['tax_percentage'] }}%)</td>
                        <td class="summary-value">Rp {{ number_format($calculations['tax_amount'], 0, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr class="total-row">
                        <td class="summary-label" style="padding-top: 10px;">TOTAL IDR</td>
                        <td class="summary-value" style="padding-top: 10px;">Rp {{ number_format($calculations['grand_total'], 0, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    @if($quotation->closing_content)
        <div style="margin-top: 20px; font-size: 9pt; text-align: justify;">
            {!! $quotation->closing_content !!}
        </div>
    @endif

    <div class="acceptance-box">
        <div class="acceptance-title">Acceptance of Proposal</div>
        <div class="acceptance-text">
            By signing below, I hereby accept the terms, conditions, and pricing set forth in this quotation #{{ $quotation->quotation_number }}. This document serves as an official approval to proceed with the project/order.
        </div>

        <table class="w-full">
            <tr>
                <td class="w-half valign-top" style="padding-right: 20px;">
                    <div class="sig-label">Approved by Client:</div>
                    <div class="sig-line"></div>
                    <div class="sig-name">{{ $quotation->customer->company_name ?? $quotation->lead->company_name ?? '[Client Name]' }}</div>
                    <div class="sig-date">Date: _________________</div>
                </td>
                <td class="w-half valign-top">
                    <div class="sig-label">Authorized by:</div>
                    <div class="sig-line"></div>
                    <div class="sig-name">{{ $quotation->prepared_by ?? $company['name'] }}</div>
                    <div class="sig-date">{{ $quotation->prepared_by_position ?? 'Sales Manager' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        This document is a quotation, not an invoice. Payment will be requested upon acceptance. | {{ $company['name'] }}
    </div>

</body>
</html>