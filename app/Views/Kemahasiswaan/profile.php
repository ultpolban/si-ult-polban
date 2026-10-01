<?php
/**
 * PROFIL UNIT KEMAHASISWAAN — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit Kemahasiswaan',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan kemahasiswaan.',
    'ultProfileRole'     => 'Unit Kemahasiswaan',
    'ultProfileRoleIcon' => 'fa-users',
    'ultProfileTask'     => 'Pengelolaan Layanan Kemahasiswaan',
]) ?>

<?= $this->endSection() ?>
