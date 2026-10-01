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
        box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
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

    .status-diproses {
        background: #cfe2ff;
        color: #084298;
    }

    .status-selesai {
        background: #d1e7dd;
        color: #0f5132;
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
        transition: .2s ease;
    }

    .btn-detail:hover {
        background: #ff7f00;
        color: #ffffff;
    }


    /* =========================================================
       SEARCH
    ========================================================= */

    .search-box {
        width: 300px;
        max-width: 100%;
    }

    .search-box .form-control {
        border-radius: 8px 0 0 8px;
    }

    .search-box .btn {
        border-radius: 0 8px 8px 0;
        background: #293582;
        color: #ffffff;
        border: none;
    }

    .search-box .btn:hover {
        background: #ff7f00;
        color: #ffffff;
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
       EMPTY DATA
    ========================================================= */

    .empty-data {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-data i {
        font-size: 45px;
        margin-bottom: 15px;
        color: #adb5bd;
    }

    .empty-data h5 {
        color: #495057;
        font-weight: 600;
    }


    /* =========================================================
       UNIT BADGE
    ========================================================= */

    .unit-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eef0ff;
        color: #293582;
        border-radius: 20px;
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .data-title {
            font-size: 24px;
        }

        .data-header {
            align-items: flex-start !important;
        }

        .search-box {
            width: 100%;
        }

    }
</style>


<!-- =========================================================
     HEADER PERPUSTAKAAN
========================================================= -->

<div class="data-header">

    <h1 class="data-title">

        <i class="fas fa-book me-2"
           style="color:#293582;"></i>

        Data Tiket Perpustakaan

    </h1>

    <p class="data-subtitle">

        Daftar tiket layanan yang masuk ke Unit Perpustakaan.

    </p>

</div>


<!-- =========================================================
     CARD DATA TIKET PERPUSTAKAAN
========================================================= -->

<div class="card card-tiket">


    <!-- =====================================================
         CARD HEADER
    ====================================================== -->

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h5 class="mb-1 fw-bold">

                    <i class="fas fa-ticket-alt me-2"
                       style="color:#293582;"></i>

                    Daftar Tiket

                </h5>

                <small class="text-muted">

                    Data pengajuan tiket layanan Perpustakaan

                </small>

            </div>


            <!-- =================================================
                 SEARCH KHUSUS PERPUSTAKAAN
            ================================================== -->

            <form
                method="get"
                action="<?= site_url('perpustakaan/data-tiket') ?>"
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
                        title="Cari tiket Perpustakaan"
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

    <div class="card-body p-0">

        <div class="table-wrapper">

            <table class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th>
                            No Tiket
                        </th>

                        <th>
                            Nama Pemohon
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
                            ?? 'Layanan Perpustakaan';


                        /* =================================================
                           UNIT LAYANAN
                           SELALU PERPUSTAKAAN
                        ================================================= */

                        $namaUnit = 'Perpustakaan';


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
                           HANYA:
                           MENUNGGU
                           DIPROSES
                           SELESAI
                        ================================================= */

                        $status =
                            $row['status']
                            ?? 'Menunggu';


                        $statusLower = strtolower(
                            trim((string) $status)
                        );


                        /* =================================================
                           NORMALISASI STATUS
                        ================================================= */

                        if (
                            in_array(
                                $statusLower,
                                [
                                    'draft',
                                    'submitted',
                                    'menunggu',
                                    'pending'
                                ],
                                true
                            )
                        ) {

                            $statusTampil = 'Menunggu';
                            $statusClass = 'status-menunggu';

                        } elseif (
                            in_array(
                                $statusLower,
                                [
                                    'verification',
                                    'processing',
                                    'in_progress',
                                    'diproses'
                                ],
                                true
                            )
                        ) {

                            $statusTampil = 'Diproses';
                            $statusClass = 'status-diproses';

                        } elseif (
                            in_array(
                                $statusLower,
                                [
                                    'completed',
                                    'complete',
                                    'selesai'
                                ],
                                true
                            )
                        ) {

                            $statusTampil = 'Selesai';
                            $statusClass = 'status-selesai';

                        } else {

                            /*
                             * Jika status dari database tidak dikenali,
                             * tampilkan sebagai Menunggu agar UI
                             * Perpustakaan tetap konsisten.
                             */

                            $statusTampil = 'Menunggu';
                            $statusClass = 'status-menunggu';

                        }


                        /* =================================================
                           ID TIKET
                        ================================================= */

                        $id = $row['id'] ?? null;

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
                                 NAMA PEMOHON
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

                                <span class="unit-badge">

                                    <i class="fas fa-book"></i>

                                    Perpustakaan

                                </span>

                            </td>


                            <!-- =================================================
                                 TANGGAL
                            ================================================= -->

                            <td>

                                <?php if ($tanggal): ?>

                                    <?php

                                    $timestamp = strtotime($tanggal);

                                    ?>

                                    <?php if ($timestamp !== false): ?>

                                        <?= date('d-m-Y', $timestamp) ?>

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

                                <span class="badge-status <?= esc($statusClass) ?>">

                                    <?= esc($statusTampil) ?>

                                </span>

                            </td>


                            <!-- =================================================
                                 AKSI
                                 KHUSUS PERPUSTAKAAN
                            ================================================= -->

                            <td>

                                <?php if ($id): ?>

                                    <a
                                        href="<?= site_url('perpustakaan/detail/' . $id) ?>"
                                        class="btn-detail"
                                    >

                                        <i class="fas fa-eye me-1"></i>

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

                                <i class="fas fa-book-open d-block"></i>

                                <h5 class="mb-2">

                                    Belum Ada Data Tiket Perpustakaan

                                </h5>

                                <p class="mb-0">

                                    Belum terdapat tiket yang masuk
                                    ke Unit Perpustakaan.

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

</div>


<?= $this->endSection() ?>
