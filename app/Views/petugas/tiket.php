<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
/* =========================================================
   SI-ULT POLBAN - DATA TIKET
   Tema: Navy + Blue + Orange + Green
========================================================= */

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
   PAGE HEADER
========================= */

.ticket-page {
    animation: pageFadeIn 0.45s ease;
}

.ticket-title {
    color: var(--polban-navy);
    font-weight: 800;
    letter-spacing: -0.4px;
}

.ticket-subtitle {
    color: #718096;
    font-size: 0.95rem;
}

.ticket-breadcrumb {
    font-size: 0.9rem;
}

.ticket-breadcrumb a {
    color: var(--polban-blue);
    text-decoration: none;
    font-weight: 600;
}

/* =========================
   STATISTIC CARDS
========================= */

.ticket-stat-card {
    position: relative;
    overflow: hidden;
    border: 0;
    border-radius: 14px;
    min-height: 120px;
    color: white;
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease;
}

.ticket-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.14) !important;
}

.ticket-stat-card::after {
    content: "";
    position: absolute;
    width: 100px;
    height: 100px;
    right: -25px;
    bottom: -35px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
}

.stat-blue {
    background: linear-gradient(135deg, #005bac, #006fc9);
}

.stat-orange {
    background: linear-gradient(135deg, #ff8c00, #ff9f1c);
}

.stat-yellow {
    background: linear-gradient(135deg, #f4c400, #f8d323);
    color: #212529;
}

.stat-green {
    background: linear-gradient(135deg, #198754, #159957);
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.22);
    font-size: 1.25rem;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    line-height: 1;
}

.stat-label {
    font-size: 0.74rem;
    text-transform: uppercase;
    font-weight: 700;
    opacity: 0.85;
}

/* =========================
   FILTER CARD
========================= */

.ticket-filter-card {
    border: 0;
    border-radius: 14px;
    background: #ffffff;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
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
    font-size: 0.9rem;
}

.ticket-input:focus,
.ticket-select:focus {
    border-color: var(--polban-navy);
    box-shadow: 0 0 0 0.18rem rgba(26,35,126,0.12);
}

.ticket-select {
    height: 44px;
    border-radius: 8px;
    font-size: 0.9rem;
}

/* =========================
   BUTTON
========================= */

.btn-ticket-filter {
    height: 44px;
    border: 0;
    border-radius: 8px;
    background: var(--polban-navy);
    color: #fff;
    font-weight: 700;
    transition: all 0.25s ease;
}

.btn-ticket-filter:hover {
    background: #11185f;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 5px 12px rgba(26,35,126,0.25);
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
    transition: all 0.25s ease;
}

.btn-ticket-reset:hover {
    background: #545b62;
    color: #fff;
    transform: translateY(-1px);
}

/* =========================
   TABLE CARD
========================= */

.ticket-table-card {
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,0.07);
}

.ticket-table-header {
    background: #ffffff;
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

/* =========================
   TABLE
========================= */

.ticket-table {
    margin-bottom: 0;
}

.ticket-table thead {
    background: var(--polban-navy);
}

.ticket-table thead th {
    color: #fff;
    border: 0;
    font-size: 0.83rem;
    font-weight: 700;
    padding: 14px 12px;
    white-space: nowrap;
}

.ticket-table tbody td {
    padding: 15px 12px;
    vertical-align: middle;
    border-color: #edf0f4;
    font-size: 0.9rem;
}

.ticket-table tbody tr {
    transition:
        background-color 0.2s ease,
        transform 0.2s ease;
}

.ticket-table tbody tr:hover {
    background-color: #f8f9ff;
}

.ticket-number {
    color: var(--polban-blue);
    font-weight: 800;
    text-decoration: none;
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
    font-size: 0.87rem;
    font-weight: 500;
}

.ticket-document {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 6px;
    font-size: 0.76rem;
    font-weight: 700;
}

.document-available {
    background: #d1e7dd;
    color: #0f5132;
}

.document-none {
    background: #f8d7da;
    color: #842029;
}

.ticket-date {
    color: #59636e;
    font-size: 0.82rem;
    line-height: 1.5;
    white-space: nowrap;
}

/* =========================
   CATEGORY BADGE
========================= */

.ticket-category {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 6px;
    background: #f5f7fa;
    border: 1px solid #dee2e6;
    color: #344054;
    font-size: 0.76rem;
    font-weight: 700;
}

/* =========================
   STATUS BADGE
========================= */

.ticket-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 0.76rem;
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

/* =========================
   ACTION BUTTONS
========================= */

.ticket-actions {
    display: flex;
    justify-content: center;
    gap: 6px;
}

.ticket-action {
    width: 34px;
    height: 34px;
    border-radius: 7px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    border: 0;
    transition: all 0.2s ease;
}

.ticket-action:hover {
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,0.15);
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
   EMPTY STATE
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
   FILTER ACTIVE BADGE
========================= */

.filter-active-badge {
    display: inline-flex;
    align-items: center;
    margin-left: 8px;
    padding: 5px 9px;
    border-radius: 20px;
    background: #e8eaff;
    color: var(--polban-navy);
    font-size: 0.72rem;
    font-weight: 700;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 991px) {
    .ticket-actions {
        flex-wrap: wrap;
    }

    .ticket-table {
        min-width: 900px;
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
    transition: all 0.4s ease;
}

.filter-loading {
    opacity: 0.65;
    pointer-events: none;
}

.btn-loading i {
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style>


<div class="container-fluid px-4 py-4 ticket-page">

    <!-- ================================
         HEADER
    ================================= -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="ticket-title mb-1" style="font-size: 1.75rem;">
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


    <!-- ================================
         STATISTIC CARDS
    ================================= -->

    <?php
        $jumlahTiket = !empty($tiket_list)
            ? count($tiket_list)
            : 0;

        $jumlahSubmitted = 0;
        $jumlahVerified = 0;
        $jumlahDisposisi = 0;

        if (!empty($tiket_list)) {
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
        }
    ?>

    <div class="row g-3 mb-4">

        <!-- TOTAL -->
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


        <!-- SUBMITTED -->
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


        <!-- VERIFIED -->
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


        <!-- DISPOSISI -->
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


    <!-- ================================
         FILTER
    ================================= -->

    <div class="card ticket-filter-card mb-4 reveal-item">

        <div class="card-body">

            <form
                id="ticketFilterForm"
                action="<?= base_url('petugas/tiket') ?>"
                method="GET"
            >

                <div class="row g-2 align-items-center">

                    <!-- SEARCH -->

                    <div class="col-xl-5 col-lg-4 col-md-12">

                        <div class="input-group ticket-input-group">

                            <span class="input-group-text">

                                <i class="fas fa-search"></i>

                            </span>

                            <input
                                type="text"
                                name="search"
                                id="ticketSearch"
                                class="form-control ticket-input"
                               placeholder="Cari No Tiket, Nama, NIK, Layanan..."
                                value="<?= esc($search ?? '') ?>"
                            >

                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="col-xl-3 col-lg-3 col-md-6">

                        <select
                            name="status"
                            class="form-control ticket-select"
                        >

                            <option value="">
                                -- Semua Status --
                            </option>

                            <option
                                value="Submitted"
                                <?= (isset($status) && $status == 'Submitted') ? 'selected' : '' ?>
                            >
                                Submitted
                            </option>

                            <option
                                value="Verified"
                                <?= (isset($status) && $status == 'Verified') ? 'selected' : '' ?>
                            >
                                Verified
                            </option>

                            <option
                                value="Disposisi"
                                <?= (isset($status) && $status == 'Disposisi') ? 'selected' : '' ?>
                            >
                                Disposisi
                            </option>

                        </select>

                    </div>


                    <!-- KATEGORI -->

                    <div class="col-xl-2 col-lg-3 col-md-6">

                        <select
                            name="kategori"
                            class="form-control ticket-select"
                        >

                            <option value="">
                                -- Semua Kategori --
                            </option>

                            <option
                                value="Akademik"
                                <?= (isset($kategori) && $kategori == 'Akademik') ? 'selected' : '' ?>
                            >
                                Akademik
                            </option>

                            <option
                                value="Keuangan"
                                <?= (isset($kategori) && $kategori == 'Keuangan') ? 'selected' : '' ?>
                            >
                                Keuangan
                            </option>

                            <option
                                value="Kemahasiswaan"
                                <?= (isset($kategori) && $kategori == 'Kemahasiswaan') ? 'selected' : '' ?>
                            >
                                Kemahasiswaan
                            </option>

                        </select>

                    </div>


                    <!-- BUTTON -->

                    <div class="col-xl-2 col-lg-2 col-md-12">

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

                </div>

            </form>

        </div>

    </div>


    <!-- ================================
         TABLE
    ================================= -->

    <div class="card ticket-table-card reveal-item">

        <!-- TABLE HEADER -->

        <div class="ticket-table-header d-flex justify-content-between align-items-center">

            <div>

                <div class="ticket-table-title">

                    <i class="fas fa-ticket-alt mr-2"></i>

                    Daftar Tiket

                    <?php if (!empty($search) || !empty($status) || !empty($kategori)): ?>

                        <span class="filter-active-badge">

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

                <?= $jumlahTiket ?> Tiket

            </span>

        </div>


        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table ticket-table">

                <thead>
    <tr>

        <th class="text-center" style="width: 50px;">
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

        <th class="text-center">
            Aksi
        </th>

    </tr>
</thead>


                <tbody>

                <?php if (!empty($tiket_list)): ?>

                    <?php $no = 1; ?>

<?php foreach ($tiket_list as $row): ?>

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

                        <td class="text-center font-weight-bold text-muted">
    <?= $no++ ?>
</td>

                            <!-- NOMOR TIKET -->

                            <td class="pl-4">

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


                            <!-- NIM -->

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

                            <!-- TANGGAL PENGAJUAN -->

<td>

    <?php if (!empty($row['created_at'])): ?>

        <div class="ticket-date">

            <div>
                <?= date('d-m-Y', strtotime($row['created_at'])) ?>
            </div>

            <div>
                <?= date('H:i:s', strtotime($row['created_at'])) ?>
            </div>

        </div>

    <?php else: ?>

        <span class="text-muted">
            -
        </span>

    <?php endif; ?>

</td>


                            <!-- ACTION -->

                            <td>

                                <div class="ticket-actions">

                                    <!-- DETAIL -->

                                    <a
                                        href="<?= base_url('petugas/detail/' . $row['id']) ?>"
                                        class="ticket-action action-detail"
                                        title="Lihat Detail"
                                        data-tooltip="Lihat Detail Tiket"
                                    >

                                        <i class="fas fa-eye"></i>

                                    </a>


                                    <!-- VERIFIKASI -->

                                    <a
                                        href="<?= base_url('petugas/verifikasi/' . $row['id']) ?>"
                                        class="ticket-action action-verify"
                                        title="Verifikasi Tiket"
                                        data-tooltip="Verifikasi Tiket"
                                    >

                                        <i class="fas fa-user-check"></i>

                                    </a>


                                    <!-- DISPOSISI -->

                                    <a
                                        href="<?= base_url('petugas/disposisi/' . $row['id']) ?>"
                                        class="ticket-action action-disposition"
                                        title="Disposisi Tiket"
                                        data-tooltip="Disposisi Tiket"
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

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    /* ==========================================
       1. ANIMASI KARTU SAAT HALAMAN DIBUKA
    ========================================== */

    const revealItems = document.querySelectorAll('.reveal-item');

    revealItems.forEach((item, index) => {

        setTimeout(() => {

            item.classList.add('show');

        }, index * 80);

    });


    /* ==========================================
       2. FILTER LOADING ANIMATION
    ========================================== */

    const filterForm = document.getElementById('ticketFilterForm');
    const filterButton = document.getElementById('filterButton');

    if (filterForm && filterButton) {

        filterForm.addEventListener('submit', function () {

            filterButton.classList.add('btn-loading');

            filterButton.innerHTML =
                '<i class="fas fa-spinner mr-1"></i> Memproses...';

        });

    }


    /* ==========================================
       3. SEARCH SHORTCUT
       CTRL + K
    ========================================== */

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


    /* ==========================================
       4. HIGHLIGHT SEARCH RESULT
    ========================================== */

    const searchInput =
        document.getElementById('ticketSearch');

    if (searchInput) {

        searchInput.addEventListener('input', function () {

            const keyword =
                this.value.trim().toLowerCase();

            const rows =
                document.querySelectorAll(
                    '.ticket-table tbody tr'
                );

            rows.forEach(function (row) {

                const text =
                    row.innerText.toLowerCase();

                if (!keyword || text.includes(keyword)) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        });

    }


    /* ==========================================
       5. KONFIRMASI AKSI DISPOSISI
    ========================================== */

    const dispositionButtons =
        document.querySelectorAll('.action-disposition');

    dispositionButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            const confirmed = confirm(
                'Buka halaman disposisi untuk tiket ini?'
            );

            if (!confirmed) {

                event.preventDefault();

            }

        });

    });


    /* ==========================================
       6. KONFIRMASI VERIFIKASI
    ========================================== */

    const verifyButtons =
        document.querySelectorAll('.action-verify');

    verifyButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            const confirmed = confirm(
                'Buka halaman verifikasi tiket ini?'
            );

            if (!confirmed) {

                event.preventDefault();

            }

        });

    });

});

</script>

<?= $this->endSection() ?>