<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

/* =========================================================
   HEADER
========================================================= */

.data-header {
    margin-bottom: 25px;
}

.data-title {
    font-size: 30px;
    font-weight: 700;
    color: #172033;
    margin-bottom: 5px;
}

.data-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}


/* =========================================================
   CARD
========================================================= */

.card-tiket {
    border: none;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,.08);
    overflow: hidden;
}

.card-tiket .card-header {
    background: #ffffff;
    border-bottom: 1px solid #eeeeee;
    padding: 20px;
}


/* =========================================================
   TABLE
========================================================= */

.table {
    margin-bottom: 0;
    min-width: 1100px;
}

.table thead th {
    background: #293582;
    color: #ffffff;
    font-weight: 600;
    vertical-align: middle;
    white-space: nowrap;
    padding: 14px 12px;
}

.table tbody td {
    vertical-align: middle;
    padding: 13px 12px;
}

.table tbody tr:hover {
    background: #f8f9ff;
}


/* =========================================================
   BADGE STATUS
========================================================= */

.badge-status {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.status-menunggu {
    background: #fff3cd;
    color: #856404;
}

.status-verifikasi {
    background: #e2d9f3;
    color: #59359a;
}

.status-revisi {
    background: #ffe5d0;
    color: #984c0c;
}

.status-diproses {
    background: #cfe2ff;
    color: #084298;
}

.status-selesai {
    background: #d1e7dd;
    color: #0f5132;
}

.status-ditolak {
    background: #f8d7da;
    color: #842029;
}

.status-dibatalkan {
    background: #e2e3e5;
    color: #41464b;
}


/* =========================================================
   BUTTON DETAIL
========================================================= */

.btn-detail {
    background: #293582;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 7px 13px;
    text-decoration: none;
    font-size: 13px;
    display: inline-block;
    white-space: nowrap;
}

.btn-detail:hover {
    background: #ff7f00;
    color: #ffffff;
}


/* =========================================================
   EMPTY DATA
========================================================= */

.empty-data {
    text-align: center;
    padding: 50px 20px;
    color: #6c757d;
}

.empty-data i {
    font-size: 45px;
    margin-bottom: 15px;
    color: #adb5bd;
}


/* =========================================================
   SEARCH
========================================================= */

.search-box {
    max-width: 300px;
}


/* =========================================================
   NOMOR TIKET
========================================================= */

.ticket-number {
    font-weight: 700;
    color: #293582;
    white-space: nowrap;
}


/* =========================================================
   NIK
========================================================= */

.nik-column {
    white-space: nowrap;
}


/* =========================================================
   LAYANAN
========================================================= */

.layanan-column {
    min-width: 230px;
}


/* =========================================================
   PEMOHON
========================================================= */

.pemohon-column {
    min-width: 140px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .data-title {
        font-size: 24px;
    }

    .search-box {
        max-width: 100%;
        width: 100%;
    }

}

</style>

<!-- =========================================================
     HEADER
========================================================= -->

<div class="data-header">

<h1 class="data-title">
    Data Tiket <?= esc($nama_unit ?? 'Unit Layanan') ?>
</h1>

<p class="data-subtitle">
    Daftar tiket layanan yang masuk ke unit
    <?= esc($nama_unit ?? 'Unit Layanan') ?>
</p>

</div>

<!-- =========================================================
     CARD DATA TIKET
========================================================= -->

<div class="card card-tiket">

<!-- =====================================================
     CARD HEADER
====================================================== -->

<div class="card-header">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h5 class="mb-1 fw-bold">
                Daftar Tiket
            </h5>

            <small class="text-muted">
                Data pengajuan tiket layanan
                <?= esc($nama_unit ?? 'Unit Layanan') ?>
            </small>

        </div>


        <!-- SEARCH -->

        <form
            method="get"
            action="<?= current_url() ?>"
            class="search-box"
        >

            <div class="input-group">

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari tiket..."
                    value="<?= esc($keyword ?? '') ?>"
                >

                <button
                    type="submit"
                    class="btn"
                    style="background:#293582;color:white;"
                >

                    <i class="fas fa-search"></i>

                </button>

            </div>

        </form>

    </div>

</div>


<!-- =====================================================
     TABLE
====================================================== -->

<div class="table-responsive">

    <table class="table table-bordered align-middle">

        <thead>

            <tr>

                <th>
                    No Tiket
                </th>

                <th>
                    Nama Pengaju
                </th>

                <th>
                    NIK
                </th>

                <th>
                    Jenis Layanan
                </th>

                <th>
                    Unit Layanan
                </th>

                <th>
                    Tanggal
                </th>

                <th>
                    Status
                </th>

                <th width="100">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>

        <?php if (!empty($tiket)): ?>

            <?php foreach ($tiket as $row): ?>

                <?php

                /* =================================================
                   NOMOR TIKET
                ================================================= */

                $noTiket =
                    $row['no_tiket']
                    ?? $row['ticket_number']
                    ?? '-';


                /* =================================================
                   NAMA PEMOHON
                ================================================= */

                $namaPemohon =
                    $row['nama_pemohon']
                    ?? $row['user_name']
                    ?? $row['name']
                    ?? 'Pemohon';


                /* =================================================
                   NIK
                ================================================= */

                $nik =
                    $row['nik']
                    ?? $row['NIK']
                    ?? '-';

                if ($nik === null || $nik === '') {
                    $nik = '-';
                }


                /* =================================================
                   JENIS LAYANAN
                ================================================= */

                $namaLayanan =
                    $row['nama_layanan']
                    ?? $row['service_name']
                    ?? $row['title']
                    ?? 'Layanan';


                /* =================================================
                   UNIT LAYANAN
                ================================================= */

                $namaUnit =
                    $row['nama_unit']
                    ?? $row['unit_name']
                    ?? ($nama_unit ?? 'Unit Layanan');


                /* =================================================
                   TANGGAL
                ================================================= */

                $tanggal =
                    $row['tanggal']
                    ?? $row['submitted_at']
                    ?? $row['created_at']
                    ?? null;


                /* =================================================
                   STATUS
                ================================================= */

                $status =
                    $row['status']
                    ?? 'Menunggu';

                $statusLower =
                    strtolower(
                        trim(
                            (string) $status
                        )
                    );


                /* =================================================
                   CLASS STATUS
                ================================================= */

                $statusClass = match ($statusLower) {

                    'menunggu',
                    'submitted'
                        => 'status-menunggu',

                    'verifikasi',
                    'verification'
                        => 'status-verifikasi',

                    'revisi',
                    'revision'
                        => 'status-revisi',

                    'diproses',
                    'processing'
                        => 'status-diproses',

                    'selesai',
                    'completed'
                        => 'status-selesai',

                    'ditolak',
                    'rejected'
                        => 'status-ditolak',

                    'dibatalkan',
                    'cancelled'
                        => 'status-dibatalkan',

                    default
                        => 'status-menunggu'
                };


                /* =================================================
                   FORMAT STATUS
                ================================================= */

                $statusTampil = match ($statusLower) {

                    'submitted'
                        => 'Menunggu',

                    'verification'
                        => 'Verifikasi',

                    'revision'
                        => 'Revisi',

                    'processing'
                        => 'Diproses',

                    'completed'
                        => 'Selesai',

                    'rejected'
                        => 'Ditolak',

                    'cancelled'
                        => 'Dibatalkan',

                    default
                        => $status
                };


                /* =================================================
                   ID TIKET
                ================================================= */

                $id =
                    $row['id']
                    ?? null;

                ?>

                <tr>

                    <!-- =================================================
                         NO TIKET
                    ================================================= -->

                    <td>

                        <span class="ticket-number">

                            <?= esc($noTiket) ?>

                        </span>

                    </td>


                    <!-- =================================================
                         NAMA PENGAJU
                    ================================================= -->

                    <td class="pemohon-column">

                        <?= esc($namaPemohon) ?>

                    </td>


                    <!-- =================================================
                         NIK
                    ================================================= -->

                    <td class="nik-column">

                        <?= esc($nik) ?>

                    </td>


                    <!-- =================================================
                         JENIS LAYANAN
                    ================================================= -->

                    <td class="layanan-column">

                        <?= esc($namaLayanan) ?>

                    </td>


                    <!-- =================================================
                         UNIT LAYANAN
                    ================================================= -->

                    <td>

                        <?= esc($namaUnit) ?>

                    </td>


                    <!-- =================================================
                         TANGGAL
                    ================================================= -->

                    <td>

                        <?php if ($tanggal): ?>

                            <?php

                            $timestamp =
                                strtotime(
                                    $tanggal
                                );

                            ?>

                            <?php if ($timestamp !== false): ?>

                                <?= date(
                                    'd-m-Y',
                                    $timestamp
                                ) ?>

                            <?php else: ?>

                                <?= esc($tanggal) ?>

                            <?php endif; ?>

                        <?php else: ?>

                            -

                        <?php endif; ?>

                    </td>


                    <!-- =================================================
                         STATUS
                    ================================================= -->

                    <td>

                        <span
                            class="badge-status <?= $statusClass ?>"
                        >

                            <?= esc($statusTampil) ?>

                        </span>

                    </td>


                    <!-- =================================================
                         AKSI
                    ================================================= -->

                    <td>

                        <?php if ($id): ?>

                            <a
                                href="<?= base_url(
                                    'unit-layanan/detail/' . $id
                                ) ?>"
                                class="btn-detail"
                            >

                                <i class="fas fa-eye"></i>

                                Detail

                            </a>

                        <?php else: ?>

                            <span class="text-muted">
                                -
                            </span>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <!-- =================================================
                 DATA KOSONG
            ================================================= -->

            <tr>

                <td colspan="8">

                    <div class="empty-data">

                        <i class="fas fa-ticket-alt d-block"></i>

                        <h5>
                            Belum Ada Data Tiket
                        </h5>

                        <p class="mb-0">

                            Belum terdapat tiket yang masuk
                            ke unit
                            <?= esc($nama_unit ?? 'ini') ?>.

                        </p>

                    </div>

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>


<!-- =====================================================
     PAGINATION
====================================================== -->

<?php if (
    isset($pager)
    && $pager
    && method_exists($pager, 'links')
): ?>

    <div class="p-3">

        <?= $pager->links() ?>

    </div>

<?php endif; ?>


</div>

<?= $this->endSection() ?>
