<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_dosen') ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 style="font-weight:700;color:#0b3d91;">

                    <i class="fas fa-user-tie"></i>

                    Profil Dosen

                </h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">

                        <a href="<?= base_url('dosen/dashboard') ?>">

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


<section class="content">

<div class="container-fluid">

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success">

        <i class="fas fa-check-circle"></i>

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>


<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger">

        <i class="fas fa-exclamation-circle"></i>

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>


<div class="card shadow-sm">

    <div
        class="card-header d-flex justify-content-between align-items-center"
        style="background:#1b4f9c;color:white;"
    >

        <h3 class="card-title mb-0">

            <i class="fas fa-id-card"></i>

            Informasi Profil Dosen

        </h3>


        <a
            href="<?= base_url('dosen/profile/edit') ?>"
            class="btn"
            style="background:#ff9800;color:white;font-weight:600;"
        >

            <i class="fas fa-edit"></i>

            Edit Profil

        </a>

    </div>


    <div class="card-body">

        <div class="row">

            <!-- =========================================
                 FOTO
            ========================================== -->

            <div class="col-lg-4 text-center">

                <?php if (! empty($profile['foto'])) : ?>

                    <img
                        src="<?= base_url('uploads/profile/' . $profile['foto']) ?>"
                        class="img-circle elevation-4"
                        style="
                            width:190px;
                            height:190px;
                            object-fit:cover;
                            border:5px solid #1b4f9c;
                            box-shadow:0 8px 20px rgba(0,0,0,.2);
                        "
                    >

                <?php else : ?>

                    <img
                        src="<?= base_url('assets/img/default-user.png') ?>"
                        class="img-circle elevation-4"
                        style="
                            width:190px;
                            height:190px;
                            object-fit:cover;
                            border:5px solid #1b4f9c;
                            box-shadow:0 8px 20px rgba(0,0,0,.2);
                        "
                    >

                <?php endif; ?>


                <h2
                    class="mt-4 font-weight-bold"
                    style="color:#1b4f9c;"
                >

                    <?= esc($profile['nama']) ?>

                </h2>


                <h5 class="text-muted">

                    <i class="fas fa-id-card"></i>

                    NIP:
                    <?= esc($profile['nip']) ?>

                </h5>


                <h6 class="text-muted">

                    <i class="fas fa-graduation-cap"></i>

                    NIDN:
                    <?= esc($profile['nidn'] ?: '-') ?>

                </h6>


                <?php if ($profile['status'] === 'Aktif') : ?>

                    <span
                        class="badge badge-success px-4 py-2 mt-2"
                        style="font-size:17px;"
                    >

                        Aktif

                    </span>

                <?php else : ?>

                    <span
                        class="badge badge-danger px-4 py-2 mt-2"
                        style="font-size:17px;"
                    >

                        Tidak Aktif

                    </span>

                <?php endif; ?>

            </div>


            <!-- =========================================
                 DATA PRIBADI
            ========================================== -->

            <div class="col-lg-8">

                <h2
                    class="mb-4"
                    style="color:#1b4f9c;font-weight:bold;"
                >

                    <i class="fas fa-info-circle"></i>

                    Data Pribadi

                </h2>


                <table class="table table-borderless">

                    <tr>

                        <th width="45%">

                            <i
                                class="fas fa-user mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            Nama Lengkap

                        </th>

                        <td>

                            <?= esc($profile['nama']) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>

                            <i
                                class="fas fa-id-card mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            NIK

                        </th>

                        <td>
    <?= !empty($profile['nik'])
        ? esc($profile['nik'])
        : '<span class="text-muted">Belum diisi</span>' ?>
</td>

                    </tr>


                    <tr>

                        <th>

                            <i
                                class="fas fa-id-badge mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            NIP

                        </th>

                        <td>

                            <?= esc($profile['nip']) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>

                            <i
                                class="fas fa-graduation-cap mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            NIDN

                        </th>

                       <td>
    <?= !empty($profile['nidn'])
        ? esc($profile['nidn'])
        : '<span class="text-muted">Belum diisi</span>' ?>
</td>

                    </tr>


                    <tr>

                        <th>

                            <i
                                class="fas fa-envelope mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            Email

                        </th>

                        <td>

                            <?= esc($profile['email']) ?>

                        </td>

                    </tr>


                    <tr>

                        <th>

                            <i
                                class="fas fa-phone mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            Nomor HP

                        </th>

                        <td>

                            <?= esc($profile['no_hp'] ?: '-') ?>

                        </td>

                    </tr>


                    <tr>

                        <th>

                            <i
                                class="fas fa-venus-mars mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            Jenis Kelamin

                        </th>

                        <td>

                            <?= esc($profile['jenis_kelamin'] ?: '-') ?>

                        </td>

                    </tr>


                    <tr>

                        <th>

                            <i
                                class="fas fa-map-marker-alt mr-2"
                                style="color:#1b4f9c"
                            ></i>

                            Alamat

                        </th>

                        <td>

                            <?= esc($profile['alamat'] ?: '-') ?>

                        </td>

                    </tr>

                </table>

            </div>

        </div>


        <hr>


        <!-- =========================================
             AKADEMIK
        ========================================== -->

        <h2
            class="mb-4"
            style="color:#1b4f9c;font-weight:bold;"
        >

            <i class="fas fa-university"></i>

            Informasi Akademik

        </h2>


        <div class="row">

            <div class="col-md-6">

                <div
                    class="small-box bg-light border-left border-primary"
                >

                    <div class="inner">

                        <small class="text-muted">

                            Program Studi

                        </small>

                        <h4>

                            <?= esc($profile['prodi']) ?>

                        </h4>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div
                    class="small-box bg-light border-left border-primary"
                >

                    <div class="inner">

                        <small class="text-muted">

                            Jurusan

                        </small>

                        <h4>

                            <?= esc($profile['jurusan']) ?>

                        </h4>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div
                    class="small-box bg-light border-left border-primary"
                >

                    <div class="inner">

                        <small class="text-muted">

                            Fakultas

                        </small>

                        <h4>

                            <?= esc($profile['fakultas']) ?>

                        </h4>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div
                    class="small-box bg-light border-left border-warning"
                >

                    <div class="inner">

                        <small class="text-muted">

                            Jabatan

                        </small>

                        <h4>

                            <?= esc($profile['jabatan']) ?>

                        </h4>

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