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
    box-shadow: 0 0 0 0.2rem rgba(41, 53, 130, 0.25);
}


/* =========================================================
   CARD
========================================================= */

.card-logs {
    border: none;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,.08);
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

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

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
   BADGE UNIT
========================================================= */

.badge-unit {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    background: #e3f2fd;
    color: #1976d2;
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
   BUTTON
========================================================= */

.btn-log-view {
    border-radius: 8px;
    font-size: 12px;
    padding: 6px 11px;
}

.btn-log-download {
    border-radius: 8px;
    font-size: 12px;
    padding: 6px 11px;
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
    color: #ccc;
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
        font-size: 22px;
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
     HEADER
========================================================= -->

<div class="log-header">

    <h1 class="log-title">

        📋 Log Aktivitas Jurusan

    </h1>

    <p class="log-subtitle">

        Pantau semua aktivitas dan perubahan status tiket
        di Unit Layanan Jurusan

    </p>

</div>


<!-- =========================================================
     FILTER SECTION
========================================================= -->

<div class="filter-section">

    <form
        method="get"
        action="<?= base_url('jurusan/log-aktivitas') ?>"
        class="row g-3"
    >

        <!-- =================================================
             SEARCH AKTIVITAS
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
                placeholder="Cari tiket, layanan, atau status..."
                value="<?= esc($keyword ?? '') ?>"
            >

        </div>


        <!-- =================================================
             UNIT JURUSAN
        ================================================== -->

        <div class="col-md-4">

            <label
                for="unit_filter"
                class="form-label"
            >

                🏢 Unit Layanan

            </label>

            <select
                class="form-select"
                id="unit_filter"
                name="unit"
            >

                <option value="Jurusan" selected>
                    Jurusan
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

            <h5 class="mb-0 fw-bold">

                📝 Daftar Log Aktivitas Jurusan

            </h5>

            <small class="text-muted">

                <?= count($logs ?? []) ?> Aktivitas

            </small>

        </div>

    </div>


    <!-- =====================================================
         CARD BODY
    ====================================================== -->

    <div class="card-body p-0">

        <?php if (empty($logs)): ?>


            <!-- =================================================
                 EMPTY STATE
            ================================================== -->

            <div class="empty-state">

                <div class="empty-state-icon">

                    📭

                </div>

                <h5 class="text-muted">

                    Belum ada log aktivitas Jurusan

                </h5>

                <p class="empty-state-text mb-0">

                    Belum ada aktivitas yang tercatat
                    untuk Unit Layanan Jurusan.

                    <?php if (!empty($keyword)): ?>

                        <br>

                        Coba ubah kata kunci pencarian.

                    <?php endif; ?>

                </p>

            </div>


        <?php else: ?>


            <!-- =================================================
                 TABLE
            ================================================== -->

            <div class="table-wrapper">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th style="width: 12%;">
                                No Tiket
                            </th>

                            <th style="width: 15%;">
                                Unit
                            </th>

                            <th style="width: 15%;">
                                Layanan
                            </th>

                            <th style="width: 30%;">
                                Aktivitas
                            </th>

                            <th style="width: 12%;">
                                Status
                            </th>

                            <th style="width: 11%;">
                                Waktu
                            </th>

                            <th style="width: 15%;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php foreach ($logs as $log): ?>

                        <?php

                        /* =================================================
                           STATUS KHUSUS JURUSAN
                        ================================================= */

                        $status = strtolower(
                            trim(
                                (string) ($log['status'] ?? '')
                            )
                        );

                        $badgeClass =
                            'badge-status status-pending';

                        if (
                            str_contains(
                                $status,
                                'menunggu'
                            )
                        ) {

                            $badgeClass =
                                'badge-status status-pending';

                        } elseif (
                            str_contains(
                                $status,
                                'diproses'
                            )
                            ||
                            str_contains(
                                $status,
                                'processing'
                            )
                        ) {

                            $badgeClass =
                                'badge-status status-processing';

                        } elseif (
                            str_contains(
                                $status,
                                'selesai'
                            )
                            ||
                            str_contains(
                                $status,
                                'completed'
                            )
                        ) {

                            $badgeClass =
                                'badge-status status-completed';

                        }

                        $logId =
                            (int) (
                                $log['log_id']
                                ?? $log['id']
                                ?? 0
                            );

                        ?>

                        <tr>


                            <!-- =================================================
                                 NO TIKET
                            ================================================== -->

                            <td>

                                <strong>

                                    <?= esc(
                                        $log['no_tiket']
                                        ?? '-'
                                    ) ?>

                                </strong>

                            </td>


                            <!-- =================================================
                                 UNIT
                            ================================================== -->

                            <td>

                                <span class="badge-unit">

                                    <?= esc(
                                        $log['unit']
                                        ?? 'Jurusan'
                                    ) ?>

                                </span>

                            </td>


                            <!-- =================================================
                                 LAYANAN
                            ================================================== -->

                            <td>

                                <?= esc(
                                    $log['layanan']
                                    ?? '-'
                                ) ?>

                            </td>


                            <!-- =================================================
                                 AKTIVITAS
                            ================================================== -->

                            <td>

                                <small>

                                    <?= esc(
                                        $log['aktivitas']
                                        ?? '-'
                                    ) ?>

                                </small>

                            </td>


                            <!-- =================================================
                                 STATUS
                            ================================================== -->

                            <td>

                                <span
                                    class="<?= $badgeClass ?>"
                                >

                                    <?= esc(
                                        $log['status']
                                        ?? '-'
                                    ) ?>

                                </span>

                            </td>


                            <!-- =================================================
                                 WAKTU
                            ================================================== -->

                            <td>

                                <small class="text-muted">

                                    <?= esc(
                                        $log['waktu']
                                        ?? $log['tanggal']
                                        ?? '-'
                                    ) ?>

                                </small>

                            </td>


                            <!-- =================================================
                                 AKSI
                            ================================================== -->

                            <td>

                                <div class="d-flex flex-wrap gap-2">


                                    <!-- =========================================
                                         LIHAT
                                    ========================================== -->

                                    <?php if ($logId > 0): ?>

                                        <a
                                            href="<?= base_url(
                                                'jurusan/log-aktivitas/lihat/' . $logId
                                            ) ?>"
                                            class="btn btn-sm btn-outline-primary btn-log-view"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            title="Lihat dokumen terkait"
                                        >

                                            👁️ Lihat

                                        </a>


                                        <!-- =====================================
                                             DOWNLOAD
                                        ====================================== -->

                                        <a
                                            href="<?= base_url(
                                                'jurusan/log-aktivitas/download/' . $logId
                                            ) ?>"
                                            class="btn btn-sm btn-outline-success btn-log-download"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            title="Download dokumen terkait"
                                        >

                                            ⬇️ Download

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