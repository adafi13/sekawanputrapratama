<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation #{{ $quotation->quotation_number }}</title>
    <style>
        @page {
            margin: 28px 30px 40px 30px;
        }
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 9pt;
            color: #000000;
            line-height: 1.35;
            margin: 0;
            padding: 0;
        }

        /* ======== HEADER ======== */
        .header-wrapper {
            width: 100%;
            border-bottom: 2px solid #000000;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }
        .logo-cell {
            width: 160px;
            vertical-align: middle;
        }
        .company-logo {
            max-height: 80px;
            max-width: 150px;
        }
        .company-detail-cell {
            vertical-align: middle;
            padding-left: 16px;
        }
        .company-name {
            font-size: 18pt;
            font-weight: bold;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 4px 0;
        }
        .company-info {
            font-size: 8pt;
            color: #333333;
            line-height: 1.5;
        }

        /* ======== DOC META ======== */
        .doc-meta-wrapper {
            width: 100%;
            margin-bottom: 14px;
        }
        .doc-label {
            font-size: 8.5pt;
            font-weight: bold;
            color: #333;
        }
        .doc-value {
            font-size: 8.5pt;
            color: #000;
        }

        /* ======== TO/FROM BOX ======== */
        .recipient-box {
            margin-bottom: 12px;
        }
        .recipient-label {
            font-size: 8.5pt;
            color: #000;
            margin-bottom: 3px;
        }
        .recipient-name {
            font-size: 10pt;
            font-weight: bold;
            color: #000;
        }
        .recipient-address {
            font-size: 8.5pt;
            color: #222;
        }
        .subject-line {
            font-size: 9pt;
            margin-bottom: 12px;
        }

        /* ======== OPENING MESSAGE ======== */
        .opening-message {
            font-size: 9pt;
            text-align: justify;
            margin-bottom: 14px;
            color: #000;
            line-height: 1.5;
        }

        /* ======== ITEMS TABLE ======== */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        .items-table th {
            background-color: #f0f0f0;
            border: 1px solid #999999;
            padding: 6px 8px;
            font-size: 8.5pt;
            font-weight: bold;
            text-align: center;
            color: #000000;
        }
        .items-table td {
            border: 1px solid #999999;
            padding: 6px 8px;
            font-size: 8.5pt;
            vertical-align: top;
            color: #000000;
        }
        .items-table td.num { text-align: center; width: 26px; }
        .items-table td.desc { text-align: left; }
        .items-table td.price { text-align: right; white-space: nowrap; }
        .items-table td.qty { text-align: center; width: 40px; }
        .items-table td.amount { text-align: right; font-weight: bold; white-space: nowrap; }
        .items-table tr:nth-child(even) td { background-color: #fafafa; }
        .item-name { font-weight: bold; margin-bottom: 1px; }
        .item-desc { font-size: 7.5pt; color: #555; }

        /* ======== TOTAL ROW ======== */
        .total-row td {
            border: 1px solid #999;
            padding: 6px 8px;
            font-size: 9pt;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        /* ======== BOTTOM SECTION ======== */
        .bottom-table {
            width: 100%;
            margin-top: 14px;
        }
        .bottom-table td.notes-cell {
            vertical-align: top;
            width: 55%;
            padding-right: 20px;
        }
        .bottom-table td.sign-cell {
            vertical-align: top;
            width: 45%;
        }

        /* NOTES/TERMS */
        .section-label {
            font-size: 8.5pt;
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
            text-decoration: underline;
        }
        .note-text {
            font-size: 8pt;
            color: #222;
            line-height: 1.45;
            margin-bottom: 12px;
        }
        .terms-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .terms-list li {
            font-size: 8pt;
            color: #222;
            padding: 1px 0;
            padding-left: 14px;
            position: relative;
            line-height: 1.4;
        }
        .terms-list li:before {
            content: counter(li-counter) ".";
            counter-increment: li-counter;
            position: absolute;
            left: 0;
            font-weight: bold;
        }
        .terms-ol {
            counter-reset: li-counter;
        }

        /* PAYMENT SCHEDULE */
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        .payment-table td {
            padding: 3px 0;
            font-size: 8pt;
            border-bottom: 1px dashed #ccc;
            color: #222;
        }
        .payment-table td.pay-amount {
            text-align: right;
            font-weight: bold;
        }

        /* SIGNATURE BOX */
        .sign-city {
            font-size: 8.5pt;
            color: #000;
            margin-bottom: 4px;
        }
        .sign-greeting {
            font-size: 8.5pt;
            font-weight: bold;
            margin-bottom: 55px;
            color: #000;
        }
        .sign-line {
            border-bottom: 1px solid #000;
            width: 160px;
            margin-bottom: 3px;
        }
        .sign-name {
            font-size: 9pt;
            font-weight: bold;
            color: #000;
        }
        .sign-position {
            font-size: 8pt;
            color: #444;
        }
        .sign-img {
            max-height: 60px;
            max-width: 140px;
            position: absolute;
            bottom: 5px;
            left: 10px;
        }
        .sign-space {
            position: relative;
            height: 65px;
        }

        /* CLIENT APPROVAL BOX */
        .approve-box {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
            margin-bottom: 8px;
        }
        .approve-label {
            font-size: 8pt;
            color: #555;
            margin-bottom: 40px;
        }
        .approve-line {
            border-bottom: 1px solid #555;
            margin-bottom: 3px;
        }
        .approve-name {
            font-size: 8pt;
            font-weight: bold;
        }
        .approve-date {
            font-size: 7.5pt;
            color: #666;
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: -28px;
            left: 0;
            right: 0;
            height: 28px;
            border-top: 1px solid #999;
            padding-top: 6px;
            text-align: center;
            font-size: 7.5pt;
            color: #555;
        }

        .page-break-avoid { page-break-inside: avoid; }
    </style>
</head>
<body>

@php
    function getBase64Img($path) {
        if (empty($path)) return '';
        if (\Illuminate\Support\Str::startsWith($path, 'data:image')) return $path;
        if (file_exists($path)) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if ($ext === 'jpg') $ext = 'jpeg';
            $data = file_get_contents($path);
            return 'data:image/' . $ext . ';base64,' . base64_encode($data);
        }
        return '';
    }
    $logoData = getBase64Img($company['logo'] ?? '');

    // Signature images
    $preparedSigData = '';
    if ($quotation->prepared_signature_path) {
        if (\Illuminate\Support\Str::startsWith($quotation->prepared_signature_path, 'data:image')) {
            $preparedSigData = $quotation->prepared_signature_path;
        } else {
            $preparedSigData = getBase64Img(public_path('storage/' . $quotation->prepared_signature_path));
        }
    }
    $approvedSigData = '';
    if ($quotation->approved_signature_path) {
        if (\Illuminate\Support\Str::startsWith($quotation->approved_signature_path, 'data:image')) {
            $approvedSigData = $quotation->approved_signature_path;
        } else {
            $approvedSigData = getBase64Img(public_path('storage/' . $quotation->approved_signature_path));
        }
    }

    $clientCompanyName = $quotation->customer->company_name ?? $quotation->lead->company_name ?? '';
    $clientAddress = $quotation->customer->address ?? '';
    $clientPhone = $quotation->customer->phone ?? '';
    $clientContact = $quotation->customer->contact_name ?? '';
@endphp

<!-- HEADER -->
<table class="header-wrapper">
    <tr>
        <td class="logo-cell">
            @if($logoData)
                <img src="{{ $logoData }}" alt="Logo" class="company-logo">
            @else
                <div class="company-name">{{ $company['name'] }}</div>
            @endif
        </td>
        <td class="company-detail-cell">
            @if(!$logoData)
            @else
                <div class="company-name">{{ $company['name'] }}</div>
            @endif
            <div class="company-info">
                {{ $company['address'] }}<br>
                @if($company['phone'])HP : {{ $company['phone'] }}@endif
                @if($company['email'])&nbsp;&nbsp;|&nbsp;&nbsp;email : {{ $company['email'] }}@endif
            </div>
        </td>
    </tr>
</table>

<!-- RECIPIENT & DOC META -->
<table style="width: 100%; margin-bottom: 12px;">
    <tr>
        <td style="vertical-align: top; width: 60%;">
            <div class="recipient-label">Kepada Yth. :
                @if($clientContact)
                    <strong>{{ $clientContact }}</strong>
                @elseif($clientCompanyName)
                    <strong>{{ $clientCompanyName }}</strong>
                @endif
            </div>
            @if($clientCompanyName && $clientContact)
                <div class="recipient-address">{{ $clientCompanyName }}</div>
            @endif
            @if($clientAddress)
                <div class="recipient-address">{{ $clientAddress }}</div>
            @endif
            @if($clientPhone)
                <div class="recipient-address">Telp : {{ $clientPhone }}</div>
            @endif
        </td>
        <td style="vertical-align: top; width: 40%; text-align: right;">
            <table style="float: right;">
                <tr>
                    <td class="doc-label" style="padding: 2px 8px 2px 0;">No. Penawaran</td>
                    <td class="doc-value" style="padding: 2px 0;">: <strong>{{ $quotation->quotation_number }}</strong></td>
                </tr>
                <tr>
                    <td class="doc-label" style="padding: 2px 8px 2px 0;">Tanggal</td>
                    <td class="doc-value" style="padding: 2px 0;">: {{ $quotation->created_at->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td class="doc-label" style="padding: 2px 8px 2px 0;">Berlaku Hingga</td>
                    <td class="doc-value" style="padding: 2px 0;">: {{ $quotation->valid_until->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                @if($quotation->lead && $quotation->lead->title)
                <tr>
                    <td class="doc-label" style="padding: 2px 8px 2px 0;">Perihal</td>
                    <td class="doc-value" style="padding: 2px 0;">: {{ $quotation->lead->title }}</td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>

<!-- SUBJECT (Perihal standalone if no lead) -->
@if(!$quotation->lead || !$quotation->lead->title)
<div class="subject-line">
    <strong>Perihal :</strong> Penawaran Harga
</div>
@endif

<!-- OPENING MESSAGE -->
@if($quotation->opening_content)
<div class="opening-message">
    {!! $quotation->opening_content !!}
</div>
@endif

<!-- ITEMS TABLE -->
<table class="items-table page-break-avoid">
    <thead>
        <tr>
            <th style="width: 26px;">No.</th>
            <th style="text-align: left;">ITEM / URAIAN PEKERJAAN</th>
            <th style="width: 110px;">HARGA</th>
            <th style="width: 45px;">BANYAK</th>
            <th style="width: 120px;">JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        @foreach($quotation->items as $index => $item)
            @php
                $price = (float)($item->unit_price ?? 0);
                $discPercent = (float)($item->discount_percent ?? 0);
                $discAmount = $price * ($discPercent / 100);
                $lineTotal = $price - $discAmount;
            @endphp
            <tr>
                <td class="num">{{ $index + 1 }}</td>
                <td class="desc">
                    <div class="item-name">{{ $item->name }}</div>
                    @if($item->description)
                        <div class="item-desc">{{ $item->description }}</div>
                    @endif
                    @if($discPercent > 0)
                        <div class="item-desc">Diskon: {{ number_format($discPercent, 0) }}%</div>
                    @endif
                </td>
                <td class="price">Rp &nbsp;{{ number_format($price, 0, ',', '.') }}</td>
                <td class="qty">1</td>
                <td class="amount">Rp &nbsp;{{ number_format($lineTotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach

        <!-- EMPTY PADDING ROWS for aesthetics -->
        @if(count($quotation->items) < 5)
            @for($i = count($quotation->items); $i < 5; $i++)
            <tr>
                <td class="num" style="height: 18px;">&nbsp;</td>
                <td class="desc">&nbsp;</td>
                <td class="price">&nbsp;</td>
                <td class="qty">&nbsp;</td>
                <td class="amount">&nbsp;</td>
            </tr>
            @endfor
        @endif
    </tbody>
</table>

<!-- TOTAL BIAYA -->
<table class="items-table" style="margin-bottom: 0;">
    <tr class="total-row">
        <td colspan="3" style="text-align: right; border-top: 2px solid #555;">TOTAL BIAYA&nbsp;&nbsp;=</td>
        <td colspan="2" style="text-align: right; font-size: 10pt; border-top: 2px solid #555; color: #000; background: #e8e8e8;">
            Rp &nbsp;{{ number_format($calculations['grand_total'], 0, ',', '.') }}
        </td>
    </tr>
    @if($calculations['discount_percentage'] > 0)
    <tr class="total-row">
        <td colspan="3" style="text-align: right;">Subtotal</td>
        <td colspan="2" style="text-align: right;">Rp &nbsp;{{ number_format($calculations['subtotal'], 0, ',', '.') }}</td>
    </tr>
    <tr class="total-row">
        <td colspan="3" style="text-align: right;">Diskon ({{ $calculations['discount_percentage'] }}%)</td>
        <td colspan="2" style="text-align: right; color: #c00;">- Rp &nbsp;{{ number_format($calculations['discount_amount'], 0, ',', '.') }}</td>
    </tr>
    @endif
    @if(isset($quotation->include_tax) && $quotation->include_tax)
    <tr class="total-row">
        <td colspan="3" style="text-align: right;">PPN {{ $calculations['tax_percentage'] }}%</td>
        <td colspan="2" style="text-align: right;">Rp &nbsp;{{ number_format($calculations['tax_amount'], 0, ',', '.') }}</td>
    </tr>
    @endif
</table>

<!-- BOTTOM SECTION: NOTES + SIGN -->
<table class="bottom-table page-break-avoid" style="margin-top: 16px;">
    <tr>
        <!-- LEFT: NOTES, TERMS, PAYMENT -->
        <td class="notes-cell">
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
                        if (!empty($ct['term'])) {
                            $selectedTerms[] = $ct['term'];
                        }
                    }
                }
            @endphp

            @if(!empty($selectedTerms))
                <div class="section-label">Catatan :</div>
                <ul class="terms-list terms-ol">
                    @foreach($selectedTerms as $term)
                        <li>{{ $term }}</li>
                    @endforeach
                </ul>
            @endif

            @if(!empty($calculations['payment_terms']))
                <div class="section-label" style="margin-top: 10px;">Termin Pembayaran :</div>
                <ul class="terms-list terms-ol">
                    @foreach($calculations['payment_terms'] as $idx => $term)
                        <li>
                            {{ $term['description'] }}
                            &mdash; <strong>Rp {{ number_format($term['amount'], 0, ',', '.') }}</strong>
                        </li>
                    @endforeach
                </ul>
            @endif
        </td>

        <!-- RIGHT: SIGNATURE -->
        <td class="sign-cell">
            {{-- Closing Message if any --}}
            @if($quotation->closing_content)
                <div style="font-size: 8pt; text-align: justify; margin-bottom: 10px; color: #222; line-height: 1.4;">
                    {!! strip_tags($quotation->closing_content, '<br><b><strong>') !!}
                </div>
            @endif

            <table style="width: 100%;">
                <tr>
                    <!-- Authorized Signatory -->
                    <td style="text-align: center; vertical-align: top; width: 50%;">
                        <div class="sign-city">
                            Bekasi, {{ $quotation->created_at->locale('id')->isoFormat('DD MMMM YYYY') }}
                        </div>
                        <div class="sign-greeting">Hormat Kami,</div>
                        <div class="sign-space">
                            @if($preparedSigData)
                                <img src="{{ $preparedSigData }}" alt="Tanda Tangan" class="sign-img">
                            @endif
                        </div>
                        <div class="sign-line"></div>
                        <div class="sign-name">{{ $quotation->prepared_by ?? $company['name'] }}</div>
                        <div class="sign-position">{{ $quotation->prepared_by_position ?? 'Sales Representative' }}</div>
                    </td>

                    <!-- Client Approval -->
                    <td style="text-align: center; vertical-align: top; width: 50%; padding-left: 10px;">
                        <div class="sign-city">&nbsp;</div>
                        <div class="sign-greeting">Menyetujui,</div>
                        <div class="sign-space">
                            @if($approvedSigData)
                                <img src="{{ $approvedSigData }}" alt="Tanda Tangan" class="sign-img">
                            @endif
                        </div>
                        <div class="sign-line"></div>
                        <div class="sign-name">{{ $clientCompanyName ?: '_______________' }}</div>
                        <div class="sign-position">Tgl : ________________</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- FOOTER -->
<div class="footer">
    {{ $company['name'] }} &nbsp;|&nbsp; {{ $company['phone'] }} &nbsp;|&nbsp; {{ $company['email'] }}
    &nbsp;|&nbsp; Dok. No. {{ $quotation->quotation_number }} &nbsp;|&nbsp; Berlaku s/d {{ $quotation->valid_until->locale('id')->isoFormat('DD MMMM YYYY') }}
</div>

</body>
</html>