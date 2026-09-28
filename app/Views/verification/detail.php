<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .detail-page {
        padding-bottom: 30px;
    }

    /* HEADER */
    .detail-header {
        background: #293b91;
        color: #fff;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .detail-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .detail-header-icon {
        font-size: 26px;
    }

    .detail-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .detail-header p {
        margin: 3px 0 0;
        font-size: 14px;
        opacity: .9;
    }

    .btn-back {
        background: #6c757d;
        color: #fff;
        border: none;
        padding: 10px 16px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-back:hover {
        background: #5a6268;
        color: #fff;
    }

    /* CARD */
    .detail-card {
        background: #fff;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        border: 1px solid #e5e8f0;
    }

    .detail-card-header {
        background: #f5f7fc;
        padding: 16px 20px;
        border-bottom: 1px solid #e1e5ee;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-card-header i {
        color: #293b91;
        font-size: 17px;
    }

    .detail-card-header h3 {
        margin: 0;
        color: #20368d;
        font-size: 17px;
        font-weight: 700;
    }

    .detail-card-body {
        padding: 18px 20px;
    }

    /* GRID */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    .info-item {
        border: 1px solid #e0e5ef;
        border-radius: 9px;
        padding: 14px 16px;
        background: #fff;
        min-height: 78px;
    }

    .info-label {
        color: #69738a;
        font-size: 13px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-label i {
        color: #293b91;
        width: 15px;
    }

    .info-value {
        color: #17233f;
        font-size: 14px;
        font-weight: 500;
        word-break: break-word;
    }

    .ticket-number {
        color: #17368f;
        font-size: 17px;
        font-weight: 700;
    }

    /* STATUS */
    .status-badge {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-submitted {
        background: #fff3cd;
        color: #856404;
    }

    .status-verified {
        background: #d1edda;
        color: #216c3a;
    }

    .status-revision {
        background: #ffe5b4;
        color: #8a5200;
    }

    .status-processing {
        background: #cfe2ff;
        color: #174ea6;
    }

    .status-completed {
        background: #d1edda;
        color: #216c3a;
    }

    .status-rejected,
    .status-cancelled {
        background: #f8d7da;
        color: #842029;
    }

    .status-draft {
        background: #e2e3e5;
        color: #41464b;
    }

    /* DETAIL TEXT */
    .detail-text {
        border: 1px solid #e0e5ef;
        border-radius: 9px;
        padding: 15px 16px;
        background: #fff;
    }

    .detail-text-label {
        color: #69738a;
        font-size: 13px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-text-label i {
        color: #293b91;
    }

    .detail-text-content {
        color: #17233f;
        font-size: 14px;
        line-height: 1.7;
        white-space: pre-line;
    }

    /* PROCESS */
    .timeline {
        position: relative;
        padding: 2px 0 2px 56px;
    }

    .timeline::before {
        content: "";
        position: absolute;
        left: 19px;
        top: 18px;
        bottom: 18px;
        width: 2px;
        background: #dce2ef;
    }

    .timeline-item {
        position: relative;
        padding: 0 0 24px 20px;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-icon {
        position: absolute;
        left: -56px;
        top: 0;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #293b91;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }

    .timeline-title {
        font-weight: 700;
        color: #17233f;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .timeline-date {
        color: #7b8496;
        font-size: 12px;
    }

    .timeline-empty {
        color: #7b8496;
        font-size: 13px;
        font-style: italic;
    }

    /* ALERT */
    .note-box {
        border: 1px solid #e0e5ef;
        border-radius: 9px;
        padding: 15px 16px;
        background: #fff;
    }

    .note-title {
        color: #293b91;
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .note-content {
        color: #17233f;
        font-size: 14px;
        line-height: 1.6;
        white-space: pre-line;
    }

    /* RESPONSIVE */
    @media (max-width: 1000px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .detail-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .timeline {
            padding-left: 50px;
        }
    }
</style>

<div class="detail-page">

    <!-- =========================================================
         HEADER
    ========================================================== -->
    <div class="detail-header">

        <div class="detail-header-left">
            <div class="detail-header-icon">
                <i class="fas fa-file-alt"></i>
            </div>

            <div>
                <h2>Detail Tiket</h2>
                <p>Informasi lengkap data permohonan tiket</p>
            </div>
        </div>

        <a href="<?= site_url('verification') ?>" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>

    </div>


    <!-- =========================================================
         INFORMASI TIKET
    ========================================================== -->
    <div class="detail-card">

        <div class="detail-card-header">
            <i class="fas fa-ticket-alt"></i>
            <h3>Informasi Tiket</h3>
        </div>

        <div class="detail-card-body">

            <div class="info-grid">

                <!-- Nomor Tiket -->
                <div class="info-item">

                    <div class="info-label">
                        <i class="fas fa-ticket-alt"></i>
                        Nomor Tiket
                    </div>

                    <div class="info-value ticket-number">
                        <?= esc($ticket['ticket_number'] ?? '') ?>
                    </div>

                </div>


                <!-- Status -->
                <div class="info-item">

                    <div class="info-label">
                        <i class="fas fa-info-circle"></i>
                        Status
                    </div>

                    <div class="info-value">

                        <?php
                        $status = strtolower($ticket['status'] ?? '');

                        $statusClass = 'status-' . $status;

                        $statusText = [
                            'draft'        => 'Draft',
                            'submitted'    => 'Submitted',
                            'verification' => 'Verification',
                            'verified'     => 'Verified',
                            'revision'     => 'Revision',
                            'assigned'     => 'Assigned',
                            'processing'   => 'Processing',
                            'completed'    => 'Completed',
                            'rejected'     => 'Rejected',
                            'cancelled'    => 'Cancelled'
                        ];

                        $displayStatus = $statusText[$status] ?? ucfirst($status);
                        ?>

                        <span class="status-badge <?= esc($statusClass) ?>">
                            <?= esc($displayStatus) ?>
                        </span>

                    </div>

                </div>


                <!-- Prioritas -->
                <div class="info-item">

                    <div class="info-label">
                        <i class="fas fa-exclamation-circle"></i>
                        Prioritas
                    </div>

                    <div class="info-value">
                        <?= esc(ucfirst($ticket['priority'] ?? '')) ?>
                    </div>

                </div>


                <!-- Layanan -->
                <div class="info-item">

                    <div class="info-label">
                        <i class="fas fa-concierge-bell"></i>
                        Layanan
                    </div>

                    <div class="info-value">
                        <?= esc($ticket['service_name'] ?? '') ?>
                    </div>

                </div>


                <!-- Tanggal Pengajuan -->
                <?php if (!empty($ticket['submitted_at'])): ?>

                    <div class="info-item">

                        <div class="info-label">
                            <i class="fas fa-calendar-alt"></i>
                            Tanggal Pengajuan
                        </div>

                        <div class="info-value">
                            <?= esc($ticket['submitted_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- Tanggal Verifikasi -->
                <?php if (!empty($ticket['verified_at'])): ?>

                    <div class="info-item">

                        <div class="info-label">
                            <i class="fas fa-calendar-check"></i>
                            Tanggal Verifikasi
                        </div>

                        <div class="info-value">
                            <?= esc($ticket['verified_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>


    <!-- =========================================================
         DATA PEMOHON
    ========================================================== -->
    <?php if (!empty($profile)): ?>

        <div class="detail-card">

            <div class="detail-card-header">
                <i class="fas fa-user"></i>
                <h3>Data Pemohon</h3>
            </div>

            <div class="detail-card-body">

                <div class="info-grid">

                    <!-- Nama -->
                    <?php if (!empty($profile['name'])): ?>

                        <div class="info-item">

                            <div class="info-label">
                                <i class="fas fa-user"></i>
                                Nama Pemohon
                            </div>

                            <div class="info-value">
                                <?= esc($profile['name']) ?>
                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- NIM -->
                    <?php if (!empty($profile['nim'])): ?>

                        <div class="info-item">

                            <div class="info-label">
                                <i class="fas fa-id-card"></i>
                                NIM
                            </div>

                            <div class="info-value">
                                <?= esc($profile['nim']) ?>
                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- NIK -->
                    <?php if (!empty($profile['nik'])): ?>

                        <div class="info-item">

                            <div class="info-label">
                                <i class="fas fa-id-card"></i>
                                NIK
                            </div>

                            <div class="info-value">
                                <?= esc($profile['nik']) ?>
                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- Email -->
                    <?php if (!empty($profile['email'])): ?>

                        <div class="info-item">

                            <div class="info-label">
                                <i class="fas fa-envelope"></i>
                                Email
                            </div>

                            <div class="info-value">
                                <?= esc($profile['email']) ?>
                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- No HP -->
                    <?php if (!empty($profile['phone'])): ?>

                        <div class="info-item">

                            <div class="info-label">
                                <i class="fas fa-phone"></i>
                                No. HP
                            </div>

                            <div class="info-value">
                                <?= esc($profile['phone']) ?>
                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- Alamat -->
                    <?php if (!empty($profile['address'])): ?>

                        <div class="info-item">

                            <div class="info-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Alamat
                            </div>

                            <div class="info-value">
                                <?= esc($profile['address']) ?>
                            </div>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    <?php endif; ?>


    <!-- =========================================================
         DETAIL PERMOHONAN
    ========================================================== -->
    <?php if (
        !empty($ticket['title']) ||
        !empty($ticket['description'])
    ): ?>

        <div class="detail-card">

            <div class="detail-card-header">
                <i class="fas fa-align-left"></i>
                <h3>Detail Permohonan</h3>
            </div>

            <div class="detail-card-body">

                <!-- Judul -->
                <?php if (!empty($ticket['title'])): ?>

                    <div class="detail-text" style="margin-bottom: 14px;">

                        <div class="detail-text-label">
                            <i class="fas fa-heading"></i>
                            Judul Permohonan
                        </div>

                        <div class="detail-text-content">
                            <?= esc($ticket['title']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- Keterangan -->
                <?php if (!empty($ticket['description'])): ?>

                    <div class="detail-text">

                        <div class="detail-text-label">
                            <i class="fas fa-align-left"></i>
                            Keterangan Permohonan
                        </div>

                        <div class="detail-text-content">
                            <?= esc($ticket['description']) ?>
                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    <?php endif; ?>


    <!-- =========================================================
         INFORMASI PROSES
    ========================================================== -->
    <div class="detail-card">

        <div class="detail-card-header">
            <i class="fas fa-history"></i>
            <h3>Informasi Proses</h3>
        </div>

        <div class="detail-card-body">

            <div class="timeline">

                <!-- TIKET DIAJUKAN -->
                <?php if (!empty($ticket['submitted_at'])): ?>

                    <div class="timeline-item">

                        <div class="timeline-icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>

                        <div class="timeline-title">
                            Tiket Diajukan
                        </div>

                        <div class="timeline-date">
                            <?= esc($ticket['submitted_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- VERIFIKASI -->
                <?php if (!empty($ticket['verified_at'])): ?>

                    <div class="timeline-item">

                        <div class="timeline-icon">
                            <i class="fas fa-check"></i>
                        </div>

                        <div class="timeline-title">
                            Verifikasi
                        </div>

                        <div class="timeline-date">
                            <?= esc($ticket['verified_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- PROSES -->
                <?php if (!empty($ticket['processed_at'])): ?>

                    <div class="timeline-item">

                        <div class="timeline-icon">
                            <i class="fas fa-cogs"></i>
                        </div>

                        <div class="timeline-title">
                            Diproses
                        </div>

                        <div class="timeline-date">
                            <?= esc($ticket['processed_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- SELESAI -->
                <?php if (!empty($ticket['completed_at'])): ?>

                    <div class="timeline-item">

                        <div class="timeline-icon">
                            <i class="fas fa-check-double"></i>
                        </div>

                        <div class="timeline-title">
                            Selesai
                        </div>

                        <div class="timeline-date">
                            <?= esc($ticket['completed_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- DITOLAK -->
                <?php if (!empty($ticket['rejected_at'])): ?>

                    <div class="timeline-item">

                        <div class="timeline-icon">
                            <i class="fas fa-times"></i>
                        </div>

                        <div class="timeline-title">
                            Ditolak
                        </div>

                        <div class="timeline-date">
                            <?= esc($ticket['rejected_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- DIBATALKAN -->
                <?php if (!empty($ticket['cancelled_at'])): ?>

                    <div class="timeline-item">

                        <div class="timeline-icon">
                            <i class="fas fa-ban"></i>
                        </div>

                        <div class="timeline-title">
                            Dibatalkan
                        </div>

                        <div class="timeline-date">
                            <?= esc($ticket['cancelled_at']) ?>
                        </div>

                    </div>

                <?php endif; ?>


                <!-- Jika belum ada proses -->
                <?php if (
                    empty($ticket['submitted_at']) &&
                    empty($ticket['verified_at']) &&
                    empty($ticket['processed_at']) &&
                    empty($ticket['completed_at']) &&
                    empty($ticket['rejected_at']) &&
                    empty($ticket['cancelled_at'])
                ): ?>

                    <div class="timeline-empty">
                        Belum ada informasi proses.
                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>


    <!-- =========================================================
         CATATAN ADMIN
    ========================================================== -->
    <?php if (!empty($ticket['admin_note'])): ?>

        <div class="detail-card">

            <div class="detail-card-header">
                <i class="fas fa-sticky-note"></i>
                <h3>Catatan Admin</h3>
            </div>

            <div class="detail-card-body">

                <div class="note-box">

                    <div class="note-title">
                        Catatan
                    </div>

                    <div class="note-content">
                        <?= esc($ticket['admin_note']) ?>
                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>


    <!-- =========================================================
         ALASAN PENOLAKAN
    ========================================================== -->
    <?php if (!empty($ticket['rejection_reason'])): ?>

        <div class="detail-card">

            <div class="detail-card-header">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Alasan Penolakan</h3>
            </div>

            <div class="detail-card-body">

                <div class="note-box">

                    <div class="note-title">
                        Alasan
                    </div>

                    <div class="note-content">
                        <?= esc($ticket['rejection_reason']) ?>
                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>