<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation #{{ $quotation->quotation_number }}</title>
    <style>
        @page {
            margin: 28px 32px 42px 32px;
        }
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 9pt;
            color: #000;
            line-height: 1.35;
            margin: 0;
            padding: 0;
        }

        /* ======== HEADER ======== */
        .header-table {
            width: 100%;
            border-bottom: 2.5px solid #000;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }
        .logo-cell {
            width: 150px;
            vertical-align: middle;
        }
        .company-logo {
            max-height: 80px;
            max-width: 145px;
        }
        .company-detail-cell {
            vertical-align: middle;
            padding-left: 14px;
        }
        .company-name {
            font-size: 17pt;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 3px 0;
        }
        .company-info {
            font-size: 8pt;
            color: #333;
            line-height: 1.6;
        }

        /* ======== DOC META TABLE ======== */
        .doc-meta-label {
            font-size: 8.5pt;
            font-weight: bold;
            color: #000;
            padding: 2px 10px 2px 0;
            white-space: nowrap;
        }
        .doc-meta-value {
            font-size: 8.5pt;
            color: #000;
            padding: 2px 0;
        }

        /* ======== RECIPIENT ======== */
        .kepada-label {
            font-size: 9pt;
            color: #000;
            margin-bottom: 2px;
        }
        .kepada-name {
            font-size: 9.5pt;
            font-weight: bold;
            color: #000;
        }
        .kepada-detail {
            font-size: 8.5pt;
            color: #222;
            line-height: 1.45;
        }

        /* ======== OPENING MESSAGE ======== */
        .opening-msg {
            font-size: 8.5pt;
            text-align: justify;
            margin-bottom: 12px;
            color: #000;
            line-height: 1.55;
        }

        /* ======== ITEMS TABLE ======== */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        .items-table th {
            background-color: #e8e8e8;
            border: 1px solid #888;
            padding: 6px 8px;
            font-size: 8.5pt;
            font-weight: bold;
            text-align: center;
            color: #000;
        }
        .items-table td {
            border: 1px solid #aaa;
            padding: 5px 8px;
            font-size: 8.5pt;
            vertical-align: top;
            color: #000;
        }
        .items-table td.col-no   { text-align: center; width: 24px; }
        .items-table td.col-desc { text-align: left; }
        .items-table td.col-harga { text-align: right; white-space: nowrap; width: 100px; }
        .items-table td.col-qty   { text-align: center; width: 40px; }
        .items-table td.col-jumlah{ text-align: right; font-weight: bold; white-space: nowrap; width: 110px; }
        .item-name { font-weight: bold; }
        .item-sub  { font-size: 7.5pt; color: #555; margin-top: 1px; }

        /* TOTAL ROW */
        .total-row td {
            border: 1px solid #888;
            padding: 6px 8px;
            font-size: 9.5pt;
            font-weight: bold;
        }
        .total-sub td {
            border: 1px solid #bbb;
            padding: 4px 8px;
            font-size: 8.5pt;
            background: #f5f5f5;
        }

        /* ======== BOTTOM SECTION ======== */
        .bottom-notes-cell {
            vertical-align: top;
            width: 52%;
            padding-right: 18px;
        }
        .bottom-sign-cell {
            vertical-align: top;
            width: 48%;
        }
        .sec-label {
            font-size: 8.5pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 4px;
            color: #000;
        }
        .terms-ol {
            margin: 0;
            padding: 0;
            counter-reset: term-counter;
        }
        .terms-ol li {
            list-style: none;
            font-size: 7.8pt;
            color: #111;
            line-height: 1.45;
            padding-left: 15px;
            position: relative;
            margin-bottom: 2px;
        }
        .terms-ol li:before {
            content: counter(term-counter) ".";
            counter-increment: term-counter;
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        /* ======== SIGNATURE AREA ======== */
        .sign-container {
            text-align: center;
        }
        .sign-city-date {
            font-size: 8.5pt;
            color: #000;
            margin-bottom: 4px;
            text-align: left;
        }
        .sign-greeting {
            font-size: 8.5pt;
            font-weight: bold;
            margin-bottom: 6px;
            color: #000;
        }

        /* Stamp Effect */
        .stamp-wrapper {
            position: relative;
            height: 90px;
            width: 200px;
            margin: 0 auto;
        }
        .stamp-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 88px;
            height: 88px;
            border-radius: 50%;
            border: 3px solid #003399;
            box-sizing: border-box;
            opacity: 0.7;
        }
        .stamp-circle-inner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 74px;
            height: 74px;
            border-radius: 50%;
            border: 1.5px dashed #003399;
            box-sizing: border-box;
            opacity: 0.6;
        }
        .stamp-text-top {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            text-align: center;
            font-size: 5pt;
            font-weight: bold;
            color: #003399;
            letter-spacing: 0.5px;
            line-height: 1.2;
            margin-top: -16px;
            opacity: 0.8;
        }
        .stamp-text-mid {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -52%);
            font-size: 5.5pt;
            font-weight: bold;
            color: #003399;
            letter-spacing: 0.3px;
            text-align: center;
            width: 60px;
            opacity: 0.8;
        }
        .stamp-star {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 8pt;
            color: #003399;
            margin-top: 10px;
            opacity: 0.7;
        }

        .sig-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -58%);
            max-width: 80px;
            max-height: 55px;
            filter: grayscale(100%) contrast(200%) brightness(0%);
        }

        .sign-line {
            border-bottom: 1.5px solid #000;
            width: 170px;
            margin: 0 auto 3px;
        }
        .sign-name {
            font-size: 9pt;
            font-weight: bold;
            color: #000;
            text-align: center;
        }
        .sign-position {
            font-size: 8pt;
            color: #333;
            text-align: center;
        }

        /* CLIENT SIGN BOX */
        .client-sign-box {
            border: 1px solid #aaa;
            padding: 6px 8px;
            text-align: center;
            height: 90px;
        }
        .client-sign-label {
            font-size: 7.5pt;
            color: #555;
            margin-bottom: 0;
        }

        /* FOOTER */
        .pdf-footer {
            position: fixed;
            bottom: -35px;
            left: 0;
            right: 0;
            height: 30px;
            border-top: 1.5px solid #888;
            padding-top: 5px;
            text-align: center;
            font-size: 7.5pt;
            color: #555;
        }

        .avoid-break { page-break-inside: avoid; }
    </style>
</head>
<body>

@php
    // Base64 image helper
    function pdfB64Img($path) {
        if (empty($path)) return '';
        if (\Illuminate\Support\Str::startsWith($path, 'data:image')) return $path;
        if (!empty($path) && file_exists($path)) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if ($ext === 'jpg') $ext = 'jpeg';
            return 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($path));
        }
        return '';
    }

    $logoB64 = pdfB64Img($company['logo'] ?? '');

    // Signature paths
    $prepSigB64 = '';
    if (!empty($quotation->prepared_signature_path)) {
        $sp = \Illuminate\Support\Str::startsWith($quotation->prepared_signature_path, 'data:image')
            ? $quotation->prepared_signature_path
            : pdfB64Img(public_path('storage/' . $quotation->prepared_signature_path));
        $prepSigB64 = $sp;
    }

    $appSigB64 = '';
    if (!empty($quotation->approved_signature_path)) {
        $sp = \Illuminate\Support\Str::startsWith($quotation->approved_signature_path, 'data:image')
            ? $quotation->approved_signature_path
            : pdfB64Img(public_path('storage/' . $quotation->approved_signature_path));
        $appSigB64 = $sp;
    }

    $clientCompany = $quotation->customer->company_name ?? $quotation->lead->company_name ?? '';
    $clientContact = $quotation->customer->contact_name ?? '';
    $clientAddress = $quotation->customer->address ?? '';
    $clientPhone   = $quotation->customer->phone ?? '';

    $companyNameShort = strtoupper(preg_replace('/^(PT\.?\s*|CV\.?\s*)/i', '', $company['name']));
@endphp

<!-- ===== HEADER ===== -->
<table class="header-table">
    <tr>
        <td class="logo-cell">
            @if($logoB64)
                <img src="{{ $logoB64 }}" alt="Logo" class="company-logo">
            @endif
        </td>
        <td class="company-detail-cell">
            <div class="company-name">{{ $company['name'] }}</div>
            <div class="company-info">
                {{ $company['address'] }}<br>
                @if(!empty($company['phone']))HP : {{ $company['phone'] }}@endif
                @if(!empty($company['email']))&nbsp;&nbsp;&nbsp;email : {{ $company['email'] }}@endif
            </div>
        </td>
    </tr>
</table>

<!-- ===== RECIPIENT + DOC META ===== -->
<table style="width: 100%; margin-bottom: 12px;">
    <tr>
        <!-- Left: Recipient -->
        <td style="vertical-align: top; width: 58%;">
            <div class="kepada-label">
                Kepada Yth. :
            </div>
            @if($clientContact)
                <div class="kepada-name">{{ $clientContact }}</div>
                @if($clientCompany)
                    <div class="kepada-detail">{{ $clientCompany }}</div>
                @endif
            @elseif($clientCompany)
                <div class="kepada-name">{{ $clientCompany }}</div>
            @endif
            @if($clientAddress)
                <div class="kepada-detail">{{ $clientAddress }}</div>
            @endif
            @if($clientPhone)
                <div class="kepada-detail">Telp : {{ $clientPhone }}</div>
            @endif
        </td>
        <!-- Right: Meta -->
        <td style="vertical-align: top; width: 42%; padding-left: 10px;">
            <table style="float: right; border-collapse: collapse;">
                <tr>
                    <td class="doc-meta-label">No. Penawaran</td>
                    <td class="doc-meta-value">: <strong>{{ $quotation->quotation_number }}</strong></td>
                </tr>
                <tr>
                    <td class="doc-meta-label">Tanggal</td>
                    <td class="doc-meta-value">: {{ $quotation->created_at->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td class="doc-meta-label">Berlaku Hingga</td>
                    <td class="doc-meta-value">: {{ $quotation->valid_until->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                @if($quotation->lead && $quotation->lead->title)
                <tr>
                    <td class="doc-meta-label">Perihal</td>
                    <td class="doc-meta-value" style="max-width: 180px;">: {{ $quotation->lead->title }}</td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>

<!-- ===== OPENING MESSAGE ===== -->
@if($quotation->opening_content)
<div class="opening-msg">
    {!! strip_tags($quotation->opening_content, '<br><b><strong><em><i>') !!}
</div>
@endif

<!-- ===== ITEMS TABLE ===== -->
<table class="items-table avoid-break">
    <thead>
        <tr>
            <th style="width: 24px;">No.</th>
            <th style="text-align: left;">ITEM / URAIAN PEKERJAAN</th>
            <th style="width: 105px;">HARGA</th>
            <th style="width: 38px;">QTY</th>
            <th style="width: 115px;">JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        @foreach($quotation->items as $idx => $item)
            @php
                $unitPrice   = (float)($item->unit_price ?? 0);
                $discPct     = (float)($item->discount_percent ?? 0);
                $lineTotal   = (float)($item->total ?? ($unitPrice * (1 - $discPct/100)));
            @endphp
            <tr>
                <td class="col-no">{{ $idx + 1 }}</td>
                <td class="col-desc">
                    <div class="item-name">{{ $item->name }}</div>
                    @if($item->description)
                        <div class="item-sub">{{ $item->description }}</div>
                    @endif
                    @if($discPct > 0)
                        <div class="item-sub">Diskon : {{ number_format($discPct, 0) }}%</div>
                    @endif
                </td>
                <td class="col-harga">
                    Rp&nbsp;{{ number_format($unitPrice, 0, ',', '.') }}
                </td>
                <td class="col-qty">1</td>
                <td class="col-jumlah">
                    Rp&nbsp;{{ number_format($lineTotal, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach

        {{-- Padding rows to make table look fuller --}}
        @if($quotation->items->count() < 6)
            @for($p = $quotation->items->count(); $p < 6; $p++)
            <tr>
                <td class="col-no" style="height: 17px;">&nbsp;</td>
                <td class="col-desc">&nbsp;</td>
                <td class="col-harga">&nbsp;</td>
                <td class="col-qty">&nbsp;</td>
                <td class="col-jumlah">&nbsp;</td>
            </tr>
            @endfor
        @endif
    </tbody>
</table>

<!-- ===== TOTAL ===== -->
<table class="items-table" style="border-collapse: collapse; width: 100%;">
    @if($calculations['discount_percentage'] > 0)
    <tr class="total-sub">
        <td colspan="3" style="text-align: right; font-weight: normal; border-top: 1px solid #888; padding: 4px 8px;">Sub Total</td>
        <td colspan="2" style="text-align: right; border-top: 1px solid #888; padding: 4px 8px;">Rp&nbsp;{{ number_format($calculations['subtotal'], 0, ',', '.') }}</td>
    </tr>
    <tr class="total-sub">
        <td colspan="3" style="text-align: right; font-weight: normal; padding: 4px 8px;">Diskon ({{ number_format($calculations['discount_percentage'],0) }}%)</td>
        <td colspan="2" style="text-align: right; color:#b00; padding: 4px 8px;">- Rp&nbsp;{{ number_format($calculations['discount_amount'], 0, ',', '.') }}</td>
    </tr>
    @endif
    @if(isset($quotation->include_tax) && $quotation->include_tax && $calculations['tax_amount'] > 0)
    <tr class="total-sub">
        <td colspan="3" style="text-align: right; font-weight: normal; padding: 4px 8px;">PPN {{ number_format($calculations['tax_percentage'],0) }}%</td>
        <td colspan="2" style="text-align: right; padding: 4px 8px;">Rp&nbsp;{{ number_format($calculations['tax_amount'], 0, ',', '.') }}</td>
    </tr>
    @endif
    <tr class="total-row">
        <td colspan="3" style="text-align: right; border: 1.5px solid #555; background: #eee;">TOTAL BIAYA &nbsp;=</td>
        <td colspan="2" style="text-align: right; border: 1.5px solid #555; background: #ddd; font-size: 10.5pt; color: #000;">
            Rp&nbsp;{{ number_format($calculations['grand_total'], 0, ',', '.') }}
        </td>
    </tr>
</table>

<!-- ===== BOTTOM: NOTES LEFT + SIGNATURE RIGHT ===== -->
@php
    $defaultTerms = \App\Models\Quotation::getDefaultTerms();
    $selectedTerms = [];
    if ($quotation->terms_and_conditions && is_array($quotation->terms_and_conditions)) {
        foreach ($quotation->terms_and_conditions as $key) {
            if (isset($defaultTerms[$key])) {
                $selectedTerms[] = $defaultTerms[$key];
            }
        }
    }
    if ($quotation->custom_terms && is_array($quotation->custom_terms)) {
        foreach ($quotation->custom_terms as $ct) {
            if (!empty($ct['term'])) $selectedTerms[] = $ct['term'];
        }
    }
    $payTerms = $calculations['payment_terms'] ?? [];
@endphp

<table style="width: 100%; margin-top: 16px;" class="avoid-break">
    <tr>
        <!-- ===== LEFT: Notes & Termin ===== -->
        <td class="bottom-notes-cell">
            @if(!empty($selectedTerms))
                <div class="sec-label">Catatan :</div>
                <ul class="terms-ol">
                    @foreach($selectedTerms as $t)
                        <li>{{ $t }}</li>
                    @endforeach
                </ul>
            @endif

            @if(!empty($payTerms))
                <div class="sec-label" style="margin-top: 10px;">Termin Pembayaran :</div>
                <ul class="terms-ol">
                    @foreach($payTerms as $pt)
                        <li>{{ $pt['description'] }} &mdash; <strong>Rp&nbsp;{{ number_format($pt['amount'], 0, ',', '.') }}</strong></li>
                    @endforeach
                </ul>
            @endif
        </td>

        <!-- ===== RIGHT: Closing + Signatures ===== -->
        <td class="bottom-sign-cell">
            @if($quotation->closing_content)
                <div style="font-size: 8pt; text-align: justify; margin-bottom: 10px; color: #000; line-height: 1.5;">
                    {!! strip_tags($quotation->closing_content, '<br><b><strong>') !!}
                </div>
            @endif

@php
    // Generate clean GD PNG stamp
    $stampPng = \App\Services\QuotationPdfService::generateStampPng($company['name']);
@endphp

            <!-- Perfectly Aligned 4-Row Signature Table -->
            <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                <!-- ROW 1: City & Greetings -->
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top; padding-bottom: 4px;">
                        <div style="font-size: 8pt; color: #333; margin-bottom: 2px;">Bekasi, {{ $quotation->created_at->locale('id')->isoFormat('DD MMMM YYYY') }}</div>
                        <div style="font-size: 8.5pt; font-weight: bold; color: #000;">Hormat Kami,</div>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: top; padding-bottom: 4px;">
                        <div style="font-size: 8pt; color: transparent; margin-bottom: 2px;">&nbsp;</div>
                        <div style="font-size: 8.5pt; font-weight: bold; color: #000;">Menyetujui,</div>
                    </td>
                </tr>

                <!-- ROW 2: Fixed Height (85px) Stamp & Signature Area -->
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: middle; height: 85px;">
                        <div style="position: relative; width: 100px; height: 85px; margin: 0 auto;">
                            @if($stampPng)
                                <img src="{{ $stampPng }}" style="width: 85px; height: 85px; position: absolute; top: 0; left: 7px; opacity: 0.85;">
                            @endif
                            @if($prepSigB64)
                                <img src="{{ $prepSigB64 }}" style="width: 80px; max-height: 50px; position: absolute; top: 18px; left: 10px; filter: grayscale(100%) contrast(400%) brightness(0%);">
                            @endif
                        </div>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: middle; height: 85px;">
                        <div style="position: relative; width: 100px; height: 85px; margin: 0 auto;">
                            @if($appSigB64)
                                <img src="{{ $appSigB64 }}" style="width: 80px; max-height: 50px; position: absolute; top: 18px; left: 10px; filter: grayscale(100%) contrast(400%) brightness(0%);">
                            @endif
                        </div>
                    </td>
                </tr>

                <!-- ROW 3: Black Underlines (Pixel-aligned) -->
                <tr>
                    <td style="width: 50%; text-align: center; padding: 2px 4px 4px 4px;">
                        <div style="border-bottom: 1.5px solid #000; width: 140px; margin: 0 auto;"></div>
                    </td>
                    <td style="width: 50%; text-align: center; padding: 2px 4px 4px 4px;">
                        <div style="border-bottom: 1.5px solid #000; width: 140px; margin: 0 auto;"></div>
                    </td>
                </tr>

                <!-- ROW 4: Name & Position / Date -->
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <div style="font-size: 8.5pt; font-weight: bold; color: #000; text-transform: uppercase;">{{ $quotation->prepared_by ?? $company['name'] }}</div>
                        <div style="font-size: 7.5pt; color: #444;">{{ $quotation->prepared_by_position ?? 'Sales Manager' }}</div>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <div style="font-size: 8.5pt; font-weight: bold; color: #000; text-transform: uppercase;">{{ $clientCompany ?: '________________________' }}</div>
                        <div style="font-size: 7.5pt; color: #444;">Tgl : ___________________</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- ===== FOOTER ===== -->
<div class="pdf-footer">
    {{ $company['name'] }}
    @if($company['phone']) &nbsp;|&nbsp; {{ $company['phone'] }} @endif
    @if($company['email']) &nbsp;|&nbsp; {{ $company['email'] }} @endif
    &nbsp;|&nbsp; Dok. No. {{ $quotation->quotation_number }}
    &nbsp;|&nbsp; Berlaku s/d {{ $quotation->valid_until->locale('id')->isoFormat('DD MMMM YYYY') }}
</div>

</body>
</html>