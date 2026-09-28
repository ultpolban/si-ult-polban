<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<!-- ===================================================== -->
<!-- CONTENT HEADER -->
<!-- ===================================================== -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2 align-items-center">

            <div class="col-sm-6">

                <h1
                    class="m-0 font-weight-bold text-dark"
                    style="font-size: 1.75rem;"
                >
                    Data Tiket Permohonan
                </h1>

                <p class="text-muted small mb-0">
                    Kelola dan pantau seluruh tiket permohonan layanan mahasiswa.
                </p>

            </div>


            <div class="col-sm-6">

                <ol
                    class="breadcrumb float-sm-right bg-transparent p-0 m-0 text-sm"
                >

                    <li class="breadcrumb-item">

                        <a href="<?= base_url('dashboard') ?>">
                            Dashboard
                        </a>

                    </li>

                    <li class="breadcrumb-item active">
                        Data Tiket
                    </li>

                </ol>

            </div>

        </div>

    </div>

</div>


<!-- ===================================================== -->
<!-- MAIN CONTENT -->
<!-- ===================================================== -->

<section class="content">

<div class="container-fluid">


    <!-- ================================================= -->
    <!-- STATISTIC CARDS -->
    <!-- ================================================= -->

    <div class="row mb-3">


        <!-- TOTAL TIKET -->
        <div class="col-lg-3 col-6">

            <div
                class="card bg-primary text-white shadow-sm border-0 rounded-lg"
            >

                <div
                    class="card-body d-flex justify-content-between align-items-center p-3"
                >

                    <div>

                        <p
                            class="text-uppercase font-weight-bold mb-1"
                            style="font-size: 0.7rem; opacity: 0.85;"
                        >
                            Total Tiket
                        </p>

                        <h2 class="font-weight-bold mb-0">

                            <?= esc(
                                $totalTickets
                                ?? count($tickets ?? [])
                            ) ?>

                        </h2>

                    </div>


                    <div
                        class="rounded-circle p-3 text-white"
                        style="background: rgba(255,255,255,0.2);"
                    >

                        <i class="fas fa-ticket-alt fa-2x"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- MENUNGGU VERIFIKASI -->
        <div class="col-lg-3 col-6">

            <div
                class="card bg-warning text-white shadow-sm border-0 rounded-lg"
            >

                <div
                    class="card-body d-flex justify-content-between align-items-center p-3"
                >

                    <div>

                        <p
                            class="text-uppercase font-weight-bold mb-1"
                            style="font-size: 0.7rem; opacity: 0.85;"
                        >
                            Menunggu Verifikasi
                        </p>

                        <h2 class="font-weight-bold mb-0">

                            <?= esc($totalPending ?? 0) ?>

                        </h2>

                    </div>


                    <div
                        class="rounded-circle p-3 text-white"
                        style="background: rgba(255,255,255,0.2);"
                    >

                        <i class="far fa-clock fa-2x"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- TERVERIFIKASI -->
        <div class="col-lg-3 col-6">

            <div
                class="card bg-success text-white shadow-sm border-0 rounded-lg"
            >

                <div
                    class="card-body d-flex justify-content-between align-items-center p-3"
                >

                    <div>

                        <p
                            class="text-uppercase font-weight-bold mb-1"
                            style="font-size: 0.7rem; opacity: 0.85;"
                        >
                            Terverifikasi
                        </p>

                        <h2 class="font-weight-bold mb-0">

                            <?= esc($totalVerified ?? 0) ?>

                        </h2>

                    </div>


                    <div
                        class="rounded-circle p-3 text-white"
                        style="background: rgba(255,255,255,0.2);"
                    >

                        <i class="fas fa-user-check fa-2x"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- DIPROSES / DISPOSISI -->
        <div class="col-lg-3 col-6">

            <div
                class="card text-dark shadow-sm border-0 rounded-lg"
                style="background-color: #fbc02d;"
            >

                <div
                    class="card-body d-flex justify-content-between align-items-center p-3"
                >

                    <div>

                        <p
                            class="text-uppercase font-weight-bold mb-1"
                            style="font-size: 0.7rem; opacity: 0.85;"
                        >
                            Diproses / Disposisi
                        </p>

                        <h2 class="font-weight-bold mb-0">

                            <?= esc($totalProcessed ?? 0) ?>

                        </h2>

                    </div>


                    <div
                        class="rounded-circle p-3 text-dark"
                        style="background: rgba(0,0,0,0.08);"
                    >

                        <i class="fas fa-cogs fa-2x"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- FILTER -->
    <!-- ================================================= -->

    <div
        class="card shadow-sm border-0 mb-4 rounded-lg"
    >

        <div class="card-body p-3">

            <form
                method="get"
                action="<?= base_url('datatiket') ?>"
                id="filterForm"
            >

                <div class="form-row align-items-center">


                    <!-- SEARCH -->
                    <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">

                        <div class="input-group input-group-sm">

                            <div class="input-group-prepend">

                                <span
                                    class="input-group-text bg-white border-right-0"
                                >

                                    <i class="fas fa-search text-muted"></i>

                                </span>

                            </div>


                            <input
                                type="text"
                                name="keyword"
                                class="form-control form-control-sm border-left-0"
                                placeholder="Cari No Tiket, Nama, NIK, Layanan..."
                                value="<?= esc($keyword ?? '') ?>"
                            >

                        </div>

                    </div>


                    <!-- STATUS -->
                    <div class="col-lg-2 col-md-3 mb-2 mb-lg-0">

                        <select
                            name="status"
                            class="form-control form-control-sm"
                        >

                            <option value="">
                                -- Semua Status --
                            </option>

                            <?php

                            $statuses = [

                                'submitted'  => 'Submitted',

                                'verified'   => 'Verified',

                                'assigned'   => 'Assigned',

                                'in_progress' => 'In Progress',

                                'completed'  => 'Completed',

                                'rejected'   => 'Rejected',

                                'cancelled'  => 'Cancelled'

                            ];

                            ?>


                            <?php foreach ($statuses as $val => $lbl): ?>

                                <option
                                    value="<?= esc($val) ?>"
                                    <?= (($status ?? '') === $val)
                                        ? 'selected'
                                        : '' ?>
                                >

                                    <?= esc($lbl) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- KATEGORI -->
                    <div class="col-lg-2 col-md-3 mb-2 mb-lg-0">

                        <select
                            name="category"
                            class="form-control form-control-sm"
                        >

                            <option value="">
                                -- Semua Kategori --
                            </option>


                            <option
                                value="Akademik"
                                <?= (($category ?? '') === 'Akademik')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Akademik
                            </option>


                            <option
                                value="Kemahasiswaan"
                                <?= (($category ?? '') === 'Kemahasiswaan')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Kemahasiswaan
                            </option>


                            <option
                                value="IT"
                                <?= (($category ?? '') === 'IT')
                                    ? 'selected'
                                    : '' ?>
                            >
                                IT
                            </option>

                        </select>

                    </div>


                    <!-- PER PAGE -->
                    <div class="col-lg-1 col-md-2 mb-2 mb-lg-0">

                        <input
                            type="number"
                            name="per_page"
                            class="form-control form-control-sm text-center"
                            min="1"
                            value="<?= esc($perPage ?? 10) ?>"
                            onchange="this.form.submit()"
                        >

                    </div>


                    <!-- FILTER BUTTON -->
                    <div class="col-lg-3 col-md-4 d-flex gap-1">

                        <button
                            type="submit"
                            class="btn btn-sm text-white font-weight-bold flex-fill mr-1"
                            style="background-color: #1e3a8a;"
                        >

                            <i class="fas fa-filter mr-1"></i>

                            Filter

                        </button>


                        <a
                            href="<?= base_url('datatiket') ?>"
                            class="btn btn-secondary btn-sm"
                            title="Reset Filter"
                        >

                            <i class="fas fa-undo"></i>

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- TABLE -->
    <!-- ================================================= -->

    <div
        class="card shadow-sm border-0 rounded-lg overflow-hidden"
    >


        <!-- TABLE HEADER -->
        <div class="card-header bg-white py-3">

            <div
                class="d-flex justify-content-between align-items-center"
            >

                <div>

                    <h5
                        class="card-title font-weight-bold mb-0 text-dark"
                    >

                        <i
                            class="fas fa-inbox text-primary mr-2"
                        ></i>

                        Daftar Tiket

                    </h5>


                    <small
                        class="text-muted d-block mt-1"
                    >

                        Kelola tiket masuk dan proses layanan mahasiswa.

                    </small>

                </div>


                <!-- EXPORT -->
                <div
                    class="d-flex align-items-center"
                >

                    <div class="dropdown mr-2">

                        <button
                            class="btn btn-sm text-white font-weight-bold dropdown-toggle"
                            type="button"
                            id="exportDataTiket"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            style="background-color: #2f3b8f;"
                        >

                            <i class="fas fa-download mr-1"></i>

                            Export Laporan

                        </button>


                        <div
                            class="dropdown-menu dropdown-menu-right shadow-sm"
                            aria-labelledby="exportDataTiket"
                        >

                            <a
                                class="dropdown-item"
                                href="<?= base_url('datatiket/export/pdf') ?>"
                            >

                                <i
                                    class="fas fa-file-pdf text-danger mr-2"
                                ></i>

                                Export PDF

                            </a>


                            <a
                                class="dropdown-item"
                                href="<?= base_url('datatiket/export/excel') ?>"
                            >

                                <i
                                    class="fas fa-file-excel text-success mr-2"
                                ></i>

                                Export Excel

                            </a>


                            <a
                                class="dropdown-item"
                                href="<?= base_url('datatiket/export/csv') ?>"
                            >

                                <i
                                    class="fas fa-file-csv text-primary mr-2"
                                ></i>

                                Export CSV

                            </a>

                        </div>

                    </div>


                    <span
                        class="badge badge-light border px-3 py-2 font-weight-bold text-dark"
                    >

                        <?= esc(
                            $totalTickets
                            ?? count($tickets ?? [])
                        ) ?>

                        Tiket

                    </span>

                </div>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- TABLE BODY -->
        <!-- ================================================= -->

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    class="table table-striped table-hover mb-0 text-sm align-middle"
                >

                    <thead
                        class="text-white"
                        style="background-color: #1e293b;"
                    >

                        <tr>

                            <th
                                width="50"
                                class="py-3 pl-3"
                            >
                                No
                            </th>

                            <th class="py-3">
                                No. Tiket
                            </th>

                            <th class="py-3">
                                Nama Pemohon
                            </th>

                            <th class="py-3">
                                NIK
                            </th>

                            <th class="py-3">
                                Layanan
                            </th>

                            <th class="py-3">
                                Kategori
                            </th>

                            <th class="py-3">
                                Dokumen
                            </th>

                            <th class="py-3">
                                Status
                            </th>

                            <th class="py-3">
                                Tgl Pengajuan
                            </th>

                            <th
                                width="220"
                                class="py-3 text-center"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php if (!empty($tickets)): ?>


                        <?php

                        $currentPage = isset($pager)
                            ? $pager->getCurrentPage('datatiket')
                            : 1;

                        $limitPerPage = $perPage ?? 10;

                        $no = 1 + (
                            $limitPerPage *
                            ($currentPage - 1)
                        );

                        ?>


                        <?php foreach ($tickets as $ticket): ?>


                            <?php

                            /*
                             * =========================================
                             * STATUS TIKET
                             * =========================================
                             */

                            $status = strtolower(
                                trim(
                                    $ticket['status']
                                    ?? 'submitted'
                                )
                            );


                            /*
                             * =========================================
                             * BADGE STATUS
                             * =========================================
                             */

                            $statusBadge = match ($status) {

                                'submitted' =>
                                    'warning',

                                'verified' =>
                                    'success',

                                'assigned' =>
                                    'primary',

                                'in_progress' =>
                                    'primary',

                                'completed' =>
                                    'success',

                                'rejected' =>
                                    'danger',

                                'cancelled' =>
                                    'secondary',

                                default =>
                                    'secondary',

                            };


                            /*
                             * =========================================
                             * LABEL STATUS
                             * =========================================
                             */

                            $statusLabel = match ($status) {

                                'submitted' =>
                                    'Submitted',

                                'verified' =>
                                    'Verified',

                                'assigned' =>
                                    'Assigned',

                                'in_progress' =>
                                    'In Progress',

                                'completed' =>
                                    'Completed',

                                'rejected' =>
                                    'Rejected',

                                'cancelled' =>
                                    'Cancelled',

                                default =>
                                    ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $status
                                        )
                                    ),

                            };


                            /*
                             * =========================================
                             * DOKUMEN
                             * =========================================
                             */

                            $docStatus =
                                $ticket['has_document']
                                ?? true;


                            /*
                             * =========================================
                             * ID TIKET
                             * =========================================
                             */

                            $ticketId =
                                $ticket['id'];

                            ?>


                            <tr>


                                <!-- NO -->
                                <td class="pl-3 text-muted">

                                    <?= $no++ ?>

                                </td>


                                <!-- NOMOR TIKET -->
                                <td>

                                    <strong
                                        class="text-primary"
                                    >

                                        <?= esc(
                                            $ticket['ticket_number']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </td>


                                <!-- NAMA -->
                                <td class="font-weight-bold">

                                    <?= esc(
                                        $ticket['applicant_name']
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- NIK -->
                                <td class="text-muted">

                                    <?= esc(
                                        $ticket['nik']
                                        ?? $ticket['nim']
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- LAYANAN -->
                                <td>

                                    <?= esc(
                                        $ticket['service_name']
                                        ?? '-'
                                    ) ?>

                                </td>


                                <!-- KATEGORI -->
                                <td>

                                    <span
                                        class="badge badge-light border text-dark font-weight-normal px-2 py-1"
                                    >

                                        <?= esc(
                                            $ticket['category_name']
                                            ?? 'Umum'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- DOKUMEN -->
                                <td>

                                    <?php if ($docStatus): ?>

                                        <span
                                            class="badge badge-success px-2 py-1"
                                        >

                                            <i
                                                class="fas fa-check-circle mr-1"
                                            ></i>

                                            Ada

                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="badge badge-danger px-2 py-1"
                                        >

                                            <i
                                                class="fas fa-times-circle mr-1"
                                            ></i>

                                            Tidak Ada

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- STATUS -->
                                <td>

                                    <span
                                        class="badge badge-<?= $statusBadge ?> px-2 py-1"
                                    >


                                        <?php if ($status === 'submitted'): ?>

                                            <i
                                                class="far fa-clock mr-1"
                                            ></i>


                                        <?php elseif ($status === 'verified'): ?>

                                            <i
                                                class="fas fa-check-circle mr-1"
                                            ></i>


                                        <?php elseif ($status === 'assigned'): ?>

                                            <i
                                                class="fas fa-share-square mr-1"
                                            ></i>


                                        <?php elseif ($status === 'in_progress'): ?>

                                            <i
                                                class="fas fa-spinner mr-1"
                                            ></i>


                                        <?php elseif ($status === 'completed'): ?>

                                            <i
                                                class="fas fa-check-double mr-1"
                                            ></i>


                                        <?php elseif ($status === 'rejected'): ?>

                                            <i
                                                class="fas fa-times-circle mr-1"
                                            ></i>


                                        <?php else: ?>

                                            <i
                                                class="fas fa-info-circle mr-1"
                                            ></i>

                                        <?php endif; ?>


                                        <?= esc($statusLabel) ?>

                                    </span>

                                </td>


                                <!-- TANGGAL -->
                                <td class="text-muted small">

                                    <?= esc(
                                        $ticket['created_at']
                                        ?? '-'
                                    ) ?>

                                </td>


                               <!-- ================================================= -->
<!-- AKSI SESUAI STATUS -->
<!-- ================================================= -->

<td class="text-center">

    <div
        class="d-flex justify-content-center align-items-center"
        style="gap: 4px;"
    >

        <!-- ================================= -->
        <!-- DETAIL -->
        <!-- SELALU MUNCUL -->
        <!-- ================================= -->

        <a
            href="<?= base_url(
                'verification/detail/' . $ticketId
            ) ?>"
            class="btn btn-info btn-sm text-white"
            title="Detail Tiket"
        >
            <i class="fas fa-eye"></i>
            Detail
        </a>


        <!-- ================================= -->
        <!-- SUBMITTED -->
        <!-- DETAIL + VERIFIKASI -->
        <!-- ================================= -->

        <?php if ($status === 'submitted'): ?>

            <a
                href="<?= base_url(
                    'verification/process/' . $ticketId
                ) ?>"
                class="btn btn-success btn-sm"
                title="Verifikasi Tiket"
            >
                <i class="fas fa-user-check"></i>
                Verifikasi
            </a>

        <?php endif; ?>


        <!-- ================================= -->
        <!-- VERIFIED -->
        <!-- DETAIL + DISPOSISI -->
        <!-- ================================= -->

        <?php if ($status === 'verified'): ?>

            <a
                href="<?= base_url(
                    'disposition/detail/' . $ticketId
                ) ?>"
                class="btn btn-warning btn-sm text-white"
                title="Disposisi Tiket"
            >
                <i class="fas fa-share-square"></i>
                Disposisi
            </a>

        <?php endif; ?>


        <!-- ================================= -->
        <!-- ASSIGNED -->
        <!-- DETAIL SAJA -->
        <!-- ================================= -->


        <!-- ================================= -->
        <!-- IN PROGRESS -->
        <!-- DETAIL SAJA -->
        <!-- ================================= -->


        <!-- ================================= -->
        <!-- COMPLETED -->
        <!-- DETAIL SAJA -->
        <!-- ================================= -->


        <!-- ================================= -->
        <!-- REJECTED -->
        <!-- DETAIL SAJA -->
        <!-- ================================= -->


        <!-- ================================= -->
        <!-- CANCELLED -->
        <!-- DETAIL SAJA -->
        <!-- ================================= -->

    </div>

</td>

                                </td>


                            </tr>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <!-- TIDAK ADA DATA -->
                        <tr>

                            <td
                                colspan="10"
                                class="text-center py-4 text-muted"
                            >

                                <i
                                    class="fas fa-folder-open fa-2x mb-2 d-block"
                                ></i>

                                Tidak ada data tiket yang ditemukan.

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- PAGINATION -->
        <!-- ================================================= -->

        <?php if (isset($pager)): ?>

            <div
                class="card-footer bg-white py-3 d-flex justify-content-between align-items-center"
            >

                <div class="text-muted small">

                    Menampilkan

                    <?= count($tickets ?? []) ?>

                    data pada halaman ini

                </div>


                <div>

                    <?= $pager->links(
                        'datatiket',
                        'default_full'
                    ) ?>

                </div>

            </div>

        <?php endif; ?>


    </div>

</div>

</section>


<?= $this->endSection() ?>