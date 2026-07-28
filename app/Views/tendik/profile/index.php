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

                        <i class="fas fa-user"></i>

                        Profil Tendik

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

                            Profil

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">


            <!-- SUCCESS -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show">

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


            <!-- ERROR -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc(
                        session()->getFlashdata('error')
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


            <div class="row">


                <!-- =====================================
                     KARTU PROFIL
                ====================================== -->

                <div class="col-lg-4">

                    <div
                        class="
                            card
                            shadow-sm
                            border-0
                            text-center
                        "
                    >

                        <div
                            class="card-header text-white"
                            style="
                                background:#0b3d91;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-user-circle mr-2"></i>

                                Profil Saya

                            </h5>

                        </div>


                        <div class="card-body">


                            <!-- FOTO / AVATAR -->

                            <div class="mb-3">

                                <div
                                    style="
                                        width:120px;
                                        height:120px;
                                        border-radius:50%;
                                        background:#e8f1fb;
                                        margin:auto;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >

                                    <i
                                        class="fas fa-user"
                                        style="
                                            font-size:60px;
                                            color:#0b3d91;
                                        "
                                    ></i>

                                </div>

                            </div>


                            <!-- NAMA -->

                            <h4
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                <?= esc(
                                    $user['nama']
                                    ??
                                    'Nama Tendik'
                                ) ?>

                            </h4>


                            <p class="text-muted">

                                Tenaga Kependidikan

                            </p>


                        </div>

                    </div>

                </div>



                <!-- =====================================
                     INFORMASI PROFIL
                ====================================== -->

                <div class="col-lg-8">

                    <div class="card shadow-sm border-0">


                        <div
                            class="card-header text-white"
                            style="
                                background:#0b3d91;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-id-card mr-2"></i>

                                Informasi Data Tendik

                            </h5>

                        </div>


                        <div class="card-body">


                            <!-- NAMA -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Nama Lengkap

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $user['nama']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>


                            <hr>


                            <!-- NIP -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        NIP

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $user['nip']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>


                            <hr>


                            <!-- EMAIL -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Email

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $user['email']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>


                            <hr>


                            <!-- UNIT KERJA -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Unit Kerja

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $user['unit_kerja']
                                        ??
                                        $user['unit_tujuan']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>


                            <hr>


                            <!-- JABATAN -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Jabatan

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $user['jabatan']
                                        ??
                                        'Tenaga Kependidikan'
                                    ) ?>

                                </div>

                            </div>


                            <hr>


                            <!-- NOMOR HP -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Nomor HP

                                    </strong>

                                </div>

                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $user['no_hp']
                                        ??
                                        $user['telepon']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>


                        </div>

                    </div>



                    <!-- BUTTON -->

                    <div class="card shadow-sm border-0 mt-4">

                        <div class="card-body">

                            <div
                                class="
                                    d-flex
                                    justify-content-between
                                "
                            >


                                <!-- KEMBALI -->

                                <a
                                    href="<?= base_url(
                                        'tendik/dashboard'
                                    ) ?>"
                                    class="btn btn-secondary"
                                >

                                    <i class="fas fa-arrow-left mr-1"></i>

                                    Kembali ke Dashboard

                                </a>


                                <!-- EDIT -->

                                <a
                                    href="<?= base_url(
                                        'tendik/profile/edit'
                                    ) ?>"
                                    class="btn text-white"
                                    style="
                                        background:#f28c28;
                                    "
                                >

                                    <i class="fas fa-edit mr-1"></i>

                                    Edit Profil

                                </a>


                            </div>

                        </div>

                    </div>


                </div>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>