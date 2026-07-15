<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Laporan Tiket</h1>
    </div>
</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-3">
                    <label>Tanggal Awal</label>
                    <input type="date"
                           name="tanggal_awal"
                           class="form-control"
                           value="<?= $_GET['tanggal_awal'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <label>Tanggal Akhir</label>
                    <input type="date"
                           name="tanggal_akhir"
                           class="form-control"
                           value="<?= $_GET['tanggal_akhir'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="">Semua Status</option>

                        <option value="Submitted">Submitted</option>

                        <option value="Verified">Verified</option>

                        <option value="Completed">Completed</option>

                        <option value="Diproses Unit">Diproses Unit</option>

                    </select>

                </div>

                <div class="col-md-3">

    <label>&nbsp;</label>

    <div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Filter
        </button>

    </div>

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

            <?php if(empty($tickets)): ?>

                <tr>

                    <td colspan="7" class="text-center">
                        Tidak ada data.
                    </td>

                </tr>

            <?php else: ?>

                <?php $no=1; ?>

                <?php foreach($tickets as $ticket): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= esc($ticket['ticket_number']) ?></td>

                        <td>

                            <span class="badge badge-success">

                                <?= esc($ticket['status']) ?>

                            </span>

                        </td>

                        <td><?= esc($ticket['priority']) ?></td>

                        <td><?= esc($ticket['description']) ?></td>

                        <td>

                            <?= date('d F Y H:i:s', strtotime($ticket['submitted_at'])) ?>

                        </td>

                        <td>

                            <?php if(!empty($ticket['verified_at'])): ?>

                                <?= date('d F Y H:i:s', strtotime($ticket['verified_at'])) ?>

                            <?php else: ?>

                                -

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>