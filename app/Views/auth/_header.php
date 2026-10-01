<?php
/**
 * Header halaman auth (login, registrasi, MFA).
 * Satu tampilan untuk seluruh halaman autentikasi.
 */
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title><?= esc($title ?? 'Login') ?> &mdash; SI ULT POLBAN</title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo-polban.png') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/ult-select.css') ?>">
</head>

<body>

<div class="auth-page">

    <div class="auth-container">

        <div class="auth-card">

            <!-- PANEL KIRI -->
            <div class="auth-left">

                <div class="auth-left-inner">

                    <a href="<?= base_url('/') ?>" class="auth-logo">
                        <img src="<?= base_url('assets/img/logo-polban.png') ?>" alt="Logo POLBAN">
                        <span>
                            <b>SI ULT POLBAN</b>
                            <small>Unit Layanan Terpadu</small>
                        </span>
                    </a>

                    <h1><?= esc($authHeader ?? 'Sistem Informasi Layanan Terpadu POLBAN') ?></h1>

                    <p>
                        Satu pintu untuk seluruh layanan akademik, administrasi,
                        dan kemahasiswaan Politeknik Negeri Bandung.
                    </p>

                    <ul class="auth-points">
                        <li><i class="bi bi-check2-circle"></i> Pengajuan 100% online</li>
                        <li><i class="bi bi-check2-circle"></i> Status tiket transparan</li>
                        <li><i class="bi bi-check2-circle"></i> Seluruh unit layanan terhubung</li>
                    </ul>

                </div>

            </div>

            <!-- PANEL KANAN (FORM) -->
            <div class="auth-right">
