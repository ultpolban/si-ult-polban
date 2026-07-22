<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Laporan Tiket</h1>
    </div>
</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Cari Laporan Tiket</h3>
    </div>

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-8">

                    <label>Nomor Tiket</label>

                    <input
                        type="text"
                        name="ticket_number"
                        class="form-control"
                        placeholder="Masukkan Nomor Tiket"
                        value="<?= $_GET['ticket_number'] ?? '' ?>">

                </div>

                <div class="col-md-2">

                    <label>&nbsp;</label>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Cari
                    </button>

                </div>

                <div class="col-md-2">

                    <label>&nbsp;</label>

                    <a href="<?= base_url('report') ?>" class="btn btn-secondary btn-block">
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Data Laporan Tiket</h3>
    </div>

    <div class="card-body table-responsive">

        <div class="mb-3">
            <a href="<?= base_url('report/print') ?>" target="_blank" class="btn btn-primary">
                <i class="fas fa-print"></i> Print
            </a>
        </div>

        <table class="table table-bordered table-striped">

            <thead class="thead-dark">

                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Isi Tiket</th>
                    <th>Tanggal & Jam Pengajuan</th>
                    <th>Jam Verifikasi</th>
                </tr>

            </thead>

            <tbody>

            <?php if (empty($tickets)): ?>

                <tr>
                    <td colspan="7" class="text-center">
                        Tidak ada data.
                    </td>
                </tr>

            <?php else: ?>

                <?php $no = 1; ?>

                <?php foreach ($tickets as $ticket): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= esc($ticket['ticket_number']) ?></td>

                        <td>
                            <?php if ($ticket['status'] == 'Verified'): ?>
                                <span class="badge badge-success">
                                    <?= esc($ticket['status']) ?>
                                </span>
                            <?php else: ?>
                                <span class="badge badge-secondary">
                                    <?= esc($ticket['status']) ?>
                                </span>
                            <?php endif; ?>
                        </td>

                        <td><?= esc($ticket['priority']) ?></td>

                        <td><?= esc($ticket['ticket_description']) ?></td>

                        <td>
                            <?= date('d F Y H:i:s', strtotime($ticket['submitted_at'])) ?>
                        </td>

                        <td>
                            <?= !empty($ticket['verified_at'])
                                ? date('d F Y H:i:s', strtotime($ticket['verified_at']))
                                : '-'; ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>