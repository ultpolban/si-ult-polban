<?php
/**
 * PROFIL MASYARAKAT UMUM — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Masyarakat Umum',
    'ultProfileSubtitle' => 'Kelola dan tinjau identitas serta data akun Anda.',
    'ultProfileRole'     => 'Masyarakat Umum',
    'ultProfileRoleIcon' => 'fa-user',
    'ultProfileTask'     => 'Pengajuan & Pelacakan Layanan',
]) ?>

<?= $this->endSection() ?>
