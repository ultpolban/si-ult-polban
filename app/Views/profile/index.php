<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Profil Petugas - SI-ULT POLBAN') ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 250px;
            --navy-primary: #1e3a8a;
            --navy-sidebar: #22326e;
            --navy-dark: #1a2556;
            --orange-primary: #f97316;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            overflow-x: hidden;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--navy-sidebar);
            color: #ffffff;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar .brand {
            padding: 20px;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .user-info {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #d1d5db;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            color: #ffffff;
            background-color: var(--navy-dark);
        }

        .sidebar-menu li a i {
            font-size: 1.1rem;
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        /* =========================
           MAIN
        ========================= */

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            height: 60px;
            background-color: var(--navy-primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .content-body {
            padding: 30px;
            flex: 1;
        }

        /* =========================
           CARD
        ========================= */

        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            background: #ffffff;
        }

        .card-header-blue {
            background-color: #2563eb;
            color: #ffffff;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            padding: 15px 20px;
        }

        /* =========================
           INFO BOX
        ========================= */

        .info-box {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 12px 16px;
            height: 100%;
            border: 1px solid transparent;
            transition: 0.2s ease;
        }

        .info-box:hover {
            background-color: #ffffff;
            border-color: #dbeafe;
            box-shadow: 0 3px 10px rgba(37, 99, 235, 0.06);
        }

        .info-box label {
            font-size: 0.75rem;
            color: #64748b;
            display: block;
            margin-bottom: 3px;
        }

        .info-box p {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            word-break: break-word;
        }

        /* =========================
           PROFILE PHOTO
        ========================= */

        .profile-photo-area {
            padding: 10px 15px;
        }

        .avatar-container {
            position: relative;
            display: inline-block;
        }

        .avatar-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #ffffff;
            box-shadow:
                0 0 0 2px #dbeafe,
                0 6px 18px rgba(30, 58, 138, 0.12);
            background-color: #f8fafc;
            transition: 0.2s ease;
        }

        .avatar-container:hover .avatar-img {
            transform: scale(1.02);
        }

        .avatar-badge {
            position: absolute;
            bottom: 4px;
            right: 3px;
            background-color: var(--orange-primary);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid white;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .avatar-badge:hover {
            transform: scale(1.08);
            background-color: #ea580c;
        }

        .avatar-badge i {
            font-size: 15px;
        }

        .photo-help {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 9px 14px;
            display: inline-block;
        }

        .photo-help i {
            color: #2563eb;
        }

        /* =========================
           PROFILE HEADER
        ========================= */

        .profile-intro {
            background: linear-gradient(
                135deg,
                rgba(37, 99, 235, 0.08),
                rgba(249, 115, 22, 0.04)
            );
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 18px;
            border: 1px solid #e5e7eb;
        }

        .profile-intro-title {
            font-size: 0.82rem;
            color: #64748b;
            margin-bottom: 3px;
        }

        .profile-intro-name {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
        }

        /* =========================
           EMPLOYEE CARD
        ========================= */

        .employee-card {
            height: 100%;
            border: 1px solid #edf2f7;
            border-radius: 10px;
            padding: 18px;
            background: #ffffff;
            transition: 0.2s ease;
        }

        .employee-card:hover {
            border-color: #dbeafe;
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.06);
        }

        .employee-icon {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* =========================
           SECURITY INFO
        ========================= */

        .security-box {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #2563eb;
            padding: 16px 18px;
            margin-top: 20px;
        }

        .security-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 991px) {
            .sidebar {
                width: 220px;
            }

            .main-wrapper {
                margin-left: 220px;
            }

            .content-body {
                padding: 20px;
            }
        }

        @media (max-width: 767px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .top-navbar {
                padding: 0 15px;
            }

            .content-body {
                padding: 15px;
            }

            .border-end {
                border-right: none !important;
                border-bottom: 1px solid #e5e7eb;
                padding-bottom: 25px;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================= -->

    <div class="sidebar">

        <div class="brand d-flex align-items-center gap-2">
            <i class="bi bi-layers-fill text-warning fs-4"></i>
            <span>SI-ULT POLBAN</span>
        </div>

        <div class="user-info d-flex align-items-center gap-2">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                style="width: 35px; height: 35px; font-weight: 600; font-size: 0.85rem;">
                PE
            </div>

            <div>
                <div class="fw-bold small">
                    <?= esc($user['full_name'] ?? 'Petugas ULT') ?>
                </div>
            </div>
        </div>

        <ul class="sidebar-menu">

            <li>
                <a href="<?= base_url('profile') ?>" class="active">
                    <i class="bi bi-person"></i>
                    Profil
                </a>
            </li>

            <li>
                <a href="<?= base_url('dashboard') ?>">
                    <i class="bi bi-house"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="<?= base_url('datatiket') ?>">
                    <i class="bi bi-ticket-detailed"></i>
                    Data Tiket
                </a>
            </li>

            <li>
                <a href="<?= base_url('verification') ?>">
                    <i class="bi bi-person-check"></i>
                    Verifikasi Tiket
                </a>
            </li>

            <li>
                <a href="<?= base_url('disposisi') ?>">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Disposisi Tiket
                </a>
            </li>

            <li>
                <a href="<?= base_url('guest-report') ?>">
                    <i class="bi bi-people"></i>
                    Laporan Tamu
                </a>
            </li>

            <li>
                <a href="<?= base_url('statistics') ?>">
                    <i class="bi bi-pie-chart"></i>
                    Statistik Tiket
                </a>
            </li>

            <li>
                <a href="<?= base_url('report') ?>">
                    <i class="bi bi-file-earmark-text"></i>
                    Laporan Tiket
                </a>
            </li>

            <li>
                <a href="<?= base_url('tracking') ?>">
                    <i class="bi bi-geo-alt"></i>
                    Tracking Tiket
                </a>
            </li>

            <li>
                <a href="<?= base_url('logout') ?>">
                    <i class="bi bi-box-arrow-left"></i>
                    Logout
                </a>
            </li>

        </ul>
    </div>


    <!-- =========================
         MAIN CONTENT
    ========================= -->

    <div class="main-wrapper">

        <!-- TOP NAVBAR -->
        <div class="top-navbar">

            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-list fs-4" style="cursor: pointer;"></i>

                <span class="fw-semibold">
                    Sistem Informasi Unit Layanan Terpadu
                </span>
            </div>

            <div class="d-flex align-items-center gap-3">

                <span class="badge bg-danger rounded-pill">
                    3
                </span>

                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 32px; height: 32px; font-size: 0.8rem;">
                    PE
                </div>

            </div>

        </div>


        <!-- CONTENT -->
        <div class="content-body">

            <!-- SUCCESS -->
            <?php if (session()->getFlashdata('success')): ?>

                <div class="alert alert-success alert-dismissible fade show border-0 mb-4 shadow-sm"
                    role="alert">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    <?= session()->getFlashdata('success') ?>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                    </button>

                </div>

            <?php endif; ?>


            <!-- PAGE TITLE -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">

                        <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px;">

                            <i class="bi bi-person-gear fs-5"></i>

                        </div>

                        Profil Petugas

                    </h4>

                    <p class="text-muted small mb-0 ms-5">
                        Kelola informasi profil dan identitas petugas ULT Polban.
                    </p>

                </div>


                <a href="<?= base_url('profile/edit') ?>"
                    class="btn text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                    style="background-color: var(--orange-primary);">

                    <i class="bi bi-pencil-square me-1"></i>
                    Edit Profil

                </a>

            </div>


            <!-- =========================
                 PROFILE MAIN CARD
            ========================= -->

            <div class="card card-custom mb-4 overflow-hidden">

                <div class="card-header-blue d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center gap-2 fw-semibold">

                        <i class="bi bi-card-heading"></i>

                        Informasi Petugas

                    </div>

                    <i class="bi bi-shield-check"></i>

                </div>


                <div class="card-body p-4">

                    <div class="profile-intro">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-info-circle text-primary"></i>

                            <div>

                                <div class="profile-intro-title">
                                    Data akun petugas Unit Layanan Terpadu
                                </div>

                                <div class="profile-intro-name">
                                    <?= esc($user['full_name'] ?? 'Nama Petugas') ?>
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="row g-4 align-items-center">


                        <!-- =========================
                             FOTO PROFIL
                        ========================= -->

                        <div class="col-lg-4 text-center border-end">

                            <?php

                            $photoPath = !empty($user['profile_photo'])
                                && file_exists(FCPATH . 'uploads/profile/' . $user['profile_photo'])
                                ? base_url('uploads/profile/' . $user['profile_photo'])
                                : 'https://via.placeholder.com/150';

                            ?>


                            <!-- FORM KHUSUS FOTO -->
                            <form id="photoForm"
                                action="<?= base_url('profile/update') ?>"
                                method="post"
                                enctype="multipart/form-data">

                                <!--
                                    Controller update() membutuhkan
                                    full_name, email, dan phone_number.
                                    Jadi data lama dikirim kembali ketika
                                    foto diganti melalui kamera.
                                -->

                                <input type="hidden"
                                    name="full_name"
                                    value="<?= esc($user['full_name'] ?? '') ?>">

                                <input type="hidden"
                                    name="email"
                                    value="<?= esc($user['email'] ?? '') ?>">

                                <input type="hidden"
                                    name="phone_number"
                                    value="<?= esc($user['phone_number'] ?? '') ?>">


                                <!-- INPUT FILE -->
                                <input type="file"
                                    id="profilePhotoInput"
                                    name="profile_photo"
                                    accept="image/png,image/jpg,image/jpeg,image/webp"
                                    class="d-none">


                                <div class="profile-photo-area">

                                    <div class="avatar-container mb-3">

                                        <img id="profilePreview"
                                            src="<?= $photoPath ?>"
                                            alt="Foto Profil"
                                            class="avatar-img">


                                        <!--
                                            KAMERA SEKARANG BISA DIKLIK
                                        -->
                                        <label for="profilePhotoInput"
                                            class="avatar-badge"
                                            title="Ganti foto profil">

                                            <i class="bi bi-camera-fill"></i>

                                        </label>

                                    </div>


                                    <h5 class="fw-bold text-dark mb-1">

                                        <?= esc($user['full_name'] ?? 'Nama Petugas') ?>

                                    </h5>


                                    <p class="text-muted small mb-2">

                                        <i class="bi bi-person-badge me-1"></i>

                                        Petugas ULT Polban

                                    </p>


                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-normal">

                                        <i class="bi bi-dot"></i>

                                        Akun Aktif

                                    </span>


                                    <!-- INFO FOTO -->

                                    <div class="photo-help text-muted mt-3"
                                        style="font-size: 0.7rem;">

                                        <i class="bi bi-image me-1"></i>

                                        JPG, PNG, atau WEBP

                                        <br>

                                        Maksimal 2 MB

                                    </div>


                                    <!-- TOMBOL EDIT FOTO -->

                                    <div class="mt-3">

                                        <label for="profilePhotoInput"
                                            class="btn btn-outline-primary btn-sm px-3">

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Edit Foto

                                        </label>

                                    </div>


                                    <!-- STATUS UPLOAD -->

                                    <div id="photoStatus"
                                        class="small text-primary mt-2 d-none">

                                        <i class="bi bi-arrow-repeat me-1"></i>

                                        Menyimpan foto...

                                    </div>

                                </div>

                            </form>

                        </div>


                        <!-- =========================
                             DATA PRIBADI
                        ========================= -->

                        <div class="col-lg-8 ps-lg-4">

                            <h6 class="fw-bold text-warning mb-3 d-flex align-items-center gap-2">

                                <i class="bi bi-person-fill"></i>

                                Data Pribadi

                            </h6>


                            <div class="row g-3">


                                <!-- NAMA -->
                                <div class="col-md-6">

                                    <div class="info-box">

                                        <label>

                                            <i class="bi bi-person text-primary me-1"></i>

                                            Nama Lengkap

                                        </label>

                                        <p>
                                            <?= esc($user['full_name'] ?? '-') ?>
                                        </p>

                                    </div>

                                </div>


                                <!-- ID -->
                                <div class="col-md-6">

                                    <div class="info-box">

                                        <label>

                                            <i class="bi bi-credit-card-2-front text-primary me-1"></i>

                                            ID Petugas

                                        </label>

                                        <p>
                                            <?= esc($user['id'] ?? '-') ?>
                                        </p>

                                    </div>

                                </div>


                                <!-- EMAIL -->
                                <div class="col-md-6">

                                    <div class="info-box">

                                        <label>

                                            <i class="bi bi-envelope text-primary me-1"></i>

                                            Email

                                        </label>

                                        <p>
                                            <?= esc($user['email'] ?? '-') ?>
                                        </p>

                                    </div>

                                </div>


                                <!-- PHONE -->
                                <div class="col-md-6">

                                    <div class="info-box">

                                        <label>

                                            <i class="bi bi-telephone text-primary me-1"></i>

                                            Nomor HP

                                        </label>

                                        <p>
                                            <?= esc($user['phone_number'] ?? '-') ?>
                                        </p>

                                    </div>

                                </div>


                                <!-- JABATAN -->
                                <div class="col-md-6">

                                    <div class="info-box">

                                        <label>

                                            <i class="bi bi-briefcase text-primary me-1"></i>

                                            Jabatan

                                        </label>

                                        <p>
                                            <?= esc($user['position'] ?? 'Petugas ULT') ?>
                                        </p>

                                    </div>

                                </div>


                                <!-- UNIT -->
                                <div class="col-md-6">

                                    <div class="info-box">

                                        <label>

                                            <i class="bi bi-building text-primary me-1"></i>

                                            Unit

                                        </label>

                                        <p>
                                            <?= esc($user['unit'] ?? 'Unit Layanan Terpadu') ?>
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
                 INFORMASI KEPEGAWAIAN
            ========================= -->

            <h6 class="fw-bold text-warning mb-3 d-flex align-items-center gap-2">

                <i class="bi bi-layers-fill"></i>

                Informasi Kepegawaian

            </h6>


            <div class="row g-3">


                <!-- ROLE -->
                <div class="col-md-4">

                    <div class="employee-card">

                        <div class="d-flex align-items-center gap-3">

                            <div class="employee-icon bg-primary-subtle text-primary">

                                <i class="bi bi-shield-lock"></i>

                            </div>

                            <div>

                                <span class="text-muted small d-block">
                                    Role Sistem
                                </span>

                                <strong class="text-dark">
                                    Petugas ULT
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- TUGAS -->
                <div class="col-md-4">

                    <div class="employee-card">

                        <div class="d-flex align-items-center gap-3">

                            <div class="employee-icon bg-warning-subtle text-warning">

                                <i class="bi bi-headset"></i>

                            </div>

                            <div>

                                <span class="text-muted small d-block">
                                    Tugas Utama
                                </span>

                                <strong class="text-dark">
                                    Pengelolaan Tiket
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- STATUS -->
                <div class="col-md-4">

                    <div class="employee-card">

                        <div class="d-flex align-items-center gap-3">

                            <div class="employee-icon bg-success-subtle text-success">

                                <i class="bi bi-check-circle"></i>

                            </div>

                            <div>

                                <span class="text-muted small d-block">
                                    Status Akun
                                </span>

                                <strong class="text-success">
                                    Aktif
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =========================
                 SECURITY INFO
            ========================= -->

            <div class="security-box">

                <div class="d-flex align-items-center gap-3">

                    <div class="security-icon">

                        <i class="bi bi-shield-check fs-5"></i>

                    </div>

                    <div>

                        <div class="fw-bold text-dark mb-1">

                            Akun Anda Terlindungi

                        </div>

                        <div class="text-muted small">

                            Pastikan informasi akun dan data pribadi
                            tetap terjaga untuk keamanan sistem.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- =========================
         FOTO PROFIL SCRIPT
    ========================= -->

    <script>

        const photoInput = document.getElementById('profilePhotoInput');
        const photoPreview = document.getElementById('profilePreview');
        const photoForm = document.getElementById('photoForm');
        const photoStatus = document.getElementById('photoStatus');


        photoInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }


            // Cek tipe file
            const allowedTypes = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {

                alert('Format foto harus JPG, JPEG, PNG, atau WEBP.');

                this.value = '';

                return;
            }


            // Cek ukuran maksimal 2 MB
            if (file.size > 2 * 1024 * 1024) {

                alert('Ukuran foto maksimal 2 MB.');

                this.value = '';

                return;
            }


            // Preview foto
            const reader = new FileReader();

            reader.onload = function (event) {

                photoPreview.src = event.target.result;

            };

            reader.readAsDataURL(file);


            /*
             * Langsung submit.
             *
             * Controller update() akan menerima:
             * full_name
             * email
             * phone_number
             * profile_photo
             */

            photoStatus.classList.remove('d-none');

            photoForm.submit();

        });

    </script>

</body>

</html>