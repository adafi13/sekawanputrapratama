<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Sekawan Putra Pratama</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; padding: 40px 0;">
        <tr>
            <td align="center">
                
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px; width: 100%;">
                    
                    <tr>
                        <td align="center" style="background-color: #0F172A; padding: 30px 20px;">
                            <img src="{{ asset('assets/media/logo.png') }}" 
                                 alt="Sekawan Putra Pratama" 
                                 width="200" 
                                 style="display: block; border: 0; max-width: 200px; height: auto;">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px; font-size: 16px; color: #334155; line-height: 1.6;">
                                Halo <strong>{{ $data['name'] }}</strong>,
                            </p>
                            
                            <p style="margin: 0 0 20px; font-size: 16px; color: #334155; line-height: 1.6;">
                                Terima kasih telah menghubungi kami. Permintaan Anda mengenai layanan <strong style="color: #2563eb;">{{ $data['service'] }}</strong> telah kami terima.
                            </p>
                            
                            <p style="margin: 0 0 30px; font-size: 16px; color: #334155; line-height: 1.6;">
                                Tim kami sedang meninjau detailnya dan akan segera menghubungi Anda kembali.
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h3 style="margin: 0 0 15px; font-size: 14px; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #cbd5e1; padding-bottom: 10px;">Ringkasan Pesan Anda:</h3>
                                        
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 8px;">
                                            <tr>
                                                <td width="100" style="font-size: 14px; color: #64748b; font-weight: bold; vertical-align: top;">Perusahaan</td>
                                                <td style="font-size: 14px; color: #0f172a;">: {{ $data['company_name'] }}</td>
                                            </tr>
                                        </table>

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 8px;">
                                            <tr>
                                                <td width="100" style="font-size: 14px; color: #64748b; font-weight: bold; vertical-align: top;">Email</td>
                                                <td style="font-size: 14px; color: #0f172a;">: {{ $data['email'] }}</td>
                                            </tr>
                                        </table>

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 8px;">
                                            <tr>
                                                <td width="100" style="font-size: 14px; color: #64748b; font-weight: bold; vertical-align: top;">WhatsApp</td>
                                                <td style="font-size: 14px; color: #0f172a;">: {{ $data['phone'] }}</td>
                                            </tr>
                                        </table>

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="100" style="font-size: 14px; color: #64748b; font-weight: bold; vertical-align: top;">Pesan</td>
                                                <td style="font-size: 14px; color: #0f172a; line-height: 1.5;">: {{ $data['message'] }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/') }}" style="display: inline-block; padding: 14px 30px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 16px;">Kembali ke Website</a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #f8fafc; padding: 20px; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 12px; line-height: 1.5;">
                            &copy; {{ date('Y') }} Sekawan Putra Pratama.<br>
                            Bekasi, Jawa Barat, Indonesia.<br>
                            <a href="https://wa.me/6285156412702" style="color: #2563eb; text-decoration: none; font-weight: bold;">Butuh bantuan? WhatsApp Kami</a>
                        </td>
                    </tr>

                </table>
                <div style="height: 40px;"></div>
            </td>
        </tr>
    </table>

</body>
</html>