<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Baru Masuk</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            margin: -30px -30px 30px -30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: #10B981;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
        .info-box {
            background: #F8FAFC;
            border-left: 4px solid #3B82F6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-row {
            margin: 10px 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #E5E7EB;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #64748B;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .value {
            color: #1E293B;
            font-size: 16px;
            margin-top: 5px;
        }
        .message-box {
            background: #FEF3C7;
            border-left: 4px solid #F59E0B;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #E5E7EB;
            color: #64748B;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #3B82F6;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }
        .btn:hover {
            background: #2563EB;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔔 Lead Baru Masuk!</h1>
            <span class="badge">WEBSITE FORM</span>
        </div>

        <p style="font-size: 16px; color: #64748B;">
            Halo Admin,<br>
            Ada lead baru yang baru saja submit form di website. Berikut detailnya:
        </p>

        <div class="info-box">
            <div class="info-row">
                <div class="label">Nama Perusahaan</div>
                <div class="value">{{ $lead->company_name }}</div>
            </div>

            <div class="info-row">
                <div class="label">Nama Kontak</div>
                <div class="value">{{ $lead->contact_person }}</div>
            </div>

            <div class="info-row">
                <div class="label">Email</div>
                <div class="value">
                    <a href="mailto:{{ $lead->email }}" style="color: #3B82F6; text-decoration: none;">
                        {{ $lead->email }}
                    </a>
                </div>
            </div>

            @if($lead->phone)
            <div class="info-row">
                <div class="label">Nomor Telepon</div>
                <div class="value">
                    <a href="tel:{{ $lead->phone }}" style="color: #3B82F6; text-decoration: none;">
                        {{ $lead->phone }}
                    </a>
                </div>
            </div>
            @endif

            <div class="info-row">
                <div class="label">Sumber</div>
                <div class="value">{{ ucfirst($lead->source) }}</div>
            </div>

            <div class="info-row">
                <div class="label">Waktu Submit</div>
                <div class="value">{{ $lead->created_at->format('d M Y, H:i') }} WIB</div>
            </div>
        </div>

        @if($lead->notes)
        <div class="message-box">
            <div class="label">PESAN/KEBUTUHAN:</div>
            <div class="value" style="margin-top: 10px; white-space: pre-wrap;">{{ $lead->notes }}</div>
        </div>
        @endif

        <div style="text-align: center;">
            <a href="{{ config('app.url') }}/admin/leads" class="btn">
                📊 Lihat di Admin Panel
            </a>
        </div>

        <div class="footer">
            <p>
                <strong>Sekawan Putra Pratama</strong><br>
                Software House & IT Consultant<br>
                <a href="https://sekawanputrapratama.com" style="color: #3B82F6; text-decoration: none;">
                    sekawanputrapratama.com
                </a>
            </p>
            <p style="font-size: 12px; color: #94A3B8; margin-top: 15px;">
                Email otomatis dari sistem CRM. Jangan balas email ini.
            </p>
        </div>
    </div>
</body>
</html>
