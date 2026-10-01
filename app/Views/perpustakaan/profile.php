<?php
/**
 * PROFIL UNIT PERPUSTAKAAN — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit Perpustakaan',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan perpustakaan.',
    'ultProfileRole'     => 'Unit Perpustakaan',
    'ultProfileRoleIcon' => 'fa-book',
    'ultProfileTask'     => 'Pengelolaan Layanan Perpustakaan',
]) ?>

<?= $this->endSection() ?>
