<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_mitra'); ?>

<?php
$profile = $profile ?? [];

$nama         = $profile['nama'] ?? 'Mitra';
$instansi     = $profile['instansi'] ?? '-';
$jabatan      = $profile['jabatan'] ?? '-';
$jenisKelamin = $profile['jenis_kelamin'] ?? '-';
$email        = $profile['email'] ?? '-';
$noHp         = $profile['no_hp'] ?? '-';
$alamat       = $profile['alamat'] ?? '-';

$foto         = $profile['foto'] ?? null;
?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-sm-6">
                    <h1
                        class="mb-0"
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >
                        <i class="fas fa-user mr-2"></i>
                        Profil Mitra
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('mitra/dashboard') ?>">
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


    <!-- =====================================================
         CONTENT
    ====================================================== -->
    <section class="content">
        <div class="container-fluid">

            <!-- ALERT SUCCESS -->
            <?php if (session()->getFlashdata('success')): ?>

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


            <!-- ALERT ERROR -->
            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >
                        &times;
                    </button>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 PROFILE CARD
            ================================================== -->
            <div
                class="card shadow-sm"
                style="
                    border-radius:15px;
                    border-top:5px solid #0b3d91;
                "
            >

                <!-- CARD HEADER -->
                <div
                    class="card-header"
                    style="
                        background:#0b3d91;
                        color:white;
                    "
                >

                    <div class="d-flex justify-content-between align-items-center">

                        <h3 class="card-title mb-0">

                            <i class="fas fa-id-card mr-2"></i>

                            Informasi Profil Mitra

                        </h3>


                        <a
                            href="<?= base_url('mitra/profile/edit') ?>"
                            class="btn"
                            style="
                                background:#f28c28;
                                color:white;
                                font-weight:600;
                            "
                        >

                            <i class="fas fa-edit mr-1"></i>

                            Edit Profil

                        </a>

                    </div>

                </div>


                <!-- CARD BODY -->
                <div class="card-body">

                    <!-- =================================================
                         BAGIAN ATAS
                    ================================================== -->
                    <div class="row">

                        <!-- FOTO + IDENTITAS -->
                        <div class="col-lg-4 col-md-5 mb-4 mb-md-0">

                            <div
                                class="text-center"
                                style="
                                    padding:20px;
                                    background:#f8fafc;
                                    border-radius:12px;
                                    height:100%;
                                "
                            >

                                <!-- FOTO -->
                                <?php if (!empty($foto)): ?>

                                    <img
                                        src="<?= base_url('uploads/profile/' . $foto) ?>"
                                        alt="Foto Profil"
                                        style="
                                            width:170px;
                                            height:170px;
                                            object-fit:cover;
                                            border-radius:50%;
                                            border:6px solid #0b3d91;
                                            box-shadow:
                                                0 5px 15px
                                                rgba(0,0,0,.15);
                                        "
                                    >

                                <?php else: ?>

                                    <div
                                        style="
                                            width:170px;
                                            height:170px;
                                            margin:auto;
                                            border-radius:50%;
                                            background:#0b3d91;
                                            display:flex;
                                            align-items:center;
                                            justify-content:center;
                                            color:white;
                                            font-size:80px;
                                        "
                                    >
                                        <i class="fas fa-user-tie"></i>
                                    </div>

                                <?php endif; ?>


                                <!-- NAMA -->
                                <h3
                                    class="mt-3 mb-2"
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >
                                    <?= esc($nama) ?>
                                </h3>


                                <!-- INSTANSI -->
                                <p class="text-muted mb-1">

                                    <i class="fas fa-building mr-1"></i>

                                    <?= esc($instansi) ?>

                                </p>


                                <!-- JABATAN -->
                                <p class="text-muted mb-0">

                                    <i class="fas fa-briefcase mr-1"></i>

                                    <?= esc($jabatan) ?>

                                </p>

                            </div>

                        </div>


                        <!-- DATA PRIBADI -->
                        <div class="col-lg-8 col-md-7">

                            <h4
                                class="mb-4"
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                <i class="fas fa-user mr-2"></i>

                                Data Pribadi

                            </h4>


                            <!-- NAMA -->
                            <div class="row mb-3">

                                <div class="col-sm-4 font-weight-bold">

                                    <i class="fas fa-user text-primary mr-2"></i>

                                    Nama Lengkap

                                </div>

                                <div class="col-sm-8">

                                    <?= esc($nama) ?>

                                </div>

                            </div>


                            <!-- INSTANSI -->
                            <div class="row mb-3">

                                <div class="col-sm-4 font-weight-bold">

                                    <i class="fas fa-building text-primary mr-2"></i>

                                    Instansi / Perusahaan

                                </div>

                                <div class="col-sm-8">

                                    <?= esc($instansi) ?>

                                </div>

                            </div>


                            <!-- JABATAN -->
                            <div class="row mb-3">

                                <div class="col-sm-4 font-weight-bold">

                                    <i class="fas fa-briefcase text-primary mr-2"></i>

                                    Jabatan

                                </div>

                                <div class="col-sm-8">

                                    <?= esc($jabatan) ?>

                                </div>

                            </div>


                            <!-- JENIS KELAMIN -->
                            <div class="row mb-3">

                                <div class="col-sm-4 font-weight-bold">

                                    <i class="fas fa-venus-mars text-primary mr-2"></i>

                                    Jenis Kelamin

                                </div>

                                <div class="col-sm-8">

                                    <?= esc($jenisKelamin) ?>

                                </div>

                            </div>


                            <!-- EMAIL -->
                            <div class="row mb-3">

                                <div class="col-sm-4 font-weight-bold">

                                    <i class="fas fa-envelope text-primary mr-2"></i>

                                    Email

                                </div>

                                <div class="col-sm-8">

                                    <?= esc($email) ?>

                                </div>

                            </div>


                            <!-- NOMOR HP -->
                            <div class="row mb-3">

                                <div class="col-sm-4 font-weight-bold">

                                    <i class="fas fa-phone text-primary mr-2"></i>

                                    Nomor HP

                                </div>

                                <div class="col-sm-8">

                                    <?= esc($noHp) ?>

                                </div>

                            </div>


                            <!-- ALAMAT -->
                            <div class="row mb-0">

                                <div class="col-sm-4 font-weight-bold">

                                    <i class="fas fa-map-marker-alt text-primary mr-2"></i>

                                    Alamat

                                </div>

                                <div class="col-sm-8">

                                    <?= esc($alamat) ?>

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    <!-- =================================================
                         INFORMASI MITRA
                    ================================================== -->
                    <h4
                        class="mb-4"
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-handshake mr-2"></i>

                        Informasi Mitra

                    </h4>


                    <div class="row">

                        <!-- INSTANSI -->
                        <div class="col-lg-6 col-md-6 mb-3">

                            <div
                                style="
                                    background:#f5f8fc;
                                    padding:20px;
                                    border-left:4px solid #0b3d91;
                                    border-radius:8px;
                                    height:100%;
                                "
                            >

                                <small class="text-muted">

                                    Instansi / Perusahaan

                                </small>

                                <h5
                                    class="mb-0 mt-1"
                                    style="
                                        font-weight:600;
                                    "
                                >

                                    <?= esc($instansi) ?>

                                </h5>

                            </div>

                        </div>


                        <!-- JABATAN -->
                        <div class="col-lg-6 col-md-6 mb-3">

                            <div
                                style="
                                    background:#f5f8fc;
                                    padding:20px;
                                    border-left:4px solid #0b3d91;
                                    border-radius:8px;
                                    height:100%;
                                "
                            >

                                <small class="text-muted">

                                    Jabatan

                                </small>

                                <h5
                                    class="mb-0 mt-1"
                                    style="
                                        font-weight:600;
                                    "
                                >

                                    <?= esc($jabatan) ?>

                                </h5>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

</div>

<?= $this->include('layouts/footer'); ?>