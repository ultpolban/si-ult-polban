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

                <div class="col-xl-6 col-lg-6 col-md-12 d-flex align-items-center justify-content-md-end gap-2 flex-wrap mt-2 mt-lg-0">
                    <div class="text-muted fw-semibold me-2" style="font-size: 0.85rem;">
                        Total Data: <span id="totalDataBadge" class="badge bg-primary text-white fs-6 ms-1 px-2 py-1" style="border-radius: 8px;">8 Tiket</span>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-export-laporan d-flex align-items-center gap-2 shadow-sm dropdown-toggle" type="button" id="dropdownExportLaporan" data-bs-toggle="dropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            <span>Export Laporan</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end export-dropdown-menu" aria-labelledby="dropdownExportLaporan">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel text-success"></i> Export Excel</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf text-danger"></i> Export PDF</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv text-primary"></i> Export CSV</a></li>
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
                                <td><div class="ticket-name cell-nama"><?= $d[1] ?></div></td>
                                <td><span class="ticket-category cell-layanan"><?= $d[2] ?></span></td>
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
                                <td><div class="ticket-date cell-tanggal"><?= $d[4] ?></div></td>
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

            <form id="formTambahTamu" action="<?= base_url('laporantamu/store') ?>" method="POST" enctype="multipart/form-data">
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
                            <div id="dynamicFormContainer" class="row g-3"></div>
                        </div>

                        <div class="col-12">
                            <label class="offline-form-label">
                                KETERANGAN / DESKRIPSI KEPERLUAN <span class="required">*</span>
                            </label>
                            <textarea id="addDeskripsi" name="deskripsi" class="offline-textarea modal-input-field" placeholder="Tuliskan detail permohonan atau keperluan tamu di sini..." maxlength="500" required style="padding-left: 16px !important;"></textarea>
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
            const instance = bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl);
            if (instance) instance.hide();
        }
        if (window.jQuery && typeof window.jQuery.fn.modal === 'function') {
            window.jQuery('#' + modalId).modal('hide');
        }
    }

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

        setTimeout(() => { toastElement.classList.add('show'); }, 50);
        setTimeout(() => {
            toastElement.classList.remove('show');
            setTimeout(() => { toastElement.remove(); }, 400);
        }, 3800);
    }

    function copyNoTiket(element, noTiket) {
        navigator.clipboard.writeText(noTiket).then(() => {
            showToast('Nomor Tiket Disalin!', `Nomor ${noTiket} berhasil disalin ke clipboard.`, 'success');
        }).catch(err => {
            showToast('Gagal Menyalin', 'Terjadi kesalahan saat menyalin nomor tiket.', 'danger');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            document.querySelectorAll('.reveal-item').forEach(item => {
                item.classList.add('show');
            });
        }, 100);

        document.querySelectorAll('[data-bs-toggle="modal"], [data-toggle="modal"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target') || this.getAttribute('data-target');
                if (!target) return;

                if (window.bootstrap && bootstrap.Modal) {
                    const modalEl = document.querySelector(target);
                    if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).show();
                }
                if (window.jQuery && typeof window.jQuery.fn.modal === 'function') {
                    window.jQuery(target).modal('show');
                }
            });
        });

        document.querySelectorAll('[data-bs-dismiss="modal"], [data-dismiss="modal"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const modalEl = this.closest('.modal');
                if (!modalEl) return;
                closeModal(modalEl.id);
            });
        });

        // DYNAMIC FORM BUILDER
        const jenisPemohonSelect = document.getElementById('addJenisPemohon');
        const dynamicContainer = document.getElementById('dynamicFormContainer');

        if (jenisPemohonSelect && dynamicContainer) {
            jenisPemohonSelect.addEventListener('change', function() {
                const val = this.value;
                let htmlContent = '';

                if (val === 'Mahasiswa') {
                    htmlContent = `
                        <div class="col-md-6">
                            <label class="offline-form-label">NAMA LENGKAP <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-user offline-input-icon"></i>
                                <input type="text" name="nama" class="offline-input" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">KELAS / ANGKATAN <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-users offline-input-icon"></i>
                                <input type="text" name="kelas" class="offline-input" placeholder="Contoh: 3A / 2023" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">EMAIL <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-envelope offline-input-icon"></i>
                                <input type="email" name="email" class="offline-input" placeholder="email@student.polban.ac.id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">NO. WHATSAPP / HP <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-phone offline-input-icon"></i>
                                <input type="text" name="hp" class="offline-input" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card border shadow-sm rounded-3">
                                <div class="card-header bg-primary text-white fw-bold py-2 px-3">
                                    <i class="fas fa-list-ul me-2"></i> Pilih Layanan
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="offline-form-label">Unit Layanan <span class="required">*</span></label>
                                            <select id="addUnitLayanan" name="unit_layanan" class="offline-select" required style="padding-left: 16px !important;">
                                                <option value="" selected disabled>-- Pilih Unit Layanan --</option>
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
                                        <div class="col-md-4" id="wrapperJurusan" style="display: none;">
                                            <label class="offline-form-label">Jurusan <span class="required">*</span></label>
                                            <select id="addJurusan" name="jurusan" class="offline-select" style="padding-left: 16px !important;">
                                                <option value="" selected disabled>-- Pilih Jurusan --</option>
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
                                        <div class="col-md-4" id="wrapperJenisLayananCol">
                                            <label class="offline-form-label">Jenis Layanan <span class="required">*</span></label>
                                            <select id="addJenisLayanan" name="jenis_layanan" class="offline-select" disabled required style="padding-left: 16px !important;">
                                                <option value="" selected disabled>-- Pilih Jenis Layanan --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="persyaratanContainer" class="mt-4 d-none">
                                        <div class="fw-bold text-dark mb-1" style="font-size: 0.92rem;">
                                            <i class="fas fa-clipboard-list me-1"></i> Persyaratan Layanan
                                        </div>
                                        <p class="text-muted small mb-3">Silakan upload dokumen sesuai persyaratan layanan yang dipilih.</p>
                                        <div id="persyaratanContent"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else if (val) {
                    htmlContent = `
                        <div class="col-md-6">
                            <label class="offline-form-label">NAMA LENGKAP <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-user offline-input-icon"></i>
                                <input type="text" name="nama" class="offline-input" placeholder="Masukkan Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">INSTANSI / UNIT ASAL <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-building offline-input-icon"></i>
                                <input type="text" name="instansi" class="offline-input" placeholder="Masukkan Instansi / Perusahaan" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">NO. WHATSAPP / HP <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-phone offline-input-icon"></i>
                                <input type="text" name="hp" class="offline-input" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="offline-form-label">EMAIL <span class="required">*</span></label>
                            <div class="offline-input-group">
                                <i class="fas fa-envelope offline-input-icon"></i>
                                <input type="email" name="email" class="offline-input" placeholder="email@domain.com" required>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card border shadow-sm rounded-3">
                                <div class="card-header bg-primary text-white fw-bold py-2 px-3">
                                    <i class="fas fa-list-ul me-2"></i> Pilih Layanan
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="offline-form-label">Unit Layanan <span class="required">*</span></label>
                                            <select id="addUnitLayanan" name="unit_layanan" class="offline-select" required style="padding-left: 16px !important;">
                                                <option value="" selected disabled>-- Pilih Unit Layanan --</option>
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
                                        <div class="col-md-4" id="wrapperJurusan" style="display: none;">
                                            <label class="offline-form-label">Jurusan <span class="required">*</span></label>
                                            <select id="addJurusan" name="jurusan" class="offline-select" style="padding-left: 16px !important;">
                                                <option value="" selected disabled>-- Pilih Jurusan --</option>
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
                                        <div class="col-md-4" id="wrapperJenisLayananCol">
                                            <label class="offline-form-label">Jenis Layanan <span class="required">*</span></label>
                                            <select id="addJenisLayanan" name="jenis_layanan" class="offline-select" disabled required style="padding-left: 16px !important;">
                                                <option value="" selected disabled>-- Pilih Jenis Layanan --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="persyaratanContainer" class="mt-4 d-none">
                                        <div class="fw-bold text-dark mb-1" style="font-size: 0.92rem;">
                                            <i class="fas fa-clipboard-list me-1"></i> Persyaratan Layanan
                                        </div>
                                        <p class="text-muted small mb-3">Silakan upload dokumen sesuai persyaratan layanan yang dipilih.</p>
                                        <div id="persyaratanContent"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
                dynamicContainer.innerHTML = htmlContent;
                initLayananDropdownEvents();
            });
        }

        function initLayananDropdownEvents() {
            const unitSelect = document.getElementById('addUnitLayanan');
            const wrapperJurusan = document.getElementById('wrapperJurusan');
            const wrapperJenisLayananCol = document.getElementById('wrapperJenisLayananCol');
            const jurusanSelect = document.getElementById('addJurusan');
            const jenisSelect = document.getElementById('addJenisLayanan');
            const persyaContainer = document.getElementById('persyaratanContainer');
            const persyaContent = document.getElementById('persyaratanContent');

            if (!unitSelect || !jenisSelect) return;

            unitSelect.addEventListener('change', function() {
                const selectedUnit = this.value;
                jenisSelect.innerHTML = '<option value="" selected disabled>-- Pilih Jenis Layanan --</option>';
                persyaContainer.classList.add('d-none');
                persyaContent.innerHTML = '';

                // Handle Jurusan option visibility
                if (selectedUnit === 'Jurusan') {
                    if (wrapperJurusan) wrapperJurusan.style.display = 'block';
                    if (jurusanSelect) jurusanSelect.required = true;
                    if (wrapperJenisLayananCol) {
                        wrapperJenisLayananCol.className = 'col-md-4';
                    }
                } else {
                    if (wrapperJurusan) {
                        wrapperJurusan.style.display = 'none';
                        if (jurusanSelect) {
                            jurusanSelect.required = false;
                            jurusanSelect.value = '';
                        }
                    }
                    if (wrapperJenisLayananCol) {
                        wrapperJenisLayananCol.className = 'col-md-6';
                    }
                }

                if (selectedUnit === 'Bagian Keuangan') {
                    jenisSelect.disabled = false;
                    const options = [
                        'Pengajuan Keringanan UKT',
                        'Pengembalian Dana / Refund UKT',
                        'Surat Keterangan Bebas Tanggungan Keuangan',
                        'Klarifikasi / Konsultasi Pembayaran UKT',
                        'Permohonan Rincian Pembayaran Biaya Kuliah',
                        'Validasi Bukti Pembayaran / Slip Ganda',
                        'Layanan Keuangan Lainnya'
                    ];
                    options.forEach(opt => {
                        const optionEl = document.createElement('option');
                        optionEl.value = opt;
                        optionEl.textContent = opt;
                        jenisSelect.appendChild(optionEl);
                    });
                } else if (selectedUnit === 'Bagian Kemahasiswaan') {
                    jenisSelect.disabled = false;
                    const options = [
                        'Surat Rekomendasi Beasiswa',
                        'Persetujuan Kegiatan Organisasi Mahasiswa',
                        'Surat Keterangan Berkelakuan Baik',
                        'Surat Rekomendasi Lomba/Kompetisi',
                        'Pengajuan Bantuan Biaya Pendidikan',
                        'Klaim Asuransi Kecelakaan Mahasiswa',
                        'Surat Keterangan Bebas Kompen/Pustaka',
                        'Legalisasi SK/Sertifikat Prestasi'
                    ];
                    options.forEach(opt => {
                        const optionEl = document.createElement('option');
                        optionEl.value = opt;
                        optionEl.textContent = opt;
                        jenisSelect.appendChild(optionEl);
                    });
                } else if (selectedUnit === 'Bagian Akademik') {
                    jenisSelect.disabled = false;
                    const options = [
                        'Surat Keterangan Mahasiswa',
                        'Surat Keterangan Aktif Kuliah',
                        'Permohonan Daftar Nilai',
                        'Pengunduran Diri Mahasiswa',
                        'Pendaftaran Wisuda',
                        'Legalisasi Transkrip Nilai',
                        'Legalisasi Ijazah',
                        'Aktif Kembali Setelah Cuti',
                        'Administrasi Yudisium'
                    ];
                    options.forEach(opt => {
                        const optionEl = document.createElement('option');
                        optionEl.value = opt;
                        optionEl.textContent = opt;
                        jenisSelect.appendChild(optionEl);
                    });
                } else if (selectedUnit === 'Administrasi Umum') {
                    jenisSelect.disabled = false;
                    const options = [
                        'Layanan Surat Masuk dan Keluar',
                        'Peminjaman Ruangan',
                        'Peminjaman Sarana dan Prasarana'
                    ];
                    options.forEach(opt => {
                        const optionEl = document.createElement('option');
                        optionEl.value = opt;
                        optionEl.textContent = opt;
                        jenisSelect.appendChild(optionEl);
                    });
                } else if (selectedUnit === 'UPT Teknologi Informasi dan Komunikasi') {
                    jenisSelect.disabled = false;
                    const options = [
                        'Reset Password Akun Mahasiswa',
                        'Perubahan Data Akun',
                        'Layanan Helpdesk TI',
                        'Aktivasi Email Institusi',
                        'Aktivasi Akun Mahasiswa',
                        'Akses WiFi Kampus'
                    ];
                    options.forEach(opt => {
                        const optionEl = document.createElement('option');
                        optionEl.value = opt;
                        optionEl.textContent = opt;
                        jenisSelect.appendChild(optionEl);
                    });
                } else if (selectedUnit === 'Perpustakaan') {
                    jenisSelect.disabled = false;
                    const options = [
                        'Usulan Pengadaan Buku',
                        'Penggantian Kartu Perpustakaan',
                        'Pendaftaran Anggota Perpustakaan',
                        'Pembayaran Denda Perpustakaan'
                    ];
                    options.forEach(opt => {
                        const optionEl = document.createElement('option');
                        optionEl.value = opt;
                        optionEl.textContent = opt;
                        jenisSelect.appendChild(optionEl);
                    });
                } else if (selectedUnit === 'Jurusan') {
                    jenisSelect.disabled = false;
                    const options = [
                        'Surat Keterangan Aktif Kuliah',
                        'Pengajuan Cuti Akademik',
                        'Permohonan Legalisir Ijazah/Transkrip',
                        'Konsultasi Akademik / Perwalian',
                        'Pengajuan Surat Pengantar Penelitian / PKL',
                        'Surat Keterangan Bebas Laboratorium / Bengkel',
                        'Pengambilan Ijazah / Transkrip',
                        'Layanan Administrasi Jurusan Lainnya'
                    ];
                    options.forEach(opt => {
                        const optionEl = document.createElement('option');
                        optionEl.value = opt;
                        optionEl.textContent = opt;
                        jenisSelect.appendChild(optionEl);
                    });
                } else {
                    jenisSelect.disabled = true;
                }
            });

            jenisSelect.addEventListener('change', function() {
                const selectedJenis = this.value;
                persyaContent.innerHTML = '';

                if (selectedJenis === 'Pengajuan Keringanan UKT') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Permohonan Keringanan UKT (Bermaterai)</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Surat permohonan resmi yang ditandatangani di atas meterai.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_surat_permohonan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted d-block mb-1" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Slip Gaji / Surat Keterangan Penghasilan Orang Tua</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Bukti slip gaji terbaru atau surat keterangan penghasilan dari kelurahan.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_slip_gaji" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted d-block mb-1" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">3. Foto Rumah Tempat Tinggal (Tampak Depan & Ruang Keluarga)</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Foto kondisi rumah pemohon saat ini.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_foto_rumah" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted d-block mb-1" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">4. Rekening Listrik / PBB Bulan Terakhir</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Bukti pembayaran tagihan listrik atau PBB.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_rekening_listrik" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted d-block mb-1" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">5. Kartu Tanda Mahasiswa (KTM) / Kartu Keluarga</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan KTM atau Kartu Keluarga (KK).</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_ktm_kk" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted d-block mb-1" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Pengembalian Dana / Refund UKT') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Bukti Pembayaran Ganda / Berlebih</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Lampiran bukti transaksi pembayaran.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_bukti_bayar" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Buku Rekening atas Nama Mahasiswa</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan halaman depan buku rekening.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_rekening" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Keterangan Bebas Tanggungan Keuangan') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Kartu Tanda Mahasiswa (KTM)</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan KTM aktif.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Klarifikasi / Konsultasi Pembayaran UKT') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Bukti Transaksi Bank</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Bukti transaksi kendala pembayaran.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_transaksi" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Permohonan Rincian Pembayaran Biaya Kuliah') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Kartu Tanda Mahasiswa (KTM)</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan KTM.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Validasi Bukti Pembayaran / Slip Ganda') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Bukti Transfer / Pembayaran Bank</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Struk atau bukti pembayaran valid.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_bukti_transfer" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Layanan Keuangan Lainnya') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Dokumen Pendukung Keperluan Keuangan</span>
                                <span class="badge bg-secondary">Opsional</span>
                            </div>
                            <small class="text-muted d-block mb-2">Upload dokumen pendukung terkait.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_pendukung" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Rekomendasi Beasiswa') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Permohonan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Permohonan surat rekomendasi.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_surat_permohonan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted mt-1 d-block" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Persetujuan Kegiatan Organisasi Mahasiswa') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Proposal Kegiatan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Proposal kegiatan organisasi.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_proposal" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted d-block mb-1" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Susunan Panitia</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Daftar panitia kegiatan.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_susunan_panitia" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted d-block mb-1" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Keterangan Berkelakuan Baik') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Pengantar dari Jurusan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Surat pengantar resmi.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_pengantar_jurusan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Rekomendasi Lomba/Kompetisi') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Proposal/Brosur Lomba</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Informasi kegiatan perlombaan.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_brosur_lomba" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Pengajuan Bantuan Biaya Pendidikan') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Permohonan Bantuan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Surat permohonan resmi.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_surat_permohonan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Slip Pendapatan Orang Tua</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Bukti penghasilan orang tua.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_slip_gaji" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Klaim Asuransi Kecelakaan Mahasiswa') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Keterangan Kecelakaan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Surat keterangan dari rumah sakit/kepolisian.</small>
                            <div class="offline-file-box mb-2">
                                <input type="file" name="syarat_ket_kecelakaan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Keterangan Bebas Kompen/Pustaka') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Bukti Bebas Pustaka/Kompen</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Lampiran bukti valid.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_bebas_kompen" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Legalisasi SK/Sertifikat Prestasi') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Scan Sertifikat Asli</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Sertifikat atau SK prestasi.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_sertifikat" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Keterangan Mahasiswa') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan KTM.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. KRS</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">KRS aktif.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_krs" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Keterangan Aktif Kuliah') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan KTM.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. KRS Semester Berjalan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan KRS.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_krs" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Permohonan Daftar Nilai') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Scan KTM.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Legalisasi Transkrip Nilai') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Scan Transkrip</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Transkrip nilai.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_transkrip" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Legalisasi Ijazah') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Scan Ijazah</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Ijazah asli.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_ijazah" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. KTP</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Identitas.</small>
                            <div class="offline-file-box">
                                <input type="file" name="syarat_ktp" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Layanan Surat Masuk dan Keluar') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Draft Surat</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-2">Draft surat yang akan diproses.</small>
                            <div class="offline-file-box">
                                <input type="file" name="file_draft_surat" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            </div>
                        </div>
                    `;
                } else if (selectedJenis === 'Peminjaman Ruangan') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Permohonan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Surat peminjaman ruangan.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_surat_permohonan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Proposal Kegiatan</span>
                                <span class="badge bg-secondary">Opsional</span>
                            </div>
                            <small class="text-muted d-block mb-1">Proposal kegiatan (jika ada).</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_proposal_kegiatan" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Peminjaman Sarana dan Prasarana') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Permohonan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Surat permohonan peminjaman.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_surat_permohonan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Reset Password Akun Mahasiswa') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KTM.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Perubahan Data Akun') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. KTP / KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Identitas pemohon.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_identitas" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Layanan Helpdesk TI') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Screenshot Kendala</span>
                                <span class="badge bg-secondary">Opsional</span>
                            </div>
                            <small class="text-muted d-block mb-1">Screenshot error (opsional).</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_screenshot" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Aktivasi Email Institusi' || selectedJenis === 'Aktivasi Akun Mahasiswa' || selectedJenis === 'Akses WiFi Kampus') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KTM.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Usulan Pengadaan Buku') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Form Usulan Buku</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Form usulan pengadaan buku.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_usulan_buku" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Penggantian Kartu Perpustakaan') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Kehilangan (Jika Hilang)</span>
                                <span class="badge bg-secondary">Opsional</span>
                            </div>
                            <small class="text-muted d-block mb-1">Surat kehilangan dari kepolisian (opsional jika hilang).</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_surat_kehilangan" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KTM.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Pendaftaran Anggota Perpustakaan') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. KTM</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KTM.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Pembayaran Denda Perpustakaan') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Bukti Pembayaran</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Upload bukti pembayaran denda.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="file_bukti_pembayaran" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Pengajuan Cuti Akademik') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Permohonan Cuti Akademik (Bermaterai)</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Surat permohonan cuti dari mahasiswa diketahui Orang Tua/Wali.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_surat_permohonan_cuti" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Surat Persetujuan Dosen Wali & Ketua Jurusan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Form rekomendasi persetujuan cuti.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_persetujuan_dosen_wali" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">3. Transkrip Nilai / Kartu Hasil Studi (KHS) Terakhir</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KHS semester sebelumnya.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_khs_terakhir" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">4. Bukti Lunas Pembayaran Administrasi/SPP Berjalan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Slip pembayaran kewajiban keuangan.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_lunas_spp" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Konsultasi Akademik / Perwalian') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Kartu Tanda Mahasiswa (KTM) / Kartu Rencana Studi (KRS)</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KTM atau KRS aktif.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_ktm_krs" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Pengajuan Surat Pengantar Penelitian / PKL') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Surat Balasan / Permohonan dari Instansi / Perusahaan Tujuan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Surat resmi tempat PKL/penelitian.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_surat_instansi" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Proposal Singkat / Rencana Kegiatan PKL / Penelitian</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Outline atau proposal penelitian/PKL.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_proposal_pkl" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">3. Kartu Tanda Mahasiswa (KTM) / Transkrip Sementara</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan identitas atau transkrip.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_ktm_transkrip" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Surat Keterangan Bebas Laboratorium / Bengkel') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Kartu Tanda Mahasiswa (KTM) / Bukti Penyerahan Alat</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KTM dan bukti bebas lab.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_ktm_lab" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Pengambilan Ijazah / Transkrip') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Kartu Tanda Mahasiswa (KTM) / Kartu Identitas (KTP)</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Scan KTP atau KTM.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_ktp_ktm" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">2. Bukti Bebas Pustaka / Kompensasi / Tanggungan Jurusan</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Surat keterangan bebas tanggungan.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_bebas_tanggungan" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">3. Kuesioner Tracer Study yang Telah Diisi</span>
                                <span class="badge bg-danger">Wajib</span>
                            </div>
                            <small class="text-muted d-block mb-1">Bukti selesai mengisi tracer study.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_tracer_study" required accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else if (selectedJenis === 'Layanan Administrasi Jurusan Lainnya') {
                    persyaContainer.classList.remove('d-none');
                    persyaContent.innerHTML = `
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">1. Kartu Tanda Mahasiswa (KTM) / Dokumen Pendukung Lainnya</span>
                                <span class="badge bg-secondary">Opsional</span>
                            </div>
                            <small class="text-muted d-block mb-1">Upload dokumen pendukung keperluan jurusan.</small>
                            <div class="offline-file-box mb-1">
                                <input type="file" name="syarat_pendukung_jurusan" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <small class="text-muted" style="font-size:0.75rem;">Format: PDF / JPG / JPEG / PNG</small>
                        </div>
                    `;
                } else {
                    persyaContainer.classList.add('d-none');
                }
            });
        }

        const descTextarea = document.getElementById('addDeskripsi');
        const charCount = document.getElementById('charCount');
        if (descTextarea && charCount) {
            descTextarea.addEventListener('input', function() {
                charCount.innerText = `${this.value.length} / 500 Karakter`;
            });
        }

        document.querySelectorAll('.btn-detail-tamu').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('dispNoTiket').innerText = this.getAttribute('data-notiket');
                document.getElementById('dispNama').innerText = this.getAttribute('data-nama');
                document.getElementById('dispLayanan').innerText = this.getAttribute('data-layanan');
                document.getElementById('dispStatus').innerText = this.getAttribute('data-status');
                document.getElementById('dispEmail').innerText = this.getAttribute('data-email');
                document.getElementById('dispHp').innerText = this.getAttribute('data-hp');
                document.getElementById('dispInstansi').innerText = this.getAttribute('data-instansi');
                document.getElementById('dispTanggal').innerText = this.getAttribute('data-tanggal');
                document.getElementById('dispDeskripsi').innerText = this.getAttribute('data-deskripsi');
            });
        });
    });
</script>

<?= $this->endSection() ?>