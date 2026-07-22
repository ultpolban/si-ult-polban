<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- ============================= -->
    <!-- HEADER -->
    <!-- ============================= -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>

                        <i class="fas fa-ticket-alt text-danger"></i>

                        Tracking Tiket

                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dashboard-mahasiswa') ?>">

                                Dashboard Mahasiswa

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Tracking Tiket

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <!-- ============================= -->
    <!-- CONTENT -->
    <!-- ============================= -->

    <section class="content">

        <div class="container-fluid">


            <!-- ============================= -->
            <!-- INFORMASI -->
            <!-- ============================= -->

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <h4 class="mb-2">

                                <i class="fas fa-search text-primary mr-2"></i>

                                Riwayat Pengajuan Layanan

                            </h4>

                            <p class="text-muted mb-0">

                                Pantau status pengajuan layanan yang telah
                                kamu ajukan melalui sistem SI-ULT POLBAN.

                            </p>

                        </div>

                        <div class="col-md-4 text-md-right mt-3 mt-md-0">

                            <a
                                href="<?= base_url('mahasiswa/ticket/create') ?>"
                                class="btn btn-danger"
                            >

                                <i class="fas fa-plus-circle mr-1"></i>

                                Ajukan Layanan Baru

                            </a>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ============================= -->
            <!-- TABEL TIKET -->
            <!-- ============================= -->

            <div class="card shadow-sm">

                <div class="card-header bg-danger text-white">

                    <h3 class="card-title mb-0">

                        <i class="fas fa-list mr-2"></i>

                        Daftar Tiket Saya

                    </h3>

                </div>


                <div class="card-body table-responsive p-0">

                    <table class="table table-hover table-bordered mb-0">

                        <thead class="bg-light">

                            <tr>

                                <th width="60">

                                    No

                                </th>

                                <th>

                                    Nomor Tiket

                                </th>

                                <th>

                                    Jenis Layanan

                                </th>

                                <th>

                                    Unit Tujuan

                                </th>

                                <th>

                                    Tanggal Pengajuan

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

                        <?php if (!empty($tickets)): ?>

                            <?php $no = 1; ?>

                            <?php foreach ($tickets as $ticket): ?>

                                <tr>

                                    <!-- NOMOR -->

                                    <td>

                                        <?= $no++ ?>

                                    </td>


                                    <!-- NOMOR TIKET -->

                                    <td>

                                        <strong>

                                            <?= esc(
                                                $ticket['nomor']
                                                ?? $ticket['ticket_number']
                                                ?? '-'
                                            ) ?>

                                        </strong>

                                    </td>


                                    <!-- LAYANAN -->

                                    <td>

                                        <?= esc(
                                            $ticket['layanan']
                                            ?? $ticket['service_name']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- UNIT -->

                                    <td>

                                        <?= esc(
                                            $ticket['unit']
                                            ?? 'Belum Ditentukan'
                                        ) ?>

                                    </td>


                                    <!-- TANGGAL -->

                                    <td>

                                        <?= esc(
                                            $ticket['tanggal']
                                            ?? $ticket['created_at']
                                            ?? '-'
                                        ) ?>

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        <?php

                                        $status = $ticket['status'] ?? 'Submitted';

                                        $badge = 'secondary';

                                        $icon = 'fa-question-circle';

                                        if ($status == 'Submitted') {

                                            $badge = 'primary';

                                            $icon = 'fa-paper-plane';

                                        } elseif ($status == 'Verified') {

                                            $badge = 'success';

                                            $icon = 'fa-check';

                                        } elseif ($status == 'Assigned') {

                                            $badge = 'info';

                                            $icon = 'fa-user-check';

                                        } elseif ($status == 'In Progress') {

                                            $badge = 'warning';

                                            $icon = 'fa-spinner';

                                        } elseif ($status == 'Revision') {

                                            $badge = 'danger';

                                            $icon = 'fa-exclamation-circle';

                                        } elseif ($status == 'Completed') {

                                            $badge = 'success';

                                            $icon = 'fa-check-circle';

                                        }

                                        ?>

                                        <span class="badge bg-<?= $badge ?> p-2">

                                            <i class="fas <?= $icon ?> mr-1"></i>

                                            <?= esc($status) ?>

                                        </span>

                                    </td>


                                    <!-- AKSI -->

                                    <td>

                                        <a
                                            href="<?= base_url(
                                                'mahasiswa/ticket/detail/' .
                                                ($ticket['id'] ?? 0)
                                            ) ?>"
                                            class="btn btn-info btn-sm"
                                        >

                                            <i class="fas fa-eye"></i>

                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>


                        <?php else: ?>

                            <!-- TIDAK ADA TIKET -->

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <i
                                        class="fas fa-folder-open fa-3x text-muted mb-3"
                                    ></i>

                                    <h5>

                                        Belum Ada Pengajuan

                                    </h5>

                                    <p class="text-muted">

                                        Kamu belum memiliki pengajuan layanan.

                                    </p>

                                    <a
                                        href="<?= base_url(
                                            'mahasiswa/ticket/create'
                                        ) ?>"
                                        class="btn btn-danger"
                                    >

                                        <i class="fas fa-plus-circle mr-1"></i>

                                        Ajukan Layanan

                                    </a>

                                </td>

                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- ============================= -->
            <!-- KETERANGAN STATUS -->
            <!-- ============================= -->

            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">

                    <h3 class="card-title mb-0">

                        <i class="fas fa-info-circle mr-2"></i>

                        Keterangan Status Tiket

                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <span class="badge bg-primary p-2">

                                <i class="fas fa-paper-plane mr-1"></i>

                                Submitted

                            </span>

                            <p class="text-muted mt-2 mb-0">

                                Pengajuan telah berhasil dikirim.

                            </p>

                        </div>


                        <div class="col-md-4 mb-3">

                            <span class="badge bg-success p-2">

                                <i class="fas fa-check mr-1"></i>

                                Verified

                            </span>

                            <p class="text-muted mt-2 mb-0">

                                Pengajuan telah diverifikasi.

                            </p>

                        </div>


                        <div class="col-md-4 mb-3">

                            <span class="badge bg-info p-2">

                                <i class="fas fa-user-check mr-1"></i>

                                Assigned

                            </span>

                            <p class="text-muted mt-2 mb-0">

                                Pengajuan telah diteruskan ke unit terkait.

                            </p>

                        </div>


                        <div class="col-md-4 mb-3">

                            <span class="badge bg-warning p-2">

                                <i class="fas fa-spinner mr-1"></i>

                                In Progress

                            </span>

                            <p class="text-muted mt-2 mb-0">

                                Pengajuan sedang diproses.

                            </p>

                        </div>


                        <div class="col-md-4 mb-3">

                            <span class="badge bg-danger p-2">

                                <i class="fas fa-exclamation-circle mr-1"></i>

                                Revision

                            </span>

                            <p class="text-muted mt-2 mb-0">

                                Pengajuan membutuhkan perbaikan.

                            </p>

                        </div>


                        <div class="col-md-4 mb-3">

                            <span class="badge bg-success p-2">

                                <i class="fas fa-check-circle mr-1"></i>

                                Completed

                            </span>

                            <p class="text-muted mt-2 mb-0">

                                Pengajuan telah selesai diproses.

                            </p>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>