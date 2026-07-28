<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_mahasiswa') ?>


<div class="content-wrapper">

    <!-- ==========================================
         HEADER
    =========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        ">

                        <i class="fas fa-history"></i>

                        Tracking Tiket

                    </h1>

                </div>

            </div>

        </div>

    </section>


    <!-- ==========================================
         MAIN CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- ==========================================
                 SUCCESS MESSAGE
            =========================================== -->

            <?php if (session()->getFlashdata('success')): ?>

                <div
                    class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle me-2"></i>

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

                </div>

            <?php endif; ?>


            <!-- ==========================================
                 ERROR MESSAGE
            =========================================== -->

            <?php if (session()->getFlashdata('error')): ?>

                <div
                    class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle me-2"></i>

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>

                </div>

            <?php endif; ?>


            <!-- ==========================================
                 CARD TRACKING
            =========================================== -->

            <div class="card shadow-sm">

                <!-- CARD HEADER -->

                <div
                    class="card-header"
                    style="
                        background:#0b3d91;
                        color:white;
                    ">

                    <h3 class="card-title">

                        <i class="fas fa-ticket-alt me-2"></i>

                        Riwayat Pengajuan Layanan

                    </h3>

                </div>


                <!-- CARD BODY -->

                <div class="card-body">


                    <?php if (!empty($tickets)): ?>


                        <!-- ==========================================
                             TABLE
                        =========================================== -->

                        <div class="table-responsive">

                            <table
                                class="
                                    table
                                    table-bordered
                                    table-hover
                                    align-middle
                                ">

                                <thead
                                    style="
                                        background:#0b3d91;
                                        color:white;
                                    ">

                                    <tr>

                                        <th
                                            class="text-center"
                                            style="width:60px;">

                                            No

                                        </th>

                                        <th>

                                            Nomor Tiket

                                        </th>

                                        <th>

                                            Layanan

                                        </th>

                                        <th>

                                            Unit Tujuan

                                        </th>

                                        <th>

                                            Tanggal

                                        </th>

                                        <th
                                            class="text-center">

                                            Status

                                        </th>

                                        <th
                                            class="text-center"
                                            style="width:120px;">

                                            Aksi

                                        </th>

                                    </tr>

                                </thead>


                                <tbody>


                                    <?php foreach (
                                        $tickets
                                        as $index => $ticket
                                    ): ?>


                                        <tr>


                                            <!-- NO -->

                                            <td
                                                class="text-center">

                                                <?= $index + 1 ?>

                                            </td>


                                            <!-- NOMOR TIKET -->

                                            <td>

                                                <strong
                                                    style="
                                                        color:#0b3d91;
                                                    ">

                                                    <?= esc(
                                                        $ticket['nomor']
                                                            ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>


                                            <!-- LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket['layanan']
                                                        ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- UNIT -->

                                            <td>

                                                <?= esc(
                                                    $ticket['unit']
                                                        ?? 'Akademik'
                                                ) ?>

                                            </td>


                                            <!-- TANGGAL -->

                                            <td>

                                                <?= esc(
                                                    $ticket['tanggal']
                                                        ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- STATUS -->

                                            <td
                                                class="text-center">

                                                <?php

                                                $status =
                                                    $ticket['status']
                                                    ?? 'Submitted';

                                                ?>


                                                <?php if (
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'completed'
                                                ): ?>


                                                    <span
                                                        class="
                                                            badge
                                                            bg-success
                                                        ">

                                                        <i
                                                            class="
                                                                fas
                                                                fa-check-circle
                                                            "></i>

                                                        Selesai

                                                    </span>


                                                <?php elseif (
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'in progress'
                                                ): ?>


                                                    <span
                                                        class="
                                                            badge
                                                            bg-warning
                                                            text-dark
                                                        ">

                                                        <i
                                                            class="
                                                                fas
                                                                fa-spinner
                                                            "></i>

                                                        Diproses

                                                    </span>


                                                <?php elseif (
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'revisi'
                                                ): ?>


                                                    <span
                                                        class="
                                                            badge
                                                            bg-danger
                                                        ">

                                                        <i
                                                            class="
                                                                fas
                                                                fa-exclamation-circle
                                                            "></i>

                                                        Perlu Revisi

                                                    </span>


                                                <?php else: ?>


                                                    <span
                                                        class="
                                                            badge
                                                            bg-primary
                                                        ">

                                                        <i
                                                            class="
                                                                fas
                                                                fa-paper-plane
                                                            "></i>

                                                        <?= esc(
                                                            $status
                                                        ) ?>

                                                    </span>


                                                <?php endif; ?>


                                            </td>


                                            <!-- AKSI -->

                                            <td
                                                class="text-center">

                                                <a
                                                    href="<?= base_url(
                                                                'mahasiswa/ticket/detail/' .
                                                                    $index
                                                            ) ?>"
                                                    class="
                                                        btn
                                                        btn-sm
                                                        btn-info
                                                    ">

                                                    <i
                                                        class="
                                                            fas
                                                            fa-eye
                                                        "></i>

                                                    Detail

                                                </a>

                                            </td>


                                        </tr>


                                    <?php endforeach; ?>


                                </tbody>

                            </table>

                        </div>


                    <?php else: ?>


                        <!-- ==========================================
                             EMPTY STATE
                        =========================================== -->

                        <div
                            class="text-center py-5">

                            <div
                                style="
                                    width:90px;
                                    height:90px;
                                    background:#eef5ff;
                                    border-radius:50%;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    margin:0 auto 20px;
                                ">

                                <i
                                    class="
                                        fas
                                        fa-ticket-alt
                                    "
                                    style="
                                        font-size:40px;
                                        color:#0b3d91;
                                    "></i>

                            </div>


                            <h4
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                ">

                                Belum Ada Pengajuan

                            </h4>


                            <p
                                class="text-muted">

                                Anda belum memiliki tiket pengajuan layanan.

                                <br>

                                Silakan ajukan layanan untuk melihat
                                tiket Anda di halaman ini.

                            </p>


                            <a
                                href="<?= base_url(
                                            'mahasiswa/ticket/create'
                                        ) ?>"
                                class="btn"
                                style="
                                    background:#f28c28;
                                    color:white;
                                    font-weight:600;
                                ">

                                <i
                                    class="
                                        fas
                                        fa-plus-circle
                                    "></i>

                                Ajukan Layanan

                            </a>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


            <!-- ==========================================
                 BUTTON KEMBALI
            =========================================== -->

            <div class="mt-3">

                <a
    href="<?= base_url('dashboard-mahasiswa') ?>"
    class="btn btn-secondary"
>
    <i class="fas fa-arrow-left"></i>

    Kembali ke Dashboard
</a>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>