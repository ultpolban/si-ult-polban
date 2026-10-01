<?php
/**
 * PROFIL UNIT JURUSAN — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit Jurusan',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan jurusan.',
    'ultProfileRole'     => 'Unit Jurusan',
    'ultProfileRoleIcon' => 'fa-landmark',
    'ultProfileTask'     => 'Pengelolaan Layanan Jurusan',
]) ?>

<?= $this->endSection() ?>
