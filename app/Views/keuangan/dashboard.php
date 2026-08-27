<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="dashboard-title mb-1">
            Dashboard Keuangan
        </h2>

        <p class="dashboard-subtitle">

            Selamat datang,

            <strong>
                <?= esc(session()->get('name') ?: 'Petugas Keuangan') ?>
            </strong>

            👋

        </p>

    </div>


    <div class="text-end">

        <span class="badge bg-primary px-3 py-2">

            <i class="fas fa-calendar-alt me-1"></i>

            <?= date('d-m-Y') ?>

        </span>

    </div>

</div>


<!-- =========================================================
     STATISTIK
========================================================= -->

<div class="row g-4 mb-4">

    <!-- TOTAL -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-primary">

            <h2>
                <?= $total ?? 0 ?>
            </h2>

            <p>
                Total Tiket
            </p>

            <i class="fas fa-ticket-alt"></i>

        </div>

    </div>


    <!-- MENUNGGU -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-warning">

            <h2>
                <?= $menunggu ?? 0 ?>
            </h2>

            <p>
                Menunggu
            </p>

            <i class="fas fa-hourglass-half"></i>

        </div>

    </div>


    <!-- DIPROSES -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-info">

            <h2>
                <?= $diproses ?? 0 ?>
            </h2>

            <p>
                Diproses
            </p>

            <i class="fas fa-spinner"></i>

        </div>

    </div>


    <!-- SELESAI -->

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-success">

            <h2>
                <?= $selesai ?? 0 ?>
            </h2>

            <p>
                Selesai
            </p>

            <i class="fas fa-check-circle"></i>

        </div>

    </div>

</div>


<!-- =========================================================
     TABEL TIKET
========================================================= -->

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0 fw-bold">

            <i class="fas fa-list me-2 text-primary"></i>

            Tiket Terbaru

        </h5>


        <span class="badge bg-secondary">

            <?= count($tiket ?? []) ?>

            Tiket

        </span>

    </div>


    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle table-hover">

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

                        <th width="130">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (empty($tiket)): ?>

                        <tr>

                            <td
                                colspan="8"
                                class="text-center text-muted py-5"
                            >

                                <i
                                    class="fas fa-folder-open fa-2x mb-2"
                                ></i>

                                <br>

                                Belum ada data tiket.

                            </td>

                        </tr>

                    <?php else: ?>


                        <?php foreach ($tiket as $t): ?>


                            <?php

                            /*
                             * STATUS DATABASE
                             */

                            $statusDatabase =
                                strtolower(
                                    trim(
                                        (string)
                                        ($t['status'] ?? '')
                                    )
                                );


                            /*
                             * STATUS INDONESIA
                             */

                            switch ($statusDatabase) {

                                case 'draft':
                                case 'submitted':
                                case 'menunggu':

                                    $statusTampilan =
                                        'Menunggu';

                                    $badge =
                                        'warning';

                                    break;


                                case 'verification':
                                case 'processing':
                                case 'in_progress':
                                case 'diproses':

                                    $statusTampilan =
                                        'Diproses';

                                    $badge =
                                        'primary';

                                    break;


                                case 'completed':
                                case 'complete':
                                case 'selesai':

                                    $statusTampilan =
                                        'Selesai';

                                    $badge =
                                        'success';

                                    break;


                                case 'rejected':
                                case 'ditolak':

                                    $statusTampilan =
                                        'Ditolak';

                                    $badge =
                                        'danger';

                                    break;


                                case 'cancelled':
                                case 'canceled':
                                case 'dibatalkan':

                                    $statusTampilan =
                                        'Dibatalkan';

                                    $badge =
                                        'secondary';

                                    break;


                                default:

                                    $statusTampilan =
                                        ucfirst(
                                            $statusDatabase
                                        );

                                    $badge =
                                        'secondary';

                                    break;
                            }


                            /*
                             * NO TIKET
                             */

                            $noTiket =
                                $t['no_tiket']
                                ?? $t['ticket_number']
                                ?? '-';


                            /*
                             * NAMA PEMOHON
                             */

                            $namaPemohon =
                                $t['nama_pemohon']
                                ?? $t['applicant_name']
                                ?? $t['name']
                                ?? '-';


                            /*
                             * NIK
                             */

                            $nik =
                                $t['nik']
                                ?? $t['nim']
                                ?? '-';


                            /*
                             * LAYANAN
                             */

                            $namaLayanan =
                                $t['nama_layanan']
                                ?? '-';


                            /*
                             * UNIT
                             */

                            $namaUnit =
                                $t['nama_unit']
                                ?? '-';


                            /*
                             * TANGGAL
                             */

                            $tanggal =
                                $t['created_at']
                                ?? $t['tanggal']
                                ?? null;

                            ?>


                            <tr>

                                <!-- NO TIKET -->

                                <td>

                                    <strong>

                                        <?= esc($noTiket) ?>

                                    </strong>

                                </td>


                                <!-- NAMA PENGAJU -->

                                <td>

                                    <?= esc($namaPemohon) ?>

                                </td>


                                <!-- NIK -->

                                <td>

                                    <?= esc($nik) ?>

                                </td>


                                <!-- JENIS LAYANAN -->

                                <td>

                                    <?= esc($namaLayanan) ?>

                                </td>


                                <!-- UNIT LAYANAN -->

                                <td>

                                    <?= esc($namaUnit) ?>

                                </td>


                                <!-- TANGGAL -->

                                <td>

                                    <?php if (!empty($tanggal)): ?>

                                        <?= date(
                                            'd-m-Y',
                                            strtotime($tanggal)
                                        ) ?>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    <span
                                        class="badge bg-<?= esc($badge) ?>"
                                    >

                                        <?= esc($statusTampilan) ?>

                                    </span>

                                </td>


                                <!-- AKSI -->

                                <td>

                                    <a
                                        href="<?= base_url(
                                            'keuangan/detail/' .
                                            ($t['id'] ?? 0)
                                        ) ?>"
                                        class="btn btn-primary btn-sm"
                                    >

                                        <i
                                            class="fas fa-eye me-1"
                                        ></i>

                                        Detail

                                    </a>

                                </td>

                            </tr>


                        <?php endforeach; ?>


                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>