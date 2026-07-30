<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>

<div class="content-wrapper">

    <!-- ========================================= -->
    <!-- HEADER -->
    <!-- ========================================= -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 style="font-weight:700;color:#0b3d91;">

                        <i class="fas fa-user-circle mr-2"></i>

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


    <!-- ========================================= -->
    <!-- CONTENT -->
    <!-- ========================================= -->

    <section class="content">

        <div class="container-fluid">

            <?php if(session()->getFlashdata('success')): ?>

                <div class="alert alert-success">

                    <?= session()->getFlashdata('success') ?>

                </div>

            <?php endif; ?>


            <div class="row">

                <!-- FOTO -->

                <div class="col-md-4">

                    <div class="card shadow-sm">

                        <div class="card-body text-center">

                            <?php if(!empty($profile['foto'])): ?>

                                <img
                                    src="<?= base_url('uploads/profile/'.$profile['foto']) ?>"
                                    class="img-circle elevation-2"
                                    style="
                                        width:180px;
                                        height:180px;
                                        object-fit:cover;
                                    "
                                >

                            <?php else: ?>

                                <img
                                    src="<?= base_url('assets/img/default-user.png') ?>"
                                    class="img-circle elevation-2"
                                    style="
                                        width:180px;
                                        height:180px;
                                        object-fit:cover;
                                    "
                                >

                            <?php endif; ?>


                            <h3
                                class="mt-3"
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                <?= esc($profile['nama']) ?>

                            </h3>

                            <span class="badge badge-success">

                                <?= esc($profile['status']) ?>

                            </span>

                            <hr>

                            <a
                                href="<?= base_url('dosen/profile/edit') ?>"
                                class="btn btn-warning btn-block"
                            >

                                <i class="fas fa-edit mr-1"></i>

                                Edit Profil

                            </a>

                        </div>

                    </div>

                </div>



                <!-- DATA -->

                <div class="col-md-8">

                    <!-- DATA PRIBADI -->

                    <div class="card shadow-sm">

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                            "
                        >

                            <strong>

                                Data Pribadi

                            </strong>

                        </div>

                        <div class="card-body">

                            <table class="table table-borderless">

                                <tr>

                                    <th width="180">

                                        Nama

                                    </th>

                                    <td>

                                        <?= esc($profile['nama']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        NIP

                                    </th>

                                    <td>

                                        <?= esc($profile['nip']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        NIDN

                                    </th>

                                    <td>

                                        <?= esc($profile['nidn']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        NIK

                                    </th>

                                    <td>

                                        <?= esc($profile['nik']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Email

                                    </th>

                                    <td>

                                        <?= esc($profile['email']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        No HP

                                    </th>

                                    <td>

                                        <?= esc($profile['no_hp']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Jenis Kelamin

                                    </th>

                                    <td>

                                        <?= esc($profile['jenis_kelamin']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Alamat

                                    </th>

                                    <td>

                                        <?= esc($profile['alamat']) ?>

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>



                    <!-- AKADEMIK -->

                    <div class="card shadow-sm mt-3">

                        <div
                            class="card-header"
                            style="
                                background:#f28c28;
                                color:white;
                            "
                        >

                            <strong>

                                Informasi Akademik

                            </strong>

                        </div>

                        <div class="card-body">

                            <table class="table table-borderless">

                                <tr>

                                    <th width="180">

                                        Program Studi

                                    </th>

                                    <td>

                                        <?= esc($profile['prodi']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Jurusan

                                    </th>

                                    <td>

                                        <?= esc($profile['jurusan']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Fakultas

                                    </th>

                                    <td>

                                        <?= esc($profile['fakultas']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Jabatan

                                    </th>

                                    <td>

                                        <?= esc($profile['jabatan']) ?>

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Status

                                    </th>

                                    <td>

                                        <span class="badge badge-success">

                                            <?= esc($profile['status']) ?>

                                        </span>

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>