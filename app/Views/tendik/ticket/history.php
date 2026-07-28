<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>


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
                        "
                    >

                        <i class="fas fa-ticket-alt"></i>

                        Tracking Tiket

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('tendik/dashboard') ?>">

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


            <!-- SUCCESS -->
            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('success')) ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- ERROR -->
            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

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
                        background-color:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-history mr-2"></i>

                        Riwayat Pengajuan Layanan

                    </h5>

                </div>


                <!-- CARD BODY -->
                <div class="card-body">


                    <?php if (!empty($tickets)) : ?>


                        <div class="table-responsive">

                            <table
                                class="
                                    table
                                    table-bordered
                                    table-hover
                                    align-middle
                                "
                            >

                                <thead
                                    style="
                                        background-color:#e8f1fb;
                                        color:#17365d;
                                    "
                                >

                                    <tr>

                                        <th>No</th>

                                        <th>Nomor Tiket</th>

                                        <th>Unit Tujuan</th>

                                        <th>Jenis Layanan</th>

                                        <th>Judul</th>

                                        <th>Tanggal</th>

                                        <th>Status</th>

                                        <th>Aksi</th>

                                    </tr>

                                </thead>


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

                                                <strong>

                                                    <?= esc(
                                                        $ticket['nomor_tiket']
                                                        ?? $ticket['nomor']
                                                        ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>


                                            <!-- UNIT -->
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
                                                    ?? $ticket['layanan']
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


                                            <!-- TANGGAL -->
                                            <td>

                                                <?= esc(
                                                    $ticket['created_at']
                                                    ?? $ticket['tanggal']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- STATUS -->
                                            <td>

                                                <?php
                                                $status =
                                                    $ticket['status']
                                                    ?? 'Submitted';

                                                $badgeClass = 'badge-primary';

                                                if (
                                                    strtolower($status)
                                                    === 'completed'
                                                    ||
                                                    strtolower($status)
                                                    === 'selesai'
                                                ) {
                                                    $badgeClass =
                                                        'badge-success';
                                                }

                                                elseif (
                                                    strtolower($status)
                                                    === 'in progress'
                                                    ||
                                                    strtolower($status)
                                                    === 'diproses'
                                                ) {
                                                    $badgeClass =
                                                        'badge-warning';
                                                }

                                                elseif (
                                                    strtolower($status)
                                                    === 'revision'
                                                    ||
                                                    strtolower($status)
                                                    === 'revisi'
                                                ) {
                                                    $badgeClass =
                                                        'badge-danger';
                                                }
                                                ?>

                                                <span
                                                    class="
                                                        badge
                                                        <?= $badgeClass ?>
                                                    "
                                                >

                                                    <?= esc($status) ?>

                                                </span>

                                            </td>


                                            <!-- AKSI -->
                                            <td>

                                                <a
                                                    href="<?= base_url(
                                                        'tendik/ticket/detail/' .
                                                        ($ticket['id'] ?? $index)
                                                    ) ?>"
                                                    class="
                                                        btn
                                                        btn-sm
                                                        btn-info
                                                    "
                                                >

                                                    <i
                                                        class="
                                                            fas
                                                            fa-eye
                                                        "
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
                            class="
                                text-center
                                py-5
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-ticket-alt
                                    fa-3x
                                    mb-3
                                "
                                style="
                                    color:#b0bec5;
                                "
                            ></i>


                            <h5
                                style="
                                    color:#17365d;
                                "
                            >

                                Belum Ada Tiket

                            </h5>


                            <p class="text-muted">

                                Anda belum memiliki
                                pengajuan layanan.

                            </p>


                            <a
                                href="<?= base_url(
                                    'tendik/ticket/create'
                                ) ?>"
                                class="
                                    btn
                                    text-white
                                "
                                style="
                                    background-color:#f28c28;
                                    border-color:#f28c28;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-plus-circle
                                        mr-1
                                    "
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


<?= $this->include('layouts/footer') ?>