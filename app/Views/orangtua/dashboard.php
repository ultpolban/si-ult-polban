<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_orangtua'); ?>

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

                        Dashboard Orang Tua

                    </h1>

                </div>

                <div class="col-sm-6 text-sm-end mt-2 mt-sm-0">

                    <a
                        href="<?= base_url('orangtua/ticket/create') ?>"
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

                        <!-- DATA ORANG TUA -->

                        <div class="col-md-8">

                            <h3 class="welcome-title">

                                Selamat Datang,

                                <strong>Bapak Ahmad Wijaya</strong>

                                👋

                            </h3>

                            <p class="welcome-text mb-3">

                                Selamat datang di Sistem Informasi
                                Unit Layanan Terpadu POLBAN.

                            </p>

                            <div class="student-info">

                                <div>

                                    <i class="fas fa-id-card"></i>

                                    <strong>NIK :</strong>

                                    3273010101010001

                                </div>

                                <div>

                                    <i class="fas fa-user"></i>

                                    <strong>Nama Mahasiswa :</strong>

                                    Muhammad Rafi Putra Zakaria

                                </div>

                                <div>

                                    <i class="fas fa-graduation-cap"></i>

                                    <strong>NIM :</strong>

                                    241511001

                                </div>

                                <div>

                                    <i class="fas fa-building"></i>

                                    <strong>Program Studi :</strong>

                                    D4 Teknik Informatika

                                </div>

                            </div>

                        </div>



                        <!-- AVATAR -->

                        <div class="col-md-4 text-center mt-3 mt-md-0">

                            <div class="student-avatar">

                                <i class="fas fa-users"></i>

                            </div>

                            <div class="mt-2">

                                <span class="status-active">

                                    <i class="fas fa-circle"></i>

                                    Orang Tua Aktif

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


                <!-- TOTAL -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-blue">

                        <div class="stat-content">

                            <h2>0</h2>

                            <p>

                                Jumlah Pengajuan

                            </p>

                        </div>

                        <div class="stat-icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                    </div>

                </div>



                <!-- DIPROSES -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-orange">

                        <div class="stat-content">

                            <h2>0</h2>

                            <p>

                                Sedang Diproses

                            </p>

                        </div>

                        <div class="stat-icon">

                            <i class="fas fa-spinner"></i>

                        </div>

                    </div>

                </div>



                <!-- REVISI -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-warning">

                        <div class="stat-content">

                            <h2>0</h2>

                            <p>

                                Perlu Revisi

                            </p>

                        </div>

                        <div class="stat-icon">

                            <i class="fas fa-edit"></i>

                        </div>

                    </div>

                </div>



                <!-- SELESAI -->

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-success">

                        <div class="stat-content">

                            <h2>0</h2>

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


                <!-- AJUKAN -->

                <div class="col-lg-4 col-md-4 mb-2">

                    <a
                        href="<?= base_url('orangtua/ticket/create') ?>"
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
                        href="<?= base_url('orangtua/ticket/history') ?>"
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
                        href="<?= base_url('orangtua/notification') ?>"
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
                 RIWAYAT PENGAJUAN
            ========================================== -->

            <div class="card shadow-sm">

                <div
                    class="card-header d-flex justify-content-between align-items-center"
                    style="
                        background:#0b3d91;
                        color:white;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h3 class="card-title mb-0">

                        <i class="fas fa-history me-2"></i>

                        Riwayat Pengajuan

                    </h3>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover table-striped mb-0">

                            <thead
                                style="
                                    background:#f8f9fa;
                                "
                            >

                                <tr>

                                    <th width="8%">
                                        No
                                    </th>

                                    <th>
                                        Nomor Tiket
                                    </th>

                                    <th>
                                        Layanan
                                    </th>

                                    <th>
                                        Unit
                                    </th>

                                    <th>
                                        Tanggal
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th width="10%">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <i
                                            class="fas fa-inbox"
                                            style="
                                                font-size:50px;
                                                color:#ced4da;
                                            "
                                        ></i>

                                        <h5
                                            class="mt-3"
                                            style="
                                                color:#6c757d;
                                            "
                                        >

                                            Belum Ada Riwayat Pengajuan

                                        </h5>

                                        <p
                                            class="text-muted mb-4"
                                        >

                                            Silakan ajukan layanan terlebih dahulu.

                                        </p>

                                        <a
                                            href="<?= base_url('orangtua/ticket/create') ?>"
                                            class="btn btn-warning"
                                        >

                                            <i class="fas fa-plus-circle"></i>

                                            Ajukan Layanan

                                        </a>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer'); ?>