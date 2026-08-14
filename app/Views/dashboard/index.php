<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .dashboard-title {
        color: #182b80;
        font-weight: 700;
        font-size: 30px;
    }

    .dashboard-subtitle {
        color: #777;
        font-size: 16px;
    }

    /* STATISTIC BOX */
    .stat-card {
        border-radius: 12px;
        color: white;
        min-height: 105px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 3px 8px rgba(0,0,0,.12);
    }

    .stat-card .inner {
        padding: 20px;
        position: relative;
        z-index: 2;
    }

    .stat-card h3 {
        font-size: 27px;
        font-weight: 700;
        margin: 0 0 5px 0;
    }

    .stat-card p {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
    }

    .stat-card .stat-icon {
        position: absolute;
        right: 20px;
        top: 25px;
        font-size: 45px;
        opacity: .20;
    }

    .stat-blue {
        background: #202d87;
    }

    .stat-orange {
        background: #ff8b00;
    }

    .stat-yellow {
        background: #f5c400;
    }

    .stat-green {
        background: #128044;
    }

    /* QUICK ACTION */
    .quick-card {
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .section-header {
        background: #202d87;
        color: white;
        padding: 10px 16px;
        font-size: 18px;
        font-weight: 700;
    }

    .quick-body {
        padding: 16px;
    }

    .quick-btn {
        width: 100%;
        border: none;
        color: white !important;
        font-size: 17px;
        font-weight: 600;
        padding: 17px 10px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,.12);
    }

    .quick-orange {
        background: #ff8b00;
    }

    .quick-green {
        background: #128044;
    }

    .quick-yellow {
        background: #f5c400;
    }

    .quick-dark {
        background: #343a40;
    }

    /* FILTER */
    .filter-card {
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0,0,0,.10);
    }

    .filter-card .card-body {
        padding: 20px;
    }

    .filter-label {
        font-weight: 600;
        color: #666;
        margin-bottom: 7px;
    }

    .filter-control {
        height: 45px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .search-btn {
        height: 45px;
        border-radius: 8px;
        width: 100%;
        background: #ff8b00;
        border: none;
        color: white;
        font-weight: 600;
        font-size: 16px;
    }

    /* TABLE */
    .dashboard-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 8px rgba(0,0,0,.10);
    }

    .dashboard-table .table {
        margin-bottom: 0;
    }

    .dashboard-table thead {
        background: #202d87;
        color: white;
    }

    .dashboard-table thead th {
        padding: 14px 12px;
        font-weight: 600;
        border: none;
        white-space: nowrap;
    }

    .dashboard-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
    }

    .ticket-number {
        color: #1683df;
        font-weight: 700;
    }

    .priority-high {
        background: #dc3545;
        color: white;
    }

    .priority-medium {
        background: #ffc107;
        color: white;
    }

    .priority-low {
        background: #6c757d;
        color: white;
    }

    .status-badge {
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* BOTTOM CARDS */
    .bottom-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 8px rgba(0,0,0,.10);
        height: 100%;
    }

    .bottom-card-header {
        background: #202d87;
        color: white;
        padding: 13px 16px;
        font-size: 18px;
        font-weight: 700;
    }

    .sla-table {
        margin-bottom: 0;
    }

    .sla-table td,
    .sla-table th {
        padding: 15px;
        vertical-align: middle;
    }

    .sla-safe {
        background: #28a745;
        color: white;
    }

    .sla-warning {
        background: #ffc107;
        color: white;
    }

    .sla-danger {
        background: #dc3545;
        color: white;
    }

    /* ACTIVITY */
    .activity-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 8px rgba(0,0,0,.10);
    }

    .activity-header {
        background: #1683df;
        color: white;
        padding: 14px 18px;
        font-size: 18px;
        font-weight: 700;
    }

    .activity-date {
        display: inline-block;
        background: #1683df;
        color: white;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .activity-item {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .activity-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1683df;
        font-size: 20px;
        flex-shrink: 0;
    }

    .activity-content strong {
        display: block;
        font-size: 15px;
        margin-bottom: 3px;
    }

    .activity-content span {
        color: #777;
    }

    .empty-data {
        text-align: center;
        padding: 25px;
        color: #888;
    }

    @media(max-width: 768px) {
        .quick-btn {
            margin-bottom: 10px;
        }

        .dashboard-title {
            font-size: 24px;
        }
    }
</style>

<?php
/*
|--------------------------------------------------------------------------
| DATA DASHBOARD
|--------------------------------------------------------------------------
*/

$tiketMasuk = $total ?? 0;

$diverifikasi = $verified ?? 0;

$diprosesUnit = ($assigned ?? 0) + ($progress ?? 0);

/*
|--------------------------------------------------------------------------
| Hitung SLA dari tiket yang tersedia
|--------------------------------------------------------------------------
| Estimasi SLA = 3 hari.
*/
$terlambatSla = 0;

if (!empty($tickets)) {
    foreach ($tickets as $t) {

        if (
            !empty($t['submitted_at']) &&
            !in_array($t['status'], ['Completed', 'Rejected'])
        ) {

            $tanggalMasuk = strtotime($t['submitted_at']);
            $sekarang     = time();

            $selisihHari = floor(
                ($sekarang - $tanggalMasuk) / 86400
            );

            if ($selisihHari > 3) {
                $terlambatSla++;
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| Status badge
|--------------------------------------------------------------------------
*/
function dashboardStatusBadge($status)
{
    switch ($status) {

        case 'Submitted':
            return 'warning';

        case 'Verified':
            return 'success';

        case 'Assigned':
            return 'info';

        case 'In Progress':
            return 'primary';

        case 'Completed':
            return 'success';

        case 'Need Revision':
            return 'dark';

        case 'Rejected':
            return 'danger';

        default:
            return 'secondary';
    }
}

/*
|--------------------------------------------------------------------------
| Priority badge
|--------------------------------------------------------------------------
*/
function dashboardPriorityBadge($priority)
{
    switch (strtolower($priority ?? '')) {

        case 'high':
        case 'tinggi':
            return 'priority-high';

        case 'medium':
        case 'sedang':
            return 'priority-medium';

        case 'low':
        case 'rendah':
            return 'priority-low';

        default:
            return 'priority-low';
    }
}

/*
|--------------------------------------------------------------------------
| Cari tiket prioritas tinggi
|--------------------------------------------------------------------------
*/
$tiketPrioritas = [];

if (!empty($tickets)) {

    foreach ($tickets as $t) {

        $priority = strtolower($t['priority'] ?? '');

        if (
            $priority === 'high' ||
            $priority === 'tinggi'
        ) {
            $tiketPrioritas[] = $t;
        }
    }
}

/*
|--------------------------------------------------------------------------
| Ambil maksimal 5 tiket prioritas
|--------------------------------------------------------------------------
*/
$tiketPrioritas = array_slice($tiketPrioritas, 0, 5);
?>

<!-- ========================================================= -->
<!-- HEADER -->
<!-- ========================================================= -->

<section class="content-header">
    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-8">

                <h1 class="dashboard-title">
                    Dashboard Petugas ULT
                </h1>

                <div class="dashboard-subtitle">
                    Kelola tiket layanan mahasiswa Politeknik Negeri Bandung.
                </div>

            </div>

            <div class="col-sm-4 text-right">

                <div class="text-muted mt-2">
                    <span style="color:#1683df;">
                        Dashboard
                    </span>
                    &nbsp;/&nbsp;
                    Home
                </div>

            </div>

        </div>

    </div>
</section>


<section class="content">

<div class="container-fluid">


<!-- ========================================================= -->
<!-- STATISTIK -->
<!-- ========================================================= -->

<div class="row mb-4">

    <!-- Tiket Masuk -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-blue">

            <div class="inner">

                <h3>
                    <?= $tiketMasuk ?>
                </h3>

                <p>
                    Tiket Masuk
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-envelope"></i>
            </div>

        </div>

    </div>


    <!-- Diverifikasi -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-orange">

            <div class="inner">

                <h3>
                    <?= $diverifikasi ?>
                </h3>

                <p>
                    Diverifikasi
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>

        </div>

    </div>


    <!-- Diproses Unit -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-yellow">

            <div class="inner">

                <h3>
                    <?= $diprosesUnit ?>
                </h3>

                <p>
                    Diproses Unit
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-spinner"></i>
            </div>

        </div>

    </div>


    <!-- Terlambat SLA -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-green">

            <div class="inner">

                <h3>
                    <?= $terlambatSla ?>
                </h3>

                <p>
                    Terlambat SLA
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- QUICK ACTION -->
<!-- ========================================================= -->

<div class="quick-card mb-4">

    <div class="section-header">

        <i class="fas fa-bolt"></i>
        Quick Action

    </div>

    <div class="quick-body">

        <div class="row">

            <div class="col-md-3 mb-2">

                <a
                    href="<?= base_url('datatiket') ?>"
                    class="quick-btn quick-orange"
                >

                    <i class="fas fa-ticket-alt fa-lg"></i>

                    Data Tiket

                </a>

            </div>


            <div class="col-md-3 mb-2">

                <a
                    href="<?= base_url('verification') ?>"
                    class="quick-btn quick-green"
                >

                    <i class="fas fa-user-check fa-lg"></i>

                    Verifikasi

                </a>

            </div>


            <div class="col-md-3 mb-2">

                <a
                    href="<?= base_url('disposisi') ?>"
                    class="quick-btn quick-yellow"
                >

                    <i class="fas fa-share-square fa-lg"></i>

                    Disposisi

                </a>

            </div>


            <div class="col-md-3 mb-2">

                <button
                    type="button"
                    onclick="location.reload()"
                    class="quick-btn quick-dark"
                >

                    <i class="fas fa-sync-alt fa-lg"></i>

                    Refresh

                </button>

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- FILTER TIKET -->
<!-- ========================================================= -->

<div class="card filter-card mb-4">

    <div class="section-header">

        <i class="fas fa-filter"></i>
        Filter Tiket

    </div>

    <div class="card-body">

        <div class="row">

            <!-- STATUS -->

            <div class="col-md-3 mb-3">

                <label class="filter-label">
                    Status
                </label>

                <select
                    id="filterStatus"
                    class="form-control filter-control"
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option value="Submitted">
                        Submitted
                    </option>

                    <option value="Verified">
                        Verified
                    </option>

                    <option value="Assigned">
                        Assigned
                    </option>

                    <option value="In Progress">
                        In Progress
                    </option>

                    <option value="Completed">
                        Completed
                    </option>

                    <option value="Need Revision">
                        Need Revision
                    </option>

                    <option value="Rejected">
                        Rejected
                    </option>

                </select>

            </div>


            <!-- KATEGORI -->

            <div class="col-md-3 mb-3">

                <label class="filter-label">
                    Kategori
                </label>

                <select
                    id="filterKategori"
                    class="form-control filter-control"
                >

                    <option value="">
                        Semua Kategori
                    </option>

                    <?php

                    $kategori = [];

                    if (!empty($tickets)) {

                        foreach ($tickets as $ticket) {

                            $layanan = $ticket['service_name'] ?? '';

                            if (
                                $layanan &&
                                !in_array($layanan, $kategori)
                            ) {
                                $kategori[] = $layanan;
                            }

                        }

                    }

                    foreach ($kategori as $k):

                    ?>

                        <option value="<?= esc($k) ?>">
                            <?= esc($k) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- PRIORITAS -->

            <div class="col-md-2 mb-3">

                <label class="filter-label">
                    Prioritas
                </label>

                <select
                    id="filterPrioritas"
                    class="form-control filter-control"
                >

                    <option value="">
                        Semua Prioritas
                    </option>

                    <option value="High">
                        High
                    </option>

                    <option value="Medium">
                        Medium
                    </option>

                    <option value="Low">
                        Low
                    </option>

                </select>

            </div>


            <!-- UNIT -->

            <div class="col-md-2 mb-3">

                <label class="filter-label">
                    Unit Tujuan
                </label>

                <select
                    id="filterUnit"
                    class="form-control filter-control"
                >

                    <option value="">
                        Semua Unit
                    </option>

                    <?php

                    $units = [];

                    if (!empty($tickets)) {

                        foreach ($tickets as $ticket) {

                            $unit = $ticket['assigned_unit'] ?? '';

                            if (
                                $unit &&
                                !in_array($unit, $units)
                            ) {
                                $units[] = $unit;
                            }

                        }

                    }

                    foreach ($units as $unit):

                    ?>

                        <option value="<?= esc($unit) ?>">
                            <?= esc($unit) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- BUTTON -->

            <div class="col-md-2 mb-3">

                <label class="filter-label">
                    &nbsp;
                </label>

                <button
                    type="button"
                    onclick="filterTickets()"
                    class="search-btn"
                >

                    <i class="fas fa-search"></i>
                    Cari

                </button>

            </div>

        </div>


        <!-- KEYWORD -->

        <div class="row">

            <div class="col-md-12">

                <label class="filter-label">
                    Pencarian Keyword
                </label>

                <input
                    type="text"
                    id="filterKeyword"
                    class="form-control filter-control"
                    placeholder="Cari Nama / NIM / Nomor Tiket..."
                    onkeyup="filterTickets()"
                >

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- ANTRIAN TIKET TERBARU -->
<!-- ========================================================= -->

<div class="dashboard-table mb-4">

    <div class="section-header">

        <i class="fas fa-inbox"></i>

        Antrian Tiket Terbaru

        <a
            href="<?= base_url('datatiket') ?>"
            class="btn btn-sm btn-light float-right"
        >

            <i class="fas fa-list"></i>
            Lihat Semua

        </a>

    </div>


    <div class="table-responsive">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>No Tiket</th>

                    <th>Mahasiswa</th>

                    <th>Layanan</th>

                    <th>Prioritas</th>

                    <th>Status</th>

                    <th>Tanggal</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody id="ticketTable">

            <?php if (!empty($tickets)): ?>

                <?php foreach ($tickets as $ticket): ?>

                    <tr
                        class="ticket-row"

                        data-status="<?= esc($ticket['status'] ?? '') ?>"

                        data-kategori="<?= esc($ticket['service_name'] ?? '') ?>"

                        data-prioritas="<?= esc($ticket['priority'] ?? '') ?>"

                        data-unit="<?= esc($ticket['assigned_unit'] ?? '') ?>"

                        data-keyword="
                            <?= esc(
                                ($ticket['ticket_number'] ?? '') . ' ' .
                                ($ticket['applicant_name'] ?? '') . ' ' .
                                ($ticket['nim'] ?? '')
                            ) ?>
                        "
                    >

                        <!-- NOMOR -->

                        <td>

                            <span class="ticket-number">

                                <?= esc(
                                    $ticket['ticket_number'] ?? '-'
                                ) ?>

                            </span>

                        </td>


                        <!-- MAHASISWA -->

                        <td>

                            <?= esc(
                                $ticket['applicant_name'] ?? '-'
                            ) ?>

                        </td>


                        <!-- LAYANAN -->

                        <td>

                            <?= esc(
                                $ticket['service_name'] ?? '-'
                            ) ?>

                        </td>


                        <!-- PRIORITAS -->

                        <td>

                            <span
                                class="status-badge
                                <?= dashboardPriorityBadge(
                                    $ticket['priority'] ?? ''
                                ) ?>"
                            >

                                <?= esc(
                                    $ticket['priority'] ?? 'Low'
                                ) ?>

                            </span>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <span
                                class="status-badge badge-<?= dashboardStatusBadge(
                                    $ticket['status'] ?? ''
                                ) ?>"
                            >

                                <?= esc(
                                    $ticket['status'] ?? '-'
                                ) ?>

                            </span>

                        </td>


                        <!-- TANGGAL -->

                        <td>

                            <?php if (!empty($ticket['submitted_at'])): ?>

                                <?= date(
                                    'd F Y',
                                    strtotime(
                                        $ticket['submitted_at']
                                    )
                                ) ?>

                            <?php else: ?>

                                -

                            <?php endif; ?>

                        </td>


                        <!-- AKSI -->

                        <td>

                            <a
                                href="<?= base_url(
                                    'verification/detail/' .
                                    ($ticket['id'] ?? '')
                                ) ?>"
                                class="btn btn-sm btn-info"
                                title="Lihat Detail"
                            >

                                <i class="fas fa-eye"></i>

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td
                        colspan="7"
                        class="empty-data"
                    >

                        <i class="fas fa-inbox fa-2x mb-2"></i>

                        <br>

                        Belum ada tiket.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<!-- ========================================================= -->
<!-- TIKET PRIORITAS + MONITORING SLA -->
<!-- ========================================================= -->

<div class="row mb-4">


    <!-- PRIORITAS TINGGI -->

    <div class="col-md-6 mb-3">

        <div class="bottom-card">

            <div class="bottom-card-header">

                <i class="fas fa-exclamation-triangle"></i>

                Tiket Prioritas Tinggi

            </div>


            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>

                        <tr>

                            <th>No Tiket</th>

                            <th>Mahasiswa</th>

                            <th>Layanan</th>

                            <th>SLA</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (!empty($tiketPrioritas)): ?>

                        <?php foreach ($tiketPrioritas as $ticket): ?>

                            <?php

                            $slaText = 'Aman';

                            $slaClass = 'badge-success';

                            if (!empty($ticket['submitted_at'])) {

                                $hari = floor(
                                    (
                                        time() -
                                        strtotime(
                                            $ticket['submitted_at']
                                        )
                                    ) / 86400
                                );

                                if ($hari >= 3) {

                                    $slaText = 'Hari Ini';
                                    $slaClass = 'badge-danger';

                                } elseif ($hari >= 2) {

                                    $slaText = '1 Hari';
                                    $slaClass = 'badge-warning';

                                }

                            }

                            ?>

                            <tr>

                                <td>

                                    <span class="ticket-number">

                                        <?= esc(
                                            $ticket['ticket_number'] ?? '-'
                                        ) ?>

                                    </span>

                                </td>

                                <td>

                                    <?= esc(
                                        $ticket['applicant_name'] ?? '-'
                                    ) ?>

                                </td>

                                <td>

                                    <?= esc(
                                        $ticket['service_name'] ?? '-'
                                    ) ?>

                                </td>

                                <td>

                                    <span
                                        class="badge <?= $slaClass ?>"
                                    >

                                        <?= $slaText ?>

                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="4"
                                class="empty-data"
                            >

                                Tidak ada tiket prioritas tinggi.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- MONITORING SLA -->

    <div class="col-md-6 mb-3">

        <div class="bottom-card">

            <div class="bottom-card-header">

                <i class="fas fa-clock"></i>

                Monitoring SLA

            </div>


            <div class="table-responsive">

                <table class="table sla-table">

                    <thead>

                        <tr>

                            <th>Status SLA</th>

                            <th>Jumlah</th>

                            <th>Keterangan</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php

                        $aman = max(
                            0,
                            ($total ?? 0)
                            - $terlambatSla
                        );

                        $mendekati = 0;

                        if (!empty($tickets)) {

                            foreach ($tickets as $ticket) {

                                if (
                                    empty(
                                        $ticket['submitted_at']
                                    )
                                ) {
                                    continue;
                                }

                                if (
                                    in_array(
                                        $ticket['status'],
                                        ['Completed', 'Rejected']
                                    )
                                ) {
                                    continue;
                                }

                                $hari = floor(
                                    (
                                        time() -
                                        strtotime(
                                            $ticket['submitted_at']
                                        )
                                    ) / 86400
                                );

                                if (
                                    $hari >= 2 &&
                                    $hari <= 3
                                ) {
                                    $mendekati++;
                                }

                            }

                        }

                        ?>

                        <tr>

                            <td>

                                <span
                                    class="badge sla-safe"
                                >

                                    Aman

                                </span>

                            </td>

                            <td>

                                <strong>
                                    <?= $aman ?>
                                </strong>

                            </td>

                            <td>
                                Masih dalam batas SLA
                            </td>

                        </tr>


                        <tr>

                            <td>

                                <span
                                    class="badge sla-warning"
                                >

                                    Mendekati Deadline

                                </span>

                            </td>

                            <td>

                                <strong>
                                    <?= $mendekati ?>
                                </strong>

                            </td>

                            <td>
                                &lt; 24 Jam
                            </td>

                        </tr>


                        <tr>

                            <td>

                                <span
                                    class="badge sla-danger"
                                >

                                    Melewati SLA

                                </span>

                            </td>

                            <td>

                                <strong>
                                    <?= $terlambatSla ?>
                                </strong>

                            </td>

                            <td>
                                Harus segera diproses
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- AKTIVITAS TERBARU -->
<!-- ========================================================= -->

<div class="activity-card mb-4">

    <div class="activity-header">

        <i class="fas fa-history"></i>

        Aktivitas Terbaru

    </div>


    <div class="card-body">

        <div class="activity-date">

            <?= date('d F Y') ?>

        </div>


        <?php if (!empty($tickets)): ?>

            <?php

            $activityTickets = array_slice(
                $tickets,
                0,
                5
            );

            ?>

            <?php foreach ($activityTickets as $ticket): ?>

                <div class="activity-item">

                    <div class="activity-icon">

                        <?php

                        $activityIcon =
                            'fa-file-alt';

                        if (
                            ($ticket['status'] ?? '') ===
                            'Verified'
                        ) {
                            $activityIcon =
                                'fa-check-circle';
                        }

                        if (
                            ($ticket['status'] ?? '') ===
                            'Assigned'
                        ) {
                            $activityIcon =
                                'fa-share-square';
                        }

                        if (
                            ($ticket['status'] ?? '') ===
                            'Completed'
                        ) {
                            $activityIcon =
                                'fa-check-double';
                        }

                        ?>

                        <i class="fas <?= $activityIcon ?>"></i>

                    </div>


                    <div class="activity-content">

                        <strong>

                            <?= esc(
                                $ticket['status'] ?? 'Aktivitas Tiket'
                            ) ?>

                        </strong>


                        <span>

                            <strong
                                style="
                                display:inline;
                                color:#333;
                                "
                            >

                                <?= esc(
                                    $ticket['applicant_name'] ?? '-'
                                ) ?>

                            </strong>

                            mengajukan

                            <?= esc(
                                $ticket['service_name'] ?? '-'
                            ) ?>

                            .

                        </span>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-data">

                Belum ada aktivitas terbaru.

            </div>

        <?php endif; ?>

    </div>

</div>


</div>

</section>


<!-- ========================================================= -->
<!-- FILTER JAVASCRIPT -->
<!-- ========================================================= -->

<script>

function filterTickets()
{
    const status =
        document.getElementById('filterStatus')
        .value
        .toLowerCase();

    const kategori =
        document.getElementById('filterKategori')
        .value
        .toLowerCase();

    const prioritas =
        document.getElementById('filterPrioritas')
        .value
        .toLowerCase();

    const unit =
        document.getElementById('filterUnit')
        .value
        .toLowerCase();

    const keyword =
        document.getElementById('filterKeyword')
        .value
        .toLowerCase();

    const rows =
        document.querySelectorAll('.ticket-row');

    rows.forEach(function(row)
    {

        const rowStatus =
            row.dataset.status
            .toLowerCase();

        const rowKategori =
            row.dataset.kategori
            .toLowerCase();

        const rowPrioritas =
            row.dataset.prioritas
            .toLowerCase();

        const rowUnit =
            row.dataset.unit
            .toLowerCase();

        const rowKeyword =
            row.dataset.keyword
            .toLowerCase();

        const statusMatch =
            !status ||
            rowStatus === status;

        const kategoriMatch =
            !kategori ||
            rowKategori === kategori;

        const prioritasMatch =
            !prioritas ||
            rowPrioritas === prioritas;

        const unitMatch =
            !unit ||
            rowUnit === unit;

        const keywordMatch =
            !keyword ||
            rowKeyword.includes(keyword);

        if (
            statusMatch &&
            kategoriMatch &&
            prioritasMatch &&
            unitMatch &&
            keywordMatch
        ) {

            row.style.display = '';

        } else {

            row.style.display = 'none';

        }

    });
}

</script>


<?= $this->endSection() ?>