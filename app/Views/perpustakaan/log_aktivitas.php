<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

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
   FILTER
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

.filter-section .form-control {
    border-radius: 8px;
    border: 1px solid #e0e6ed;
}

.filter-section .form-control:focus {
    border-color: #293582;
    box-shadow: 0 0 0 0.2rem rgba(41, 53, 130, 0.25);
}


/* =========================================================
   CARD LOG
========================================================= */

.card-logs {
    border: none;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
    overflow: hidden;
}

.card-logs .card-header {
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
    border-color: #293582;
}

.table tbody td {
    vertical-align: middle;
    padding: 13px 12px;
}

.table tbody tr:hover {
    background: #f8f9ff;
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
   UNIT BADGE
========================================================= */

.badge-unit {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    background: #e3f2fd;
    color: #1976d2;
    white-space: nowrap;
}


/* =========================================================
   STATUS
========================================================= */

.badge-status {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-processing {
    background: #cce5ff;
    color: #0c5460;
}

.status-completed {
    background: #d4edda;
    color: #155724;
}


/* =========================================================
   ACTION BUTTON
========================================================= */

.btn-action {
    border-radius: 8px;
    font-size: 12px;
    padding: 6px 10px;
    font-weight: 500;
    white-space: nowrap;
}

.btn-view {
    color: #293582;
    border-color: #293582;
}

.btn-view:hover {
    background: #293582;
    color: #ffffff;
}

.btn-download {
    color: #198754;
    border-color: #198754;
}

.btn-download:hover {
    background: #198754;
    color: #ffffff;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    text-align: center;
    padding: 50px 20px;
}

.empty-state-icon {
    font-size: 48px;
    color: #adb5bd;
    margin-bottom: 15px;
}

.empty-state-text {
    color: #999;
    font-size: 16px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .log-title {
        font-size: 24px;
    }

    .table {
        font-size: 13px;
        min-width: 100%;
    }

    .table thead th {
        padding: 10px 8px;
    }

    .table tbody td {
        padding: 10px 8px;
    }

    .badge-status {
        padding: 5px 10px;
        font-size: 11px;
    }

}

</style>


<!-- =========================================================
     HEADER PERPUSTAKAAN
========================================================= -->

<div class="log-header">

    <h1 class="log-title">

        <i class="fas fa-history me-2"
           style="color:#293582;"></i>

        Log Aktivitas Perpustakaan

    </h1>

    <p class="log-subtitle">

        Pantau semua aktivitas dan perubahan status tiket
        pada Unit Perpustakaan.

    </p>

</div>


<!-- =========================================================
     FILTER PENCARIAN
     KHUSUS PERPUSTAKAAN
========================================================= -->

<div class="filter-section">

    <form
        method="get"
        action="<?= site_url('perpustakaan/log-aktivitas') ?>"
        class="row g-3"
    >

        <div class="col-md-10">

            <label
                for="keyword"
                class="form-label"
            >

                <i class="fas fa-search me-1"></i>

                Cari Aktivitas

            </label>

            <input
                type="text"
                class="form-control"
                id="keyword"
                name="keyword"
                placeholder="Cari tiket, layanan, aktivitas, atau status..."
                value="<?= esc($keyword ?? '') ?>"
            >

        </div>


        <div class="col-md-2 d-flex align-items-end">

            <button
                type="submit"
                class="btn w-100 text-white"
                style="background:#293582;"
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

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h5 class="mb-1 fw-bold">

                    <i class="fas fa-list me-2"
                       style="color:#293582;"></i>

                    Daftar Log Aktivitas

                </h5>

                <small class="text-muted">

                    Riwayat aktivitas tiket Unit Perpustakaan

                </small>

            </div>


            <!-- JUMLAH LOG -->

            <span class="badge bg-light text-dark px-3 py-2">

                <?= count($logs ?? []) ?>

                Aktivitas

            </span>

        </div>

    </div>


    <!-- =====================================================
         CARD BODY
    ====================================================== -->

    <div class="card-body p-0">


        <?php if (empty($logs)): ?>


            <!-- =================================================
                 DATA KOSONG
            ================================================== -->

            <div class="empty-state">

                <div class="empty-state-icon">

                    <i class="fas fa-history"></i>

                </div>


                <h5 class="fw-bold text-secondary">

                    Belum Ada Log Aktivitas

                </h5>


                <p class="empty-state-text mb-0">

                    Belum terdapat aktivitas tiket
                    pada Unit Perpustakaan.

                    <?php if (!empty($keyword)): ?>

                        <br>

                        Coba ubah kata kunci pencarian Anda.

                    <?php endif; ?>

                </p>

            </div>


        <?php else: ?>


            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th style="width:12%;">

                                No Tiket

                            </th>

                            <th style="width:15%;">

                                Unit

                            </th>

                            <th style="width:15%;">

                                Layanan

                            </th>

                            <th style="width:28%;">

                                Aktivitas

                            </th>

                            <th style="width:12%;">

                                Status

                            </th>

                            <th style="width:12%;">

                                Waktu

                            </th>

                            <th style="width:16%;">

                                Aksi

                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach ($logs as $log): ?>

                        <?php

                        /* =================================================
                           DATA LOG PERPUSTAKAAN
                        ================================================= */

                        $noTiket =
                            $log['no_tiket']
                            ?? '-';

                        $layanan =
                            $log['layanan']
                            ?? '-';

                        $aktivitas =
                            $log['aktivitas']
                            ?? '-';

                        $status =
                            $log['status']
                            ?? 'Menunggu';

                        $waktu =
                            $log['waktu']
                            ?? $log['tanggal']
                            ?? '-';

                        $logId =
                            (int) (
                                $log['log_id']
                                ?? 0
                            );


                        /* =================================================
                           UNIT SELALU PERPUSTAKAAN
                        ================================================= */

                        $unit = 'Perpustakaan';


                        /* =================================================
                           STATUS
                           HANYA:
                           MENUNGGU
                           DIPROSES
                           SELESAI
                        ================================================= */

                        $statusLower = strtolower(
                            trim((string) $status)
                        );


                        if (
                            str_contains(
                                $statusLower,
                                'diproses'
                            )
                            ||
                            str_contains(
                                $statusLower,
                                'processing'
                            )
                            ||
                            str_contains(
                                $statusLower,
                                'in_progress'
                            )
                        ) {

                            $badgeClass =
                                'badge-status status-processing';

                            $statusTampil =
                                'Diproses';

                        } elseif (
                            str_contains(
                                $statusLower,
                                'selesai'
                            )
                            ||
                            str_contains(
                                $statusLower,
                                'completed'
                            )
                        ) {

                            $badgeClass =
                                'badge-status status-completed';

                            $statusTampil =
                                'Selesai';

                        } else {

                            $badgeClass =
                                'badge-status status-pending';

                            $statusTampil =
                                'Menunggu';

                        }

                        ?>


                        <tr>


                            <!-- =================================================
                                 NO TIKET
                            ================================================== -->

                            <td>

                                <span class="ticket-number">

                                    <?= esc($noTiket) ?>

                                </span>

                            </td>


                            <!-- =================================================
                                 UNIT
                            ================================================== -->

                            <td>

                                <span class="badge-unit">

                                    <i class="fas fa-book me-1"></i>

                                    Perpustakaan

                                </span>

                            </td>


                            <!-- =================================================
                                 LAYANAN
                            ================================================== -->

                            <td>

                                <?= esc($layanan) ?>

                            </td>


                            <!-- =================================================
                                 AKTIVITAS
                            ================================================== -->

                            <td>

                                <small>

                                    <?= esc($aktivitas) ?>

                                </small>

                            </td>


                            <!-- =================================================
                                 STATUS
                            ================================================== -->

                            <td>

                                <span class="<?= esc($badgeClass) ?>">

                                    <?= esc($statusTampil) ?>

                                </span>

                            </td>


                            <!-- =================================================
                                 WAKTU
                            ================================================== -->

                            <td>

                                <small class="text-muted">

                                    <?= esc($waktu) ?>

                                </small>

                            </td>


                            <!-- =================================================
                                 AKSI
                                 KHUSUS PERPUSTAKAAN
                            ================================================== -->

                            <td>

                                <div class="d-flex flex-wrap gap-2">


                                    <?php if ($logId > 0): ?>


                                        <!-- LIHAT -->

                                        <a
                                            href="<?= site_url('perpustakaan/log-aktivitas/lihat/' . $logId) ?>"
                                            class="btn btn-sm btn-outline-primary btn-action btn-view"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            title="Lihat dokumen terkait"
                                        >

                                            <i class="fas fa-eye me-1"></i>

                                            Lihat

                                        </a>


                                        <!-- DOWNLOAD -->

                                        <a
                                            href="<?= site_url('perpustakaan/log-aktivitas/download/' . $logId) ?>"
                                            class="btn btn-sm btn-outline-success btn-action btn-download"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            title="Download dokumen terkait"
                                        >

                                            <i class="fas fa-download me-1"></i>

                                            Download

                                        </a>


                                    <?php else: ?>


                                        <span class="text-muted">

                                            -

                                        </span>


                                    <?php endif; ?>


                                </div>

                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>

                </table>

            </div>


        <?php endif; ?>


    </div>

</div>


<?= $this->endSection() ?>
