<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_dosen') ?>


<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-8">

                    <h1 style="color:#0b3d91;font-weight:700;">

                        <i class="fas fa-bell"></i>

                        Notifikasi

                    </h1>

                    <p class="text-muted mb-0">

                        Lihat informasi terbaru mengenai pengajuan layanan Anda.

                    </p>

                </div>


                <div class="col-sm-4 text-right">

                    <a
                        href="<?= base_url('dosen/dashboard') ?>"
                        class="btn btn-outline-primary"
                    >

                        <i class="fas fa-home"></i>

                        Dashboard

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">


            <!-- STATISTIK -->

            <div class="row">


                <!-- TOTAL NOTIFIKASI -->

                <div class="col-lg-4 col-md-4 col-sm-12 mb-3">

                    <div class="card shadow-sm border-0">

                        <div class="card-body d-flex align-items-center">

                            <div
                                style="
                                    width:56px;
                                    height:56px;
                                    background:#293b8f;
                                    border-radius:12px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    color:white;
                                    font-size:24px;
                                "
                            >

                                <i class="fas fa-bell"></i>

                            </div>


                            <div class="ml-3">

                                <div class="text-muted">

                                    Total Notifikasi

                                </div>

                                <h3
                                    class="mb-0"
                                    style="color:#0b3d91;font-weight:700;"
                                >

                                    <?= $totalNotifikasi ?>

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- BELUM DIBACA -->

                <div class="col-lg-4 col-md-4 col-sm-12 mb-3">

                    <div class="card shadow-sm border-0">

                        <div class="card-body d-flex align-items-center">

                            <div
                                style="
                                    width:56px;
                                    height:56px;
                                    background:#ff8500;
                                    border-radius:12px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    color:white;
                                    font-size:24px;
                                "
                            >

                                <i class="fas fa-envelope"></i>

                            </div>


                            <div class="ml-3">

                                <div class="text-muted">

                                    Belum Dibaca

                                </div>

                                <h3
                                    class="mb-0"
                                    style="color:#0b3d91;font-weight:700;"
                                >

                                    <?= $belumDibaca ?>

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- STATUS -->

                <div class="col-lg-4 col-md-4 col-sm-12 mb-3">

                    <div class="card shadow-sm border-0">

                        <div class="card-body d-flex align-items-center">

                            <div
                                style="
                                    width:56px;
                                    height:56px;
                                    background:#198754;
                                    border-radius:12px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    color:white;
                                    font-size:24px;
                                "
                            >

                                <i class="fas fa-check-circle"></i>

                            </div>


                            <div class="ml-3">

                                <div class="text-muted">

                                    Status

                                </div>

                                <h3
                                    class="mb-0"
                                    style="color:#0b3d91;font-weight:700;"
                                >

                                    Aktif

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- DAFTAR NOTIFIKASI -->

            <div class="card shadow-sm border-0">

                <div
                    class="card-header"
                    style="
                        background:#293b8f;
                        color:white;
                        border-bottom:4px solid #ff8500;
                    "
                >

                    <h3 class="card-title mb-0">

                        <i class="fas fa-list"></i>

                        Daftar Notifikasi

                    </h3>

                </div>


                <div class="card-body p-0">


                    <?php if (!empty($notifications)): ?>

                        <?php foreach ($notifications as $notification): ?>

                            <div
                                class="notification-item"
                                style="
                                    padding:22px;
                                    border-bottom:1px solid #eee;
                                    border-left:
                                    <?= $notification['status'] === 'baru'
                                        ? '4px solid #ff8500'
                                        : '4px solid transparent'
                                    ?>;
                                    background:
                                    <?= $notification['status'] === 'baru'
                                        ? '#fffaf3'
                                        : '#ffffff'
                                    ?>;
                                "
                            >

                                <div class="d-flex align-items-start">


                                    <!-- ICON -->

                                    <div
                                        style="
                                            min-width:52px;
                                            width:52px;
                                            height:52px;
                                            background:#293b8f;
                                            border-radius:50%;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            color:white;
                                            font-size:20px;
                                        "
                                    >

                                        <i
                                            class="fas <?= esc($notification['icon']) ?>"
                                        ></i>

                                    </div>


                                    <!-- ISI -->

                                    <div class="ml-3 flex-grow-1">

                                        <div
                                            class="d-flex justify-content-between align-items-start"
                                        >

                                            <h5
                                                class="mb-1"
                                                style="
                                                    color:#0b3d91;
                                                    font-weight:700;
                                                "
                                            >

                                                <?= esc($notification['judul']) ?>

                                            </h5>


                                            <?php if ($notification['status'] === 'baru'): ?>

                                                <span
                                                    class="badge"
                                                    style="
                                                        background:#ff8500;
                                                        color:white;
                                                        padding:8px 12px;
                                                    "
                                                >

                                                    Baru

                                                </span>

                                            <?php endif; ?>

                                        </div>


                                        <p class="text-muted mb-2">

                                            <?= esc($notification['pesan']) ?>

                                        </p>


                                        <small class="text-muted">

                                            <i class="far fa-clock"></i>

                                            <?= esc($notification['tanggal']) ?>,

                                            <?= esc($notification['waktu']) ?>

                                        </small>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>


                        <!-- KALAU TIDAK ADA NOTIFIKASI -->

                        <div class="text-center py-5">

                            <i
                                class="fas fa-bell-slash fa-3x text-muted mb-3"
                            ></i>

                            <h5 class="text-muted">

                                Belum ada notifikasi

                            </h5>

                            <p class="text-muted">

                                Notifikasi pengajuan layanan akan muncul di sini.

                            </p>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>