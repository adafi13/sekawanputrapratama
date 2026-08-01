<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation #{{ $quotation->quotation_number }}</title>
    <style>
        /* --- PAGE SETUP --- */
        @page {
            margin: 0cm;
        }
        body {
            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #334155;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background: white;
        }
        
        .page-container {
            padding: 1.5cm;
        }

        /* --- UTILITY CLASSES --- */
        .w-full { width: 100%; }
        .w-half { width: 50%; vertical-align: top; }
        .w-1/3 { width: 33.33%; vertical-align: top; }
        .w-2/3 { width: 66.66%; vertical-align: top; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .text-blue { color: #0f172a; } /* Darker professional slate */
        .text-gray { color: #64748b; }
        .text-light { color: #94a3b8; }
        .mt-2 { margin-top: 8px; }
        .mt-4 { margin-top: 16px; }
        .mt-6 { margin-top: 24px; }
        .mt-8 { margin-top: 32px; }
        .mb-2 { margin-bottom: 8px; }
        .mb-4 { margin-bottom: 16px; }
        .valign-top { vertical-align: top; }
        .valign-middle { vertical-align: middle; }

        /* --- HEADER BORDER --- */
        .top-bar {
            height: 6px;
            width: 100%;
            background-color: #2563eb;
        }

        /* --- HEADER --- */
        .header-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .company-logo {
            max-width: 180px;
            max-height: 70px;
            margin-bottom: 10px;
        }
        .company-info { 
            font-size: 8pt; 
            color: #64748b; 
            line-height: 1.4;
        }
        .doc-title { 
            font-size: 26pt; 
            font-weight: 800; 
            color: #1e293b; 
            letter-spacing: 2px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .doc-meta-table {
            float: right;
            border-collapse: collapse;
        }
        .doc-meta-table td {
            padding: 4px 10px;
            font-size: 8pt;
        }
        .doc-meta-label { 
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            text-align: right;
        }
        .doc-meta-value {
            font-weight: 600;
            color: #0f172a;
            text-align: right;
        }

        /* --- RECIPIENT & INFO BOX --- */
        .info-grid {
            width: 100%;
            margin-bottom: 25px;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 0;
        }
        
        .info-label { 
            font-size: 7pt; 
            font-weight: 700; 
            color: #94a3b8; 
            text-transform: uppercase; 
            margin-bottom: 4px; 
            letter-spacing: 0.5px;
        }
        .info-name { 
            font-size: 11pt; 
            font-weight: 700; 
            color: #0f172a;
            margin-bottom: 4px;
        }
        .info-detail { 
            font-size: 8.5pt; 
            color: #475569; 
            line-height: 1.4;
        }

        /* --- OPENING MESSAGE --- */
        .opening-message {
            margin-bottom: 25px;
            font-size: 9.5pt;
            text-align: justify;
            color: #334155;
            line-height: 1.6;
        }

        /* --- ITEMS TABLE --- */
        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 25px;
        }
        .items-table thead {
            background: #f1f5f9;
        }
        .items-table th {
            text-align: left;
            padding: 10px 12px;
            font-size: 7.5pt;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #cbd5e1;
        }
        .items-table tbody tr td {
            border-bottom: 1px solid #e2e8f0;
            padding: 12px;
            vertical-align: top;
            font-size: 9pt;
        }
        .items-table tbody tr:nth-child(even) td {
            background-color: #fafaf9;
        }
        
        .item-name { 
            font-weight: 700; 
            color: #0f172a;
            margin-bottom: 3px;
        }
        .item-desc { 
            font-size: 8pt; 
            color: #64748b; 
            line-height: 1.4;
        }

        /* --- SUMMARY TABLE --- */
        .summary-table { 
            width: 100%; 
            border-collapse: collapse;
        }
        .summary-label { 
            text-align: right; 
            padding: 6px 15px 6px 0; 
            font-weight: 500; 
            color: #64748b;
            font-size: 9pt;
        }
        .summary-value { 
            text-align: right; 
            padding: 6px 0; 
            width: 130px; 
            font-weight: 600;
            color: #0f172a;
            font-size: 9.5pt;
        }
        .total-row {
            border-top: 2px solid #e2e8f0;
        }
        .total-row .summary-label { 
            padding: 12px 15px 12px 0; 
            font-size: 11pt; 
            font-weight: 800;
            color: #0f172a;
        }
        .total-row .summary-value {
            color: #2563eb;
            font-size: 12pt;
            font-weight: 800;
            padding: 12px 0;
        }

        /* --- PAYMENT SCHEDULE --- */
        .section-title { 
            font-size: 10pt; 
            font-weight: 700; 
            color: #0f172a; 
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 4px;
        }
        .payment-table { 
            width: 100%; 
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .payment-table tr td {
            padding: 8px 0;
            border-bottom: 1px dashed #cbd5e1;
            font-size: 8.5pt;
        }
        .payment-table tr:last-child td {
            border-bottom: none;
        }
        .payment-label {
            color: #475569;
        }
        .payment-amount {
            text-align: right;
            font-weight: 700;
            color: #0f172a;
        }

        /* --- TERMS & CONDITIONS --- */
        .terms-list { 
            padding-left: 0; 
            margin: 0 0 25px 0;
            list-style: none;
        }
        .terms-list li { 
            margin-bottom: 6px;
            font-size: 8pt;
            color: #475569;
            line-height: 1.5;
            position: relative;
            padding-left: 14px;
        }
        .terms-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2563eb;
            font-weight: bold;
        }
        
        /* --- CLOSING MESSAGE --- */
        .closing-message {
            margin: 25px 0;
            font-size: 9.5pt;
            text-align: justify;
            color: #334155;
            line-height: 1.6;
        }

        /* --- SIGNATURE BOX --- */
        .signature-section {
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .sig-container {
            width: 100%;
        }
        .sig-box {
            text-align: center;
        }
        .sig-role { 
            font-size: 8.5pt; 
            color: #64748b; 
            margin-bottom: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .sig-space {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sig-line { 
            border-bottom: 1px solid #94a3b8; 
            width: 80%; 
            margin: 0 auto 5px auto;
        }
        .sig-name { 
            font-weight: 700; 
            font-size: 10pt;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .sig-date { 
            font-size: 8pt; 
            color: #64748b; 
        }

        /* --- FOOTER --- */
        .footer { 
            position: fixed; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            height: 1.5cm; 
            text-align: center; 
            font-size: 7.5pt; 
            color: #94a3b8; 
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            background: white;
            line-height: 1.4;
        }
        
        .page-break-avoid {
            page-break-inside: avoid;
        }
        
        /* Highlight tags */
        .highlight {
            background-color: #eff6ff;
            color: #1e40af;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 7.5pt;
        }
    </style>
</head>
<body>

    <div class="top-bar"></div>

    <div class="page-container">
        <!-- HEADER -->
        <table class="header-table">
            <tr>
                <td class="w-half valign-middle">
                    @if(isset($company['logo']) && $company['logo'])
                        <img src="{{ $company['logo'] }}" alt="Logo" class="company-logo">
                    @else
                        <div style="font-size: 20pt; font-weight: 900; color: #0f172a; margin-bottom: 5px;">{{ $company['name'] }}</div>
                    @endif
                    <div class="company-info">
                        @if($company['address']){{ $company['address'] }}<br>@endif
                        @if($company['phone'])T. {{ $company['phone'] }}@endif
                        @if($company['email']) &nbsp;|&nbsp; E. {{ $company['email'] }}@endif
                        @if($company['website'])<br>{{ $company['website'] }}@endif
                    </div>
                </td>
                <td class="w-half text-right valign-top">
                    <div class="doc-title">QUOTATION</div>
                    <table class="doc-meta-table">
                        <tr>
                            <td class="doc-meta-label">Reference Number</td>
                            <td class="doc-meta-value">#{{ $quotation->quotation_number }}</td>
                        </tr>
                        <tr>
                            <td class="doc-meta-label">Date Issued</td>
                            <td class="doc-meta-value">{{ $quotation->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="doc-meta-label" style="color: #ef4444;">Valid Until</td>
                            <td class="doc-meta-value" style="color: #ef4444;">{{ $quotation->valid_until->format('d M Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- RECIPIENT INFO -->
        <table class="info-grid">
            <tr>
                <td class="w-2/3 valign-top">
                    <div class="info-label">Prepared For</div>
                    <div class="info-name">{{ $quotation->customer->company_name ?? $quotation->lead->company_name ?? 'Client Name' }}</div>
                    <div class="info-detail">
                        @if($quotation->customer && $quotation->customer->contact_name)
                            Attn: <strong>{{ $quotation->customer->contact_name }}</strong><br>
                        @endif
                        {{ $quotation->customer->address ?? '' }}<br>
                        {{ $quotation->customer->phone ?? '' }}
                    </div>
                </td>
                <td class="w-1/3 valign-top text-right">
                    @if($quotation->lead)
                        <div class="info-label">Project Details</div>
                        <div class="info-detail" style="font-weight: 600; color: #0f172a;">
                            {{ $quotation->lead->title ?? 'New Project Implementation' }}
                        </div>
                    @endif
                </td>
            </tr>
        </table>

        <!-- OPENING MESSAGE -->
        @if($quotation->opening_content)
            <div class="opening-message">
                {!! $quotation->opening_content !!}
            </div>
        @endif

        <!-- ITEMS TABLE -->
        <table class="items-table">
            <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="45%">Description</th>
                    <th width="20%" class="text-right">Unit Price</th>
                    <th width="10%" class="text-center">Disc</th>
                    <th width="20%" class="text-right">Amount</th>
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
                        <td class="text-center">
                            @if($discPercent > 0)
                                <span class="highlight">{{ number_format($discPercent, 0) }}%</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right text-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TOTALS & SPLIT VIEW -->
        <table class="w-full page-break-avoid mt-4">
            <tr>
                <td class="w-half valign-top" style="padding-right: 30px;">
                    <!-- PAYMENT SCHEDULE -->
                    @if(!empty($calculations['payment_terms']))
                        <div class="section-title">Payment Schedule</div>
                        <table class="payment-table">
                            @foreach($calculations['payment_terms'] as $index => $term)
                                <tr>
                                    <td class="payment-label">
                                        <strong>Termin {{ $index + 1 }}</strong><br>
                                        <span style="font-size: 7.5pt; color:#64748b;">{{ $term['description'] }}</span>
                                    </td>
                                    <td class="payment-amount valign-top">Rp {{ number_format($term['amount'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    <!-- TERMS & CONDITIONS -->
                    <div class="section-title mt-2">Terms & Conditions</div>
                    <ul class="terms-list">
                        @php
                            $defaultTerms = \App\Models\Quotation::getDefaultTerms();
                            $hasTerms = false;
                        @endphp
                        
                        {{-- Standard Terms --}}
                        @if($quotation->terms_and_conditions && is_array($quotation->terms_and_conditions))
                            @foreach($quotation->terms_and_conditions as $key)
                                @if(isset($defaultTerms[$key]))
                                    <li>{{ $defaultTerms[$key] }}</li>
                                    @php $hasTerms = true; @endphp
                                @endif
                            @endforeach
                        @endif

                        {{-- Custom Terms from Repeater --}}
                        @if($quotation->custom_terms && is_array($quotation->custom_terms))
                            @foreach($quotation->custom_terms as $customTerm)
                                @if(isset($customTerm['term']) && !empty($customTerm['term']))
                                    <li>{{ $customTerm['term'] }}</li>
                                    @php $hasTerms = true; @endphp
                                @endif
                            @endforeach
                        @endif

                        {{-- Fallback if completely empty --}}
                        @if(!$hasTerms)
                            <li>Syarat dan ketentuan pembayaran sesuai dengan termin pembayaran.</li>
                            <li>Penawaran harga ini berlaku selama 30 hari sejak tanggal diterbitkan.</li>
                            <li>Pekerjaan di luar ruang lingkup (scope of work) akan dikenakan biaya tambahan.</li>
                        @endif
                    </ul>
                </td>

                <td class="w-half valign-top">
                    <!-- SUMMARY -->
                    <table class="summary-table">
                        <tr>
                            <td class="summary-label">Subtotal</td>
                            <td class="summary-value">Rp {{ number_format($calculations['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                        @if($calculations['discount_percentage'] > 0)
                            <tr>
                                <td class="summary-label text-gray">Discount ({{ $calculations['discount_percentage'] }}%)</td>
                                <td class="summary-value" style="color: #ef4444;">- Rp {{ number_format($calculations['discount_amount'], 0, ',', '.') }}</td>
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
                    </table>
                </td>
            </tr>
        </table>

        <!-- CLOSING MESSAGE -->
        @if($quotation->closing_content)
            <div class="closing-message page-break-avoid">
                {!! $quotation->closing_content !!}
            </div>
        @endif

        <!-- SIGNATURES -->
        <div class="signature-section">
            <table class="sig-container">
                <tr>
                    <!-- CLIENT SIGNATURE -->
                    <td class="w-half valign-top sig-box">
                        <div class="sig-role">Client Approval</div>
                        <div class="sig-space">
                            @if($quotation->approved_signature_path)
                                @if(\Illuminate\Support\Str::startsWith($quotation->approved_signature_path, 'data:image'))
                                    <img src="{{ $quotation->approved_signature_path }}" alt="Signature" style="max-height: 70px; max-width: 180px;">
                                @elseif(Storage::disk('public')->exists($quotation->approved_signature_path))
                                    <img src="{{ public_path('storage/' . $quotation->approved_signature_path) }}" alt="Signature" style="max-height: 70px; max-width: 180px;">
                                @endif
                            @endif
                        </div>
                        <div class="sig-line"></div>
                        <div class="sig-name">{{ $quotation->customer->company_name ?? $quotation->lead->company_name ?? '_______________' }}</div>
                        <div class="sig-date">Date: _________________</div>
                    </td>

                    <!-- COMPANY SIGNATURE -->
                    <td class="w-half valign-top sig-box">
                        <div class="sig-role">Authorized Representative</div>
                        <div class="sig-space">
                            @if($quotation->prepared_signature_path)
                                @if(\Illuminate\Support\Str::startsWith($quotation->prepared_signature_path, 'data:image'))
                                    <img src="{{ $quotation->prepared_signature_path }}" alt="Signature" style="max-height: 70px; max-width: 180px;">
                                @elseif(Storage::disk('public')->exists($quotation->prepared_signature_path))
                                    <img src="{{ public_path('storage/' . $quotation->prepared_signature_path) }}" alt="Signature" style="max-height: 70px; max-width: 180px;">
                                @endif
                            @endif
                        </div>
                        <div class="sig-line"></div>
                        <div class="sig-name">{{ $quotation->prepared_by ?? $company['name'] }}</div>
                        <div class="sig-date">{{ $quotation->prepared_by_position ?? 'Sales Representative' }}</div>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        This document is a formal quotation. Pricing is valid until {{ $quotation->valid_until->format('d M Y') }}.<br>
        <strong>{{ $company['name'] }}</strong>
    </div>

</body>
</html>