<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Permintaan Ditolak - SI ULT POLBAN</title>
    <style>
        :root {
            --danger: #dc3545;
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
            color: var(--danger);
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

        .ref {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 12px;
            border-radius: 6px;
            background: #f3f4f6;
            border: 1px dashed #d1d5db;
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: .8rem;
            color: var(--dark);
            letter-spacing: .5px;
        }

        .actions {
            margin-top: 24px;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
            border: 1px solid transparent;
        }

        .btn-primary {
            background: #0d6efd;
            color: #ffffff;
        }

        .btn-outline {
            background: #ffffff;
            color: var(--dark);
            border-color: #d1d5db;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="icon" aria-hidden="true">&#9888;</div>

        <h1>Permintaan Ditolak</h1>

        <p>
            Sistem mendeteksi pola karakter yang berpotensi berbahaya pada data
            yang Anda kirim, sehingga permintaan tidak diproses.
        </p>

        <p>
            Silakan kembali, periksa kembali isian Anda, dan hindari penggunaan
            karakter seperti <strong>&lt;</strong>, <strong>&gt;</strong>,
            tanda kutip berpasangan, atau perintah khusus.
        </p>

        <?php if (! empty($referenceId)) : ?>

            <div class="ref">Kode referensi: <?= esc($referenceId, 'html') ?></div>

        <?php endif; ?>

        <div class="actions">
            <a href="javascript:history.back()" class="btn btn-primary">Kembali ke Formulir</a>
            <a href="<?= site_url('/') ?>" class="btn btn-outline">Halaman Utama</a>
        </div>
    </div>
</body>

</html>
