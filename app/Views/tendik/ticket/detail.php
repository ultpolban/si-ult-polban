<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>


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
                        "
                    >

                        <i class="fas fa-ticket-alt"></i>

                        Detail Tiket

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url('tendik/dashboard') ?>"
                            >

                                Dashboard

                            </a>

                        </li>


                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url('tendik/ticket/history') ?>"
                            >

                                Tracking Tiket

                            </a>

                        </li>


                        <li class="breadcrumb-item active">

                            Detail Tiket

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>



    <!-- ==========================================
         CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- SUCCESS MESSAGE -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div
                    class="
                        alert
                        alert-success
                        alert-dismissible
                        fade
                        show
                    "
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



            <!-- ERROR MESSAGE -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div
                    class="
                        alert
                        alert-danger
                        alert-dismissible
                        fade
                        show
                    "
                >

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc(
                        session()->getFlashdata('error')
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



            <div class="row">


                <!-- ==========================================
                     INFORMASI TIKET
                =========================================== -->

                <div class="col-lg-8">


                    <div class="card shadow-sm border-0">


                        <!-- HEADER -->

                        <div
                            class="card-header text-white"
                            style="
                                background:#0b3d91;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i
                                    class="
                                        fas
                                        fa-info-circle
                                        mr-2
                                    "
                                ></i>

                                Informasi Pengajuan

                            </h5>

                        </div>



                        <!-- BODY -->

                        <div class="card-body">


                            <!-- NOMOR TIKET -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Nomor Tiket

                                    </strong>

                                </div>


                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $ticket['nomor_tiket']
                                        ??
                                        $ticket['nomor']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>



                            <!-- UNIT TUJUAN -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Unit Tujuan

                                    </strong>

                                </div>


                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $ticket['unit_tujuan']
                                        ??
                                        $ticket['unit']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>



                            <!-- JENIS LAYANAN -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Jenis Layanan

                                    </strong>

                                </div>


                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $ticket['jenis_layanan']
                                        ??
                                        $ticket['layanan']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>



                            <!-- JUDUL -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Judul

                                    </strong>

                                </div>


                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $ticket['judul']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>



                            <!-- TANGGAL -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Tanggal Pengajuan

                                    </strong>

                                </div>


                                <div class="col-md-8">

                                    :

                                    <?= esc(
                                        $ticket['created_at']
                                        ??
                                        $ticket['tanggal']
                                        ??
                                        '-'
                                    ) ?>

                                </div>

                            </div>



                            <!-- STATUS -->

                            <div class="row mb-3">

                                <div class="col-md-4">

                                    <strong>

                                        Status

                                    </strong>

                                </div>


                                <div class="col-md-8">

                                    :

                                    <?php
                                    $status =
                                        $ticket['status']
                                        ??
                                        'Submitted';

                                    $badgeClass =
                                        'badge-primary';

                                    if (
                                        strtolower($status)
                                        === 'completed'
                                        ||
                                        strtolower($status)
                                        === 'selesai'
                                    ) {

                                        $badgeClass =
                                            'badge-success';

                                    } elseif (
                                        strtolower($status)
                                        === 'in progress'
                                        ||
                                        strtolower($status)
                                        === 'diproses'
                                    ) {

                                        $badgeClass =
                                            'badge-warning';

                                    } elseif (
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

                                        <?= esc(
                                            $status
                                        ) ?>

                                    </span>

                                </div>

                            </div>



                            <hr>



                            <!-- KETERANGAN -->

                            <div class="mb-3">

                                <strong>

                                    Keterangan Pengajuan

                                </strong>


                                <div
                                    class="
                                        mt-2
                                        p-3
                                        rounded
                                    "
                                    style="
                                        background:#f5f7fa;
                                    "
                                >

                                    <?= nl2br(
                                        esc(
                                            $ticket['keterangan']
                                            ??
                                            '-'
                                        )
                                    ) ?>

                                </div>

                            </div>


                        </div>

                    </div>



                    <!-- ==========================================
                         CATATAN PETUGAS
                    =========================================== -->

                    <div class="card shadow-sm border-0 mt-4">


                        <div
                            class="card-header"
                            style="
                                background:#fff3cd;
                                color:#856404;
                                border-bottom:3px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i
                                    class="
                                        fas
                                        fa-comment-alt
                                        mr-2
                                    "
                                ></i>

                                Catatan Petugas

                            </h5>

                        </div>


                        <div class="card-body">


                            <?php if (
                                !empty(
                                    $ticket['catatan_petugas']
                                    ??
                                    null
                                )
                            ) : ?>


                                <div
                                    class="
                                        alert
                                        alert-warning
                                        mb-0
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-exclamation-circle
                                            mr-2
                                        "
                                    ></i>

                                    <?= nl2br(
                                        esc(
                                            $ticket[
                                                'catatan_petugas'
                                            ]
                                        )
                                    ) ?>

                                </div>


                            <?php else : ?>


                                <div
                                    class="
                                        text-center
                                        text-muted
                                        py-3
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-comment-slash
                                            fa-2x
                                            mb-2
                                        "
                                    ></i>

                                    <p class="mb-0">

                                        Belum ada catatan
                                        dari petugas.

                                    </p>

                                </div>


                            <?php endif; ?>


                        </div>

                    </div>



                    <!-- ==========================================
                         BALASAN TENDIK
                    =========================================== -->

                    <div class="card shadow-sm border-0 mt-4">


                        <div
                            class="card-header"
                            style="
                                background:#e8f1fb;
                                color:#0b3d91;
                                border-bottom:3px solid #0b3d91;
                            "
                        >

                            <h5 class="mb-0">

                                <i
                                    class="
                                        fas
                                        fa-reply
                                        mr-2
                                    "
                                ></i>

                                Balasan Anda

                            </h5>

                        </div>


                        <div class="card-body">


                            <?php if (
                                !empty(
                                    $ticket['balasan']
                                    ??
                                    null
                                )
                            ) : ?>


                                <div
                                    class="
                                        alert
                                        alert-info
                                    "
                                >

                                    <strong>

                                        <i
                                            class="
                                                fas
                                                fa-user
                                                mr-1
                                            "
                                        ></i>

                                        Balasan Tendik:

                                    </strong>


                                    <hr>


                                    <?= nl2br(
                                        esc(
                                            $ticket['balasan']
                                        )
                                    ) ?>

                                </div>


                            <?php endif; ?>



                            <!-- FORM BALASAN -->

                            <form
                                action="<?= base_url(
                                    'tendik/ticket/reply/' .
                                    ($ticket['id'] ?? 0)
                                ) ?>"
                                method="post"
                            >

                                <?= csrf_field() ?>


                                <div class="form-group">

                                    <label
                                        for="balasan"
                                    >

                                        <strong>

                                            Tulis Balasan

                                        </strong>

                                    </label>


                                    <textarea
                                        name="balasan"
                                        id="balasan"
                                        rows="5"
                                        class="form-control"
                                        placeholder="Tulis balasan atau tanggapan Anda terhadap catatan petugas..."
                                    ></textarea>

                                </div>


                                <button
                                    type="submit"
                                    class="btn text-white"
                                    style="
                                        background:#0b3d91;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-paper-plane
                                            mr-1
                                        "
                                    ></i>

                                    Kirim Balasan

                                </button>


                            </form>


                        </div>

                    </div>


                </div>



                <!-- ==========================================
                     SIDEBAR DETAIL
                =========================================== -->

                <div class="col-lg-4">


                    <!-- STATUS CARD -->

                    <div class="card shadow-sm border-0">


                        <div
                            class="card-header text-white"
                            style="
                                background:#f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i
                                    class="
                                        fas
                                        fa-tasks
                                        mr-2
                                    "
                                ></i>

                                Status Pengajuan

                            </h5>

                        </div>


                        <div class="card-body text-center">


                            <i
                                class="
                                    fas
                                    fa-ticket-alt
                                    fa-3x
                                    mb-3
                                "
                                style="
                                    color:#0b3d91;
                                "
                            ></i>


                            <h5>

                                <?= esc(
                                    $ticket['nomor_tiket']
                                    ??
                                    $ticket['nomor']
                                    ??
                                    '-'
                                ) ?>

                            </h5>


                            <p class="text-muted">

                                Status saat ini

                            </p>


                            <span
                                class="
                                    badge
                                    <?= $badgeClass ?>
                                "
                                style="
                                    font-size:15px;
                                    padding:8px 15px;
                                "
                            >

                                <?= esc(
                                    $status
                                ) ?>

                            </span>


                        </div>

                    </div>



                    <!-- BUTTON KEMBALI -->

                    <div class="card shadow-sm border-0 mt-4">


                        <div class="card-body">


                            <a
                                href="<?= base_url(
                                    'tendik/ticket/history'
                                ) ?>"
                                class="
                                    btn
                                    btn-secondary
                                    btn-block
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-arrow-left
                                        mr-1
                                    "
                                ></i>

                                Kembali ke Tracking Tiket

                            </a>


                        </div>

                    </div>


                </div>


            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>