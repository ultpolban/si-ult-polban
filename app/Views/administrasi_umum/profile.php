<?php
/**
 * PROFIL UNIT ADMINISTRASI UMUM — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit Administrasi Umum',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan administrasi umum.',
    'ultProfileRole'     => 'Unit Administrasi Umum',
    'ultProfileRoleIcon' => 'fa-clipboard-list',
    'ultProfileTask'     => 'Pengelolaan Layanan Administrasi',
]) ?>

<?= $this->endSection() ?>
