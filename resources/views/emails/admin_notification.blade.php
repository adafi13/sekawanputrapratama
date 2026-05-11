<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Lead Baru</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: sans-serif;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 30px 0;">
        <tr>
            <td align="center">
                
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 8px; border: 1px solid #e5e7eb; overflow: hidden;">
                    
                    <tr>
                        <td style="background-color: #dc2626; padding: 20px; text-align: center;">
                            <img src="{{ $message->embed(public_path('assets/media/logo.png')) }}" alt="Logo" width="120" style="margin-bottom: 10px;"><br>
                            <h2 style="color: #ffffff; margin: 0; font-size: 20px;">🔔 LEAD / PROSPEK BARU</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin-top: 0;">Halo Admin,</p>
                            <p>Ada calon klien baru yang mengisi formulir kontak website. Berikut detailnya:</p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; margin-top: 15px;">
                                <tr>
                                    <td style="padding: 15px;">
                                        <table border="0" cellpadding="5" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="130" style="font-weight: bold; color: #4b5563;">🏢 Perusahaan</td>
                                                <td style="color: #111827;">: {{ $data['company_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; color: #4b5563;">👤 Nama Kontak</td>
                                                <td style="color: #111827;">: {{ $data['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; color: #4b5563;">📧 Email</td>
                                                <td style="color: #111827;">: <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; color: #4b5563;">📱 WhatsApp</td>
                                                <td style="color: #111827;">: <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $data['phone'])) }}">{{ $data['phone'] }}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="font-weight: bold; color: #4b5563;">🛠 Layanan</td>
                                                <td style="color: #dc2626; font-weight: bold;">: {{ $data['service'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-top: 20px;">
                                <div style="font-weight: bold; margin-bottom: 5px;">Isi Pesan:</div>
                                <div style="background: #fff; border: 1px solid #d1d5db; padding: 15px; border-radius: 4px; font-style: italic;">
                                    "{!! nl2br(e($data['message'])) !!}"
                                </div>
                            </div>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $data['phone'])) }}" style="background-color: #25D366; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; margin-right: 10px;">Hubungi via WA</a>
                                        <a href="mailto:{{ $data['email'] }}" style="background-color: #3b82f6; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">Balas Email</a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f3f4f6; padding: 15px; text-align: center; font-size: 12px; color: #6b7280;">
                            Dikirim otomatis oleh Sistem Website PT Sekawan Putra Pratama
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>