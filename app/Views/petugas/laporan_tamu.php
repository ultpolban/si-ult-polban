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

body, .container-fluid {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    color: var(--text-dark);
}

.ticket-page { animation: pageFadeIn .45s ease; }

::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: #f1f5f9; }
::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

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

.stat-tamu-card:hover::before { transform: scale(1.25); }

.bg-tamu-navy { background: linear-gradient(135deg, #1a237e 0%, #283593 100%) !important; }
.bg-tamu-orange { background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%) !important; }
.bg-tamu-yellow { background: linear-gradient(135deg, #f4c400 0%, #fb8c00 100%) !important; }
.bg-tamu-green { background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; }

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

.ticket-filter-card {
    border: 0;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,.06);
    position: relative;
    z-index: 100 !important;
    overflow: visible !important;
}

.ticket-filter-card .card-body { padding: 18px; }
.ticket-input-group { height: 44px; }
.ticket-input-group .input-group-text { background: #fff; border-right: 0; color: var(--polban-navy); }
.ticket-input { height: 44px; border-left: 0; font-size: .9rem; }

.ticket-input:focus, .ticket-select:focus {
    border-color: var(--polban-navy);
    box-shadow: 0 0 0 .18rem rgba(26,35,126,.12);
}

.ticket-select { height: 44px; border-radius: 8px; font-size: .9rem; }

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

.btn-ticket-reset:hover { background: #545b62; color: #fff; transform: translateY(-1px); }

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

.btn-export-laporan:hover, .btn-export-laporan:focus {
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

.export-dropdown-menu .dropdown-item:hover { background-color: #f1f5f9; }

.ticket-table-card {
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,.07);
}

.ticket-table-header { background: #fff; padding: 18px 20px; border-bottom: 1px solid #edf0f4; }
.ticket-table-title { color: var(--text-dark); font-size: 1.05rem; font-weight: 800; }
.ticket-table-title i { color: var(--polban-blue); }
.ticket-table { margin-bottom: 0; }
.ticket-table thead { background: var(--polban-navy) !important; }

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

.ticket-table tbody tr { transition: .2s ease; }
.ticket-table tbody tr:hover { background-color: #f8f9ff; }

.cell-notiket, .ticket-number {
    color: var(--polban-blue);
    font-weight: 800;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
}

.cell-notiket:hover, .ticket-number:hover {
    color: var(--polban-navy);
    text-decoration: underline;
}

.ticket-name { font-weight: 700; color: #263238; }

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

.status-submitted { background: #fff3cd; color: #856404; }
.status-verified { background: #d1e7dd; color: #0f5132; }
.status-disposisi { background: #cff4fc; color: #055160; }
.status-rejected { background: #f8d7da; color: #842029; }

.ticket-date { color: #59636e; font-size: .82rem; line-height: 1.5; white-space: nowrap; }

.ticket-actions { display: flex; justify-content: center; align-items: center; gap: 6px; }

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

.btn-modal-close-header {
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: #ffffff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.2s ease;
}

.btn-modal-close-header:hover {
    background: rgba(255, 255, 255, 0.3);
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

.btn-modal-cancel:hover { background-color: #cbd5e1; color: #1e293b; }

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

.offline-form-label .required { color: #ef4444; }

.offline-input-group { position: relative; }

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

.offline-input, .offline-select, .offline-textarea {
    width: 100%;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: #334155;
    border-radius: 12px;
    transition: all 0.25s ease;
    font-size: 0.92rem;
}

.offline-input { height: 50px; padding: 10px 16px 10px 46px !important; }
.offline-select { height: 50px; padding: 10px 42px 10px 46px !important; }

.offline-textarea {
    min-height: 130px;
    resize: vertical;
    padding: 14px 16px !important;
    line-height: 1.6;
}

.offline-input::placeholder, .offline-textarea::placeholder { color: #94a3b8; }

.offline-input:focus, .offline-select:focus, .offline-textarea:focus {
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

.offline-file-box:hover { border-color: #283593; background: #f1f5f9; }
.offline-file-box input[type="file"] { width: 100%; font-size: 0.88rem; color: #475569; }

.offline-modal-body { padding: 28px 32px !important; }
.offline-modal-footer { background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 18px 32px; }

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

.offline-btn-cancel:hover { background: #f1f5f9; color: #1e293b; }

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

.custom-toast.show { transform: translateX(0); opacity: 1; }
.custom-toast.success { border-left-color: #10b981; }
.custom-toast.success .toast-icon-wrapper { background: #d1fae5; color: #059669; }
.custom-toast.danger { border-left-color: #dc2626; }
.custom-toast.danger .toast-icon-wrapper { background: #fef2f2; color: #dc2626; }
.custom-toast.info { border-left-color: #2563eb; }
.custom-toast.info .toast-icon-wrapper { background: #eff6ff; color: #2563eb; }
.custom-toast.warning { border-left-color: #ff8c00; }
.custom-toast.warning .toast-icon-wrapper { background: #fffbeb; color: #f57c00; }

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

.toast-content-area { flex-grow: 1; }
.toast-title { font-weight: 800; font-size: 0.9rem; margin-bottom: 2px; color: #0f172a; }
.toast-message { font-size: 0.82rem; color: #64748b; margin: 0; line-height: 1.4; }

@keyframes pageFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.reveal-item { opacity: 0; transform: translateY(12px); }
.reveal-item.show { opacity: 1; transform: translateY(0); transition: all .4s ease; }

@media (max-width: 767px) {
    .offline-modal-body { padding: 20px !important; }
    .offline-modal-footer { padding: 15px 20px; }
    #toastContainer { top: 15px; right: 15px; left: 15px; }
    .custom-toast { min-width: auto; max-width: 100%; }
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
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="<?= (int) ($totalTiket ?? 0) ?>"><?= (int) ($totalTiket ?? 0) ?></h2>
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
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="<?= (int) ($submittedTiket ?? 0) ?>"><?= (int) ($submittedTiket ?? 0) ?></h2>
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
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="<?= (int) ($assignedTiket ?? 0) ?>"><?= (int) ($assignedTiket ?? 0) ?></h2>
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
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="<?= (int) ($verifiedTiket ?? 0) ?>"><?= (int) ($verifiedTiket ?? 0) ?></h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER CARD -->
    <div class="card ticket-filter-card mb-4 reveal-item">
        <div class="card-body">
            <div class="row g-2 align-items-center justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="input-group ticket-input-group flex-grow-1" style="min-width: 240px; max-width: 360px;">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" id="quickSearchInput" class="form-control ticket-input" placeholder="Cari nomor tiket / nama..." style="font-size: 0.88rem;">
                        </div>
                        <button class="btn btn-ticket-filter px-3 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCariTiket" data-toggle="modal" data-target="#modalCariTiket">
                            <i class="fas fa-filter"></i> Filter & Cari
                        </button>
                        <button id="btnKembaliTabel" class="btn btn-ticket-reset d-none" title="Kembali / Reset Filter">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-center justify-content-md-end gap-3 flex-wrap mt-2 mt-lg-0">
                    <div class="text-muted fw-semibold me-2" style="font-size: 0.85rem;">
                        Total Data: <span id="totalDataBadge" class="badge bg-primary text-white fs-6 ms-1 px-2 py-1" style="border-radius: 8px;"><?= (int) ($totalTiket ?? 0) ?> Tiket</span>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-export-laporan d-flex align-items-center gap-2 shadow-sm dropdown-toggle" type="button" id="dropdownExportLaporan" data-bs-toggle="dropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            <span>Export Laporan</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end export-dropdown-menu" aria-labelledby="dropdownExportLaporan">
                            <li><a class="dropdown-item" href="<?= base_url('report/excel') ?>"><i class="fas fa-file-excel text-success"></i> Export Excel</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('report/pdf') ?>"><i class="fas fa-file-pdf text-danger"></i> Export PDF</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('report/csv') ?>"><i class="fas fa-file-csv text-primary"></i> Export CSV</a></li>
                        </ul>
                    </div>

                    <button class="btn btn-ticket-filter px-3 d-flex align-items-center gap-2 shadow-sm" data-toggle="modal" data-target="#modalTambahTamu" data-bs-toggle="modal" data-bs-target="#modalTambahTamu" style="background: var(--polban-orange);">
                        <i class="fas fa-plus"></i> Tambah Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL LAPORAN TAMU -->
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
                        <?php if (!empty($tickets)): ?>

    <?php foreach ($tickets as $i => $d): ?>

        <?php
            $ticketId = $d['id'] ?? '';

            $ticketNumber = $d['ticket_number'] ?? '-';

            $namaPemohon = $d['applicant_name']
                ?? $d['nama_pemohon']
                ?? $d['student_name']
                ?? $d['name']
                ?? '-';

            $layanan = $d['service_name']
                ?? $d['layanan']
                ?? '-';

            // Ambil data form lama untuk fallback data Instansi/Unit
            $formData = [];
            if (!empty($d['form_data'])) {
                $decodedFormData = json_decode((string) $d['form_data'], true);
                if (is_array($decodedFormData)) {
                    $formData = $decodedFormData;
                }
            }

            $instansiUnit = !empty($d['institution_name'])
                ? $d['institution_name']
                : (!empty($d['instansi'])
                    ? $d['instansi']
                    : (!empty($d['unit_name'])
                        ? $d['unit_name']
                        : (!empty($formData['institution_name'])
                            ? $formData['institution_name']
                            : (!empty($formData['instansi'])
                                ? $formData['instansi']
                                : (!empty($formData['unit_name'])
                                    ? $formData['unit_name']
                                    : (!empty($formData['unit'])
                                        ? $formData['unit']
                                        : '-'))))));

            $status = strtolower($d['status'] ?? 'submitted');

            $statusLabel = match ($status) {
                'submitted'   => 'Submitted',
                'verified'    => 'Verified',
                'assigned'    => 'Assigned',
                'in_progress' => 'In Progress',
                'completed'   => 'Completed',
                'rejected'    => 'Rejected',
                'cancelled'   => 'Cancelled',
                default       => ucfirst($status),
            };

            $stClass = match ($status) {
                'verified',
                'completed' => 'status-verified',

                'assigned',
                'in_progress' => 'status-disposisi',

                'rejected',
                'cancelled' => 'status-rejected',

                default => 'status-submitted',
            };

            $email = $d['email'] ?? '';
            $phone = $d['phone'] ?? '';
            $description = $d['description'] ?? '';
            $createdAt = $d['ticket_created_at'] ?? null;

            $tanggal = $createdAt
                ? (new DateTime($createdAt, new DateTimeZone('UTC')))
                    ->setTimezone(new DateTimeZone('Asia/Jakarta'))
                    ->format('d-m-Y H:i')
                : '-';
        ?>

        <tr class="tamu-row"
            data-id="<?= esc($ticketId) ?>"
            data-notiket="<?= esc($ticketNumber) ?>"
            data-nama="<?= esc($namaPemohon) ?>"
            data-layanan="<?= esc($layanan) ?>"
            data-status="<?= esc($statusLabel) ?>"
            data-email="<?= esc($email) ?>"
            data-hp="<?= esc($phone) ?>"
            data-tanggal="<?= esc($tanggal) ?>"
            data-deskripsi="<?= esc($description) ?>">

            <td class="text-center fw-bold text-muted row-number">
                <?= $i + 1 ?>
            </td>

            <td>
                <span class="cell-notiket ticket-number"
                      title="Klik untuk menyalin nomor tiket"
                      onclick="copyNoTiket(this, '<?= esc($ticketNumber) ?>')">
                    <?= esc($ticketNumber) ?>
                </span>
            </td>

            <td>
                <div class="ticket-name cell-nama">
                    <?= esc($namaPemohon) ?>
                </div>
            </td>

            <td>
                <span class="ticket-category cell-layanan">
                    <?= esc($layanan) ?>
                </span>
            </td>

            <td class="text-center">
                <span class="ticket-status cell-status <?= esc($stClass) ?>">
                    <i class="fas fa-circle" style="font-size:0.45rem;"></i>
                    <?= esc($statusLabel) ?>
                </span>
            </td>

            <td>
                <div class="ticket-date cell-tanggal">
                    <?= esc($tanggal) ?>
                </div>
            </td>

            <td class="text-center">
                <div class="ticket-actions">

                    <!-- DETAIL -->
                    <button type="button"
                            class="ticket-action action-detail btn-detail-tamu"
                            title="Detail Tiket"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDetailTamu"
                            data-toggle="modal"
                            data-target="#modalDetailTamu"
                            data-id="<?= esc($ticketId) ?>"
                            data-notiket="<?= esc($ticketNumber) ?>"
                            data-nama="<?= esc($namaPemohon) ?>"
                            data-layanan="<?= esc($layanan) ?>"
                            data-status="<?= esc($statusLabel) ?>"
                            data-email="<?= esc($d['applicant_email'] ?? $d['email'] ?? '-') ?>"
                            data-hp="<?= esc($d['applicant_phone'] ?? $d['phone'] ?? '-') ?>"
                            data-instansi="<?= esc($instansiUnit) ?>"
                            data-tanggal="<?= esc($tanggal) ?>"
                            data-deskripsi="<?= esc($d['description'] ?? $d['ticket_description'] ?? $d['title'] ?? '-') ?>">
                        <i class="fas fa-eye"></i>
                    </button>

                    <!-- VERIFIKASI -->
                    <?php if ($status === 'submitted'): ?>
                        <button type="button"
                                class="ticket-action action-verify btn-verifikasi-tamu"
                                title="Verifikasi Tiket"
                                data-bs-toggle="modal"
                                data-bs-target="#modalVerifikasiTamu"
                                data-toggle="modal"
                                data-target="#modalVerifikasiTamu"
                              data-id="<?= esc($ticketId) ?>"
data-notiket="<?= esc($ticketNumber) ?>"
data-nama="<?= esc($namaPemohon) ?>"
data-unit-id="<?= esc($d['service_unit_id'] ?? '') ?>"
data-unit-name="<?= esc($d['unit_name'] ?? '') ?>">
                            <i class="fas fa-check-circle"></i>
                        </button>
                    <?php endif; ?>

                    <!-- DISPOSISI -->
<?php if ($status === 'verified'): ?>
    <button type="button"
            class="ticket-action action-disposition btn-disposisi-tamu"
            title="Disposisi Tiket"
            data-bs-toggle="modal"
            data-bs-target="#modalDisposisiTamu"
            data-toggle="modal"
            data-target="#modalDisposisiTamu"
data-id="<?= esc($ticketId) ?>"
data-notiket="<?= esc($ticketNumber) ?>"
data-status="<?= esc($statusLabel) ?>"
data-unit-id="<?= esc($d['service_unit_id'] ?? '') ?>"
data-unit-name="<?= esc($d['unit_name'] ?? '') ?>">
        <i class="fas fa-share"></i>
    </button>
<?php endif; ?>

                    <!-- EDIT -->
                    <button type="button"
                            class="ticket-action action-edit btn-edit-tamu"
                            title="Edit Tiket"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditTiket"
                            data-toggle="modal"
                            data-target="#modalEditTiket"
                            data-id="<?= esc($ticketId) ?>"
                            data-notiket="<?= esc($ticketNumber) ?>"
                            data-nama="<?= esc($namaPemohon) ?>"
                            data-email="<?= esc($d['applicant_email'] ?? $d['email'] ?? '') ?>"
                            data-service-id="<?= esc($d['service_id'] ?? '') ?>"
                            data-unit-id="<?= esc($d['unit_id'] ?? $d['service_unit_id'] ?? '') ?>"
                            data-hp="<?= esc($d['applicant_phone'] ?? $d['phone'] ?? '') ?>"
                            data-instansi="<?= esc($instansiUnit) ?>"
                            data-layanan="<?= esc($layanan) ?>"
                            data-deskripsi="<?= esc($d['description'] ?? $d['ticket_description'] ?? $d['title'] ?? '') ?>">
                        <i class="fas fa-pen"></i>
                    </button>

                    <!-- HAPUS -->
                    <button type="button"
                            class="ticket-action action-delete btn-delete-tamu"
                            title="Hapus Tiket"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDeleteTiket"
                            data-toggle="modal"
                            data-target="#modalDeleteTiket"
                            data-id="<?= esc($ticketId) ?>"
                            data-notiket="<?= esc($ticketNumber) ?>"
                            data-nama="<?= esc($namaPemohon) ?>">
                        <i class="fas fa-trash"></i>
                    </button>

                </div>
            </td>

        </tr>

    <?php endforeach; ?>

<?php endif; ?>
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
            <div class="modal-header modal-header-ultra d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Tambah Laporan Tamu (Walk-In)</h5>
                        <small class="text-white-50">Catat kunjungan tamu langsung di Unit Layanan Terpadu</small>
                    </div>
                </div>
                <button type="button" class="btn-modal-close-header" data-bs-dismiss="modal" data-dismiss="modal" title="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="formTambahTamu" action="<?= base_url('guest-report/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body offline-modal-body">
                    
                    <div class="offline-info-box">
                        <i class="fas fa-info-circle me-2"></i> Silakan pilih jenis pemohon terlebih dahulu untuk menampilkan form isian yang sesuai.
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="offline-form-label">JENIS PEMOHON <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-user-tag offline-input-icon"></i>
                                <select id="addJenisPemohon" name="applicant_type" class="offline-select" required>
                                    <option value="" selected disabled>-- Pilih Jenis Pemohon --</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Tendik">Tenaga Kependidikan</option>
                                    <option value="Orang Tua">Orang Tua</option>
                                    <option value="Alumni">Alumni</option>
                                    <option value="Mitra">Mitra</option>
                                    <option value="Umum">Umum</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div id="dynamicFormContainer" class="row g-3"></div>
                        </div>

                        <div class="col-12">
                            <label class="offline-form-label">
                                KETERANGAN / DESKRIPSI KEPERLUAN <span class="required">*</span>
                            </label>
                            <textarea id="addDeskripsi" name="ticket_description" class="offline-textarea modal-input-field" placeholder="Tuliskan detail permohonan atau keperluan tamu di sini..." maxlength="500" required style="padding-left: 16px !important;"></textarea>
                            <div class="d-flex justify-content-end mt-1">
                                <small id="charCount" class="text-muted fw-semibold" style="font-size: 0.75rem;">0 / 500 Karakter</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer offline-modal-footer">
                    <button type="button" class="btn offline-btn-cancel" data-bs-dismiss="modal" data-dismiss="modal">
                        Batal
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
            <div class="modal-header modal-header-ultra d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-ticket-alt text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Detail Informasi Tiket</h5>
                        <small class="text-white-50">Informasi lengkap riwayat dan status permohonan</small>
                    </div>
                </div>
                <button type="button" class="btn-modal-close-header" data-bs-dismiss="modal" data-dismiss="modal" title="Tutup">
                    <i class="fas fa-times"></i>
                </button>
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
                <button type="button" class="btn btn-modal-cancel w-100" data-bs-dismiss="modal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VERIFIKASI TAMU -->
<div class="modal fade" id="modalVerifikasiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-user-check text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Verifikasi Tiket Tamu</h5>
                        <small class="text-white-50">Perbarui status verifikasi data tamu</small>
                    </div>
                </div>
                <button type="button" class="btn-modal-close-header" data-bs-dismiss="modal" data-dismiss="modal" title="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formVerifikasiTamu">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="offline-form-label">Nomor Tiket</label>
                        <input type="text" id="verifNoTiket" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 16px !important;">
                    </div>
                    <div class="mb-3">
                       <label class="offline-form-label">
    Tentukan Hasil Verifikasi <span class="required">*</span>
</label>

<select class="offline-select"
        id="verifStatusSelect"
        required
        style="padding-left: 16px !important;">

    <option value="" selected disabled>
        -- Pilih Hasil Verifikasi --
    </option>

    <option value="Verified">
        Verify / Verifikasi
    </option>

    <option value="Need Revision">
        Need Revision / Perlu Revisi
    </option>

    <option value="Rejected">
        Reject / Tolak
    </option>

</select>
                    </div>

                    <!-- PRIORITAS -->
<div class="mb-3">

    <label class="offline-form-label">
        <i class="fas fa-flag text-danger"></i>
        Tentukan Prioritas
    </label>

    <select name="prioritas"
            id="verifPrioritas"
            class="offline-select"
            required
            style="padding-left: 16px !important;">

        <option value="" selected disabled>
            -- Pilih Prioritas --
        </option>

        <option value="low">
            Low
        </option>

        <option value="medium">
            Medium
        </option>

        <option value="high">
            High
        </option>

        <option value="urgent">
            Urgent
        </option>

    </select>

</div>


<!-- UNIT TUJUAN -->
<div class="mb-3">

    <label class="offline-form-label">
        <i class="fas fa-building text-primary"></i>
        Unit Tujuan
    </label>

    <input type="text"
           id="verifUnitName"
           class="offline-input"
           readonly
           value="Memuat unit..."
           style="
               background-color: #f1f5f9;
               padding-left: 16px !important;
           ">

    <input type="hidden"
           name="assigned_to"
           id="verifUnitId">

    <small class="text-muted">
        <i class="fas fa-info-circle text-primary"></i>
        Unit tujuan otomatis mengikuti unit yang dipilih saat pengajuan tiket.
    </small>

</div>

                    <div class="mb-0">
                        <label class="offline-form-label">Catatan Verifikasi</label>
                        <textarea class="offline-textarea" placeholder="Tambahkan catatan verifikasi jika diperlukan..." style="padding-left: 16px !important; min-height: 90px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">Verifikasi Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DISPOSISI TAMU -->
<div class="modal fade" id="modalDisposisiTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-share text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Disposisi Tiket</h5>
                        <small class="text-white-50">Teruskan tiket ke unit atau bagian terkait</small>
                    </div>
                </div>
                <button type="button" class="btn-modal-close-header" data-bs-dismiss="modal" data-dismiss="modal" title="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formDisposisiTamu">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="offline-form-label">Nomor Tiket</label>
                        <input type="text" id="dispNoTiketField" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 16px !important;">
                    </div>
                   <div class="mb-3">
    <label class="offline-form-label">
        Unit / Bagian Tujuan Disposisi
    </label>

    <input type="text"
           id="dispUnitName"
           class="offline-input"
           readonly
           value="Memuat unit..."
           style="
               background-color: #f1f5f9;
               padding-left: 16px !important;
               font-weight: 700;
               color: #1a237e;
               cursor: not-allowed;
           ">

    <input type="hidden"
           name="assigned_to"
           id="dispUnitId">
</div>
                    <div class="mb-0">
                        <label class="offline-form-label">Catatan Disposisi</label>
                        <textarea name="note" id="dispNote" class="offline-textarea" placeholder="Tambahkan instruksi atau catatan disposisi..." style="padding-left: 16px !important; min-height: 90px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
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
            <div class="modal-header modal-header-ultra d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-pen text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Edit Data Tiket Tamu</h5>
                        <small class="text-white-50">Perbarui informasi laporan kunjungan</small>
                    </div>
                </div>
                <button type="button" class="btn-modal-close-header" data-bs-dismiss="modal" data-dismiss="modal" title="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formEditTiket">
                <input type="hidden" id="editTicketId" name="ticket_id">
                <div class="modal-body offline-modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="offline-form-label">Nomor Tiket</label>
                            <input type="text" id="editNoTiket" class="offline-input" readonly style="background-color: #f1f5f9; padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Nama Pemohon <span class="required">*</span></label>
                            <input type="text" id="editNama" name="applicant_name" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Email <span class="required">*</span></label>
                            <input type="email" id="editEmail" name="email" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Nomor HP / WhatsApp <span class="required">*</span></label>
                            <input type="text" id="editHp" name="phone" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Instansi / Unit <span class="required">*</span></label>
                            <input type="text" id="editInstansi" name="instansi" class="offline-input" required style="padding-left: 16px !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">Layanan Tujuan <span class="required">*</span></label>
                            <select id="editLayanan" name="unit_id" class="offline-select" required style="padding-left: 16px !important;">
                                <option value="1">Unit Layanan Terpadu</option>
                                <option value="2">Bagian Akademik</option>
                                <option value="3">Bagian Keuangan</option>
                                <option value="4">Bagian Kemahasiswaan</option>
                                <option value="5">Perpustakaan</option>
                                <option value="6">Jurusan</option>
                                <option value="7">UPT Teknologi Informasi dan Komunikasi</option>
                                <option value="9">Bagian Administrasi Umum</option>
                                <option value="8">Administrasi Umum</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="offline-form-label">Deskripsi Keperluan <span class="required">*</span></label>
                            <textarea id="editDeskripsi" name="ticket_description" class="offline-textarea" required style="padding-left: 16px !important; min-height: 100px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-ultra">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-submit">Update Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DELETE TIKET -->
<div class="modal fade" id="modalDeleteTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header bg-danger text-white py-3 px-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge bg-white bg-opacity-25 text-white me-3">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Konfirmasi Hapus Tiket</h5>
                        <small class="text-white-50">Tindakan ini tidak dapat dibatalkan</small>
                    </div>
                </div>
                <button type="button" class="btn-modal-close-header" data-bs-dismiss="modal" data-dismiss="modal" title="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <input type="hidden" id="deleteTicketId" value="">
                <p class="text-muted mb-2">Apakah Anda yakin ingin menghapus data laporan tamu berikut?</p>
                <h5 id="deleteNoTiketSpan" class="fw-bold text-dark mb-1">-</h5>
                <p class="fw-semibold text-primary mb-0" id="deleteNamaSpan">-</p>
            </div>
            <div class="modal-footer modal-footer-ultra justify-content-center">
                <button type="button" class="btn btn-modal-cancel px-4" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger px-4 fw-bold rounded-3 shadow-sm" id="confirmDeleteBtn" style="padding: 10px 22px;">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CARI / FILTER TIKET -->
<div class="modal fade" id="modalCariTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-ultra">
            <div class="modal-header modal-header-ultra d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-badge">
                        <i class="fas fa-filter text-white"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-white">Filter & Cari Data Tamu</h5>
                        <small class="text-white-50">Saring tabel berdasarkan status dan layanan</small>
                    </div>
                </div>
                <button type="button" class="btn-modal-close-header" data-bs-dismiss="modal" data-dismiss="modal" title="Tutup">
                    <i class="fas fa-times"></i>
                </button>
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
                        <option value="1">Unit Layanan Terpadu</option>
                        <option value="2">Bagian Akademik</option>
                        <option value="3">Bagian Keuangan</option>
                        <option value="4">Bagian Kemahasiswaan</option>
                        <option value="5">Perpustakaan</option>
                        <option value="6">Jurusan</option>
                        <option value="7">UPT Teknologi Informasi dan Komunikasi</option>
                        <option value="9">Bagian Administrasi Umum</option>
                        <option value="8">Administrasi Umum</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer modal-footer-ultra">
                <button type="button" class="btn btn-modal-cancel" id="resetFilterBtn">Reset</button>
                <button type="button" class="btn btn-modal-submit" data-bs-dismiss="modal" data-dismiss="modal">Terapkan Filter</button>
            </div>
        </div>
    </div>
</div>

<script>
    function closeModal(modalId) {
        const modalEl = document.getElementById(modalId);
        if (!modalEl) return;

        if (window.bootstrap && bootstrap.Modal) {
            const instance =
                bootstrap.Modal.getInstance(modalEl) ||
                bootstrap.Modal.getOrCreateInstance(modalEl);

            if (instance) {
                instance.hide();
            }
        }

        if (
            window.jQuery &&
            typeof window.jQuery.fn.modal === 'function'
        ) {
            window.jQuery('#' + modalId).modal('hide');
        }
    }

    function showToast(title, message, type = 'success') {
        const container =
            document.getElementById('toastContainer');

        if (!container) return;

        const toastId = 'toast_' + Date.now();

        let iconClass = 'fas fa-check-circle';

        if (type === 'danger') {
            iconClass = 'fas fa-exclamation-circle';
        }

        if (type === 'warning') {
            iconClass = 'fas fa-exclamation-triangle';
        }

        if (type === 'info') {
            iconClass = 'fas fa-info-circle';
        }

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

        container.insertAdjacentHTML(
            'beforeend',
            toastHTML
        );

        const toastElement =
            document.getElementById(toastId);

        setTimeout(() => {
            if (toastElement) {
                toastElement.classList.add('show');
            }
        }, 50);

        setTimeout(() => {
            if (toastElement) {
                toastElement.classList.remove('show');

                setTimeout(() => {
                    if (toastElement) {
                        toastElement.remove();
                    }
                }, 400);
            }
        }, 3800);
    }

    function copyNoTiket(element, noTiket) {
        navigator.clipboard
            .writeText(noTiket)
            .then(() => {
                showToast(
                    'Nomor Tiket Disalin!',
                    `Nomor ${noTiket} berhasil disalin ke clipboard.`,
                    'success'
                );
            })
            .catch(() => {
                showToast(
                    'Gagal Menyalin',
                    'Terjadi kesalahan saat menyalin nomor tiket.',
                    'danger'
                );
            });
    }


    document.addEventListener('DOMContentLoaded', function () {

        /* =====================================================
         * ANIMASI ITEM
         * ===================================================== */
        setTimeout(() => {
            document
                .querySelectorAll('.reveal-item')
                .forEach(item => {
                    item.classList.add('show');
                });
        }, 100);


        /* =====================================================
         * MODAL BOOTSTRAP
         * ===================================================== */
        document
            .querySelectorAll(
                '[data-bs-toggle="modal"], [data-toggle="modal"]'
            )
            .forEach(function (btn) {

                btn.addEventListener('click', function () {

                    const target =
                        this.getAttribute('data-bs-target') ||
                        this.getAttribute('data-target');

                    if (!target) return;

                    if (
                        window.bootstrap &&
                        bootstrap.Modal
                    ) {
                        const modalEl =
                            document.querySelector(target);

                        if (modalEl) {
                            bootstrap.Modal
                                .getOrCreateInstance(modalEl)
                                .show();
                        }
                    }

                    if (
                        window.jQuery &&
                        typeof window.jQuery.fn.modal === 'function'
                    ) {
                        window.jQuery(target).modal('show');
                    }
                });
            });


        /* =====================================================
         * TOMBOL CLOSE MODAL
         * ===================================================== */
        document
            .querySelectorAll(
                '[data-bs-dismiss="modal"], [data-dismiss="modal"]'
            )
            .forEach(function (btn) {

                btn.addEventListener('click', function () {

                    const modalEl =
                        this.closest('.modal');

                    if (!modalEl) return;

                    closeModal(modalEl.id);
                });
            });


        /* =====================================================
         * DYNAMIC FORM BUILDER
         * ===================================================== */
        const jenisPemohonSelect =
            document.getElementById('addJenisPemohon');

        const dynamicContainer =
            document.getElementById('dynamicFormContainer');


        if (
            jenisPemohonSelect &&
            dynamicContainer
        ) {

            jenisPemohonSelect.addEventListener(
                'change',
                function () {

                    const val = this.value;

                    let htmlContent = '';


                    /* =========================
                     * MAHASISWA
                     * ========================= */
                    if (val === 'Mahasiswa') {

                        htmlContent = `
                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    NAMA LENGKAP
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-user offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="nama"
                                        class="offline-input"
                                        placeholder="Masukkan Nama Lengkap"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
    <label class="offline-form-label">
        NIM <span class="required">*</span>
    </label>

    <div class="offline-input-group">
        <i class="fas fa-id-card offline-input-icon"></i>
        <input
            type="text"
            name="nim"
            class="offline-input"
            placeholder="Masukkan NIM"
            required
        >
    </div>
</div>

                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    KELAS / ANGKATAN
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-users offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="kelas"
                                        class="offline-input"
                                        placeholder="Contoh: 3A / 2023"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    EMAIL
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-envelope offline-input-icon"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        class="offline-input"
                                        placeholder="email@student.polban.ac.id"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    NO. WHATSAPP / HP
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-phone offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="hp"
                                        class="offline-input"
                                        placeholder="Contoh: 081234567890"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="card border shadow-sm rounded-3">

                                    <div class="card-header bg-primary text-white fw-bold py-2 px-3">
                                        <i class="fas fa-list-ul me-2"></i>
                                        Pilih Layanan
                                    </div>

                                    <div class="card-body p-3">

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="offline-form-label">
                                                    Unit Layanan
                                                    <span class="required">*</span>
                                                </label>

                                                <select
                                                    id="addUnitLayanan"
                                                    name="unit_layanan"
                                                    class="offline-select"
                                                    required
                                                    style="padding-left: 16px !important;"
                                                >
                                                    <option value="" selected disabled>
                                                        -- Pilih Unit Layanan --
                                                    </option>

                                                    <option value="1">
                                                        Unit Layanan Terpadu
                                                    </option>

                                                    <option value="2">
                                                        Bagian Akademik
                                                    </option>

                                                    <option value="3">
                                                        Bagian Keuangan
                                                    </option>

                                                    <option value="4">
                                                        Bagian Kemahasiswaan
                                                    </option>

                                                    <option value="5">
                                                        Perpustakaan
                                                    </option>

                                                    <option value="6">
                                                        Jurusan
                                                    </option>

                                                    <option value="7">
                                                        UPT Teknologi Informasi dan Komunikasi
                                                    </option>

                                                    <option value="9">
                                                        Bagian Administrasi Umum
                                                    </option>

                                                    <option value="8">
                                                        Administrasi Umum
                                                    </option>
                                                </select>
                                            </div>


                                            <div
                                                class="col-md-4"
                                                id="wrapperJurusan"
                                                style="display: none;"
                                            >
                                                <label class="offline-form-label">
                                                    Jurusan
                                                    <span class="required">*</span>
                                                </label>

                                                <select
                                                    id="addJurusan"
                                                    name="jurusan"
                                                    class="offline-select"
                                                    style="padding-left: 16px !important;"
                                                >
                                                    <option value="" selected disabled>
                                                        -- Pilih Jurusan --
                                                    </option>

                                                    <option value="Teknik Komputer dan Informatika">
                                                        Teknik Komputer dan Informatika
                                                    </option>

                                                    <option value="Teknik Elektro">
                                                        Teknik Elektro
                                                    </option>

                                                    <option value="Teknik Mesin">
                                                        Teknik Mesin
                                                    </option>

                                                    <option value="Teknik Sipil">
                                                        Teknik Sipil
                                                    </option>

                                                    <option value="Teknik Kimia">
                                                        Teknik Kimia
                                                    </option>

                                                    <option value="Akuntansi">
                                                        Akuntansi
                                                    </option>

                                                    <option value="Administrasi Niaga">
                                                        Administrasi Niaga
                                                    </option>

                                                    <option value="Bahasa Inggris">
                                                        Bahasa Inggris
                                                    </option>
                                                </select>
                                            </div>


                                            <div
                                                class="col-md-4"
                                                id="wrapperJenisLayananCol"
                                            >
                                                <label class="offline-form-label">
                                                    Jenis Layanan
                                                    <span class="required">*</span>
                                                </label>

                                                <select
                                                    id="addJenisLayanan"
                                                    name="jenis_layanan"
                                                    class="offline-select"
                                                    disabled
                                                    required
                                                    style="padding-left: 16px !important;"
                                                >
                                                    <option value="" selected disabled>
                                                        -- Pilih Jenis Layanan --
                                                    </option>
                                                </select>
                                            </div>

                                        </div>


                                        <div
                                            id="persyaratanContainer"
                                            class="mt-4 d-none"
                                        >
                                            <div
                                                class="fw-bold text-dark mb-1"
                                                style="font-size: 0.92rem;"
                                            >
                                                <i class="fas fa-clipboard-list me-1"></i>
                                                Persyaratan Layanan
                                            </div>

                                            <p class="text-muted small mb-3">
                                                Silakan upload dokumen sesuai persyaratan layanan yang dipilih.
                                            </p>

                                            <div id="persyaratanContent"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        `;

                    }

                    /* =========================
                     * JENIS PEMOHON LAINNYA
                     * ========================= */
                    else if (val) {

                        htmlContent = `
                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    NAMA LENGKAP
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-user offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="nama"
                                        class="offline-input"
                                        placeholder="Masukkan Nama Lengkap"
                                        required
                                    >
                                </div>
                            </div>

                            ${
                                val === 'Dosen' ||
                                val === 'Tendik' ||
                                val === 'Orang Tua' ||
                                val === 'Umum'
                                    ? `
                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    NIK <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-id-card offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="nik"
                                        class="offline-input"
                                        placeholder="Masukkan NIK"
                                        required
                                    >
                                </div>
                            </div>
                                    `
                                    : ''
                            }

                            ${
                                val === 'Orang Tua'
                                    ? `
                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    NIM ANAK <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-id-card offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="nim_anak"
                                        class="offline-input"
                                        placeholder="Masukkan NIM Anak"
                                        required
                                    >
                                </div>
                            </div>
                                    `
                                    : ''
                            }

                            ${
                                val === 'Alumni'
                                    ? `
                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    NIM <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-id-card offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="nim"
                                        class="offline-input"
                                        placeholder="Masukkan NIM"
                                        required
                                    >
                                </div>
                            </div>
                                    `
                                    : ''
                            }

                            ${
                                val === 'Mitra'
                                    ? `
                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    INSTANSI <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-building offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="instansi"
                                        class="offline-input"
                                        placeholder="Masukkan Instansi"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    JABATAN <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-briefcase offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="jabatan"
                                        class="offline-input"
                                        placeholder="Masukkan Jabatan"
                                        required
                                    >
                                </div>
                            </div>
                                    `
                                    : ''
                            }

                            ${
                                val === 'Dosen' ||
                                val === 'Tendik'
                                    ? `
                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    INSTANSI / UNIT ASAL
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-building offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="instansi"
                                        class="offline-input"
                                        placeholder="Masukkan Instansi / Unit Asal"
                                        required
                                    >
                                </div>
                            </div>
                                    `
                                    : ''
                            }

                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    NO. WHATSAPP / HP
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-phone offline-input-icon"></i>

                                    <input
                                        type="text"
                                        name="hp"
                                        class="offline-input"
                                        placeholder="Contoh: 081234567890"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="offline-form-label">
                                    EMAIL
                                    <span class="required">*</span>
                                </label>

                                <div class="offline-input-group">
                                    <i class="fas fa-envelope offline-input-icon"></i>

                                    <input
                                        type="email"
                                        name="email"
                                        class="offline-input"
                                        placeholder="email@domain.com"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="card border shadow-sm rounded-3">

                                    <div class="card-header bg-primary text-white fw-bold py-2 px-3">
                                        <i class="fas fa-list-ul me-2"></i>
                                        Pilih Layanan
                                    </div>

                                    <div class="card-body p-3">

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="offline-form-label">
                                                    Unit Layanan
                                                    <span class="required">*</span>
                                                </label>

                                                <select
                                                    id="addUnitLayanan"
                                                    name="unit_layanan"
                                                    class="offline-select"
                                                    required
                                                    style="padding-left: 16px !important;"
                                                >
                                                    <option value="" selected disabled>
                                                        -- Pilih Unit Layanan --
                                                    </option>

                                                    <option value="1">Unit Layanan Terpadu</option>
                                                    <option value="2">Bagian Akademik</option>
                                                    <option value="3">Bagian Keuangan</option>
                                                    <option value="4">Bagian Kemahasiswaan</option>
                                                    <option value="5">Perpustakaan</option>
                                                    <option value="6">Jurusan</option>
                                                    <option value="7">UPT Teknologi Informasi dan Komunikasi</option>
                                                    <option value="8">Administrasi Umum</option>
                                                </select>
                                            </div>

                                            <div
                                                class="col-md-4"
                                                id="wrapperJurusan"
                                                style="display: none;"
                                            >
                                                <label class="offline-form-label">
                                                    Jurusan
                                                    <span class="required">*</span>
                                                </label>

                                                <select
                                                    id="addJurusan"
                                                    name="jurusan"
                                                    class="offline-select"
                                                    style="padding-left: 16px !important;"
                                                >
                                                    <option value="" selected disabled>
                                                        -- Pilih Jurusan --
                                                    </option>

                                                    <option value="Teknik Komputer dan Informatika">Teknik Komputer dan Informatika</option>
                                                    <option value="Teknik Elektro">Teknik Elektro</option>
                                                    <option value="Teknik Mesin">Teknik Mesin</option>
                                                    <option value="Teknik Sipil">Teknik Sipil</option>
                                                    <option value="Teknik Kimia">Teknik Kimia</option>
                                                    <option value="Akuntansi">Akuntansi</option>
                                                    <option value="Administrasi Niaga">Administrasi Niaga</option>
                                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                                </select>
                                            </div>

                                            <div
                                                class="col-md-4"
                                                id="wrapperJenisLayananCol"
                                            >
                                                <label class="offline-form-label">
                                                    Jenis Layanan
                                                    <span class="required">*</span>
                                                </label>

                                                <select
                                                    id="addJenisLayanan"
                                                    name="jenis_layanan"
                                                    class="offline-select"
                                                    disabled
                                                    required
                                                    style="padding-left: 16px !important;"
                                                >
                                                    <option value="" selected disabled>
                                                        -- Pilih Jenis Layanan --
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                        <div
                                            id="persyaratanContainer"
                                            class="mt-4 d-none"
                                        >
                                            <div
                                                class="fw-bold text-dark mb-1"
                                                style="font-size: 0.92rem;"
                                            >
                                                <i class="fas fa-clipboard-list me-1"></i>
                                                Persyaratan Layanan
                                            </div>

                                            <p class="text-muted small mb-3">
                                                Silakan upload dokumen sesuai persyaratan layanan yang dipilih.
                                            </p>

                                            <div id="persyaratanContent"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        `;
                    }


                    dynamicContainer.innerHTML =
                        htmlContent;

                    initLayananDropdownEvents();
                }
            );
        }


        /* =====================================================
         * DROPDOWN LAYANAN
         * ===================================================== */
        function initLayananDropdownEvents() {

            const unitSelects =
                document.querySelectorAll('#addUnitLayanan');

            const jenisSelects =
                document.querySelectorAll('#addJenisLayanan');


            if (
                !unitSelects.length ||
                !jenisSelects.length
            ) {
                console.warn(
                    'Dropdown Unit/Jenis Layanan tidak ditemukan.'
                );

                return;
            }


            unitSelects.forEach(
                (unitSelect, index) => {

                    const jenisSelect =
                        jenisSelects[index];

                    if (!jenisSelect) return;


                    const form =
                        unitSelect.closest('form') ||
                        document;


                    const wrapperJurusan =
                        form.querySelector(
                            '#wrapperJurusan'
                        );

                    const wrapperJenisLayananCol =
                        form.querySelector(
                            '#wrapperJenisLayananCol'
                        );

                    const jurusanSelect =
                        form.querySelector(
                            '#addJurusan'
                        );

                    const persyaContainer =
                        form.querySelector(
                            '#persyaratanContainer'
                        );

                    const persyaContent =
                        form.querySelector(
                            '#persyaratanContent'
                        );


                    function resetLayanan() {

                        jenisSelect.innerHTML =
                            '<option value="" selected disabled>-- Pilih Jenis Layanan --</option>';

                        jenisSelect.disabled =
                            true;


                        if (persyaContainer) {
                            persyaContainer.classList.add(
                                'd-none'
                            );
                        }


                        if (persyaContent) {
                            persyaContent.innerHTML =
                                '';
                        }
                    }


                    unitSelect.addEventListener(
                        'change',
                        async function () {

                            const unitId =
                                this.value;

                            resetLayanan();


                            const selectedOption =
                                this.options[
                                    this.selectedIndex
                                ];

                            const unitName =
                                selectedOption
                                    ? selectedOption
                                        .textContent
                                        .trim()
                                        .toLowerCase()
                                    : '';


                            if (
                                unitName ===
                                'jurusan'
                            ) {

                                if (wrapperJurusan) {
                                    wrapperJurusan.style.display =
                                        'block';
                                }

                                if (jurusanSelect) {
                                    jurusanSelect.required =
                                        true;
                                }

                                if (
                                    wrapperJenisLayananCol
                                ) {
                                    wrapperJenisLayananCol.className =
                                        'col-md-4';
                                }

                            } else {

                                if (wrapperJurusan) {
                                    wrapperJurusan.style.display =
                                        'none';
                                }

                                if (jurusanSelect) {
                                    jurusanSelect.required =
                                        false;

                                    jurusanSelect.value =
                                        '';
                                }

                                if (
                                    wrapperJenisLayananCol
                                ) {
                                    wrapperJenisLayananCol.className =
                                        'col-md-6';
                                }
                            }


                            if (!unitId) return;


                            // Unit Layanan Terpadu tidak memiliki Jenis Layanan.
                            // Biarkan kosong dan izinkan form untuk disubmit.
                            if (unitId === '1') {
                                jenisSelect.value = '';
                                jenisSelect.disabled = true;
                                jenisSelect.required = false;

                                if (wrapperJenisLayananCol) {
                                    wrapperJenisLayananCol.className =
                                        'col-md-6';
                                }

                                return;
                            }


                            jenisSelect.disabled =
                                true;

                            jenisSelect.innerHTML =
                                '<option value="" selected disabled>Memuat layanan...</option>';


                            const url =
                                '<?= base_url('guest-report/services-by-unit') ?>/' +
                                encodeURIComponent(
                                    unitId
                                );


                            console.log(
                                'Memuat layanan:',
                                url
                            );


                            try {

                                const response =
                                    await fetch(
                                        url,
                                        {
                                            method: 'GET',

                                            headers: {
                                                'X-Requested-With':
                                                    'XMLHttpRequest',

                                                'Accept':
                                                    'application/json'
                                            },

                                            credentials:
                                                'same-origin'
                                        }
                                    );


                                console.log(
                                    'Response layanan:',
                                    response.status,
                                    response.url
                                );


                                if (!response.ok) {
                                    throw new Error(
                                        'HTTP ' +
                                        response.status
                                    );
                                }


                                const result =
                                    await response.json();


                                console.log(
                                    'Data layanan:',
                                    result
                                );


                                jenisSelect.innerHTML =
                                    '<option value="" selected disabled>-- Pilih Jenis Layanan --</option>';


                                if (
                                    result.status ===
                                        'success' &&
                                    Array.isArray(
                                        result.data
                                    )
                                ) {

                                    result.data.forEach(
                                        service => {

                                            const option =
                                                document.createElement(
                                                    'option'
                                                );

                                            option.value =
                                                service.id ??
                                                '';

                                            option.textContent =
                                                service.name ??
                                                service.service_name ??
                                                'Layanan';

                                            jenisSelect.appendChild(
                                                option
                                            );
                                        }
                                    );


                                    if (
                                        result.data.length >
                                        0
                                    ) {

                                        jenisSelect.disabled =
                                            false;

                                    } else {

                                        jenisSelect.disabled =
                                            true;

                                        jenisSelect.innerHTML =
                                            '<option value="" selected disabled>Tidak ada layanan</option>';
                                    }

                                } else {

                                    throw new Error(
                                        result.message ||
                                        'Data layanan tidak valid'
                                    );
                                }

                            } catch (error) {

                                console.error(
                                    'Gagal mengambil layanan:',
                                    error
                                );

                                jenisSelect.disabled =
                                    true;

                                jenisSelect.innerHTML =
                                    '<option value="" selected disabled>Gagal memuat layanan</option>';
                            }
                        }
                    );


                    jenisSelect.addEventListener(
                        'change',
                        async function () {

                            const serviceId =
                                this.value;


                            if (persyaContainer) {
                                persyaContainer.classList.add(
                                    'd-none'
                                );
                            }


                            if (persyaContent) {
                                persyaContent.innerHTML =
                                    '';
                            }


                            if (!serviceId) return;


                            if (persyaContainer) {
                                persyaContainer.classList.remove(
                                    'd-none'
                                );
                            }


                            if (persyaContent) {

                                persyaContent.innerHTML = `
                                    <div class="text-center py-3 text-muted">
                                        <i class="fas fa-spinner fa-spin me-2"></i>
                                        Memuat persyaratan layanan...
                                    </div>
                                `;
                            }


                            try {

                                const response =
                                    await fetch(
                                        '<?= base_url('guest-report/requirements') ?>/' +
                                        encodeURIComponent(
                                            serviceId
                                        ),
                                        {
                                            method: 'GET',

                                            headers: {
                                                'X-Requested-With':
                                                    'XMLHttpRequest',

                                                'Accept':
                                                    'application/json'
                                            },

                                            credentials:
                                                'same-origin'
                                        }
                                    );


                                if (!response.ok) {
                                    throw new Error(
                                        'HTTP ' +
                                        response.status
                                    );
                                }


                                const result =
                                    await response.json();


                                if (
                                    result.status !==
                                        'success' ||
                                    !Array.isArray(
                                        result.data
                                    ) ||
                                    result.data.length ===
                                        0
                                ) {

                                    if (persyaContainer) {
                                        persyaContainer.classList.add(
                                            'd-none'
                                        );
                                    }

                                    if (persyaContent) {
                                        persyaContent.innerHTML =
                                            '';
                                    }

                                    return;
                                }


                                let html = '';


                                result.data.forEach(
                                    (item, index) => {

                                        const name =
                                            item.name ??
                                            item.requirement_name ??
                                            item.nama ??
                                            `Persyaratan ${index + 1}`;


                                        const description =
                                            item.description ??
                                            item.keterangan ??
                                            '';


                                        const required =
                                            item.is_required ===
                                                true ||
                                            item.is_required ===
                                                1 ||
                                            item.is_required ===
                                                '1';


                                        const rawExtensions =
                                            item.allowed_extensions ??
                                            item.allowed_file_types ??
                                            'pdf,jpg,jpeg,png';


                                        const extensions =
                                            rawExtensions
                                                .split(',')
                                                .map(
                                                    ext =>
                                                        ext.trim()
                                                )
                                                .filter(
                                                    Boolean
                                                )
                                                .map(
                                                    ext =>
                                                        ext.startsWith(
                                                            '.'
                                                        )
                                                            ? ext
                                                            : '.' +
                                                              ext
                                                )
                                                .join(',');


                                        const maxFileSize =
                                            Number(
                                                item.max_file_size ??
                                                0
                                            );


                                        const maxFileSizeText =
                                            maxFileSize >
                                            0
                                                ? (
                                                    maxFileSize >=
                                                    1024
                                                        ? (
                                                            maxFileSize /
                                                            1024
                                                        ).toFixed(
                                                            maxFileSize %
                                                                1024 ===
                                                                0
                                                                ? 0
                                                                : 1
                                                        ) +
                                                          ' MB'
                                                        : maxFileSize +
                                                          ' KB'
                                                )
                                                : '';


                                        const inputName =
                                            'syarat_' +
                                            (
                                                item.id ??
                                                index
                                            );


                                        html += `
                                            <div class="mb-3 p-3 border rounded bg-light">

                                                <label class="form-label fw-semibold">
                                                    <i class="fas fa-paperclip me-1"></i>

                                                    ${name}

                                                    ${
                                                        required
                                                            ? '<span class="text-danger">*</span>'
                                                            : '<span class="text-muted">(opsional)</span>'
                                                    }
                                                </label>


                                                ${
                                                    description
                                                        ? `
                                                            <div class="small text-muted mb-2">
                                                                ${description}
                                                            </div>
                                                        `
                                                        : ''
                                                }


                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    name="${inputName}"
                                                    ${
                                                        required
                                                            ? 'required'
                                                            : ''
                                                    }
                                                    accept="${extensions}"
                                                >


                                                <div class="small text-muted mt-1">

                                                    ${
                                                        extensions
                                                            ? 'Format: ' +
                                                              extensions
                                                                  .split(',')
                                                                  .map(
                                                                      ext =>
                                                                          ext.toUpperCase()
                                                                  )
                                                                  .join(
                                                                      ', '
                                                                  )
                                                            : ''
                                                    }

                                                    ${
                                                        maxFileSizeText
                                                            ? ' • Maks. ' +
                                                              maxFileSizeText
                                                            : ''
                                                    }

                                                </div>

                                            </div>
                                        `;
                                    }
                                );


                                if (persyaContent) {
                                    persyaContent.innerHTML =
                                        html;
                                }

                            } catch (error) {

                                console.error(
                                    'Gagal mengambil persyaratan:',
                                    error
                                );

                                if (persyaContent) {

                                    persyaContent.innerHTML = `
                                        <div class="alert alert-warning mb-0">
                                            Persyaratan layanan gagal dimuat.
                                        </div>
                                    `;
                                }
                            }
                        }
                    );
                }
            );
        }


        /* =====================================================
         * FILTER DAN PENCARIAN DATA TIKET
         * ===================================================== */
        const quickSearchInput =
            document.getElementById(
                'quickSearchInput'
            );

        const filterStatusModal =
            document.getElementById(
                'filterStatusModal'
            );

        const filterLayananModal =
            document.getElementById(
                'filterLayananModal'
            );

        const resetFilterBtn =
            document.getElementById(
                'resetFilterBtn'
            );

        const totalDataBadge =
            document.getElementById(
                'totalDataBadge'
            );

        const tableBody =
            document.getElementById(
                'tamuTableBody'
            );


        function applyTicketFilter() {

            if (!tableBody) return;


            const searchValue =
                (
                    quickSearchInput?.value ||
                    ''
                )
                    .trim()
                    .toLowerCase();


            const statusValue =
                (
                    filterStatusModal?.value ||
                    ''
                )
                    .trim()
                    .toLowerCase();


            const layananValue =
                (
                    filterLayananModal?.value ||
                    ''
                )
                    .trim()
                    .toLowerCase();


            const rows =
                tableBody.querySelectorAll(
                    'tr'
                );


            let visibleCount = 0;


            rows.forEach(row => {

                if (
                    row.id ===
                    'tabelEmptyState'
                ) {
                    return;
                }


                const nomorTiket =
                    (
                        row.getAttribute(
                            'data-notiket'
                        ) ||
                        ''
                    ).toLowerCase();


                const nama =
                    (
                        row.getAttribute(
                            'data-nama'
                        ) ||
                        ''
                    ).toLowerCase();


                const layanan =
                    (
                        row.getAttribute(
                            'data-layanan'
                        ) ||
                        ''
                    ).toLowerCase();


                const status =
                    (
                        row.getAttribute(
                            'data-status'
                        ) ||
                        ''
                    ).toLowerCase();


                const cocokSearch =
                    !searchValue ||
                    nomorTiket.includes(
                        searchValue
                    ) ||
                    nama.includes(
                        searchValue
                    );


                const cocokStatus =
                    !statusValue ||
                    status === statusValue ||
                    status.replace(
                        '_',
                        ' '
                    ) === statusValue;


                const cocokLayanan =
                    !layananValue ||
                    layanan === layananValue;


                const tampil =
                    cocokSearch &&
                    cocokStatus &&
                    cocokLayanan;


                row.style.display =
                    tampil ? '' : 'none';


                if (tampil) {
                    visibleCount++;
                }
            });


            if (totalDataBadge) {
                totalDataBadge.textContent =
                    visibleCount + ' Tiket';
            }


            const emptyState =
                document.getElementById(
                    'tabelEmptyState'
                );


            if (emptyState) {

                emptyState.style.display =
                    visibleCount === 0
                        ? ''
                        : 'none';
            }
        }


        /* =====================================================
         * FILTER LAYANAN
         * ===================================================== */
        function populateLayananFilter() {

            if (
                !filterLayananModal ||
                !tableBody
            ) {
                return;
            }


            const currentValue =
                filterLayananModal.value;


            const layananMap =
                new Map();


            tableBody
                .querySelectorAll('tr')
                .forEach(row => {

                    if (
                        row.id ===
                        'tabelEmptyState'
                    ) {
                        return;
                    }


                    const layanan =
                        (
                            row.getAttribute(
                                'data-layanan'
                            ) ||
                            ''
                        ).trim();


                    if (layanan) {

                        const key =
                            layanan.toLowerCase();


                        if (
                            !layananMap.has(
                                key
                            )
                        ) {
                            layananMap.set(
                                key,
                                layanan
                            );
                        }
                    }
                });


            filterLayananModal.innerHTML = `
                <option value="">
                    -- Semua Layanan --
                </option>
            `;


            [...layananMap.values()]
                .sort(
                    (a, b) =>
                        a.localeCompare(
                            b,
                            'id'
                        )
                )
                .forEach(layanan => {

                    const option =
                        document.createElement(
                            'option'
                        );

                    option.value =
                        layanan.toLowerCase();

                    option.textContent =
                        layanan;

                    filterLayananModal.appendChild(
                        option
                    );
                });


            if (
                currentValue &&
                [...filterLayananModal.options]
                    .some(
                        option =>
                            option.value ===
                            currentValue
                    )
            ) {
                filterLayananModal.value =
                    currentValue;
            }
        }


        /* =====================================================
         * EVENT FILTER
         * ===================================================== */
        quickSearchInput?.addEventListener(
            'input',
            applyTicketFilter
        );


        filterStatusModal?.addEventListener(
            'change',
            applyTicketFilter
        );


        filterLayananModal?.addEventListener(
            'change',
            applyTicketFilter
        );


        resetFilterBtn?.addEventListener(
            'click',
            function () {

                if (quickSearchInput) {
                    quickSearchInput.value =
                        '';
                }


                if (filterStatusModal) {
                    filterStatusModal.value =
                        '';
                }


                if (filterLayananModal) {
                    filterLayananModal.value =
                        '';
                }


                applyTicketFilter();


                closeModal(
                    'modalCariTiket'
                );
            }
        );


        populateLayananFilter();
        applyTicketFilter();


        /* =====================================================
         * DETAIL TIKET
         * ===================================================== */
        document
            .querySelectorAll(
                '.btn-detail-tamu'
            )
            .forEach(btn => {

                btn.addEventListener(
                    'click',
                    function () {

                        const setText =
                            (id, value) => {

                                const element =
                                    document.getElementById(
                                        id
                                    );

                                if (element) {
                                    element.innerText =
                                        value || '-';
                                }
                            };


                        setText(
                            'dispNoTiket',
                            this.getAttribute(
                                'data-notiket'
                            )
                        );

                        setText(
                            'dispNama',
                            this.getAttribute(
                                'data-nama'
                            )
                        );

                        setText(
                            'dispLayanan',
                            this.getAttribute(
                                'data-layanan'
                            )
                        );

                        setText(
                            'dispStatus',
                            this.getAttribute(
                                'data-status'
                            )
                        );

                        setText(
                            'dispEmail',
                            this.getAttribute(
                                'data-email'
                            )
                        );

                        setText(
                            'dispHp',
                            this.getAttribute(
                                'data-hp'
                            )
                        );

                        setText(
                            'dispInstansi',
                            this.getAttribute(
                                'data-instansi'
                            )
                        );

                        setText(
                            'dispTanggal',
                            this.getAttribute(
                                'data-tanggal'
                            )
                        );

                        setText(
                            'dispDeskripsi',
                            this.getAttribute(
                                'data-deskripsi'
                            )
                        );
                    }
                );
            });


        /* =====================================================
         * VERIFIKASI TIKET
         * ===================================================== */
        document
            .querySelectorAll(
                '.btn-verifikasi-tamu'
            )
            .forEach(btn => {

                btn.addEventListener(
                    'click',
                    function () {

                        const noTiket =
                            this.getAttribute(
                                'data-notiket'
                            ) || '-';


                        const field =
                            document.getElementById(
                                'verifNoTiket'
                            );


                        if (field) {
                            field.value =
                                noTiket;
                        }

                        /* UNIT OTOMATIS */
const unitId =
    this.getAttribute(
        'data-unit-id'
    ) || '';

const unitName =
    this.getAttribute(
        'data-unit-name'
    ) || '-';

const unitNameField =
    document.getElementById(
        'verifUnitName'
    );

const unitIdField =
    document.getElementById(
        'verifUnitId'
    );

if (unitNameField) {
    unitNameField.value =
        unitName;
}

if (unitIdField) {
    unitIdField.value =
        unitId;
}


                    }
                );
            });


       /* =====================================================
 * DISPOSISI TIKET
 * UNIT OTOMATIS SESUAI UNIT LAYANAN TIKET
 * ===================================================== */
document
    .querySelectorAll(
        '.btn-disposisi-tamu'
    )
    .forEach(btn => {

        btn.addEventListener(
            'click',
            function () {

                /* NOMOR TIKET */
                const noTiket =
                    this.getAttribute(
                        'data-notiket'
                    ) || '-';

                const field =
                    document.getElementById(
                        'dispNoTiketField'
                    );

                if (field) {
                    field.value =
                        noTiket;
                }


                /* UNIT OTOMATIS */
                const unitId =
                    this.getAttribute(
                        'data-unit-id'
                    ) || '';

                const unitName =
                    this.getAttribute(
                        'data-unit-name'
                    ) || '-';


                const unitNameField =
                    document.getElementById(
                        'dispUnitName'
                    );

                const unitIdField =
                    document.getElementById(
                        'dispUnitId'
                    );


                if (unitNameField) {
                    unitNameField.value =
                        unitName;
                }


                if (unitIdField) {
                    unitIdField.value =
                        unitId;
                }

            }
        );
    });

        /* =====================================================
         * EDIT TIKET
         * ===================================================== */
        document
            .querySelectorAll(
                '.btn-edit-tamu'
            )
            .forEach(btn => {

                btn.addEventListener(
                    'click',
                    function () {

                        const setValue =
                            (id, value) => {

                                const element =
                                    document.getElementById(
                                        id
                                    );

                                if (element) {
                                    element.value =
                                        value ?? '';
                                }
                            };


                        const ticketNumber =
                            this.getAttribute(
                                'data-notiket'
                            ) || '';


                        const nama =
                            this.getAttribute(
                                'data-nama'
                            ) || '';


                        const email =
                            this.getAttribute(
                                'data-email'
                            ) || '';


                        const hp =
                            this.getAttribute(
                                'data-hp'
                            ) || '';


                        const instansi =
                            this.getAttribute(
                                'data-instansi'
                            ) || '';


                        const unitId =
                            this.getAttribute(
                                'data-unit-id'
                            ) || '';


                        const deskripsi =
                            this.getAttribute(
                                'data-deskripsi'
                            ) || '';


                        /* DATA DASAR */
                        setValue(
                            'editNoTiket',
                            ticketNumber
                        );

                        setValue(
                            'editNama',
                            nama
                        );

                        setValue(
                            'editEmail',
                            email
                        );

                        setValue(
                            'editHp',
                            hp
                        );

                        setValue(
                            'editInstansi',
                            instansi
                        );

                        setValue(
                            'editDeskripsi',
                            deskripsi
                        );


                        /* LAYANAN */
                        const layananSelect =
                            document.getElementById(
                                'editLayanan'
                            );


                        if (layananSelect) {

                            layananSelect.value =
                                unitId;

                            if (
                                layananSelect.value !==
                                unitId
                            ) {
                                layananSelect.value =
                                    '';
                            }
                        }


                        /* SIMPAN ID TIKET */
                        const editTicketId =
                            document.getElementById(
                                'editTicketId'
                            );

                        if (editTicketId) {
                            editTicketId.value =
                                this.getAttribute(
                                    'data-id'
                                ) || '';
                        }
                    }
                );
            });


        /* =====================================================
         * SUBMIT EDIT TIKET
         * ===================================================== */
        const formEditTiket =
            document.getElementById(
                'formEditTiket'
            );

        if (formEditTiket) {

            formEditTiket.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();

                    const ticketId =
                        document.getElementById(
                            'editTicketId'
                        )?.value || '';

                    if (!ticketId) {
                        alert(
                            'ID tiket tidak ditemukan.'
                        );
                        return;
                    }

                    const formData =
                        new FormData(
                            formEditTiket
                        );

                    fetch(
                        '<?= base_url('guest-report/update') ?>/' +
                        ticketId,
                        {
                            method: 'POST',
                            body: formData
                        }
                    )
                    .then(response => {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal mengirim data edit tiket.'
                            );
                        }

                        window.location.reload();
                    })
                    .catch(error => {

                        console.error(
                            'Edit tiket error:',
                            error
                        );

                        alert(
                            'Gagal menyimpan perubahan tiket.'
                        );
                    });
                }
            );
        }


        /* =====================================================
         * SUBMIT VERIFIKASI TIKET
         * ===================================================== */
        document
            .querySelectorAll(
                '.btn-verifikasi-tamu'
            )
            .forEach(btn => {

                btn.addEventListener(
                    'click',
                    function () {

                        let ticketId =
                            this.getAttribute(
                                'data-id'
                            ) || '';

                        const form =
                            document.getElementById(
                                'formVerifikasiTamu'
                            );

                        if (form) {

                            let idField =
                                form.querySelector(
                                    '#verifTicketId'
                                );

                            if (!idField) {

                                idField =
                                    document.createElement(
                                        'input'
                                    );

                                idField.type =
                                    'hidden';

                                idField.id =
                                    'verifTicketId';

                                idField.name =
                                    'ticket_id';

                                form.appendChild(
                                    idField
                                );
                            }

                            idField.value =
                                ticketId;
                        }
                    }
                );
            });


        const formVerifikasiTamu =
            document.getElementById(
                'formVerifikasiTamu'
            );

        if (formVerifikasiTamu) {

            formVerifikasiTamu.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();

                    const ticketId =
                        document.getElementById(
                            'verifTicketId'
                        )?.value || '';

                    const statusSelect =
                        document.getElementById(
                            'verifStatusSelect'
                        );

                    const prioritas =
                        document.getElementById(
                            'verifPrioritas'
                        );

                    if (!ticketId) {
                        alert(
                            'ID tiket tidak ditemukan.'
                        );
                        return;
                    }

                    if (
                        !statusSelect ||
                        !statusSelect.value
                    ) {
                        alert(
                            'Hasil verifikasi wajib dipilih.'
                        );
                        return;
                    }

                    if (
                        !prioritas ||
                        !prioritas.value
                    ) {
                        alert(
                            'Prioritas wajib dipilih.'
                        );
                        return;
                    }

                    const statusMap = {
                        'Verified': 'verify',
                        'Need Revision': 'revision',
                        'Rejected': 'reject'
                    };

                   const formData = new FormData(formVerifikasiTamu);
formData.delete('assigned_to');
formData.set('hasil_verifikasi', statusMap[statusSelect.value] || '');

                    formData.set(
                        'priority',
                        prioritas.value
                    );

                   
                    const catatan =
                        formVerifikasiTamu.querySelector(
                            'textarea'
                        )?.value || '';

                    if (catatan) {
                        formData.set(
                            'catatan_verifikasi',
                            catatan
                        );
                    }

                    fetch(
                        '<?= base_url('verification/process') ?>/' +
                        ticketId,
                        {
                            method: 'POST',
                            body: formData
                        }
                    )
                    .then(response => {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal memproses verifikasi tiket.'
                            );
                        }

                        window.location.reload();
                    })
                    .catch(error => {

                        console.error(
                            'Verifikasi tiket error:',
                            error
                        );

                        alert(
                            'Gagal memproses verifikasi tiket.'
                        );
                    });
                }
            );
        }


        /* =====================================================
         * SUBMIT DISPOSISI TIKET
         * ===================================================== */
        document
            .querySelectorAll(
                '.btn-disposisi-tamu'
            )
            .forEach(btn => {

                btn.addEventListener(
                    'click',
                    function () {

                        const ticketId =
                            this.getAttribute(
                                'data-id'
                            ) || '';

                        const form =
                            document.getElementById(
                                'formDisposisiTamu'
                            );

                        if (form) {

                            let idField =
                                form.querySelector(
                                    '#dispTicketId'
                                );

                            if (!idField) {

                                idField =
                                    document.createElement(
                                        'input'
                                    );

                                idField.type =
                                    'hidden';

                                idField.id =
                                    'dispTicketId';

                                idField.name =
                                    'ticket_id';

                                form.appendChild(
                                    idField
                                );
                            }

                            idField.value =
                                ticketId;
                        }
                    }
                );
            });


        const formDisposisiTamu =
            document.getElementById(
                'formDisposisiTamu'
            );

        if (formDisposisiTamu) {

            formDisposisiTamu.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();

                    const ticketId =
                        document.getElementById(
                            'dispTicketId'
                        )?.value || '';

                    if (!ticketId) {
                        alert(
                            'ID tiket tidak ditemukan.'
                        );
                        return;
                    }

                    const formData =
                        new FormData(
                            formDisposisiTamu
                        );

                    fetch(
                        '<?= base_url('disposition/process') ?>/' +
                        ticketId,
                        {
                            method: 'POST',
                            body: formData
                        }
                    )
                    .then(response => {

                        if (!response.ok) {
                            throw new Error(
                                'Gagal memproses disposisi tiket.'
                            );
                        }

                        window.location.reload();
                    })
                    .catch(error => {

                        console.error(
                            'Disposisi tiket error:',
                            error
                        );

                        alert(
                            'Gagal memproses disposisi tiket.'
                        );
                    });
                }
            );
        }


        /* =====================================================
         * HAPUS TIKET
         * ===================================================== */
        document
            .querySelectorAll(
                '.btn-delete-tamu'
            )
            .forEach(btn => {

                btn.addEventListener(
                    'click',
                    function () {

                        const ticketId =
                            this.getAttribute(
                                'data-id'
                            ) || '';


                        const noTiket =
                            this.getAttribute(
                                'data-notiket'
                            ) || '-';


                        const nama =
                            this.getAttribute(
                                'data-nama'
                            ) || '-';


                        /* ID TIKET */
                        const idField =
                            document.getElementById(
                                'deleteTicketId'
                            );


                        if (idField) {
                            idField.value =
                                ticketId;
                        }


                        /* NOMOR TIKET */
                        const noTiketSpan =
                            document.getElementById(
                                'deleteNoTiketSpan'
                            );


                        if (noTiketSpan) {
                            noTiketSpan.textContent =
                                noTiket;
                        }


                        /* NAMA PEMOHON */
                        const namaSpan =
                            document.getElementById(
                                'deleteNamaSpan'
                            );


                        if (namaSpan) {
                            namaSpan.textContent =
                                nama;
                        }


                        console.log(
                            'Tiket yang akan dihapus:',
                            {
                                id: ticketId,
                                nomor: noTiket,
                                nama: nama
                            }
                        );
                    }
                );
            });


        /* =====================================================
         * KONFIRMASI HAPUS TIKET
         * ===================================================== */
        const confirmDeleteBtn =
            document.getElementById(
                'confirmDeleteBtn'
            );

        if (confirmDeleteBtn) {

            confirmDeleteBtn.addEventListener(
                'click',
                function () {

                    const ticketId =
                        document.getElementById(
                            'deleteTicketId'
                        )?.value || '';

                    if (!ticketId) {
                        alert(
                            'ID tiket tidak ditemukan.'
                        );
                        return;
                    }

                    window.location.href =
                        '<?= base_url('guest-report/delete') ?>/' +
                        ticketId;
                }
            );
        }

    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addDeskripsi = document.getElementById('addDeskripsi');
    const charCount = document.getElementById('charCount');

    if (addDeskripsi && charCount) {
        const updateCharCount = function () {
            charCount.textContent = addDeskripsi.value.length + ' / 500 Karakter';
        };

        addDeskripsi.addEventListener('input', updateCharCount);
        updateCharCount();
    }
});
</script>

<?= $this->endSection() ?>