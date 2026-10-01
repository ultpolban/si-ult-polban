<?php
/**
 * PROFIL MITRA — memakai tampilan profil bersama (tema ULT).
 */
?>

<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?= $this->include('profile/ult_profile', [
    'ultProfileTitle'    => 'Profil Mitra',
    'ultProfileSubtitle' => 'Kelola dan tinjau identitas serta data akun Anda.',
    'ultProfileRole'     => 'Mitra',
    'ultProfileRoleIcon' => 'fa-handshake',
    'ultProfileTask'     => 'Pengajuan & Pelacakan Layanan',
]) ?>

<?= $this->endSection() ?>
