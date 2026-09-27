<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
// =====================================================
// DATA PETUGAS
// =====================================================

$namaPetugas  = session()->get('name') ?: 'Siti Nurhaliza';
$nipPetugas   = session()->get('nip') ?: '199001182024012003';
$emailPetugas = session()->get('email') ?: 'siti.nurhaliza@polban.ac.id';
$noHpPetugas  = session()->get('no_hp') ?: '081376543210';
$jabatan      = session()->get('jabatan') ?: 'Petugas Unit Layanan';
?>

<div class="container-fluid">

    <!-- ===================================================== -->
    <!-- NOTIFIKASI -->
    <!-- ===================================================== -->

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success alert-dismissible fade show shadow-sm"
             role="alert">

            <i class="fas fa-check-circle me-2"></i>

            <?= esc(session()->getFlashdata('success')) ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show shadow-sm"
             role="alert">

            <i class="fas fa-exclamation-circle me-2"></i>

            <?= esc(session()->getFlashdata('error')) ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <!-- ===================================================== -->
    <!-- JUDUL -->
    <!-- ===================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="dashboard-title mb-1">

                <i class="fas fa-user-circle me-2"></i>

                Profil Petugas

            </h2>

            <p class="dashboard-subtitle mb-0">

                Informasi profil Petugas Unit Layanan Kemahasiswaan

            </p>

        </div>

    </div>


    <!-- ===================================================== -->
    <!-- CARD PROFIL -->
    <!-- ===================================================== -->

    <div class="card shadow-sm border-0">

        <!-- HEADER -->

        <div class="card-header text-white"
             style="background-color:#293582;">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    <i class="fas fa-id-card me-2"></i>

                    Profil Petugas Kemahasiswaan

                </h5>


                <!-- TOMBOL EDIT PROFIL -->

                <button type="button"
                        class="btn btn-sm text-white"
                        style="background-color:#ff7f00;"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEditProfil">

                    <i class="fas fa-edit me-1"></i>

                    Edit Profil

                </button>

            </div>

        </div>


        <!-- ================================================= -->
        <!-- BODY CARD -->
        <!-- ================================================= -->

        <div class="card-body p-4">

            <div class="row">


                <!-- ================================================= -->
                <!-- FOTO / IDENTITAS -->
                <!-- ================================================= -->

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


                    <!-- NAMA -->

                    <h4 class="fw-bold mb-1"
                        style="color:#293582;">

                        <?= esc($namaPetugas) ?>

                    </h4>


                    <!-- JABATAN -->

                    <p class="text-muted mb-3">

                        <i class="fas fa-id-badge me-1"></i>

                        <?= esc($jabatan) ?>

                    </p>


                    <!-- STATUS -->

                    <span class="badge bg-success px-3 py-2">

                        <i class="fas fa-circle me-1"
                           style="font-size:8px;">
                        </i>

                        Aktif

                    </span>

                </div>


                <!-- ================================================= -->
                <!-- INFORMASI PETUGAS -->
                <!-- ================================================= -->

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

                            <?= esc($jabatan) ?>

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

                                <i class="fas fa-user-graduate me-1"></i>

                                Kemahasiswaan

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

                            <span class="badge bg-success px-3 py-2">

                                Aktif

                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <!-- GARIS PEMISAH -->

            <hr class="my-4">


            <!-- ================================================= -->
            <!-- INFORMASI UNIT KEMAHASISWAAN -->
            <!-- ================================================= -->

            <h4 class="fw-bold mb-4"
                style="color:#293582;">

                <i class="fas fa-user-graduate me-2"></i>

                Informasi Unit Kemahasiswaan

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

                                        Kemahasiswaan

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

                                        <?= esc($jabatan) ?>

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

                                        Layanan Kemahasiswaan

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


<!-- ========================================================= -->
<!-- MODAL EDIT PROFIL KEMAHASISWAAN -->
<!-- ========================================================= -->

<div class="modal fade"
     id="modalEditProfil"
     tabindex="-1"
     aria-labelledby="modalEditProfilLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">


            <!-- HEADER MODAL -->

            <div class="modal-header text-white"
                 style="background-color:#293582;">

                <h5 class="modal-title"
                    id="modalEditProfilLabel">

                    <i class="fas fa-user-edit me-2"></i>

                    Edit Profil Petugas Kemahasiswaan

                </h5>


                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <!-- FORM -->

            <form action="<?= base_url('kemahasiswaan/profile/update') ?>"
                  method="post">

                <?= csrf_field() ?>

                <div class="modal-body p-4">

                    <div class="row">


                        <!-- NAMA -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                <i class="fas fa-user text-primary me-2"></i>

                                Nama Lengkap

                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="<?= esc($namaPetugas) ?>"
                                   placeholder="Masukkan nama lengkap"
                                   required>

                        </div>


                        <!-- NIP -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                <i class="fas fa-id-card text-primary me-2"></i>

                                NIP

                            </label>

                            <input type="text"
                                   name="nip"
                                   class="form-control"
                                   value="<?= esc($nipPetugas) ?>"
                                   placeholder="Masukkan NIP"
                                   required>

                        </div>


                        <!-- EMAIL -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                <i class="fas fa-envelope text-primary me-2"></i>

                                Email

                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="<?= esc($emailPetugas) ?>"
                                   placeholder="Masukkan email"
                                   required>

                        </div>


                        <!-- NO HP -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-bold">

                                <i class="fas fa-phone text-primary me-2"></i>

                                Nomor HP

                            </label>

                            <input type="text"
                                   name="no_hp"
                                   class="form-control"
                                   value="<?= esc($noHpPetugas) ?>"
                                   placeholder="Masukkan nomor HP">

                        </div>


                        <!-- JABATAN -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label fw-bold">

                                <i class="fas fa-briefcase text-primary me-2"></i>

                                Jabatan

                            </label>

                            <input type="text"
                                   name="jabatan"
                                   class="form-control"
                                   value="<?= esc($jabatan) ?>"
                                   placeholder="Masukkan jabatan">

                        </div>


                        <!-- UNIT -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label fw-bold">

                                <i class="fas fa-building text-primary me-2"></i>

                                Unit Layanan

                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="Kemahasiswaan"
                                   readonly>

                            <small class="text-muted">

                                <i class="fas fa-info-circle me-1"></i>

                                Unit layanan tidak dapat diubah.

                            </small>

                        </div>

                    </div>

                </div>


                <!-- FOOTER -->

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        <i class="fas fa-times me-1"></i>

                        Batal

                    </button>


                    <button type="submit"
                            class="btn text-white"
                            style="background-color:#293582;">

                        <i class="fas fa-save me-1"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<?= $this->endSection() ?>