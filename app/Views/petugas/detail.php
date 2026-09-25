<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<!-- ASSETS FONTS & ICONS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* =========================================================
       ULT POLBAN - SYSTEM DETAIL STYLING
    ========================================================= */

    :root {
        --ult-navy-dark: #2b3990;
        --ult-navy: #2b3990;
        --ult-blue-accent: #3b4cca;
        --ult-orange: #ff8c00;
        --ult-green: #10b981;
        --ult-yellow: #f59e0b;
        --ult-cyan: #06b6d4;
        --ult-light-bg: #f8fafc;
        --ult-card-border: rgba(226, 232, 240, 0.8);
        --ult-shadow-sm: 0 4px 20px -2px rgba(43, 57, 144, 0.05);
        --ult-shadow-hover: 0 20px 35px -10px rgba(43, 57, 144, 0.12);
    }

    body,
    .container-fluid {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
        background-color: #f1f5f9;
    }

    /* =========================
       HEADER
    ========================= */

    .header-gradient-card {
        background: #2b3990 !important;
        border-radius: 20px;
        padding: 24px 28px;
        color: #ffffff;
        box-shadow: 0 12px 30px rgba(43, 57, 144, 0.25);
        position: relative;
        overflow: hidden;
    }

    .header-gradient-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(
            circle,
            rgba(255, 255, 255, 0.15) 0%,
            rgba(255, 255, 255, 0) 70%
        );
        pointer-events: none;
    }

    .detail-page-title {
        color: #ffffff;
        font-weight: 800;
        letter-spacing: -0.5px;
        font-size: 1.65rem;
    }

    .detail-page-subtitle {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.92rem;
    }

    /* =========================
       CARD
    ========================= */

    .detail-main-card {
        border: 1px solid var(--ult-card-border);
        border-radius: 20px;
        background: #ffffff;
        box-shadow: var(--ult-shadow-sm);
        transition: all 0.35s ease;
        overflow: hidden;
    }

    .detail-main-card:hover {
        box-shadow: var(--ult-shadow-hover);
    }

    .info-section-title {
        color: var(--ult-navy-dark);
        font-weight: 800;
        font-size: 1.05rem;
        margin-bottom: 20px;
        letter-spacing: -0.2px;
        display: flex;
        align-items: center;
    }

    .info-section-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(43, 57, 144, 0.08);
        color: var(--ult-navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 1rem;
    }

    /* =========================
       INFO ITEM
    ========================= */

    .info-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px 18px;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }

    .info-item:hover {
        background: #ffffff;
        border-color: var(--ult-navy);
        box-shadow: 0 10px 25px rgba(43, 57, 144, 0.08);
        transform: translateY(-3px);
    }

    .info-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 6px;
    }

    .info-label i {
        color: var(--ult-navy);
    }

    .info-value {
        display: block;
        color: #0f172a;
        font-weight: 700;
        font-size: 0.98rem;
        word-break: break-word;
    }

    /* =========================
       TICKET NUMBER
    ========================= */

    .ticket-badge-glow {
        color: var(--ult-navy);
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: 0.3px;
    }

    .btn-copy-ticket {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-copy-ticket:hover {
        background: var(--ult-orange);
        border-color: var(--ult-orange);
        color: #ffffff;
        transform: scale(1.08);
    }

    /* =========================
       STATUS
    ========================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 30px;
        padding: 6px 16px;
        font-size: 0.82rem;
        font-weight: 800;
        letter-spacing: 0.3px;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: currentColor;
        animation: pulseDot 1.6s infinite;
    }

    @keyframes pulseDot {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.3);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 8px rgba(0, 0, 0, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        }
    }

    .status-submitted {
        background: #fef3c7;
        color: #b45309;
    }

    .status-verified {
        background: #d1fae5;
        color: #047857;
    }

    .status-disposisi {
        background: #e0f2fe;
        color: #0369a1;
    }

    .status-default {
        background: #f1f5f9;
        color: #475569;
    }

    /* =========================
       DESCRIPTION
    ========================= */

    .description-box {
        background: linear-gradient(
            145deg,
            #f8fafc 0%,
            #f1f5f9 100%
        );
        border-left: 5px solid var(--ult-navy);
        border-radius: 14px;
        padding: 20px;
        color: #334155;
        line-height: 1.7;
        font-weight: 500;
        font-size: 0.96rem;
    }

    /* =========================
       REQUIREMENT / ATTACHMENT
    ========================= */

    .detail-card {
        border: 1px solid var(--ult-card-border);
        border-radius: 20px;
        background: #ffffff;
        box-shadow: var(--ult-shadow-sm);
        overflow: hidden;
    }

    .detail-card-header {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 14px;
        border-bottom: 1px solid #e2e8f0;
    }

    .detail-card-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 10px;
        background: rgba(43, 57, 144, 0.08);
        color: var(--ult-navy);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-card-title {
        color: var(--ult-navy-dark);
        font-weight: 800;
    }

    .detail-card-body {
        padding: 24px;
    }

    .requirement-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .requirement-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 18px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.25s ease;
    }

    .requirement-item:hover {
        background: #ffffff;
        border-color: var(--ult-navy);
        box-shadow: 0 6px 18px rgba(43, 57, 144, 0.07);
        transform: translateY(-2px);
    }

    .requirement-info {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .requirement-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 10px;
        background: #eef2ff;
        color: #293b91;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .requirement-name {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
    }

    .requirement-file {
        margin-top: 3px;
        font-size: 12px;
        color: #64748b;
        word-break: break-all;
    }

    .empty-attachment {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
    }

    .empty-attachment-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 10px;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-attachment h6 {
        margin: 0 0 4px;
        font-weight: 700;
        color: #334155;
    }

    .empty-attachment p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }

    /* =========================
       TIMELINE
    ========================= */

    .timeline {
        position: relative;
        padding-left: 10px;
    }

    .timeline::before {
        content: "";
        position: absolute;
        left: 27px;
        top: 15px;
        bottom: 15px;
        width: 3px;
        background: #e2e8f0;
        border-radius: 4px;
    }

    .timeline-item {
        position: relative;
        display: flex;
        gap: 18px;
        margin-bottom: 20px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        position: relative;
        z-index: 2;
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 0.9rem;
        box-shadow:
            0 0 0 5px #ffffff,
            0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .timeline-icon-primary {
        background: var(--ult-navy);
    }

    .timeline-content {
        flex: 1;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        transition: all 0.25s ease;
    }

    .timeline-content:hover {
        background: #ffffff;
        border-color: var(--ult-navy);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .timeline-title {
        margin: 0 0 4px;
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f172a;
    }

    .timeline-date {
        font-size: 0.78rem;
        font-weight: 600;
        color: #64748b;
    }

    /* =========================
       TOAST
    ========================= */

    #ultToast {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background: #0f172a;
        color: #ffffff;
        padding: 12px 22px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        z-index: 9999;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    #ultToast.show {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    /* =========================
       ANIMATION
    ========================= */

    .detail-animate {
        opacity: 0;
        transform: translateY(18px);
    }

    .detail-animate.show {
        opacity: 1;
        transform: translateY(0);
        transition:
            opacity 0.5s cubic-bezier(0.165, 0.84, 0.44, 1),
            transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .detail-card-header {
            padding: 18px;
        }

        .detail-card-body {
            padding: 18px;
        }

        .requirement-item {
            align-items: flex-start;
            flex-direction: column;
        }

        .requirement-item .btn {
            width: 100%;
        }
    }

    /* =========================================================
       PROFESSIONAL BACK BUTTON
       ========================================================= */
    .detail-back-wrapper {
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid rgba(15, 23, 42, 0.08);
        display: flex;
        justify-content: flex-start;
    }

    .detail-back-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-width: 145px;
        justify-content: center;
        padding: 11px 18px;
        border: 1px solid rgba(15, 23, 42, 0.10);
        border-radius: 10px;
        background: #ffffff;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1px;
        cursor: pointer;
        overflow: hidden;
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease,
            color .25s ease,
            background .25s ease;
        box-shadow:
            0 2px 6px rgba(15, 23, 42, .05),
            0 8px 20px rgba(15, 23, 42, .04);
    }

    .detail-back-btn::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(15, 23, 42, .035),
            transparent
        );
        transform: translateX(-110%);
        transition: transform .55s ease;
    }

    .detail-back-btn:hover {
        transform: translateY(-2px);
        border-color: rgba(15, 23, 42, .18);
        color: #0f172a;
        background: #f8fafc;
        box-shadow:
            0 4px 10px rgba(15, 23, 42, .07),
            0 12px 26px rgba(15, 23, 42, .07);
    }

    .detail-back-btn:hover::before {
        transform: translateX(110%);
    }

    .detail-back-btn:active {
        transform: translateY(0) scale(.98);
        box-shadow:
            0 2px 5px rgba(15, 23, 42, .06);
    }

    .detail-back-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 27px;
        height: 27px;
        border-radius: 7px;
        background: #f1f5f9;
        color: #475569;
        transition:
            transform .25s ease,
            background .25s ease,
            color .25s ease;
    }

    .detail-back-btn:hover .detail-back-icon {
        transform: translateX(-3px);
        background: #e2e8f0;
        color: #0f172a;
    }

    .detail-back-btn.is-loading {
        pointer-events: none;
        opacity: .75;
    }

    .detail-back-btn.is-loading .detail-back-icon {
        animation: detailBackSpin .7s linear infinite;
    }

    @keyframes detailBackSpin {
        to {
            transform: rotate(-360deg);
        }
    }

    @media (max-width: 576px) {
        .detail-back-wrapper {
            margin-top: 24px;
            padding-top: 18px;
        }

        .detail-back-btn {
            width: 100%;
            min-width: 0;
        }
    }

</style>

<?php
    /*
     * ============================================================
     * DATA NORMALIZATION
     * ============================================================
     */

    $tiket = $tiket ?? $ticket ?? [];

    // Nomor tiket
    $nomorTiket =
        $tiket['ticket_number']
        ?? $tiket['nomor_tiket']
        ?? '-';

    // Status
    $statusVal = strtoupper(
        trim(
            $tiket['status']
            ?? 'SUBMITTED'
        )
    );

    $statusClass = match ($statusVal) {
        'SUBMITTED' => 'status-submitted',
        'VERIFIED' => 'status-verified',
        'ASSIGNED',
        'DISPOSISI',
        'PROCESSING',
        'IN_PROGRESS' => 'status-disposisi',
        default => 'status-default',
    };

    // Prioritas
    $priority =
        $tiket['priority']
        ?? $tiket['prioritas']
        ?? 'Normal';

    // Layanan
    $serviceName =
        $tiket['service_name']
        ?? $tiket['layanan']
        ?? '-';

    // Nama pemohon
    $applicantName =
        $tiket['applicant_name']
        ?? $tiket['nama_pemohon']
        ?? $tiket['student_name']
        ?? $tiket['name']
        ?? '-';

    // NIM / NIK
    $identity =
        !empty($tiket['nim'])
        ? $tiket['nim']
        : (!empty($tiket['nik']) ? $tiket['nik'] : '-');

    $identityLabel =
        !empty($tiket['nim'])
        ? 'NIM'
        : (!empty($tiket['nik']) ? 'NIK' : 'Identitas');

    // Email
    $email =
        $tiket['email']
        ?? '-';

    // No HP
    $phone =
        $tiket['phone']
        ?? $tiket['no_hp']
        ?? '-';

    // Judul
    $title =
        $tiket['title']
        ?? $tiket['judul_permohonan']
        ?? '-';

    // Deskripsi
    $description =
        $tiket['description']
        ?? $tiket['keterangan']
        ?? $tiket['deskripsi']
        ?? '';

    // Tanggal pengajuan
    $submittedAt =
        $tiket['submitted_at']
        ?? $tiket['created_at']
        ?? $tiket['tanggal_pengajuan']
        ?? '-';

    /*
     * Attachment dibuat aman supaya tidak muncul
     * Undefined variable ketika controller belum mengirim data.
     */
    $attachments = $attachments ?? [];
?>

<div class="container-fluid px-4 py-4">

    <!-- =========================================================
         HEADER
    ========================================================== -->

    <div class="header-gradient-card d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 detail-animate">

        <div class="mb-3 mb-md-0">

            <h1 class="detail-page-title mb-1">
                <i class="fas fa-ticket-alt me-2 text-warning"></i>
                Detail Informasi Tiket
            </h1>

            <p class="detail-page-subtitle mb-0">
                Layanan Informasi & Verifikasi Data Permohonan Terpadu POLBAN
            </p>

        </div>

    </div>


    <!-- =========================================================
         1. INFORMASI TIKET
    ========================================================== -->

    <div class="card detail-main-card mb-4 detail-animate">

        <div class="card-body p-4">

            <h6 class="info-section-title">

                <span class="info-section-icon">
                    <i class="fas fa-folder-open"></i>
                </span>

                Informasi Tiket & Status

            </h6>


            <div class="row g-3">

                <!-- NOMOR TIKET -->

                <div class="col-md-6 col-lg-4">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-hashtag"></i>
                            Nomor Tiket
                        </span>

                        <div class="d-flex align-items-center justify-content-between mt-1">

                            <span
                                id="ticketNumber"
                                class="info-value ticket-badge-glow"
                            >
                                <?= esc($nomorTiket) ?>
                            </span>

                            <button
                                type="button"
                                class="btn-copy-ticket"
                                id="copyTicketBtn"
                                title="Salin Nomor Tiket"
                            >
                                <i class="fas fa-copy"></i>
                            </button>

                        </div>

                    </div>

                </div>


                <!-- STATUS -->

                <div class="col-md-6 col-lg-4">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-signal"></i>
                            Status Permohonan
                        </span>

                        <div class="mt-1">

                            <span class="status-badge <?= esc($statusClass) ?>">

                                <span class="pulse-dot"></span>

                                <?= esc($statusVal) ?>

                            </span>

                        </div>

                    </div>

                </div>


                <!-- PRIORITAS -->

                <div class="col-md-6 col-lg-4">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-flag"></i>
                            Tingkat Prioritas
                        </span>

                        <span class="info-value mt-1 text-primary">

                            <i class="fas fa-layer-group me-1"></i>

                            <?= esc(ucfirst((string) $priority)) ?>

                        </span>

                    </div>

                </div>


                <!-- LAYANAN -->

                <div class="col-md-6 col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-concierge-bell"></i>
                            Kategori Layanan
                        </span>

                        <span class="info-value mt-1">
                            <?= esc($serviceName) ?>
                        </span>

                    </div>

                </div>


                <!-- TANGGAL PENGAJUAN -->

                <div class="col-md-6 col-lg-6">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="far fa-calendar-alt"></i>
                            Tanggal & Waktu Pengajuan
                        </span>

                        <span class="info-value mt-1">
                            <?= esc($submittedAt) ?>
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         2. DATA PEMOHON
    ========================================================== -->

    <div class="card detail-main-card mb-4 detail-animate">

        <div class="card-body p-4">

            <h6 class="info-section-title">

                <span class="info-section-icon">
                    <i class="fas fa-user-shield"></i>
                </span>

                Data Identitas Pemohon

            </h6>


            <div class="row g-3">

                <!-- NAMA -->

                <div class="col-md-6 col-lg-3">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-user"></i>
                            Nama Lengkap
                        </span>

                        <span class="info-value mt-1">
                            <?= esc($applicantName) ?>
                        </span>

                    </div>

                </div>


                <!-- NIM / IDENTITAS -->

                <div class="col-md-6 col-lg-3">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-id-card"></i>
                            <?= esc($identityLabel) ?>
                        </span>

                        <span class="info-value mt-1">
                            <?= esc($identity) ?>
                        </span>

                    </div>

                </div>


                <!-- EMAIL -->

                <div class="col-md-6 col-lg-3">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-envelope"></i>
                            Alamat Email
                        </span>

                        <span class="info-value mt-1 text-truncate">
                            <?= esc($email) ?>
                        </span>

                    </div>

                </div>


                <!-- NO HP -->

                <div class="col-md-6 col-lg-3">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fab fa-whatsapp"></i>
                            No. HP / WhatsApp
                        </span>

                        <span class="info-value mt-1">
                            <?= esc($phone) ?>
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         3. DETAIL PERMOHONAN
    ========================================================== -->

    <div class="card detail-main-card mb-4 detail-animate">

        <div class="card-body p-4">

            <h6 class="info-section-title">

                <span class="info-section-icon">
                    <i class="fas fa-file-alt"></i>
                </span>

                Rincian & Keterangan Permohonan

            </h6>


            <div class="row g-3">

                <!-- JUDUL -->

                <div class="col-12">

                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-heading"></i>
                            Judul Permohonan
                        </span>

                        <span class="info-value mt-1 fs-6">
                            <?= esc($title) ?>
                        </span>

                    </div>

                </div>


                <!-- DESKRIPSI -->

                <div class="col-12">

                    <div class="description-box">

                        <div class="info-label text-dark fw-bold mb-2">

                            <i class="fas fa-quote-left text-primary"></i>

                            Deskripsi Keperluan

                        </div>

                        <div>

                            <?php if ($description !== ''): ?>

                                <?= nl2br(esc($description)) ?>

                            <?php else: ?>

                                <span class="text-muted">
                                    Tidak ada deskripsi tambahan.
                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         4. PERSYARATAN & LAMPIRAN
    ========================================================== -->

    <div class="detail-card mb-4 detail-animate">

        <div class="detail-card-header">

            <div class="detail-card-icon">

                <i class="fas fa-paperclip"></i>

            </div>

            <div>

                <h5 class="detail-card-title mb-0">
                    Persyaratan & Lampiran
                </h5>

                <small class="text-muted">
                    Dokumen persyaratan yang diunggah saat pembuatan tiket
                </small>

            </div>

        </div>


        <div class="detail-card-body">

            <?php if (!empty($attachments)): ?>

                <div class="requirement-list">

                    <?php foreach ($attachments as $file): ?>

                        <?php
                            /*
                             * Nama file
                             */
                            $fileName =
                                $file['file_name']
                                ?? $file['filename']
                                ?? 'File persyaratan';

                            /*
                             * Nama persyaratan
                             */
                            $requirementName =
                                $file['requirement_name']
                                ?? $file['name']
                                ?? 'Persyaratan';

                            /*
                             * Path file
                             */
                            $filePath =
                                $file['file_path']
                                ?? $file['path']
                                ?? '';

                            $fileUrl = '';

                            if ($filePath !== '') {

                                /*
                                 * Kalau sudah berupa URL lengkap,
                                 * langsung gunakan.
                                 */
                                if (
                                    str_starts_with($filePath, 'http://')
                                    ||
                                    str_starts_with($filePath, 'https://')
                                ) {

                                    $fileUrl = $filePath;

                                } else {

                                    /*
                                     * Normalisasi slash Windows
                                     * menjadi slash URL.
                                     */
                                    $cleanPath = str_replace(
                                        '\\',
                                        '/',
                                        $filePath
                                    );

                                    $cleanPath = ltrim(
                                        $cleanPath,
                                        '/'
                                    );

                                    /*
                                     * Hindari base_url(base_url(...))
                                     */
                                    $fileUrl = base_url($cleanPath);
                                }
                            }
                        ?>


                        <div class="requirement-item">

                            <div class="requirement-info">

                                <div class="requirement-icon">

                                    <?php
                                        $extension = strtolower(
                                            $file['file_extension']
                                            ?? pathinfo(
                                                $fileName,
                                                PATHINFO_EXTENSION
                                            )
                                        );

                                        $fileIcon = match ($extension) {
                                            'pdf' => 'fa-file-pdf',
                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'webp' => 'fa-file-image',
                                            'doc',
                                            'docx' => 'fa-file-word',
                                            'xls',
                                            'xlsx' => 'fa-file-excel',
                                            default => 'fa-file-alt',
                                        };
                                    ?>

                                    <i class="fas <?= esc($fileIcon) ?>"></i>

                                </div>


                                <div>

                                    <div class="requirement-name">
                                        <?= esc($requirementName) ?>
                                    </div>

                                    <div class="requirement-file">
                                        <?= esc($fileName) ?>
                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 INI BAGIAN YANG SEBELUMNYA ERROR
                                 WAJIB PAKAI :
                            ================================================== -->

                            <?php if ($fileUrl !== ''): ?>

                                <a
                                    href="<?= esc($fileUrl) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-primary"
                                >

                                    <i class="fas fa-eye me-1"></i>

                                    Lihat

                                </a>

                            <?php else: ?>

                                <span class="badge bg-secondary">
                                    File tidak tersedia
                                </span>

                            <?php endif; ?>

                        </div>

                    <?php endforeach; ?>

                </div>


            <?php else: ?>

                <!-- TIDAK ADA LAMPIRAN -->

                <div class="empty-attachment">

                    <div class="empty-attachment-icon">

                        <i class="fas fa-folder-open"></i>

                    </div>

                    <div>

                        <h6>
                            Belum ada lampiran
                        </h6>

                        <p>
                            Belum terdapat dokumen persyaratan
                            yang diunggah pada tiket ini.
                        </p>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>


    <!-- =========================================================
         5. TIMELINE
    ========================================================== -->

    <div class="card detail-main-card mb-4 detail-animate">

        <div class="card-body p-4">

            <h6 class="info-section-title">

                <span class="info-section-icon">
                    <i class="fas fa-history"></i>
                </span>

                Lacak Riwayat Proses

            </h6>


            <div class="timeline mt-3">

                <?php if (!empty($timeline)): ?>

                    <?php foreach ($timeline as $item): ?>

                        <div class="timeline-item">

                            <div class="timeline-icon timeline-icon-primary">

                                <i class="fas <?= esc($item['icon'] ?? 'fa-circle') ?>"></i>

                            </div>


                            <div class="timeline-content">

                                <h6 class="timeline-title">

                                    <?= esc($item['title'] ?? '-') ?>

                                </h6>


                                <span class="timeline-date">

                                    <i class="far fa-clock me-1"></i>

                                    <?= esc($item['date'] ?? '-') ?>

                                </span>

                            </div>

                        </div>

                    <?php endforeach; ?>


                <?php else: ?>

                    <div class="timeline-content">

                        <h6 class="timeline-title">
                            Belum ada riwayat proses
                        </h6>

                        <span class="timeline-date">
                            Riwayat akan muncul setelah tiket diproses.
                        </span>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     TOAST
========================================================== -->

<div id="ultToast">

    <i class="fas fa-check-circle text-success fs-5"></i>

    <span id="ultToastMessage">
        Nomor Tiket Berhasil Disalin!
    </span>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================== -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       1. STAGGERED ENTRANCE ANIMATION
    ========================================================== */

    const animatedElements =
        document.querySelectorAll('.detail-animate');

    animatedElements.forEach(function (element, index) {

        setTimeout(function () {

            element.classList.add('show');

        }, index * 90);

    });


    /* =========================================================
       2. COPY NOMOR TIKET
    ========================================================== */

    const copyButton =
        document.getElementById('copyTicketBtn');

    const ticketNumber =
        document.getElementById('ticketNumber');

    const toast =
        document.getElementById('ultToast');

    const toastMsg =
        document.getElementById('ultToastMessage');


    function showToast(message) {

        if (!toast || !toastMsg) {
            return;
        }

        toastMsg.textContent = message;

        toast.classList.add('show');

        setTimeout(function () {

            toast.classList.remove('show');

        }, 2500);
    }


    if (copyButton && ticketNumber) {

        copyButton.addEventListener('click', function () {

            const textToCopy =
                ticketNumber.innerText.trim();


            if (
                navigator.clipboard
                &&
                textToCopy !== ''
                &&
                textToCopy !== '-'
            ) {

                navigator.clipboard
                    .writeText(textToCopy)
                    .then(function () {

                        showToast(
                            'Nomor Tiket "' +
                            textToCopy +
                            '" Berhasil Disalin!'
                        );


                        copyButton.innerHTML =
                            '<i class="fas fa-check text-success"></i>';


                        setTimeout(function () {

                            copyButton.innerHTML =
                                '<i class="fas fa-copy"></i>';

                        }, 1800);

                    })
                    .catch(function () {

                        showToast(
                            'Gagal menyalin nomor tiket.'
                        );

                    });

            }

        });

    }


    /* =========================================================
       3. INTERACTIVE CARD 3D TILT EFFECT
    ========================================================== */

    const cards =
        document.querySelectorAll('.info-item');


    cards.forEach(function (card) {

        card.addEventListener(
            'mousemove',
            function (e) {

                const rect =
                    card.getBoundingClientRect();

                const x =
                    e.clientX -
                    rect.left -
                    rect.width / 2;

                const y =
                    e.clientY -
                    rect.top -
                    rect.height / 2;


                card.style.transform =
                    `perspective(1000px)
                     rotateX(${-y / 20}deg)
                     rotateY(${x / 20}deg)
                     translateY(-3px)`;

            }
        );


        card.addEventListener(
            'mouseleave',
            function () {

                card.style.transform =
                    'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';

            }
        );

    });

});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const backButton = document.getElementById('detailBackButton');

    if (!backButton) return;

    backButton.addEventListener('click', function () {
        if (backButton.classList.contains('is-loading')) return;

        backButton.classList.add('is-loading');

        const icon = backButton.querySelector('i');
        const label = backButton.querySelector('span:last-child');

        if (icon) {
            icon.className = 'fas fa-spinner';
        }

        if (label) {
            label.textContent = 'Kembali...';
        }

        setTimeout(function () {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = "<?= site_url('datatiket') ?>";
            }
        }, 220);
    });
});
</script>


            <div class="detail-back-wrapper">
                <button type="button"
                        id="detailBackButton"
                        class="detail-back-btn"
                        aria-label="Kembali ke halaman sebelumnya">
                    <span class="detail-back-icon">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span>Kembali</span>
                </button>
            </div>

<?= $this->endSection() ?>