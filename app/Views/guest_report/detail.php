<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">

        <h1>Detail Laporan Tamu</h1>

    </div>
</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            <?= esc($ticket['ticket_number']) ?>
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Nomor Tiket</th>
                <td><?= esc($ticket['ticket_number']) ?></td>
            </tr>

            <tr>
                <th>Nama Pemohon</th>
                <td><?= esc($ticket['applicant_name']) ?></td>
            </tr>

            <tr>
                <th>Jenis Pemohon</th>
                <td><?= esc($ticket['applicant_type']) ?></td>
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
                <th>Status</th>
                <td>
                    <span class="badge badge-primary">
                        <?= esc($ticket['status']) ?>
                    </span>
                </td>
            </tr>

            <tr>
                <th>Prioritas</th>
                <td><?= esc($ticket['priority']) ?></td>
            </tr>

            <tr>
                <th>Tanggal Pengajuan</th>
                <td><?= date('d-m-Y H:i:s', strtotime($ticket['submitted_at'])) ?></td>
            </tr>

            <tr>
                <th>Lampiran</th>

                <td>

                <?php if(!empty($ticket['attachment'])): ?>

                    <a href="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                       target="_blank"
                       class="btn btn-success btn-sm">

                        <i class="fas fa-download"></i>
                        Lihat Lampiran

                    </a>

                <?php else: ?>

                    -

                <?php endif; ?>

                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a href="<?= base_url('guest-report') ?>" class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a href="<?= base_url('guest-report/edit/'.$ticket['id']) ?>"
           class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>