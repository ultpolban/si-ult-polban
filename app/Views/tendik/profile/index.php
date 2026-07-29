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
                        <i class="fas fa-user-circle mr-2"></i>
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

            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('success')) ?>

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

                <!-- FOTO PROFIL -->
                <div class="col-md-4">

                    <div class="card card-primary card-outline shadow-sm">

                        <div class="card-body box-profile text-center">

                            <div class="mb-3">

                                <i
                                    class="fas fa-user-circle"
                                    style="
                                        font-size:110px;
                                        color:#0b3d91;
                                    "
                                ></i>

                            </div>

                            <h3 class="profile-username text-center">

                                <?= esc(
                                    $user['nama']
                                    ?? 'Nama Tendik'
                                ) ?>

                            </h3>

                            <p class="text-muted text-center">

                                Tenaga Kependidikan

                            </p>

                            <a
                                href="<?= base_url('tendik/profile/edit') ?>"
                                class="btn btn-primary btn-block"
                            >

                                <i class="fas fa-edit mr-1"></i>

                                Edit Profil

                            </a>

                        </div>

                    </div>

                </div>


                <!-- INFORMASI PROFIL -->
                <div class="col-md-8">

                    <div class="card shadow-sm">

                        <div
                            class="card-header text-white"
                            style="
                                background:#0b3d91;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-user mr-2"></i>

                                Informasi Profil

                            </h5>

                        </div>


                        <div class="card-body">

                            <div class="row mb-3">

                                <div class="col-md-4 font-weight-bold">
                                    Nama Lengkap
                                </div>

                                <div class="col-md-8">
                                    <?= esc(
                                        $user['nama']
                                        ?? '-'
                                    ) ?>
                                </div>

                            </div>


                            <hr>


                            <div class="row mb-3">

                                <div class="col-md-4 font-weight-bold">
                                    NIP
                                </div>

                                <div class="col-md-8">
                                    <?= esc(
                                        $user['nip']
                                        ?? '-'
                                    ) ?>
                                </div>

                            </div>


                            <hr>


                            <div class="row mb-3">

                                <div class="col-md-4 font-weight-bold">
                                    Email
                                </div>

                                <div class="col-md-8">
                                    <?= esc(
                                        $user['email']
                                        ?? '-'
                                    ) ?>
                                </div>

                            </div>


                            <hr>


                            <div class="row mb-3">

                                <div class="col-md-4 font-weight-bold">
                                    Jabatan
                                </div>

                                <div class="col-md-8">
                                    <?= esc(
                                        $user['jabatan']
                                        ?? 'Tenaga Kependidikan'
                                    ) ?>
                                </div>

                            </div>


                            <hr>


                            <div class="row mb-3">

                                <div class="col-md-4 font-weight-bold">
                                    Unit / Bagian
                                </div>

                                <div class="col-md-8">
                                    <?= esc(
                                        $user['unit']
                                        ?? '-'
                                    ) ?>
                                </div>

                            </div>


                            <hr>


                            <div class="row">

                                <div class="col-md-4 font-weight-bold">
                                    Nomor Telepon
                                </div>

                                <div class="col-md-8">
                                    <?= esc(
                                        $user['no_hp']
                                        ?? '-'
                                    ) ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>