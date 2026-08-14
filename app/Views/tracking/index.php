<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
$isDetail = isset($ticket) && !empty($ticket);
?>

<style>
    .tracking-stepper {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 35px 20px 50px;
    }

    .tracking-stepper::before {
        content: '';
        position: absolute;
        top: 22px;
        left: 5%;
        right: 5%;
        height: 4px;
        background: #dee2e6;
        z-index: 0;
    }

    .tracking-step {
        position: relative;
        z-index: 1;
        text-align: center;
        flex: 1;
    }

    .tracking-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #dee2e6;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-weight: bold;
        border: 3px solid #fff;
        box-shadow: 0 0 0 1px #dee2e6;
    }

    .tracking-step.active .tracking-circle {
        background: #28a745;
        color: white;
        box-shadow: 0 0 0 1px #28a745;
    }

    .tracking-step.active .step-title {
        color: #28a745;
        font-weight: bold;
    }

    .tracking-step.current .tracking-circle {
        background: #007bff;
        color: white;
        box-shadow: 0 0 0 2px #007bff;
    }

    .tracking-step.current .step-title {
        color: #007bff;
        font-weight: bold;
    }

    .step-title {
        font-size: 13px;
        color: #6c757d;
    }

    .step-date {
        font-size: 11px;
        color: #999;
        margin-top: 3px;
    }

    .info-label {
        font-weight: 600;
        color: #6c757d;
    }

    .info-value {
        color: #212529;
    }

    .timeline {
        position: relative;
        margin: 20px 0;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #dee2e6;
    }

    .timeline-item {
        position: relative;
        padding: 0 0 25px 20px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -28px;
        top: 3px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #007bff;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #007bff;
    }

    .timeline-title {
        font-weight: 600;
        margin-bottom: 3px;
    }

    .timeline-date {
        font-size: 12px;
        color: #888;
    }

    .timeline-description {
        margin-top: 5px;
        color: #555;
    }

    .ticket-number {
        font-size: 20px;
        font-weight: bold;
    }

    .tracking-search {
        max-width: 700px;
        margin: auto;
    }

    .action-column {
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .tracking-stepper {
            margin-left: 5px;
            margin-right: 5px;
        }

        .step-title {
            font-size: 10px;
        }

        .step-date {
            display: none;
        }

        .tracking-circle {
            width: 35px;
            height: 35px;
            font-size: 12px;
        }

        .tracking-stepper::before {
            top: 17px;
        }

        .table {
            font-size: 12px;
        }
    }
</style>


<?php if ($isDetail): ?>

<!-- ========================================================= -->
<!-- HALAMAN DETAIL TRACKING -->
<!-- ========================================================= -->

<div class="container-fluid">

    <div class="card shadow-sm mb-4">

        <!-- HEADER -->
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-route mr-2"></i>
                Tracking Status Tiket
            </h5>
        </div>

        <div class="card-body">

            <!-- NOMOR TIKET -->
            <div class="text-center mb-4">

                <div class="text-muted">
                    Nomor Tiket
                </div>

                <div class="ticket-number">
                    <?= esc($ticket['ticket_number'] ?? '-') ?>
                </div>

                <?php
                $status = $ticket['status'] ?? 'Submitted';

                $badgeClass = 'badge-secondary';

                switch ($status) {
                    case 'Submitted':
                        $badgeClass = 'badge-warning';
                        break;

                    case 'Verified':
                        $badgeClass = 'badge-info';
                        break;

                    case 'Assigned':
                        $badgeClass = 'badge-primary';
                        break;

                    case 'In Progress':
                        $badgeClass = 'badge-warning';
                        break;

                    case 'Completed':
                        $badgeClass = 'badge-success';
                        break;

                    case 'Need Revision':
                        $badgeClass = 'badge-warning';
                        break;

                    case 'Rejected':
                        $badgeClass = 'badge-danger';
                        break;
                }
                ?>

                <div class="mt-2">
                    <span class="badge <?= $badgeClass ?> px-3 py-2">
                        <?= esc($status) ?>
                    </span>
                </div>

            </div>


            <!-- STEPPER -->
            <?php
            $statusOrder = [
                'Submitted'   => 1,
                'Verified'    => 2,
                'Assigned'    => 3,
                'In Progress' => 4,
                'Completed'   => 5
            ];

            $currentStep = $statusOrder[$status] ?? 1;
            ?>

            <div class="tracking-stepper">

                <!-- SUBMITTED -->
                <div class="tracking-step <?= $currentStep >= 1 ? 'active' : '' ?>">

                    <div class="tracking-circle">
                        <i class="fas fa-paper-plane"></i>
                    </div>

                    <div class="step-title">
                        Diajukan
                    </div>

                    <?php if (!empty($ticket['submitted_at'])): ?>
                        <div class="step-date">
                            <?= date('d-m-Y H:i', strtotime($ticket['submitted_at'])) ?>
                        </div>
                    <?php endif; ?>

                </div>


                <!-- VERIFIED -->
                <div class="tracking-step
                    <?= $currentStep > 2 ? 'active' : ($currentStep == 2 ? 'current' : '') ?>">

                    <div class="tracking-circle">
                        <i class="fas fa-check"></i>
                    </div>

                    <div class="step-title">
                        Diverifikasi
                    </div>

                    <?php if (!empty($ticket['verified_at'])): ?>
                        <div class="step-date">
                            <?= date('d-m-Y H:i', strtotime($ticket['verified_at'])) ?>
                        </div>
                    <?php endif; ?>

                </div>


                <!-- ASSIGNED -->
                <div class="tracking-step
                    <?= $currentStep > 3 ? 'active' : ($currentStep == 3 ? 'current' : '') ?>">

                    <div class="tracking-circle">
                        <i class="fas fa-share"></i>
                    </div>

                    <div class="step-title">
                        Didisposisikan
                    </div>

                </div>


                <!-- IN PROGRESS -->
                <div class="tracking-step
                    <?= $currentStep > 4 ? 'active' : ($currentStep == 4 ? 'current' : '') ?>">

                    <div class="tracking-circle">
                        <i class="fas fa-cogs"></i>
                    </div>

                    <div class="step-title">
                        Diproses Unit
                    </div>

                </div>


                <!-- COMPLETED -->
                <div class="tracking-step <?= $currentStep >= 5 ? 'active' : '' ?>">

                    <div class="tracking-circle">
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <div class="step-title">
                        Selesai
                    </div>

                    <?php if (!empty($ticket['completed_at'])): ?>
                        <div class="step-date">
                            <?= date('d-m-Y H:i', strtotime($ticket['completed_at'])) ?>
                        </div>
                    <?php endif; ?>

                </div>

            </div>


            <!-- INFORMASI TIKET -->
            <div class="card border mb-4">

                <div class="card-header bg-light">
                    <strong>
                        <i class="fas fa-info-circle mr-2"></i>
                        Informasi Tiket
                    </strong>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Nomor Tiket</div>
                            <div class="info-value">
                                <?= esc($ticket['ticket_number'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Nama Pemohon</div>
                            <div class="info-value">
                                <?= esc($ticket['applicant_name'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">NIM</div>
                            <div class="info-value">
                                <?= esc($ticket['nim'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                <?= esc($ticket['email'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Nomor HP</div>
                            <div class="info-value">
                                <?= esc($ticket['phone'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Layanan</div>
                            <div class="info-value">
                                <?= esc($ticket['service_name'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Judul Tiket</div>
                            <div class="info-value">
                                <?= esc($ticket['ticket_title'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Unit Tujuan</div>

                            <div class="info-value">

                                <?php if (!empty($ticket['assigned_unit'])): ?>

                                    <span class="badge badge-primary">
                                        <i class="fas fa-building mr-1"></i>
                                        <?= esc($ticket['assigned_unit']) ?>
                                    </span>

                                <?php else: ?>

                                    <span class="text-muted">
                                        Belum didisposisikan
                                    </span>

                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Prioritas</div>

                            <div class="info-value">
                                <?= esc($ticket['priority'] ?? '-') ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-label">Lama Proses</div>

                            <div class="info-value">
                                <span class="badge badge-info">
                                    <?= esc($ticket['lama_proses'] ?? '-') ?>
                                </span>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="mb-2 info-label">
                        Deskripsi
                    </div>

                    <div class="border rounded p-3 bg-light">
                        <?= nl2br(
                            esc($ticket['ticket_description'] ?? '-')
                        ) ?>
                    </div>

                </div>
            </div>


            <!-- PROGRESS -->
            <div class="card border mb-4">

                <div class="card-header bg-light">
                    <strong>
                        <i class="fas fa-tasks mr-2"></i>
                        Progress Tiket
                    </strong>
                </div>

                <div class="card-body">

                    <?php

                    if ($status === 'Assigned') {

                        $progress = 50;
                        $progressText =
                            'Tiket sudah didisposisikan ke unit dan menunggu proses.';

                    } elseif ($status === 'In Progress') {

                        $progress = 75;
                        $progressText =
                            'Tiket sedang diproses oleh unit tujuan.';

                    } elseif ($status === 'Completed') {

                        $progress = 100;
                        $progressText =
                            'Tiket telah selesai diproses oleh unit.';

                    } elseif ($status === 'Verified') {

                        $progress = 25;
                        $progressText =
                            'Tiket telah diverifikasi dan menunggu disposisi.';

                    } else {

                        $progress = 10;
                        $progressText =
                            'Tiket telah diajukan dan sedang menunggu proses berikutnya.';
                    }

                    ?>

                    <div class="d-flex justify-content-between mb-2">

                        <strong>
                            Status Proses
                        </strong>

                        <strong>
                            <?= $progress ?>%
                        </strong>

                    </div>

                    <div class="progress" style="height:25px;">

                        <div
                            class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar"
                            style="width: <?= $progress ?>%;"
                        >
                            <?= $progress ?>%
                        </div>

                    </div>

                    <div class="mt-3 text-muted">
                        <i class="fas fa-info-circle mr-1"></i>
                        <?= esc($progressText) ?>
                    </div>

                </div>
            </div>


            <!-- RIWAYAT -->
            <div class="card border mb-4">

                <div class="card-header bg-light">

                    <strong>
                        <i class="fas fa-history mr-2"></i>
                        Riwayat Aktivitas Tiket
                    </strong>

                </div>

                <div class="card-body">

                    <?php if (!empty($logs)): ?>

                        <div class="timeline">

                            <?php foreach ($logs as $log): ?>

                                <div class="timeline-item">

                                    <div class="timeline-title">

                                        <?php
                                        $logStatus =
                                            $log['status']
                                            ?? $log['action']
                                            ?? 'Aktivitas Tiket';
                                        ?>

                                        <?= esc($logStatus) ?>

                                    </div>


                                    <?php if (!empty($log['created_at'])): ?>

                                        <div class="timeline-date">

                                            <i class="far fa-clock mr-1"></i>

                                            <?= date(
                                                'd F Y, H:i',
                                                strtotime($log['created_at'])
                                            ) ?>

                                        </div>

                                    <?php endif; ?>


                                    <?php
                                    $logDescription =
                                        $log['description']
                                        ?? $log['note']
                                        ?? $log['message']
                                        ?? '';
                                    ?>


                                    <?php if (!empty($logDescription)): ?>

                                        <div class="timeline-description">

                                            <?= nl2br(
                                                esc($logDescription)
                                            ) ?>

                                        </div>

                                    <?php endif; ?>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="text-center text-muted py-4">

                            <i class="fas fa-history fa-2x mb-3"></i>

                            <div>
                                Belum ada riwayat aktivitas tiket.
                            </div>

                        </div>

                    <?php endif; ?>

                </div>
            </div>


            <!-- KEMBALI -->
            <div class="mb-4">

                <a
                    href="<?= base_url('tracking') ?>"
                    class="btn btn-secondary"
                >
                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Tracking
                </a>

            </div>

        </div>
    </div>

</div>


<?php else: ?>

<!-- ========================================================= -->
<!-- HALAMAN UTAMA TRACKING -->
<!-- ========================================================= -->

<div class="container-fluid">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                <i class="fas fa-route mr-2"></i>
                Tracking Tiket
            </h5>

        </div>

        <div class="card-body">

            <!-- ERROR SESSION -->
            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= session()->getFlashdata('error') ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >
                        <span>&times;</span>
                    </button>

                </div>

            <?php endif; ?>


            <!-- ERROR DATA -->
            <?php if (!empty($error)): ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc($error) ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >
                        <span>&times;</span>
                    </button>

                </div>

            <?php endif; ?>


            <!-- SEARCH -->
            <div class="tracking-search">

                <div class="text-center mb-3">

                    <h5>
                        Cari Tiket
                    </h5>

                    <p class="text-muted">
                        Masukkan nomor tiket untuk melihat
                        status dan progres tiket.
                    </p>

                </div>


                <form
                    action="<?= base_url('tracking/search') ?>"
                    method="post"
                >

                    <?= csrf_field() ?>

                    <div class="input-group">

                        <input
                            type="text"
                            name="ticket_number"
                            class="form-control"
                            placeholder="Contoh: ULT-20260716-0001"
                            required
                            autocomplete="off"
                        >

                        <div class="input-group-append">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="fas fa-search mr-1"></i>
                                Cari Tiket
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>


    <!-- ===================================================== -->
    <!-- TABEL TIKET -->
    <!-- ===================================================== -->

    <div class="card shadow-sm">

        <div class="card-header">

            <h5 class="mb-0">

                <i class="fas fa-list mr-2"></i>

                Tiket yang Sudah Didisposisikan ke Unit

            </h5>

        </div>


        <div class="card-body">

            <?php if (empty($tickets)): ?>

                <div class="text-center text-muted py-5">

                    <i class="fas fa-inbox fa-3x mb-3"></i>

                    <?php if (!empty($isSearch)): ?>

                        <p class="mb-0">
                            Tiket dengan nomor tersebut tidak ditemukan.
                        </p>

                    <?php else: ?>

                        <p class="mb-0">
                            Tidak ada tiket yang sudah didisposisikan
                            ke unit.
                        </p>

                    <?php endif; ?>

                </div>


            <?php else: ?>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="thead-light">

                            <tr>

                                <th width="50">
                                    No
                                </th>

                                <th>
                                    No Tiket
                                </th>

                                <th>
                                    Pemohon
                                </th>

                                <th>
                                    Layanan
                                </th>

                                <th>
                                    Unit Tujuan
                                </th>

                                <th>
                                    Status
                                </th>

                                <th width="130">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php $no = 1; ?>

                            <?php foreach ($tickets as $item): ?>

                                <tr>

                                    <td>
                                        <?= $no++ ?>
                                    </td>


                                    <td>

                                        <strong>
                                            <?= esc(
                                                $item['ticket_number']
                                                ?? '-'
                                            ) ?>
                                        </strong>

                                    </td>


                                    <td>
                                        <?= esc(
                                            $item['applicant_name']
                                            ?? '-'
                                        ) ?>
                                    </td>


                                    <td>
                                        <?= esc(
                                            $item['service_name']
                                            ?? '-'
                                        ) ?>
                                    </td>


                                    <td>

                                        <?php if (!empty($item['assigned_unit'])): ?>

                                            <span class="badge badge-primary">

                                                <i class="fas fa-building mr-1"></i>

                                                <?= esc(
                                                    $item['assigned_unit']
                                                ) ?>

                                            </span>

                                        <?php else: ?>

                                            <span class="text-muted">
                                                Belum didisposisikan
                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <?php

                                        $itemStatus =
                                            $item['status'] ?? '-';

                                        $itemBadge =
                                            'badge-secondary';

                                        switch ($itemStatus) {

                                            case 'Assigned':
                                                $itemBadge =
                                                    'badge-primary';
                                                break;

                                            case 'In Progress':
                                                $itemBadge =
                                                    'badge-warning';
                                                break;

                                            case 'Completed':
                                                $itemBadge =
                                                    'badge-success';
                                                break;

                                            case 'Verified':
                                                $itemBadge =
                                                    'badge-info';
                                                break;

                                            case 'Need Revision':
                                                $itemBadge =
                                                    'badge-warning';
                                                break;

                                            case 'Rejected':
                                                $itemBadge =
                                                    'badge-danger';
                                                break;
                                        }

                                        ?>

                                        <span class="badge <?= $itemBadge ?>">

                                            <?= esc($itemStatus) ?>

                                        </span>

                                    </td>


                                    <td class="action-column">

                                        <a
                                            href="<?= base_url(
                                                'tracking/detail/' .
                                                urlencode(
                                                    $item['ticket_number']
                                                )
                                            ) ?>"
                                            class="btn btn-info btn-sm"
                                            title="Lihat Progres"
                                        >

                                            <i class="fas fa-eye mr-1"></i>

                                            Lihat Progres

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>


                <!-- KEMBALI SETELAH SEARCH -->
                <?php if (!empty($isSearch)): ?>

                    <div class="mt-3">

                        <a
                            href="<?= base_url('tracking') ?>"
                            class="btn btn-secondary"
                        >

                            <i class="fas fa-arrow-left mr-1"></i>

                            Kembali ke Tracking

                        </a>

                    </div>

                <?php endif; ?>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php endif; ?>


<?= $this->endSection() ?>