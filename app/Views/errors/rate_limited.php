<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Terlalu Banyak Permintaan - SI ULT POLBAN</title>
    <style>
        :root {
            --warning: #d97706;
            --dark: #1f2937;
            --muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #f3f4f6;
            color: var(--dark);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 32px 28px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }

        .icon {
            font-size: 3rem;
            line-height: 1;
            color: var(--warning);
        }

        h1 {
            margin: 16px 0 8px;
            font-size: 1.375rem;
        }

        p {
            margin: 0 0 12px;
            color: var(--muted);
            line-height: 1.6;
            font-size: .95rem;
        }

        .timer {
            display: inline-block;
            margin-top: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            font-weight: 600;
            font-size: .9rem;
        }

        .actions {
            margin-top: 24px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
            background: #ffffff;
            color: var(--dark);
            border: 1px solid #d1d5db;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon" aria-hidden="true">&#9203;</div>

        <h1>Terlalu Banyak Permintaan</h1>

        <p>
            Anda mengirim permintaan terlalu sering dalam waktu singkat.
            Demi keamanan, permintaan berikutnya ditunda sementara.
        </p>

        <div class="timer">
            Coba lagi dalam <?= (int) ($retryAfter ?? 60) ?> detik
        </div>

        <div class="actions">
            <a href="javascript:history.back()" class="btn">Kembali</a>
        </div>
    </div>
</body>

</html>
