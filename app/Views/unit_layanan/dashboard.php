<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

/* =====================================================
   DASHBOARD AKADEMIK
===================================================== */

.dashboard-title{
    font-size:30px;
    font-weight:700;
    color:#172033;
}

.dashboard-subtitle{
    color:#6c757d;
    margin-bottom:0;
}


/* =====================================================
   STAT CARD
===================================================== */

.stat-card{
    position:relative;
    min-height:155px;
    border-radius:18px;
    padding:25px;
    color:white;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.2s ease;
}

.stat-card:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(0,0,0,.12);
}

.stat-card h2{
    font-size:36px;
    font-weight:700;
    margin:0 0 5px;
}

.stat-card p{
    margin:0;
    font-size:15px;
    font-weight:500;
}

.stat-card i{
    position:absolute;
    right:20px;
    bottom:15px;
    font-size:55px;
    opacity:.18;
}


/* =====================================================
   DASHBOARD CARD
===================================================== */

.dashboard-card{
    border:none;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.06);
    background:white;
}


/* =====================================================
   BUTTON
===================================================== */

.btn-primary{
    background:#293582;
    border-color:#293582;
}

.btn-primary:hover{
    background:#ff7f00;
    border-color:#ff7f00;
}

.btn-outline-primary{
    color:#293582;
    border-color:#293582;
}

.btn-outline-primary:hover{
    background:#ff7f00;
    border-color:#ff7f00;
    color:white;
}


/* =====================================================
   STATISTIK
===================================================== */

.statistik-box{
    padding:25px;
}

.statistik-item{
    margin-bottom:25px;
}

.statistik-item:last-child{
    margin-bottom:0;
}

.statistik-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:9px;
    font-size:14px;
}

.progress{
    height:12px;
    border-radius:10px;
    background:#eef0f5;
    overflow:hidden;
}

.progress-bar{
    border-radius:10px;
    transition:width .5s ease;
}


/* =====================================================
   INFO DATA TIKET
===================================================== */

.data-tiket-icon{
    width:65px;
    height:65px;
    border-radius:16px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#293582;
    color:white;

    font-size:28px;
    flex-shrink:0;
}


/* =====================================================
   STATISTIK TOTAL
===================================================== */

.total-statistik{
    text-align:center;
    padding:25px 10px;
}

.total-statistik h3{
    font-size:32px;
    font-weight:700;
    color:#293582;
    margin-bottom:5px;
}

.total-statistik p{
    color:#6c757d;
    margin:0;
}


/* =====================================================
   EMPTY
===================================================== */

.empty-statistik{
    text-align:center;
    padding:30px 15px;
    color:#6c757d;
}

.empty-statistik i{
    font-size:45px;
    margin-bottom:15px;
    opacity:.35;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:768px){

    .dashboard-title{
        font-size:24px;
    }

    .stat-card{
        min-height:135px;
    }

    .statistik-header{
        font-size:13px;
    }

}

</style>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="dashboard-title mb-1">
            Dashboard Akademik
        </h2>

        <p class="dashboard-subtitle">

            Selamat datang,

            <strong>
                <?= esc(session()->get('name') ?? 'Petugas') ?>
            </strong>

            👋

        </p>

    </div>


    <div class="text-end">

        <span class="badge bg-primary px-3 py-2">

            <i class="fas fa-calendar-alt me-1"></i>

            <?= date('d M Y') ?>

        </span>

    </div>

</div>



<!-- =====================================================
     STATISTIK TIKET
===================================================== -->

<div class="row g-4 mb-4">


    <!-- =================================================
         TOTAL TIKET
    ================================================== -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-primary">

            <h2>
                <?= (int)($total ?? 0) ?>
            </h2>

            <p>
                Total Tiket
            </p>

            <i class="fas fa-ticket-alt"></i>

        </div>

    </div>



    <!-- =================================================
         MENUNGGU
    ================================================== -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-warning">

            <h2>
                <?= (int)($menunggu ?? 0) ?>
            </h2>

            <p>
                Menunggu
            </p>

            <i class="fas fa-hourglass-half"></i>

        </div>

    </div>



    <!-- =================================================
         DIPROSES
    ================================================== -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-info">

            <h2>
                <?= (int)($diproses ?? 0) ?>
            </h2>

            <p>
                Diproses
            </p>

            <i class="fas fa-spinner"></i>

        </div>

    </div>



    <!-- =================================================
         SELESAI
    ================================================== -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-success">

            <h2>
                <?= (int)($selesai ?? 0) ?>
            </h2>

            <p>
                Selesai
            </p>

            <i class="fas fa-check-circle"></i>

        </div>

    </div>

</div>



<!-- =====================================================
     DATA TIKET AKADEMIK
===================================================== -->

<div class="dashboard-card mb-4">

    <div class="card-body p-4">

        <div class="row align-items-center">


            <!-- =================================================
                 INFO
            ================================================== -->

            <div class="col-md-8">

                <div class="d-flex align-items-center">

                    <div class="data-tiket-icon me-3">

                        <i class="fas fa-ticket-alt"></i>

                    </div>


                    <div>

                        <h5 class="fw-bold mb-1">

                            Data Tiket Akademik

                        </h5>

                        <p class="text-muted mb-0">

                            Lihat dan kelola seluruh tiket yang
                            masuk ke Unit Akademik.

                        </p>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 BUTTON DATA TIKET
            ================================================== -->

            <div class="col-md-4 text-md-end mt-3 mt-md-0">

                <!--
                    DIARAHKAN LANGSUNG KE
                    DATA TIKET AKADEMIK
                -->

                <a
                    href="<?= base_url('akademik/data-tiket') ?>"
                    class="btn btn-primary px-4 py-2"
                >

                    <i class="fas fa-list me-2"></i>

                    Lihat Data Tiket

                </a>

            </div>

        </div>

    </div>

</div>



<!-- =====================================================
     STATISTIK TIKET
===================================================== -->

<div class="dashboard-card">

    <!-- HEADER -->

    <div class="card-header bg-white border-0 p-4">

        <h5 class="fw-bold mb-1">

            <i class="fas fa-chart-bar text-primary me-2"></i>

            Statistik Tiket

        </h5>

        <small class="text-muted">

            Ringkasan status tiket Unit Akademik

        </small>

    </div>


    <!-- BODY -->

    <div class="card-body statistik-box">


        <?php

        $totalStat =
            (int)($total ?? 0);

        $menungguStat =
            (int)($menunggu ?? 0);

        $diprosesStat =
            (int)($diproses ?? 0);

        $selesaiStat =
            (int)($selesai ?? 0);


        /*
         * Hitung persentase
         */

        $persenMenunggu =
            $totalStat > 0
                ? round(
                    ($menungguStat / $totalStat) * 100
                )
                : 0;


        $persenDiproses =
            $totalStat > 0
                ? round(
                    ($diprosesStat / $totalStat) * 100
                )
                : 0;


        $persenSelesai =
            $totalStat > 0
                ? round(
                    ($selesaiStat / $totalStat) * 100
                )
                : 0;

        ?>


        <?php if($totalStat > 0): ?>


            <!-- =================================================
                 TOTAL
            ================================================== -->

            <div class="row mb-4">

                <div class="col-md-4">

                    <div class="total-statistik">

                        <h3>
                            <?= $totalStat ?>
                        </h3>

                        <p>
                            Total Tiket
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="total-statistik">

                        <h3>
                            <?= $persenMenunggu ?>%
                        </h3>

                        <p>
                            Tiket Menunggu
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="total-statistik">

                        <h3>
                            <?= $persenSelesai ?>%
                        </h3>

                        <p>
                            Tiket Selesai
                        </p>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 MENUNGGU
            ================================================== -->

            <div class="statistik-item">

                <div class="statistik-header">

                    <span>

                        <i class="fas fa-hourglass-half text-warning me-2"></i>

                        Menunggu

                    </span>


                    <strong>

                        <?= $menungguStat ?>

                        tiket

                        <span class="text-muted ms-1">

                            (<?= $persenMenunggu ?>%)

                        </span>

                    </strong>

                </div>


                <div class="progress">

                    <div
                        class="progress-bar bg-warning"
                        role="progressbar"
                        style="width: <?= $persenMenunggu ?>%;"
                        aria-valuenow="<?= $persenMenunggu ?>"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    ></div>

                </div>

            </div>



            <!-- =================================================
                 DIPROSES
            ================================================== -->

            <div class="statistik-item">

                <div class="statistik-header">

                    <span>

                        <i class="fas fa-spinner text-info me-2"></i>

                        Diproses

                    </span>


                    <strong>

                        <?= $diprosesStat ?>

                        tiket

                        <span class="text-muted ms-1">

                            (<?= $persenDiproses ?>%)

                        </span>

                    </strong>

                </div>


                <div class="progress">

                    <div
                        class="progress-bar bg-info"
                        role="progressbar"
                        style="width: <?= $persenDiproses ?>%;"
                        aria-valuenow="<?= $persenDiproses ?>"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    ></div>

                </div>

            </div>



            <!-- =================================================
                 SELESAI
            ================================================== -->

            <div class="statistik-item">

                <div class="statistik-header">

                    <span>

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Selesai

                    </span>


                    <strong>

                        <?= $selesaiStat ?>

                        tiket

                        <span class="text-muted ms-1">

                            (<?= $persenSelesai ?>%)

                        </span>

                    </strong>

                </div>


                <div class="progress">

                    <div
                        class="progress-bar bg-success"
                        role="progressbar"
                        style="width: <?= $persenSelesai ?>%;"
                        aria-valuenow="<?= $persenSelesai ?>"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    ></div>

                </div>

            </div>



        <?php else: ?>


            <!-- =================================================
                 BELUM ADA DATA
            ================================================== -->

            <div class="empty-statistik">

                <i class="fas fa-chart-pie d-block"></i>

                <h6 class="fw-bold">

                    Belum Ada Data Tiket

                </h6>

                <p class="mb-0">

                    Belum ada tiket yang masuk ke Unit Akademik.

                </p>

            </div>


        <?php endif; ?>


    </div>

</div>


<?= $this->endSection() ?>