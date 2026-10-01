<?php
/**
 * =====================================================================
 *  HEAD TUNGGAL - SI ULT POLBAN
 * =====================================================================
 *
 *  Dipakai oleh SELURUH halaman yang sudah login, baik `layouts/template`
 *  (section based) maupun halaman lama yang memakai shell bersama.
 *
 *  Satu-satunya sumber style untuk area autentikasi:
 *   1. AdminLTE 3 (lokal, konsisten untuk semua halaman)
 *   2. Design system ULT (ult-dashboard.css)
 *   3. Komponen pendukung (theme-polban.css, petugas.css, table.css)
 *
 *  Catatan: `style.css` sengaja TIDAK dimuat di sini karena berisi gaya
 *  halaman publik (landing page) dan akan merusak tampilan dashboard.
 */
$ultTitle = $title ?? $pageTitle ?? 'Dashboard';
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Sistem Informasi Unit Layanan Terpadu Politeknik Negeri Bandung">
<meta name="author" content="SI ULT POLBAN">
<meta name="csrf-token" content="<?= csrf_hash() ?>">
<meta name="base-url" content="<?= base_url() ?>">

<title><?= esc($ultTitle) ?> &mdash; SI ULT POLBAN</title>

<!-- Logo / Favicon POLBAN -->
<link rel="icon" type="image/png" href="<?= base_url('assets/img/logo-polban.png') ?>">
<link rel="apple-touch-icon" href="<?= base_url('assets/img/logo-polban.png') ?>">

<!-- ========== BASE (AdminLTE 3 - lokal) ========== -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">

<!-- ========== DESIGN SYSTEM ULT ========== -->
<link rel="stylesheet" href="<?= base_url('assets/css/ult-dashboard.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/theme-polban.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/petugas.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/table.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">

<!-- ========== DROP-DOWN / SELECT (harus setelah design system) ========== -->
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/ult-select.css') ?>">

<?= $this->renderSection('styles') ?>