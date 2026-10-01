<?php
/**
 * =====================================================================
 *  PROFIL PETUGAS ULT
 * ---------------------------------------------------------------------
 *  Memakai tampilan profil bersama (tema ULT) yang identik untuk
 *  seluruh role. Lihat: app/Views/profile/ult_profile.php
 * =====================================================================
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Petugas',
    'ultProfileSubtitle' => 'Kelola dan tinjau identitas resmi petugas Unit Layanan Terpadu POLBAN.',
    'ultProfileRole'     => 'Petugas ULT',
    'ultProfileRoleIcon' => 'fa-user-tie',
    'ultProfileTask'     => 'Pengelolaan Tiket & Aduan',
]) ?>

<?= $this->endSection() ?>
