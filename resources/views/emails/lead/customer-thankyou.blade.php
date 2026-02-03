<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Sekawan Putra Pratama</title>
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
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #0F172A;
            font-size: 28px;
            margin: 0 0 10px 0;
        }
        .header p {
            color: #64748B;
            font-size: 16px;
            margin: 0;
        }
        .checkmark {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
        }
        .checkmark::after {
            content: "✓";
            color: white;
            font-size: 48px;
            font-weight: bold;
        }
        .content {
            color: #475569;
            font-size: 16px;
            line-height: 1.8;
            margin: 30px 0;
        }
        .info-box {
            background: #F8FAFC;
            border: 2px solid #E2E8F0;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .info-box h3 {
            color: #0F172A;
            font-size: 18px;
            margin: 0 0 15px 0;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            margin: 10px 0;
            padding: 10px 0;
            border-bottom: 1px solid #E2E8F0;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-item .icon {
            margin-right: 12px;
            color: #3B82F6;
            font-size: 20px;
        }
        .info-item .text {
            flex: 1;
        }
        .info-item .label {
            font-size: 12px;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
        .info-item .value {
            color: #0F172A;
            font-size: 15px;
            margin-top: 3px;
        }
        .cta-box {
            background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }
        .cta-box h3 {
            color: #0F172A;
            margin: 0 0 15px 0;
        }
        .btn {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 5px;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .btn-success {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        }
        .timeline {
            margin: 25px 0;
            padding: 20px;
            background: #FFFBEB;
            border-left: 4px solid #F59E0B;
            border-radius: 4px;
        }
        .timeline h4 {
            color: #92400E;
            margin: 0 0 10px 0;
            font-size: 16px;
        }
        .timeline ol {
            margin: 10px 0 0 20px;
            color: #78350F;
        }
        .timeline li {
            margin: 8px 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #E5E7EB;
        }
        .footer-logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .footer-text {
            color: #64748B;
            font-size: 14px;
            line-height: 1.6;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #3B82F6;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/media/logo.png') }}" alt="Sekawan Putra Pratama">
        </div>

        <div class="checkmark"></div>

        <div class="header">
            <h1>Terima Kasih, {{ explode(' ', $lead->contact_person)[0] }}! 🎉</h1>
            <p>Pesan Anda telah kami terima dengan baik</p>
        </div>

        <div class="content">
            <p>Halo <strong>{{ $lead->contact_person }}</strong>,</p>
            
            <p>
                Terima kasih telah menghubungi <strong>Sekawan Putra Pratama</strong>. 
                Kami sangat menghargai kepercayaan Anda dan antusias untuk membantu mewujudkan kebutuhan IT bisnis Anda.
            </p>

            <p>
                Pesan Anda telah masuk ke sistem kami dan sedang dalam proses review oleh tim konsultan IT kami.
            </p>
        </div>

        <div class="info-box">
            <h3>📋 Detail Permintaan Anda:</h3>
            
            <div class="info-item">
                <span class="icon">🏢</span>
                <div class="text">
                    <div class="label">Perusahaan</div>
                    <div class="value">{{ $lead->company_name }}</div>
                </div>
            </div>

            <div class="info-item">
                <span class="icon">📧</span>
                <div class="text">
                    <div class="label">Email</div>
                    <div class="value">{{ $lead->email }}</div>
                </div>
            </div>

            @if($lead->phone)
            <div class="info-item">
                <span class="icon">📱</span>
                <div class="text">
                    <div class="label">Nomor Telepon</div>
                    <div class="value">{{ $lead->phone }}</div>
                </div>
            </div>
            @endif

            <div class="info-item">
                <span class="icon">📅</span>
                <div class="text">
                    <div class="label">Waktu Submit</div>
                    <div class="value">{{ $lead->created_at->format('d M Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <div class="timeline">
            <h4>⏱️ Apa yang Terjadi Selanjutnya?</h4>
            <ol>
                <li>Tim kami akan <strong>mereview kebutuhan Anda</strong> dalam 1-2 jam kerja</li>
                <li>Konsultan IT kami akan <strong>menghubungi Anda via email/telepon</strong> untuk diskusi lebih lanjut</li>
                <li>Kami akan <strong>menyusun proposal dan penawaran</strong> yang sesuai dengan kebutuhan Anda</li>
                <li>Jika setuju, kita bisa langsung <strong>memulai project</strong>! 🚀</li>
            </ol>
        </div>

        <div class="cta-box">
            <h3>Butuh Respon Lebih Cepat?</h3>
            <p style="color: #64748B; margin: 10px 0;">Hubungi kami langsung via WhatsApp atau telepon:</p>
            
            <a href="https://wa.me/6285156412702?text=Halo%20Tim%20Sekawan%2C%20saya%20{{ urlencode($lead->contact_person) }}%20dari%20{{ urlencode($lead->company_name) }}.%20Saya%20baru%20submit%20form%20di%20website." class="btn btn-success">
                💬 WhatsApp Sekarang
            </a>
            
            <a href="tel:+6285156412702" class="btn">
                📞 Telepon Kami
            </a>
        </div>

        <div class="content">
            <p>
                <strong>Catatan Penting:</strong><br>
                Jika Anda tidak menerima respon dari kami dalam 24 jam (di hari kerja), 
                silakan cek folder spam/junk email Anda atau hubungi kami langsung via WhatsApp.
            </p>
        </div>

        <div class="footer">
            <img src="{{ asset('assets/media/logo.png') }}" alt="SPP" class="footer-logo">
            
            <div class="footer-text">
                <strong>Sekawan Putra Pratama</strong><br>
                Software House & IT Consultant<br>
                Perumahan Mega Regency, Blk. L5, No 23, Bekasi<br>
                <br>
                <strong>Email:</strong> support@sekawanputrapratama.com<br>
                <strong>WhatsApp:</strong> +62 851-5641-2702
            </div>

            <div class="social-links">
                <a href="https://www.instagram.com/sekawanputrapratama">Instagram</a> |
                <a href="https://sekawanputrapratama.com">Website</a>
            </div>

            <p style="font-size: 12px; color: #94A3B8; margin-top: 20px;">
                Email ini dikirim otomatis. Mohon jangan balas ke email ini.<br>
                Untuk pertanyaan, silakan hubungi support@sekawanputrapratama.com
            </p>
        </div>
    </div>
</body>
</html>
