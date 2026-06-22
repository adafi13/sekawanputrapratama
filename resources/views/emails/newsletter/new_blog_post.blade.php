<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Helvetica, Arial, sans-serif;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; padding: 40px 0;">
        <tr>
            <td align="center">

                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px; width: 100%;">

                    <tr>
                        <td align="center" style="background-color: #0F172A; padding: 40px 20px;">
                            <img src="{{ asset('assets/media/logo.png') }}"
                                 alt="PT Sekawan Putra Pratama"
                                 width="180"
                                 style="display: block; border: 0; max-width: 180px; height: auto;">
                        </td>
                    </tr>

                    @php
                        $img = $post->getFirstMediaUrl('featured_image') ?: ($post->featured_image ? \Illuminate\Support\Facades\Storage::url($post->featured_image) : null);
                    @endphp
                    @if($img)
                    <tr>
                        <td>
                            <img src="{{ $img }}" alt="{{ $post->title }}" width="600" style="display: block; width: 100%; max-height: 280px; object-fit: cover;">
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td style="padding: 40px 30px;">

                            <p style="margin: 0 0 8px; font-size: 13px; color: #2563eb; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                                Artikel Baru
                            </p>

                            <h1 style="margin: 0 0 16px; font-size: 24px; color: #0f172a; line-height: 1.3;">
                                {{ $post->title }}
                            </h1>

                            <p style="margin: 0 0 30px; font-size: 16px; color: #334155; line-height: 1.6;">
                                {{ $post->excerpt }}
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="{{ route('blog.show', $post->slug) }}" style="display: inline-block; padding: 14px 35px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 50px; font-weight: bold; font-size: 15px; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);">
                                            Baca Selengkapnya
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="background-color: #f8fafc; padding: 30px; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0 0 5px; font-size: 14px; font-weight: bold; color: #475569;">PT Sekawan Putra Pratama</p>
                            <p style="margin: 0 0 20px; font-size: 12px; color: #64748b; line-height: 1.5;">
                                Perumahan Mega Regency, Blk. L5, No 23, Sukaragam,<br>
                                Kec. Serang Baru, Kabupaten Bekasi, Jawa Barat 17330
                            </p>
                            <p style="margin: 0; font-size: 11px; color: #94a3b8;">
                                Anda menerima email ini karena berlangganan newsletter di website kami.<br>
                                <a href="{{ $unsubscribeUrl }}" style="color: #94a3b8; text-decoration: underline;">Berhenti berlangganan</a>
                            </p>
                            <p style="margin: 20px 0 0; font-size: 11px; color: #94a3b8;">
                                &copy; {{ date('Y') }} PT Sekawan Putra Pratama. All rights reserved.
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
