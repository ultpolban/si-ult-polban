<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Tiket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2>Detail Tiket</h2>

    <table class="table table-bordered">

        <tr>
            <th width="30%">Nomor Tiket</th>
            <td><?= esc($ticket['ticket_number']) ?></td>
        </tr>

        <tr>
            <th>Status</th>
            <td><?= esc($ticket['status']) ?></td>
        </tr>

        <tr>
            <th>Prioritas</th>
            <td><?= esc($ticket['priority']) ?></td>
        </tr>

        <tr>
            <th>Deskripsi</th>
            <td><?= esc($ticket['description']) ?></td>
        </tr>

        <tr>
            <th>Tanggal Pengajuan</th>
            <td><?= esc($ticket['submitted_at']) ?></td>
        </tr>

        <tr>
            <th>Tanggal Verifikasi</th>
            <td>
                <?= $ticket['verified_at'] ?? '-' ?>
            </td>
        </tr>

    </table>

    <a href="<?= base_url('verification') ?>" class="btn btn-secondary">
        Kembali
    </a>

</div>

</body>
</html>