<?php
/**
 * PROFIL ALUMNI — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Alumni',
    'ultProfileSubtitle' => 'Kelola dan tinjau identitas serta data akun Anda.',
    'ultProfileRole'     => 'Alumni',
    'ultProfileRoleIcon' => 'fa-user-graduate',
    'ultProfileTask'     => 'Pengajuan & Pelacakan Layanan',
]) ?>

<?= $this->endSection() ?>
