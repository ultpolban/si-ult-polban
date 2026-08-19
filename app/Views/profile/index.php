<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Profil Petugas - SI-ULT POLBAN') ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

        /* Sidebar Styling */
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

        /* Main Content Wrapper */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .top-navbar {
            height: 60px;
            background-color: var(--navy-primary);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        /* Content Container */
        .content-body {
            padding: 30px;
            flex: 1;
        }

        /* Card Styling */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            background: #ffffff;
        }

        .card-header-blue {
            background-color: #2563eb;
            color: #ffffff;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            padding: 15px 20px;
        }

        .info-box {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 12px 16px;
            height: 100%;
        }

        .info-box label {
            font-size: 0.75rem;
            color: #64748b;
            display: block;
            margin-bottom: 2px;
        }

        .info-box p {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
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
            border: 4px solid #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .avatar-badge {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: var(--orange-primary);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navbar -->
    <div class="sidebar">
        <div class="brand d-flex align-items-center gap-2">
            <i class="bi bi-layers-fill text-warning fs-4"></i>
            <span>SI-ULT POLBAN</span>
        </div>
        
        <div class="user-info d-flex align-items-center gap-2">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: 600; font-size: 0.85rem;">
                PE
            </div>
            <div>
                <div class="fw-bold small"><?= esc($user['full_name'] ?? 'Petugas ULT') ?></div>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li><a href="<?= base_url('profile') ?>" class="active"><i class="bi bi-person"></i> Profil</a></li>
            <li><a href="<?= base_url('dashboard') ?>"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="<?= base_url('datatiket') ?>"><i class="bi bi-ticket-detailed"></i> Data Tiket</a></li>
            <li><a href="<?= base_url('verification') ?>"><i class="bi bi-person-check"></i> Verifikasi Tiket</a></li>
            <li><a href="<?= base_url('disposisi') ?>"><i class="bi bi-box-arrow-up-right"></i> Disposisi Tiket</a></li>
            <li><a href="<?= base_url('guest-report') ?>"><i class="bi bi-people"></i> Laporan Tamu</a></li>
            <li><a href="<?= base_url('statistics') ?>"><i class="bi bi-pie-chart"></i> Statistik Tiket</a></li>
            <li><a href="<?= base_url('report') ?>"><i class="bi bi-file-earmark-text"></i> Laporan Tiket</a></li>
            <li><a href="<?= base_url('tracking') ?>"><i class="bi bi-geo-alt"></i> Tracking Tiket</a></li>
            <li><a href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-list fs-4" style="cursor: pointer;"></i>
                <span class="fw-semibold">Sistem Informasi Unit Layanan Terpadu</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-danger rounded-pill">3</span>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.8rem;">
                    PE
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-body">
            
            <!-- Alert Success -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0 mb-4 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Page Title & Action -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                        <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <i class="bi bi-person-gear fs-5"></i>
                        </div>
                        Profil Petugas
                    </h4>
                    <p class="text-muted small mb-0 ms-5">Kelola informasi profil dan identitas petugas ULT Polban.</p>
                </div>
                <a href="<?= base_url('profile/edit') ?>" class="btn text-white fw-semibold px-4 py-2 rounded-3 shadow-sm" style="background-color: var(--orange-primary);">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profil
                </a>
            </div>

            <!-- Card Utama Informasi Petugas -->
            <div class="card card-custom mb-4 overflow-hidden">
                <div class="card-header-blue d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2 fw-semibold">
                        <i class="bi bi-card-heading"></i> Informasi Petugas
                    </div>
                    <i class="bi bi-shield-check"></i>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-4">Data akun petugas Unit Layanan Terpadu</p>
                    
                    <div class="row g-4 align-items-center">
                        <!-- Foto Profil & Nama -->
                        <div class="col-lg-4 text-center border-end">
                            <div class="avatar-container mb-3">
                                <?php 
                                    $photoPath = !empty($user['profile_photo']) && file_exists(FCPATH . 'uploads/profile/' . $user['profile_photo']) 
                                        ? base_url('uploads/profile/' . $user['profile_photo']) 
                                        : 'https://via.placeholder.com/150';
                                ?>
                                <img src="<?= $photoPath ?>" alt="Foto Profil" class="avatar-img">
                                <div class="avatar-badge">
                                    <i class="bi bi-camera-fill small"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold text-dark mb-1"><?= esc($user['full_name'] ?? 'Nama Petugas') ?></h5>
                            <p class="text-muted small mb-2"><i class="bi bi-person-badge me-1"></i> Petugas ULT Polban</p>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-normal">
                                <i class="bi bi-dot"></i> Akun Aktif
                            </span>
                            <div class="text-muted mt-3" style="font-size: 0.7rem;">JPG, PNG, atau WEBP • Maks. 2 MB</div>
                        </div>

                        <!-- Data Pribadi Grid -->
                        <div class="col-lg-8 ps-lg-4">
                            <h6 class="fw-bold text-warning mb-3 d-flex align-items-center gap-2">
                                <i class="bi bi-person-fill"></i> Data Pribadi
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <label><i class="bi bi-person text-primary me-1"></i> Nama Lengkap</label>
                                        <p><?= esc($user['full_name'] ?? '-') ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <label><i class="bi bi-credit-card-2-front text-primary me-1"></i> ID Petugas</label>
                                        <p><?= esc($user['id'] ?? '-') ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <label><i class="bi bi-envelope text-primary me-1"></i> Email</label>
                                        <p><?= esc($user['email'] ?? '-') ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <label><i class="bi bi-telephone text-primary me-1"></i> Nomor HP</label>
                                        <p><?= esc($user['phone_number'] ?? '-') ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <label><i class="bi bi-briefcase text-primary me-1"></i> Jabatan</label>
                                        <p><?= esc($user['position'] ?? 'Petugas ULT') ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box">
                                        <label><i class="bi bi-building text-primary me-1"></i> Unit</label>
                                        <p><?= esc($user['unit'] ?? 'Unit Layanan Terpadu') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Kepegawaian Section -->
            <h6 class="fw-bold text-warning mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-layers-fill"></i> Informasi Kepegawaian
            </h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 bg-primary-subtle text-primary rounded-3">
                                <i class="bi bi-shield-lock fs-4"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Role Sistem</span>
                                <strong class="text-dark">Petugas ULT</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 bg-warning-subtle text-warning rounded-3">
                                <i class="bi bi-headset fs-4"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Tugas Utama</span>
                                <strong class="text-dark">Pengelolaan Tiket</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 bg-success-subtle text-success rounded-3">
                                <i class="bi bi-check-circle fs-4"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block">Status Akun</span>
                                <strong class="text-dark">Aktif</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>