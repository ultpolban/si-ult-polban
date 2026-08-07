<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<?php

// Dummy Data
$tickets = [

    [
        'id'            => 1,
        'nomor'         => 'ULT-ORT-20260807102531',
        'unit_layanan'  => 'Akademik',
        'layanan'       => 'Surat Aktif Kuliah',
        'keterangan'    => 'Permohonan Surat Aktif Kuliah.',
        'dokumen'       => '',
        'status'        => 'Submitted',
        'created_at'    => '07 Agustus 2026'
    ],

    [
        'id'            => 2,
        'nomor'         => 'ULT-ORT-20260807104025',
        'unit_layanan'  => 'Keuangan',
        'layanan'       => 'Informasi UKT/SPP',
        'keterangan'    => 'Menanyakan rincian pembayaran UKT.',
        'dokumen'       => '',
        'status'        => 'Diproses',
        'created_at'    => '07 Agustus 2026'
    ],

    [
        'id'            => 3,
        'nomor'         => 'ULT-ORT-20260807105110',
        'unit_layanan'  => 'Kemahasiswaan',
        'layanan'       => 'Pengajuan Beasiswa',
        'keterangan'    => 'Pengajuan beasiswa untuk mahasiswa.',
        'dokumen'       => '',
        'status'        => 'Selesai',
        'created_at'    => '07 Agustus 2026'
    ]

];

?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        ">

                        <i class="fas fa-ticket-alt mr-2"></i>

                        Tracking Tiket

                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dashboard-orangtua') ?>">

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Tracking Tiket

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>

    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <!-- ALERT SUCCESS -->
            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('success')) ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert">

                        &times;

                    </button>

                </div>

            <?php endif; ?>

            <!-- ALERT ERROR -->
            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert">

                        &times;

                    </button>

                </div>

            <?php endif; ?>

            <!-- CARD -->
            <div
                class="card shadow-sm border-0">

                <div
                    class="card-header text-white"
                    style="
                        background:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    ">

                    <h5 class="mb-0">

                        <i class="fas fa-ticket-alt mr-2"></i>

                        Daftar Tiket Pengajuan

                    </h5>

                </div>

                <div class="card-body">

                    <?php if (!empty($tickets)) : ?>

                        <div class="table-responsive">

                            <table
                                class="table table-bordered table-hover">

                                <thead
                                    style="
                                        background:#e8f1fb;
                                        color:#17365d;
                                    ">

                                    <tr>

                                        <th>No</th>

                                        <th>Nomor Tiket</th>

                                        <th>Unit Layanan</th>

                                        <th>Jenis Layanan</th>

                                        <th>Keterangan</th>

                                        <th>Dokumen</th>

                                        <th>Status</th>

                                        <th>Tanggal Pengajuan</th>

                                        <th width="120">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php foreach ($tickets as $index => $ticket) : ?>

                                        <tr>

                                            <td><?= $index + 1 ?></td>

                                            <td>

                                                <strong>

                                                    <?= esc($ticket['nomor']) ?>

                                                </strong>

                                            </td>

                                            <td>

                                                <?= esc($ticket['unit_layanan']) ?>

                                            </td>

                                            <td>

                                                <?= esc($ticket['layanan']) ?>

                                            </td>

                                            <td>

                                                <?= esc($ticket['keterangan']) ?>

                                            </td>
                                                                                        </td>

                                            <!-- DOKUMEN -->
                                            <td>

                                                <?php if (!empty($ticket['dokumen'])) : ?>

                                                    <a
                                                        href="<?= base_url('uploads/dokumen/' . $ticket['dokumen']) ?>"
                                                        target="_blank"
                                                        class="btn btn-sm btn-primary">

                                                        <i class="fas fa-file-alt mr-1"></i>

                                                        Lihat

                                                    </a>

                                                <?php else : ?>

                                                    <span class="text-muted">

                                                        Tidak Ada

                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                            <!-- STATUS -->
                                            <td>

                                                <?php

                                                $status = $ticket['status'];

                                                ?>

                                                <?php if (strtolower($status) == 'submitted') : ?>

                                                    <span class="badge badge-warning">

                                                        <i class="fas fa-clock mr-1"></i>

                                                        Submitted

                                                    </span>

                                                <?php elseif (strtolower($status) == 'diproses') : ?>

                                                    <span class="badge badge-info">

                                                        <i class="fas fa-spinner mr-1"></i>

                                                        Diproses

                                                    </span>

                                                <?php elseif (strtolower($status) == 'selesai') : ?>

                                                    <span class="badge badge-success">

                                                        <i class="fas fa-check-circle mr-1"></i>

                                                        Selesai

                                                    </span>

                                                <?php elseif (strtolower($status) == 'ditolak') : ?>

                                                    <span class="badge badge-danger">

                                                        <i class="fas fa-times-circle mr-1"></i>

                                                        Ditolak

                                                    </span>

                                                <?php else : ?>

                                                    <span class="badge badge-secondary">

                                                        <?= esc($status) ?>

                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                            <!-- TANGGAL -->
                                            <td>

                                                <?= esc($ticket['created_at']) ?>

                                            </td>

                                            <!-- AKSI -->
                                            <td>

                                                <a
                                                    href="<?= base_url('orangtua/ticket/detail/' . $ticket['nomor']) ?>"
                                                    class="btn btn-sm btn-primary">

                                                    <i class="fas fa-eye mr-1"></i>

                                                    Detail

                                                </a>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    <?php else : ?>

                        <div class="text-center py-5">

                            <i
                                class="fas fa-ticket-alt"
                                style="
                                    font-size:60px;
                                    color:#b0bec5;
                                ">
                            </i>

                            <h5
                                class="mt-3"
                                style="
                                    color:#17365d;
                                ">

                                Belum Ada Tiket

                            </h5>

                            <p class="text-muted">

                                Anda belum memiliki riwayat pengajuan layanan.

                            </p>

                            <a
                                href="<?= base_url('orangtua/ticket/create') ?>"
                                class="btn text-white"
                                style="
                                    background:#f28c28;
                                    border-color:#f28c28;
                                ">

                                <i class="fas fa-plus-circle mr-1"></i>

                                Buat Pengajuan

                            </a>

                        </div>

                    <?php endif; ?>

                </div>

            </div>
                    </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>