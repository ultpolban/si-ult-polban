<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
:root {
    --polban-navy: #000066;
    --polban-blue: #005bac;
    --polban-orange: #ff8c00;
    --polban-yellow: #f4c400;
    --polban-green: #198754;
}

/* ==========================================
   STYLE KOTAK STATISTIK (4 CARDS Top)
========================================== */
.stat-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    margin-bottom: 20px;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.stat-info h6 {
    font-size: 0.82rem;
    color: #6c757d;
    margin-bottom: 4px;
    font-weight: 600;
    text-transform: uppercase;
}

.stat-info h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0;
    color: #212529;
}

.bg-soft-primary { background: #e8f0fe; color: #0d6efd; }
.bg-soft-warning { background: #fff3cd; color: #ffc107; }
.bg-soft-info { background: #cff4fc; color: #0dcaf0; }
.bg-soft-success { background: #d1e7dd; color: #198754; }

/* ==========================================
   STYLE FILTER BAR TOP (SESUAI FOTO 1)
========================================== */
.filter-bar-container {
    background: #ffffff;
    border-radius: 14px;
    padding: 12px 18px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}

.search-input-box {
    border: 1px solid #ced4da;
    border-radius: 6px;
    display: flex;
    align-items: center;
    padding-left: 12px;
    background: #fff;
    height: 40px;
}

.search-input-box i {
    color: var(--polban-navy);
    font-size: 1rem;
    margin-right: 8px;
}

.search-input-box input {
    border: none;
    outline: none;
    width: 100%;
    font-size: 0.88rem;
    color: #495057;
}

.custom-filter-select {
    height: 40px;
    border-radius: 6px;
    font-size: 0.88rem;
    border: 1px solid #ced4da;
    color: #495057;
}

.btn-filter-submit {
    height: 40px;
    background: #0d1282;
    color: #fff;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 0 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-filter-submit:hover {
    background: #080a5e;
    color: #fff;
}

.btn-filter-reset {
    height: 40px;
    width: 42px;
    background: #6c757d;
    color: #fff;
    border-radius: 6px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-filter-reset:hover {
    background: #5a6268;
    color: #fff;
}

.btn-export-dropdown {
    height: 40px;
    background: #0f7b43;
    color: #fff;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 0 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.btn-export-dropdown:hover {
    background: #0b5c32;
    color: #fff;
}

/* ==========================================
   STYLE TABEL KELOLA LOG AKTIVITAS 
========================================== */
.ticket-table-card {
    border: 0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,0.06);
    background: #fff;
}

.ticket-table {
    margin-bottom: 0;
    width: 100%;
}

.ticket-table thead {
    background: #fff;
    border-bottom: 2px solid #edf0f4;
}

.ticket-table thead th {
    color: #495057;
    font-size: 0.85rem;
    font-weight: 700;
    padding: 14px 12px;
    border: none;
}

.ticket-table tbody td {
    padding: 14px 12px;
    vertical-align: middle;
    border-color: #edf0f4;
    font-size: 0.88rem;
}

.ticket-number-link {
    color: #005bac;
    font-weight: 700;
    text-decoration: none;
}

.ticket-number-link:hover {
    text-decoration: underline;
}

.badge-berkas-ada {
    background-color: #d1e7dd;
    color: #0f5132;
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-berkas-tidak {
    background-color: #f8d7da;
    color: #842029;
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-status-submitted {
    background-color: #fff3cd;
    color: #856404;
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-status-verified {
    background-color: #d1e7dd;
    color: #0f5132;
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-status-disposisi {
    background-color: #cff4fc;
    color: #055160;
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-status-completed {
    background-color: #d1e7dd;
    color: #0f5132;
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-status-rejected {
    background-color: #f8d7da;
    color: #842029;
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.btn-action-icon {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    border: none;
    margin: 0 2px;
    text-decoration: none !important;
}

.btn-action-cyan { background-color: #17a2b8; }
.btn-action-green { background-color: #198754; }
.btn-action-orange { background-color: #fd7e14; }

.btn-action-cyan:hover { background-color: #138496; color: #fff; }
.btn-action-green:hover { background-color: #157347; color: #fff; }
.btn-action-orange:hover { background-color: #e06b00; color: #fff; }

/* ==========================================
   STYLE PAGINASI BOTTOM (SESUAI FOTO 2)
========================================== */
.pagination-bottom-container {
    padding: 18px 20px;
    background: #fff;
    border-top: 1px solid #edf0f4;
}

.page-num-btn {
    min-width: 36px;
    height: 36px;
    border: 1px solid #ced4da;
    background: #fff;
    color: #212529;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin: 0 2px;
    text-decoration: none !important;
}

.page-num-btn.active {
    background: #0d1282;
    color: #fff;
    border-color: #0d1282;
}

.page-num-btn.disabled {
    color: #ccc;
    pointer-events: none;
}
</style>

<?php
// DATA DUMMY LENGKAP UNTUK HALAMAN LOG AKTIVITAS
$allData = [
    [
        'id' => 1,
        'nomor_tiket' => 'ULT-20260808-0015',
        'nama_pemohon' => 'Rian Hidayat',
        'nik' => '3201123456780015',
        'layanan' => 'Surat Aktif Kuliah',
        'kategori' => 'Akademik',
        'berkas' => 'Ada',
        'status' => 'Submitted',
        'tanggal' => '08-08-2026 14:30:00'
    ],
    [
        'id' => 2,
        'nomor_tiket' => 'ULT-20260808-0014',
        'nama_pemohon' => 'Dewi Lestari',
        'nik' => '3201123456780014',
        'layanan' => 'Bantuan UKT',
        'kategori' => 'Keuangan',
        'berkas' => 'Tidak Ada',
        'status' => 'Verified',
        'tanggal' => '08-08-2026 13:45:00'
    ],
    [
        'id' => 3,
        'nomor_tiket' => 'ULT-20260808-0013',
        'nama_pemohon' => 'Fajar Nugraha',
        'nik' => '3201123456780013',
        'layanan' => 'Beasiswa Prestasi',
        'kategori' => 'Kemahasiswaan',
        'berkas' => 'Ada',
        'status' => 'Disposisi',
        'tanggal' => '08-08-2026 12:30:00'
    ],
    [
        'id' => 4,
        'nomor_tiket' => 'ULT-20260807-0012',
        'nama_pemohon' => 'Siti Aminah',
        'nik' => '3201123456780012',
        'layanan' => 'Surat Keterangan Lulus',
        'kategori' => 'Akademik',
        'berkas' => 'Ada',
        'status' => 'Submitted',
        'tanggal' => '07-08-2026 16:20:00'
    ],
    [
        'id' => 5,
        'nomor_tiket' => 'ULT-20260807-0011',
        'nama_pemohon' => 'Budi Santoso',
        'nik' => '3201123456780011',
        'layanan' => 'Pengajuan Cuti',
        'kategori' => 'Akademik',
        'berkas' => 'Tidak Ada',
        'status' => 'Verified',
        'tanggal' => '07-08-2026 15:10:00'
    ],
    [
        'id' => 6,
        'nomor_tiket' => 'ULT-20260807-0010',
        'nama_pemohon' => 'Ahmad Fauzi',
        'nik' => '3201123456780010',
        'layanan' => 'Beasiswa Prestasi',
        'kategori' => 'Kemahasiswaan',
        'berkas' => 'Tidak Ada',
        'status' => 'Disposisi',
        'tanggal' => '07-08-2026 13:00:00'
    ],
    [
        'id' => 7,
        'nomor_tiket' => 'ULT-20260807-0009',
        'nama_pemohon' => 'Annisa Rahma',
        'nik' => '3201123456780009',
        'layanan' => 'Legalisir Ijazah',
        'kategori' => 'Akademik',
        'berkas' => 'Ada',
        'status' => 'Completed',
        'tanggal' => '07-08-2026 11:45:00'
    ],
    [
        'id' => 8,
        'nomor_tiket' => 'ULT-20260807-0008',
        'nama_pemohon' => 'Yoga Pratama',
        'nik' => '3201123456780008',
        'layanan' => 'Keringanan UKT',
        'kategori' => 'Keuangan',
        'berkas' => 'Ada',
        'status' => 'Verified',
        'tanggal' => '07-08-2026 10:30:00'
    ],
    [
        'id' => 9,
        'nomor_tiket' => 'ULT-20260807-0007',
        'nama_pemohon' => 'Intan Permata',
        'nik' => '3201123456780007',
        'layanan' => 'Surat Pengantar PKL',
        'kategori' => 'Akademik',
        'berkas' => 'Tidak Ada',
        'status' => 'Submitted',
        'tanggal' => '07-08-2026 09:20:00'
    ],
    [
        'id' => 10,
        'nomor_tiket' => 'ULT-20260807-0006',
        'nama_pemohon' => 'Reza Pahlevi',
        'nik' => '3201123456780006',
        'layanan' => 'Pindah Kelas',
        'kategori' => 'Akademik',
        'berkas' => 'Ada',
        'status' => 'Rejected',
        'tanggal' => '07-08-2026 08:15:00'
    ],
    [
        'id' => 11,
        'nomor_tiket' => 'ULT-20260806-0005',
        'nama_pemohon' => 'Putri Wulandari',
        'nik' => '3201123456780005',
        'layanan' => 'Konseling Akademik',
        'kategori' => 'Kemahasiswaan',
        'berkas' => 'Tidak Ada',
        'status' => 'Completed',
        'tanggal' => '06-08-2026 16:00:00'
    ],
    [
        'id' => 12,
        'nomor_tiket' => 'ULT-20260806-0004',
        'nama_pemohon' => 'Dedi Kurniawan',
        'nik' => '3201123456780004',
        'layanan' => 'Penggantian KTM Hilang',
        'kategori' => 'Kemahasiswaan',
        'berkas' => 'Ada',
        'status' => 'Verified',
        'tanggal' => '06-08-2026 14:30:00'
    ],
    [
        'id' => 13,
        'nomor_tiket' => 'ULT-20260806-0003',
        'nama_pemohon' => 'Nabila Putri',
        'nik' => '3201123456780003',
        'layanan' => 'Surat Rekomendasi',
        'kategori' => 'Akademik',
        'berkas' => 'Ada',
        'status' => 'Disposisi',
        'tanggal' => '06-08-2026 12:00:00'
    ],
    [
        'id' => 14,
        'nomor_tiket' => 'ULT-20260806-0002',
        'nama_pemohon' => 'Galih Ramadhan',
        'nik' => '3201123456780002',
        'layanan' => 'Bantuan Beasiswa',
        'kategori' => 'Keuangan',
        'berkas' => 'Tidak Ada',
        'status' => 'Verified',
        'tanggal' => '06-08-2026 10:45:00'
    ],
    [
        'id' => 15,
        'nomor_tiket' => 'ULT-20260806-0001',
        'nama_pemohon' => 'Maya Sari',
        'nik' => '3201123456780001',
        'layanan' => 'Surat Aktif Kuliah',
        'kategori' => 'Akademik',
        'berkas' => 'Ada',
        'status' => 'Submitted',
        'tanggal' => '06-08-2026 08:30:00'
    ]
];

// MENGHITUNG DUMMY STATISTIK UNTUK 4 KOTAK CARD
$totalTiket = count($allData);
$totalSubmitted = count(array_filter($allData, fn($i) => $i['status'] === 'Submitted'));
$totalVerified = count(array_filter($allData, fn($i) => $i['status'] === 'Verified'));
$totalDisposisi = count(array_filter($allData, fn($i) => $i['status'] === 'Disposisi'));

// INPUT FILTER & LIMIT DARI USER
$searchValue = trim($_GET['search'] ?? '');
$statusValue = trim($_GET['status'] ?? '');
$kategoriValue = trim($_GET['kategori'] ?? '');

// PROSES FILTERING DATA
$filteredData = array_filter($allData, function($item) use ($searchValue, $statusValue, $kategoriValue) {
    $mSearch = true;
    $mStatus = true;
    $mKat = true;

    if ($searchValue !== '') {
        $text = strtolower($item['nomor_tiket'].' '.$item['nama_pemohon'].' '.$item['nik']);
        $mSearch = str_contains($text, strtolower($searchValue));
    }
    if ($statusValue !== '') {
        $mStatus = strtolower($item['status']) === strtolower($statusValue);
    }
    if ($kategoriValue !== '') {
        $mKat = strtolower($item['kategori']) === strtolower($kategoriValue);
    }

    return $mSearch && $mStatus && $mKat;
});

$filteredData = array_values($filteredData);
$totalFilteredCount = count($filteredData);

// BANYAK BARIS PER HALAMAN (LIMIT DARI INPUT FOTO 2, DEFAULT 9 Sesuai Foto)
$perPage = isset($_GET['limit']) && (int)$_GET['limit'] > 0 ? (int)$_GET['limit'] : 9;
$currentPage = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;

$totalPages = max(1, ceil($totalFilteredCount / $perPage));
if ($currentPage > $totalPages) {
    $currentPage = $totalPages;
}

$startIndex = ($currentPage - 1) * $perPage;
$pageData = array_slice($filteredData, $startIndex, $perPage);

$displayStart = $totalFilteredCount > 0 ? $startIndex + 1 : 0;
$displayEnd = min($startIndex + $perPage, $totalFilteredCount);

// HELPER FUNCTION UNTUK URL PAGINASI & FILTER
function buildFilterUrl($page, $perPage, $searchValue, $statusValue, $kategoriValue) {
    $params = [
        'page' => $page,
        'limit' => $perPage
    ];
    if ($searchValue !== '') $params['search'] = $searchValue;
    if ($statusValue !== '') $params['status'] = $statusValue;
    if ($kategoriValue !== '') $params['kategori'] = $kategoriValue;
    return base_url('petugas/log_aktivitas') . '?' . http_build_query($params);
}
?>

<div class="container-fluid px-3 py-3">

    <!-- =========================================================
         0. 4 KOTAK INFO STATISTIK (SEPERTI DI HALAMAN DATA TIKET)
    ========================================================= -->
    <div class="row g-3 mb-3">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-info">
                    <h6>Total Log Aktivitas</h6>
                    <h3><?= $totalTiket ?></h3>
                </div>
                <div class="stat-icon bg-soft-primary">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-info">
                    <h6>Perlu Verifikasi</h6>
                    <h3><?= $totalSubmitted ?></h3>
                </div>
                <div class="stat-icon bg-soft-warning">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-info">
                    <h6>Perlu Disposisi</h6>
                    <h3><?= $totalVerified ?></h3>
                </div>
                <div class="stat-icon bg-soft-info">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-info">
                    <h6>Dalam Disposisi</h6>
                    <h3><?= $totalDisposisi ?></h3>
                </div>
                <div class="stat-icon bg-soft-success">
                    <i class="fas fa-share-square"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================================================
         1. FILTER BAR TOP (PERSIS FOTO 1)
    ========================================================= -->
    <div class="filter-bar-container">
        <form action="<?= base_url('petugas/log_aktivitas') ?>" method="GET">
            <div class="row g-2 align-items-center">

                <!-- SEARCH -->
                <div class="col-lg-3 col-md-4">
                    <div class="search-input-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" placeholder="Cari No Tiket, Nama, NIK..." value="<?= esc($searchValue) ?>">
                    </div>
                </div>

                <!-- SEMUA STATUS -->
                <div class="col-lg-2 col-md-3">
                    <select name="status" class="form-control custom-filter-select">
                        <option value="">-- Semua Status --</option>
                        <option value="Submitted" <?= $statusValue === 'Submitted' ? 'selected' : '' ?>>Submitted</option>
                        <option value="Verified" <?= $statusValue === 'Verified' ? 'selected' : '' ?>>Verified</option>
                        <option value="Disposisi" <?= $statusValue === 'Disposisi' ? 'selected' : '' ?>>Disposisi</option>
                        <option value="Completed" <?= $statusValue === 'Completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="Rejected" <?= $statusValue === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                </div>

                <!-- SEMUA KATEGORI -->
                <div class="col-lg-2 col-md-3">
                    <select name="kategori" class="form-control custom-filter-select">
                        <option value="">-- Semua Kategori --</option>
                        <option value="Akademik" <?= $kategoriValue === 'Akademik' ? 'selected' : '' ?>>Akademik</option>
                        <option value="Keuangan" <?= $kategoriValue === 'Keuangan' ? 'selected' : '' ?>>Keuangan</option>
                        <option value="Kemahasiswaan" <?= $kategoriValue === 'Kemahasiswaan' ? 'selected' : '' ?>>Kemahasiswaan</option>
                    </select>
                </div>

                <!-- INPUT BARIS PER HALAMAN (MEMUNCULKAN 9 ATAU DUKUNG CUSTOM LIMIT) -->
                <div class="col-lg-1 col-md-2">
                    <input type="number" name="limit" title="Jumlah Baris Halaman" class="form-control custom-filter-select text-center" value="<?= esc($perPage) ?>" min="1">
                </div>

                <!-- TOMBOL FILTER & RESET -->
                <div class="col-lg-2 col-md-4 d-flex gap-1">
                    <button type="submit" class="btn-filter-submit flex-grow-1">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="<?= base_url('petugas/log_aktivitas') ?>" class="btn-filter-reset" title="Reset Filter">
                        <i class="fas fa-redo-alt"></i>
                    </a>
                </div>

                <!-- EXPORT LAPORAN -->
                <div class="col-lg-2 col-md-4">
                    <div class="dropdown">
                        <button class="btn-export-dropdown w-100 dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <span><i class="fas fa-download mr-1"></i> Export Laporan</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/excel') ?>"><i class="fas fa-file-excel text-success mr-2"></i> Excel</a>
                            <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/pdf') ?>"><i class="fas fa-file-pdf text-danger mr-2"></i> PDF</a>
                            <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/csv') ?>"><i class="fas fa-file-csv text-info mr-2"></i> CSV</a>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- =========================================================
         2. TABEL KELOLA LOG AKTIVITAS 
    ========================================================= -->
    <div class="ticket-table-card">
        <div class="table-responsive">
            <table class="table ticket-table align-middle">
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>No Tiket</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Layanan</th>
                        <th>Kategori</th>
                        <th>Berkas</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($pageData)): ?>
                        <?php foreach($pageData as $index => $row): ?>
                            <tr>
                                <td class="text-muted font-weight-bold"><?= $startIndex + $index + 1 ?></td>
                                <td>
                                    <a href="<?= base_url('petugas/detail/'.$row['id']) ?>" class="ticket-number-link">
                                        <?= $row['nomor_tiket'] ?>
                                    </a>
                                </td>
                                <td class="font-weight-bold text-dark"><?= $row['nama_pemohon'] ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['layanan'] ?></td>
                                <td>
                                    <span class="badge badge-light border px-2 py-1"><?= $row['kategori'] ?></span>
                                </td>
                                <td>
                                    <?php if($row['berkas'] === 'Ada'): ?>
                                        <span class="badge-berkas-ada"><i class="fas fa-check-circle"></i> Ada</span>
                                    <?php else: ?>
                                        <span class="badge-berkas-tidak"><i class="fas fa-times-circle"></i> Tidak Ada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($row['status'] === 'Submitted'): ?>
                                        <span class="badge-status-submitted"><i class="fas fa-clock"></i> Submitted</span>
                                    <?php elseif($row['status'] === 'Verified'): ?>
                                        <span class="badge-status-verified"><i class="fas fa-check"></i> Verified</span>
                                    <?php elseif($row['status'] === 'Disposisi'): ?>
                                        <span class="badge-status-disposisi"><i class="fas fa-share-square"></i> Disposisi</span>
                                    <?php elseif($row['status'] === 'Completed'): ?>
                                        <span class="badge-status-completed"><i class="fas fa-check-circle"></i> Completed</span>
                                    <?php else: ?>
                                        <span class="badge-status-rejected"><i class="fas fa-times-circle"></i> Rejected</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted" style="font-size: 0.82rem;">
                                    <?= $row['tanggal'] ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('petugas/detail/'.$row['id']) ?>" class="btn-action-icon btn-action-cyan" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('petugas/verifikasi/'.$row['id']) ?>" class="btn-action-icon btn-action-green" title="Verifikasi">
                                        <i class="fas fa-user-check"></i>
                                    </a>
                                    <a href="<?= base_url('petugas/disposisi/'.$row['id']) ?>" class="btn-action-icon btn-action-orange" title="Disposisi">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">Data log aktivitas tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- =========================================================
             3. KOMPONEN BAWAH TABEL (PAGINASI DINAMIS BERDASARKAN LIMIT)
        ========================================================= -->
        <div class="pagination-bottom-container d-flex justify-content-between align-items-center flex-wrap">
            <div class="text-muted" style="font-size: 0.88rem;">
                Menampilkan <strong><?= $displayStart ?> - <?= $displayEnd ?></strong> dari <strong><?= $totalFilteredCount ?></strong> tiket
            </div>

            <div class="d-flex align-items-center">
                <!-- PREVIOUS BUTTON -->
                <?php if ($currentPage > 1): ?>
                    <a href="<?= buildFilterUrl($currentPage - 1, $perPage, $searchValue, $statusValue, $kategoriValue) ?>" class="page-num-btn" title="Sebelumnya">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php else: ?>
                    <span class="page-num-btn disabled"><i class="fas fa-chevron-left"></i></span>
                <?php endif; ?>

                <!-- NUMERIC PAGINATION -->
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <?php if ($p == $currentPage): ?>
                        <span class="page-num-btn active"><?= $p ?></span>
                    <?php else: ?>
                        <a href="<?= buildFilterUrl($p, $perPage, $searchValue, $statusValue, $kategoriValue) ?>" class="page-num-btn"><?= $p ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <!-- NEXT BUTTON -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= buildFilterUrl($currentPage + 1, $perPage, $searchValue, $statusValue, $kategoriValue) ?>" class="page-num-btn" title="Berikutnya">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <span class="page-num-btn disabled"><i class="fas fa-chevron-right"></i></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>