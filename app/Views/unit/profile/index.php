<?php
/**
 * =====================================================================
 *  PROFIL UNIT TUJUAN
 * ---------------------------------------------------------------------
 *  Memakai tampilan profil bersama (tema ULT).
 * =====================================================================
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan Anda.',
    'ultProfileRoleIcon' => 'fa-building',
    'ultProfileTask'     => 'Pengelolaan Tiket Unit Layanan',
]) ?>

<?= $this->endSection() ?>
