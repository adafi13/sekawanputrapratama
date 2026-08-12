<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
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
            padding: 6px 8px;
            font-size: 8.5pt;
            vertical-align: top;
            color: #000;
        }
        .items-table td.col-no    { text-align: center; width: 24px; }
        .items-table td.col-desc  { text-align: left; }
        .items-table td.col-tahap { text-align: center; width: 130px; }
        .items-table td.col-jumlah{ text-align: right; font-weight: bold; white-space: nowrap; width: 140px; }
        .item-name { font-weight: bold; }
        .item-sub  { font-size: 7.5pt; color: #555; margin-top: 1px; }

        /* TOTAL ROW */
        .total-row td {
            border: 1px solid #888;
            padding: 6px 8px;
            font-size: 9.5pt;
            font-weight: bold;
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

    $clientCompany = $customer->company_name ?? $project->customer->company_name ?? '';
    $clientContact = $customer->contact_name ?? $project->customer->contact_name ?? '';
    $clientAddress = $customer->address ?? $project->customer->address ?? '';
    $clientPhone   = $customer->phone ?? $project->customer->phone ?? '';

    $stageName = match($invoice->payment_stage ?? $invoice->stage) {
        'dp' => 'Down Payment (DP)',
        'progress' => 'Progress Payment',
        'final' => 'Pelunasan (Final)',
        default => strtoupper($invoice->payment_stage ?? $invoice->stage ?? 'INVOICE'),
    };

    $statusLabel = match($invoice->status) {
        'paid' => 'LUNAS (PAID)',
        'sent' => 'DIKIRIM (SENT)',
        'overdue' => 'JATUH TEMPO (OVERDUE)',
        'cancelled' => 'DIBATALKAN',
        default => 'PENDING',
    };

    $stampPng = \App\Services\QuotationPdfService::generateStampPng($company['name']);
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
<table style="width: 100%; margin-bottom: 14px;">
    <tr>
        <!-- Left: Recipient -->
        <td style="vertical-align: top; width: 58%;">
            <div class="kepada-label">
                Tagihan Kepada Yth. :
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
                    <td class="doc-meta-label">INVOICE NO.</td>
                    <td class="doc-meta-value">: <strong>{{ $invoice->invoice_number }}</strong></td>
                </tr>
                <tr>
                    <td class="doc-meta-label">Tanggal Tagihan</td>
                    <td class="doc-meta-value">: {{ ($invoice->issue_date ?? $invoice->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td class="doc-meta-label">Jatuh Tempo</td>
                    <td class="doc-meta-value">: {{ \Carbon\Carbon::parse($invoice->due_date)->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td class="doc-meta-label">Tahap Pembayaran</td>
                    <td class="doc-meta-value">: <strong>{{ $stageName }}</strong></td>
                </tr>
                <tr>
                    <td class="doc-meta-label">Status</td>
                    <td class="doc-meta-value">: <strong>{{ $statusLabel }}</strong></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!-- ===== ITEMS / INVOICE TABLE ===== -->
<table class="items-table avoid-break">
    <thead>
        <tr>
            <th style="width: 24px;">No.</th>
            <th style="text-align: left;">URAIAN PEKERJAAN / PROJECT</th>
            <th style="width: 130px;">TAHAP</th>
            <th style="width: 140px;">JUMLAH TAGIHAN</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="col-no">1</td>
            <td class="col-desc">
                <div class="item-name">{{ $project->name ?? 'Tagihan Proyek Pekerjaan' }}</div>
                @if($invoice->notes)
                    <div class="item-sub">{{ $invoice->notes }}</div>
                @elseif($project && $project->description)
                    <div class="item-sub">{{ $project->description }}</div>
                @endif
            </td>
            <td class="col-tahap">
                <strong>{{ $stageName }}</strong>
            </td>
            <td class="col-jumlah">
                Rp&nbsp;{{ number_format((float)$invoice->amount, 0, ',', '.') }}
            </td>
        </tr>

        {{-- Padding rows to make table consistent --}}
        @for($p = 1; $p < 4; $p++)
        <tr>
            <td class="col-no" style="height: 18px;">&nbsp;</td>
            <td class="col-desc">&nbsp;</td>
            <td class="col-tahap">&nbsp;</td>
            <td class="col-jumlah">&nbsp;</td>
        </tr>
        @endfor
    </tbody>
</table>

<!-- ===== TOTAL ===== -->
<table class="items-table" style="border-collapse: collapse; width: 100%;">
    <tr class="total-row">
        <td colspan="3" style="text-align: right; border: 1.5px solid #555; background: #eee;">TOTAL HARUS DIBAYAR &nbsp;=</td>
        <td style="width: 140px; text-align: right; border: 1.5px solid #555; background: #ddd; font-size: 10.5pt; color: #000;">
            Rp&nbsp;{{ number_format((float)$invoice->amount, 0, ',', '.') }}
        </td>
    </tr>
</table>

<!-- ===== BOTTOM: PAYMENT INFO LEFT + SIGNATURE RIGHT ===== -->
<table style="width: 100%; margin-top: 16px;" class="avoid-break">
    <tr>
        <!-- ===== LEFT: Bank Account & Payment Instructions ===== -->
        <td class="bottom-notes-cell">
            <div class="sec-label">Informasi Pembayaran / Transfer Bank :</div>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
                <tr>
                    <td style="width: 16px; vertical-align: top; font-size: 8pt; font-weight: bold; color: #000; padding: 2px 0;">1.</td>
                    <td style="vertical-align: top; font-size: 8pt; color: #111; line-height: 1.4; padding: 2px 0;">
                        <strong>Bank Central Asia (BCA)</strong><br>
                        No. Rekening : <strong>1234567890</strong><br>
                        Atas Nama : {{ $company['name'] }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 16px; vertical-align: top; font-size: 8pt; font-weight: bold; color: #000; padding: 4px 0 2px 0;">2.</td>
                    <td style="vertical-align: top; font-size: 8pt; color: #111; line-height: 1.4; padding: 4px 0 2px 0;">
                        <strong>Bank Mandiri</strong><br>
                        No. Rekening : <strong>0987654321</strong><br>
                        Atas Nama : {{ $company['name'] }}
                    </td>
                </tr>
            </table>

            <div class="sec-label" style="margin-top: 6px;">Catatan Penting :</div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 14px; vertical-align: top; font-size: 8pt; font-weight: bold; color: #000; padding: 1px 0;">&bull;</td>
                    <td style="vertical-align: top; font-size: 7.8pt; color: #222; line-height: 1.4; padding: 1px 0;">
                        Pembayaran harap dilakukan sebelum tanggal <strong>{{ \Carbon\Carbon::parse($invoice->due_date)->locale('id')->isoFormat('DD MMMM YYYY') }}</strong>.
                    </td>
                </tr>
                <tr>
                    <td style="width: 14px; vertical-align: top; font-size: 8pt; font-weight: bold; color: #000; padding: 1px 0;">&bull;</td>
                    <td style="vertical-align: top; font-size: 7.8pt; color: #222; line-height: 1.4; padding: 1px 0;">
                        Sertakan nomor tagihan <strong>#{{ $invoice->invoice_number }}</strong> pada keterangan transfer.
                    </td>
                </tr>
                <tr>
                    <td style="width: 14px; vertical-align: top; font-size: 8pt; font-weight: bold; color: #000; padding: 1px 0;">&bull;</td>
                    <td style="vertical-align: top; font-size: 7.8pt; color: #222; line-height: 1.4; padding: 1px 0;">
                        Kirimkan bukti pembayaran via Email ({{ $company['email'] }}) atau WhatsApp ({{ $company['phone'] }}).
                    </td>
                </tr>
            </table>
        </td>

        <!-- ===== RIGHT: Signatures ===== -->
        <td class="bottom-sign-cell">
            <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                <!-- ROW 1: City & Greetings -->
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top; padding-bottom: 4px;">
                        <div style="font-size: 8pt; color: #333; margin-bottom: 2px;">Bekasi, {{ ($invoice->issue_date ?? $invoice->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</div>
                        <div style="font-size: 8.5pt; font-weight: bold; color: #000;">Hormat Kami,</div>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: top; padding-bottom: 4px;">
                        <div style="font-size: 8pt; color: transparent; margin-bottom: 2px;">&nbsp;</div>
                        <div style="font-size: 8.5pt; font-weight: bold; color: #000;">Penerima / Klien,</div>
                    </td>
                </tr>

                <!-- ROW 2: Stamp & Signature Area -->
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: middle; height: 85px;">
                        <div style="position: relative; width: 100px; height: 85px; margin: 0 auto;">
                            @if($stampPng)
                                <img src="{{ $stampPng }}" style="width: 85px; height: 85px; position: absolute; top: 0; left: 7px; opacity: 0.85;">
                            @endif
                        </div>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: middle; height: 85px;">
                        <div style="position: relative; width: 100px; height: 85px; margin: 0 auto;">
                            &nbsp;
                        </div>
                    </td>
                </tr>

                <!-- ROW 3: Black Underlines -->
                <tr>
                    <td style="width: 50%; text-align: center; padding: 2px 4px 4px 4px;">
                        <div style="border-bottom: 1.5px solid #000; width: 140px; margin: 0 auto;"></div>
                    </td>
                    <td style="width: 50%; text-align: center; padding: 2px 4px 4px 4px;">
                        <div style="border-bottom: 1.5px solid #000; width: 140px; margin: 0 auto;"></div>
                    </td>
                </tr>

                <!-- ROW 4: Name & Position -->
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <div style="font-size: 8.5pt; font-weight: bold; color: #000; text-transform: uppercase;">{{ $company['name'] }}</div>
                        <div style="font-size: 7.5pt; color: #444;">Finance Department</div>
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
    &nbsp;|&nbsp; Dok. No. {{ $invoice->invoice_number }}
    &nbsp;|&nbsp; Jatuh Tempo {{ \Carbon\Carbon::parse($invoice->due_date)->locale('id')->isoFormat('DD MMMM YYYY') }}
</div>

</body>
</html>
