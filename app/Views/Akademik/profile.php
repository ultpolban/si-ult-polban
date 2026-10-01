<?php
/**
 * PROFIL UNIT AKADEMIK — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit Akademik',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan akademik.',
    'ultProfileRole'     => 'Unit Akademik',
    'ultProfileRoleIcon' => 'fa-graduation-cap',
    'ultProfileTask'     => 'Pengelolaan Layanan Akademik',
]) ?>

<?= $this->endSection() ?>
