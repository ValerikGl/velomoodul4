<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Uus kontaktvormi sõnum</title>
</head>
<body style="margin:0;padding:40px;background:#F8FAFC;font-family:Arial,sans-serif;">

<div style="max-width:700px;margin:0 auto;background:#ffffff;border-radius:24px;overflow:hidden;box-shadow:0 15px 40px rgba(15,23,42,0.08);">

    <div style="background:#6D28D9;padding:32px 40px;">
        <h1 style="margin:0;color:white;font-size:28px;font-weight:800;">
            Uus kontaktvormi sõnum
        </h1>

        <p style="margin-top:10px;color:rgba(255,255,255,0.9);font-size:15px;">
            Veebilehe kontaktvormilt saadeti uus päring.
        </p>
    </div>

    <div style="padding:40px;">

        <div style="margin-bottom:30px;">
            <h2 style="margin:0 0 10px 0;color:#0F172A;font-size:16px;">
                Saatja andmed
            </h2>

            <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:20px;">
                <p style="margin:0 0 12px 0;">
                    <strong>Nimi:</strong>
                    {{ $contactMessage->name }}
                </p>

                <p style="margin:0;">
                    <strong>E-post:</strong>
                    {{ $contactMessage->email }}
                </p>
            </div>
        </div>

        <div>
            <h2 style="margin:0 0 10px 0;color:#0F172A;font-size:16px;">
                Sõnum
            </h2>

            <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:16px;padding:20px;">
                <p style="margin:0;line-height:1.7;color:#334155;">
                    {!! nl2br(e($contactMessage->message)) !!}
                </p>
            </div>
        </div>

    </div>

    <div style="padding:24px 40px;background:#F8FAFC;border-top:1px solid #E2E8F0;">
        <p style="margin:0;color:#64748B;font-size:13px;">
            Saadetud automaatselt Velo kontaktvormi kaudu.
        </p>
    </div>

</div>

</body>
</html>