<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Tiket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">Verifikasi Tiket</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

        <tr>
            <th width="5%">No</th>
            <th>No Tiket</th>
            <th>ID Pemohon</th>
            <th>ID Layanan</th>
            <th>Status</th>
            <th>Waktu Pengajuan</th>
            <th width="220">Aksi</th>
        </tr>

        </thead>

        <tbody>

        <?php if(empty($tickets)): ?>

            <tr>
                <td colspan="7" class="text-center">
                    Belum ada tiket.
                </td>
            </tr>

        <?php else: ?>

            <?php $no=1; ?>

            <?php foreach($tickets as $ticket): ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= esc($ticket['ticket_number']); ?></td>

                <td><?= esc($ticket['applicant_id']); ?></td>

                <td><?= esc($ticket['service_id']); ?></td>

                <td>

                    <?php if($ticket['status']=="Submitted"): ?>

                        <span class="badge bg-warning text-dark">
                            Submitted
                        </span>

                    <?php elseif($ticket['status']=="Verified"): ?>

                        <span class="badge bg-success">
                            Verified
                        </span>

                    <?php elseif($ticket['status']=="Completed"): ?>

                        <span class="badge bg-primary">
                            Completed
                        </span>

                    <?php else: ?>

                        <span class="badge bg-secondary">
                            <?= esc($ticket['status']); ?>
                        </span>

                    <?php endif; ?>

                </td>

                <td>

                    <?= date('d-m-Y H:i:s', strtotime($ticket['submitted_at'])); ?>

                </td>

                <td>

                    <a href="<?= base_url('verification/detail/'.$ticket['id']); ?>" class="btn btn-info btn-sm">
                        Detail
                    </a>

                    <?php if($ticket['status']=="Submitted"): ?>

                        <a href="<?= base_url('verification/verify/'.$ticket['id']); ?>" class="btn btn-success btn-sm">
                            Verifikasi
                        </a>

                    <?php else: ?>

                        <button class="btn btn-secondary btn-sm" disabled>
                            Sudah Diverifikasi
                        </button>

                    <?php endif; ?>

                </td>

            </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>
</html>