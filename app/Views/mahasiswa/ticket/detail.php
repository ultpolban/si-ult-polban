<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->

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

                        <i class="fas fa-ticket-alt mr-2"></i>

                        Detail Tiket

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dashboard-mahasiswa') ?>">

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('mahasiswa/ticket/history') ?>">

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


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- =================================================
                 NOMOR TIKET
            ================================================== -->

            <div
                class="card shadow-sm border-0 mb-4"
                style="
                    border-radius:15px;
                    overflow:hidden;
                "
            >

                <div
                    class="card-header text-white"
                    style="
                        background:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-ticket-alt mr-2"></i>

                        Informasi Tiket

                    </h5>

                </div>


                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <small
                                class="text-muted d-block mb-1"
                            >

                                Nomor Tiket

                            </small>

                            <h3
                                class="mb-0"
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                <?= esc(
                                    $ticket['ticket_number']
                                    ?? '-'
                                ) ?>

                            </h3>

                        </div>


                        <div
                            class="
                                col-md-4
                                text-md-right
                                mt-3
                                mt-md-0
                            "
                        >

                            <?php
                            $status = strtolower(
                                trim(
                                    $ticket['status']
                                    ?? ''
                                )
                            );
                            ?>


                            <?php if ($status === 'submitted'): ?>

                                <span
                                    class="
                                        badge
                                        badge-warning
                                        p-2
                                    "
                                    style="
                                        font-size:14px;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-clock
                                            mr-1
                                        "
                                    ></i>

                                    Submitted

                                </span>


                            <?php elseif (
                                $status === 'processed'
                                ||
                                $status === 'diproses'
                            ): ?>

                                <span
                                    class="
                                        badge
                                        badge-info
                                        p-2
                                    "
                                    style="
                                        font-size:14px;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-spinner
                                            mr-1
                                        "
                                    ></i>

                                    Diproses

                                </span>


                            <?php elseif (
                                $status === 'completed'
                                ||
                                $status === 'selesai'
                            ): ?>

                                <span
                                    class="
                                        badge
                                        badge-success
                                        p-2
                                    "
                                    style="
                                        font-size:14px;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-check-circle
                                            mr-1
                                        "
                                    ></i>

                                    Selesai

                                </span>


                            <?php elseif (
                                $status === 'rejected'
                                ||
                                $status === 'ditolak'
                            ): ?>

                                <span
                                    class="
                                        badge
                                        badge-danger
                                        p-2
                                    "
                                    style="
                                        font-size:14px;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-times-circle
                                            mr-1
                                        "
                                    ></i>

                                    Ditolak

                                </span>


                            <?php else: ?>

                                <span
                                    class="
                                        badge
                                        badge-secondary
                                        p-2
                                    "
                                    style="
                                        font-size:14px;
                                    "
                                >

                                    <?= esc(
                                        $ticket['status']
                                        ?? '-'
                                    ) ?>

                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 DETAIL PENGAJUAN
            ================================================== -->

            <div
                class="card shadow-sm border-0 mb-4"
                style="
                    border-radius:15px;
                    overflow:hidden;
                "
            >

                <div
                    class="card-header text-white"
                    style="
                        background:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-info-circle mr-2"></i>

                        Detail Pengajuan

                    </h5>

                </div>


                <div class="card-body">

                    <div class="row">


                        <!-- UNIT LAYANAN -->

                        <div class="col-md-6 mb-4">

                            <div
                                class="p-3"
                                style="
                                    background:#f8f9fa;
                                    border-radius:10px;
                                    height:100%;
                                "
                            >

                                <small
                                    class="
                                        text-muted
                                        d-block
                                        mb-1
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-building
                                            mr-1
                                        "
                                    ></i>

                                    Unit Layanan

                                </small>

                                <strong
                                    style="
                                        color:#17365d;
                                        font-size:16px;
                                    "
                                >

                                    <?= esc(
                                        $ticket['unit_name']
                                        ?? '-'
                                    ) ?>

                                </strong>

                            </div>

                        </div>



                        <!-- JENIS LAYANAN -->

                        <div class="col-md-6 mb-4">

                            <div
                                class="p-3"
                                style="
                                    background:#f8f9fa;
                                    border-radius:10px;
                                    height:100%;
                                "
                            >

                                <small
                                    class="
                                        text-muted
                                        d-block
                                        mb-1
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-list-alt
                                            mr-1
                                        "
                                    ></i>

                                    Jenis Layanan

                                </small>

                                <strong
                                    style="
                                        color:#17365d;
                                        font-size:16px;
                                    "
                                >

                                    <?= esc(
                                        $ticket['service_name']
                                        ?? '-'
                                    ) ?>

                                </strong>

                            </div>

                        </div>



                        <!-- TANGGAL -->

                        <div class="col-md-6 mb-4">

                            <div
                                class="p-3"
                                style="
                                    background:#f8f9fa;
                                    border-radius:10px;
                                    height:100%;
                                "
                            >

                                <small
                                    class="
                                        text-muted
                                        d-block
                                        mb-1
                                    "
                                >

                                    <i
                                        class="
                                            far
                                            fa-calendar-alt
                                            mr-1
                                        "
                                    ></i>

                                    Tanggal Pengajuan

                                </small>

                                <strong
                                    style="
                                        color:#17365d;
                                        font-size:16px;
                                    "
                                >

                                    <?php
                                    if (
                                        !empty(
                                            $ticket['submitted_at']
                                        )
                                    ) {
                                        echo date(
                                            'd F Y',
                                            strtotime(
                                                $ticket['submitted_at']
                                            )
                                        );
                                    } elseif (
                                        !empty(
                                            $ticket['created_at']
                                        )
                                    ) {
                                        echo date(
                                            'd F Y',
                                            strtotime(
                                                $ticket['created_at']
                                            )
                                        );
                                    } else {
                                        echo '-';
                                    }
                                    ?>

                                </strong>

                            </div>

                        </div>



                        <!-- WAKTU -->

                        <div class="col-md-6 mb-4">

                            <div
                                class="p-3"
                                style="
                                    background:#f8f9fa;
                                    border-radius:10px;
                                    height:100%;
                                "
                            >

                                <small
                                    class="
                                        text-muted
                                        d-block
                                        mb-1
                                    "
                                >

                                    <i
                                        class="
                                            far
                                            fa-clock
                                            mr-1
                                        "
                                    ></i>

                                    Waktu Pengajuan

                                </small>

                                <strong
                                    style="
                                        color:#17365d;
                                        font-size:16px;
                                    "
                                >

                                    <?php
                                    if (
                                        !empty(
                                            $ticket['submitted_at']
                                        )
                                    ) {
                                        echo date(
                                            'H:i',
                                            strtotime(
                                                $ticket['submitted_at']
                                            )
                                        );
                                        echo ' WIB';
                                    } else {
                                        echo '-';
                                    }
                                    ?>

                                </strong>

                            </div>

                        </div>


                    </div>


                    <!-- =================================================
                         KETERANGAN
                    ================================================== -->

                    <div class="mt-2">

                        <label
                            class="font-weight-bold"
                            style="
                                color:#17365d;
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-comment-alt
                                    mr-1
                                "
                            ></i>

                            Keterangan Pengajuan

                        </label>


                        <div
                            class="p-3"
                            style="
                                background:#f8f9fa;
                                border-radius:10px;
                                min-height:100px;
                            "
                        >

                            <?php if (
                                !empty(
                                    $ticket['description']
                                )
                            ): ?>

                                <?= nl2br(
                                    esc(
                                        $ticket['description']
                                    )
                                ) ?>

                            <?php else: ?>

                                <span class="text-muted">

                                    Tidak ada keterangan.

                                </span>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>



            <!-- =================================================
                 DOKUMEN
            ================================================== -->

            <div
                class="card shadow-sm border-0 mb-4"
                style="
                    border-radius:15px;
                    overflow:hidden;
                "
            >

                <div
                    class="card-header text-white"
                    style="
                        background:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-paperclip mr-2"></i>

                        Dokumen Persyaratan

                    </h5>

                </div>


                <div class="card-body">


                    <?php if (
                        !empty($documents)
                    ): ?>


                        <div class="table-responsive">

                            <table
                                class="
                                    table
                                    table-bordered
                                    table-hover
                                    mb-0
                                "
                            >

                                <thead
                                    style="
                                        background:#e8f1fb;
                                        color:#17365d;
                                    "
                                >

                                    <tr>

                                        <th>
                                            Persyaratan
                                        </th>

                                        <th>
                                            Nama Dokumen
                                        </th>

                                        <th
                                            style="
                                                width:120px;
                                            "
                                        >
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    <?php foreach (
                                        $documents
                                        as $document
                                    ): ?>

                                        <tr>

                                            <td>

                                                <?= esc(
                                                    $document[
                                                        'requirement_name'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <td>

                                                <i
                                                    class="
                                                        fas
                                                        fa-file-alt
                                                        mr-1
                                                        text-primary
                                                    "
                                                ></i>

                                                <?= esc(
                                                    $document[
                                                        'original_name'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <td>

                                                <?php if (
                                                    !empty(
                                                        $document[
                                                            'file_path'
                                                        ]
                                                    )
                                                ): ?>

                                                    <a
                                                        href="<?= base_url(
                                                            $document[
                                                                'file_path'
                                                            ]
                                                        ) ?>"
                                                        target="_blank"
                                                        class="
                                                            btn
                                                            btn-sm
                                                            btn-primary
                                                        "
                                                    >

                                                        <i
                                                            class="
                                                                fas
                                                                fa-eye
                                                                mr-1
                                                            "
                                                        ></i>

                                                        Lihat

                                                    </a>

                                                <?php else: ?>

                                                    <span
                                                        class="
                                                            text-muted
                                                        "
                                                    >

                                                        -

                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>


                    <?php else: ?>

                        <div
                            class="
                                alert
                                alert-info
                                mb-0
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-info-circle
                                    mr-2
                                "
                            ></i>

                            Belum ada dokumen yang diunggah.

                        </div>

                    <?php endif; ?>


                </div>

            </div>



            <!-- =================================================
                 TOMBOL
            ================================================== -->

            <div
                class="card shadow-sm border-0 mb-5"
                style="
                    border-radius:15px;
                "
            >

                <div class="card-body">

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-center
                            flex-wrap
                        "
                    >

                        <a
                            href="<?= base_url(
                                'mahasiswa/ticket/history'
                            ) ?>"
                            class="
                                btn
                                btn-secondary
                                mb-2
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-arrow-left
                                    mr-1
                                "
                            ></i>

                            Kembali ke Tracking

                        </a>


                        <a
                            href="<?= base_url(
                                'dashboard-mahasiswa'
                            ) ?>"
                            class="
                                btn
                                text-white
                                mb-2
                            "
                            style="
                                background:#f28c28;
                                border-color:#f28c28;
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-home
                                    mr-1
                                "
                            ></i>

                            Dashboard

                        </a>

                    </div>

                </div>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>