<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root {
    --polban-navy: #1a237e;
    --polban-blue: #005bac;
    --polban-orange: #ff8c00;
    --polban-yellow: #f4c400;
    --polban-green: #198754;
    --soft-bg: #f4f6f9;
    --text-dark: #263238;
    --text-muted: #6c757d;
}

/* ==========================================================================
   1. GLOBAL & PAGE
   ========================================================================== */
body,
.container-fluid {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    color: var(--text-dark);
}

.ticket-page {
    animation: pageFadeIn .45s ease;
}

::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* ==========================================================================
   2. STATISTIC CARDS (PERSISI DATA TIKET)
   ========================================================================== */
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
    background: linear-gradient(135deg, #1a237e 0%, #283593 100%) !important;
}

.bg-tamu-orange {
    background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%) !important;
}

.bg-tamu-yellow {
    background: linear-gradient(135deg, #f4c400 0%, #fb8c00 100%) !important;
}

.bg-tamu-green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
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

/* ==========================================================================
   3. FILTER & TOOLBAR (DISAMAKAN DENGAN STYLE TIKET)
   ========================================================================== */
.ticket-filter-card {
    border: 0;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,.06);
    position: relative;
    z-index: 100 !important;
    overflow: visible !important;
}

.ticket-filter-card .card-body {
    padding: 18px;
}

.ticket-input-group {
    height: 44px;
}

.ticket-input-group .input-group-text {
    background: #fff;
    border-right: 0;
    color: var(--polban-navy);
}

.ticket-input {
    height: 44px;
    border-left: 0;
    font-size: .9rem;
}

.ticket-input:focus,
.ticket-select:focus {
    border-color: var(--polban-navy);
    box-shadow: 0 0 0 .18rem rgba(26,35,126,.12);
}

.ticket-select {
    height: 44px;
    border-radius: 8px;
    font-size: .9rem;
}

.btn-ticket-filter {
    height: 44px;
    border: 0;
    border-radius: 8px;
    background: var(--polban-navy);
    color: #fff;
    font-weight: 700;
    transition: .25s ease;
}

.btn-ticket-filter:hover {
    background: #11185f;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(26,35,126,.25);
}

.btn-ticket-reset {
    height: 44px;
    width: 46px;
    border-radius: 8px;
    background: #6c757d;
    color: #fff;
    border: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: .25s ease;
}

.btn-ticket-reset:hover {
    background: #545b62;
    color: #fff;
    transform: translateY(-1px);
}

/* STYLE TOMBOL EXPORT LAPORAN */
.btn-export-laporan {
    height: 44px;
    background-color: #15803d;
    color: #ffffff;
    font-weight: 700;
    border: none;
    border-radius: 8px;
    padding: 0 16px;
    transition: all 0.25s ease;
}

.btn-export-laporan:hover,
.btn-export-laporan:focus {
    background-color: #166534;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(21, 128, 61, 0.3);
}

.export-dropdown-menu {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    padding: 8px;
    min-width: 180px;
}

.export-dropdown-menu .dropdown-item {
    font-weight: 600;
    font-size: 0.88rem;
    padding: 10px 14px;
    border-radius: 8px;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s ease;
}

.export-dropdown-menu .dropdown-item:hover {
    background-color: #f1f5f9;
}

/* ==========================================================================
   4. TABEL STYLE PERSISI TIKET.PHP
   ========================================================================== */
.ticket-table-card {
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,.07);
}

.ticket-table-header {
    background: #fff;
    padding: 18px 20px;
    border-bottom: 1px solid #edf0f4;
}

.ticket-table-title {
    color: var(--text-dark);
    font-size: 1.05rem;
    font-weight: 800;
}

.ticket-table-title i {
    color: var(--polban-blue);
}

.ticket-table {
    margin-bottom: 0;
}

.ticket-table thead {
    background: var(--polban-navy) !important;
}

.ticket-table thead th {
    color: #ffffff !important;
    background-color: var(--polban-navy) !important;
    border: 0;
    font-size: .83rem;
    font-weight: 700;
    padding: 14px 12px;
    white-space: nowrap;
}

.ticket-table tbody td {
    padding: 15px 12px;
    vertical-align: middle;
    border-color: #edf0f4;
    font-size: .9rem;
}

.ticket-table tbody tr {
    transition: .2s ease;
}

.ticket-table tbody tr:hover {
    background-color: #f8f9ff;
}

.cell-notiket,
.ticket-number {
    color: var(--polban-blue);
    font-weight: 800;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
}

.cell-notiket:hover,
.ticket-number:hover {
    color: var(--polban-navy);
    text-decoration: underline;
}

.ticket-name {
    font-weight: 700;
    color: #263238;
}

.ticket-category {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 6px;
    background: #f5f7fa;
    border: 1px solid #dee2e6;
    color: #344054;
    font-size: .76rem;
    font-weight: 700;
}

/* Status Badge Tiket Style */
.ticket-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: .76rem;
    font-weight: 700;
    white-space: nowrap;
}

.status-submitted {
    background: #fff3cd;
    color: #856404;
}

.status-verified {
    background: #d1e7dd;
    color: #0f5132;
}

.status-disposisi {
    background: #cff4fc;
    color: #055160;
}

.ticket-date {
    color: #59636e;
    font-size: .82rem;
    line-height: 1.5;
    white-space: nowrap;
}

/* ==========================================================================
   5. ACTION BUTTONS (DESAIN SAMA DENGAN TIKET.PHP)
   ========================================================================== */
.ticket-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
}

.ticket-action {
    width: 34px;
    height: 34px;
    border-radius: 7px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff !important;
    border: 0;
    text-decoration: none !important;
    transition: .2s ease;
    font-size: 0.85rem;
}

.ticket-action:hover {
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,.15);
}

.action-detail { background: #17a2b8; }
.action-verify { background: var(--polban-green); }
.action-disposition { background: var(--polban-orange); }
.action-edit { background: #d97706; }
.action-delete { background: #dc2626; }

/* ==========================================================================
   6. MODAL STYLING
   ========================================================================== */
.modal-content-ultra {
    border-radius: 22px;
    border: none;
    overflow: hidden;
    box-shadow: 0 25px 60px -15px rgba(26, 35, 126, 0.3);
}

.modal-header-ultra {
    background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
    padding: 22px 30px;
    border: none;
}

.modal-icon-badge {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    margin-right: 16px;
    box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.2);
}

.modal-footer-ultra {
    background-color: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 18px 30px;
}

.btn-modal-cancel {
    background-color: #e2e8f0;
    color: #475569;
    font-weight: 700;
    border-radius: 12px;
    padding: 10px 22px;
    border: none;
    transition: all 0.2s ease;
}

.btn-modal-cancel:hover {
    background-color: #cbd5e1;
    color: #1e293b;
}

.btn-modal-submit {
    background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
    color: #ffffff;
    font-weight: 700;
    border-radius: 12px;
    padding: 10px 26px;
    border: none;
    box-shadow: 0 4px 15px rgba(26, 35, 126, 0.3);
    transition: all 0.2s ease;
}

.btn-modal-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(26, 35, 126, 0.4);
}

.offline-form-label {
    display: block;
    margin-bottom: 8px;
    font-size: 0.84rem;
    font-weight: 800;
    color: #334155;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.offline-form-label .required {
    color: #ef4444;
}

.offline-input-group {
    position: relative;
}

.offline-input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    z-index: 5;
    pointer-events: none;
    font-size: 1rem;
}

.offline-input,
.offline-select,
.offline-textarea {
    width: 100%;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #334155;
    border-radius: 12px;
    transition: all 0.25s ease;
    font-size: 0.92rem;
}

.offline-input {
    height: 50px;
    padding: 10px 16px 10px 46px !important;
}

.offline-select {
    height: 50px;
    padding: 10px 42px 10px 46px !important;
}

.offline-textarea {
    min-height: 130px;
    resize: vertical;
    padding: 14px 16px !important;
    line-height: 1.6;
}

.offline-input::placeholder,
.offline-textarea::placeholder {
    color: #94a3b8;
}

.offline-input:focus,
.offline-select:focus,
.offline-textarea:focus {
    border-color: #283593;
    box-shadow: 0 0 0 4px rgba(40, 53, 147, 0.15);
    outline: none;
    background-color: #fff;
}

.offline-info-box {
    background: linear-gradient(135deg, #eef4ff 0%, #e5edff 100%);
    border-left: 5px solid #1a237e;
    border-radius: 12px;
    padding: 15px 18px;
    color: #1a237e;
    font-size: 0.9rem;
    margin-bottom: 24px;
    font-weight: 500;
    box-shadow: 0 2px 8px rgba(26, 35, 126, 0.05);
}

.offline-file-box {
    border: 2px dashed #cbd5e1;
    background: #f8fafc;
    border-radius: 12px;
    padding: 14px 16px;
    transition: all 0.2s ease;
}

.offline-file-box:hover {
    border-color: #283593;
    background: #f1f5f9;
}

.offline-file-box input[type="file"] {
    width: 100%;
    font-size: 0.88rem;
    color: #475569;
}

.offline-modal-body {
    padding: 28px 32px !important;
}

.offline-modal-footer {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 18px 32px;
}

.offline-btn-save {
    background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%);
    color: #ffffff;
    border: none;
    border-radius: 12px;
    padding: 11px 26px;
    font-weight: 700;
    box-shadow: 0 6px 18px rgba(245, 124, 0, 0.3);
    transition: all 0.25s ease;
}

.offline-btn-save:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(245, 124, 0, 0.4);
}

.offline-btn-cancel {
    background: #ffffff;
    color: #475569;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    padding: 11px 26px;
    font-weight: 700;
    transition: all 0.2s ease;
}

.offline-btn-cancel:hover {
    background: #f1f5f9;
    color: #1e293b;
}

/* ==========================================================================
   7. FLOATING TOAST NOTIFICATION
   ========================================================================== */
#toastContainer {
    position: fixed;
    top: 25px;
    right: 25px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    pointer-events: none;
}

.custom-toast {
    background: #ffffff;
    color: #1e293b;
    padding: 16px 20px;
    border-radius: 14px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15), 0 5px 15px rgba(0, 0, 0, 0.08);
    display: flex;
    align-items: center;
    gap: 14px;
    min-width: 320px;
    max-width: 420px;
    pointer-events: auto;
    transform: translateX(120%);
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    border-left: 5px solid #283593;
}

.custom-toast.show {
    transform: translateX(0);
    opacity: 1;
}

.custom-toast.success {
    border-left-color: #10b981;
}

.custom-toast.success .toast-icon-wrapper {
    background: #d1fae5;
    color: #059669;
}

.custom-toast.danger {
    border-left-color: #dc2626;
}

.custom-toast.danger .toast-icon-wrapper {
    background: #fef2f2;
    color: #dc2626;
}

.custom-toast.info {
    border-left-color: #2563eb;
}

.custom-toast.info .toast-icon-wrapper {
    background: #eff6ff;
    color: #2563eb;
}

.custom-toast.warning {
    border-left-color: #ff8c00;
}

.custom-toast.warning .toast-icon-wrapper {
    background: #fffbeb;
    color: #f57c00;
}

.toast-icon-wrapper {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.toast-content-area {
    flex-grow: 1;
}

.toast-title {
    font-weight: 800;
    font-size: 0.9rem;
    margin-bottom: 2px;
    color: #0f172a;
}

.toast-message {
    font-size: 0.82rem;
    color: #64748b;
    margin: 0;
    line-height: 1.4;
}

/* ==========================================================================
   ANIMATIONS & RESPONSIVE
   ========================================================================== */
@keyframes pageFadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.reveal-item {
    opacity: 0;
    transform: translateY(12px);
}

.reveal-item.show {
    opacity: 1;
    transform: translateY(0);
    transition: all .4s ease;
}

@media (max-width: 767px) {
    .offline-modal-body {
        padding: 20px !important;
    }

    .offline-modal-footer {
        padding: 15px 20px;
    }

    #toastContainer {
        top: 15px;
        right: 15px;
        left: 15px;
    }

    .custom-toast {
        min-width: auto;
        max-width: 100%;
    }
}
</style>

<div id="toastContainer"></div>

<div class="container-fluid px-4 py-4 ticket-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="color: var(--polban-navy); letter-spacing: -0.4px; font-size:1.75rem;">Laporan Tamu & Tiket</h1>
            <p class="text-muted small mb-0" style="font-size: 0.95rem;">Kelola dan pantau seluruh data riwayat kunjungan tamu serta status tiket layanan dengan sistem terintegrasi.</p>
        </div>
    </div>

    <!-- STATISTIC CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Total Tamu</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="8">8</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Submitted</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="1">1</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-paper-plane"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Assigned / Diproses</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="5">5</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-spinner"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Verified / Selesai</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="2">2</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- TOOLBAR / FILTER CARD (STYLE DARI TIKET.PHP) -->
    <div class="card ticket-filter-card mb-4 reveal-item">
        <div class="card-body">
            <div class="row g-2 align-items-center justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="input-group ticket-input-group flex-grow-1" style="min-width: 240px; max-width: 360px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" id="quickSearchInput" class="form-control ticket-input" placeholder="Cari nomor tiket / nama..." style="font-size: 0.88rem;">
                        </div>
                        <button class="btn btn-ticket-filter px-3 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCariTiket">
                            <i class="fas fa-filter"></i> Filter & Cari
                        </button>
                        <button id="btnKembaliTabel" class="btn btn-ticket-reset d-none" title="Kembali / Reset Filter">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-center justify-content-md-end gap-2 flex-wrap mt-2 mt-lg-0">
                    <div class="text-muted fw-semibold me-2" style="font-size: 0.85rem;">
                        Total Data: <span id="totalDataBadge" class="badge bg-primary text-white fs-6 ms-1 px-2 py-1" style="border-radius: 8px;">8 Tiket</span>
                    </div>

                    <!-- TOMBOL EXPORT LAPORAN -->
                    <div class="dropdown">
                        <button class="btn btn-export-laporan d-flex align-items-center gap-2 shadow-sm dropdown-toggle" type="button" id="dropdownExportLaporan" data-bs-toggle="dropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            <span>Export Laporan</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end export-dropdown-menu" aria-labelledby="dropdownExportLaporan">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-file-excel text-success"></i> Export Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-file-pdf text-danger"></i> Export PDF
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-file-csv text-primary"></i> Export CSV
                                </a>
                            </li>
                        </ul>
                    </div>

                    <button class="btn btn-ticket-filter px-3 d-flex align-items-center gap-2 shadow-sm" data-toggle="modal" data-target="#modalTambahTamu" data-bs-toggle="modal" data-bs-target="#modalTambahTamu" style="background: var(--polban-orange);">
                        <i class="fas fa-plus"></i> Tambah Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL ULTRACLEAN (PERSISI STYLING TIKET.PHP) -->
    <div class="card ticket-table-card reveal-item">
        <div class="ticket-table-header d-flex justify-content-between align-items-center">
            <div>
                <div class="ticket-table-title">
                    <i class="fas fa-list-alt me-2"></i> Data Laporan Tamu & Tiket Kunjungan
                </div>
                <small class="text-muted">Kelola riwayat kunjungan dan status permohonan layanan</small>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table ticket-table align-middle" id="tabelLaporanTamu">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th>Nomor Tiket <small class="text-white-50 fw-normal" style="font-size: 0.7rem;">(Klik salin)</small></th>
                            <th>Nama Pemohon</th>
                            <th>Layanan</th>
                            <th class="text-center">Status</th>
                            <th>Tanggal Masuk</th>
                            <th class="text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tamuTableBody">
                        <?php
                        $dummy = [
                            ['ULT-20260806074739865', 'Asep', 'Bagian Keuangan', 'Verified', '06-08-2026 07:47', 'asep@gmail.com', '081234567890', 'Universitas Padjadjaran', 'Pengajuan rekapitulasi pembayaran UKT.'],
                            ['ULT-20260805023213577', 'Apin', 'Bagian Kemahasiswaan', 'Verified', '05-08-2026 02:32', 'apin@polban.ac.id', '082198765432', 'Politeknik Negeri Bandung', 'Penyerahan berkas Beasiswa KIP-K.'],
                            ['ULT-20260730081403481', 'Apin', 'Bagian Kemahasiswaan', 'Assigned', '30-07-2026 08:14', 'apin@polban.ac.id', '082198765432', 'Politeknik Negeri Bandung', 'Legalisir sertifikat kemahasiswaan.'],
                            ['ULT-20260730080403262', 'Ikbal', 'Bagian Kemahasiswaan', 'Assigned', '30-07-2026 08:04', 'ikbal@gmail.com', '085712345678', 'Universitas Indonesia', 'Izin kegiatan Ormawa.'],
                            ['ULT-20260730002942605', 'Rizki AM', 'Bagian Keuangan', 'Assigned', '30-07-2026 00:29', 'rizki@gmail.com', '081311223344', 'Telkom University', 'Kendala pencairan dana beasiswa.'],
                            ['ULT-20260730002841489', 'Adit', 'Bagian Akademik', 'Assigned', '30-07-2026 00:28', 'adit@gmail.com', '089655443322', 'ITB', 'Prosedur perbaikan nilai KRS.'],
                            ['ULT-20260729065029720', 'Zein Gtg', 'Bagian Akademik', 'Assigned', '29-07-2026 06:50', 'zein@gmail.com', '081299887766', 'Universitas Pasundan', 'Cetak Surat Aktif Kuliah.'],
                            ['ULT-20260728093734525', 'Zein', 'Bagian Akademik', 'Submitted', '28-07-2026 09:37', 'zein@gmail.com', '081299887766', 'Universitas Pasundan', 'Permohonan ulang Surat Aktif Kuliah.']
                        ];
                        foreach ($dummy as $i => $d):
                        ?>
                            <tr class="tamu-row"
                                data-notiket="<?= esc($d[0]) ?>"
                                data-nama="<?= esc($d[1]) ?>"
                                data-layanan="<?= esc($d[2]) ?>"
                                data-status="<?= esc($d[3]) ?>"
                                data-email="<?= esc($d[5]) ?>"
                                data-hp="<?= esc($d[6]) ?>"
                                data-instansi="<?= esc($d[7]) ?>"
                                data-tanggal="<?= esc($d[4]) ?>"
                                data-deskripsi="<?= esc($d[8]) ?>">
                                <td class="text-center fw-bold text-muted row-number"><?= $i + 1 ?></td>
                                <td>
                                    <span class="cell-notiket ticket-number" title="Klik untuk menyalin nomor tiket" onclick="copyNoTiket(this, '<?= $d[0] ?>')">
                                        <?= $d[0] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="ticket-name cell-nama"><?= $d[1] ?></div>
                                </td>
                                <td>
                                    <span class="ticket-category cell-layanan"><?= $d[2] ?></span>
                                </td>
                                <td class="text-center">
                                    <?php
                                        $stClass = 'status-submitted';
                                        if ($d[3] == 'Verified') $stClass = 'status-verified';
                                        if ($d[3] == 'Assigned') $stClass = 'status-disposisi';
                                    ?>
                                    <span class="ticket-status cell-status <?= $stClass ?>">
                                        <i class="fas fa-circle" style="font-size:0.45rem;"></i> <?= $d[3] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="ticket-date cell-tanggal"><?= $d[4] ?></div>
                                </td>
                                <td class="text-center">
                                    <div class="ticket-actions">
                                        <button type="button" class="ticket-action action-detail btn-detail-tamu" title="Detail Tiket" data-bs-toggle="modal" data-bs-target="#modalDetailTamu" data-toggle="modal" data-target="#modalDetailTamu" data-notiket="<?= esc($d[0]) ?>" data-nama="<?= esc($d[1]) ?>" data-layanan="<?= esc($d[2]) ?>" data-status="<?= esc($d[3]) ?>" data-email="<?= esc($d[5]) ?>" data-hp="<?= esc($d[6]) ?>" data-instansi="<?= esc($d[7]) ?>" data-tanggal="<?= esc($d[4]) ?>" data-deskripsi="<?= esc($d[8]) ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="ticket-action action-verify btn-verifikasi-tamu" title="Verifikasi Tiket" data-bs-toggle="modal" data-bs-target="#modalVerifikasiTamu" data-toggle="modal" data-target="#modalVerifikasiTamu" data-notiket="<?= esc($d[0]) ?>" data-status="<?= esc($d[3]) ?>">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                        <button type="button" class="ticket-action action-disposition btn-disposisi-tamu" title="Disposisi Tiket" data-bs-toggle="modal" data-bs-target="#modalDisposisiTamu" data-toggle="modal" data-target="#modalDisposisiTamu" data-notiket="<?= esc($d[0]) ?>">
                                            <i class="fas fa-share"></i>
                                        </button>
                                        <button type="button" class="ticket-action action-edit btn-edit-tamu" title="Edit Tiket" data-bs-toggle="modal" data-bs-target="#modalEditTiket" data-toggle="modal" data-target="#modalEditTiket" data-notiket="<?= esc($d[0]) ?>" data-nama="<?= esc($d[1]) ?>" data-layanan="<?= esc($d[2]) ?>" data-email="<?= esc($d[5]) ?>" data-hp="<?= esc($d[6]) ?>" data-instansi="<?= esc($d[7]) ?>" data-deskripsi="<?= esc($d[8]) ?>">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="ticket-action action-delete btn-delete-tamu" title="Hapus Tiket" data-bs-toggle="modal" data-bs-target="#modalDeleteTiket" data-toggle="modal" data-target="#modalDeleteTiket" data-notiket="<?= esc($d[0]) ?>" data-nama="<?= esc($d[1]) ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div id="tabelEmptyState" class="text-center py-5 d-none">
                <div class="mb-3 text-muted" style="font-size: 3rem;"><i class="fas fa-folder-open"></i></div>
                <h5 class="fw-bold text-dark">Data Tidak Ditemukan</h5>
                <p class="text-muted small">Tidak ada data laporan tamu yang cocok dengan kriteria pencarian atau filter Anda.</p>
            </div>
        </div>
    </div>

</div>

<!-- MODAL TAMBAH LAPORAN TAMU -->
<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Tambah Laporan Tamu (Walk-In)</h5>
                        <small class="text-white-50">Catat kunjungan tamu langsung di Unit Layanan Terpadu</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formTambahTamu" action="<?= base_url('laporantamu/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body offline-modal-body">
                    
                    <div class="offline-info-box">
                        <i class="fas fa-info-circle me-2"></i> Silakan pilih jenis pemohon terlebih dahulu untuk menampilkan form isian yang sesuai.
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="offline-form-label">Jenis Pemohon <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-user-tag offline-input-icon"></i>
                                <select id="addJenisPemohon" name="jenis_pemohon" class="offline-select" required>
                                    <option value="" selected disabled>-- Pilih Jenis Pemohon --</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                    <option value="Orang Tua">Orang Tua</option>
                                    <option value="Alumni">Alumni</option>
                                    <option value="Mitra">Mitra</option>
                                    <option value="Publik">Publik</option>
                                    <option value="Masyarakat">Masyarakat</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div id="dynamicFormContainer" class="row g-3">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="offline-form-label">
                                Keterangan / Deskripsi Keperluan <span class="required">*</span>
                            </label>
                            <textarea id="addDeskripsi" name="deskripsi" class="offline-textarea modal-input-field" placeholder="Tuliskan detail permohonan atau keperluan tamu di sini..." maxlength="500" required style="padding-left: 16px !important;"></textarea>
                            <div class="d-flex justify-content-end mt-1">
                                <small id="charCount" class="text-muted fw-semibold" style="font-size: 0.75rem;">0 / 500 Karakter</small>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="offline-form-label">
                                Lampiran Pendukung <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <div class="offline-file-box">
                                <input type="file" id="addLampiran" name="lampiran" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="mt-1">
                                    <small id="fileInfo" class="text-muted" style="font-size: 0.78rem;">Maksimal ukuran file 5MB. Format: PDF, JPG, JPEG, PNG.</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer offline-modal-footer">
                    <button type="button" class="btn offline-btn-cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" id="submitTambahTamuBtn" class="btn offline-btn-save">
                        <i class="fas fa-save me-1"></i> Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DETAIL TAMU -->
<div class="modal fade" id="modalDetailTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-ticket-alt text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Detail Informasi Tiket</h5>
                        <small class="text-white-50">Informasi lengkap riwayat dan status permohonan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Nomor Tiket</span>
                            <h6 id="dispNoTiket" class="fw-bold text-primary mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Status Tiket</span>
                            <div class="mt-1"><span id="dispStatus" class="ticket-status status-verified">-</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Nama Pemohon</span>
                            <h6 id="dispNama" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Layanan Tujuan</span>
                            <h6 id="dispLayanan" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Email Pemohon</span>
                            <h6 id="dispEmail" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Nomor HP / WhatsApp</span>
                            <h6 id="dispHp" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Instansi / Unit Asal</span>
                            <h6 id="dispInstansi" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Tanggal Masuk</span>
                            <h6 id="dispTanggal" class="fw-bold text-dark mt-1 mb-0">-</h6>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3 border">
                            <span class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Deskripsi / Keperluan</span>
                            <p id="dispDeskripsi" class="text-dark mt-1 mb-0" style="font-size: 0.9rem; line-height: 1.5;">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-ultra">
                <button type="button" class="btn btn-modal-cancel w-100" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VERIFIKASI TAMU -->
<div class="modal fade" id="modalVerifikasiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-user-check text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Verifikasi Tiket Tamu</h5>
                        <small class="text-white-50">Perbarui status verifikasi data tamu</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formVerifikasiTamu">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="offline-form-label">Nomor Tiket</label>
                        <input type="text" id="verifNoTiket" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 16px !important;">
                    </div>
                    <div class="mb-3">
                        <label class="offline-form-label">Status Verifikasi <span class="required">*</span></label>
                        <select class="offline-select" id="verifStatusSelect" required style="padding-left: 16px !important;">
                            <option value="Submitted">Submitted (Diajukan)</option>
                            <option value="Assigned">Assigned (Diproses)</option>
                            <option value="Verified">Verified (Selesai/Valid)</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="offline-form-label">Catatan Verifikasi</label>
                        <textarea class="offline-textarea" placeholder="Tambahkan catatan verifikasi jika diperlukan..." style="padding-left: 16px !important; min-height: 90px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DISPOSISI TAMU -->
<div class="modal fade" id="modalDisposisiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-share text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Disposisi Tiket</h5>
                        <small class="text-white-50">Teruskan tiket ke unit atau bagian terkait</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDisposisiTamu">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="offline-form-label">Nomor Tiket</label>
                        <input type="text" id="dispNoTiketField" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 16px !important;">
                    </div>
                    <div class="mb-3">
                        <label class="offline-form-label">Unit / Bagian Tujuan Disposisi <span class="required">*</span></label>
                        <select class="offline-select" required style="padding-left: 16px !important;">
                            <option value="" selected disabled>-- Pilih Unit Tujuan --</option>
                            <option value="Unit Layanan Terpadu">Unit Layanan Terpadu</option>
                            <option value="Bagian Akademik">Bagian Akademik</option>
                            <option value="Bagian Keuangan">Bagian Keuangan</option>
                            <option value="Bagian Kemahasiswaan">Bagian Kemahasiswaan</option>
                            <option value="Perpustakaan">Perpustakaan</option>
                            <option value="Jurusan">Jurusan</option>
                            <option value="UPT Teknologi Informasi dan Komunikasi">UPT Teknologi Informasi dan Komunikasi</option>
                            <option value="Bagian Administrasi Umum">Bagian Administrasi Umum</option>
                            <option value="Administrasi Umum">Administrasi Umum</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="offline-form-label">Catatan Disposisi</label>
                        <textarea class="offline-textarea" placeholder="Tambahkan instruksi atau catatan disposisi..." style="padding-left: 16px !important; min-height: 90px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">Kirim Disposisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT TIKET -->
<div class="modal fade" id="modalEditTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-pen text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Edit Data Tiket Tamu</h5>
                        <small class="text-white-50">Perbarui informasi laporan kunjungan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditTiket">
                <div class="modal-body offline-modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="offline-form-label">Nomor Tiket</label>
                            <input type="text" id="editNoTiket" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Nama Pemohon <span class="required">*</span></label>
                            <input type="text" id="editNama" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Email <span class="required">*</span></label>
                            <input type="email" id="editEmail" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                            <input type="text" id="editHp" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Instansi / Unit <span class="required">*</span></label>
                            <input type="text" id="editInstansi" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                            <select id="editLayanan" class="offline-select" required style="padding-left: 16px !important;">
                                <option value="Unit Layanan Terpadu">Unit Layanan Terpadu</option>
                                <option value="Bagian Akademik">Bagian Akademik</option>
                                <option value="Bagian Keuangan">Bagian Keuangan</option>
                                <option value="Bagian Kemahasiswaan">Bagian Kemahasiswaan</option>
                                <option value="Perpustakaan">Perpustakaan</option>
                                <option value="Jurusan">Jurusan</option>
                                <option value="UPT Teknologi Informasi dan Komunikasi">UPT Teknologi Informasi dan Komunikasi</option>
                                <option value="Bagian Administrasi Umum">Bagian Administrasi Umum</option>
                                <option value="Administrasi Umum">Administrasi Umum</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="offline-form-label">Deskripsi Keperluan <span class="required">*</span></label>
                            <textarea id="editDeskripsi" class="offline-textarea" required style="padding-left: 16px !important; min-height: 100px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DELETE TIKET -->
<div class="modal fade" id="modalDeleteTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header bg-danger text-white py-3 px-4">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge bg-white bg-opacity-25 text-white me-3">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Konfirmasi Hapus Tiket</h5>
                        <small class="text-white-50">Tindakan ini tidak dapat dibatalkan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="text-muted mb-2">Apakah Anda yakin ingin menghapus data laporan tamu berikut?</p>
                <h5 id="deleteNoTiketSpan" class="fw-bold text-dark mb-1">-</h5>
                <p class="fw-semibold text-primary mb-0" id="deleteNamaSpan">-</p>
            </div>
            <div class="modal-footer modal-footer-ultra justify-content-center">
                <button type="button" class="btn btn-modal-cancel px-4" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger px-4 fw-bold rounded-3 shadow-sm" id="confirmDeleteBtn" data-bs-dismiss="modal" style="padding: 10px 22px;">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CARI / FILTER TIKET -->
<div class="modal fade" id="modalCariTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-filter text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Filter & Cari Data Tamu</h5>
                        <small class="text-white-50">Saring tabel berdasarkan status dan layanan</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="offline-form-label">Filter Status Tiket</label>
                    <select id="filterStatusModal" class="offline-select" style="padding-left: 16px !important;">
                        <option value="">Semua Status</option>
                        <option value="Submitted">Submitted</option>
                        <option value="Assigned">Assigned</option>
                        <option value="Verified">Verified</option>
                    </select>
                </div>
                <div class="mb-0">
                    <label class="offline-form-label">Filter Layanan</label>
                    <select id="filterLayananModal" class="offline-select" style="padding-left: 16px !important;">
                        <option value="">Semua Layanan</option>
                        <option value="Unit Layanan Terpadu">Unit Layanan Terpadu</option>
                        <option value="Bagian Akademik">Bagian Akademik</option>
                        <option value="Bagian Keuangan">Bagian Keuangan</option>
                        <option value="Bagian Kemahasiswaan">Bagian Kemahasiswaan</option>
                        <option value="Perpustakaan">Perpustakaan</option>
                        <option value="Jurusan">Jurusan</option>
                        <option value="UPT Teknologi Informasi dan Komunikasi">UPT Teknologi Informasi dan Komunikasi</option>
                        <option value="Bagian Administrasi Umum">Bagian Administrasi Umum</option>
                        <option value="Administrasi Umum">Administrasi Umum</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer modal-footer-ultra">
                <button type="button" class="btn btn-modal-cancel" id="resetFilterBtn">Reset</button>
                <button type="button" class="btn btn-modal-submit" data-bs-dismiss="modal">Terapkan Filter</button>
            </div>
        </div>
    </div>
</div>

<script>
    // ==========================================================================
    // UTILITY: FLOATING TOAST NOTIFICATION SYSTEM
    // ==========================================================================
    function showToast(title, message, type = 'success') {
        const container = document.getElementById('toastContainer');
        if (!container) return;

        const toastId = 'toast_' + Date.now();
        let iconClass = 'fas fa-check-circle';
        if (type === 'danger') iconClass = 'fas fa-exclamation-circle';
        if (type === 'warning') iconClass = 'fas fa-exclamation-triangle';
        if (type === 'info') iconClass = 'fas fa-info-circle';

        const toastHTML = `
            <div id="${toastId}" class="custom-toast ${type}">
                <div class="toast-icon-wrapper">
                    <i class="${iconClass}"></i>
                </div>
                <div class="toast-content-area">
                    <h5 class="toast-title">${title}</h5>
                    <p class="toast-message">${message}</p>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', toastHTML);
        const toastElement = document.getElementById(toastId);

        setTimeout(() => {
            toastElement.classList.add('show');
        }, 50);

        setTimeout(() => {
            toastElement.classList.remove('show');
            setTimeout(() => {
                toastElement.remove();
            }, 400);
        }, 3800);
    }

    // ==========================================================================
    // COPY NOMOR TIKET KE CLIPBOARD
    // ==========================================================================
    function copyNoTiket(element, noTiket) {
        navigator.clipboard.writeText(noTiket).then(() => {
            showToast('Nomor Tiket Disalin!', `Nomor ${noTiket} berhasil disalin ke clipboard. Silakan paste di kolom pencarian filter.`, 'success');
        }).catch(err => {
            showToast('Gagal Menyalin', 'Terjadi kesalahan saat menyalin nomor tiket.', 'danger');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // REVEAL ANIMATIONS IDENTIK DENGAN DATA TIKET
        setTimeout(() => {
            document.querySelectorAll('.reveal-item').forEach(item => {
                item.classList.add('show');
            });
        }, 100);

        // ======================================================================
        // MODAL COMPATIBILITY HELPER
        // ======================================================================
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target');
                if (!target) return;

                if (window.bootstrap && bootstrap.Modal) {
                    const modalEl = document.querySelector(target);
                    if (modalEl) {
                        bootstrap.Modal.getOrCreateInstance(modalEl).show();
                    }
                } else if (window.jQuery && typeof window.jQuery.fn.modal === 'function') {
                    window.jQuery(target).modal('show');
                }
            });
        });

        // ======================================================================
        // DYNAMIC FORM BUILDER UNTUK TAMBAH LAPORAN TAMU
        // ======================================================================
        const jenisPemohonSelect = document.getElementById('addJenisPemohon');
        const dynamicContainer = document.getElementById('dynamicFormContainer');

        if (jenisPemohonSelect && dynamicContainer) {
            jenisPemohonSelect.addEventListener('change', function() {
                const val = this.value;
                let htmlContent = '';

                if (val === 'Mahasiswa') {
                    htmlContent = `
                        <div class="col-md-6">
                            <label class="offline-form-label">NIM <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-id-card offline-input-icon"></i>
                                <input type="text" name="nim" class="offline-input" placeholder="Masukkan NIM Mahasiswa" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Nama Lengkap <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-user offline-input-icon"></i>
                                <input type="text" name="nama" class="offline-input" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Program Studi / Jurusan <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-graduation-cap offline-input-icon"></i>
                                <input type="text" name="prodi" class="offline-input" placeholder="Contoh: D4 Teknik Informatika" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Kelas / Angkatan <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-users offline-input-icon"></i>
                                <input type="text" name="kelas" class="offline-input" placeholder="Contoh: 3A / 2023" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">No. WhatsApp / HP <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-phone offline-input-icon"></i>
                                <input type="text" name="hp" class="offline-input" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Email <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-envelope offline-input-icon"></i>
                                <input type="email" name="email" class="offline-input" placeholder="email@student.polban.ac.id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-concierge-bell offline-input-icon"></i>
                                <select name="layanan" class="offline-select" required>
                                    <option value="" selected disabled>-- Pilih Layanan --</option>
                                    <option value="Unit Layanan Terpadu">Unit Layanan Terpadu</option>
                                    <option value="Bagian Akademik">Bagian Akademik</option>
                                    <option value="Bagian Keuangan">Bagian Keuangan</option>
                                    <option value="Bagian Kemahasiswaan">Bagian Kemahasiswaan</option>
                                    <option value="Perpustakaan">Perpustakaan</option>
                                    <option value="Jurusan">Jurusan</option>
                                    <option value="UPT Teknologi Informasi dan Komunikasi">UPT Teknologi Informasi dan Komunikasi</option>
                                    <option value="Bagian Administrasi Umum">Bagian Administrasi Umum</option>
                                    <option value="Administrasi Umum">Administrasi Umum</option>
                                </select>
                            </div>
                        </div>
                    `;
                } else if (val) {
                    htmlContent = `
                        <div class="col-md-6">
                            <label class="offline-form-label">Nama Lengkap <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-user offline-input-icon"></i>
                                <input type="text" name="nama" class="offline-input" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Instansi / Unit Asal <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-building offline-input-icon"></i>
                                <input type="text" name="instansi" class="offline-input" placeholder="Masukkan Instansi / Perusahaan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">No. WhatsApp / HP <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-phone offline-input-icon"></i>
                                <input type="text" name="hp" class="offline-input" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Email <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-envelope offline-input-icon"></i>
                                <input type="email" name="email" class="offline-input" placeholder="email@domain.com" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-concierge-bell offline-input-icon"></i>
                                <select name="layanan" class="offline-select" required>
                                    <option value="" selected disabled>-- Pilih Layanan --</option>
                                    <option value="Unit Layanan Terpadu">Unit Layanan Terpadu</option>
                                    <option value="Bagian Akademik">Bagian Akademik</option>
                                    <option value="Bagian Keuangan">Bagian Keuangan</option>
                                    <option value="Bagian Kemahasiswaan">Bagian Kemahasiswaan</option>
                                    <option value="Perpustakaan">Perpustakaan</option>
                                    <option value="Jurusan">Jurusan</option>
                                    <option value="UPT Teknologi Informasi dan Komunikasi">UPT Teknologi Informasi dan Komunikasi</option>
                                    <option value="Bagian Administrasi Umum">Bagian Administrasi Umum</option>
                                    <option value="Administrasi Umum">Administrasi Umum</option>
                                </select>
                            </div>
                        </div>
                    `;
                }
                dynamicContainer.innerHTML = htmlContent;
            });
        }

        // ======================================================================
        // FALLBACK CLOSE UNTUK X / BATAL / TUTUP MODAL
        // ======================================================================
        document.querySelectorAll('.modal [data-bs-dismiss="modal"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const modalEl = this.closest('.modal');
                if (!modalEl) return;

                if (window.bootstrap && bootstrap.Modal) {
                    bootstrap.Modal.getOrCreateInstance(modalEl).hide();
                } else if (window.jQuery && typeof window.jQuery.fn.modal === 'function') {
                    window.jQuery(modalEl).modal('hide');
                }
            });
        });

        // RESET MODAL TAMBAH LAPORAN KETIKA DITUTUP
        const modalTambahTamuEl = document.getElementById('modalTambahTamu');
        const formTambahTamuEl = document.getElementById('formTambahTamu');

        if (modalTambahTamuEl && formTambahTamuEl) {
            modalTambahTamuEl.addEventListener('hidden.bs.modal', function () {
                formTambahTamuEl.reset();
                if (dynamicContainer) {
                    dynamicContainer.innerHTML = '';
                }
            });
        }

        // KARAKTER COUNTER UNTUK DESKRIPSI
        const descTextarea = document.getElementById('addDeskripsi');
        const charCount = document.getElementById('charCount');
        if (descTextarea && charCount) {
            descTextarea.addEventListener('input', function() {
                const len = this.value.length;
                charCount.innerText = `${len} / 500 Karakter`;
            });
        }

        // ======================================================================
        // POPULATE DATA KE MODAL DETAIL, VERIFIKASI, DISPOSISI, EDIT & DELETE
        // ======================================================================
        document.querySelectorAll('.btn-detail-tamu').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('dispNoTiket').innerText = this.getAttribute('data-notiket');
                document.getElementById('dispNama').innerText = this.getAttribute('data-nama');
                document.getElementById('dispLayanan').innerText = this.getAttribute('data-layanan');
                document.getElementById('dispEmail').innerText = this.getAttribute('data-email');
                document.getElementById('dispHp').innerText = this.getAttribute('data-hp');
                document.getElementById('dispInstansi').innerText = this.getAttribute('data-instansi');
                document.getElementById('dispTanggal').innerText = this.getAttribute('data-tanggal');
                document.getElementById('dispDeskripsi').innerText = this.getAttribute('data-deskripsi');

                const statusVal = this.getAttribute('data-status');
                const badgeEl = document.getElementById('dispStatus');
                badgeEl.innerText = statusVal;
                badgeEl.className = 'ticket-status ' + (statusVal === 'Verified' ? 'status-verified' : (statusVal === 'Assigned' ? 'status-disposisi' : 'status-submitted'));
            });
        });

        document.querySelectorAll('.btn-verifikasi-tamu').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('verifNoTiket').value = this.getAttribute('data-notiket');
                document.getElementById('verifStatusSelect').value = this.getAttribute('data-status');
            });
        });

        document.querySelectorAll('.btn-disposisi-tamu').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('dispNoTiketField').value = this.getAttribute('data-notiket');
            });
        });

        document.querySelectorAll('.btn-edit-tamu').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('editNoTiket').value = this.getAttribute('data-notiket');
                document.getElementById('editNama').value = this.getAttribute('data-nama');
                document.getElementById('editEmail').value = this.getAttribute('data-email');
                document.getElementById('editHp').value = this.getAttribute('data-hp');
                document.getElementById('editInstansi').value = this.getAttribute('data-instansi');
                document.getElementById('editLayanan').value = this.getAttribute('data-layanan');
                document.getElementById('editDeskripsi').value = this.getAttribute('data-deskripsi');
            });
        });

        document.querySelectorAll('.btn-delete-tamu').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('deleteNoTiketSpan').innerText = this.getAttribute('data-notiket');
                document.getElementById('deleteNamaSpan').innerText = this.getAttribute('data-nama');
            });
        });

        // FORM SUBMIT HANDLERS
        document.getElementById('formTambahTamu')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const modalEl = document.getElementById('modalTambahTamu');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
            showToast('Laporan Berhasil Disimpan!', 'Data laporan tamu (walk-in) baru berhasil ditambahkan ke sistem.', 'success');
            this.reset();
            if (dynamicContainer) dynamicContainer.innerHTML = '';
        });

        document.getElementById('formVerifikasiTamu')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const modalEl = document.getElementById('modalVerifikasiTamu');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
            showToast('Verifikasi Diperbarui!', 'Status verifikasi tiket tamu berhasil diperbarui.', 'success');
        });

        document.getElementById('formDisposisiTamu')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const modalEl = document.getElementById('modalDisposisiTamu');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
            showToast('Disposisi Terkirim!', 'Tiket berhasil didisposisikan ke unit tujuan terkait.', 'success');
        });

        document.getElementById('formEditTiket')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const modalEl = document.getElementById('modalEditTiket');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();
            showToast('Perubahan Disimpan!', 'Data tiket tamu berhasil diperbarui.', 'success');
        });

        document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
            showToast('Tiket Dihapus', 'Data laporan tamu berhasil dihapus dari sistem.', 'danger');
        });

        // ======================================================================
        // LIVE SEARCH & FILTER TABLE SYSTEM
        // ======================================================================
        const searchInput = document.getElementById('quickSearchInput');
        const filterStatusModal = document.getElementById('filterStatusModal');
        const filterLayananModal = document.getElementById('filterLayananModal');
        const btnKembaliTabel = document.getElementById('btnKembaliTabel');
        const resetFilterBtn = document.getElementById('resetFilterBtn');
        const rows = document.querySelectorAll('.tamu-row');
        const emptyState = document.getElementById('tabelEmptyState');
        const totalDataBadge = document.getElementById('totalDataBadge');

        function filterTable() {
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const statusVal = filterStatusModal ? filterStatusModal.value : '';
            const layananVal = filterLayananModal ? filterLayananModal.value : '';

            let visibleCount = 0;

            rows.forEach(row => {
                const notiket = row.getAttribute('data-notiket').toLowerCase();
                const nama = row.getAttribute('data-nama').toLowerCase();
                const layanan = row.getAttribute('data-layanan');
                const status = row.getAttribute('data-status');

                const matchSearch = (notiket.includes(query) || nama.includes(query));
                const matchStatus = (statusVal === '' || status === statusVal);
                const matchLayanan = (layananVal === '' || layanan === layananVal);

                if (matchSearch && matchStatus && matchLayanan) {
                    row.style.display = '';
                    visibleCount++;
                    const numCell = row.querySelector('.row-number');
                    if (numCell) numCell.innerText = visibleCount;
                } else {
                    row.style.display = 'none';
                }
            });

            if (totalDataBadge) {
                totalDataBadge.innerText = `${visibleCount} Tiket`;
            }

            if (emptyState) {
                if (visibleCount === 0) {
                    emptyState.classList.remove('d-none');
                } else {
                    emptyState.classList.add('d-none');
                }
            }
        }

        if (searchInput) searchInput.addEventListener('input', filterTable);
        if (filterStatusModal) filterStatusModal.addEventListener('change', filterTable);
        if (filterLayananModal) filterLayananModal.addEventListener('change', filterTable);

        if (btnKembaliTabel) {
            btnKembaliTabel.addEventListener('click', function() {
                if (searchInput) searchInput.value = '';
                if (filterStatusModal) filterStatusModal.value = '';
                if (filterLayananModal) filterLayananModal.value = '';
                filterTable();
                showToast('Kembali ke Halaman Utama', 'Menampilkan seluruh data laporan tamu awal.', 'info');
            });
        }

        if (resetFilterBtn) {
            resetFilterBtn.addEventListener('click', function() {
                if (filterStatusModal) filterStatusModal.value = '';
                if (filterLayananModal) filterLayananModal.value = '';
                if (searchInput) searchInput.value = '';
                filterTable();
                showToast('Filter Direset', 'Semua kriteria filter telah dikosongkan.', 'info');
            });
        }
    });

    $(document).on('click', '[data-toggle="modal"]', function() {
        let targetModal = $(this).attr('data-target');
        $(targetModal).modal('show');
    });
</script>

<?= $this->endSection() ?>