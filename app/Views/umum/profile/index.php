<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_umum'); ?>

<style>
    /* =====================================================
       PROFIL MASYARAKAT UMUM — LAYOUT & STYLE
    ====================================================== */

    /* Judul halaman */
    .profile-page-title {
        color: #0b3d91;
        font-weight: 700;
    }

    /* Kard profil */
    .profile-card {
        border-radius: 15px;
        border-top: 5px solid #0b3d91;
        box-shadow: 0 6px 18px rgba(11, 61, 145, 0.12);
    }

    .profile-card .card-header {
        background: #0b3d91;
        color: #ffffff;
    }

    .profile-card .card-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 0;
    }

    .profile-edit-btn {
        background: #f28c28;
        border: none;
        color: #ffffff;
        font-weight: 600;
        border-radius: 6px;
        padding: 8px 18px;
        transition: all 0.25s ease;
    }

    .profile-edit-btn:hover {
        background: #ff7f00;
        box-shadow: 0 3px 10px rgba(242, 140, 40, 0.35);
        transform: translateY(-1px);
    }

    /* Panel avatar */
    .profile-avatar-panel {
        background: #f8fafc;
        border: 1px dashed #cbd8ef;
        border-radius: 12px;
        padding: 24px;
        height: 100%;
    }

    .profile-avatar-img {
        width: 170px;
        height: 170px;
        object-fit: cover;
        border-radius: 50%;
        border: 6px solid #0b3d91;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .profile-avatar-initial {
        width: 170px;
        height: 170px;
        margin: 0 auto;
        border-radius: 50%;
        background: linear-gradient(135deg, #0b3d91, #293582);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 80px;
        box-shadow: 0 5px 15px rgba(11, 61, 145, 0.25);
    }

    .profile-name {
        color: #0b3d91;
        font-size: 22px;
        font-weight: 700;
        margin-top: 14px;
        word-break: break-word;
    }

    .profile-role-badge {
        background: #eef3fb;
        color: #0b3d91;
        font-weight: 600;
        border: 1px solid #cbd8ef;
        border-radius: 30px;
        padding: 4px 14px;
        font-size: 13px;
    }

    /* Judul section */
    .profile-section-title {
        color: #0b3d91;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #dbe4f3;
    }

    /* Row info */
    .profile-info-row {
        background: #f8fafc;
        border-left: 4px solid #0b3d91;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 12px;
    }

    .profile-info-label {
        font-weight: 700;
        color: #293582;
    }

    .profile-info-icon {
        color: #0b3d91;
        width: 24px;
    }

    .profile-info-value {
        color: #212529;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .profile-avatar-img,
        .profile-avatar-initial {
            width: 130px;
            height: 130px;
            font-size: 60px;
        }

        .profile-info-row {
            padding: 10px 12px;
        }
    }

</style>

<?php
$profile = $profile ?? [];

$nama         = $profile['nama'] ?? '-';
$nik          = $profile['nik'] ?? '-';
$jenisKelamin = $profile['jenis_kelamin'] ?? '-';
$email        = $profile['email'] ?? '-';
$noHp         = $profile['no_hp'] ?? '-';
$alamat       = $profile['alamat'] ?? '-';

$foto = $profile['foto'] ?? null;
?>

<div class="content-wrapper" style="padding-top:0;">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <h1 class="mb-0 profile-page-title">

                        <i class="fas fa-user-tie mr-2"></i>

                        Profil Masyarakat Umum

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('umum/dashboard') ?>">

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

                    <button type="button" class="close" data-dismiss="alert">

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- ALERT ERROR -->

            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

                    <button type="button" class="close" data-dismiss="alert">

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 PROFILE CARD
            ================================================== -->

            <div class="card shadow-sm profile-card">


                <!-- CARD HEADER -->

                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <h3 class="card-title mb-0">

                            <i class="fas fa-id-card mr-2"></i>

                            Informasi Profil Masyarakat Umum

                        </h3>


                        <a
                            href="<?= base_url('umum/profile/edit') ?>"
                            class="btn profile-edit-btn"
                        >

                            <i class="fas fa-edit mr-1"></i>

                            Edit Profil

                        </a>

                    </div>

                </div>


                <!-- CARD BODY -->

                <div class="card-body">

                    <div class="row">


                        <!-- FOTO + IDENTITAS -->

                        <div class="col-lg-4 col-md-5 mb-4 mb-md-0">

                            <div class="text-center profile-avatar-panel">


                                <!-- FOTO -->

                                <?php if (!empty($foto)): ?>

                                    <img
                                        src="<?= base_url('uploads/profile/' . $foto) ?>"
                                        alt="Foto Profil"
                                        class="profile-avatar-img"
                                    >

                                <?php else: ?>

                                    <div class="profile-avatar-initial">

                                        <i class="fas fa-user-tie"></i>

                                    </div>

                                <?php endif; ?>


                                <!-- NAMA -->

                                <h3 class="profile-name">

                                    <?= esc($nama) ?>

                                </h3>


                                <span class="profile-role-badge">

                                    <i class="fas fa-users mr-1"></i>

                                    Masyarakat Umum

                                </span>

                            </div>

                        </div>


                        <!-- =================================================
                             DATA PRIBADI
                        ================================================== -->

                        <div class="col-lg-8 col-md-7">

                            <h4 class="profile-section-title">

                                <i class="fas fa-user mr-2"></i>

                                Data Pribadi

                            </h4>


                            <!-- NAMA -->

                            <div class="profile-info-row">

                                <div class="row">

                                    <div class="col-sm-4 profile-info-label">

                                        <i class="fas fa-user profile-info-icon mr-2"></i>

                                        Nama Lengkap

                                    </div>

                                    <div class="col-sm-8 profile-info-value">

                                        <?= esc($nama) ?>

                                    </div>

                                </div>

                            </div>


                            <!-- NIK -->

                            <div class="profile-info-row">

                                <div class="row">

                                    <div class="col-sm-4 profile-info-label">

                                        <i class="fas fa-id-card profile-info-icon mr-2"></i>

                                        NIK

                                    </div>

                                    <div class="col-sm-8 profile-info-value">

                                        <?= esc($nik) ?>

                                    </div>

                                </div>

                            </div>


                            <!-- JENIS KELAMIN -->

                            <div class="profile-info-row">

                                <div class="row">

                                    <div class="col-sm-4 profile-info-label">

                                        <i class="fas fa-venus-mars profile-info-icon mr-2"></i>

                                        Jenis Kelamin

                                    </div>

                                    <div class="col-sm-8 profile-info-value">

                                        <?php
                                        if ($jenisKelamin === 'L') {
                                            echo 'Laki-laki';
                                        } elseif ($jenisKelamin === 'P') {
                                            echo 'Perempuan';
                                        } else {
                                            echo esc($jenisKelamin);
                                        }
                                        ?>

                                    </div>

                                </div>

                            </div>


                            <!-- EMAIL -->

                            <div class="profile-info-row">

                                <div class="row">

                                    <div class="col-sm-4 profile-info-label">

                                        <i class="fas fa-envelope profile-info-icon mr-2"></i>

                                        Email

                                    </div>

                                    <div class="col-sm-8 profile-info-value">

                                        <?= esc($email) ?>

                                    </div>

                                </div>

                            </div>


                            <!-- NOMOR HP -->

                            <div class="profile-info-row">

                                <div class="row">

                                    <div class="col-sm-4 profile-info-label">

                                        <i class="fas fa-phone profile-info-icon mr-2"></i>

                                        Nomor HP

                                    </div>

                                    <div class="col-sm-8 profile-info-value">

                                        <?= esc($noHp) ?>

                                    </div>

                                </div>

                            </div>


                            <!-- ALAMAT -->

                            <div class="profile-info-row">

                                <div class="row">

                                    <div class="col-sm-4 profile-info-label">

                                        <i class="fas fa-map-marker-alt profile-info-icon mr-2"></i>

                                        Alamat

                                    </div>

                                    <div class="col-sm-8 profile-info-value">

                                        <?= esc($alamat) ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer'); ?>
