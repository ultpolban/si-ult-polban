<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <div>

        <h2 class="mb-1">Dashboard Unit Layanan</h2>

        <p class="text-muted mb-0">Ringkasan antrean tiket yang sedang ditangani unit.</p>

    </div>

    <div>

        <a href="<?= base_url('unit') ?>" class="btn btn-primary btn-sm">

            <i class="fas fa-ticket-alt me-1"></i> Data Tiket

        </a>

        <a href="<?= base_url('unit/laporan') ?>" class="btn btn-outline-primary btn-sm">

            <i class="fas fa-chart-bar me-1"></i> Laporan

        </a>

    </div>

</div>

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>

<div class="row mb-3">

    <div class="col-lg-4 col-md-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3><?= esc($summary['total']) ?></h3>

                <p>Total Antrean</p>

            </div>

            <div class="icon"><i class="fas fa-folder-open"></i></div>

        </div>

    </div>

    <div class="col-lg-4 col-md-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3><?= esc($summary['assigned']) ?></h3>

                <p>Menunggu Tindak Lanjut</p>

            </div>

            <div class="icon"><i class="fas fa-hourglass-half"></i></div>

        </div>

    </div>

    <div class="col-lg-4 col-md-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3><?= esc($summary['processing']) ?></h3>

                <p>Sedang Diproses</p>

            </div>

            <div class="icon"><i class="fas fa-spinner"></i></div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">Antrean Tiket Unit</h3>

    </div>

    <div class="card-body">

        <?php if (empty($tickets)): ?>

            <div class="alert alert-info mb-0">

                <i class="fas fa-info-circle me-2"></i>

                Saat ini tidak ada tiket yang menunggu tindak lanjut unit.

            </div>

        <?php else: ?>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-primary">

                        <tr>

                            <th>No Tiket</th>

                            <th>Pemohon</th>

                            <th>Layanan</th>

                            <th>Status</th>

                            <th class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($tickets as $ticket): ?>

                        <?php $status = strtolower(trim($ticket['status'] ?? '')); ?>

                        <tr>

                            <td>

                                <a href="<?= base_url('unit/detail/' . $ticket['id']) ?>">

                                    <?= esc($ticket['ticket_number'] ?? '-') ?>

                                </a>

                            </td>

                            <td><?= esc($ticket['applicant_name'] ?? '-') ?></td>

                            <td><?= esc($ticket['service_display_name'] ?? '-') ?></td>

                            <td>

                                <?php if ($status === 'processing') : ?>

                                    <span class="status-badge processing">Diproses</span>

                                <?php else : ?>

                                    <span class="status-badge submitted">Menunggu</span>

                                <?php endif; ?>

                            </td>

                            <td class="text-center">

                                <a
                                    href="<?= base_url('unit/update-status/' . $ticket['id']) ?>"
                                    class="btn btn-sm btn-primary">

                                    <i class="fas fa-sync-alt me-1"></i> Update Status

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
