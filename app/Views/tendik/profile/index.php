<?php
/**
 * PROFIL TENDIK — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Tendik',
    'ultProfileSubtitle' => 'Kelola dan tinjau identitas serta data akun Anda.',
    'ultProfileRole'     => 'Tendik',
    'ultProfileRoleIcon' => 'fa-user-tie',
    'ultProfileTask'     => 'Pengajuan & Pelacakan Layanan',
]) ?>

<?= $this->endSection() ?>
