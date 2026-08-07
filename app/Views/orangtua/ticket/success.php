<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<?php

// Nomor tiket otomatis jika belum dikirim dari controller
$nomor_tiket = $nomor_tiket ?? 'ULT-ORT-' . date('YmdHis');

// Jenis layanan
$jenis_layanan = $jenis_layanan ?? 'Surat Keterangan Mahasiswa';

// Status
$status = $status ?? 'Submitted';

?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1 class="font-weight-bold text-primary">

                <i class="fas fa-check-circle mr-2"></i>

                Pengajuan

            </h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-7">

                    <div class="card shadow-lg"
                        style="border-top:5px solid #0b3d91;border-radius:18px;">

                        <div class="card-body text-center p-5">

                            <div
                                style="
                                    width:130px;
                                    height:130px;
                                    background:#d9f7df;
                                    border-radius:50%;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    margin:auto;
                                ">

                                <i class="fas fa-check text-success"
                                    style="font-size:70px;"></i>

                            </div>

                            <h1
                                class="mt-4 font-weight-bold"
                                style="color:#0B3D91;">
                                Pengajuan Berhasil Dikirim!
                            </h1>

                            <p class="text-muted mt-3 mb-4"
                               style="font-size:20px;">

                                Pengajuan layanan Anda telah berhasil dikirim
                                dan akan diproses oleh petugas ULT POLBAN.

                            </p>

                            <div
                                class="border rounded p-4 mb-4"
                                style="
                                    background:#F5F9FF;
border:2px solid #0B3D91;
                                ">

                                <div class="text-muted">

                                    Nomor Tiket Anda

                                </div>

                                <h2
                                    class="font-weight-bold mt-2"
                                    style="
                                    color:#0B3D91;
                                    letter-spacing:2px;">
                                    <?= esc($nomor_tiket) ?>
                                </h2>

                            </div>

                            <hr>

                            <div class="row text-left">

                                <div class="col-6">

                                    <p>

                                        <i class="fas fa-file-alt text-primary mr-2"></i>

                                        Jenis Layanan

                                    </p>

                                </div>

                                <div class="col-6 text-right font-weight-bold">

                                    <?= esc($jenis_layanan) ?>

                                </div>

                            </div>

                            <div class="row text-left mt-2">

                                <div class="col-6">

                                    <p>

                                        <i class="fas fa-info-circle text-primary mr-2"></i>

                                        Status

                                    </p>

                                </div>

                                <div class="col-6 text-right">

<span
    class="badge px-3 py-2"
    style="
        background:#0B3D91;
        color:white;
        font-size:14px;
    ">

                                        <?= esc($status) ?>

                                    </span>

                                </div>

                            </div>

                            <hr>

                            <div
                                class="alert"
style="
    background:#EDF4FF;
    border-left:5px solid #0B3D91;
    color:#0B3D91;
">

                                <i class="fas fa-info-circle mr-2"></i>

                                Simpan nomor tiket Anda untuk memantau
                                perkembangan pengajuan layanan.

                            </div>

                            <div class="mt-4">

                                <a
                                    href="<?= base_url('dashboard-orangtua') ?>"
                                    class="btn btn-secondary mr-2">

                                    <i class="fas fa-home mr-1"></i>

                                    Dashboard

                                </a>

                                <a
                                    href="<?= base_url('orangtua/ticket/history') ?>"
                                    class="btn btn-primary">

                                    <i class="btn"
style="
    background:#0B3D91;
    color:white;
    border:none;
"></i>

                                    Tracking Tiket

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>