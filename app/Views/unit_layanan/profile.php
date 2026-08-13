<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
// Data petugas.
// Jika session memiliki data, gunakan data session.
// Jika belum ada, gunakan data dummy.
$namaPetugas  = session()->get('name') ?: 'Budi Santoso';
$nipPetugas   = session()->get('nip') ?: '198603122024011002';
$emailPetugas = session()->get('email') ?: 'budi.santoso@polban.ac.id';
$noHpPetugas  = session()->get('no_hp') ?: '081298765432';
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="dashboard-title mb-1">
                <i class="fas fa-user-circle me-2"></i>
                Profil Petugas
            </h2>

            <p class="dashboard-subtitle mb-0">
                Informasi profil Petugas Unit Layanan Akademik
            </p>
        </div>

    </div>


    <div class="card shadow-sm border-0">

        <!-- HEADER -->
        <div class="card-header text-white"
             style="background-color:#293582;">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    <i class="fas fa-id-card me-2"></i>
                    Profil Petugas Akademik
                </h5>

                <a href="<?= base_url('unit_layanan/profile/edit') ?>"
                   class="btn btn-sm text-white"
                   style="background-color:#ff7f00;">

                    <i class="fas fa-edit me-1"></i>
                    Edit Profil

                </a>

            </div>

        </div>


        <!-- BODY -->
        <div class="card-body p-4">

            <div class="row">

                <!-- FOTO -->
                <div class="col-lg-4 text-center border-end">

                    <div class="mb-3">

                        <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                             style="
                                width:150px;
                                height:150px;
                                background:#293582;
                                color:white;
                                font-size:70px;
                             ">

                            <i class="fas fa-user"></i>

                        </div>

                    </div>


                    <h4 class="fw-bold mb-1"
                        style="color:#293582;">

                        <?= esc($namaPetugas) ?>

                    </h4>


                    <p class="text-muted mb-3">

                        <i class="fas fa-id-badge me-1"></i>

                        Petugas Unit Layanan

                    </p>


                    <span class="badge bg-success px-3 py-2">

                        <i class="fas fa-circle me-1"
                           style="font-size:8px;"></i>

                        Aktif

                    </span>

                </div>


                <!-- INFORMASI -->
                <div class="col-lg-8">

                    <h4 class="fw-bold mb-4"
                        style="color:#293582;">

                        <i class="fas fa-user me-2"></i>
                        Informasi Petugas

                    </h4>


                    <!-- NAMA -->
                    <div class="row mb-3">

                        <div class="col-md-4 fw-bold">
                            <i class="fas fa-user text-primary me-2"></i>
                            Nama Lengkap
                        </div>

                        <div class="col-md-8">
                            <?= esc($namaPetugas) ?>
                        </div>

                    </div>


                    <!-- NIP -->
                    <div class="row mb-3">

                        <div class="col-md-4 fw-bold">
                            <i class="fas fa-id-card text-primary me-2"></i>
                            NIP
                        </div>

                        <div class="col-md-8">
                            <?= esc($nipPetugas) ?>
                        </div>

                    </div>


                    <!-- EMAIL -->
                    <div class="row mb-3">

                        <div class="col-md-4 fw-bold">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            Email
                        </div>

                        <div class="col-md-8">
                            <?= esc($emailPetugas) ?>
                        </div>

                    </div>


                    <!-- NO HP -->
                    <div class="row mb-3">

                        <div class="col-md-4 fw-bold">
                            <i class="fas fa-phone text-primary me-2"></i>
                            Nomor HP
                        </div>

                        <div class="col-md-8">
                            <?= esc($noHpPetugas) ?>
                        </div>

                    </div>


                    <!-- JABATAN -->
                    <div class="row mb-3">

                        <div class="col-md-4 fw-bold">
                            <i class="fas fa-briefcase text-primary me-2"></i>
                            Jabatan
                        </div>

                        <div class="col-md-8">
                            Petugas Unit Layanan
                        </div>

                    </div>


                    <!-- UNIT -->
                    <div class="row mb-3">

                        <div class="col-md-4 fw-bold">
                            <i class="fas fa-building text-primary me-2"></i>
                            Unit Layanan
                        </div>

                        <div class="col-md-8">

                            <span class="badge px-3 py-2"
                                  style="background-color:#293582;">

                                <i class="fas fa-university me-1"></i>

                                Akademik

                            </span>

                        </div>

                    </div>


                    <!-- STATUS -->
                    <div class="row mb-3">

                        <div class="col-md-4 fw-bold">
                            <i class="fas fa-check-circle text-primary me-2"></i>
                            Status
                        </div>

                        <div class="col-md-8">

                            <span class="badge bg-success">
                                Aktif
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <hr class="my-4">


            <!-- INFORMASI AKADEMIK -->
            <h4 class="fw-bold mb-4"
                style="color:#293582;">

                <i class="fas fa-university me-2"></i>
                Informasi Unit Akademik

            </h4>


            <div class="row g-3">

                <!-- UNIT -->
                <div class="col-md-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="
                                        width:50px;
                                        height:50px;
                                        background:#293582;
                                        color:white;
                                     ">

                                    <i class="fas fa-building"></i>

                                </div>

                                <div>

                                    <small class="text-muted">
                                        Unit
                                    </small>

                                    <h6 class="fw-bold mb-0">
                                        Akademik
                                    </h6>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- JABATAN -->
                <div class="col-md-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="
                                        width:50px;
                                        height:50px;
                                        background:#293582;
                                        color:white;
                                     ">

                                    <i class="fas fa-user-tie"></i>

                                </div>

                                <div>

                                    <small class="text-muted">
                                        Jabatan
                                    </small>

                                    <h6 class="fw-bold mb-0">
                                        Petugas Unit Layanan
                                    </h6>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- LAYANAN -->
                <div class="col-md-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-body">

                            <div class="d-flex align-items-center">

                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                     style="
                                        width:50px;
                                        height:50px;
                                        background:#ff7f00;
                                        color:white;
                                     ">

                                    <i class="fas fa-headset"></i>

                                </div>

                                <div>

                                    <small class="text-muted">
                                        Bidang Layanan
                                    </small>

                                    <h6 class="fw-bold mb-0">
                                        Layanan Akademik
                                    </h6>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>