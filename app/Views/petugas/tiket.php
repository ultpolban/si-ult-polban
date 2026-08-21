<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

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

/* =========================
   PAGE
========================= */
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

/* =========================
   STATISTIC
========================= */
.ticket-stat-card {
    position: relative;
    overflow: hidden;
    border: 0;
    border-radius: 14px;
    min-height: 120px;
    color: white;
    transition: .25s ease;
}

.ticket-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,.14) !important;
}

.ticket-stat-card::after {
    content: "";
    position: absolute;
    width: 100px;
    height: 100px;
    right: -25px;
    bottom: -35px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
}

.stat-blue {
    background: linear-gradient(135deg,#005bac,#006fc9);
}

.stat-orange {
    background: linear-gradient(135deg,#ff8c00,#ff9f1c);
}

.stat-yellow {
    background: linear-gradient(135deg,#f4c400,#f8d323);
    color: #212529;
}

.stat-green {
    background: linear-gradient(135deg,#198754,#159957);
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,.22);
    font-size: 1.25rem;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    line-height: 1;
}

.stat-label {
    font-size: .74rem;
    text-transform: uppercase;
    font-weight: 700;
    opacity: .85;
}

/* =========================
   FILTER
========================= */
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

/* Tombol Export Laporan Green */
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

/* =========================
   TABLE
========================= */
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

.ticket-number {
    color: var(--polban-blue);
    font-weight: 800;
    text-decoration: none;
    white-space: nowrap;
}

.ticket-number:hover {
    color: var(--polban-navy);
    text-decoration: underline;
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

/* =========================
   ACTION
========================= */
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

.action-detail {
    background: #17a2b8;
}

.action-verify {
    background: var(--polban-green);
}

.action-disposition {
    background: var(--polban-orange);
}

/* =========================
   EMPTY
========================= */
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

/* =========================
   PAGINATION
========================= */
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

/* =========================
   ANIMATION
========================= */
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

.filter-loading {
    opacity: .65;
    pointer-events: none;
}

.btn-loading i {
    animation: spin .8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 991px) {
    .ticket-actions {
        flex-wrap: wrap;
    }

    .ticket-table {
        min-width: 1100px;
    }
}

@media (max-width: 767px) {
    .ticket-page {
        padding-left: 8px;
        padding-right: 8px;
    }

    .ticket-title {
        font-size: 1.45rem;
    }

    .ticket-breadcrumb {
        display: none;
    }

    .stat-number {
        font-size: 1.5rem;
    }

    .ticket-filter-card .card-body {
        padding: 14px;
    }
}
</style>


<div class="container-fluid px-4 py-4 ticket-page">

    <!-- =========================
         HEADER
    ========================== -->
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
                    <a href="<?= base_url('petugas/dashboard') ?>">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active text-muted">
                    Data Tiket
                </li>

            </ol>
        </nav>

    </div>


<?php
/*
|--------------------------------------------------------------------------
| DATA DUMMY
|--------------------------------------------------------------------------
| Data dari controller tetap dipakai.
| Data dummy ditambahkan agar tabel memiliki banyak data untuk
| mengetes pagination per halaman[cite: 9].
*/

$realTickets = !empty($tiket_list) && is_array($tiket_list)
    ? $tiket_list
    : [];

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
    ],

    [
        'id' => 1004,
        'nomor_tiket' => 'ULT-20260807-0012',
        'nama_pemohon' => 'Siti Aminah',
        'nik' => '3201123456780012',
        'layanan' => 'Surat Keterangan Lulus',
        'kategori' => 'Akademik',
        'dokumen' => 'ada',
        'status' => 'Submitted',
        'created_at' => '2026-08-07 16:20:00'
    ],

    [
        'id' => 1005,
        'nomor_tiket' => 'ULT-20260807-0011',
        'nama_pemohon' => 'Budi Santoso',
        'nik' => '3201123456780011',
        'layanan' => 'Pengajuan Cuti',
        'kategori' => 'Akademik',
        'dokumen' => '',
        'status' => 'Verified',
        'created_at' => '2026-08-07 15:10:00'
    ],

    [
        'id' => 1006,
        'nomor_tiket' => 'ULT-20260807-0010',
        'nama_pemohon' => 'Ahmad Fauzi',
        'nik' => '3201123456780010',
        'layanan' => 'Beasiswa Prestasi',
        'kategori' => 'Kemahasiswaan',
        'dokumen' => '',
        'status' => 'Disposisi',
        'created_at' => '2026-08-07 13:00:00'
    ],

    [
        'id' => 1007,
        'nomor_tiket' => 'ULT-20260807-0009',
        'nama_pemohon' => 'Annisa Rahma',
        'nik' => '3201123456780009',
        'layanan' => 'Legalisir Ijazah',
        'kategori' => 'Akademik',
        'dokumen' => 'ada',
        'status' => 'Completed',
        'created_at' => '2026-08-07 11:45:00'
    ],

    [
        'id' => 1008,
        'nomor_tiket' => 'ULT-20260807-0008',
        'nama_pemohon' => 'Yoga Pratama',
        'nik' => '3201123456780008',
        'layanan' => 'Keringanan UKT',
        'kategori' => 'Keuangan',
        'dokumen' => 'ada',
        'status' => 'Verified',
        'created_at' => '2026-08-07 10:30:00'
    ],

    [
        'id' => 1009,
        'nomor_tiket' => 'ULT-20260807-0007',
        'nama_pemohon' => 'Intan Permata',
        'nik' => '3201123456780007',
        'layanan' => 'Surat Pengantar PKL',
        'kategori' => 'Akademik',
        'dokumen' => '',
        'status' => 'Submitted',
        'created_at' => '2026-08-07 09:20:00'
    ],

    [
        'id' => 1010,
        'nomor_tiket' => 'ULT-20260807-0006',
        'nama_pemohon' => 'Reza Pahlevi',
        'nik' => '3201123456780006',
        'layanan' => 'Pindah Kelas',
        'kategori' => 'Akademik',
        'dokumen' => 'ada',
        'status' => 'Rejected',
        'created_at' => '2026-08-07 08:15:00'
    ],

    [
        'id' => 1011,
        'nomor_tiket' => 'ULT-20260806-0005',
        'nama_pemohon' => 'Putri Wulandari',
        'nik' => '3201123456780005',
        'layanan' => 'Konseling Akademik',
        'kategori' => 'Kemahasiswaan',
        'dokumen' => '',
        'status' => 'Completed',
        'created_at' => '2026-08-06 16:00:00'
    ],

    [
        'id' => 1012,
        'nomor_tiket' => 'ULT-20260806-0004',
        'nama_pemohon' => 'Dedi Kurniawan',
        'nik' => '3201123456780004',
        'layanan' => 'Penggantian KTM Hilang',
        'kategori' => 'Kemahasiswaan',
        'dokumen' => 'ada',
        'status' => 'Verified',
        'created_at' => '2026-08-06 14:30:00'
    ],

    [
        'id' => 1013,
        'nomor_tiket' => 'ULT-20260806-0003',
        'nama_pemohon' => 'Nabila Putri',
        'nik' => '3201123456780003',
        'layanan' => 'Surat Rekomendasi',
        'kategori' => 'Akademik',
        'dokumen' => 'ada',
        'status' => 'Disposisi',
        'created_at' => '2026-08-06 12:00:00'
    ],

    [
        'id' => 1014,
        'nomor_tiket' => 'ULT-20260806-0002',
        'nama_pemohon' => 'Galih Ramadhan',
        'nik' => '3201123456780002',
        'layanan' => 'Bantuan Beasiswa',
        'kategori' => 'Keuangan',
        'dokumen' => '',
        'status' => 'Verified',
        'created_at' => '2026-08-06 10:45:00'
    ],

    [
        'id' => 1015,
        'nomor_tiket' => 'ULT-20260806-0001',
        'nama_pemohon' => 'Maya Sari',
        'nik' => '3201123456780001',
        'layanan' => 'Surat Aktif Kuliah',
        'kategori' => 'Akademik',
        'dokumen' => 'ada',
        'status' => 'Submitted',
        'created_at' => '2026-08-06 08:30:00'
    ],

];


/*
|--------------------------------------------------------------------------
| GABUNGKAN DATA DATABASE + DUMMY
|--------------------------------------------------------------------------
*/

$tiket_list = array_merge($realTickets, $dummyTickets);


/*
|--------------------------------------------------------------------------
| SORTING
|--------------------------------------------------------------------------
| Tiket terbaru selalu berada di atas.
*/

usort($tiket_list, function ($a, $b) {

    return strtotime($b['created_at'] ?? '1970-01-01 00:00:00')
        <=> strtotime($a['created_at'] ?? '1970-01-01 00:00:00');

});


/*
|--------------------------------------------------------------------------
| FILTER
|--------------------------------------------------------------------------
*/

$searchValue = trim($_GET['search'] ?? '');
$statusValue = trim($_GET['status'] ?? '');
$kategoriValue = trim($_GET['kategori'] ?? '');

$filteredTickets = array_filter($tiket_list, function ($ticket) use (
    $searchValue,
    $statusValue,
    $kategoriValue
) {

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

        $searchMatch = str_contains(
            $haystack,
            strtolower($searchValue)
        );
    }

    if ($statusValue !== '') {

        $statusMatch =
            strtolower($ticket['status'] ?? '') ===
            strtolower($statusValue);
    }

    if ($kategoriValue !== '') {

        $kategoriMatch =
            strtolower($ticket['kategori'] ?? '') ===
            strtolower($kategoriValue);
    }

    return $searchMatch && $statusMatch && $kategoriMatch;

});


$filteredTickets = array_values($filteredTickets);


/*
|--------------------------------------------------------------------------
| STATISTIK
|--------------------------------------------------------------------------
*/

$jumlahTiket = count($tiket_list);

$jumlahSubmitted = 0;
$jumlahVerified = 0;
$jumlahDisposisi = 0;

foreach ($tiket_list as $statRow) {

    $statStatus = strtolower(
        trim($statRow['status'] ?? '')
    );

    if ($statStatus === 'submitted') {
        $jumlahSubmitted++;
    }

    if ($statStatus === 'verified') {
        $jumlahVerified++;
    }

    if (
        $statStatus === 'disposisi' ||
        $statStatus === 'in progress'
    ) {
        $jumlahDisposisi++;
    }
}


/*
|--------------------------------------------------------------------------
| PAGINATION & CUSTOM PER PAGE
|--------------------------------------------------------------------------
| Petugas bisa mengetik jumlah tiket yang ingin ditampilkan per halaman.
*/

$perPage = isset($_GET['limit']) && $_GET['limit'] !== '' ? (int) $_GET['limit'] : 10;
if ($perPage < 1) {
    $perPage = 10;
}

$totalData = count($filteredTickets);

$totalPages = max(
    1,
    (int) ceil($totalData / $perPage)
);

$currentPage = isset($_GET['page'])
    ? (int) $_GET['page']
    : 1;

$currentPage = max(
    1,
    min($currentPage, $totalPages)
);

$offset = ($currentPage - 1) * $perPage;

$paginatedList = array_slice(
    $filteredTickets,
    $offset,
    $perPage
);

$no = $offset + 1;


/*
|--------------------------------------------------------------------------
| QUERY PAGINATION
|--------------------------------------------------------------------------
*/

$queryParams = [];

if ($searchValue !== '') {
    $queryParams['search'] = $searchValue;
}

if ($statusValue !== '') {
    $queryParams['status'] = $statusValue;
}

if ($kategoriValue !== '') {
    $queryParams['kategori'] = $kategoriValue;
}

if (isset($_GET['limit']) && $_GET['limit'] !== '') {
    $queryParams['limit'] = $_GET['limit'];
}

function ticketPageUrl($page, $queryParams = [])
{
    $queryParams['page'] = $page;

    return base_url(
        'petugas/tiket?' .
        http_build_query($queryParams)
    );
}

?>


<!-- =========================
     STATISTIC CARDS
========================= -->

<div class="row g-3 mb-4">

    <div class="col-xl-3 col-md-6">

        <div class="card ticket-stat-card stat-blue shadow-sm reveal-item">

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Total Tiket
                        </div>

                        <div class="stat-number mt-2">
                            <?= $jumlahTiket ?>
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-xl-3 col-md-6">

        <div class="card ticket-stat-card stat-orange shadow-sm reveal-item">

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Menunggu Verifikasi
                        </div>

                        <div class="stat-number mt-2">
                            <?= $jumlahSubmitted ?>
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-xl-3 col-md-6">

        <div class="card ticket-stat-card stat-green shadow-sm reveal-item">

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Terverifikasi
                        </div>

                        <div class="stat-number mt-2">
                            <?= $jumlahVerified ?>
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-xl-3 col-md-6">

        <div class="card ticket-stat-card stat-yellow shadow-sm reveal-item">

            <div class="card-body p-3">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <div class="stat-label">
                            Diproses / Disposisi
                        </div>

                        <div class="stat-number mt-2">
                            <?= $jumlahDisposisi ?>
                        </div>

                    </div>

                    <div class="stat-icon">
                        <i class="fas fa-cogs"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================
     FILTER & EXPORT
========================= -->

<div class="card ticket-filter-card mb-4 reveal-item">

    <div class="card-body">

        <form
            id="ticketFilterForm"
            action="<?= base_url('petugas/tiket') ?>"
            method="GET"
        >

            <div class="row g-2 align-items-center">

                <div class="col-xl-3 col-lg-3 col-md-12">

                    <div class="input-group ticket-input-group">

                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            id="ticketSearch"
                            class="form-control ticket-input"
                            placeholder="Cari No Tiket, Nama, NIK..."
                            value="<?= esc($searchValue) ?>"
                        >

                    </div>

                </div>


                <div class="col-xl-2 col-lg-2 col-md-4">

                    <select
                        name="status"
                        class="form-control ticket-select"
                    >

                        <option value="">
                            -- Semua Status --
                        </option>

                        <option
                            value="Submitted"
                            <?= $statusValue === 'Submitted' ? 'selected' : '' ?>
                        >
                            Submitted
                        </option>

                        <option
                            value="Verified"
                            <?= $statusValue === 'Verified' ? 'selected' : '' ?>
                        >
                            Verified
                        </option>

                        <option
                            value="Disposisi"
                            <?= $statusValue === 'Disposisi' ? 'selected' : '' ?>
                        >
                            Disposisi
                        </option>

                    </select>

                </div>


                <div class="col-xl-2 col-lg-2 col-md-4">

                    <select
                        name="kategori"
                        class="form-control ticket-select"
                    >

                        <option value="">
                            -- Semua Kategori --
                        </option>

                        <option
                            value="Akademik"
                            <?= $kategoriValue === 'Akademik' ? 'selected' : '' ?>
                        >
                            Akademik
                        </option>

                        <option
                            value="Keuangan"
                            <?= $kategoriValue === 'Keuangan' ? 'selected' : '' ?>
                        >
                            Keuangan
                        </option>

                        <option
                            value="Kemahasiswaan"
                            <?= $kategoriValue === 'Kemahasiswaan' ? 'selected' : '' ?>
                        >
                            Kemahasiswaan
                        </option>

                    </select>

                </div>

                <!-- INPUT JUMLAH TAMPILAN PER HALAMAN -->
                <div class="col-xl-1 col-lg-1 col-md-4">
                    <input
                        type="number"
                        name="limit"
                        class="form-control ticket-select text-center"
                        placeholder="Jml"
                        min="1"
                        value="<?= esc($perPage) ?>"
                        title="Jumlah tiket per halaman"
                    >
                </div>


                <div class="col-xl-2 col-lg-2 col-md-6">

                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            id="filterButton"
                            class="btn btn-ticket-filter flex-grow-1"
                        >

                            <i class="fas fa-filter mr-1"></i>
                            Filter

                        </button>


                        <a
                            href="<?= base_url('petugas/tiket') ?>"
                            class="btn btn-ticket-reset"
                            title="Reset Filter"
                        >

                            <i class="fas fa-undo"></i>

                        </a>

                    </div>

                </div>

                <!-- TOMBOL EXPORT LAPORAN -->
                <div class="col-xl-2 col-lg-2 col-md-6 export-action-group">
                    <div class="export-dropdown">
                        <button type="button" class="btn btn-export-green w-100 d-flex align-items-center justify-content-center" id="dropdownExport" onclick="toggleExportMenu(event)">
                            <i class="fas fa-download mr-2"></i>
                            Export Laporan
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div class="export-menu" id="exportMenu">
                            <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/excel') ?>">
                                <i class="fas fa-file-excel mr-2" style="color:#0B8F4D;"></i> Export Excel
                            </a>
                            <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/pdf') ?>">
                                <i class="fas fa-file-pdf mr-2" style="color:#D93025;"></i> Export PDF
                            </a>
                            <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/csv') ?>">
                                <i class="fas fa-file-csv mr-2" style="color:#005BAC;"></i> Export CSV
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </form>

    </div>

</div>


<!-- =========================
     TABLE
========================= -->

<div class="card ticket-table-card reveal-item">

    <div class="ticket-table-header d-flex justify-content-between align-items-center">

        <div>

            <div class="ticket-table-title">

                <i class="fas fa-ticket-alt mr-2"></i>

                Daftar Tiket

                <?php if (
                    $searchValue !== '' ||
                    $statusValue !== '' ||
                    $kategoriValue !== ''
                ): ?>

                    <span
                        class="badge badge-light border px-2 py-1 ml-2"
                        style="font-size:.7rem;"
                    >
                        <i class="fas fa-filter mr-1"></i>
                        Hasil Filter
                    </span>

                <?php endif; ?>

            </div>

            <small class="text-muted">
                Kelola tiket masuk dan proses layanan mahasiswa.
            </small>

        </div>


        <span
            class="badge badge-light border px-3 py-2"
            id="ticketTotalBadge"
        >

            <?= $totalData ?> Tiket

        </span>

    </div>


    <div class="table-responsive">

        <table class="table ticket-table">

            <thead>

                <tr>

                    <th
                        class="text-center"
                        style="width:50px;"
                    >
                        No
                    </th>

                    <th>
                        No. Tiket
                    </th>

                    <th>
                        Nama Pemohon
                    </th>

                    <th>
                        NIK
                    </th>

                    <th>
                        Layanan
                    </th>

                    <th>
                        Kategori
                    </th>

                    <th>
                        Dokumen
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Tgl Pengajuan
                    </th>

                    <th
                        class="text-center"
                        style="width:140px;"
                    >
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

            <?php if (!empty($paginatedList)): ?>

                <?php foreach ($paginatedList as $row): ?>

                    <?php

                    $statusRow = strtolower(
                        trim($row['status'] ?? '')
                    );

                    $statusClass = 'status-submitted';
                    $statusIcon = 'fa-clock';

                    if ($statusRow === 'verified') {

                        $statusClass = 'status-verified';
                        $statusIcon = 'fa-check';

                    } elseif ($statusRow === 'disposisi') {

                        $statusClass = 'status-disposisi';
                        $statusIcon = 'fa-share-square';

                    } elseif ($statusRow === 'in progress') {

                        $statusClass = 'status-progress';
                        $statusIcon = 'fa-cogs';

                    } elseif ($statusRow === 'completed') {

                        $statusClass = 'status-completed';
                        $statusIcon = 'fa-check-circle';

                    } elseif ($statusRow === 'rejected') {

                        $statusClass = 'status-rejected';
                        $statusIcon = 'fa-times-circle';

                    }

                    ?>

                    <tr>

                        <!-- NOMOR URUT -->
                        <td class="text-center font-weight-bold text-muted">
                            <?= $no++ ?>
                        </td>


                        <!-- NOMOR TIKET -->
                        <td>

                            <a
                                href="<?= base_url('petugas/detail/' . $row['id']) ?>"
                                class="ticket-number"
                            >

                                <?= esc($row['nomor_tiket']) ?>

                            </a>

                        </td>


                        <!-- NAMA -->
                        <td>

                            <span class="ticket-name">
                                <?= esc($row['nama_pemohon']) ?>
                            </span>

                        </td>


                        <!-- NIK -->
                        <td>

                            <span class="ticket-nik">
                                <?= esc($row['nik'] ?? '-') ?>
                            </span>

                        </td>


                        <!-- LAYANAN -->
                        <td>
                            <?= esc($row['layanan']) ?>
                        </td>


                        <!-- KATEGORI -->
                        <td>

                            <span class="ticket-category">
                                <?= esc($row['kategori']) ?>
                            </span>

                        </td>


                        <!-- DOKUMEN -->
                        <td>

                            <?php if (!empty($row['dokumen'])): ?>

                                <span class="ticket-document document-available">

                                    <i class="fas fa-check-circle"></i>

                                    Ada

                                </span>

                            <?php else: ?>

                                <span class="ticket-document document-none">

                                    <i class="fas fa-times-circle"></i>

                                    Tidak Ada

                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- STATUS -->
                        <td>

                            <span class="ticket-status <?= $statusClass ?>">

                                <i class="fas <?= $statusIcon ?>"></i>

                                <?= esc($row['status']) ?>

                            </span>

                        </td>


                        <!-- TANGGAL -->
                        <td>

                            <?php if (!empty($row['created_at'])): ?>

                                <div class="ticket-date">

                                    <div>
                                        <?= date(
                                            'd-m-Y',
                                            strtotime($row['created_at'])
                                        ) ?>
                                    </div>

                                    <div>
                                        <?= date(
                                            'H:i:s',
                                            strtotime($row['created_at'])
                                        ) ?>
                                    </div>

                                </div>

                            <?php else: ?>

                                <span class="text-muted">
                                    -
                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- AKSI -->
                        <td>

                            <div class="ticket-actions">

                                <!-- DETAIL -->
                                <a
                                    href="<?= base_url('petugas/detail/' . $row['id']) ?>"
                                    class="ticket-action action-detail"
                                    title="Lihat Detail"
                                >

                                    <i class="fas fa-eye"></i>

                                </a>


                                <!-- VERIFIKASI -->
                                <a
                                    href="<?= base_url('petugas/verifikasi/' . $row['id']) ?>"
                                    class="ticket-action action-verify"
                                    title="Verifikasi Tiket"
                                >

                                    <i class="fas fa-user-check"></i>

                                </a>


                                <!-- DISPOSISI -->
                                <a
                                    href="<?= base_url('petugas/disposisi/' . $row['id']) ?>"
                                    class="ticket-action action-disposition"
                                    title="Disposisi Tiket"
                                >

                                    <i class="fas fa-share-square"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>


            <?php else: ?>

                <tr>

                    <td
                        colspan="10"
                        class="text-center ticket-empty"
                    >

                        <div class="ticket-empty-icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                        <h6 class="font-weight-bold text-dark mb-1">
                            Tidak Ada Tiket
                        </h6>

                        <p class="mb-0">
                            Tidak ada tiket yang sesuai dengan pencarian atau filter Anda.
                        </p>

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!-- =========================
         PAGINATION
    ========================== -->

    <?php if ($totalPages > 1): ?>

        <div class="ticket-pagination">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <small class="text-muted mb-2 mb-md-0">

                    Menampilkan

                    <strong>
                        <?= $totalData > 0 ? $offset + 1 : 0 ?>
                    </strong>

                    -

                    <strong>
                        <?= min($offset + $perPage, $totalData) ?>
                    </strong>

                    dari

                    <strong>
                        <?= $totalData ?>
                    </strong>

                    tiket

                </small>


                <nav aria-label="Navigasi halaman">

                    <ul class="pagination mb-0">

                        <!-- PREVIOUS -->

                        <li
                            class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>"
                        >

                            <?php if ($currentPage > 1): ?>

                                <a
                                    class="page-link"
                                    href="<?= ticketPageUrl($currentPage - 1, $queryParams) ?>"
                                >
                                    <i class="fas fa-chevron-left"></i>
                                </a>

                            <?php else: ?>

                                <span class="page-link">
                                    <i class="fas fa-chevron-left"></i>
                                </span>

                            <?php endif; ?>

                        </li>


                        <!-- NOMOR HALAMAN -->

                        <?php for ($page = 1; $page <= $totalPages; $page++): ?>

                            <li
                                class="page-item <?= $currentPage === $page ? 'active' : '' ?>"
                            >

                                <a
                                    class="page-link"
                                    href="<?= ticketPageUrl($page, $queryParams) ?>"
                                >

                                    <?= $page ?>

                                </a>

                            </li>

                        <?php endfor; ?>


                        <!-- NEXT -->

                        <li
                            class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>"
                        >

                            <?php if ($currentPage < $totalPages): ?>

                                <a
                                    class="page-link"
                                    href="<?= ticketPageUrl($currentPage + 1, $queryParams) ?>"
                                >
                                    <i class="fas fa-chevron-right"></i>
                                </a>

                            <?php else: ?>

                                <span class="page-link">
                                    <i class="fas fa-chevron-right"></i>
                                </span>

                            <?php endif; ?>

                        </li>

                    </ul>

                </nav>

            </div>

        </div>

    <?php endif; ?>


</div>

</div>


<script>
function toggleExportMenu(event) {
    event.stopPropagation();
    const menu = document.getElementById('exportMenu');
    if (menu) {
        menu.classList.toggle('show');
    }
}

// Menutup dropdown jika pengguna mengklik di luar area tombol/menu
document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.export-dropdown');
    const menu = document.getElementById('exportMenu');

    if (dropdown && menu && !dropdown.contains(event.target)) {
        menu.classList.remove('show');
    }
});

document.addEventListener("DOMContentLoaded", function () {

    /* =========================
       ANIMASI
    ========================== */

    const revealItems =
        document.querySelectorAll('.reveal-item');

    revealItems.forEach(function (item, index) {

        setTimeout(function () {

            item.classList.add('show');

        }, index * 80);

    });


    /* =========================
       FILTER LOADING
    ========================== */

    const filterForm =
        document.getElementById('ticketFilterForm');

    const filterButton =
        document.getElementById('filterButton');

    if (filterForm && filterButton) {

        filterForm.addEventListener('submit', function () {

            filterButton.classList.add('btn-loading');

            filterButton.innerHTML =
                '<i class="fas fa-spinner mr-1"></i> Memproses...';

        });

    }


    /* =========================
       CTRL + K SEARCH
    ========================== */

    document.addEventListener('keydown', function (event) {

        if (
            (event.ctrlKey || event.metaKey) &&
            event.key.toLowerCase() === 'k'
        ) {

            event.preventDefault();

            const searchInput =
                document.getElementById('ticketSearch');

            if (searchInput) {

                searchInput.focus();
                searchInput.select();

            }

        }

    });


    /* =========================
       KONFIRMASI DISPOSISI
    ========================== */

    document
        .querySelectorAll('.action-disposition')
        .forEach(function (button) {

            button.addEventListener('click', function (event) {

                const confirmed = confirm(
                    'Buka halaman disposisi untuk tiket ini?'
                );

                if (!confirmed) {

                    event.preventDefault();

                }

            });

        });


    /* =========================
       KONFIRMASI VERIFIKASI
    ========================== */

    document
        .querySelectorAll('.action-verify')
        .forEach(function (button) {

            button.addEventListener('click', function (event) {

                const confirmed = confirm(
                    'Buka halaman verifikasi untuk tiket ini?'
                );

                if (!confirmed) {

                    event.preventDefault();

                }

            });

        });


    /* =========================
       HOVER ACTION
    ========================== */

    document
        .querySelectorAll('.ticket-action')
        .forEach(function (button) {

            button.addEventListener('mouseenter', function () {

                this.style.transform = 'translateY(-2px) scale(1.05)';

            });

            button.addEventListener('mouseleave', function () {

                this.style.transform = '';

            });

        });

});

</script>

<?= $this->endSection() ?>