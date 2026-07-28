<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>


<div class="content-wrapper">

    <!-- HEADER -->
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

                        <i class="fas fa-bell"></i>

                        Notifikasi

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('tendik/dashboard') ?>">

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


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">


            <!-- FLASH SUCCESS -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div
                    class="alert alert-success alert-dismissible fade show"
                >

                    <i class="fas fa-check-circle mr-2"></i>

                    <?= esc(
                        session()->getFlashdata('success')
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


            <!-- CARD -->

            <div class="card shadow-sm border-0">


                <!-- HEADER CARD -->

                <div
                    class="card-header text-white"
                    style="
                        background:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-bell mr-2"></i>

                        Notifikasi Anda

                    </h5>

                </div>


                <!-- BODY -->

                <div class="card-body">


                    <?php if (!empty($notifications)) : ?>


                        <?php foreach (
                            $notifications
                            as $notification
                        ) : ?>


                            <div
                                class="
                                    d-flex
                                    align-items-start
                                    p-3
                                    mb-3
                                    rounded
                                "
                                style="
                                    background:#f5f7fa;
                                    border-left:5px solid #0b3d91;
                                "
                            >


                                <!-- ICON -->

                                <div class="mr-3">

                                    <div
                                        style="
                                            width:45px;
                                            height:45px;
                                            border-radius:50%;
                                            background:#e8f1fb;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-bell
                                            "
                                            style="
                                                color:#0b3d91;
                                            "
                                        ></i>

                                    </div>

                                </div>


                                <!-- CONTENT -->

                                <div class="flex-grow-1">

                                    <h6
                                        class="mb-1"
                                        style="
                                            color:#0b3d91;
                                            font-weight:700;
                                        "
                                    >

                                        <?= esc(
                                            $notification['judul']
                                            ??
                                            'Notifikasi'
                                        ) ?>

                                    </h6>


                                    <p
                                        class="mb-1 text-muted"
                                    >

                                        <?= esc(
                                            $notification['pesan']
                                            ??
                                            '-'
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
                                            ??
                                            '-'
                                        ) ?>

                                    </small>

                                </div>


                            </div>


                        <?php endforeach; ?>


                    <?php else : ?>


                        <!-- EMPTY -->

                        <div
                            class="
                                text-center
                                py-5
                            "
                        >

                            <i
                                class="
                                    far
                                    fa-bell-slash
                                    fa-4x
                                    mb-3
                                "
                                style="
                                    color:#b0bec5;
                                "
                            ></i>


                            <h5
                                style="
                                    color:#17365d;
                                    font-weight:700;
                                "
                            >

                                Belum Ada Notifikasi

                            </h5>


                            <p class="text-muted">

                                Belum ada notifikasi untuk Anda.

                            </p>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>