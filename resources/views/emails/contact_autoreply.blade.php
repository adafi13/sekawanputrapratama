<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Sekawan Putra Pratama</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Helvetica, Arial, sans-serif;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; padding: 40px 0;">
        <tr>
            <td align="center">

                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px; width: 100%;">

                    <tr>
                        <td align="center" style="background-color: #0F172A; padding: 40px 20px;">
                            <img src="{{ url('assets/media/logo.png') }}"
                                 alt="Sekawan Putra Pratama"
                                 width="180"
                                 style="display: block; border: 0; max-width: 180px; height: auto;">
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

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; table-layout: fixed;"> 
                                <tr>
                                    <td style="padding: 25px;">
                                        
                                        <h3 style="margin: 0 0 20px; font-size: 13px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #cbd5e1; padding-bottom: 10px;">
                                            Ringkasan Pesan Anda
                                        </h3>

                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            
                                            <tr>
                                                <td width="100" valign="top" style="padding-bottom: 10px; font-size: 14px; color: #64748b; font-weight: bold; white-space: nowrap;">Perusahaan</td>
                                                <td width="15" valign="top" style="padding-bottom: 10px; font-size: 14px; color: #64748b; text-align: center;">:</td>
                                                <td valign="top" style="padding-bottom: 10px; font-size: 14px; color: #0f172a; font-weight: 500;">
                                                    {{ $data['company_name'] }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="100" valign="top" style="padding-bottom: 10px; font-size: 14px; color: #64748b; font-weight: bold; white-space: nowrap;">Email</td>
                                                <td width="15" valign="top" style="padding-bottom: 10px; font-size: 14px; color: #64748b; text-align: center;">:</td>
                                                <td valign="top" style="padding-bottom: 10px; font-size: 14px; color: #0f172a; font-weight: 500;">
                                                    <div style="width: 100%; max-width: 350px; word-wrap: break-word; word-break: break-all; overflow-wrap: break-word;">
                                                        {{ $data['email'] }}
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="100" valign="top" style="padding-bottom: 10px; font-size: 14px; color: #64748b; font-weight: bold; white-space: nowrap;">WhatsApp</td>
                                                <td width="15" valign="top" style="padding-bottom: 10px; font-size: 14px; color: #64748b; text-align: center;">:</td>
                                                <td valign="top" style="padding-bottom: 10px; font-size: 14px; color: #0f172a; font-weight: 500;">
                                                    {{ $data['phone'] }}
                                                </td>
                                            </tr>

                                        </table>

                                        <div style="margin-top: 15px;">
                                            <div style="font-size: 13px; color: #64748b; font-weight: bold; margin-bottom: 8px; text-transform: uppercase;">Isi Pesan:</div>
                                            <div style="background-color: #ffffff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 15px; font-size: 14px; color: #334155; line-height: 1.6; width: 100%; max-width: 100%; box-sizing: border-box; word-wrap: break-word; overflow-wrap: break-word;">
                                                {!! nl2br(e($data['message'])) !!}
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 35px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/') }}" style="display: inline-block; padding: 14px 35px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 15px; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);">
                                            Kembali ke Website
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #f8fafc; padding: 30px; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0 0 5px; font-size: 14px; font-weight: bold; color: #475569;">Sekawan Putra Pratama</p>
                            <p style="margin: 0 0 20px; font-size: 12px; color: #64748b; line-height: 1.5;">
                                Perumahan Mega Regency, Blk. L5, No 23, Sukaragam,<br>
                                Kec. Serang Baru, Kabupaten Bekasi, Jawa Barat 17330
                            </p>
                            <a href="https://wa.me/6285156412702" style="color: #2563eb; text-decoration: none; font-weight: 600; font-size: 13px;">
                                Butuh bantuan? WhatsApp Kami
                            </a>
                            <p style="margin: 20px 0 0; font-size: 11px; color: #94a3b8;">
                                &copy; {{ date('Y') }} Sekawan Putra Pratama. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
                <div style="height: 40px;"></div>
            </td>
        </tr>
    </table>

</body>
</html>