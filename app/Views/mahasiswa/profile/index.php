<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-7">
                    <h1 class="fw-bold profile-page-title">
                        <i class="fas fa-user-graduate"></i>
                        Profil Mahasiswa
                    </h1>
                </div>

                <div class="col-md-5 text-md-end mt-2 mt-md-0">

                    <a href="<?= base_url('dashboard-mahasiswa') ?>"
                       class="btn btn-outline-primary">

                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Dashboard

                    </a>

                </div>

            </div>

        </div>
    </section>


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- ========================= -->
                <!-- CARD PROFIL KIRI -->
                <!-- ========================= -->

                <div class="col-lg-4 mb-4">

                    <div class="card profile-card shadow-sm">

                        <div class="card-header profile-card-header">

                            <h3 class="card-title">

                                <i class="fas fa-user-circle"></i>

                                Foto Profil

                            </h3>

                        </div>


                        <div class="card-body text-center">

                            <!-- INISIAL -->
                            <div class="profile-avatar">

                                <?php
                                $nama = $user['nama'] ?? 'Mahasiswa';

                                $initials = '';

                                $namaParts = explode(' ', trim($nama));

                                foreach ($namaParts as $part) {
                                    if (!empty($part)) {
                                        $initials .= strtoupper(substr($part, 0, 1));
                                    }
                                }

                                echo substr($initials, 0, 2);
                                ?>

                            </div>


                            <!-- NAMA -->

                            <h3 class="fw-bold mt-3 mb-1">

                                <?= esc($user['nama'] ?? '-') ?>

                            </h3>


                            <!-- NIM -->

                            <p class="text-muted mb-1">

                                <i class="fas fa-id-card"></i>

                                <?= esc($user['nim'] ?? '-') ?>

                            </p>


                            <!-- PRODI -->

                            <p class="text-muted mb-3">

                                <i class="fas fa-graduation-cap"></i>

                                <?= esc($user['prodi'] ?? '-') ?>

                            </p>


                            <!-- STATUS -->

                            <span class="badge bg-success px-3 py-2">

                                <i class="fas fa-check-circle"></i>

                                <?= esc($user['status'] ?? 'Aktif') ?>

                            </span>

                        </div>


                        <div class="card-footer text-center bg-white">

                            <a href="<?= base_url('mahasiswa/profile/edit') ?>"
                               class="btn btn-danger btn-edit-profile">

                                <i class="fas fa-edit"></i>

                                Edit Profil

                            </a>

                        </div>

                    </div>

                </div>


                <!-- ========================= -->
                <!-- INFORMASI MAHASISWA -->
                <!-- ========================= -->

                <div class="col-lg-8 mb-4">

                    <div class="card profile-card shadow-sm">

                        <div class="card-header profile-card-header">

                            <h3 class="card-title">

                                <i class="fas fa-address-card"></i>

                                Informasi Mahasiswa

                            </h3>

                        </div>


                        <div class="card-body">

                            <div class="row">

                                <!-- NAMA -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-user"></i>

                                            Nama Lengkap

                                        </span>

                                        <strong>

                                            <?= esc($user['nama'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- NIM -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-id-card"></i>

                                            NIM

                                        </span>

                                        <strong>

                                            <?= esc($user['nim'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- NIK -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-id-badge"></i>

                                            NIK

                                        </span>

                                        <strong>

                                            <?= esc($user['nik'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- TEMPAT TANGGAL LAHIR -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-calendar-alt"></i>

                                            Tempat, Tanggal Lahir

                                        </span>

                                        <strong>

                                            <?= esc($user['tempat_lahir'] ?? '-') ?>,

                                            <?= esc($user['tanggal_lahir'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- JENIS KELAMIN -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-venus-mars"></i>

                                            Jenis Kelamin

                                        </span>

                                        <strong>

                                            <?= esc($user['jenis_kelamin'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- PROGRAM STUDI -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-graduation-cap"></i>

                                            Program Studi

                                        </span>

                                        <strong>

                                            <?= esc($user['prodi'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- FAKULTAS -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-university"></i>

                                            Fakultas

                                        </span>

                                        <strong>

                                            <?= esc($user['fakultas'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- TAHUN ANGKATAN -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-calendar"></i>

                                            Tahun Angkatan

                                        </span>

                                        <strong>

                                            <?= esc($user['angkatan'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- STATUS -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-user-check"></i>

                                            Status Keaktifan Kuliah

                                        </span>

                                        <strong class="text-success">

                                            <i class="fas fa-check-circle"></i>

                                            <?= esc($user['status'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- DOSEN WALI -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-chalkboard-teacher"></i>

                                            Dosen Wali

                                        </span>

                                        <strong>

                                            <?= esc($user['dosen_wali'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- NOMOR TELEPON -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-phone"></i>

                                            Nomor Telepon

                                        </span>

                                        <strong>

                                            <?= esc($user['telepon'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- EMAIL -->

                                <div class="col-md-6 mb-3">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-envelope"></i>

                                            Email

                                        </span>

                                        <strong>

                                            <?= esc($user['email'] ?? '-') ?>

                                        </strong>

                                    </div>

                                </div>


                                <!-- ALAMAT -->

                                <div class="col-12 mb-2">

                                    <div class="profile-info-box">

                                        <span class="profile-label">

                                            <i class="fas fa-map-marker-alt"></i>

                                            Alamat

                                        </span>

                                        <strong>

                                            <?= esc($user['alamat'] ?? '-') ?>

                                        </strong>

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


<style>

/* ============================= */
/* JUDUL HALAMAN */
/* ============================= */

.profile-page-title {
    color: #0d47a1;
}

.profile-page-title i {
    color: #0d47a1;
}


/* ============================= */
/* CARD */
/* ============================= */

.profile-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
}


/* ============================= */
/* HEADER CARD */
/* ============================= */

.profile-card-header {
    background: #0d47a1;
    color: white;
    padding: 15px 20px;
    border-bottom: 4px solid #f59e0b;
}

.profile-card-header .card-title {
    font-size: 19px;
    font-weight: 600;
}


/* ============================= */
/* FOTO / INISIAL */
/* ============================= */

.profile-avatar {
    width: 150px;
    height: 150px;
    margin: 10px auto;

    border-radius: 50%;

    background: #0d47a1;
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 60px;
    font-weight: 500;

    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.20);

    border: 6px solid #f8fafc;
}


/* ============================= */
/* INFO BOX */
/* ============================= */

.profile-info-box {
    min-height: 82px;

    padding: 14px 16px;

    background: #f8fafc;

    border: 1px solid #e2e8f0;

    border-left: 4px solid #0d47a1;

    border-radius: 8px;

    transition: all 0.2s ease;
}


.profile-info-box:hover {
    transform: translateY(-2px);

    border-left-color: #f59e0b;

    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}


.profile-label {
    display: block;

    color: #64748b;

    font-size: 13px;

    font-weight: 600;

    margin-bottom: 6px;
}


.profile-label i {
    width: 20px;

    color: #0d47a1;
}


.profile-info-box strong {
    color: #172554;

    font-size: 16px;

    font-weight: 600;
}


/* ============================= */
/* BUTTON EDIT */
/* ============================= */

.btn-edit-profile {
    background: #0d47a1;

    border-color: #0d47a1;

    padding: 10px 22px;

    font-weight: 600;

    transition: all 0.2s ease;
}


.btn-edit-profile:hover {
    background: #f59e0b;

    border-color: #f59e0b;

    transform: translateY(-2px);
}


/* ============================= */
/* BUTTON KEMBALI */
/* ============================= */

.btn-outline-primary {
    color: #0d47a1;

    border-color: #0d47a1;
}


.btn-outline-primary:hover {
    background: #f59e0b;

    border-color: #f59e0b;

    color: white;
}

</style>


<?= $this->include('layouts/footer') ?>