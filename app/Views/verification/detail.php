<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Tiket</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
<div class="container-fluid">

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Informasi Tiket -->
    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Tiket
            </h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Nomor Tiket</th>
                    <td><?= esc($ticket['ticket_number']) ?></td>
                </tr>

                <tr>
                    <th>Nama Pemohon</th>
                    <td><?= esc($ticket['applicant_name']) ?></td>
                </tr>

                <tr>
                    <th>NIM</th>
                    <td><?= esc($ticket['nim']) ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?= esc($ticket['email']) ?></td>
                </tr>

                <tr>
                    <th>No HP</th>
                    <td><?= esc($ticket['phone']) ?></td>
                </tr>

                <tr>
                    <th>Layanan</th>
                    <td><?= esc($ticket['service_name']) ?></td>
                </tr>

                <tr>
                    <th>Judul Tiket</th>
                    <td><?= esc($ticket['ticket_title']) ?></td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td><?= nl2br(esc($ticket['ticket_description'])) ?></td>
                </tr>

                <tr>
                    <th>Jenis Pengajuan</th>
                    <td><?= esc($ticket['submission_type']) ?></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge badge-info">
                            <?= esc($ticket['status']) ?>
                        </span>
                    </td>
                </tr>

            </table>

        </div>

    </div>

    <!-- Lampiran -->
    <div class="card card-info">

        <div class="card-header">
            <h3 class="card-title">
                Lampiran
            </h3>
        </div>

        <div class="card-body">

            <?php if (!empty($ticket['attachment'])): ?>

                <a href="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                   target="_blank"
                   class="btn btn-primary">
                    <i class="fas fa-paperclip"></i>
                    Lihat Lampiran
                </a>

            <?php else: ?>

                <span class="text-danger">
                    Tidak ada lampiran.
                </span>

            <?php endif; ?>

        </div>

    </div>

    <!-- Riwayat -->
    <div class="card card-secondary">

        <div class="card-header">
            <h3 class="card-title">
                Riwayat Proses
            </h3>
        </div>

        <div class="card-body">

            <?php if(!empty($logs)): ?>

                <table class="table table-bordered">

                    <thead>

                    <tr>
                        <th>Tanggal</th>
                        <th>Petugas</th>
                        <th>Aktivitas</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php foreach($logs as $log): ?>

                    <tr>

                        <td><?= esc($log['created_at']) ?></td>

                        <td><?= esc($log['user_name']) ?></td>

                        <td><?= esc($log['activity']) ?></td>

                    </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <p class="text-muted">
                    Belum ada riwayat proses.
                </p>

            <?php endif; ?>

        </div>

    </div>

    <!-- Komentar -->
    <div class="card card-warning">

        <div class="card-header">
            <h3 class="card-title">
                Komentar Verifikasi
            </h3>
        </div>

        <div class="card-body">

            <?php if(!empty($comments)): ?>

                <?php foreach($comments as $comment): ?>

                    <div class="border rounded p-3 mb-2">

                        <strong>
                            <?= esc($comment['sender']) ?>
                        </strong>

                        <small class="float-right text-muted">
                            <?= esc($comment['created_at']) ?>
                        </small>

                        <hr>

                        <?= nl2br(esc($comment['comment'])) ?>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p class="text-muted">
                    Belum ada komentar.
                </p>

            <?php endif; ?>

        </div>

    </div>

    <!-- Disposisi -->
    <div class="card card-success">

        <div class="card-header">
            <h3 class="card-title">
                Informasi Disposisi
            </h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Unit Tujuan</th>
                    <td><?= !empty($ticket['assigned_unit']) ? esc($ticket['assigned_unit']) : '-' ?></td>
                </tr>

                <tr>
                    <th>Diverifikasi Oleh</th>
                    <td><?= !empty($ticket['verified_by']) ? esc($ticket['verified_by']) : '-' ?></td>
                </tr>

                <tr>
                    <th>Tanggal Verifikasi</th>
                    <td><?= !empty($ticket['verified_at']) ? esc($ticket['verified_at']) : '-' ?></td>
                </tr>

            </table>

        </div>

    </div>

    <!-- Tombol -->
    <div class="mt-3">

    <!-- KEMBALI KE HALAMAN DISPOSISI -->
    <a href="<?= base_url('disposition') ?>"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>
        Kembali

    </a>


    <!-- TOMBOL VERIFIKASI -->
    <?php if (($ticket['status'] ?? '') !== 'Verified' && ($ticket['status'] ?? '') !== 'Assigned'): ?>

        <a href="<?= base_url('verification/verify/' . $ticket['id']) ?>"
           class="btn btn-success">

            <i class="fas fa-check-circle"></i>
            Verifikasi

        </a>

    <?php endif; ?>


    <!-- TOMBOL DISPOSISI -->
    <?php if (($ticket['status'] ?? '') === 'Verified'): ?>

        <a href="<?= base_url('disposition/detail/' . $ticket['id']) ?>"
           class="btn btn-warning">

            <i class="fas fa-share"></i>
            Disposisi

        </a>

    <?php endif; ?>

</div>

</div>
</section>

<?= $this->endSection() ?>