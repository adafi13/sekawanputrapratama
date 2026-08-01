<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation #{{ $quotation->quotation_number }}</title>
    <style>
        @page {
            margin: 35px 40px 50px 40px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #334155;
            line-height: 1.4;
        }

        /* UTILITIES */
        .w-full { width: 100%; }
        .w-half { width: 50%; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .valign-top { vertical-align: top; }
        .valign-bottom { vertical-align: bottom; }
        .mb-2 { margin-bottom: 8px; }
        .mb-4 { margin-bottom: 16px; }
        .mt-4 { margin-top: 16px; }
        
        /* HEADER */
        .header-table {
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 15px;
        }
        .company-logo {
            max-width: 200px;
            max-height: 80px;
            margin-bottom: 5px;
        }
        .company-name-text {
            font-size: 18pt;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 5px;
        }
        .company-info {
            font-size: 8pt;
            color: #64748b;
            line-height: 1.4;
        }
        .doc-title {
            font-size: 24pt;
            font-weight: 800;
            color: #1e293b;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .doc-meta-table {
            float: right;
            border-collapse: collapse;
        }
        .doc-meta-table td {
            padding: 2px 10px;
            font-size: 8pt;
        }
        .doc-meta-label {
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            text-align: right;
        }
        .doc-meta-value {
            font-weight: bold;
            color: #0f172a;
            text-align: right;
        }

        /* RECIPIENT BOX */
        .info-grid {
            width: 100%;
            margin-bottom: 25px;
        }
        .info-box {
            background-color: #f8fafc;
            border-radius: 4px;
            padding: 12px;
            border-left: 4px solid #2563eb;
        }
        .info-label {
            font-size: 7.5pt;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }
        .info-name {
            font-size: 11pt;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .info-detail {
            font-size: 8.5pt;
            color: #475569;
            line-height: 1.4;
        }

        /* OPENING MESSAGE */
        .opening-message {
            margin-bottom: 20px;
            font-size: 9.5pt;
            text-align: justify;
            color: #334155;
            line-height: 1.5;
        }

        /* ITEMS TABLE */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .items-table th {
            background-color: #1e293b;
            color: white;
            text-align: left;
            padding: 8px 10px;
            font-size: 8pt;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .items-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 10px;
            vertical-align: top;
            font-size: 9pt;
        }
        .items-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }
        .item-name {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 3px;
        }
        .item-desc {
            font-size: 8pt;
            color: #64748b;
            line-height: 1.3;
        }
        .highlight {
            background-color: #eff6ff;
            color: #2563eb;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 8pt;
        }

        /* TOTALS AND TERMS LAYOUT */
        .bottom-layout {
            width: 100%;
            margin-top: 20px;
        }
        
        /* TERMS */
        .section-title {
            font-size: 9pt;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 8px;
            text-transform: uppercase;
            border-bottom: 1px solid #2563eb;
            padding-bottom: 4px;
            display: inline-block;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .payment-table td {
            padding: 6px 0;
            border-bottom: 1px dashed #cbd5e1;
            font-size: 8.5pt;
        }
        .terms-list {
            padding-left: 0;
            margin: 0;
            list-style: none;
        }
        .terms-list li {
            margin-bottom: 5px;
            font-size: 8pt;
            color: #475569;
            line-height: 1.4;
            padding-left: 12px;
            position: relative;
        }
        .terms-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #2563eb;
            font-weight: bold;
        }

        /* SUMMARY */
        .summary-box {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 6px 0;
            font-size: 9pt;
        }
        .summary-label {
            text-align: left;
            color: #64748b;
            font-weight: 500;
        }
        .summary-value {
            text-align: right;
            color: #0f172a;
            font-weight: bold;
        }
        .total-row {
            border-top: 2px solid #cbd5e1;
        }
        .total-row td {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .total-row .summary-label {
            font-size: 11pt;
            font-weight: bold;
            color: #0f172a;
        }
        .total-row .summary-value {
            font-size: 12pt;
            font-weight: bold;
            color: #2563eb;
        }

        /* CLOSING MESSAGE */
        .closing-message {
            margin: 20px 0;
            font-size: 9.5pt;
            text-align: justify;
            color: #334155;
            line-height: 1.5;
        }

        /* SIGNATURES */
        .signature-section {
            margin-top: 30px;
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
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .sig-space {
            height: 90px;
            vertical-align: bottom;
            text-align: center;
        }
        .sig-line {
            border-bottom: 1px solid #94a3b8;
            width: 70%;
            margin: 0 auto 5px auto;
        }
        .sig-name {
            font-weight: bold;
            font-size: 10pt;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .sig-date {
            font-size: 8pt;
            color: #64748b;
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            font-size: 7.5pt;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }

        .page-break-avoid {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

    {{-- Helper to base64 encode images --}}
    @php
        function getBase64Image($path) {
            if (empty($path)) return '';
            
            // If it's already a base64 string
            if (\Illuminate\Support\Str::startsWith($path, 'data:image')) {
                return $path;
            }
            
            // Check if it's a valid local path
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                return 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
            
            return '';
        }
        
        // Prepare company logo
        $logoData = getBase64Image($company['logo'] ?? '');
    @endphp

    <!-- HEADER -->
    <table class="header-table">
        <tr>
            <td class="w-half valign-bottom">
                @if($logoData)
                    <img src="{{ $logoData }}" alt="Logo" class="company-logo">
                @else
                    <div class="company-name-text">{{ $company['name'] }}</div>
                @endif
                <div class="company-info">
                    @if($company['address']){{ $company['address'] }}<br>@endif
                    @if($company['phone'])T. {{ $company['phone'] }}@endif
                    @if($company['email']) &nbsp;|&nbsp; E. {{ $company['email'] }}@endif
                    @if($company['website'])<br>{{ $company['website'] }}@endif
                </div>
            </td>
            <td class="w-half text-right valign-bottom">
                <div class="doc-title">QUOTATION</div>
                <table class="doc-meta-table">
                    <tr>
                        <td class="doc-meta-label">Reference</td>
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
            <td class="valign-top" style="padding-right: 20px;">
                <div class="info-box">
                    <div class="info-label">Prepared For</div>
                    <div class="info-name">{{ $quotation->customer->company_name ?? $quotation->lead->company_name ?? 'Client Name' }}</div>
                    <div class="info-detail">
                        @if($quotation->customer && $quotation->customer->contact_name)
                            Attn: <strong>{{ $quotation->customer->contact_name }}</strong><br>
                        @endif
                        {{ $quotation->customer->address ?? '' }}<br>
                        {{ $quotation->customer->phone ?? '' }}
                    </div>
                </div>
            </td>
            <td class="w-half valign-top">
                @if($quotation->lead)
                    <div class="info-box" style="background-color: white; border-color: #cbd5e1;">
                        <div class="info-label">Project Details</div>
                        <div class="info-detail" style="font-weight: bold; color: #0f172a;">
                            {{ $quotation->lead->title ?? 'New Project Implementation' }}
                        </div>
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
                    <td class="text-center text-gray" style="font-weight: bold;">{{ $index + 1 }}</td>
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
                    <td class="text-right" style="font-weight: bold;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTALS & TERMS -->
    <table class="bottom-layout page-break-avoid">
        <tr>
            <td class="w-half valign-top" style="padding-right: 30px;">
                
                <!-- PAYMENT SCHEDULE -->
                @if(!empty($calculations['payment_terms']))
                    <div class="section-title">Payment Schedule</div>
                    <table class="payment-table">
                        @foreach($calculations['payment_terms'] as $index => $term)
                            <tr>
                                <td>
                                    <strong>Termin {{ $index + 1 }}</strong><br>
                                    <span style="font-size: 7.5pt; color:#64748b;">{{ $term['description'] }}</span>
                                </td>
                                <td style="text-align: right; font-weight: bold; color: #0f172a; vertical-align: top;">
                                    Rp {{ number_format($term['amount'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif

                <!-- TERMS & CONDITIONS -->
                <div class="section-title mt-4">Terms & Conditions</div>
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

                    {{-- Fallback --}}
                    @if(!$hasTerms)
                        <li>Syarat dan ketentuan pembayaran sesuai dengan termin pembayaran di atas.</li>
                        <li>Penawaran harga ini berlaku selama 30 hari sejak tanggal diterbitkan.</li>
                    @endif
                </ul>
            </td>

            <td class="w-half valign-top">
                <!-- SUMMARY BOX -->
                <div class="summary-box">
                    <table class="summary-table">
                        <tr>
                            <td class="summary-label">Subtotal</td>
                            <td class="summary-value">Rp {{ number_format($calculations['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                        @if($calculations['discount_percentage'] > 0)
                            <tr>
                                <td class="summary-label">Discount ({{ $calculations['discount_percentage'] }}%)</td>
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
                </div>
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
                        @php
                            $approvedSig = '';
                            if($quotation->approved_signature_path) {
                                if(\Illuminate\Support\Str::startsWith($quotation->approved_signature_path, 'data:image')) {
                                    $approvedSig = $quotation->approved_signature_path;
                                } else {
                                    $approvedSig = getBase64Image(public_path('storage/' . $quotation->approved_signature_path));
                                }
                            }
                        @endphp
                        
                        @if($approvedSig)
                            <img src="{{ $approvedSig }}" alt="Signature" style="max-height: 80px; max-width: 180px;">
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
                        @php
                            $preparedSig = '';
                            if($quotation->prepared_signature_path) {
                                if(\Illuminate\Support\Str::startsWith($quotation->prepared_signature_path, 'data:image')) {
                                    $preparedSig = $quotation->prepared_signature_path;
                                } else {
                                    $preparedSig = getBase64Image(public_path('storage/' . $quotation->prepared_signature_path));
                                }
                            }
                        @endphp
                        
                        @if($preparedSig)
                            <img src="{{ $preparedSig }}" alt="Signature" style="max-height: 80px; max-width: 180px;">
                        @endif
                    </div>
                    <div class="sig-line"></div>
                    <div class="sig-name">{{ $quotation->prepared_by ?? $company['name'] }}</div>
                    <div class="sig-date">{{ $quotation->prepared_by_position ?? 'Sales Representative' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        This document is a formal quotation. Pricing is valid until {{ $quotation->valid_until->format('d M Y') }}.<br>
        <strong>{{ $company['name'] }}</strong>
    </div>

</body>
</html>