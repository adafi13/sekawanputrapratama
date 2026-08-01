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
            color: #1e293b;
            line-height: 1.4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .w-half { width: 50%; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .valign-top { vertical-align: top; }
        .valign-bottom { vertical-align: bottom; }
        
        /* HEADER */
        .header-container {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #1e40af;
        }
        .company-logo {
            max-height: 70px;
            max-width: 220px;
            margin-bottom: 8px;
        }
        .company-name {
            font-size: 16pt;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 4px;
        }
        .company-info {
            font-size: 8pt;
            color: #475569;
            line-height: 1.3;
        }
        .doc-title {
            font-size: 24pt;
            font-weight: bold;
            color: #1e40af;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        .meta-table {
            width: 100%;
        }
        .meta-table td {
            padding: 3px 0;
            font-size: 8.5pt;
        }
        .meta-label {
            color: #64748b;
            font-weight: bold;
            text-transform: uppercase;
        }
        .meta-value {
            color: #0f172a;
            font-weight: bold;
            text-align: right;
        }

        /* RECIPIENT */
        .info-container {
            margin-bottom: 25px;
        }
        .info-box {
            border: 1px solid #cbd5e1;
            padding: 12px;
            border-radius: 4px;
            background: #f8fafc;
        }
        .info-label {
            font-size: 7.5pt;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 6px;
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

        /* OPENING */
        .opening-message {
            margin-bottom: 20px;
            text-align: justify;
            font-size: 9.5pt;
            line-height: 1.5;
        }

        /* ITEMS TABLE */
        .items-table {
            margin-bottom: 25px;
        }
        .items-table th {
            background-color: #1e40af;
            color: white;
            padding: 10px;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #1e40af;
        }
        .items-table td {
            padding: 10px;
            border: 1px solid #cbd5e1;
            font-size: 9pt;
            vertical-align: top;
        }
        .items-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }
        .item-name {
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .item-desc {
            font-size: 8pt;
            color: #475569;
        }

        /* BOTTOM SECTION */
        .bottom-section {
            width: 100%;
        }
        .section-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 8px;
            text-transform: uppercase;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 4px;
        }
        .payment-table td {
            padding: 6px 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 8.5pt;
        }
        .terms-list {
            padding-left: 14px;
            margin: 0;
        }
        .terms-list li {
            margin-bottom: 6px;
            font-size: 8pt;
            color: #475569;
            line-height: 1.4;
        }

        /* SUMMARY BOX */
        .summary-box {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 10px;
        }
        .summary-table td {
            padding: 6px 10px;
            font-size: 9pt;
        }
        .summary-label {
            color: #475569;
            font-weight: bold;
        }
        .summary-value {
            text-align: right;
            font-weight: bold;
            color: #0f172a;
        }
        .total-row {
            background-color: #1e40af;
        }
        .total-row td {
            color: white;
            font-size: 11pt;
            font-weight: bold;
            padding: 10px;
        }
        .total-row .summary-label {
            color: white;
        }
        .total-row .summary-value {
            color: white;
        }

        /* SIGNATURE */
        .closing-message {
            margin: 25px 0;
            text-align: justify;
            font-size: 9.5pt;
            line-height: 1.5;
        }
        .signature-table {
            margin-top: 30px;
            page-break-inside: avoid;
        }
        .sig-role {
            font-size: 8.5pt;
            font-weight: bold;
            color: #475569;
            text-transform: uppercase;
        }
        .sig-space {
            height: 90px;
            vertical-align: bottom;
            padding-bottom: 5px;
        }
        .sig-img {
            max-height: 80px;
            max-width: 180px;
        }
        .sig-line {
            border-top: 1px solid #0f172a;
            width: 200px;
            margin: 0 auto;
            padding-top: 4px;
        }
        .sig-name {
            font-size: 10pt;
            font-weight: bold;
            color: #0f172a;
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
            font-size: 8pt;
            color: #94a3b8;
            border-top: 1px solid #cbd5e1;
            padding-top: 10px;
        }
        .page-break-avoid {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

    @php
        function getBase64Image($path) {
            if (empty($path)) return '';
            if (\Illuminate\Support\Str::startsWith($path, 'data:image')) {
                return $path;
            }
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                return 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
            return '';
        }
        $logoData = getBase64Image($company['logo'] ?? '');
    @endphp

    <!-- HEADER -->
    <div class="header-container">
        <table>
            <tr>
                <td class="w-half valign-bottom">
                    @if($logoData)
                        <img src="{{ $logoData }}" alt="Logo" class="company-logo">
                    @else
                        <div class="company-name">{{ $company['name'] }}</div>
                    @endif
                    <div class="company-info">
                        @if($company['address']){{ $company['address'] }}<br>@endif
                        @if($company['phone'])Telp: {{ $company['phone'] }}@endif
                        @if($company['email']) | Email: {{ $company['email'] }}@endif
                    </div>
                </td>
                <td class="w-half valign-bottom text-right">
                    <div class="doc-title">QUOTATION</div>
                    <table class="meta-table">
                        <tr>
                            <td class="meta-label">Reference No</td>
                            <td class="meta-value">#{{ $quotation->quotation_number }}</td>
                        </tr>
                        <tr>
                            <td class="meta-label">Date Issued</td>
                            <td class="meta-value">{{ $quotation->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="meta-label">Valid Until</td>
                            <td class="meta-value" style="color: #dc2626;">{{ $quotation->valid_until->format('d M Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <!-- RECIPIENT -->
    <div class="info-container">
        <table>
            <tr>
                <td class="valign-top" style="padding-right: 20px; width: 60%;">
                    <div class="info-box">
                        <div class="info-label">Quotation Prepared For</div>
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
                <td class="valign-top" style="width: 40%;">
                    @if($quotation->lead)
                        <div class="info-box" style="background: white;">
                            <div class="info-label">Project Details</div>
                            <div class="info-detail" style="font-weight: bold; color: #0f172a;">
                                {{ $quotation->lead->title ?? 'New Project' }}
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- OPENING MESSAGE -->
    @if($quotation->opening_content)
        <div class="opening-message">
            {!! $quotation->opening_content !!}
        </div>
    @endif

    <!-- ITEMS -->
    <table class="items-table">
        <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="45%" class="text-left">Description</th>
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
                    <td class="text-center text-bold">{{ $index + 1 }}</td>
                    <td>
                        <div class="item-name">{{ $item->name }}</div>
                        @if($item->description)
                            <div class="item-desc">{{ $item->description }}</div>
                        @endif
                    </td>
                    <td class="text-right">Rp {{ number_format($price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $discPercent > 0 ? number_format($discPercent, 0) . '%' : '-' }}</td>
                    <td class="text-right text-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- BOTTOM LAYOUT -->
    <table class="bottom-section page-break-avoid">
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
                                    <span style="color:#64748b;">{{ $term['description'] }}</span>
                                </td>
                                <td class="text-right text-bold">
                                    Rp {{ number_format($term['amount'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="margin-bottom: 20px;"></div>
                @endif

                <!-- TERMS -->
                <div class="section-title">Terms & Conditions</div>
                <ul class="terms-list">
                    @php
                        $defaultTerms = \App\Models\Quotation::getDefaultTerms();
                        $hasTerms = false;
                    @endphp
                    @if($quotation->terms_and_conditions && is_array($quotation->terms_and_conditions))
                        @foreach($quotation->terms_and_conditions as $key)
                            @if(isset($defaultTerms[$key]))
                                <li>{{ $defaultTerms[$key] }}</li>
                                @php $hasTerms = true; @endphp
                            @endif
                        @endforeach
                    @endif
                    @if($quotation->custom_terms && is_array($quotation->custom_terms))
                        @foreach($quotation->custom_terms as $customTerm)
                            @if(isset($customTerm['term']) && !empty($customTerm['term']))
                                <li>{{ $customTerm['term'] }}</li>
                                @php $hasTerms = true; @endphp
                            @endif
                        @endforeach
                    @endif
                    @if(!$hasTerms)
                        <li>Syarat dan ketentuan sesuai kesepakatan tertulis.</li>
                        <li>Harga dapat berubah jika terdapat perubahan lingkup pekerjaan.</li>
                    @endif
                </ul>
            </td>

            <td class="w-half valign-top">
                <!-- SUMMARY -->
                <div class="summary-box">
                    <table class="summary-table">
                        <tr>
                            <td class="summary-label">Subtotal</td>
                            <td class="summary-value">Rp {{ number_format($calculations['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                        @if($calculations['discount_percentage'] > 0)
                            <tr>
                                <td class="summary-label">Discount ({{ $calculations['discount_percentage'] }}%)</td>
                                <td class="summary-value" style="color: #dc2626;">- Rp {{ number_format($calculations['discount_amount'], 0, ',', '.') }}</td>
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

    <!-- SIGNATURES (FIXED ALIGNMENT) -->
    <table class="signature-table w-full">
        <tr>
            <td class="w-half text-center valign-top">
                <div class="sig-role">Client Approval</div>
            </td>
            <td class="w-half text-center valign-top">
                <div class="sig-role">Authorized Representative</div>
            </td>
        </tr>
        <tr>
            <td class="w-half text-center sig-space">
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
                    <img src="{{ $approvedSig }}" alt="Signature" class="sig-img">
                @endif
            </td>
            <td class="w-half text-center sig-space">
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
                    <img src="{{ $preparedSig }}" alt="Signature" class="sig-img">
                @endif
            </td>
        </tr>
        <tr>
            <td class="w-half text-center valign-top">
                <div class="sig-line"></div>
                <div class="sig-name">{{ $quotation->customer->company_name ?? $quotation->lead->company_name ?? '_______________' }}</div>
                <div class="sig-date">Date: _________________</div>
            </td>
            <td class="w-half text-center valign-top">
                <div class="sig-line"></div>
                <div class="sig-name">{{ $quotation->prepared_by ?? $company['name'] }}</div>
                <div class="sig-date">{{ $quotation->prepared_by_position ?? 'Sales Representative' }}</div>
            </td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        This document is a formal quotation. Pricing is valid until {{ $quotation->valid_until->format('d M Y') }}.<br>
        <strong>{{ $company['name'] }}</strong>
    </div>

</body>
</html>