<?php
/**
 * =====================================================================
 *  LAYOUT UTAMA (section based) — SI ULT POLBAN
 * =====================================================================
 *
 *  Semua halaman modern memakai layout ini:
 *      <?= $this->extend('layouts/template') ?>
 *
 *  Halaman lama yang memakai `layouts/header` + `layouts/footer`
 *  mendapat tampilan yang sama persis karena keduanya memakai
 *  shell bersama (`_shell_open` / `_shell_close`).
 */
?>

<?= $this->include('layouts/_shell_open') ?>

<?= $this->renderSection('content') ?>

<?= $this->include('layouts/_shell_close') ?>
