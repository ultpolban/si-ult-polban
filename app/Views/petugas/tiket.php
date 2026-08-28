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

/* KUSTOMISASI COPY NO TIKET */
.ticket-copy-btn {
    background: transparent;
    border: none;
    color: var(--polban-blue);
    font-weight: 800;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.ticket-copy-btn:hover {
    background: rgba(0, 91, 172, 0.1);
    color: var(--polban-navy);
}

.ticket-copy-btn i {
    font-size: 0.8rem;
    opacity: 0.7;
}

.ticket-name {
    font-weight: 700;
    color: #263238;
}

.ticket-nik {
    color: #59636e;
    font-size: .87rem;
    font-weight: 500;
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

.ticket-document {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 6px;
    font-size: .76rem;
    font-weight: 700;
    white-space: nowrap;
}

.document-available {
    background: #d1e7dd;
    color: #0f5132;
}

.document-none {
    background: #f8d7da;
    color: #842029;
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

.status-progress {
    background: #e2d9f3;
    color: #432874;
}

.status-completed {
    background: #d1e7dd;
    color: #0f5132;
}

.status-rejected {
    background: #f8d7da;
    color: #842029;
}

.ticket-date {
    color: #59636e;
    font-size: .82rem;
    line-height: 1.5;
    white-space: nowrap;
}

.ticket-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    min-width: 125px;
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
}

.ticket-action:hover {
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,.15);
}

.action-detail { background: #17a2b8; }
.action-verify { background: var(--polban-green); }
.action-disposition { background: var(--polban-orange); }

.ticket-empty {
    padding: 50px 20px !important;
    color: #7b8794;
}

.ticket-empty-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #f0f2f7;
    color: #9aa4b2;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
}

.ticket-pagination {
    padding: 16px 20px;
    border-top: 1px solid #edf0f4;
    background: #fff;
}

.ticket-pagination .page-link {
    color: var(--polban-navy);
    border-radius: 7px !important;
    margin: 0 3px;
    font-weight: 600;
}

.ticket-pagination .page-item.active .page-link {
    background: var(--polban-navy);
    border-color: var(--polban-navy);
    color: #fff;
}

.ticket-pagination .page-item.disabled .page-link {
    color: #adb5bd;
}

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

/* Toast Salin */
.copy-toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #198754;
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    font-weight: 600;
    z-index: 10000;
    display: none;
    align-items: center;
    gap: 8px;
}

@media (max-width: 991px) {
    .ticket-actions { flex-wrap: wrap; }
    .ticket-table { min-width: 1100px; }
}

@media (max-width: 767px) {
    .ticket-page { padding-left: 8px; padding-right: 8px; }
    .ticket-title { font-size: 1.45rem; }
    .ticket-breadcrumb { display: none; }
    .ticket-filter-card .card-body { padding: 14px; }
}
</style>

<div class="container-fluid px-4 py-4 ticket-page">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="ticket-title mb-1" style="font-size:1.75rem;">
                Data Tiket Permohonan
            </h1>
            <p class="ticket-subtitle mb-0">
                Kelola dan pantau seluruh tiket permohonan layanan mahasiswa.
            </p>
        </div>
        <nav aria-label="breadcrumb" class="ticket-breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('petugas/dashboard') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active text-muted">Data Tiket</li>
            </ol>
        </nav>
    </div>

<?php
$realTickets = !empty($tiket_list) && is_array($tiket_list) ? $tiket_list : [];
$dummyTickets = [
    [
        'id' => 1001,
        'nomor_tiket' => 'ULT-20260808-0015',
        'nama_pemohon' => 'Rian Hidayat',
        'nik' => '3201123456780015',
        'layanan' => 'Surat Aktif Kuliah',
        'kategori' => 'Akademik',
        'dokumen' => 'ada',
        'status' => 'Submitted',
        'created_at' => '2026-08-08 14:30:00'
    ],
    [
        'id' => 1002,
        'nomor_tiket' => 'ULT-20260808-0014',
        'nama_pemohon' => 'Dewi Lestari',
        'nik' => '3201123456780014',
        'layanan' => 'Bantuan UKT',
        'kategori' => 'Keuangan',
        'dokumen' => '',
        'status' => 'Verified',
        'created_at' => '2026-08-08 13:45:00'
    ],
    [
        'id' => 1003,
        'nomor_tiket' => 'ULT-20260808-0013',
        'nama_pemohon' => 'Fajar Nugraha',
        'nik' => '3201123456780013',
        'layanan' => 'Beasiswa Prestasi',
        'kategori' => 'Kemahasiswaan',
        'dokumen' => 'ada',
        'status' => 'Disposisi',
        'created_at' => '2026-08-08 12:30:00'
    ]
];

$tiket_list = array_merge($realTickets, $dummyTickets);

usort($tiket_list, function ($a, $b) {
    return strtotime($b['created_at'] ?? '1970-01-01 00:00:00') <=> strtotime($a['created_at'] ?? '1970-01-01 00:00:00');
});

$searchValue = trim($_GET['search'] ?? '');
$statusValue = trim($_GET['status'] ?? '');
$kategoriValue = trim($_GET['kategori'] ?? '');

$filteredTickets = array_filter($tiket_list, function ($ticket) use ($searchValue, $statusValue, $kategoriValue) {
    $searchMatch = true;
    $statusMatch = true;
    $kategoriMatch = true;

    if ($searchValue !== '') {
        $haystack = strtolower(
            ($ticket['nomor_tiket'] ?? '') . ' ' .
            ($ticket['nama_pemohon'] ?? '') . ' ' .
            ($ticket['nik'] ?? '') . ' ' .
            ($ticket['layanan'] ?? '')
        );
        $searchMatch = str_contains($haystack, strtolower($searchValue));
    }

    if ($statusValue !== '') {
        $statusMatch = strtolower($ticket['status'] ?? '') === strtolower($statusValue);
    }

    if ($kategoriValue !== '') {
        $kategoriMatch = strtolower($ticket['kategori'] ?? '') === strtolower($kategoriValue);
    }

    return $searchMatch && $statusMatch && $kategoriMatch;
});

$filteredTickets = array_values($filteredTickets);

$jumlahTiket = count($tiket_list);
$jumlahSubmitted = 0;
$jumlahVerified = 0;
$jumlahDisposisi = 0;

foreach ($tiket_list as $statRow) {
    $statStatus = strtolower(trim($statRow['status'] ?? ''));
    if ($statStatus === 'submitted') $jumlahSubmitted++;
    if ($statStatus === 'verified') $jumlahVerified++;
    if ($statStatus === 'disposisi' || $statStatus === 'in progress') $jumlahDisposisi++;
}

$perPage = isset($_GET['limit']) && $_GET['limit'] !== '' ? (int) $_GET['limit'] : 10;
if ($perPage < 1) $perPage = 10;

$totalData = count($filteredTickets);
$totalPages = max(1, (int) ceil($totalData / $perPage));
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));
$offset = ($currentPage - 1) * $perPage;
$paginatedList = array_slice($filteredTickets, $offset, $perPage);
$no = $offset + 1;

$queryParams = [];
if ($searchValue !== '') $queryParams['search'] = $searchValue;
if ($statusValue !== '') $queryParams['status'] = $statusValue;
if ($kategoriValue !== '') $queryParams['kategori'] = $kategoriValue;
if (isset($_GET['limit']) && $_GET['limit'] !== '') $queryParams['limit'] = $_GET['limit'];

function ticketPageUrl($page, $queryParams = []) {
    $queryParams['page'] = $page;
    return base_url('petugas/tiket?' . http_build_query($queryParams));
}
?>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Total Tiket</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $jumlahTiket ?></h2>
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
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $jumlahSubmitted ?></h2>
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
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $jumlahVerified ?></h2>
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
                        <h2 class="fw-extrabold mb-0 text-white mt-1"><?= $jumlahDisposisi ?></h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-cogs"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card ticket-filter-card mb-4 reveal-item">
        <div class="card-body">
            <form id="ticketFilterForm" action="<?= base_url('petugas/tiket') ?>" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class="input-group ticket-input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" id="ticketSearch" class="form-control ticket-input" placeholder="Cari No Tiket, Nama, NIK..." value="<?= esc($searchValue) ?>">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4">
                        <select name="status" class="form-control ticket-select">
                            <option value="">-- Semua Status --</option>
                            <option value="Submitted" <?= $statusValue === 'Submitted' ? 'selected' : '' ?>>Submitted</option>
                            <option value="Verified" <?= $statusValue === 'Verified' ? 'selected' : '' ?>>Verified</option>
                            <option value="Disposisi" <?= $statusValue === 'Disposisi' ? 'selected' : '' ?>>Disposisi</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4">
                        <select name="kategori" class="form-control ticket-select">
                            <option value="">-- Semua Kategori --</option>
                            <option value="Akademik" <?= $kategoriValue === 'Akademik' ? 'selected' : '' ?>>Akademik</option>
                            <option value="Keuangan" <?= $kategoriValue === 'Keuangan' ? 'selected' : '' ?>>Keuangan</option>
                            <option value="Kemahasiswaan" <?= $kategoriValue === 'Kemahasiswaan' ? 'selected' : '' ?>>Kemahasiswaan</option>
                        </select>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-4">
                        <input type="number" name="limit" class="form-control ticket-select text-center" placeholder="Jml" min="1" value="<?= esc($perPage) ?>" title="Jumlah tiket per halaman">
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="d-flex gap-2">
                            <button type="submit" id="filterButton" class="btn btn-ticket-filter flex-grow-1">
                                <i class="fas fa-filter mr-1"></i> Filter
                            </button>
                            <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-ticket-reset" title="Reset Filter">
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

    <div class="card ticket-table-card reveal-item">
        <div class="ticket-table-header d-flex justify-content-between align-items-center">
            <div>
                <div class="ticket-table-title">
                    <i class="fas fa-list-alt me-2"></i> Daftar Tiket Permohonan
                </div>
                <small class="text-muted">Menampilkan <?= count($paginatedList) ?> dari total <?= $totalData ?> tiket yang cocok</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table ticket-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nomor Tiket</th>
                        <th>Nama Pemohon</th>
                        <th>NIK / Identitas</th>
                        <th>Layanan</th>
                        <th>Kategori</th>
                        <th class="text-center">Lampiran</th>
                        <th class="text-center">Status</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($paginatedList)): ?>
                        <?php foreach ($paginatedList as $ticket): ?>
                            <tr>
                                <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                                <td>
                                    <!-- TOMBOL SALIN NO TIKET -->
                                    <button type="button" class="ticket-copy-btn" onclick="copyTicketNumber('<?= esc($ticket['nomor_tiket']) ?>')" title="Klik untuk menyalin nomor tiket">
                                        <?= esc($ticket['nomor_tiket']) ?>
                                        <i class="far fa-copy"></i>
                                    </button>
                                </td>
                                <td>
                                    <div class="ticket-name"><?= esc($ticket['nama_pemohon']) ?></div>
                                </td>
                                <td>
                                    <div class="ticket-nik"><?= esc($ticket['nik'] ?? '-') ?></div>
                                </td>
                                <td><?= esc($ticket['layanan']) ?></td>
                                <td>
                                    <span class="ticket-category"><?= esc($ticket['kategori'] ?? 'Umum') ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($ticket['dokumen']) || !empty($ticket['lampiran'])): ?>
                                        <span class="ticket-document document-available">
                                            <i class="fas fa-paperclip"></i> Ada
                                        </span>
                                    <?php else: ?>
                                        <span class="ticket-document document-none">
                                            <i class="fas fa-times"></i> Tidak Ada
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $st = strtolower($ticket['status'] ?? '');
                                    $statusClass = 'status-submitted';
                                    if ($st === 'verified') $statusClass = 'status-verified';
                                    elseif ($st === 'disposisi' || $st === 'in progress') $statusClass = 'status-disposisi';
                                    elseif ($st === 'completed') $statusClass = 'status-completed';
                                    elseif ($st === 'rejected') $statusClass = 'status-rejected';
                                    ?>
                                    <span class="ticket-status <?= $statusClass ?>">
                                        <?= esc($ticket['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="ticket-date">
                                        <i class="far fa-clock me-1"></i>
                                        <?= date('d-m-Y H:i', strtotime($ticket['created_at'])) ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="ticket-actions">
                                        <!-- AKSI DETAIL KAN SELALU ADA -->
                                        <a href="<?= base_url('petugas/tiket/detail/' . esc($ticket['id'] ?? $ticket['nomor_tiket'])) ?>" class="ticket-action action-detail" title="Detail Tiket">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <?php if ($st === 'submitted'): ?>
                                            <!-- BELUM DIVERIFIKASI -> AKSI VERIFIKASI -->
                                            <a href="<?= base_url('petugas/tiket/verifikasi/' . esc($ticket['id'] ?? $ticket['nomor_tiket'])) ?>" class="ticket-action action-verify" title="Verifikasi Tiket">
                                                <i class="fas fa-user-check"></i>
                                            </a>
                                        <?php elseif ($st === 'verified'): ?>
                                            <!-- SUDAH DIVERIFIKASI -> AKSI DISPOSISI -->
                                            <a href="<?= base_url('petugas/tiket/disposisi/' . esc($ticket['id'] ?? $ticket['nomor_tiket'])) ?>" class="ticket-action action-disposition" title="Disposisi Tiket">
                                                <i class="fas fa-share"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center ticket-empty">
                                <div class="ticket-empty-icon"><i class="fas fa-folder-open"></i></div>
                                <h5 class="fw-bold">Tidak ada data tiket</h5>
                                <p class="text-muted small">Silakan sesuaikan filter pencarian Anda.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="ticket-pagination d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="text-muted small">
                Halaman <strong><?= $currentPage ?></strong> dari <strong><?= $totalPages ?></strong>
            </div>

            <ul class="pagination pagination-sm m-0">
                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ticketPageUrl($currentPage - 1, $queryParams) ?>">Prev</a>
                </li>

                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="<?= ticketPageUrl($p, $queryParams) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ticketPageUrl($currentPage + 1, $queryParams) ?>">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- TOAST NOTIFIKASI COPY -->
<div id="copyToast" class="copy-toast">
    <i class="fas fa-check-circle"></i> Nomor tiket berhasil disalin!
</div>

<script>
function copyTicketNumber(text) {
    navigator.clipboard.writeText(text).then(function() {
        const toast = document.getElementById('copyToast');
        toast.style.display = 'flex';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 2000);
    }).catch(function(err) {
        console.error('Gagal menyalin text: ', err);
    });
}

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