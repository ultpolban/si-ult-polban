<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* =========================================================
       DETAIL TIKET - STYLE SISTEM ULT POLBAN
    ========================================================= */

    :root {
        --ult-navy: #1a237e;
        --ult-orange: #ff8c00;
        --ult-green: #198754;
        --ult-blue: #0d6efd;
        --ult-yellow: #f4c400;
        --ult-light: #f5f7fb;
        --ult-border: #e4e7ec;
        --ult-text: #263238;
        --ult-muted: #6c757d;
    }

    body, .container-fluid {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    /* =========================
       PAGE HEADER
    ========================= */

    .detail-page-title {
        color: var(--ult-navy);
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    .detail-page-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .detail-breadcrumb {
        font-size: 0.9rem;
    }

    .detail-breadcrumb a {
        color: var(--ult-blue);
        text-decoration: none;
    }

    /* =========================================================
       SUMMARY CARDS (DISAMAKAN DENGAN FOTO HASIL REVISI)
    ========================================================= */

    .stat-tamu-card {
        border-radius: 18px;
        border: none;
        color: #ffffff;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .stat-tamu-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        z-index: -1;
        transition: transform 0.5s ease;
    }

    .stat-tamu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .stat-tamu-card:hover::before {
        transform: scale(1.25);
    }

    .bg-tamu-navy {
        background: linear-gradient(135deg, #1b2e85 0%, #283593 100%) !important;
    }

    .bg-tamu-orange {
        background: linear-gradient(135deg, #ff7a00 0%, #ff8c00 100%) !important;
    }

    .bg-tamu-yellow {
        background: linear-gradient(135deg, #ffb300 0%, #f4c400 100%) !important;
    }

    .bg-tamu-green {
        background: linear-gradient(135deg, #00a86b 0%, #10b981 100%) !important;
    }

    .icon-tamu-circle {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        box-shadow: inset 0 0 12px rgba(255, 255, 255, 0.25);
    }

    /* =========================
       MAIN CARD
    ========================= */

    .detail-main-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .detail-card-header {
        background: var(--ult-navy);
        color: #fff;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .detail-card-header-title {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .detail-card-header-title i {
        margin-right: 9px;
    }

    /* =========================
       STATUS BADGE
    ========================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 7px;
        padding: 8px 13px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .status-submitted {
        background: #ffc107;
        color: #212529;
    }

    .status-verified {
        background: var(--ult-green);
        color: #fff;
    }

    .status-disposisi {
        background: #0dcaf0;
        color: #212529;
    }

    .status-default {
        background: #6c757d;
        color: #fff;
    }

    /* =========================
       INFORMATION GRID
    ========================= */

    .info-section-title {
        color: var(--ult-navy);
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 18px;
    }

    .info-section-title i {
        margin-right: 8px;
    }

    .info-item {
        background: #f8f9fb;
        border: 1px solid var(--ult-border);
        border-radius: 9px;
        padding: 14px 16px;
        height: 100%;
        transition: all 0.2s ease;
    }

    .info-item:hover {
        background: #fff;
        border-color: rgba(26, 35, 126, 0.35);
        box-shadow: 0 4px 12px rgba(26, 35, 126, 0.06);
    }

    .info-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--ult-muted);
        margin-bottom: 5px;
    }

    .info-label i {
        color: var(--ult-navy);
        margin-right: 5px;
    }

    .info-value {
        display: block;
        color: #212529;
        font-weight: 600;
        font-size: 0.94rem;
    }

    .ticket-number-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ticket-number {
        color: var(--ult-blue);
        font-weight: 700;
    }

    .btn-copy-ticket {
        width: 30px;
        height: 30px;
        padding: 0;
        border-radius: 6px;
        border: 1px solid #dfe3e8;
        background: #fff;
        color: var(--ult-navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-copy-ticket:hover {
        background: var(--ult-navy);
        color: #fff;
    }

    /* =========================
       ATTACHMENT
    ========================= */

    .attachment-box {
        border: 1px dashed #cfd4dc;
        border-radius: 9px;
        padding: 14px;
        background: #fafbfc;
    }

    .btn-attachment {
        background: var(--ult-blue);
        border-color: var(--ult-blue);
        color: #fff;
        border-radius: 7px;
        font-weight: 600;
    }

    .btn-attachment:hover {
        background: #0b5ed7;
        border-color: #0b5ed7;
        color: #fff;
    }

    /* =========================
       DESCRIPTION
    ========================= */

    .description-box {
        background: #f8f9fb;
        border: 1px solid var(--ult-border);
        border-radius: 9px;
        padding: 16px;
        color: #495057;
        line-height: 1.7;
        min-height: 90px;
    }

    /* =========================
       TIMELINE
    ========================= */

    .timeline {
        position: relative;
        padding-left: 12px;
    }

    .timeline::before {
        content: "";
        position: absolute;
        left: 28px;
        top: 10px;
        bottom: 10px;
        width: 3px;
        background: #e9ecef;
        border-radius: 5px;
    }

    .timeline-item {
        position: relative;
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        position: relative;
        z-index: 2;
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.85rem;
        box-shadow: 0 0 0 4px #fff;
    }

    .timeline-icon-primary {
        background: var(--ult-blue);
    }

    .timeline-icon-warning {
        background: var(--ult-orange);
    }

    .timeline-icon-success {
        background: var(--ult-green);
    }

    .timeline-content {
        flex: 1;
        background: #f8f9fb;
        border: 1px solid var(--ult-border);
        border-radius: 9px;
        padding: 13px 15px;
        transition: all 0.2s ease;
    }

    .timeline-content:hover {
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .timeline-title {
        margin: 0 0 3px;
        font-size: 0.92rem;
        font-weight: 700;
        color: #212529;
    }

    .timeline-desc {
        margin: 0;
        font-size: 0.82rem;
        color: #6c757d;
    }

    .timeline-date {
        font-size: 0.76rem;
        font-weight: 600;
        color: #6c757d;
        margin-top: 6px;
        display: block;
    }

    /* =========================
       ACTION FOOTER
    ========================= */

    .detail-footer {
        background: #fff;
        border-top: 1px solid #eef0f3;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .detail-actions {
        display: flex;
        gap: 8px;
    }

    .btn-detail-back,
    .btn-detail-success,
    .btn-detail-orange {
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-detail-back:hover,
    .btn-detail-success:hover,
    .btn-detail-orange:hover {
        transform: translateY(-1px);
    }

    .btn-detail-orange {
        background: var(--ult-orange);
        border-color: var(--ult-orange);
        color: #fff;
    }

    .btn-detail-orange:hover {
        background: #e67e00;
        border-color: #e67e00;
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 767px) {

        .detail-card-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 10px;
        }

        .detail-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .detail-actions {
            flex-direction: column;
        }

        .detail-actions a,
        .detail-footer > a {
            width: 100%;
        }

        .timeline::before {
            left: 25px;
        }

        .timeline-icon {
            width: 32px;
            height: 32px;
            flex-basis: 32px;
        }
    }

    /* =========================
       PAGE ANIMATION
    ========================= */

    .detail-animate {
        opacity: 0;
        transform: translateY(12px);
    }

    .detail-animate.show {
        opacity: 1;
        transform: translateY(0);
        transition:
            opacity 0.45s ease,
            transform 0.45s ease;
    }
</style>

<div class="container-fluid px-4 py-4">

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4 detail-animate">

        <div>
            <h1 class="h3 detail-page-title mb-1">
                <i class="fas fa-file-alt me-2"></i>
                Detail Tiket
            </h1>

            <p class="detail-page-subtitle mb-0">
                Informasi lengkap pengajuan layanan mahasiswa.
            </p>
        </div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0 detail-breadcrumb">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('petugas/dashboard') ?>">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('petugas/tiket') ?>">
                        Data Tiket
                    </a>
                </li>

                <li class="breadcrumb-item active text-muted">
                    Detail
                </li>

            </ol>
        </nav>

    </div>


    <!-- =====================================================
         SUMMARY CARDS (PERSIS DENGAN HAFALAN TAMPILAN FOTO)
    ====================================================== -->

    <div class="row g-3 mb-4">
        <!-- TOTAL TAMU -->
        <div class="col-xl-3 col-md-6 detail-animate">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">TOTAL TAMU</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['total'] ?? '8') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- SUBMITTED -->
        <div class="col-xl-3 col-md-6 detail-animate">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">SUBMITTED</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['submitted'] ?? '1') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ASSIGNED / DIPROSES -->
        <div class="col-xl-3 col-md-6 detail-animate">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">ASSIGNED / DIPROSES</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['assigned'] ?? '5') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- VERIFIED / SELESAI -->
        <div class="col-xl-3 col-md-6 detail-animate">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">VERIFIED / SELESAI</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['verified'] ?? '2') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- =====================================================
         DATA PENGAJUAN
    ====================================================== -->

    <div class="card detail-main-card shadow-sm mb-4 detail-animate">

        <div class="detail-card-header">

            <h5 class="detail-card-header-title">
                <i class="fas fa-file-invoice"></i>
                Data Pengajuan
            </h5>

            <?php
                $status = $tiket['status'] ?? 'Submitted';

                if ($status == 'Submitted') {
                    $statusClass = 'status-submitted';
                    $statusIcon = 'fa-clock';
                } elseif ($status == 'Verified') {
                    $statusClass = 'status-verified';
                    $statusIcon = 'fa-check';
                } elseif ($status == 'Disposisi') {
                    $statusClass = 'status-disposisi';
                    $statusIcon = 'fa-share-square';
                } else {
                    $statusClass = 'status-default';
                    $statusIcon = 'fa-info-circle';
                }
            ?>

            <span class="status-badge <?= $statusClass ?>">
                <i class="fas <?= $statusIcon ?>"></i>
                <?= esc($status) ?>
            </span>

        </div>


        <div class="card-body p-4">

            <h6 class="info-section-title">
                <i class="fas fa-user"></i>
                Informasi Pemohon
            </h6>


            <div class="row g-3 mb-4">

                <!-- NOMOR TIKET -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-hashtag"></i>
                            Nomor Tiket
                        </span>

                        <div class="ticket-number-wrapper">

                            <span
                                id="ticketNumber"
                                class="info-value ticket-number"
                            >
                                <?= esc($tiket['nomor_tiket'] ?? 'ULT-001') ?>
                            </span>

                            <button
                                type="button"
                                class="btn-copy-ticket"
                                id="copyTicketBtn"
                                title="Salin nomor tiket"
                            >
                                <i class="fas fa-copy"></i>
                            </button>

                        </div>

                    </div>

                </div>


                <!-- NAMA -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-user"></i>
                            Nama Mahasiswa
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['nama_pemohon'] ?? 'Rafi Putra') ?>
                        </span>

                    </div>

                </div>


                <!-- NIM -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-id-card"></i>
                            NIM
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['nim'] ?? '231511001') ?>
                        </span>

                    </div>

                </div>


                <!-- LAYANAN -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-concierge-bell"></i>
                            Jenis Layanan
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?>
                        </span>

                    </div>

                </div>


                <!-- EMAIL -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['email'] ?? 'rafi@student.polban.ac.id') ?>
                        </span>

                    </div>

                </div>


                <!-- NO HP -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-phone"></i>
                            Nomor HP
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['no_hp'] ?? '081234567890') ?>
                        </span>

                    </div>

                </div>


                <!-- TANGGAL -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="far fa-calendar-alt"></i>
                            Tanggal Pengajuan
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['tanggal'] ?? '17 Juli 2026') ?>
                        </span>

                    </div>

                </div>


                <!-- KATEGORI -->
                <div class="col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-layer-group"></i>
                            Kategori / Unit Tujuan
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['kategori'] ?? 'Akademik') ?>
                        </span>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 LAMPIRAN
            ================================================== -->

            <h6 class="info-section-title">
                <i class="fas fa-paperclip"></i>
                Lampiran & Dokumen
            </h6>

            <div class="attachment-box mb-4">

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

                    <div>

                        <strong class="d-block text-dark">
                            <i class="fas fa-file-pdf text-danger me-2"></i>
                            Dokumen Pengajuan
                        </strong>

                        <small class="text-muted">
                            Dokumen yang diunggah oleh pemohon.
                        </small>

                    </div>

                    <a
                        href="#"
                        class="btn btn-attachment btn-sm"
                    >
                        <i class="fas fa-eye me-1"></i>
                        Lihat Lampiran
                    </a>

                </div>

            </div>


            <!-- =================================================
                 DESKRIPSI
            ================================================== -->

            <h6 class="info-section-title">
                <i class="fas fa-align-left"></i>
                Deskripsi Pengajuan
            </h6>

            <div class="description-box">

                <?= nl2br(esc(
                    $tiket['deskripsi']
                    ?? 'Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.'
                )) ?>

            </div>

        </div>

    </div>


    <!-- =====================================================
         RIWAYAT PROSES
    ====================================================== -->

    <div class="card detail-main-card shadow-sm mb-4 detail-animate">

        <div class="detail-card-header">

            <h5 class="detail-card-header-title">
                <i class="fas fa-history"></i>
                Riwayat Proses Tiket
            </h5>

            <span class="badge bg-light text-dark px-3 py-2">
                Riwayat Aktivitas
            </span>

        </div>


        <div class="card-body p-4">

            <div class="timeline">


                <!-- RIWAYAT 1 -->

                <div class="timeline-item">

                    <div class="timeline-icon timeline-icon-primary">
                        <i class="fas fa-file-alt"></i>
                    </div>

                    <div class="timeline-content">

                        <h6 class="timeline-title">
                            Pengajuan dibuat mahasiswa
                        </h6>

                        <p class="timeline-desc">
                            Berkas berhasil diunggah oleh mahasiswa dan tiket berhasil dibuat.
                        </p>

                        <span class="timeline-date">
                            <i class="far fa-clock me-1"></i>
                            20 Juli 2026
                        </span>

                    </div>

                </div>


                <!-- RIWAYAT 2 -->

                <div class="timeline-item">

                    <div class="timeline-icon timeline-icon-warning">
                        <i class="fas fa-user-clock"></i>
                    </div>

                    <div class="timeline-content">

                        <h6 class="timeline-title">
                            Menunggu Verifikasi Petugas
                        </h6>

                        <p class="timeline-desc">
                            Tiket masuk dalam antrian dan menunggu pemeriksaan petugas ULT.
                        </p>

                        <span class="timeline-date">
                            <i class="far fa-clock me-1"></i>
                            Status saat ini
                        </span>

                    </div>

                </div>


                <!-- RIWAYAT 3 -->

                <div class="timeline-item">

                    <div class="timeline-icon timeline-icon-success">
                        <i class="fas fa-check"></i>
                    </div>

                    <div class="timeline-content">

                        <h6 class="timeline-title">
                            Proses berikutnya
                        </h6>

                        <p class="timeline-desc">
                            Setelah diverifikasi, tiket dapat dilanjutkan ke proses disposisi/unit tujuan.
                        </p>

                        <span class="timeline-date">
                            <i class="fas fa-hourglass-half me-1"></i>
                            Menunggu proses
                        </span>

                    </div>

                </div>


            </div>

        </div>


        <!-- =================================================
             ACTION BUTTONS
        ================================================== -->

        <div class="detail-footer">

            <a
                href="<?= base_url('petugas/tiket') ?>"
                class="btn btn-secondary btn-detail-back"
            >
                <i class="fas fa-arrow-left me-1"></i>
                Kembali ke Data Tiket
            </a>


            <div class="detail-actions">

                <a
                    href="<?= base_url('petugas/verifikasi/' . ($id ?? 1)) ?>"
                    class="btn btn-success btn-detail-success"
                >
                    <i class="fas fa-user-check me-1"></i>
                    Verifikasi Tiket
                </a>

                <a
                    href="<?= base_url('petugas/disposisi/' . ($id ?? 1)) ?>"
                    class="btn btn-detail-orange"
                >
                    <i class="fas fa-share-square me-1"></i>
                    Disposisi
                </a>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ANIMASI ELEMENT SAAT HALAMAN DIBUKA */
    const animatedElements = document.querySelectorAll('.detail-animate');

    animatedElements.forEach(function (element, index) {

        setTimeout(function () {
            element.classList.add('show');
        }, index * 80);

    });


    /* COPY NOMOR TIKET */
    const copyButton = document.getElementById('copyTicketBtn');
    const ticketNumber = document.getElementById('ticketNumber');

    if (copyButton && ticketNumber) {

        copyButton.addEventListener('click', function () {

            const text = ticketNumber.innerText.trim();

            if (navigator.clipboard) {

                navigator.clipboard.writeText(text).then(function () {

                    const originalIcon = copyButton.innerHTML;

                    copyButton.innerHTML =
                        '<i class="fas fa-check"></i>';

                    copyButton.style.backgroundColor = '#198754';
                    copyButton.style.color = '#fff';

                    setTimeout(function () {

                        copyButton.innerHTML = originalIcon;
                        copyButton.style.backgroundColor = '';
                        copyButton.style.color = '';

                    }, 1500);

                });

            }

        });

    }

});
</script>


<?= $this->endSection() ?>