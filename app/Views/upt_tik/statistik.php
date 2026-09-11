<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
    /*
    |--------------------------------------------------------------------------
    | DATA UPT TIK
    |--------------------------------------------------------------------------
    | Semua data berasal dari controller UPT TIK.
    | Tidak menggunakan controller/model/data Akademik.
    */

    $totalTiket = (int) ($totalTiket ?? $total ?? 0);
    $menunggu = (int) ($menunggu ?? 0);
    $diproses = (int) ($diproses ?? 0);
    $selesai = (int) ($selesai ?? 0);

    $persentaseSelesai = (float) ($persentaseSelesai ?? 0);

    $statistikLayanan = $statistikLayanan ?? [];

    /*
    |--------------------------------------------------------------------------
    | IDENTITAS UNIT
    |--------------------------------------------------------------------------
    */
    $unit = 'UPT TIK';

    /*
    |--------------------------------------------------------------------------
    | URL DATA TIKET UPT TIK
    |--------------------------------------------------------------------------
    */
    $dataTiketUrl = base_url('upt-tik/data-tiket');
?>

<style>

/* =====================================================
   HALAMAN STATISTIK
===================================================== */

.statistik-page {
    width: 100%;
}


/* =====================================================
   HEADER
===================================================== */

.stat-header {
    margin-bottom: 25px;
}

.stat-title {
    font-size: 30px;
    font-weight: 700;
    color: #172033;
}

.stat-title i {
    color: #293582;
}

.stat-subtitle {
    color: #6c757d;
    margin-top: 5px;
    font-size: 14px;
}


/* =====================================================
   BUTTON DATA TIKET
===================================================== */

.btn-primary-custom {
    background: #293582;
    border: none;
    color: #fff;
    border-radius: 10px;
    padding: 9px 18px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: .2s ease;
}

.btn-primary-custom:hover {
    background: #ff7f00;
    color: #fff;
}


/* =====================================================
   STAT CARD GRID
===================================================== */

/*
|--------------------------------------------------------------------------
| Dibuat khusus agar 4 card SELALU sejajar di desktop.
|--------------------------------------------------------------------------
*/

.stat-card-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    width: 100%;
    margin-bottom: 25px;
}


/* =====================================================
   STAT CARD
===================================================== */

.statistik-page .stat-card {
    position: relative;
    width: 100%;
    min-width: 0;
    min-height: 120px;

    border: none;
    border-radius: 18px;

    color: #fff;

    box-shadow: 0 10px 25px rgba(0, 0, 0, .08);

    overflow: hidden;

    transition: .2s ease;
}

.statistik-page .stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, .12);
}


/* =====================================================
   STAT CARD BODY
===================================================== */

.stat-card-body {
    padding: 25px;
}


/* =====================================================
   STAT ICON
===================================================== */

.stat-icon {
    width: 58px;
    height: 58px;

    border-radius: 15px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #fff;

    font-size: 24px;

    flex-shrink: 0;
}

.statistik-page .stat-icon {
    background: rgba(255, 255, 255, .22) !important;
}


/* =====================================================
   STAT TEXT
===================================================== */

.stat-label {
    color: rgba(255, 255, 255, .9);

    font-size: 14px;
    font-weight: 600;

    margin-bottom: 5px;
}

.stat-number {
    font-size: 30px;
    font-weight: 700;

    color: #fff;

    margin: 0;
}


/* =====================================================
   WARNA CARD
===================================================== */

.stat-total {
    background: #0d6efd;
}

.stat-menunggu {
    background: #ffc107;
}

.stat-diproses {
    background: #0dcaf0;
}

.stat-selesai {
    background: #198754;
}


/* =====================================================
   CARD UMUM
===================================================== */

.stat-main-card {
    border: none;

    border-radius: 18px;

    background: #fff;

    box-shadow: 0 10px 25px rgba(0, 0, 0, .08);

    overflow: hidden;

    height: 100%;
}


/* =====================================================
   CARD HEADER
===================================================== */

.stat-card-header {
    padding: 20px 25px;

    border-bottom: 1px solid #eee;
}

.stat-card-header h5 {
    margin: 0;

    color: #172033;

    font-weight: 700;
}


/* =====================================================
   CARD BODY
===================================================== */

.stat-card-body-content {
    padding: 25px;
}


/* =====================================================
   PROGRESS
===================================================== */

.progress-custom {
    height: 12px;

    border-radius: 20px;

    background: #e9ecef;

    overflow: hidden;
}

.progress-custom .progress-bar {
    background: #293582;

    border-radius: 20px;

    transition: width .4s ease;
}


/* =====================================================
   STATUS
===================================================== */

.status-row {
    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 15px 0;

    border-bottom: 1px solid #eee;
}

.status-row:last-child {
    border-bottom: none;
}

.status-name {
    display: flex;

    align-items: center;

    gap: 10px;

    font-weight: 600;

    color: #172033;
}

.status-dot {
    width: 12px;
    height: 12px;

    border-radius: 50%;

    flex-shrink: 0;
}

.status-count {
    font-size: 18px;

    font-weight: 700;

    color: #293582;
}


/* =====================================================
   TABLE
===================================================== */

.stat-table {
    margin-bottom: 0;
}

.stat-table thead th {
    background: #293582;

    color: #fff;

    border: none;

    padding: 14px;
}

.stat-table tbody td {
    padding: 14px;

    vertical-align: middle;
}

.stat-table tbody tr:hover {
    background: #f8f9fa;
}


/* =====================================================
   BADGE JUMLAH TIKET
===================================================== */

.ticket-badge {
    background: #293582;

    color: #fff;

    border-radius: 8px;

    font-size: 12px;

    font-weight: 600;

    padding: 7px 12px;
}


/* =====================================================
   ALERT INFORMASI
===================================================== */

.stat-info {
    border-radius: 12px;

    border: none;

    box-shadow: 0 5px 15px rgba(0, 0, 0, .05);
}


/* =====================================================
   RESPONSIVE LAPTOP KECIL
===================================================== */

@media (max-width: 1100px) {

    .stat-card-grid {
        gap: 14px;
    }

    .stat-card-body {
        padding: 20px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;

        font-size: 21px;
    }

    .stat-number {
        font-size: 26px;
    }

}


/* =====================================================
   TABLET
===================================================== */

@media (max-width: 900px) {

    .stat-card-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

}


/* =====================================================
   HP
===================================================== */

@media (max-width: 576px) {

    .stat-title {
        font-size: 24px;
    }

    .stat-card-grid {
        grid-template-columns: 1fr;
    }

    .stat-card-body {
        padding: 20px;
    }

    .stat-header .d-flex {
        align-items: flex-start !important;
    }

    .btn-primary-custom {
        width: 100%;
    }

}

</style>


<!-- =====================================================
     HALAMAN STATISTIK UPT TIK
===================================================== -->

<div class="statistik-page">


    <!-- =================================================
         HEADER
    ================================================== -->

    <div class="stat-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h2 class="stat-title mb-1">

                    <i class="fas fa-chart-bar me-2"></i>

                    Statistik Tiket

                </h2>


                <p class="stat-subtitle mb-0">

                    Ringkasan statistik pengajuan tiket <?= esc($unit) ?>

                </p>

            </div>


            <div>

                <a
                    href="<?= esc($dataTiketUrl) ?>"
                    class="btn btn-primary-custom"
                >

                    <i class="fas fa-ticket-alt me-1"></i>

                    Data Tiket

                </a>

            </div>

        </div>

    </div>



    <!-- =================================================
         STAT CARD
    ================================================== -->

    <div class="stat-card-grid">


        <!-- =============================================
             TOTAL TIKET
        ============================================== -->

        <div class="stat-card stat-total">

            <div class="stat-card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="stat-icon me-3"
                        style="background:#293582;"
                    >

                        <i class="fas fa-ticket-alt"></i>

                    </div>


                    <div>

                        <div class="stat-label">

                            Total Tiket

                        </div>


                        <h3 class="stat-number">

                            <?= esc((string) $totalTiket) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>



        <!-- =============================================
             MENUNGGU
        ============================================== -->

        <div class="stat-card stat-menunggu">

            <div class="stat-card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="stat-icon me-3"
                        style="background:#ffc107;"
                    >

                        <i class="fas fa-clock"></i>

                    </div>


                    <div>

                        <div class="stat-label">

                            Menunggu

                        </div>


                        <h3 class="stat-number">

                            <?= esc((string) $menunggu) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>



        <!-- =============================================
             DIPROSES
        ============================================== -->

        <div class="stat-card stat-diproses">

            <div class="stat-card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="stat-icon me-3"
                        style="background:#0dcaf0;"
                    >

                        <i class="fas fa-spinner"></i>

                    </div>


                    <div>

                        <div class="stat-label">

                            Diproses

                        </div>


                        <h3 class="stat-number">

                            <?= esc((string) $diproses) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>



        <!-- =============================================
             SELESAI
        ============================================== -->

        <div class="stat-card stat-selesai">

            <div class="stat-card-body">

                <div class="d-flex align-items-center">

                    <div
                        class="stat-icon me-3"
                        style="background:#198754;"
                    >

                        <i class="fas fa-check-circle"></i>

                    </div>


                    <div>

                        <div class="stat-label">

                            Selesai

                        </div>


                        <h3 class="stat-number">

                            <?= esc((string) $selesai) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =================================================
         RINGKASAN + TINGKAT PENYELESAIAN
    ================================================== -->

    <div class="row g-4 mb-4">


        <!-- =============================================
             STATUS TIKET
        ============================================== -->

        <div class="col-lg-7">

            <div class="stat-main-card h-100">


                <!-- HEADER -->

                <div class="stat-card-header">

                    <h5>

                        <i
                            class="fas fa-chart-pie me-2"
                            style="color:#293582;"
                        ></i>

                        Ringkasan Status Tiket

                    </h5>

                </div>


                <!-- BODY -->

                <div class="stat-card-body-content">


                    <!-- MENUNGGU -->

                    <div class="status-row">

                        <div class="status-name">

                            <span
                                class="status-dot"
                                style="background:#ffc107;"
                            ></span>

                            Menunggu

                        </div>


                        <div class="status-count">

                            <?= esc((string) $menunggu) ?>

                        </div>

                    </div>



                    <!-- DIPROSES -->

                    <div class="status-row">

                        <div class="status-name">

                            <span
                                class="status-dot"
                                style="background:#0dcaf0;"
                            ></span>

                            Diproses

                        </div>


                        <div class="status-count">

                            <?= esc((string) $diproses) ?>

                        </div>

                    </div>



                    <!-- SELESAI -->

                    <div class="status-row">

                        <div class="status-name">

                            <span
                                class="status-dot"
                                style="background:#198754;"
                            ></span>

                            Selesai

                        </div>


                        <div class="status-count">

                            <?= esc((string) $selesai) ?>

                        </div>

                    </div>


                </div>

            </div>

        </div>



        <!-- =============================================
             TINGKAT PENYELESAIAN
        ============================================== -->

        <div class="col-lg-5">

            <div class="stat-main-card h-100">


                <!-- HEADER -->

                <div class="stat-card-header">

                    <h5>

                        <i
                            class="fas fa-check-double me-2"
                            style="color:#293582;"
                        ></i>

                        Tingkat Penyelesaian

                    </h5>

                </div>


                <!-- BODY -->

                <div class="stat-card-body-content">


                    <?php

                        $totalData = (int) $totalTiket;

                        $selesaiData = (int) $selesai;

                        $persentase = $totalData > 0
                            ? round(
                                ($selesaiData / $totalData) * 100
                            )
                            : 0;

                        $persentase = min(
                            100,
                            max(
                                0,
                                $persentase
                            )
                        );

                    ?>


                    <!-- PERSENTASE -->

                    <div class="text-center mb-4">

                        <div
                            style="
                                font-size:48px;
                                font-weight:700;
                                color:#293582;
                            "
                        >

                            <?= esc((string) $persentase) ?>%

                        </div>


                        <div class="text-muted">

                            Tiket telah selesai

                        </div>

                    </div>



                    <!-- PROGRESS -->

                    <div class="progress progress-custom">

                        <div
                            class="progress-bar"
                            role="progressbar"
                            style="width:<?= $persentase ?>%;"
                            aria-valuenow="<?= $persentase ?>"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        ></div>

                    </div>



                    <!-- RANGE -->

                    <div class="d-flex justify-content-between mt-2">

                        <small class="text-muted">

                            0%

                        </small>


                        <small class="text-muted">

                            100%

                        </small>

                    </div>



                    <!-- JUMLAH -->

                    <div class="text-center mt-4">

                        <span class="text-muted">

                            <?= esc((string) $selesai) ?>

                            dari

                            <?= esc((string) $totalTiket) ?>

                            tiket selesai

                        </span>

                    </div>


                </div>

            </div>

        </div>

    </div>



    <!-- =================================================
         STATISTIK BERDASARKAN LAYANAN
    ================================================== -->

    <div class="stat-main-card mb-4">


        <!-- HEADER -->

        <div class="stat-card-header">

            <h5>

                <i
                    class="fas fa-list-alt me-2"
                    style="color:#293582;"
                ></i>

                Statistik Berdasarkan Layanan

            </h5>

        </div>



        <!-- BODY -->

        <div class="stat-card-body-content p-0">


            <?php if (!empty($statistikLayanan)): ?>


                <div class="table-responsive">

                    <table class="table stat-table">


                        <!-- TABLE HEADER -->

                        <thead>

                            <tr>

                                <th width="70">

                                    #

                                </th>


                                <th>

                                    Nama Layanan

                                </th>


                                <th
                                    width="180"
                                    class="text-center"
                                >

                                    Jumlah Tiket

                                </th>

                            </tr>

                        </thead>



                        <!-- TABLE BODY -->

                        <tbody>

                            <?php $no = 1; ?>


                            <?php foreach (
                                $statistikLayanan
                                as $row
                            ): ?>


                                <?php

                                    $namaLayanan =
                                        $row['nama_layanan']
                                        ?? 'Layanan';

                                    $jumlahTiketLayanan =
                                        $row['jumlah']
                                        ?? 0;

                                ?>


                                <tr>


                                    <!-- NOMOR -->

                                    <td>

                                        <?= $no++ ?>

                                    </td>



                                    <!-- LAYANAN -->

                                    <td>

                                        <i
                                            class="fas fa-concierge-bell me-2"
                                            style="color:#293582;"
                                        ></i>


                                        <?= esc(
                                            $namaLayanan
                                        ) ?>

                                    </td>



                                    <!-- JUMLAH -->

                                    <td class="text-center">

                                        <span
                                            class="ticket-badge"
                                        >

                                            <?= esc(
                                                (string)
                                                $jumlahTiketLayanan
                                            ) ?>

                                            Tiket

                                        </span>

                                    </td>


                                </tr>


                            <?php endforeach; ?>


                        </tbody>

                    </table>

                </div>


            <?php else: ?>


                <!-- EMPTY DATA -->

                <div class="text-center p-5">

                    <i
                        class="fas fa-chart-bar mb-3"
                        style="
                            font-size:50px;
                            color:#adb5bd;
                        "
                    ></i>


                    <h5 class="text-muted">

                        Belum ada data statistik

                    </h5>


                    <p class="text-muted mb-0">

                        Belum terdapat tiket UPT TIK
                        yang dapat ditampilkan.

                    </p>

                </div>


            <?php endif; ?>


        </div>

    </div>



    <!-- =================================================
         INFORMASI
    ================================================== -->

    <div class="alert alert-info stat-info">

        <i class="fas fa-info-circle me-2"></i>


        <strong>Informasi:</strong>


        Statistik tiket UPT TIK menampilkan jumlah tiket
        berdasarkan status
        <strong>Menunggu</strong>,
        <strong>Diproses</strong>, dan
        <strong>Selesai</strong>.

    </div>


</div>


<?= $this->endSection() ?>