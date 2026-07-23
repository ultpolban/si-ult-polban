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

            <div class="btn-group">

                <button type="button"
                        class="btn btn-primary dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">

                    <i class="fas fa-download"></i>
                    Export Laporan

                </button>

                <div class="dropdown-menu">

                    <a class="dropdown-item"
                       href="<?= base_url('report/pdf') ?>"
                       target="_blank">

                        <i class="fas fa-file-pdf text-danger"></i>
                        Export PDF

                    </a>

                    <?php if(method_exists('\App\Controllers\ReportController','excel')): ?>

                        <a class="dropdown-item"
                           href="<?= base_url('report/excel') ?>">

                            <i class="fas fa-file-excel text-success"></i>
                            Export Excel

                        </a>

                    <?php endif; ?>

                    <a class="dropdown-item"
                       href="<?= base_url('report/csv') ?>">

                        <i class="fas fa-file-csv text-primary"></i>
                        Export CSV

                    </a>

                </div>

            </div>

        </div>

        <table class="table table-bordered table-striped">

            <thead class="thead-dark">

                <tr>

                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Nama Pemohon</th>
                    <th>Jenis Pemohon</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Tanggal Pengajuan</th>

                </tr>

            </thead>

            <tbody>

            <?php if(empty($tickets)): ?>

                <tr>

                    <td colspan="8" class="text-center">
                        Tidak ada data.
                    </td>

                </tr>

            <?php else: ?>

                <?php $no = 1; ?>

                <?php foreach($tickets as $ticket): ?>

                    <?php

                    $color = 'secondary';

                    switch($ticket['status']){

                        case 'Submitted':
                            $color = 'warning';
                            break;

                        case 'Assigned':
                            $color = 'info';
                            break;

                        case 'In Progress':
                            $color = 'primary';
                            break;

                        case 'Completed':
                            $color = 'success';
                            break;

                        case 'Need Revision':
                            $color = 'dark';
                            break;

                        case 'Rejected':
                            $color = 'danger';
                            break;

                    }

                    ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= esc($ticket['ticket_number']) ?></td>

                        <td><?= esc($ticket['applicant_name']) ?></td>

                        <td><?= esc($ticket['applicant_type']) ?></td>

                        <td><?= esc($ticket['service_name']) ?></td>

                        <td>
                            <span class="badge badge-<?= $color ?>">
                                <?= esc($ticket['status']) ?>
                            </span>
                        </td>

                        <td><?= esc($ticket['priority']) ?></td>

                        <td><?= date('d-m-Y H:i', strtotime($ticket['submitted_at'])) ?></td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>