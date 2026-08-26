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

.ticket-page {
    animation: pageFadeIn .45s ease;
}

.ticket-title {
    color: var(--polban-navy);
    font-weight: 800;
    letter-spacing: -.4px;
}

.ticket-subtitle {
    color: #718096;
    font-size: .95rem;
}

.ticket-breadcrumb {
    font-size: .9rem;
}

.ticket-breadcrumb a {
    color: var(--polban-blue);
    text-decoration: none;
    font-weight: 600;
}

/* 4 CARD STATISTIK PERSIS DATA TIKET */
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

/* FILTER BOX & DROPDOWN PERSIS DATA TIKET */
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
.ticket-select:focus,
.ticket-number-input:focus {
    border-color: var(--polban-navy);
    box-shadow: 0 0 0 .18rem rgba(26,35,126,.12);
}

.ticket-select {
    height: 44px;
    border-radius: 8px;
    font-size: .9rem;
}

/* INPUT NUMBER DIATUR SENDIRI SESUAI FOTO 2 */
.ticket-number-input {
    height: 44px;
    border-radius: 8px;
    font-size: .9rem;
    border: 1px solid #ced4da;
    padding: 0.375rem 0.75rem;
    text-align: center;
    width: 100%;
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

.btn-export-green {
    background-color: #198754;
    border-color: #198754;
    color: #ffffff;
    font-weight: 700;
    border-radius: 8px;
    height: 44px;
    padding: 0 20px;
    transition: all 0.25s ease-in-out;
}

.btn-export-green:hover {
    background-color: #146c43;
    border-color: #13653f;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.35);
    transform: translateY(-1px);
}

.export-action-group {
    position: relative;
    z-index: 105 !important;
}

.export-dropdown {
    position: relative;
    display: inline-block;
    width: 100%;
}

.export-menu {
    display: none;
    position: absolute;
    right: 0;
    top: calc(100% + 8px);
    min-width: 210px;
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 6px 0;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
    z-index: 9999 !important;
}

.export-menu.show {
    display: block !important;
}

.export-menu .dropdown-item {
    display: flex;
    align-items: center;
    padding: 11px 15px;
    color: #212529;
    font-size: 0.9rem;
    text-decoration: none;
    white-space: nowrap;
    transition: background-color 0.2s ease;
}

.export-menu .dropdown-item:hover {
    background-color: #f5f7fa;
}

.export-menu .dropdown-item i {
    width: 22px;
    text-align: center;
}

/* TABEL PERSIS TAMPILAN FOTO 2 */
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
    background: var(--polban-navy);
}

.ticket-table thead th {
    color: #fff;
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
.status-completed { background: #d1e7dd; color: #0f5132; }
.status-rejected { background: #f8d7da; color: #842029; }

@keyframes pageFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
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
</style>

<div class="container-fluid px-4 py-4 ticket-page">
    <!-- Header Title & Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="ticket-title mb-1" style="font-size:1.75rem;">
                Laporan Tiket
            </h1>
            <p class="ticket-subtitle mb-0">
                Kelola, rekap, dan ekspor seluruh laporan data tiket permohonan layanan secara komprehensif.
            </p>
        </div>
        <nav aria-label="breadcrumb" class="ticket-breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('petugas') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active text-muted">Laporan Tiket</li>
            </ol>
        </nav>
    </div>

    <!-- 4 Kotak / Cards Statistik -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Total Tiket</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $total_tiket ?? 33 ?></h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-ticket-alt"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Menunggu Verifikasi</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $waiting_verification ?? 9 ?></h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-clock"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Terverifikasi</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $terverifikasi ?? 11 ?></h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-user-check"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Diproses / Disposisi</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $diproses ?? 7 ?></h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-cogs"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card Baris Tunggal -->
    <div class="card ticket-filter-card mb-4 reveal-item">
        <div class="card-body">
            <form action="" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class="input-group ticket-input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="keyword" class="form-control ticket-input" placeholder="Cari No Tiket, Nama, NIK..." value="<?= esc($keyword ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4">
                        <select name="status" class="form-control ticket-select">
                            <option value="">-- Semua Status --</option>
                            <option value="Submitted" <?= (isset($status) && $status == 'Submitted') ? 'selected' : '' ?>>Submitted</option>
                            <option value="Verified" <?= (isset($status) && $status == 'Verified') ? 'selected' : '' ?>>Verified</option>
                            <option value="Disposisi" <?= (isset($status) && $status == 'Disposisi') ? 'selected' : '' ?>>Disposisi</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4">
                        <select name="kategori" class="form-control ticket-select">
                            <option value="">-- Semua Kategori --</option>
                            <option value="Akademik" <?= (isset($kategori) && $kategori == 'Akademik') ? 'selected' : '' ?>>Akademik</option>
                            <option value="Keuangan" <?= (isset($kategori) && $kategori == 'Keuangan') ? 'selected' : '' ?>>Keuangan</option>
                            <option value="Kemahasiswaan" <?= (isset($kategori) && $kategori == 'Kemahasiswaan') ? 'selected' : '' ?>>Kemahasiswaan</option>
                        </select>
                    </div>

                    <!-- PENGATUR JUMLAH BARIS TIKET (SESUAI FOTO 2: SPINNER ANGKA UP/DOWN) -->
                    <div class="col-xl-1 col-lg-1 col-md-4">
                        <input type="number" name="limit" class="form-control ticket-number-input" min="1" max="500" value="<?= esc($limit ?? 10) ?>" title="Atur jumlah baris tiket">
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-ticket-filter flex-grow-1">
                                <i class="fas fa-filter mr-1"></i> Filter
                            </button>
                            <a href="<?= current_url() ?>" class="btn btn-ticket-reset" title="Reset Filter">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 export-action-group">
                        <div class="export-dropdown">
                            <button type="button" class="btn btn-export-green w-100 d-flex align-items-center justify-content-center" id="dropdownExport" onclick="toggleExportMenu(event)">
                                <i class="fas fa-download mr-2"></i> Export Laporan <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                            <div class="export-menu" id="exportMenu">
                                <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/excel') ?>"><i class="fas fa-file-excel mr-2" style="color:#0B8F4D;"></i> Export Excel</a>
                                <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/pdf') ?>"><i class="fas fa-file-pdf mr-2" style="color:#D93025;"></i> Export PDF</a>
                                <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/csv') ?>"><i class="fas fa-file-csv mr-2" style="color:#005BAC;"></i> Export CSV</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="card ticket-table-card reveal-item">
        <div class="ticket-table-header d-flex justify-content-between align-items-center">
            <div>
                <div class="ticket-table-title">
                    <i class="fas fa-list-alt me-2"></i> Data Laporan Tiket
                </div>
                <small class="text-muted">Total: <?= count($laporan_list ?? [1]) ?> Data</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table ticket-table align-middle">
                <thead>
                    <tr class="text-center">
                        <th style="width: 50px;">No</th>
                        <th>No Tiket</th>
                        <th>Nama Pemohon</th>
                        <th>Jenis Pemohon</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Prioritas</th>
                        <th>Tanggal Pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laporan_list)): ?>
                        <?php $no = 1; foreach ($laporan_list as $row): ?>
                            <tr class="text-center">
                                <td class="fw-bold text-muted"><?= $no++ ?></td>
                                <td>
                                    <a href="<?= base_url('petugas/tiket/detail/' . ($row['id'] ?? 1)) ?>" class="fw-bold text-decoration-none" style="color: var(--polban-blue);">
                                        <?= esc($row['nomor_tiket'] ?? $row['no_tiket']) ?>
                                    </a>
                                </td>
                                <td class="text-start fw-bold"><?= esc($row['nama_pemohon']) ?></td>
                                <td><span class="badge bg-light text-dark border px-2 py-1"><?= esc($row['jenis_pemohon'] ?? 'Mahasiswa') ?></span></td>
                                <td class="text-start"><?= esc($row['layanan']) ?></td>
                                <td>
                                    <?php 
                                        $st = strtolower($row['status'] ?? 'submitted');
                                        $statusClass = 'status-submitted';
                                        if ($st === 'verified') $statusClass = 'status-verified';
                                        elseif ($st === 'disposisi' || $st === 'in progress') $statusClass = 'status-disposisi';
                                        elseif ($st === 'completed') $statusClass = 'status-completed';
                                        elseif ($st === 'rejected') $statusClass = 'status-rejected';
                                    ?>
                                    <span class="ticket-status <?= $statusClass ?>">
                                        <?= esc($row['status'] ?? 'Submitted') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1"><?= esc($row['prioritas'] ?? 'Normal') ?></span>
                                </td>
                                <td class="text-muted" style="font-size: 0.85rem;">
                                    <?= date('d-m-Y', strtotime($row['created_at'] ?? '2026-07-30')) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="text-center">
                            <td class="fw-bold text-muted">1</td>
                            <td>
                                <a href="#" class="fw-bold text-decoration-none" style="color: var(--polban-blue);">
                                    ULT-20260730081403481
                                </a>
                            </td>
                            <td class="text-start fw-bold">Apin</td>
                            <td><span class="badge bg-light text-dark border px-2 py-1">Mahasiswa</span></td>
                            <td class="text-start">Kemahasiswaan</td>
                            <td>
                                <span class="ticket-status status-submitted">
                                    Submitted
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1">Normal</span>
                            </td>
                            <td class="text-muted" style="font-size: 0.85rem;">
                                30-07-2026
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function toggleExportMenu(e) {
    e.stopPropagation();
    const menu = document.getElementById('exportMenu');
    if (menu) menu.classList.toggle('show');
}

document.addEventListener('click', function(e) {
    const menu = document.getElementById('exportMenu');
    if (menu && !menu.contains(e.target) && e.target.id !== 'dropdownExport') {
        menu.classList.remove('show');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const reveals = document.querySelectorAll('.reveal-item');
    reveals.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add('show');
        }, index * 80);
    });
});
</script>

<?= $this->endSection() ?>