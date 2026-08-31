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
                 TRACKING PROGRES TIKET
            ================================================== -->

            <?php
            /*
             * Mapping status tiket ke tahapan tracking.
             *
             * 0 = Submitted
             * 1 = Verified
             * 2 = Assigned
             * 3 = Processed
             * 4 = Completed
             */

            $statusTracking = strtolower(
                trim($ticket['status'] ?? '')
            );

            $statusMap = [
                'submitted'   => 0,
                'verified'    => 1,
                'assigned'    => 2,
                'processed'   => 3,
                'diproses'    => 3,
                'in_progress' => 3,
                'completed'   => 4,
                'selesai'     => 4,
            ];

            $currentStep = $statusMap[$statusTracking] ?? 0;

            $isRejected = in_array(
                $statusTracking,
                ['rejected', 'ditolak'],
                true
            );

            $trackingSteps = [
                [
                    'label' => 'Diajukan',
                    'icon'  => 'fa-paper-plane',
                ],
                [
                    'label' => 'Diverifikasi',
                    'icon'  => 'fa-check',
                ],
                [
                    'label' => 'Didisposisi',
                    'icon'  => 'fa-share',
                ],
                [
                    'label' => 'Diproses Unit',
                    'icon'  => 'fa-cog',
                ],
                [
                    'label' => 'Selesai',
                    'icon'  => 'fa-check-circle',
                ],
            ];

            if ($isRejected) {
                $statusTitle = 'Ditolak';
                $statusDescription =
                    'Pengajuan tiket tidak dapat dilanjutkan.';
            } else {
                $statusTitle = $trackingSteps[$currentStep]['label'];

                $statusDescriptions = [
                    'Tiket berhasil diajukan dan menunggu verifikasi.',
                    'Tiket sedang dalam proses verifikasi.',
                    'Tiket telah didisposisikan ke unit terkait.',
                    'Tiket sedang diproses oleh unit terkait.',
                    'Tiket telah selesai diproses.',
                ];

                $statusDescription =
                    $statusDescriptions[$currentStep];
            }
            ?>


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

                        <i class="fas fa-route mr-2"></i>

                        Tracking Progres Tiket

                    </h5>

                </div>


                <div class="card-body">

                    <?php if ($isRejected): ?>

                        <div
                            class="text-center py-3"
                        >

                            <div
                                class="mb-3"
                                style="
                                    color:#0b3d91;
                                    font-size:36px;
                                "
                            >

                                <i class="fas fa-times-circle"></i>

                            </div>

                            <h5
                                class="font-weight-bold mb-2"
                                style="
                                    color:#0b3d91;
                                "
                            >

                                <?= esc($statusTitle) ?>

                            </h5>

                            <p
                                class="text-muted mb-0"
                            >

                                <?= esc($statusDescription) ?>

                            </p>

                        </div>

                    <?php else: ?>

                        <!-- TIMELINE -->

                        <div
                            class="ticket-timeline"
                        >

                            <?php foreach (
                                $trackingSteps
                                as $index => $step
                            ): ?>

                                <?php
                                $isCompleted =
                                    $index < $currentStep;

                                $isCurrent =
                                    $index === $currentStep;

                                $isPending =
                                    $index > $currentStep;
                                ?>

                                <div
                                    class="
                                        ticket-step
                                        <?= $isCompleted
                                            ? 'completed'
                                            : '' ?>
                                        <?= $isCurrent
                                            ? 'current'
                                            : '' ?>
                                        <?= $isPending
                                            ? 'pending'
                                            : '' ?>
                                    "
                                >

                                    <div
                                        class="ticket-step-line"
                                    ></div>


                                    <div
                                        class="ticket-step-icon"
                                    >

                                        <i
                                            class="
                                                fas
                                                <?= esc(
                                                    $step['icon']
                                                ) ?>
                                            "
                                        ></i>

                                    </div>


                                    <div
                                        class="ticket-step-label"
                                    >

                                        <?= esc(
                                            $step['label']
                                        ) ?>


                                        <?php if (
                                            $isCurrent
                                        ): ?>

                                            <span
                                                class="
                                                    d-block
                                                    mt-1
                                                    small
                                                    font-weight-normal
                                                "
                                            >

                                                Status saat ini

                                            </span>

                                        <?php elseif (
                                            $isCompleted
                                        ): ?>

                                            <span
                                                class="
                                                    d-block
                                                    mt-1
                                                    small
                                                    font-weight-normal
                                                "
                                            >

                                                Selesai

                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="
                                                    d-block
                                                    mt-1
                                                    small
                                                    font-weight-normal
                                                "
                                            >

                                                Menunggu

                                            </span>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>


                        <!-- STATUS SAAT INI -->

                        <div
                            class="mt-4 p-3"
                            style="
                                background:#f8f9fa;
                                border-left:4px solid #0b3d91;
                                border-radius:8px;
                            "
                        >

                            <div
                                class="font-weight-bold mb-1"
                                style="
                                    color:#0b3d91;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-info-circle
                                        mr-1
                                    "
                                ></i>

                                Status Tiket:
                                <?= esc($statusTitle) ?>

                            </div>


                            <div
                                class="text-muted"
                            >

                                <?= esc(
                                    $statusDescription
                                ) ?>

                            </div>

                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <style>

                .ticket-timeline {
                    display: flex;
                    align-items: flex-start;
                    justify-content: space-between;
                    position: relative;
                    padding: 10px 0 0;
                }

                .ticket-step {
                    flex: 1;
                    position: relative;
                    text-align: center;
                    min-width: 0;
                }

                .ticket-step-line {
                    position: absolute;
                    top: 19px;
                    left: 50%;
                    width: 100%;
                    height: 2px;
                    background: #dee2e6;
                    z-index: 1;
                }

                .ticket-step:last-child
                .ticket-step-line {
                    display: none;
                }

                .ticket-step-icon {
                    width: 40px;
                    height: 40px;
                    margin: 0 auto;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    position: relative;
                    z-index: 2;
                    background: #ffffff;
                    border: 2px solid #dee2e6;
                    color: #adb5bd;
                    transition: all .2s ease;
                }

                .ticket-step-label {
                    margin-top: 10px;
                    font-size: 14px;
                    font-weight: 600;
                    color: #adb5bd;
                }

                .ticket-step-label small {
                    color: #adb5bd;
                }

                /* Tahapan yang sudah selesai */

                .ticket-step.completed
                .ticket-step-icon {
                    background: #0b3d91;
                    border-color: #0b3d91;
                    color: #ffffff;
                }

                .ticket-step.completed
                .ticket-step-line {
                    background: #0b3d91;
                }

                .ticket-step.completed
                .ticket-step-label {
                    color: #17365d;
                }

                /* Status sekarang */

                .ticket-step.current
                .ticket-step-icon {
                    background: #ffffff;
                    border: 3px solid #0b3d91;
                    color: #0b3d91;
                    box-shadow:
                        0 0 0 4px rgba(11, 61, 145, .10);
                }

                .ticket-step.current
                .ticket-step-label {
                    color: #0b3d91;
                    font-weight: 700;
                }

                /* Mobile */

                @media (max-width: 767.98px) {

                    .ticket-timeline {
                        overflow-x: auto;
                        justify-content: flex-start;
                        padding-bottom: 10px;
                    }

                    .ticket-step {
                        min-width: 125px;
                    }

                    .ticket-step-label {
                        font-size: 12px;
                    }

                }

            </style>

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