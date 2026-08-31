<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

/* =====================================================
   HEADER
===================================================== */

.stat-header{
    margin-bottom:25px;
}

.stat-title{
    font-size:30px;
    font-weight:700;
    color:#172033;
}

.stat-subtitle{
    color:#6c757d;
    margin-top:5px;
}


/* =====================================================
   STAT CARD
===================================================== */

.stat-card{
    position:relative;
    border:none;
    border-radius:18px;
    background:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    overflow:hidden;
    transition:.2s;
}

.stat-card:hover{
    transform:translateY(-3px);
    box-shadow:0 14px 30px rgba(0,0,0,.12);
}

.stat-card-body{
    padding:25px;
}

.stat-icon{
    width:58px;
    height:58px;
    border-radius:15px;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#fff;
    font-size:24px;
}

.stat-label{
    color:#6c757d;
    font-size:14px;
    font-weight:600;
    margin-bottom:5px;
}

.stat-number{
    font-size:30px;
    font-weight:700;
    color:#172033;
    margin:0;
}


/* =====================================================
   CARD UMUM
===================================================== */

.stat-main-card{
    border:none;
    border-radius:18px;
    background:#fff;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    overflow:hidden;
}

.stat-card-header{
    padding:20px 25px;
    border-bottom:1px solid #eee;
}

.stat-card-header h5{
    margin:0;
    color:#172033;
    font-weight:700;
}

.stat-card-body-content{
    padding:25px;
}


/* =====================================================
   PROGRESS
===================================================== */

.progress-custom{
    height:12px;
    border-radius:20px;
    background:#e9ecef;
}

.progress-custom .progress-bar{
    background:#293582;
    border-radius:20px;
}


/* =====================================================
   STATUS
===================================================== */

.status-row{
    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:15px 0;

    border-bottom:1px solid #eee;
}

.status-row:last-child{
    border-bottom:none;
}

.status-name{
    display:flex;
    align-items:center;
    gap:10px;

    font-weight:600;
    color:#172033;
}

.status-dot{
    width:12px;
    height:12px;
    border-radius:50%;
}

.status-count{
    font-size:18px;
    font-weight:700;
    color:#293582;
}


/* =====================================================
   TABLE
===================================================== */

.stat-table{
    margin-bottom:0;
}

.stat-table thead th{
    background:#293582;
    color:#fff;
    border:none;
    padding:14px;
}

.stat-table tbody td{
    padding:14px;
    vertical-align:middle;
}

.stat-table tbody tr:hover{
    background:#f8f9fa;
}


/* =====================================================
   BUTTON
===================================================== */

.btn-primary-custom{
    background:#293582;
    border:none;
    color:#fff;
    border-radius:10px;
    padding:9px 18px;
}

.btn-primary-custom:hover{
    background:#ff7f00;
    color:#fff;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:768px){

    .stat-title{
        font-size:24px;
    }

    .stat-card-body{
        padding:20px;
    }

}

</style>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="stat-header">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>

            <h2 class="stat-title mb-1">

                <i class="fas fa-chart-bar me-2"></i>

                Statistik Tiket

            </h2>

            <p class="stat-subtitle mb-0">

                Ringkasan statistik pengajuan tiket layanan

            </p>

        </div>


        <div>

            <a
                href="<?= base_url('unit-layanan/data-tiket') ?>"
                class="btn btn-primary-custom"
            >

                <i class="fas fa-ticket-alt me-1"></i>

                Data Tiket

            </a>

        </div>

    </div>

</div>



<!-- =====================================================
     STAT CARD
===================================================== -->

<div class="row g-4 mb-4">


    <!-- TOTAL -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card h-100">

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

                            <?= esc($totalTiket ?? 0) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- MENUNGGU -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card h-100">

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

                            <?= esc($menunggu ?? 0) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- DIPROSES -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card h-100">

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

                            <?= esc($diproses ?? 0) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- SELESAI -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card h-100">

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

                            <?= esc($selesai ?? 0) ?>

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- =====================================================
     RINGKASAN + PENYELESAIAN
===================================================== -->

<div class="row g-4 mb-4">


    <!-- STATUS TIKET -->

    <div class="col-lg-7">

        <div class="stat-main-card h-100">

            <div class="stat-card-header">

                <h5>

                    <i class="fas fa-chart-pie me-2"
                       style="color:#293582;"></i>

                    Ringkasan Status Tiket

                </h5>

            </div>


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

                        <?= esc($menunggu ?? 0) ?>

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

                        <?= esc($diproses ?? 0) ?>

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

                        <?= esc($selesai ?? 0) ?>

                    </div>

                </div>


            </div>

        </div>

    </div>



    <!-- TINGKAT PENYELESAIAN -->

    <div class="col-lg-5">

        <div class="stat-main-card h-100">

            <div class="stat-card-header">

                <h5>

                    <i class="fas fa-check-double me-2"
                       style="color:#293582;"></i>

                    Tingkat Penyelesaian

                </h5>

            </div>


            <div class="stat-card-body-content">


                <div class="text-center mb-4">

                    <div
                        style="
                            font-size:48px;
                            font-weight:700;
                            color:#293582;
                        "
                    >

                        <?= esc(
                            $persentaseSelesai ?? 0
                        ) ?>%

                    </div>

                    <div class="text-muted">

                        Tiket telah selesai

                    </div>

                </div>


                <div class="progress progress-custom">

                    <div
                        class="progress-bar"
                        role="progressbar"
                        style="width:<?= min(
                            100,
                            max(
                                0,
                                (float)($persentaseSelesai ?? 0)
                            )
                        ) ?>%;"
                    ></div>

                </div>


                <div class="d-flex justify-content-between mt-2">

                    <small class="text-muted">
                        0%
                    </small>

                    <small class="text-muted">
                        100%
                    </small>

                </div>


                <div class="text-center mt-4">

                    <span class="text-muted">

                        <?= esc($selesai ?? 0) ?>

                        dari

                        <?= esc($totalTiket ?? 0) ?>

                        tiket selesai

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- =====================================================
     STATISTIK BERDASARKAN LAYANAN
===================================================== -->

<div class="stat-main-card mb-4">

    <div class="stat-card-header">

        <h5>

            <i class="fas fa-list-alt me-2"
               style="color:#293582;"></i>

            Statistik Berdasarkan Layanan

        </h5>

    </div>


    <div class="stat-card-body-content p-0">


        <?php if(
            !empty($statistikLayanan)
        ): ?>

            <div class="table-responsive">

                <table class="table stat-table">

                    <thead>

                        <tr>

                            <th width="70">
                                #
                            </th>

                            <th>
                                Nama Layanan
                            </th>

                            <th width="180"
                                class="text-center">

                                Jumlah Tiket

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php
                        $no = 1;
                        ?>

                        <?php foreach(
                            $statistikLayanan
                            as $row
                        ): ?>

                            <tr>

                                <td>

                                    <?= $no++ ?>

                                </td>


                                <td>

                                    <i
                                        class="fas fa-concierge-bell me-2"
                                        style="color:#293582;"
                                    ></i>

                                    <?= esc(
                                        $row['nama_layanan']
                                        ?? 'Layanan'
                                    ) ?>

                                </td>


                                <td class="text-center">

                                    <span
                                        class="badge px-3 py-2"
                                        style="
                                            background:#293582;
                                        "
                                    >

                                        <?= esc(
                                            $row['jumlah']
                                            ?? 0
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

                    Belum terdapat tiket yang dapat ditampilkan.

                </p>

            </div>

        <?php endif; ?>


    </div>

</div>



<!-- =====================================================
     INFORMASI
===================================================== -->

<div class="alert alert-info border-0 shadow-sm">

    <i class="fas fa-info-circle me-2"></i>

    <strong>Informasi:</strong>

    Statistik tiket menampilkan jumlah tiket berdasarkan
    status <strong>Menunggu</strong>,
    <strong>Diproses</strong>, dan
    <strong>Selesai</strong>.

</div>


<?= $this->endSection() ?>