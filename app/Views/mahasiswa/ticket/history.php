<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- ============================= -->
    <!-- HEADER -->
    <!-- ============================= -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h1 class="page-title">

                        <i class="fas fa-ticket-alt"></i>

                        Tracking Tiket

                    </h1>

                    <p class="text-muted mb-0">

                        Pantau riwayat pengajuan dan status layanan Anda.

                    </p>

                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">

                    <a
                        href="<?= base_url('mahasiswa/ticket/create') ?>"
                        class="btn btn-primary"
                    >

                        <i class="fas fa-plus-circle"></i>

                        Ajukan Layanan

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- ============================= -->
    <!-- CONTENT -->
    <!-- ============================= -->

    <section class="content">

        <div class="container-fluid">


            <!-- ============================= -->
            <!-- INFO CARD -->
            <!-- ============================= -->

            <div class="alert tracking-info">

                <i class="fas fa-info-circle"></i>

                <strong>Informasi:</strong>

                Klik tombol <strong>Detail</strong> untuk melihat informasi lengkap dan perkembangan tiket Anda.

            </div>


            <!-- ============================= -->
            <!-- TICKET LIST -->
            <!-- ============================= -->

            <?php if (!empty($tickets)): ?>

                <?php foreach ($tickets as $ticket): ?>


                    <?php

                    // Status tiket
                    $status = $ticket['status'] ?? 'Submitted';


                    // Konfigurasi status

                    $statusConfig = [

                        'Draft' => [
                            'color' => 'secondary',
                            'icon'  => 'fa-file'
                        ],

                        'Submitted' => [
                            'color' => 'primary',
                            'icon'  => 'fa-paper-plane'
                        ],

                        'Verified' => [
                            'color' => 'info',
                            'icon'  => 'fa-check'
                        ],

                        'Assigned' => [
                            'color' => 'warning',
                            'icon'  => 'fa-share'
                        ],

                        'In Progress' => [
                            'color' => 'warning',
                            'icon'  => 'fa-spinner'
                        ],

                        'Revision' => [
                            'color' => 'danger',
                            'icon'  => 'fa-exclamation-triangle'
                        ],

                        'Completed' => [
                            'color' => 'success',
                            'icon'  => 'fa-check-circle'
                        ],

                        'Closed' => [
                            'color' => 'dark',
                            'icon'  => 'fa-lock'
                        ]

                    ];


                    $config = $statusConfig[$status]
                        ?? [
                            'color' => 'secondary',
                            'icon'  => 'fa-info-circle'
                        ];

                    ?>


                    <!-- ============================= -->
                    <!-- TICKET CARD -->
                    <!-- ============================= -->

                    <div class="card ticket-card shadow-sm">


                        <!-- HEADER -->

                        <div class="card-header ticket-card-header">


                            <div>

                                <span class="ticket-label">

                                    Nomor Tiket

                                </span>


                                <h4 class="ticket-number">

                                    <?= esc($ticket['nomor'] ?? '-') ?>

                                </h4>

                            </div>


                            <span class="badge bg-<?= $config['color'] ?> ticket-status">

                                <i class="fas <?= $config['icon'] ?>"></i>

                                <?= esc($status) ?>

                            </span>


                        </div>


                        <!-- BODY -->

                        <div class="card-body">


                            <div class="row">


                                <!-- LAYANAN -->

                                <div class="col-md-4 mb-3">

                                    <div class="ticket-info">

                                        <div class="info-icon">

                                            <i class="fas fa-file-alt"></i>

                                        </div>

                                        <div>

                                            <small>

                                                Jenis Layanan

                                            </small>

                                            <strong>

                                                <?= esc($ticket['layanan'] ?? '-') ?>

                                            </strong>

                                        </div>

                                    </div>

                                </div>


                                <!-- UNIT -->

                                <div class="col-md-4 mb-3">

                                    <div class="ticket-info">

                                        <div class="info-icon">

                                            <i class="fas fa-building"></i>

                                        </div>

                                        <div>

                                            <small>

                                                Unit Tujuan

                                            </small>

                                            <strong>

                                                <?= esc($ticket['unit'] ?? '-') ?>

                                            </strong>

                                        </div>

                                    </div>

                                </div>


                                <!-- TANGGAL -->

                                <div class="col-md-4 mb-3">

                                    <div class="ticket-info">

                                        <div class="info-icon">

                                            <i class="fas fa-calendar-alt"></i>

                                        </div>

                                        <div>

                                            <small>

                                                Tanggal Pengajuan

                                            </small>

                                            <strong>

                                                <?= esc($ticket['tanggal'] ?? '-') ?>

                                            </strong>

                                        </div>

                                    </div>

                                </div>


                            </div>


                            <!-- ============================= -->
                            <!-- STATUS TIMELINE -->
                            <!-- ============================= -->

                            <div class="ticket-progress">


                                <div class="progress-title">

                                    <i class="fas fa-history"></i>

                                    Perkembangan Tiket

                                </div>


                                <div class="timeline">


                                    <!-- SUBMITTED -->

                                    <div class="timeline-item active">

                                        <div class="timeline-icon">

                                            <i class="fas fa-paper-plane"></i>

                                        </div>

                                        <div class="timeline-content">

                                            <strong>

                                                Submitted

                                            </strong>

                                            <small>

                                                Pengajuan telah dikirim oleh pemohon.

                                            </small>

                                        </div>

                                    </div>


                                    <!-- VERIFIED -->

                                    <div class="timeline-item
                                        <?= in_array($status, [
                                            'Verified',
                                            'Assigned',
                                            'In Progress',
                                            'Revision',
                                            'Completed',
                                            'Closed'
                                        ]) ? 'active' : '' ?>">

                                        <div class="timeline-icon">

                                            <i class="fas fa-check"></i>

                                        </div>

                                        <div class="timeline-content">

                                            <strong>

                                                Verified

                                            </strong>

                                            <small>

                                                Pengajuan telah diverifikasi petugas.

                                            </small>

                                        </div>

                                    </div>


                                    <!-- ASSIGNED -->

                                    <div class="timeline-item
                                        <?= in_array($status, [
                                            'Assigned',
                                            'In Progress',
                                            'Revision',
                                            'Completed',
                                            'Closed'
                                        ]) ? 'active' : '' ?>">

                                        <div class="timeline-icon">

                                            <i class="fas fa-share"></i>

                                        </div>

                                        <div class="timeline-content">

                                            <strong>

                                                Assigned

                                            </strong>

                                            <small>

                                                Tiket telah diteruskan ke unit terkait.

                                            </small>

                                        </div>

                                    </div>


                                    <!-- IN PROGRESS -->

                                    <div class="timeline-item
                                        <?= in_array($status, [
                                            'In Progress',
                                            'Revision',
                                            'Completed',
                                            'Closed'
                                        ]) ? 'active' : '' ?>">

                                        <div class="timeline-icon">

                                            <i class="fas fa-spinner"></i>

                                        </div>

                                        <div class="timeline-content">

                                            <strong>

                                                In Progress

                                            </strong>

                                            <small>

                                                Pengajuan sedang diproses oleh unit terkait.

                                            </small>

                                        </div>

                                    </div>


                                    <!-- REVISION -->

                                    <?php if ($status === 'Revision'): ?>

                                        <div class="timeline-item active revision">

                                            <div class="timeline-icon">

                                                <i class="fas fa-exclamation"></i>

                                            </div>

                                            <div class="timeline-content">

                                                <strong>

                                                    Revision

                                                </strong>

                                                <small>

                                                    Pengajuan membutuhkan perbaikan atau dokumen tambahan.

                                                </small>

                                            </div>

                                        </div>

                                    <?php endif; ?>


                                    <!-- COMPLETED -->

                                    <div class="timeline-item
                                        <?= in_array($status, [
                                            'Completed',
                                            'Closed'
                                        ]) ? 'active' : '' ?>">

                                        <div class="timeline-icon">

                                            <i class="fas fa-check-circle"></i>

                                        </div>

                                        <div class="timeline-content">

                                            <strong>

                                                Completed

                                            </strong>

                                            <small>

                                                Pengajuan telah selesai diproses.

                                            </small>

                                        </div>

                                    </div>


                                    <!-- CLOSED -->

                                    <div class="timeline-item
                                        <?= $status === 'Closed' ? 'active' : '' ?>">

                                        <div class="timeline-icon">

                                            <i class="fas fa-lock"></i>

                                        </div>

                                        <div class="timeline-content">

                                            <strong>

                                                Closed

                                            </strong>

                                            <small>

                                                Tiket telah ditutup.

                                            </small>

                                        </div>

                                    </div>


                                </div>

                            </div>


                        </div>


                        <!-- FOOTER -->

                        <div class="card-footer ticket-footer">


                            <span class="text-muted">

                                <i class="fas fa-info-circle"></i>

                                Klik detail untuk melihat informasi lengkap.

                            </span>


                            <a
                                href="<?= base_url('mahasiswa/ticket/detail/' . $ticket['id']) ?>"
                                class="btn btn-primary"
                            >

                                <i class="fas fa-eye"></i>

                                Detail Tiket

                            </a>


                        </div>


                    </div>


                <?php endforeach; ?>


            <?php else: ?>


                <!-- ============================= -->
                <!-- EMPTY STATE -->
                <!-- ============================= -->

                <div class="card empty-ticket-card shadow-sm">

                    <div class="card-body text-center">

                        <div class="empty-icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                        <h4>

                            Belum Ada Tiket

                        </h4>

                        <p class="text-muted">

                            Anda belum memiliki pengajuan layanan.

                        </p>

                        <a
                            href="<?= base_url('mahasiswa/ticket/create') ?>"
                            class="btn btn-primary"
                        >

                            <i class="fas fa-plus-circle"></i>

                            Ajukan Layanan Sekarang

                        </a>

                    </div>

                </div>


            <?php endif; ?>


        </div>

    </section>

</div>


<!-- ============================= -->
<!-- CUSTOM CSS -->
<!-- ============================= -->

<style>

/* ============================= */
/* TITLE */
/* ============================= */

.page-title {

    color: #0d47a1;

    font-weight: 700;

}


/* ============================= */
/* INFO */
/* ============================= */

.tracking-info {

    background: #eff6ff;

    border-left: 5px solid #0d47a1;

    color: #1e3a8a;

}


/* ============================= */
/* TICKET CARD */
/* ============================= */

.ticket-card {

    border: none;

    border-radius: 12px;

    overflow: hidden;

    margin-bottom: 25px;

}


/* ============================= */
/* TICKET HEADER */
/* ============================= */

.ticket-card-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    background: #0d47a1;

    color: white;

    padding: 18px 22px;

    border-bottom: 4px solid #f59e0b;

}


.ticket-label {

    display: block;

    font-size: 12px;

    opacity: 0.8;

}


.ticket-number {

    margin: 4px 0 0;

    font-weight: 700;

}


.ticket-status {

    font-size: 13px;

    padding: 8px 12px;

}


/* ============================= */
/* INFO */
/* ============================= */

.ticket-info {

    display: flex;

    align-items: center;

    gap: 12px;

}


.info-icon {

    width: 45px;

    height: 45px;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #eff6ff;

    color: #0d47a1;

    border-radius: 10px;

    font-size: 18px;

}


.ticket-info small {

    display: block;

    color: #64748b;

}


.ticket-info strong {

    display: block;

    color: #172554;

    margin-top: 3px;

}


/* ============================= */
/* PROGRESS */
/* ============================= */

.ticket-progress {

    margin-top: 15px;

    padding-top: 20px;

    border-top: 1px solid #e2e8f0;

}


.progress-title {

    color: #0d47a1;

    font-weight: 700;

    margin-bottom: 20px;

}


/* ============================= */
/* TIMELINE */
/* ============================= */

.timeline {

    display: flex;

    justify-content: space-between;

    position: relative;

    padding: 0 10px;

}


.timeline::before {

    content: '';

    position: absolute;

    top: 20px;

    left: 5%;

    right: 5%;

    height: 3px;

    background: #e2e8f0;

    z-index: 0;

}


.timeline-item {

    position: relative;

    z-index: 1;

    width: 16%;

    text-align: center;

}


.timeline-icon {

    width: 40px;

    height: 40px;

    margin: 0 auto 10px;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #e2e8f0;

    color: #94a3b8;

    border-radius: 50%;

    border: 3px solid white;

}


.timeline-item.active .timeline-icon {

    background: #0d47a1;

    color: white;

    box-shadow: 0 0 0 3px rgba(13, 71, 161, 0.15);

}


.timeline-item.revision .timeline-icon {

    background: #dc3545;

}


.timeline-content strong {

    display: block;

    font-size: 13px;

    color: #172554;

}


.timeline-content small {

    display: block;

    margin-top: 5px;

    color: #64748b;

    font-size: 11px;

}


/* ============================= */
/* FOOTER */
/* ============================= */

.ticket-footer {

    display: flex;

    justify-content: space-between;

    align-items: center;

}


/* ============================= */
/* EMPTY */
/* ============================= */

.empty-ticket-card {

    border: none;

    border-radius: 12px;

}


.empty-icon {

    font-size: 60px;

    color: #0d47a1;

    margin-bottom: 15px;

}


/* ============================= */
/* BUTTON */
/* ============================= */

.btn-primary {

    background: #0d47a1;

    border-color: #0d47a1;

}


.btn-primary:hover {

    background: #f59e0b;

    border-color: #f59e0b;

}


/* ============================= */
/* RESPONSIVE */
/* ============================= */

@media (max-width: 768px) {


    .ticket-card-header {

        flex-direction: column;

        align-items: flex-start;

        gap: 10px;

    }


    .timeline {

        flex-direction: column;

        gap: 20px;

    }


    .timeline::before {

        top: 20px;

        bottom: 20px;

        left: 29px;

        width: 3px;

        height: auto;

        right: auto;

    }


    .timeline-item {

        width: 100%;

        display: flex;

        align-items: center;

        text-align: left;

        gap: 15px;

    }


    .timeline-icon {

        flex-shrink: 0;

        margin: 0;

    }


    .timeline-content {

        flex: 1;

    }


    .ticket-footer {

        flex-direction: column;

        align-items: stretch;

        gap: 10px;

    }


    .ticket-footer .btn {

        width: 100%;

    }

}

</style>


<?= $this->include('layouts/footer') ?>