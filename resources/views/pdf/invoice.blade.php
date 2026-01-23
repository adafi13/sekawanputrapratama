<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
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
        .valign-top { vertical-align: top; }

        /* --- HEADER --- */
        .header-table {
            width: 100%;
            margin-bottom: 10px;
            border-bottom: 3px solid #dc2626;
            padding-bottom: 6px;
        }
        .company-name { 
            font-size: 12pt; 
            font-weight: bold; 
            color: #dc2626; 
            margin-bottom: 2px;
            letter-spacing: 0.2px;
        }
        .company-info { 
            font-size: 7pt; 
            color: #4b5563; 
            line-height: 1.2;
        }
        .doc-title { 
            font-size: 24pt; 
            font-weight: bold; 
            color: #dc2626; 
            letter-spacing: 1.5px;
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
            gap: 6px;
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
            margin: 0 3px;
        }

        /* --- RECIPIENT BOX --- */
        .recipient-box { 
            margin-bottom: 12px;
            background: #fef2f2;
            border-left: 3px solid #dc2626;
            padding: 8px 10px;
        }
        .recipient-label { 
            font-size: 6pt; 
            font-weight: bold; 
            color: #991b1b; 
            text-transform: uppercase; 
            margin-bottom: 2px; 
            letter-spacing: 0.3px;
        }
        .recipient-name { 
            font-size: 10pt; 
            font-weight: bold; 
            color: #1a1a1a;
            margin-bottom: 2px;
        }
        .recipient-detail { 
            font-size: 7pt; 
            color: #4b5563; 
            line-height: 1.3;
        }

        /* --- INVOICE DETAILS TABLE --- */
        .invoice-details {
            margin-bottom: 15px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 3px;
            padding: 10px;
        }
        .invoice-details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details-table td {
            padding: 4px 0;
            font-size: 7pt;
        }
        .detail-label {
            color: #6b7280;
            font-weight: 500;
            width: 35%;
        }
        .detail-value {
            color: #1a1a1a;
            font-weight: 600;
        }
        .detail-separator {
            width: 10px;
            text-align: center;
            color: #9ca3af;
        }

        /* --- AMOUNT TABLE --- */
        .amount-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .amount-table thead {
            background: #dc2626;
            color: white;
        }
        .amount-table th {
            text-align: left;
            padding: 7px 6px;
            font-size: 7pt;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .amount-table tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }
        .amount-table td {
            padding: 10px 6px;
            vertical-align: top;
            font-size: 8pt;
        }
        .item-desc { 
            font-size: 7pt; 
            color: #6b7280; 
            line-height: 1.3;
            margin-top: 2px;
        }

        /* --- SUMMARY BOX --- */
        .summary-box {
            margin-bottom: 15px;
            background: linear-gradient(to bottom, #fef2f2 0%, #ffffff 100%);
            border: 2px solid #dc2626;
            border-radius: 4px;
            padding: 12px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 6px 0;
            font-size: 8pt;
        }
        .summary-label {
            text-align: right;
            padding-right: 15px;
            color: #6b7280;
            font-weight: 500;
        }
        .summary-value {
            text-align: right;
            width: 150px;
            font-weight: 600;
            color: #1a1a1a;
        }
        .total-row {
            border-top: 2px solid #dc2626;
            background: #dc2626;
            color: white;
        }
        .total-row td {
            padding: 10px 0;
            font-size: 12pt;
            font-weight: bold;
        }
        .total-row .summary-label {
            color: white;
        }
        .total-row .summary-value {
            color: white;
        }

        /* --- PAYMENT INFO --- */
        .payment-info {
            margin-bottom: 15px;
        }
        .section-title { 
            font-size: 8pt; 
            font-weight: bold; 
            text-transform: uppercase; 
            color: #dc2626; 
            margin-bottom: 6px;
            padding-bottom: 3px;
            border-bottom: 1px solid #e5e7eb;
            letter-spacing: 0.3px;
        }
        .bank-box {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 3px;
            padding: 8px;
            margin-bottom: 6px;
        }
        .bank-name {
            font-weight: bold;
            font-size: 8pt;
            color: #1a1a1a;
            margin-bottom: 2px;
        }
        .bank-detail {
            font-size: 7pt;
            color: #6b7280;
            line-height: 1.4;
        }

        /* --- NOTES --- */
        .notes-box {
            margin-bottom: 15px;
            background: #fffbeb;
            border-left: 3px solid #f59e0b;
            padding: 8px;
        }
        .notes-title {
            font-weight: bold;
            font-size: 7pt;
            color: #92400e;
            margin-bottom: 3px;
            text-transform: uppercase;
        }
        .notes-text {
            font-size: 7pt;
            color: #78350f;
            line-height: 1.4;
        }

        /* --- TERMS --- */
        .terms-box {
            margin-bottom: 15px;
        }
        .terms-list {
            padding-left: 12px;
            margin: 3px 0;
            list-style: none;
        }
        .terms-list li {
            margin-bottom: 3px;
            font-size: 7pt;
            color: #6b7280;
            line-height: 1.3;
            position: relative;
            padding-left: 2px;
        }
        .terms-list li:before {
            content: "•";
            position: absolute;
            left: -10px;
            color: #dc2626;
            font-weight: bold;
            font-size: 8pt;
        }

        /* --- SIGNATURE --- */
        .signature-box {
            margin-top: 20px;
            padding: 10px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 3px;
        }
        .sig-table {
            width: 100%;
        }
        .sig-label {
            font-size: 7pt;
            color: #6b7280;
            margin-bottom: 30px;
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
        .sig-position {
            font-size: 7pt;
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

        /* --- STATUS BADGE --- */
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 7pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-paid {
            background: #d1fae5;
            color: #065f46;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        .status-overdue {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
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
                    <div class="doc-title">INVOICE</div>
                    <div class="doc-meta">
                        <div class="doc-meta-inline">
                            <span class="doc-meta-item">
                                <span class="doc-meta-label">Number:</span>
                                <span class="doc-meta-value">#{{ $invoice->invoice_number }}</span>
                            </span>
                            <span class="doc-meta-separator">|</span>
                            <span class="doc-meta-item">
                                <span class="doc-meta-label">Date:</span>
                                <span class="doc-meta-value">{{ $invoice->created_at->format('d M Y') }}</span>
                            </span>
                            <span class="doc-meta-separator">|</span>
                            <span class="doc-meta-item">
                                <span class="doc-meta-label">Due:</span>
                                <span class="doc-meta-value" style="color: #dc2626;">{{ $invoice->due_date->format('d M Y') }}</span>
                            </span>
                        </div>
                        <div style="margin-top: 6px;">
                            <span class="status-badge status-{{ $invoice->status }}">
                                {{ strtoupper($invoice->status) }}
                            </span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- BILL TO -->
    <div class="recipient-box">
        <table class="w-full">
            <tr>
                <td class="w-half valign-top">
                    <div class="recipient-label">Bill To:</div>
                    <div class="recipient-name">{{ $customer->company_name ?? 'Customer Name' }}</div>
                    <div class="recipient-detail">
                        Attn: {{ $customer->contact_name ?? 'Finance Department' }}<br>
                        {{ $customer->address ?? '' }}<br>
                        {{ $customer->phone ?? '' }}
                    </div>
                </td>
                <td class="w-half valign-top">
                    <div class="invoice-details">
                        <table class="invoice-details-table">
                            <tr>
                                <td class="detail-label">Project</td>
                                <td class="detail-separator">:</td>
                                <td class="detail-value">{{ $project->name ?? 'Project Name' }}</td>
                            </tr>
                            <tr>
                                <td class="detail-label">Invoice Stage</td>
                                <td class="detail-separator">:</td>
                                <td class="detail-value">{{ \App\Models\Invoice::getStages()[$invoice->stage] ?? $invoice->stage }}</td>
                            </tr>
                            @if($project->lead)
                            <tr>
                                <td class="detail-label">Lead/Project Ref.</td>
                                <td class="detail-separator">:</td>
                                <td class="detail-value">{{ $project->lead->company_name ?? '' }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- INVOICE AMOUNT -->
    <table class="amount-table">
        <thead>
            <tr>
                <th style="width: 50%;">DESCRIPTION</th>
                <th style="width: 25%; text-align: center;">STAGE</th>
                <th style="width: 25%; text-align: right;">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $project->name ?? 'Project Service' }}</strong>
                    <div class="item-desc">
                        {{ \App\Models\Invoice::getStages()[$invoice->stage] ?? $invoice->stage }} for project {{ $project->name ?? '' }}
                        @if($invoice->notes)
                        <br>{{ $invoice->notes }}
                        @endif
                    </div>
                </td>
                <td style="text-align: center;">
                    {{ \App\Models\Invoice::getStages()[$invoice->stage] ?? $invoice->stage }}
                </td>
                <td style="text-align: right;">
                    <strong>Rp {{ number_format($invoice->amount, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- SUMMARY -->
    <table class="w-full">
        <tr>
            <td class="w-half valign-top">
                <!-- Left side empty or for notes -->
            </td>
            <td class="w-half valign-top">
                <div class="summary-box">
                    <table class="summary-table">
                        <tbody>
                            <tr>
                                <td class="summary-label">Subtotal</td>
                                <td class="summary-value">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="total-row">
                                <td class="summary-label">TOTAL AMOUNT DUE</td>
                                <td class="summary-value">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- PAYMENT INFORMATION -->
    <div class="payment-info">
        <div class="section-title">Payment Information</div>
        <table class="w-full">
            <tr>
                <td class="w-half valign-top" style="padding-right: 10px;">
                    <div class="bank-box">
                        <div class="bank-name">Bank Central Asia (BCA)</div>
                        <div class="bank-detail">
                            Account Number: <strong>1234567890</strong><br>
                            Account Name: <strong>PT. Sekawan Putra Pratama</strong>
                        </div>
                    </div>
                </td>
                <td class="w-half valign-top">
                    <div class="bank-box">
                        <div class="bank-name">Bank Mandiri</div>
                        <div class="bank-detail">
                            Account Number: <strong>0987654321</strong><br>
                            Account Name: <strong>PT. Sekawan Putra Pratama</strong>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- IMPORTANT NOTES -->
    <div class="notes-box">
        <div class="notes-title">! IMPORTANT:</div>
        <div class="notes-text">
            Please make payment by <strong>{{ $invoice->due_date->format('d F Y') }}</strong>. 
            Include invoice number <strong>#{{ $invoice->invoice_number }}</strong> as payment reference. 
            For any inquiries, please contact us at {{ $company['phone'] }}.
        </div>
    </div>

    <!-- PAYMENT TERMS -->
    <div class="terms-box">
        <div class="section-title">Payment Terms & Conditions</div>
        <ul class="terms-list">
            <li>Payment must be made by the due date specified above</li>
            <li>Late payment may be subject to additional charges</li>
            <li>Please include invoice number in your payment reference</li>
            <li>Payment proof should be sent to {{ $company['email'] }}</li>
            <li>All payments are non-refundable unless otherwise stated</li>
        </ul>
    </div>

    <!-- SIGNATURE -->
    <div class="signature-box">
        <table class="sig-table">
            <tbody>
                <tr>
                    <td class="w-half valign-top" style="padding-right: 20px;">
                        <div class="sig-label">Customer Acknowledgment:</div>
                        <div class="sig-line"></div>
                        <div class="sig-name">{{ $customer->company_name ?? 'Customer Name' }}</div>
                        <div class="sig-position">Date: _________________</div>
                    </td>
                    <td class="w-half valign-top">
                        <div class="sig-label">Authorized By:</div>
                        <div class="sig-line"></div>
                        <div class="sig-name">{{ $company['name'] }}</div>
                        <div class="sig-position">Finance Department</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        This is a computer-generated invoice. Payment confirmation required. | {{ $company['name'] }}
    </div>

</body>
</html>
