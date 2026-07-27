<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">

    <!-- =========================================
         HEADER
    ========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        class="font-weight-bold"
                        style="color: #0d47a1;"
                    >

                        <i class="fas fa-history mr-2"></i>

                        Tracking Tiket

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url('dosen/dashboard') ?>"
                            >

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


    <!-- =========================================
         CONTENT
    ========================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- SUCCESS MESSAGE -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div
                    class="alert alert-success alert-dismissible fade show"
                >

                    <i class="fas fa-check-circle mr-2"></i>

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>


                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- CARD -->

            <div class="card shadow-sm border-0">


                <!-- CARD HEADER -->

                <div
                    class="card-header text-white"
                    style="
                        background-color: #0d47a1;
                        border-bottom: 4px solid #f7941d;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-ticket-alt mr-2"></i>

                        Riwayat Pengajuan Layanan

                    </h5>

                </div>


                <!-- CARD BODY -->

                <div class="card-body">


                    <?php if (!empty($tickets)) : ?>


                        <div class="table-responsive">

                            <table
                                class="table table-bordered table-hover"
                            >


                                <!-- TABLE HEADER -->

                                <thead
                                    style="
                                        background-color: #e8f1fb;
                                        color: #17365d;
                                    "
                                >

                                    <tr>

                                        <th>
                                            No
                                        </th>

                                        <th>
                                            Nomor Tiket
                                        </th>

                                        <th>
                                            Unit Tujuan
                                        </th>

                                        <th>
                                            Jenis Layanan
                                        </th>

                                        <th>
                                            Judul
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Tanggal
                                        </th>

                                        <th>
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <!-- TABLE BODY -->

                                <tbody>


                                    <?php foreach (
                                        $tickets
                                        as $index => $ticket
                                    ) : ?>


                                        <tr>


                                            <!-- NO -->

                                            <td>

                                                <?= $index + 1 ?>

                                            </td>


                                            <!-- NOMOR TIKET -->

                                            <td>

                                                <strong
                                                    style="
                                                        color: #0d47a1;
                                                    "
                                                >

                                                    <?= esc(
                                                        $ticket['nomor_tiket']
                                                        ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>


                                            <!-- UNIT TUJUAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket['unit_tujuan']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- JENIS LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket['jenis_layanan']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- JUDUL -->

                                            <td>

                                                <?= esc(
                                                    $ticket['judul']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- STATUS -->

                                            <td>


                                                <?php
                                                $status =
                                                    $ticket['status']
                                                    ?? 'Submitted';
                                                ?>


                                                <?php if (
                                                    strtolower($status)
                                                    === 'submitted'
                                                ) : ?>

                                                    <span
                                                        class="badge badge-warning"
                                                    >

                                                        Menunggu Verifikasi

                                                    </span>


                                                <?php elseif (
                                                    strtolower($status)
                                                    === 'diproses'
                                                ) : ?>

                                                    <span
                                                        class="badge badge-info"
                                                    >

                                                        Diproses

                                                    </span>


                                                <?php elseif (
                                                    strtolower($status)
                                                    === 'selesai'
                                                ) : ?>

                                                    <span
                                                        class="badge badge-success"
                                                    >

                                                        Selesai

                                                    </span>


                                                <?php elseif (
                                                    strtolower($status)
                                                    === 'ditolak'
                                                ) : ?>

                                                    <span
                                                        class="badge badge-danger"
                                                    >

                                                        Ditolak

                                                    </span>


                                                <?php else : ?>

                                                    <span
                                                        class="badge badge-secondary"
                                                    >

                                                        <?= esc(
                                                            $status
                                                        ) ?>

                                                    </span>

                                                <?php endif; ?>


                                            </td>


                                            <!-- TANGGAL -->

                                            <td>

                                                <?= esc(
                                                    $ticket['created_at']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- AKSI -->

                                            <td>

                                                <a
                                                    href="<?= base_url(
                                                        'dosen/ticket/detail/' .
                                                        $index
                                                    ) ?>"
                                                    class="btn btn-sm text-white"
                                                    style="
                                                        background-color: #0d47a1;
                                                        border-color: #0d47a1;
                                                    "
                                                >

                                                    <i
                                                        class="fas fa-eye mr-1"
                                                    ></i>

                                                    Detail

                                                </a>

                                            </td>


                                        </tr>


                                    <?php endforeach; ?>


                                </tbody>


                            </table>

                        </div>


                    <?php else : ?>


                        <!-- EMPTY STATE -->

                        <div
                            class="text-center py-5"
                        >


                            <i
                                class="fas fa-ticket-alt"
                                style="
                                    font-size: 60px;
                                    color: #b0bec5;
                                "
                            ></i>


                            <h5
                                class="mt-3"
                                style="
                                    color: #17365d;
                                "
                            >

                                Belum Ada Tiket

                            </h5>


                            <p class="text-muted">

                                Anda belum memiliki
                                riwayat pengajuan layanan.

                            </p>


                            <a
                                href="<?= base_url(
                                    'dosen/ticket/create'
                                ) ?>"
                                class="btn text-white"
                                style="
                                    background-color: #f7941d;
                                    border-color: #f7941d;
                                "
                            >

                                <i
                                    class="fas fa-plus-circle mr-1"
                                ></i>

                                Ajukan Layanan

                            </a>


                        </div>


                    <?php endif; ?>


                </div>

            </div>


        </div>

    </section>

</div>

<?= $this->endSection() ?>