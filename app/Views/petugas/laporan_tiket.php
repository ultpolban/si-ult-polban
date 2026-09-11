<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<?php
/*
|--------------------------------------------------------------------------
| Data dari ReportController
|--------------------------------------------------------------------------
| $tickets berisi:
| ticket_number
| applicant_name
| applicant_type
| service_name
| status
| priority
| tanggal_pengajuan
| submitted_at
| created_at
*/

$tickets = $tickets ?? [];

/*
|--------------------------------------------------------------------------
| Statistik
|--------------------------------------------------------------------------
*/
$totalTiket = count($tickets);
$waitingVerification = 0;
$terverifikasi = 0;
$diproses = 0;

foreach ($tickets as $ticket) {
    $status = strtolower(trim($ticket['status'] ?? ''));

    switch ($status) {
        case 'submitted':
            $waitingVerification++;
            break;

        case 'verified':
            $terverifikasi++;
            break;

        case 'assigned':
        case 'disposisi':
        case 'in_progress':
        case 'in progress':
            $diproses++;
            break;
    }
}

/*
|--------------------------------------------------------------------------
| Filter
|--------------------------------------------------------------------------
*/
$keyword = $keyword ?? '';
$statusFilter = $status ?? '';
$kategori = $kategori ?? '';
$limit = (int) ($limit ?? 10);

if ($limit < 1) {
    $limit = 10;
}

if ($limit > 500) {
    $limit = 500;
}
?>

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

/* =========================
   STATISTIK
========================= */

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

/* =========================
   EXPORT
========================= */

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

/* =========================
   STATUS
========================= */

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

.status-completed {
    background: #d1e7dd;
    color: #0f5132;
}

.status-rejected {
    background: #f8d7da;
    color: #842029;
}

.status-cancelled {
    background: #e2e3e5;
    color: #41464b;
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
</style>

<div class="container-fluid px-4 py-4 ticket-page">

    <!-- HEADER -->
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
                    <a href="<?= base_url('dashboard') ?>">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active text-muted">
                    Laporan Tiket
                </li>
            </ol>
        </nav>
    </div>

    <!-- =========================
         STATISTIK
    ========================== -->

    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm reveal-item">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:0.72rem;">
                            Total Tiket
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= $totalTiket ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-ticket-alt"></i>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm reveal-item">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:0.72rem;">
                            Menunggu Verifikasi
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= $waitingVerification ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-clock"></i>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm reveal-item">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:0.72rem;">
                            Terverifikasi
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= $terverifikasi ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-user-check"></i>
                    </div>

                </div>

            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm reveal-item">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:0.72rem;">
                            Diproses / Disposisi
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= $diproses ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-cogs"></i>
                    </div>

                </div>

            </div>
        </div>

    </div>


    <!-- =========================
         FILTER
    ========================== -->

    <div class="card ticket-filter-card mb-4 reveal-item">

        <div class="card-body">

            <form action="<?= base_url('report') ?>" method="GET">

                <div class="row g-2 align-items-center">

                    <!-- SEARCH -->
                    <div class="col-xl-3 col-lg-3 col-md-12">

                        <div class="input-group ticket-input-group">

                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>

                            <input
                                type="text"
                                name="keyword"
                                class="form-control ticket-input"
                                placeholder="Cari No Tiket, Nama, NIK..."
                                value="<?= esc($keyword) ?>"
                            >

                        </div>

                    </div>


                    <!-- STATUS -->
                    <div class="col-xl-2 col-lg-2 col-md-4">

                        <select name="status"
                                class="form-control ticket-select">

                            <option value="">
                                -- Semua Status --
                            </option>

                            <option value="submitted"
                                <?= strtolower($statusFilter) === 'submitted' ? 'selected' : '' ?>>
                                Submitted
                            </option>

                            <option value="verified"
                                <?= strtolower($statusFilter) === 'verified' ? 'selected' : '' ?>>
                                Verified
                            </option>

                            <option value="assigned"
                                <?= strtolower($statusFilter) === 'assigned' ? 'selected' : '' ?>>
                                Disposisi
                            </option>

                            <option value="in_progress"
                                <?= strtolower($statusFilter) === 'in_progress' ? 'selected' : '' ?>>
                                In Progress
                            </option>

                            <option value="completed"
                                <?= strtolower($statusFilter) === 'completed' ? 'selected' : '' ?>>
                                Completed
                            </option>

                            <option value="rejected"
                                <?= strtolower($statusFilter) === 'rejected' ? 'selected' : '' ?>>
                                Rejected
                            </option>

                        </select>

                    </div>


                    <!-- KATEGORI -->
                    <div class="col-xl-2 col-lg-2 col-md-4">

                        <select name="kategori"
                                class="form-control ticket-select">

                            <option value="">
                                -- Semua Kategori --
                            </option>

                            <option value="Akademik"
                                <?= $kategori === 'Akademik' ? 'selected' : '' ?>>
                                Akademik
                            </option>

                            <option value="Keuangan"
                                <?= $kategori === 'Keuangan' ? 'selected' : '' ?>>
                                Keuangan
                            </option>

                            <option value="Kemahasiswaan"
                                <?= $kategori === 'Kemahasiswaan' ? 'selected' : '' ?>>
                                Kemahasiswaan
                            </option>

                        </select>

                    </div>


                    <!-- JUMLAH -->
                    <div class="col-xl-1 col-lg-1 col-md-4">

                        <input
                            type="number"
                            name="limit"
                            class="form-control ticket-number-input"
                            min="1"
                            max="500"
                            value="<?= esc($limit) ?>"
                            title="Atur jumlah baris tiket"
                        >

                    </div>


                    <!-- BUTTON -->
                    <div class="col-xl-2 col-lg-2 col-md-6">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-ticket-filter flex-grow-1">

                                <i class="fas fa-filter mr-1"></i>
                                Filter

                            </button>


                            <a
                                href="<?= base_url('report') ?>"
                                class="btn btn-ticket-reset"
                                title="Reset Filter">

                                <i class="fas fa-undo"></i>

                            </a>

                        </div>

                    </div>


                    <!-- EXPORT -->
                    <div class="col-xl-2 col-lg-2 col-md-6 export-action-group">

                        <div class="export-dropdown">

                            <button
                                type="button"
                                class="btn btn-export-green w-100 d-flex align-items-center justify-content-center"
                                id="dropdownExport"
                                onclick="toggleExportMenu(event)">

                                <i class="fas fa-download mr-2"></i>
                                Export Laporan
                                <i class="fas fa-chevron-down ml-2"></i>

                            </button>


                            <div
                                class="export-menu"
                                id="exportMenu">

                                <a
                                    class="dropdown-item"
                                    href="<?= base_url('report/excel') ?>">

                                    <i
                                        class="fas fa-file-excel mr-2"
                                        style="color:#0B8F4D;">
                                    </i>

                                    Export Excel

                                </a>


                                <a
                                    class="dropdown-item"
                                    href="<?= base_url('report/pdf') ?>">

                                    <i
                                        class="fas fa-file-pdf mr-2"
                                        style="color:#D93025;">
                                    </i>

                                    Export PDF

                                </a>


                                <a
                                    class="dropdown-item"
                                    href="<?= base_url('report/csv') ?>">

                                    <i
                                        class="fas fa-file-csv mr-2"
                                        style="color:#005BAC;">
                                    </i>

                                    Export CSV

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
    ========================== -->

    <div class="card ticket-table-card reveal-item">

        <div class="ticket-table-header d-flex justify-content-between align-items-center">

            <div>

                <div class="ticket-table-title">

                    <i class="fas fa-list-alt me-2"></i>
                    Data Laporan Tiket

                </div>

                <small class="text-muted">
                    Total: <?= count($tickets) ?> Data
                </small>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table ticket-table align-middle">

                <thead>

                    <tr class="text-center">

                        <th style="width:50px;">
                            No
                        </th>

                        <th>
                            No Tiket
                        </th>

                        <th>
                            Nama Pemohon
                        </th>

                        <th>
                            Jenis Pemohon
                        </th>

                        <th>
                            Layanan
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Prioritas
                        </th>

                        <th>
                            Tanggal Pengajuan
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if (!empty($tickets)): ?>

                    <?php
                    $no = 1;

                    foreach ($tickets as $row):

                        /*
                        |--------------------------------------------------------------------------
                        | STATUS
                        |--------------------------------------------------------------------------
                        | Status database:
                        | submitted
                        | verified
                        | assigned
                        | in_progress
                        | completed
                        | rejected
                        | cancelled
                        */

                        $st = strtolower(trim($row['status'] ?? 'submitted'));

                        $statusClass = 'status-submitted';
                        $statusLabel = 'Submitted';

                        if ($st === 'verified') {

                            $statusClass = 'status-verified';
                            $statusLabel = 'Verified';

                        } elseif (
                            $st === 'assigned' ||
                            $st === 'disposisi'
                        ) {

                            $statusClass = 'status-disposisi';
                            $statusLabel = 'Disposisi';

                        } elseif (
                            $st === 'in_progress' ||
                            $st === 'in progress'
                        ) {

                            $statusClass = 'status-disposisi';
                            $statusLabel = 'In Progress';

                        } elseif ($st === 'completed') {

                            $statusClass = 'status-completed';
                            $statusLabel = 'Completed';

                        } elseif ($st === 'rejected') {

                            $statusClass = 'status-rejected';
                            $statusLabel = 'Rejected';

                        } elseif ($st === 'cancelled') {

                            $statusClass = 'status-cancelled';
                            $statusLabel = 'Cancelled';

                        }

                        $tanggal = $row['tanggal_pengajuan']
                            ?? $row['submitted_at']
                            ?? $row['created_at']
                            ?? null;
                    ?>

                        <tr class="text-center">

                            <!-- NO -->
                            <td class="fw-bold text-muted">
                                <?= $no++ ?>
                            </td>


                            <!-- NOMOR TIKET -->
                            <td>

                                <a
                                    href="<?= base_url('datatiket/detail/' . ($row['id'] ?? 0)) ?>"
                                    class="fw-bold text-decoration-none"
                                    style="color:var(--polban-blue);">

                                    <?= esc($row['ticket_number'] ?? '-') ?>

                                </a>

                            </td>


                            <!-- NAMA -->
                            <td class="text-start fw-bold">

                                <?= esc($row['applicant_name'] ?? '-') ?>

                            </td>


                            <!-- JENIS PEMOHON -->
                            <td>

                                <span class="badge bg-light text-dark border px-2 py-1">

                                    <?= esc($row['applicant_type'] ?? '-') ?>

                                </span>

                            </td>


                            <!-- LAYANAN -->
                            <td class="text-start">

                                <?= esc($row['service_name'] ?? '-') ?>

                            </td>


                            <!-- STATUS -->
                            <td>

                                <span class="ticket-status <?= $statusClass ?>">

                                    <?= esc($statusLabel) ?>

                                </span>

                            </td>


                            <!-- PRIORITAS -->
                            <td>

                                <span class="badge bg-light text-dark border px-2 py-1">

                                    <?= esc(
                                        !empty($row['priority'])
                                            ? ucfirst($row['priority'])
                                            : 'Normal'
                                    ) ?>

                                </span>

                            </td>


                            <!-- TANGGAL -->
                            <td
                                class="text-muted"
                                style="font-size:0.85rem;">

                                <?php if (!empty($tanggal)): ?>

                                    <?= date('d-m-Y', strtotime($tanggal)) ?>

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="8"
                            class="text-center py-5 text-muted">

                            <i
                                class="fas fa-inbox fa-2x mb-3 d-block">
                            </i>

                            Belum ada data tiket.

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

    if (menu) {
        menu.classList.toggle('show');
    }

}


document.addEventListener('click', function(e) {

    const menu = document.getElementById('exportMenu');

    if (
        menu &&
        !menu.contains(e.target) &&
        e.target.id !== 'dropdownExport'
    ) {

        menu.classList.remove('show');

    }

});


document.addEventListener('DOMContentLoaded', function() {

    const reveals =
        document.querySelectorAll('.reveal-item');

    reveals.forEach((el, index) => {

        setTimeout(() => {

            el.classList.add('show');

        }, index * 80);

    });

});

</script>

<?= $this->endSection() ?>