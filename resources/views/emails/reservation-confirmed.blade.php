<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $emailSubject }}</title>
</head>
<body style="margin:0;background:#f3f7fa;font-family:Arial,sans-serif;color:#334155;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f7fa;padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:620px;background:#ffffff;border-radius:18px;overflow:hidden;">
                    <tr><td style="background:#1e638f;padding:25px 32px;color:#ffffff;font-family:Georgia,serif;font-size:28px;letter-spacing:3px;">NUE HAVEN</td></tr>
                    <tr>
                        <td style="padding:36px 32px;font-size:15px;line-height:1.75;white-space:pre-line;">{{ $emailMessage }}</td>
                    </tr>
                    <tr><td style="padding:18px 32px;background:#f8fafc;color:#94a3b8;font-size:11px;">Reservation reference: {{ $reservation->reference }}</td></tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
