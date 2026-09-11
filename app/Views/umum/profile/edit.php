<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_umum'); ?>

<style>
    /* =====================================================
       EDIT PROFIL MASYARAKAT UMUM — LAYOUT & STYLE
    ====================================================== */

    /* Judul halaman */
    .profile-page-title {
        color: #0b3d91;
        font-weight: 700;
    }

    /* Kard form */
    .profile-edit-card {
        border-radius: 15px;
        border-top: 5px solid #0b3d91;
        box-shadow: 0 6px 18px rgba(11, 61, 145, 0.12);
    }

    .profile-edit-card .card-header {
        background: #0b3d91;
        color: #ffffff;
    }

    .profile-edit-card .card-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 0;
    }

    /* Foto profil */
    .profile-photo-box {
        background: #f8fafc;
        border: 1px dashed #cbd8ef;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
    }

    .profile-photo-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #0b3d91;
        box-shadow: 0 4px 12px rgba(11, 61, 145, 0.18);
    }

    .profile-photo-preview-empty {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        background: linear-gradient(135deg, #0b3d91, #293582);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 60px;
        box-shadow: 0 4px 12px rgba(11, 61, 145, 0.18);
    }

    .profile-photo-btn {
        border-radius: 6px;
        font-weight: 600;
        background: #0b3d91;
        border: none;
        color: #ffffff;
        padding: 8px 18px;
        transition: all 0.25s ease;
    }

    .profile-photo-btn:hover {
        background: #293582;
        box-shadow: 0 3px 10px rgba(11, 61, 145, 0.3);
        transform: translateY(-1px);
    }

    .profile-photo-hint {
        color: #7a8aa5;
        font-size: 13px;
    }

    /* Judul section form */
    .profile-form-section {
        color: #0b3d91;
        font-weight: 700;
        font-size: 20px;
        margin-top: 8px;
        padding-bottom: 8px;
        border-bottom: 2px solid #dbe4f3;
    }

    /* Label input */
    .profile-form-label {
        font-weight: 700;
        color: #293582;
        font-size: 14px;
        margin-bottom: 6px;
    }

    /* Input */
    .profile-form .form-control {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        min-height: 44px;
        box-shadow: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .profile-form .form-control:focus {
        border-color: #0b3d91;
        box-shadow: 0 0 0 0.2rem rgba(11, 61, 145, 0.15);
    }

    .profile-form .form-control[readonly] {
        background-color: #e9eef3;
        color: #5f7894;
        cursor: not-allowed;
    }

    .profile-form textarea.form-control {
        min-height: 110px;
        line-height: 1.5;
    }

    /* Tombol footer */
    .profile-back-btn {
        background: #e9eef3;
        border: 1px solid #c3cede;
        color: #27364d;
        font-weight: 600;
        border-radius: 6px;
        padding: 9px 22px;
        transition: all 0.2s ease;
    }

    .profile-back-btn:hover {
        background: #dbe4f0;
        box-shadow: 0 2px 8px rgba(11, 61, 145, 0.12);
    }

    .profile-save-btn {
        background: #1e7e34;
        border: none;
        color: #ffffff;
        font-weight: 600;
        border-radius: 6px;
        padding: 9px 22px;
        transition: all 0.2s ease;
    }

    .profile-save-btn:hover {
        background: #176b2b;
        box-shadow: 0 3px 10px rgba(30, 126, 52, 0.3);
        transform: translateY(-1px);
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .profile-photo-preview,
        .profile-photo-preview-empty {
            width: 120px;
            height: 120px;
            font-size: 48px;
        }
    }
</style>

<?php
$profile = $profile ?? [];
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

                        <i class="fas fa-user-edit mr-2"></i>

                        Edit Profil Masyarakat Umum

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('umum/dashboard') ?>">

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('umum/profile') ?>">

                                Profil

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Edit

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

            <div class="row justify-content-center">

                <div class="col-xl-9 col-lg-10">


                    <!-- =================================================
                         ALERT ERROR
                    ================================================== -->

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
                         ALERT SUCCESS
                    ================================================== -->

                    <?php if (session()->getFlashdata('success')): ?>

                        <div class="alert alert-success alert-dismissible fade show">

                            <i class="fas fa-check-circle mr-2"></i>

                            <?= esc(session()->getFlashdata('success')) ?>

                            <button type="button" class="close" data-dismiss="alert">

                                &times;

                            </button>

                        </div>

                    <?php endif; ?>


                    <!-- =================================================
                         FORM
                    ================================================== -->

                    <form
                        action="<?= base_url('umum/profile/update') ?>"
                        method="post"
                        enctype="multipart/form-data"
                        class="profile-form"
                    >

                        <?= csrf_field() ?>


                        <div class="card shadow-sm profile-edit-card">

                            <!-- CARD HEADER -->

                            <div class="card-header">

                                <h3 class="card-title mb-0">

                                    <i class="fas fa-user-edit mr-2"></i>

                                    Edit Informasi Profil

                                </h3>

                            </div>


                            <!-- CARD BODY -->

                            <div class="card-body">

                                <!-- =================================================
                                     FOTO PROFILE
                                ================================================== -->

                                <div class="text-center mb-4 profile-photo-box">

                                    <?php if (!empty($profile['foto'] ?? null)): ?>

                                        <img
                                            id="previewFoto"
                                            src="<?= base_url('uploads/profile/' . $profile['foto']) ?>"
                                            alt="Foto Profil"
                                            class="profile-photo-preview"
                                        >

                                    <?php else: ?>

                                        <div id="previewDefault" class="profile-photo-preview-empty">

                                            <i class="fas fa-user-graduate"></i>

                                        </div>

                                        <img
                                            id="previewFoto"
                                            src=""
                                            alt="Preview Foto"
                                            class="profile-photo-preview"
                                            style="display:none;"
                                        >

                                    <?php endif; ?>


                                    <div class="mt-3">

                                        <label for="foto" class="btn profile-photo-btn">

                                            <i class="fas fa-camera mr-1"></i>

                                            Pilih Foto Profil

                                        </label>

                                        <input
                                            type="file"
                                            name="foto"
                                            id="foto"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            style="display:none;"
                                        >

                                    </div>


                                    <small class="text-muted d-block mt-2 profile-photo-hint">

                                        Format: JPG, JPEG, PNG, WEBP.

                                        <br>

                                        Maksimal 2 MB.

                                    </small>

                                </div>


                                <hr class="my-4">


                                <!-- =================================================
                                     DATA PRIBADI
                                ================================================== -->

                                <h4 class="profile-form-section">

                                    <i class="fas fa-user mr-2"></i>

                                    Data Pribadi

                                </h4>


                                <div class="row mt-4">


                                    <!-- NAMA -->

                                    <div class="col-md-6 mb-3">

                                        <label for="nama" class="profile-form-label">

                                            Nama Lengkap

                                            <span class="text-danger">*</span>

                                        </label>

                                        <input
                                            type="text"
                                            name="nama"
                                            id="nama"
                                            class="form-control"
                                            value="<?= esc($profile['nama'] ?? '') ?>"
                                            required
                                        >

                                    </div>


                                    <!-- NIK -->

                                    <div class="col-md-6 mb-3">

                                        <label class="profile-form-label">

                                            NIK

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control bg-light"
                                            value="<?= esc($profile['nik'] ?? '') ?>"
                                            readonly
                                        >

                                        <small class="text-muted d-block">

                                            NIK tidak dapat diubah.

                                        </small>

                                    </div>


                                    <!-- JENIS KELAMIN -->

                                    <div class="col-md-6 mb-3">

                                        <label class="profile-form-label">

                                            Jenis Kelamin

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            value="<?= ($profile['jenis_kelamin'] ?? '') === 'L' ? 'Laki-laki' : (($profile['jenis_kelamin'] ?? '') === 'P' ? 'Perempuan' : '-') ?>"
                                            readonly
                                        >

                                        <small class="text-muted d-block">

                                            Jenis kelamin tidak dapat diubah melalui halaman ini.

                                        </small>

                                    </div>


                                    <!-- EMAIL -->

                                    <div class="col-md-6 mb-3">

                                        <label for="email" class="profile-form-label">

                                            Email

                                            <span class="text-danger">*</span>

                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control"
                                            value="<?= esc($profile['email'] ?? '') ?>"
                                            required
                                        >

                                    </div>


                                    <!-- NOMOR HP -->

                                    <div class="col-md-6 mb-3">

                                        <label for="no_hp" class="profile-form-label">

                                            Nomor HP

                                            <span class="text-danger">*</span>

                                        </label>

                                        <input
                                            type="text"
                                            name="no_hp"
                                            id="no_hp"
                                            class="form-control"
                                            value="<?= esc($profile['no_hp'] ?? '') ?>"
                                            required
                                        >

                                    </div>


                                    <!-- ALAMAT -->

                                    <div class="col-md-12 mb-3">

                                        <label for="alamat" class="profile-form-label">

                                            Alamat

                                            <span class="text-danger">*</span>

                                        </label>

                                        <textarea
                                            name="alamat"
                                            id="alamat"
                                            rows="4"
                                            class="form-control"
                                            required
                                        ><?= esc($profile['alamat'] ?? '') ?></textarea>

                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 CARD FOOTER
                            ================================================== -->

                            <div class="card-footer d-flex justify-content-between align-items-center">

                                <a href="<?= base_url('umum/profile') ?>" class="btn profile-back-btn">

                                    <i class="fas fa-arrow-left mr-1"></i>

                                    Kembali

                                </a>


                                <button type="submit" class="btn profile-save-btn">

                                    <i class="fas fa-save mr-1"></i>

                                    Simpan Perubahan

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>


<!-- =====================================================
     PREVIEW FOTO
====================================================== -->

<script>
    document
        .getElementById('foto')
        .addEventListener('change', function(event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {

                const preview = document.getElementById('previewFoto');
                const defaultIcon = document.getElementById('previewDefault');

                preview.src = e.target.result;
                preview.style.display = 'block';

                if (defaultIcon) {
                    defaultIcon.style.display = 'none';
                }

            };

            reader.readAsDataURL(file);

        });
</script>


<?= $this->include('layouts/footer'); ?>
