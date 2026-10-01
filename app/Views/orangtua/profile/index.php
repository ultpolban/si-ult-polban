<?php
/**
 * PROFIL ORANG TUA — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Orang Tua',
    'ultProfileSubtitle' => 'Kelola dan tinjau identitas serta data akun Anda.',
    'ultProfileRole'     => 'Orang Tua',
    'ultProfileRoleIcon' => 'fa-user-friends',
    'ultProfileTask'     => 'Pengajuan & Pelacakan Layanan',
]) ?>

<?= $this->endSection() ?>
