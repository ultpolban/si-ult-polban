<?php
/**
 * PROFIL UNIT UPT TIK — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Unit UPT TIK',
    'ultProfileSubtitle' => 'Informasi akun dan data unit layanan TIK.',
    'ultProfileRole'     => 'Unit UPT TIK',
    'ultProfileRoleIcon' => 'fa-server',
    'ultProfileTask'     => 'Pengelolaan Layanan TIK',
]) ?>

<?= $this->endSection() ?>
