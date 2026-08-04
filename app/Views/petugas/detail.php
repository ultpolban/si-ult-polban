<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* =========================================================
       DETAIL TIKET - STYLE SISTEM ULT POLBAN
       Mengikuti tema Dashboard & Data Tiket
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

    /* =========================
       SUMMARY CARDS
    ========================= */

    .summary-card {
        border: none;
        border-radius: 12px;
        min-height: 125px;
        overflow: hidden;
        position: relative;
        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease;
    }

    .summary-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.14) !important;
    }

    .summary-card .card-body {
        padding: 20px;
        position: relative;
        z-index: 2;
    }

    .summary-label {
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        opacity: 0.8;
        margin-bottom: 6px;
    }

    .summary-value {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        word-break: break-word;
    }

    .summary-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        z-index: 1;
    }

    .summary-blue {
        background: var(--ult-blue);
        color: #fff;
    }

    .summary-orange {
        background: var(--ult-orange);
        color: #fff;
    }

    .summary-navy {
        background: var(--ult-navy);
        color: #fff;
    }

    .summary-green {
        background: var(--ult-green);
        color: #fff;
    }

    .summary-blue .summary-icon,
    .summary-orange .summary-icon,
    .summary-navy .summary-icon,
    .summary-green .summary-icon {
        background: rgba(255, 255, 255, 0.20);
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

        .summary-icon {
            width: 44px;
            height: 44px;
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
         SUMMARY CARDS
    ====================================================== -->

    <div class="row g-3 mb-4">

        <!-- NO TIKET -->
        <div class="col-xl-3 col-md-6 detail-animate">

            <div class="card summary-card summary-blue shadow-sm">

                <div class="card-body">

                    <div class="summary-label">
                        Nomor Tiket
                    </div>

                    <p class="summary-value">
                        <?= esc($tiket['nomor_tiket'] ?? 'ULT-001') ?>
                    </p>

                    <div class="summary-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- PRIORITAS -->
        <div class="col-xl-3 col-md-6 detail-animate">

            <div class="card summary-card summary-orange shadow-sm">

                <div class="card-body">

                    <div class="summary-label">
                        Prioritas
                    </div>

                    <p class="summary-value">
                        <?= esc($tiket['prioritas'] ?? 'High') ?>
                    </p>

                    <div class="summary-icon">
                        <i class="fas fa-flag"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- UNIT -->
        <div class="col-xl-3 col-md-6 detail-animate">

            <div class="card summary-card summary-navy shadow-sm">

                <div class="card-body">

                    <div class="summary-label">
                        Unit Tujuan
                    </div>

                    <p class="summary-value">
                        <?= esc($tiket['kategori'] ?? 'Akademik') ?>
                    </p>

                    <div class="summary-icon">
                        <i class="fas fa-building"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- STATUS -->
        <div class="col-xl-3 col-md-6 detail-animate">

            <div class="card summary-card summary-green shadow-sm">

                <div class="card-body">

                    <div class="summary-label">
                        Status
                    </div>

                    <p class="summary-value">
                        <?= esc($tiket['status'] ?? 'Submitted') ?>
                    </p>

                    <div class="summary-icon">
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

    /* =========================================
       ANIMASI ELEMENT SAAT HALAMAN DIBUKA
    ========================================= */

    const animatedElements = document.querySelectorAll('.detail-animate');

    animatedElements.forEach(function (element, index) {

        setTimeout(function () {
            element.classList.add('show');
        }, index * 80);

    });


    /* =========================================
       COPY NOMOR TIKET
    ========================================= */

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


    /* =========================================
       HOVER EFFECT SUMMARY CARD
    ========================================= */

    const summaryCards =
        document.querySelectorAll('.summary-card');

    summaryCards.forEach(function (card) {

        card.addEventListener('mouseenter', function () {
            card.style.cursor = 'default';
        });

    });

});
</script>


<?= $this->endSection() ?>