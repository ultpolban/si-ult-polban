<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_mahasiswa'); ?>


<div class="content-wrapper">


    <!-- =========================================
         HEADER DASHBOARD
    ========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <h1 class="dashboard-title">

                        <i class="fas fa-home me-2"></i>

                        Dashboard Mahasiswa

                    </h1>

                </div>


                <div class="col-sm-6 text-sm-end mt-2 mt-sm-0">

                    <a
                        href="<?= base_url('mahasiswa/ticket/create') ?>"
                        class="btn btn-ult-orange"
                    >

                        <i class="fas fa-plus-circle me-1"></i>

                        Ajukan Layanan

                    </a>

                </div>

            </div>

        </div>

    </section>



    <!-- =========================================
         MAIN CONTENT
    ========================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- =========================================
                 WELCOME CARD
            ========================================== -->

            <div class="card welcome-card shadow-sm">

                <div class="card-body">

                    <div class="row align-items-center">


                        <!-- DATA MAHASISWA -->

                        <div class="col-md-8">

                            <h3 class="welcome-title">

                                Selamat Datang,

                                <?= esc(
                                    $user['nama']
                                    ?? 'Mahasiswa'
                                ); ?>

                               ! 👋

                            </h3>


                            <p class="welcome-text mb-3">

                                Selamat datang di Sistem Informasi
                                Unit Layanan Terpadu POLBAN.

                            </p>


                            <div class="student-info">


                                <!-- NIM -->

                                <div>

                                    <i class="fas fa-id-card"></i>

                                    <strong>
                                        NIM:
                                    </strong>

                                    <?= esc(
                                        $user['nim']
                                        ?? '-'
                                    ); ?>

                                </div>


                                <!-- PROGRAM STUDI -->

                                <div>

                                    <i class="fas fa-graduation-cap"></i>

                                    <strong>
                                        Program Studi:
                                    </strong>

                                    <?= esc(
                                        $user['prodi']
                                        ?? '-'
                                    ); ?>

                                </div>


                                <!-- JURUSAN -->

                                <div>

                                    <i class="fas fa-building"></i>

                                    <strong>
                                        Jurusan:
                                    </strong>

                                    <?= esc(
                                        $user['jurusan']
                                        ?? '-'
                                    ); ?>

                                </div>

                            </div>

                        </div>



                        <!-- AVATAR -->

                        <div
                            class="
                                col-md-4
                                text-center
                                mt-3
                                mt-md-0
                            "
                        >

                            <div class="student-avatar">

                                <i class="fas fa-user-graduate"></i>

                            </div>


                            <div class="mt-2">

                                <span class="status-active">

                                    <i class="fas fa-circle"></i>

                                    <?= esc(
                                        $user['status']
                                        ?? 'Aktif'
                                    ); ?>

                                </span>

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            <!-- =========================================
                 STATISTIK PENGAJUAN
            ========================================== -->

            <div class="row">


                <!-- ======================================
                     TOTAL PENGAJUAN
                ======================================= -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-blue">

                        <div class="stat-content">

                            <h2>

                                <?= esc(
                                    $statistik['total']
                                    ?? 0
                                ); ?>

                            </h2>

                            <p>

                                Jumlah Pengajuan

                            </p>

                        </div>


                        <div class="stat-icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                    </div>

                </div>



                <!-- ======================================
                     SEDANG DIPROSES
                ======================================= -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-orange">

                        <div class="stat-content">

                            <h2>

                                <?= esc(
                                    $statistik['diproses']
                                    ?? 0
                                ); ?>

                            </h2>

                            <p>

                                Sedang Diproses

                            </p>

                        </div>


                        <div class="stat-icon">

                            <i class="fas fa-spinner"></i>

                        </div>

                    </div>

                </div>



                <!-- ======================================
                     PERLU REVISI
                ======================================= -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-warning">

                        <div class="stat-content">

                            <h2>

                                <?= esc(
                                    $statistik['revisi']
                                    ?? 0
                                ); ?>

                            </h2>

                            <p>

                                Perlu Revisi

                            </p>

                        </div>


                        <div class="stat-icon">

                            <i class="fas fa-edit"></i>

                        </div>

                    </div>

                </div>



                <!-- ======================================
                     SELESAI
                ======================================= -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-success">

                        <div class="stat-content">

                            <h2>

                                <?= esc(
                                    $statistik['selesai']
                                    ?? 0
                                ); ?>

                            </h2>

                            <p>

                                Selesai

                            </p>

                        </div>


                        <div class="stat-icon">

                            <i class="fas fa-check-circle"></i>

                        </div>

                    </div>

                </div>


            </div>



            <!-- =========================================
                 QUICK ACTION
            ========================================== -->

            <div class="row mb-4">


                <!-- AJUKAN LAYANAN -->

                <div class="col-lg-4 col-md-4 mb-2">

                    <a
                        href="<?= base_url(
                            'mahasiswa/ticket/create'
                        ) ?>"
                        class="quick-action action-orange"
                    >

                        <i class="fas fa-plus-circle"></i>

                        <span>

                            Ajukan Layanan Baru

                        </span>

                    </a>

                </div>



                <!-- TRACKING -->

                <div class="col-lg-4 col-md-4 mb-2">

                    <a
                        href="<?= base_url(
                            'mahasiswa/ticket/history'
                        ) ?>"
                        class="quick-action action-blue"
                    >

                        <i class="fas fa-history"></i>

                        <span>

                            Tracking Tiket

                        </span>

                    </a>

                </div>



                <!-- NOTIFIKASI -->

                <div class="col-lg-4 col-md-4 mb-2">

                    <a
                        href="<?= base_url(
                            'mahasiswa/notification'
                        ) ?>"
                        class="quick-action action-blue"
                    >

                        <i class="fas fa-bell"></i>

                        <span>

                            Notifikasi

                        </span>

                    </a>

                </div>


            </div>



            <!-- =========================================
                 RIWAYAT PENGAJUAN LAYANAN
                 
                 DATA DIAMBIL DARI:
                 $riwayat

                 $riwayat hanya berisi tiket yang
                 statusnya Completed / Selesai.
            ========================================== -->

            <div class="card dashboard-card shadow-sm">


                <!-- HEADER RIWAYAT -->

                <div class="card-header dashboard-card-header">

                    <h3 class="card-title">

                        <i class="fas fa-history me-2"></i>

                        Riwayat Pengajuan Layanan

                    </h3>


                    <a
                        href="<?= base_url(
                            'mahasiswa/ticket/history'
                        ) ?>"
                        class="
                            btn
                            btn-sm
                            btn-ult-orange
                            float-end
                        "
                    >

                        Lihat Semua

                    </a>

                </div>



                <!-- BODY TABLE -->

                <div class="card-body table-responsive p-0">


                    <table
                        class="
                            table
                            table-hover
                            align-middle
                            mb-0
                        "
                    >


                        <!-- HEADER TABLE -->

                        <thead>

                            <tr>

                                <th>
                                    No
                                </th>

                                <th>
                                    Nomor Tiket
                                </th>

                                <th>
                                    Layanan
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

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>



                        <!-- ISI TABLE -->

                        <tbody>


                        <?php if (
                            !empty(
                                $riwayat
                                ?? []
                            )
                        ): ?>


                            <?php

                            $no = 1;

                            foreach (
                                $riwayat
                                as $t
                            ):

                            ?>


                                <tr>


                                    <!-- NO -->

                                    <td>

                                        <?= $no++; ?>

                                    </td>



                                    <!-- NOMOR TIKET -->

                                    <td>

                                        <strong>

                                            <?= esc(
                                                $t['nomor']
                                                ?? '-'
                                            ); ?>

                                        </strong>

                                    </td>



                                    <!-- LAYANAN -->

                                    <td>

                                        <?= esc(
                                            $t['layanan']
                                            ?? '-'
                                        ); ?>

                                    </td>



                                    <!-- UNIT LAYANAN -->

                                    <td>

                                        <?= esc(
                                            $t['unit_layanan']
                                            ?? $t['unit']
                                            ?? '-'
                                        ); ?>

                                    </td>



                                    <!-- TANGGAL -->

                                    <td>

                                        <?php

                                        if (
                                            !empty(
                                                $t['created_at']
                                            )
                                        ) {

                                            echo esc(
                                                date(
                                                    'd-m-Y',
                                                    strtotime(
                                                        $t['created_at']
                                                    )
                                                )
                                            );

                                        } elseif (
                                            !empty(
                                                $t['tanggal']
                                            )
                                        ) {

                                            echo esc(
                                                $t['tanggal']
                                            );

                                        } else {

                                            echo '-';

                                        }

                                        ?>

                                    </td>



                                    <!-- STATUS -->

                                    <td>

                                        <span
                                            class="
                                                ticket-status
                                                status-completed
                                            "
                                        >

                                            <i
                                                class="
                                                    fas
                                                    fa-check
                                                "
                                            ></i>

                                            Selesai

                                        </span>

                                    </td>



                                    <!-- AKSI -->

                                    <td>

                                        <a
                                            href="<?= base_url(
                                                'mahasiswa/ticket/detail/' .
                                                (
                                                    $t['id']
                                                    ?? ''
                                                )
                                            ) ?>"
                                            class="btn btn-detail"
                                        >

                                            <i
                                                class="
                                                    fas
                                                    fa-eye
                                                "
                                            ></i>

                                            Detail

                                        </a>

                                    </td>


                                </tr>


                            <?php endforeach; ?>


                        <?php else: ?>


                            <!-- =====================================
                                 BELUM ADA RIWAYAT
                            ====================================== -->

                            <tr>

                                <td
                                    colspan="7"
                                    class="
                                        text-center
                                        py-5
                                        text-muted
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-history
                                            fa-3x
                                            mb-3
                                        "
                                    ></i>


                                    <div>

                                        <strong>

                                            Belum Ada Riwayat Pengajuan

                                        </strong>

                                    </div>


                                    <small>

                                        Pengajuan yang sudah selesai
                                        akan otomatis muncul di sini.

                                    </small>

                                </td>

                            </tr>


                        <?php endif; ?>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer'); ?>