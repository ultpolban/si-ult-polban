<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <div>

        <h2 class="mb-1">Laporan Tiket Unit</h2>

        <p class="text-muted mb-0">Rekap tiket unit layanan berdasarkan status dan periode.</p>

    </div>

    <a href="<?= base_url('unit') ?>" class="btn btn-primary btn-sm">

        <i class="fas fa-arrow-left me-1"></i> Kembali ke Data Tiket

    </a>

</div>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>

<?php endif; ?>

<div class="card mb-3">

    <div class="card-header"><h3 class="card-title">Filter Periode</h3></div>

    <div class="card-body">

        <form method="get" action="<?= base_url('unit/laporan') ?>" class="row g-3 align-items-end">

            <div class="col-md-4">

                <label class="form-label">Dari Tanggal</label>

                <input
                    type="date"
                    name="from"
                    class="form-control"
                    value="<?= esc($from) ?>">

            </div>

            <div class="col-md-4">

                <label class="form-label">Sampai Tanggal</label>

                <input
                    type="date"
                    name="to"
                    class="form-control"
                    value="<?= esc($to) ?>">

            </div>

            <div class="col-md-4">

                <button type="submit" class="btn btn-primary w-100">

                    <i class="fas fa-filter me-1"></i> Terapkan

                </button>

            </div>

        </form>

    </div>

</div>

<div class="row mb-3">

    <?php
    $labelStatus = [
        'assigned'   => ['Menunggu', 'bg-warning'],
        'processing' => ['Diproses', 'bg-info'],
        'completed'  => ['Selesai', 'bg-success'],
        'rejected'   => ['Ditolak', 'bg-danger'],
    ];
    ?>

    <?php foreach ($rekap as $key => $jumlah): ?>

        <div class="col-lg-3 col-md-6">

            <div class="small-box <?= esc($labelStatus[$key][1] ?? 'bg-secondary') ?>">

                <div class="inner">

                    <h3><?= esc($jumlah) ?></h3>

                    <p><?= esc($labelStatus[$key][0] ?? ucfirst($key)) ?></p>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

</div>

<div class="card">

    <div class="card-header"><h3 class="card-title">Rekap Tiket</h3></div>

    <div class="card-body">

        <?php if (empty($rows)): ?>

            <div class="alert alert-info mb-0">

                <i class="fas fa-info-circle me-2"></i> Tidak ada data tiket pada periode ini.

            </div>

        <?php else: ?>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-primary">

                        <tr>

                            <th>No Tiket</th>

                            <th>Layanan</th>

                            <th>Unit</th>

                            <th>Status</th>

                            <th>Diajukan</th>

                            <th>Selesai</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($rows as $row): ?>

                        <?php
                        $status = strtolower(trim($row['status'] ?? ''));
                        $badge  = $labelStatus[$status][1] ?? 'bg-secondary';
                        ?>

                        <tr>

                            <td><?= esc($row['ticket_number'] ?? '-') ?></td>

                            <td><?= esc($row['service_name'] ?? '-') ?></td>

                            <td><?= esc($row['unit_name'] ?? '-') ?></td>

                            <td><span class="badge <?= esc($badge) ?>"><?= esc($status) ?></span></td>

                            <td><?= esc($row['submitted_at'] ?: ($row['created_at'] ?? '-')) ?></td>

                            <td><?= esc($row['completed_at'] ?? '-') ?></td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
