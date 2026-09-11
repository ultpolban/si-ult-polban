<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
    /*
    |--------------------------------------------------------------------------
    | LOG AKTIVITAS UPT TIK
    |--------------------------------------------------------------------------
    | Halaman ini khusus untuk UPT TIK.
    |
    | Saat ini belum ada tiket UPT TIK, sehingga log aktivitas
    | belum menampilkan data.
    |
    | Data dan proses UPT TIK berdiri sendiri.
    |--------------------------------------------------------------------------
    */

    $keyword = (string) ($keyword ?? '');
    $unitName = 'UPT TIK';
?>


<style>

/* =========================================================
   HEADER
========================================================= */

.log-header {
    margin-bottom: 25px;
}

.log-title {
    font-size: 30px;
    font-weight: 700;
    color: #172033;
    margin-bottom: 5px;
}

.log-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}


/* =========================================================
   FILTERS
========================================================= */

.filter-section {
    background: #f8f9ff;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.filter-section .form-label {
    font-weight: 600;
    color: #172033;
    margin-bottom: 8px;
}

.filter-section .form-control,
.filter-section .form-select {
    border-radius: 8px;
    border: 1px solid #e0e6ed;
}

.filter-section .form-control:focus,
.filter-section .form-select:focus {
    border-color: #293582;

    box-shadow:
        0 0 0 0.2rem
        rgba(41, 53, 130, 0.25);
}


/* =========================================================
   BUTTON
========================================================= */

.btn-primary {
    background: #293582;
    border-color: #293582;
    border-radius: 8px;
    font-weight: 600;
}

.btn-primary:hover {
    background: #ff7f00;
    border-color: #ff7f00;
}


/* =========================================================
   CARD
========================================================= */

.card-logs {
    border: none;
    border-radius: 18px;

    box-shadow:
        0 8px 25px
        rgba(0, 0, 0, .08);

    overflow: hidden;
}

.card-logs .card-header {
    background: #ffffff;

    border-bottom:
        1px solid #eeeeee;

    padding: 20px;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    text-align: center;

    padding: 60px 20px;
}

.empty-state-icon {
    font-size: 48px;

    color: #ccc;

    margin-bottom: 15px;
}

.empty-state-text {
    color: #999;

    font-size: 16px;

    margin-bottom: 0;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .log-title {
        font-size: 22px;
    }

    .empty-state {
        padding: 50px 20px;
    }

}

</style>


<!-- =========================================================
     HEADER
========================================================= -->

<div class="log-header">

    <h1 class="log-title">

        <i class="fas fa-history me-2"></i>

        Log Aktivitas <?= esc($unitName) ?>

    </h1>


    <p class="log-subtitle">

        Pantau semua aktivitas dan perubahan status tiket
        di unit <?= esc($unitName) ?>

    </p>

</div>



<!-- =========================================================
     FILTER SECTION
========================================================= -->

<div class="filter-section">

    <form
        method="get"
        action="<?= base_url('upt-tik/log-aktivitas') ?>"
        class="row g-3"
    >


        <!-- =================================================
             CARI AKTIVITAS
        ================================================== -->

        <div class="col-md-6">

            <label
                for="keyword"
                class="form-label"
            >

                🔍 Cari Aktivitas

            </label>


            <input
                type="text"
                class="form-control"
                id="keyword"
                name="keyword"
                placeholder="Cari tiket, unit, layanan, atau status..."
                value="<?= esc($keyword) ?>"
            >

        </div>



        <!-- =================================================
             FILTER UNIT
        ================================================== -->

        <div class="col-md-4">

            <label
                for="unit_filter"
                class="form-label"
            >

                🏢 Filter Unit

            </label>


            <select
                class="form-select"
                id="unit_filter"
                name="unit"
            >

                <option value="">

                    Semua Unit

                </option>


                <option value="UPT TIK">

                    UPT TIK

                </option>

            </select>

        </div>



        <!-- =================================================
             BUTTON CARI
        ================================================== -->

        <div class="col-md-2 d-flex align-items-end">

            <button
                type="submit"
                class="btn btn-primary w-100"
            >

                <i class="fas fa-search me-1"></i>

                Cari

            </button>

        </div>


    </form>

</div>



<!-- =========================================================
     CARD LOG AKTIVITAS
========================================================= -->

<div class="card card-logs">


    <!-- =====================================================
         CARD HEADER
    ====================================================== -->

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="mb-0">

                📝 Daftar Log Aktivitas

            </h5>


            <small class="text-muted">

                0 Aktivitas

            </small>

        </div>

    </div>



    <!-- =====================================================
         CARD BODY
    ====================================================== -->

    <div class="card-body p-0">


        <!-- =================================================
             EMPTY STATE
        ================================================== -->

        <div class="empty-state">

            <div class="empty-state-icon">

                📭

            </div>


            <p class="empty-state-text">

                Belum ada log aktivitas.

            </p>

        </div>


    </div>


</div>


<?= $this->endSection() ?>