<?php
/**
 * =====================================================================
 *  PROFIL SAYA
 * ---------------------------------------------------------------------
 *  Memakai tampilan profil bersama (tema ULT). Label peran mengikuti
 *  role pengguna yang sedang login.
 * =====================================================================
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile') ?>

<?= $this->endSection() ?>
