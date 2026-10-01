<?php
/**
 * =====================================================================
 *  SHELL OPEN — SI ULT POLBAN
 * =====================================================================
 *
 *  Membuka dokumen HTML + wrapper + sidebar + navbar + area konten.
 *  Dipakai oleh `layouts/template` (section based) maupun
 *  `layouts/header` (include based) supaya SELURUH halaman
 *  tampilannya persis sama.
 */
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <?= $this->include('layouts/head') ?>
    <?= $this->include('layouts/_navbar_style') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <div id="toast-container-custom"></div>

    <?= $this->include('layouts/sidebar') ?>
    <?= $this->include('layouts/navbar') ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
