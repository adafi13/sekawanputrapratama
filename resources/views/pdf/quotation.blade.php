<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation #{{ $quotation->quotation_number }}</title>
    <style>
        /* --- PAGE SETUP --- */
        @page {
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 8pt;
            color: #1a1a1a;
            line-height: 1.3;
        }

        /* --- UTILITY CLASSES --- */
        .w-full { width: 100%; }
        .w-half { width: 50%; vertical-align: top; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .text-blue { color: #1e40af; }
        .text-gray { color: #6b7280; }
        .mb-2 { margin-bottom: 4px; }
        .mt-4 { margin-top: 8px; }
        .valign-top { vertical-align: top; }

        /* --- HEADER --- */
        .header-table {
            width: 100%;
            margin-bottom: 10px;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 6px;
        }
        .company-name { 
            font-size: 12pt; 
            font-weight: bold; 
            color: #1e40af; 
            margin-bottom: 2px;
            letter-spacing: 0.2px;
        }
        .company-info { 
            font-size: 7pt; 
            color: #4b5563; 
            line-height: 1.2;
        }
        .doc-title { 
            font-size: 18pt; 
            font-weight: bold; 
            color: #1e40af; 
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .doc-meta { 
            margin-top: 4px; 
            font-size: 7pt;
            color: #374151;
            line-height: 1.4;
        }
        .doc-meta-inline {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .doc-meta-item {
            white-space: nowrap;
        }
        .doc-meta-label { 
            font-weight: 600;
            color: #6b7280;
        }
        .doc-meta-value {
            font-weight: 600;
            color: #1a1a1a;
        }
        .doc-meta-separator {
            color: #d1d5db;
            margin: 0 4px;
        }

        /* --- RECIPIENT BOX --- */
        .recipient-box { 
            margin-bottom: 10px;
            background: #f8fafc;
            border-left: 3px solid #1e40af;
            padding: 6px 8px;
        }
        .recipient-label { 
            font-size: 6pt; 
            font-weight: bold; 
            color: #6b7280; 
            text-transform: uppercase; 
            margin-bottom: 2px; 
            letter-spacing: 0.3px;
        }
        .recipient-name { 
            font-size: 9pt; 
            font-weight: bold; 
            color: #1a1a1a;
            margin-bottom: 2px;
        }
        .recipient-detail { 
            font-size: 7pt; 
            color: #4b5563; 
            line-height: 1.3;
        }

        /* --- OPENING MESSAGE --- */
        .opening-message {
            margin-bottom: 10px;
            font-size: 8pt;
            text-align: justify;
            color: #374151;
            line-height: 1.4;
        }

        /* --- ITEMS TABLE --- */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        .items-table thead {
            background: #1e40af;
            color: white;
        }
        .items-table th {
            text-align: left;
            padding: 5px 4px;
            font-size: 7pt;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }
        .items-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table tbody tr:last-child {
            border-bottom: 1px solid #d1d5db;
        }
        .items-table td {
            padding: 5px 4px;
            vertical-align: top;
            font-size: 7pt;
        }
        .item-name { 
            font-weight: 600; 
            color: #1a1a1a;
            margin-bottom: 1px;
        }
        .item-desc { 
            font-size: 6pt; 
            color: #6b7280; 
            line-height: 1.2;
            margin-top: 1px;
        }

        /* --- SUMMARY TABLE --- */
        .summary-container {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 2px;
            padding: 6px;
        }
        .summary-table { 
            width: 100%; 
            border-collapse: collapse;
        }
        .summary-label { 
            text-align: right; 
            padding: 3px 8px 3px 0; 
            font-weight: 500; 
            color: #4b5563;
            font-size: 7pt;
        }
        .summary-value { 
            text-align: right; 
            padding: 3px 0; 
            width: 110px; 
            font-weight: 600;
            color: #1a1a1a;
            font-size: 7pt;
        }
        .summary-table tr {
            border-bottom: 1px solid #e5e7eb;
        }
        .total-row {
            background: #1e40af;
            color: white;
        }
        .total-row td { 
            padding: 5px 8px 5px 0; 
            font-size: 9pt; 
            font-weight: bold;
            border: none;
        }
        .total-row .summary-value {
            color: white;
            font-size: 9pt;
        }

        /* --- PAYMENT SCHEDULE --- */
        .payment-container {
            margin-bottom: 8px;
        }
        .section-title { 
            font-size: 8pt; 
            font-weight: bold; 
            text-transform: uppercase; 
            color: #1e40af; 
            margin-bottom: 4px;
            padding-bottom: 2px;
            border-bottom: 1px solid #e5e7eb;
            letter-spacing: 0.2px;
        }
        .payment-table { 
            width: 100%; 
            border-collapse: collapse;
            background: #ffffff;
        }
        .payment-table tr {
            border-bottom: 1px solid #e5e7eb;
        }
        .payment-table td { 
            padding: 3px 6px; 
            font-size: 7pt;
        }
        .payment-label {
            color: #4b5563;
        }
        .payment-amount {
            text-align: right;
            font-weight: 600;
            color: #1a1a1a;
        }

        /* --- TERMS & CONDITIONS --- */
        .terms-container {
            margin-bottom: 8px;
        }
        .terms-list { 
            padding-left: 14px; 
            margin: 2px 0;
            list-style: none;
        }
        .terms-list li { 
            margin-bottom: 2px;
            font-size: 7pt;
            color: #4b5563;
            line-height: 1.3;
            position: relative;
            padding-left: 2px;
        }
        .terms-list li:before {
            content: "•";
            position: absolute;
            left: -10px;
            color: #1e40af;
            font-weight: bold;
            font-size: 8pt;
        }
        
        /* --- CLOSING MESSAGE --- */
        .closing-message {
            margin: 10px 0;
            font-size: 8pt;
            text-align: justify;
            color: #374151;
            line-height: 1.4;
        }

        /* --- SIGNATURE BOX --- */
        .acceptance-box {
            margin-top: 12px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 3px;
            padding: 8px;
            page-break-inside: avoid;
        }
        .acceptance-title { 
            font-weight: bold; 
            font-size: 8pt; 
            color: #1e40af; 
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }
        .acceptance-text { 
            font-size: 7pt; 
            color: #6b7280; 
            margin-bottom: 12px;
            line-height: 1.3;
            font-style: italic;
        }
        .sig-label { 
            font-size: 7pt; 
            color: #6b7280; 
            margin-bottom: 30px;
            font-weight: 500;
        }
        .sig-line { 
            border-bottom: 1px solid #1a1a1a; 
            width: 150px; 
            margin-bottom: 4px;
        }
        .sig-name { 
            font-weight: bold; 
            font-size: 8pt;
            color: #1a1a1a;
        }
        .sig-date { 
            font-size: 6pt; 
            color: #6b7280; 
            margin-top: 1px;
        }

        /* --- FOOTER --- */
        .footer { 
            position: fixed; 
            bottom: 0.5cm; 
            left: 0; 
            right: 0; 
            height: 0.5cm; 
            text-align: center; 
            font-size: 6pt; 
            color: #9ca3af; 
            border-top: 1px solid #e5e7eb;
            padding-top: 2px;
            background: white;
        }
        
        /* --- PAGE BREAKS --- */
        .page-break-avoid {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tbody>
            <tr>
                <td class="w-half valign-top">
                    @if($company['logo'])
                        <img src="{{ public_path('storage/' . $company['logo']) }}" style="height: 40px; margin-bottom: 6px;" alt="Logo">
                    @endif
                    <div class="company-name">{{ $company['name'] }}</div>
                    <div class="company-info">
                        @if($company['address']){{ $company['address'] }}<br>@endif
                        @if($company['phone'])Phone: {{ $company['phone'] }}@endif
                        @if($company['email']) | Email: {{ $company['email'] }}@endif
                        @if($company['website'])<br>{{ $company['website'] }}@endif
                    </div>
                </td>
                <td class="w-half text-right valign-top">
                    <div class="doc-title">QUOTATION</div>
                    <div class="doc-meta">
                        <div class="doc-meta-inline">
                            <span class="doc-meta-item">
                                <span class="doc-meta-label">Number:</span>
                                <span class="doc-meta-value">#{{ $quotation->quotation_number }}</span>
                            </span>
                            <span class="doc-meta-separator">|</span>
                            <span class="doc-meta-item">
                                <span class="doc-meta-label">Date:</span>
                                <span class="doc-meta-value">{{ $quotation->created_at->format('d M Y') }}</span>
                            </span>
                            <span class="doc-meta-separator">|</span>
                            <span class="doc-meta-item">
                                <span class="doc-meta-label" style="color: #dc2626;">Valid Until:</span>
                                <span class="doc-meta-value" style="color: #dc2626;">{{ $quotation->valid_until->format('d M Y') }}</span>
                            </span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
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

    <table class="w-full page-break-avoid" style="margin-top: 15px;">
        <tbody>
            <tr>
                <td class="w-half valign-top" style="padding-right: 20px;">
                    @if(!empty($calculations['payment_terms']))
                        <div class="payment-container">
                            <div class="section-title">Payment Schedule</div>
                            <table class="payment-table">
                                <tbody>
                                    @foreach($calculations['payment_terms'] as $index => $term)
                                        <tr>
                                            <td class="payment-label"><strong>Termin {{ $index + 1 }}:</strong> {{ $term['description'] }}</td>
                                            <td class="payment-amount">Rp {{ number_format($term['amount'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="terms-container">
                        <div class="section-title">Terms & Conditions</div>
                        <ul class="terms-list">
                            @if($quotation->terms_and_conditions && is_array($quotation->terms_and_conditions))
                                @php
                                    $defaultTerms = \App\Models\Quotation::getDefaultTerms();
                                @endphp
                                @foreach($quotation->terms_and_conditions as $key)
                                    @if(isset($defaultTerms[$key]))
                                        <li>{{ $defaultTerms[$key] }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>Payment terms as specified in the payment schedule</li>
                                <li>This quotation is valid for 30 days from the date of issue</li>
                                <li>Changes to project scope may affect the quoted price</li>
                                <li>All work comes with a standard warranty period</li>
                                <li>Cancellation policy applies as per agreement</li>
                            @endif
                        </ul>
                    </div>
                </td>

                <td class="w-half valign-top">
                    <div class="summary-container">
                        <table class="summary-table">
                            <tbody>
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
                                    <td class="summary-label">GRAND TOTAL</td>
                                    <td class="summary-value">Rp {{ number_format($calculations['grand_total'], 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- CLOSING MESSAGE --}}
    {{-- NOTE: Keep closing message as professional paragraph only. --}}
    {{-- Do NOT include sales name/position/contact - use signature section below for that --}}
    @if($quotation->closing_content)
        <div class="closing-message">
            {!! $quotation->closing_content !!}
        </div>
    @endif

    <div class="acceptance-box">
        <div class="acceptance-title">Agreement & Authorization</div>
        <div class="acceptance-text">
            By signing below, both parties hereby accept the terms, conditions, and pricing set forth in this quotation #{{ $quotation->quotation_number }}. This signature serves as official approval to proceed with the project as outlined above.
        </div>

        <table class="w-full">
            <tbody>
                <tr>
                    <td class="w-half valign-top" style="padding-right: 20px;">
                        <div class="sig-label">Client Approval:</div>
                        <div class="sig-line"></div>
                        <div class="sig-name">{{ $quotation->customer->company_name ?? $quotation->lead->company_name ?? '[Client Name]' }}</div>
                        <div class="sig-date">Date: _________________</div>
                    </td>
                    <td class="w-half valign-top">
                        <div class="sig-label">Authorized Representative:</div>
                        <div class="sig-line"></div>
                        <div class="sig-name">{{ $quotation->prepared_by ?? $company['name'] }}</div>
                        <div class="sig-date">{{ $quotation->prepared_by_position ?? 'Sales Manager' }}</div>
                        @if($quotation->sales_pic)
                        <div class="sig-date" style="margin-top: 2px;">{{ $quotation->sales_pic }}</div>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        This document is a quotation, not an invoice. Payment will be requested upon acceptance. | {{ $company['name'] }}
    </div>

</body>
</html>