<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder Pembayaran Invoice {{ $invoice->invoice_number }}</title>
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
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .logo { text-align: center; margin-bottom: 30px; }
        .logo img { max-width: 200px; height: auto; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #0F172A; font-size: 26px; margin: 0 0 10px 0; }
        .header p { color: #64748B; font-size: 16px; margin: 0; }
        .content { color: #475569; font-size: 16px; line-height: 1.8; margin: 30px 0; }
        .info-box {
            background: #FFFBEB;
            border: 2px solid #FDE68A;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .info-box h3 { color: #92400E; font-size: 18px; margin: 0 0 15px 0; }
        .info-item {
            display: flex;
            align-items: flex-start;
            margin: 10px 0;
            padding: 10px 0;
            border-bottom: 1px solid #FDE68A;
        }
        .info-item:last-child { border-bottom: none; }
        .info-item .label {
            font-size: 12px;
            color: #92400E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
        .info-item .value { color: #0F172A; font-size: 15px; margin-top: 3px; }
        .btn {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 5px;
        }
        .cta-box { text-align: center; margin: 30px 0; }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #E5E7EB;
        }
        .footer-text { color: #64748B; font-size: 14px; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://sekawanputrapratama.com/assets/media/logo.png" alt="PT Sekawan Putra Pratama">
        </div>

        <div class="header">
            <h1>Reminder Pembayaran Invoice</h1>
            <p>Invoice {{ $invoice->invoice_number }} akan segera jatuh tempo</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $invoice->customer?->company_name ?? $invoice->customer?->contact_person ?? 'Pelanggan' }}</strong>,</p>
            <p>
                Kami ingin mengingatkan bahwa invoice berikut akan jatuh tempo. Mohon segera melakukan pembayaran
                agar pengerjaan project tidak terganggu.
            </p>
        </div>

        <div class="info-box">
            <h3>📋 Detail Invoice</h3>
            <div class="info-item">
                <div>
                    <div class="label">No. Invoice</div>
                    <div class="value">{{ $invoice->invoice_number }}</div>
                </div>
            </div>
            <div class="info-item">
                <div>
                    <div class="label">Jumlah Tagihan</div>
                    <div class="value">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="info-item">
                <div>
                    <div class="label">Jatuh Tempo</div>
                    <div class="value">{{ $invoice->due_date->format('d M Y') }}</div>
                </div>
            </div>
        </div>

        <div class="cta-box">
            <a href="https://wa.me/6285156412702?text=Halo%20Tim%20Sekawan%2C%20saya%20ingin%20konfirmasi%20pembayaran%20invoice%20{{ urlencode($invoice->invoice_number) }}." class="btn">
                💬 Konfirmasi via WhatsApp
            </a>
        </div>

        <div class="footer">
            <div class="footer-text">
                <strong>PT Sekawan Putra Pratama</strong><br>
                Software House & IT Consultant<br>
                Perumahan Mega Regency, Blk. L5, No 23, Bekasi<br>
                <br>
                <strong>Email:</strong> sekawanputrapratama@gmail.com<br>
                <strong>WhatsApp:</strong> +62 851-5641-2702
            </div>
            <p style="font-size: 12px; color: #94A3B8; margin-top: 20px;">
                Email ini dikirim otomatis. Mohon jangan balas ke email ini.
            </p>
        </div>
    </div>
</body>
</html>
