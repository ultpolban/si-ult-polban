<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
    /*
    |--------------------------------------------------------------------------
    | DATA TIKET UPT TIK
    |--------------------------------------------------------------------------
    | Halaman ini khusus untuk UPT TIK.
    |
    | Tidak menggunakan:
    | - Controller Akademik
    | - Model Akademik
    | - Route Akademik
    | - Tabel tiket Akademik
    |
    | Data berasal dari controller UPT TIK melalui $tiket.
    |--------------------------------------------------------------------------
    */

    $nama_unit = (string) (
        $nama_unit
        ?? 'UPT Teknologi Informasi dan Komunikasi'
    );

    $keyword = (string) (
        $keyword
        ?? ''
    );

    $tiket = is_array($tiket ?? null)
        ? $tiket
        : [];
?>


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

    box-shadow:
        0 8px 25px
        rgba(0, 0, 0, .08);

    overflow: hidden;
}

.card-tiket .card-header {
    background: #ffffff;

    border-bottom:
        1px solid #eeeeee;

    padding: 20px;
}


/* =========================================================
   TABLE
========================================================= */

.tiket-table {
    margin-bottom: 0;

    min-width: 1100px;
}

.tiket-table thead th {
    background: #293582;

    color: #ffffff;

    font-weight: 600;

    vertical-align: middle;

    white-space: nowrap;

    padding: 14px 12px;
}

.tiket-table tbody td {
    vertical-align: middle;

    padding: 13px 12px;
}

.tiket-table tbody tr:hover {
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


/* MENUNGGU */

.status-menunggu {
    background: #fff3cd;

    color: #856404;
}


/* VERIFIKASI */

.status-verifikasi {
    background: #e2d9f3;

    color: #59359a;
}


/* REVISI */

.status-revisi {
    background: #ffe5d0;

    color: #984c0c;
}


/* DIPROSES */

.status-diproses {
    background: #cfe2ff;

    color: #084298;
}


/* SELESAI */

.status-selesai {
    background: #d1e7dd;

    color: #0f5132;
}


/* DITOLAK */

.status-ditolak {
    background: #f8d7da;

    color: #842029;
}


/* DIBATALKAN */

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

    transition: .2s;
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

.empty-data h5 {
    color: #6c757d;

    font-weight: 600;
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
   IDENTITAS
========================================================= */

.identitas-column {
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
    min-width: 160px;
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

    .tiket-table {
        font-size: 13px;

        min-width: 100%;
    }

    .tiket-table thead th {
        padding: 10px 8px;
    }

    .tiket-table tbody td {
        padding: 10px 8px;
    }

}

</style>


<!-- =========================================================
     HEADER
========================================================= -->

<div class="data-header">

    <h1 class="data-title">

        Data Tiket UPT TIK

    </h1>


    <p class="data-subtitle">

        Daftar tiket layanan yang dikelola secara mandiri oleh
        <?= esc($nama_unit) ?>

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

        <div
            class="
                d-flex
                justify-content-between
                align-items-center
                flex-wrap
                gap-3
            "
        >


            <!-- =================================================
                 JUDUL CARD
            ================================================== -->

            <div>

                <h5 class="mb-1 fw-bold">

                    Daftar Tiket

                </h5>


                <small class="text-muted">

                    Data pengajuan tiket layanan
                    <?= esc($nama_unit) ?>

                </small>

            </div>



            <!-- =================================================
                 SEARCH
            ================================================== -->

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
                        value="<?= esc($keyword) ?>"
                    >


                    <button
                        type="submit"
                        class="btn"
                        style="
                            background:#293582;
                            color:white;
                        "
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

        <table
            class="
                table
                table-bordered
                align-middle
                tiket-table
            "
        >


            <!-- =================================================
                 TABLE HEADER
            ================================================== -->

            <thead>

                <tr>

                    <th>
                        No Tiket
                    </th>

                    <th>
                        Nama Pengaju
                    </th>

                    <th>
                        Identitas
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



            <!-- =================================================
                 TABLE BODY
            ================================================== -->

            <tbody>


            <?php if (!empty($tiket)): ?>


                <?php foreach ($tiket as $row): ?>


                    <?php

                    /*
                    |--------------------------------------------------------------------------
                    | DATA TIKET
                    |--------------------------------------------------------------------------
                    */

                    $id = (int) (
                        $row['id']
                        ?? 0
                    );


                    $ticketNumber = (string) (
                        $row['ticket_number']
                        ?? '-'
                    );


                    $applicantName = (string) (
                        $row['applicant_name']
                        ?? 'Pemohon'
                    );


                    $applicantIdentifier = (
                        $row['applicant_identifier']
                        ?? null
                    );

                    if (
                        $applicantIdentifier === null
                        ||
                        $applicantIdentifier === ''
                    ) {

                        $applicantIdentifier = '-';

                    }


                    $serviceName = (string) (
                        $row['service_name']
                        ?? 'Layanan'
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | UNIT LAYANAN
                    |--------------------------------------------------------------------------
                    */

                    $unitLayanan = (string) (
                        $row['unit_name']
                        ?? $row['nama_unit']
                        ?? $nama_unit
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | TANGGAL
                    |--------------------------------------------------------------------------
                    */

                    $tanggal = (
                        $row['created_at']
                        ?? $row['submitted_at']
                        ?? $row['tanggal']
                        ?? null
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | STATUS
                    |--------------------------------------------------------------------------
                    */

                    $status = strtolower(
                        trim(
                            (string) (
                                $row['status']
                                ?? 'submitted'
                            )
                        )
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | LABEL STATUS
                    |--------------------------------------------------------------------------
                    */

                    $statusLabels = [

                        'submitted'
                            => 'Menunggu',

                        'menunggu'
                            => 'Menunggu',

                        'verification'
                            => 'Verifikasi',

                        'verifikasi'
                            => 'Verifikasi',

                        'revision'
                            => 'Revisi',

                        'revisi'
                            => 'Revisi',

                        'processing'
                            => 'Diproses',

                        'diproses'
                            => 'Diproses',

                        'completed'
                            => 'Selesai',

                        'selesai'
                            => 'Selesai',

                        'rejected'
                            => 'Ditolak',

                        'ditolak'
                            => 'Ditolak',

                        'cancelled'
                            => 'Dibatalkan',

                        'dibatalkan'
                            => 'Dibatalkan',

                    ];


                    $statusTampil =
                        $statusLabels[$status]
                        ?? ucfirst($status);


                    /*
                    |--------------------------------------------------------------------------
                    | CLASS STATUS
                    |--------------------------------------------------------------------------
                    */

                    $statusClasses = [

                        'submitted'
                            => 'status-menunggu',

                        'menunggu'
                            => 'status-menunggu',

                        'verification'
                            => 'status-verifikasi',

                        'verifikasi'
                            => 'status-verifikasi',

                        'revision'
                            => 'status-revisi',

                        'revisi'
                            => 'status-revisi',

                        'processing'
                            => 'status-diproses',

                        'diproses'
                            => 'status-diproses',

                        'completed'
                            => 'status-selesai',

                        'selesai'
                            => 'status-selesai',

                        'rejected'
                            => 'status-ditolak',

                        'ditolak'
                            => 'status-ditolak',

                        'cancelled'
                            => 'status-dibatalkan',

                        'dibatalkan'
                            => 'status-dibatalkan',

                    ];


                    $statusClass =
                        $statusClasses[$status]
                        ?? 'status-menunggu';


                    ?>


                    <tr>


                        <!-- =====================================
                             NO TIKET
                        ====================================== -->

                        <td>

                            <span class="ticket-number">

                                <?= esc($ticketNumber) ?>

                            </span>

                        </td>



                        <!-- =====================================
                             NAMA PENGAJU
                        ====================================== -->

                        <td class="pemohon-column">

                            <?= esc($applicantName) ?>

                        </td>



                        <!-- =====================================
                             IDENTITAS
                        ====================================== -->

                        <td class="identitas-column">

                            <?= esc(
                                $applicantIdentifier
                            ) ?>

                        </td>



                        <!-- =====================================
                             JENIS LAYANAN
                        ====================================== -->

                        <td class="layanan-column">

                            <?= esc($serviceName) ?>

                        </td>



                        <!-- =====================================
                             UNIT LAYANAN
                        ====================================== -->

                        <td>

                            <?= esc($unitLayanan) ?>

                        </td>



                        <!-- =====================================
                             TANGGAL
                        ====================================== -->

                        <td>

                            <?php if (!empty($tanggal)): ?>


                                <?php

                                $timestamp = strtotime(
                                    (string) $tanggal
                                );

                                ?>


                                <?php if (
                                    $timestamp !== false
                                ): ?>

                                    <?= date(
                                        'd-m-Y',
                                        $timestamp
                                    ) ?>

                                <?php else: ?>

                                    <?= esc(
                                        $tanggal
                                    ) ?>

                                <?php endif; ?>


                            <?php else: ?>

                                -

                            <?php endif; ?>

                        </td>



                        <!-- =====================================
                             STATUS
                        ====================================== -->

                        <td>

                            <span
                                class="
                                    badge-status
                                    <?= esc($statusClass) ?>
                                "
                            >

                                <?= esc(
                                    $statusTampil
                                ) ?>

                            </span>

                        </td>



                        <!-- =====================================
                             AKSI
                        ====================================== -->

                        <td>

                            <?php if ($id > 0): ?>

                                <a
                                    href="<?= base_url(
                                        'upt-tik/detail/' . $id
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
                ================================================== -->

                <tr>

                    <td colspan="8">

                        <div class="empty-data">


                            <i
                                class="
                                    fas
                                    fa-network-wired
                                    d-block
                                "
                            ></i>


                            <h5>

                                Belum Ada Data Tiket

                            </h5>


                            <p class="mb-0">

                                Belum terdapat tiket yang masuk
                                ke UPT TIK.

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
        &&
        $pager
        &&
        method_exists($pager, 'links')
    ): ?>

        <div class="p-3">

            <?= $pager->links('upt_tik') ?>

        </div>

    <?php endif; ?>


</div>


<?= $this->endSection() ?>