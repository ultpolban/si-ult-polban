<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>


<div class="content-wrapper">

    <!-- ==========================================
         HEADER
    =========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-bell mr-2"></i>

                        Notifikasi

                    </h1>

                    <p class="text-muted">

                        Lihat informasi terbaru mengenai
                        pengajuan layanan Anda.

                    </p>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url(
                                    'tendik/dashboard'
                                ) ?>"
                            >

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Notifikasi

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <!-- ==========================================
         CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- SUCCESS -->
            <?php if (
                session()->getFlashdata('success')
            ) : ?>

                <div
                    class="
                        alert
                        alert-success
                        alert-dismissible
                        fade
                        show
                    "
                >

                    <i
                        class="
                            fas
                            fa-check-circle
                            mr-2
                        "
                    ></i>

                    <?= esc(
                        session()->getFlashdata(
                            'success'
                        )
                    ) ?>


                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- ==========================================
                 STATISTIK NOTIFIKASI
            =========================================== -->

            <div class="row">


                <!-- TOTAL -->
                <div class="col-md-4">

                    <div
                        class="card shadow-sm"
                        style="
                            border-radius:12px;
                        "
                    >

                        <div
                            class="card-body
                                   d-flex
                                   align-items-center"
                        >

                            <div
                                style="
                                    width:58px;
                                    height:58px;
                                    background:#0b3d91;
                                    color:white;
                                    border-radius:12px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:25px;
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
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >

                                    <?= $totalNotifikasi ?>

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- BELUM DIBACA -->
                <div class="col-md-4">

                    <div
                        class="card shadow-sm"
                        style="
                            border-radius:12px;
                        "
                    >

                        <div
                            class="card-body
                                   d-flex
                                   align-items-center"
                        >

                            <div
                                style="
                                    width:58px;
                                    height:58px;
                                    background:#f28c28;
                                    color:white;
                                    border-radius:12px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:25px;
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
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >

                                    <?= $belumDibaca ?>

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- STATUS -->
                <div class="col-md-4">

                    <div
                        class="card shadow-sm"
                        style="
                            border-radius:12px;
                        "
                    >

                        <div
                            class="card-body
                                   d-flex
                                   align-items-center"
                        >

                            <div
                                style="
                                    width:58px;
                                    height:58px;
                                    background:#198754;
                                    color:white;
                                    border-radius:12px;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    font-size:25px;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-check-circle
                                    "
                                ></i>

                            </div>


                            <div class="ml-3">

                                <div class="text-muted">

                                    Status

                                </div>

                                <h3
                                    class="mb-0"
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >

                                    Aktif

                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ==========================================
                 DAFTAR NOTIFIKASI
            =========================================== -->

            <div class="card shadow-sm">

                <div
                    class="card-header text-white d-flex
                           justify-content-between
                           align-items-center"
                    style="
                        background:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i
                            class="
                                fas
                                fa-list
                                mr-2
                            "
                        ></i>

                        Daftar Notifikasi

                    </h5>


                    <a
                        href="<?= base_url(
                            'tendik/notification/read-all'
                        ) ?>"
                        class="btn btn-sm text-white"
                        style="
                            background:#f28c28;
                        "
                    >

                        <i
                            class="
                                fas
                                fa-check-double
                                mr-1
                            "
                        ></i>

                        Tandai Semua Dibaca

                    </a>

                </div>


                <div class="card-body p-0">


                    <?php if (
                        !empty($notifications)
                    ) : ?>


                        <?php foreach (
                            $notifications
                            as $notification
                        ) : ?>


                            <div
                                class="
                                    notification-item
                                    p-4
                                    border-bottom
                                    <?= (
                                        ($notification['status']
                                            ?? 'read')
                                        === 'unread'
                                    )
                                        ? 'unread'
                                        : ''
                                    ?>
                                "
                                style="
                                    border-left:
                                        4px solid
                                        <?= (
                                            ($notification['status']
                                                ?? 'read')
                                            === 'unread'
                                        )
                                            ? '#f28c28'
                                            : 'transparent'
                                        ?>;
                                    background:
                                        <?= (
                                            ($notification['status']
                                                ?? 'read')
                                            === 'unread'
                                        )
                                            ? '#fff8ef'
                                            : '#ffffff'
                                        ?>;
                                "
                            >


                                <div
                                    class="
                                        d-flex
                                        align-items-start
                                    "
                                >


                                    <!-- ICON -->

                                    <div
                                        style="
                                            width:52px;
                                            height:52px;
                                            min-width:52px;
                                            background:#0b3d91;
                                            color:white;
                                            border-radius:50%;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            font-size:20px;
                                        "
                                    >

                                        <i
                                            class="<?= esc(
                                                $notification['icon']
                                                ?? 'fas fa-bell'
                                            ) ?>"
                                        ></i>

                                    </div>


                                    <!-- CONTENT -->

                                    <div class="ml-3 flex-grow-1">

                                        <div
                                            class="
                                                d-flex
                                                justify-content-between
                                                align-items-start
                                            "
                                        >

                                            <h5
                                                class="mb-1"
                                                style="
                                                    color:#0b3d91;
                                                    font-weight:700;
                                                "
                                            >

                                                <?= esc(
                                                    $notification['judul']
                                                    ?? 'Notifikasi'
                                                ) ?>

                                            </h5>


                                            <?php if (
                                                ($notification['status']
                                                    ?? 'read')
                                                === 'unread'
                                            ) : ?>

                                                <span
                                                    class="
                                                        badge
                                                        text-white
                                                    "
                                                    style="
                                                        background:#f28c28;
                                                    "
                                                >

                                                    Baru

                                                </span>

                                            <?php endif; ?>

                                        </div>


                                        <p
                                            class="
                                                mb-2
                                                text-muted
                                            "
                                        >

                                            <?= esc(
                                                $notification['pesan']
                                                ?? ''
                                            ) ?>

                                        </p>


                                        <small
                                            class="text-muted"
                                        >

                                            <i
                                                class="
                                                    far
                                                    fa-clock
                                                    mr-1
                                                "
                                            ></i>

                                            <?= esc(
                                                $notification['tanggal']
                                                ?? '-'
                                            ) ?>

                                        </small>

                                    </div>

                                </div>

                            </div>


                        <?php endforeach; ?>


                    <?php else : ?>


                        <!-- TIDAK ADA NOTIFIKASI -->

                        <div
                            class="
                                text-center
                                py-5
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-bell-slash
                                "
                                style="
                                    font-size:60px;
                                    color:#b0bec5;
                                "
                            ></i>


                            <h5
                                class="mt-3"
                                style="
                                    color:#0b3d91;
                                "
                            >

                                Belum Ada Notifikasi

                            </h5>


                            <p class="text-muted">

                                Saat ada informasi terbaru,
                                notifikasi akan muncul di sini.

                            </p>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>