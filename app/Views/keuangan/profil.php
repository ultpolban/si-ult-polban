<?php
/**
 * PROFIL UNIT KEUANGAN — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit Keuangan',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan keuangan.',
    'ultProfileRole'     => 'Unit Keuangan',
    'ultProfileRoleIcon' => 'fa-wallet',
    'ultProfileTask'     => 'Pengelolaan Layanan Keuangan',
]) ?>

<?= $this->endSection() ?>
