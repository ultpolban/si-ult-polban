<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 style="color:#0b3d91;font-weight:700;">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        Detail Tiket
                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dosen/dashboard') ?>">
                                Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dosen/ticket/history') ?>">
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
                 FLASH MESSAGE
            ================================================== -->

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


            <!-- =================================================
                 INFORMASI TIKET
            ================================================== -->

            <div
                class="card shadow-sm border-0 mb-4"
                style="border-radius:15px;overflow:hidden;"
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

                            <small class="text-muted d-block mb-1">
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


                        <div class="col-md-4 text-md-right mt-3 mt-md-0">

                            <?php
                            $status = strtolower(
                                trim(
                                    (string) (
                                        $ticket['status']
                                        ?? ''
                                    )
                                )
                            );
                            ?>


                            <?php if ($status === 'submitted') : ?>

                                <span
                                    class="badge badge-warning p-2"
                                    style="font-size:14px;"
                                >

                                    <i class="fas fa-clock mr-1"></i>

                                    Submitted

                                </span>


                            <?php elseif (
                                $status === 'processed' ||
                                $status === 'diproses' ||
                                $status === 'in_progress'
                            ) : ?>

                                <span
                                    class="badge badge-info p-2"
                                    style="font-size:14px;"
                                >

                                    <i class="fas fa-spinner mr-1"></i>

                                    Diproses

                                </span>


                            <?php elseif (
                                $status === 'completed' ||
                                $status === 'selesai'
                            ) : ?>

                                <span
                                    class="badge badge-success p-2"
                                    style="font-size:14px;"
                                >

                                    <i class="fas fa-check-circle mr-1"></i>

                                    Selesai

                                </span>


                            <?php elseif (
                                $status === 'rejected' ||
                                $status === 'ditolak'
                            ) : ?>

                                <span
                                    class="badge badge-danger p-2"
                                    style="font-size:14px;"
                                >

                                    <i class="fas fa-times-circle mr-1"></i>

                                    Ditolak

                                </span>


                            <?php else : ?>

                                <span
                                    class="badge badge-secondary p-2"
                                    style="font-size:14px;"
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
                 TRACKING PROGRES
            ================================================== -->

            <?php

            $statusTracking = strtolower(
                trim(
                    (string) (
                        $ticket['status']
                        ?? ''
                    )
                )
            );

            $statusMap = [

                'submitted' => 0,

                'verified' => 1,

                'assigned' => 2,

                'processed' => 3,

                'diproses' => 3,

                'in_progress' => 3,

                'completed' => 4,

                'selesai' => 4,

            ];

            $currentStep =
                $statusMap[$statusTracking] ?? 0;

            $isRejected =
                in_array(
                    $statusTracking,
                    [
                        'rejected',
                        'ditolak'
                    ],
                    true
                );

            $trackingSteps = [

                [
                    'label' => 'Diajukan',
                    'icon' => 'fa-paper-plane'
                ],

                [
                    'label' => 'Diverifikasi',
                    'icon' => 'fa-check'
                ],

                [
                    'label' => 'Didisposisi',
                    'icon' => 'fa-share'
                ],

                [
                    'label' => 'Diproses Unit',
                    'icon' => 'fa-cog'
                ],

                [
                    'label' => 'Selesai',
                    'icon' => 'fa-check-circle'
                ],

            ];

            if ($isRejected) {

                $statusTitle =
                    'Ditolak';

                $statusDescription =
                    'Pengajuan tiket tidak dapat dilanjutkan.';

            } else {

                $statusTitle =
                    $trackingSteps[$currentStep]['label']
                    ?? 'Diajukan';

                $statusDescriptions = [

                    'Tiket berhasil diajukan dan menunggu verifikasi.',

                    'Tiket sedang dalam proses verifikasi.',

                    'Tiket telah didisposisikan ke unit terkait.',

                    'Tiket sedang diproses oleh unit terkait.',

                    'Tiket telah selesai diproses.',

                ];

                $statusDescription =
                    $statusDescriptions[$currentStep]
                    ?? 'Tiket sedang diproses.';
            }

            ?>


            <div
                class="card shadow-sm border-0 mb-4"
                style="border-radius:15px;overflow:hidden;"
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


                    <?php if ($isRejected) : ?>

                        <div class="text-center py-3">

                            <div
                                class="mb-3"
                                style="
                                    color:#dc3545;
                                    font-size:36px;
                                "
                            >

                                <i class="fas fa-times-circle"></i>

                            </div>

                            <h5
                                class="font-weight-bold mb-2"
                                style="color:#0b3d91;"
                            >

                                <?= esc($statusTitle) ?>

                            </h5>

                            <p class="text-muted mb-0">

                                <?= esc($statusDescription) ?>

                            </p>

                        </div>


                    <?php else : ?>


                        <div class="ticket-timeline">

                            <?php foreach (
                                $trackingSteps
                                as $index => $step
                            ) : ?>

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
                                        <?= $isCompleted ? 'completed' : '' ?>
                                        <?= $isCurrent ? 'current' : '' ?>
                                        <?= $isPending ? 'pending' : '' ?>
                                    "
                                >

                                    <div class="ticket-step-line"></div>

                                    <div class="ticket-step-icon">

                                        <i
                                            class="
                                                fas
                                                <?= esc($step['icon']) ?>
                                            "
                                        ></i>

                                    </div>

                                    <div class="ticket-step-content">

                                        <h6>
                                            <?= esc($step['label']) ?>
                                        </h6>

                                        <?php if ($isCurrent) : ?>

                                            <small class="text-muted">

                                                <?= esc(
                                                    $statusDescription
                                                ) ?>

                                            </small>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


            <!-- =================================================
                 ROW UTAMA
            ================================================== -->

            <div class="row">


                <!-- =============================================
                     KOLOM KIRI
                ============================================== -->

                <div class="col-lg-8">


                    <!-- =========================================
                         INFORMASI PENGAJUAN
                    ========================================== -->

                    <div
                        class="card shadow-sm mb-4"
                        style="
                            border-radius:15px;
                            border:none;
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-radius:15px 15px 0 0;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-file-alt mr-2"></i>

                                Informasi Pengajuan

                            </h5>

                        </div>


                        <div class="card-body">


                            <!-- JENIS LAYANAN -->

                            <div class="row py-3 border-bottom">

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="fas fa-file-signature text-primary mr-2"
                                    ></i>

                                    Jenis Layanan

                                </div>

                                <div class="col-md-7 text-md-right">

                                    <strong>

                                        <?= esc(
                                            $ticket['service_name']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>

                            </div>


                            <!-- UNIT TUJUAN -->

                            <div class="row py-3 border-bottom">

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="fas fa-building text-primary mr-2"
                                    ></i>

                                    Unit Tujuan

                                </div>

                                <div class="col-md-7 text-md-right">

                                    <strong>

                                        <?= esc(
                                            $ticket['unit_name']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>

                            </div>


                            <!-- TANGGAL -->

                            <div class="row py-3 border-bottom">

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="fas fa-calendar-alt text-primary mr-2"
                                    ></i>

                                    Tanggal Pengajuan

                                </div>

                                <div class="col-md-7 text-md-right">

                                    <strong>

                                        <?php

                                        $dateValue =
                                            $ticket['submitted_at']
                                            ??
                                            $ticket['created_at']
                                            ??
                                            null;

                                        if ($dateValue) {

                                            echo esc(
                                                date(
                                                    'd F Y H:i',
                                                    strtotime(
                                                        $dateValue
                                                    )
                                                )
                                            );

                                        } else {

                                            echo '-';

                                        }

                                        ?>

                                    </strong>

                                </div>

                            </div>


                            <!-- KETERANGAN -->

                            <div class="row py-3">

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="fas fa-comment-alt text-primary mr-2"
                                    ></i>

                                    Keterangan

                                </div>

                                <div class="col-md-7 text-md-right">

                                    <strong>

                                        <?= esc(
                                            $ticket['description']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>

                            </div>


                        </div>

                    </div>


                    <!-- =========================================
                         DOKUMEN
                    ========================================== -->

                    <div
                        class="card shadow-sm mb-4"
                        style="
                            border-radius:15px;
                            border:none;
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-radius:15px 15px 0 0;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-paperclip mr-2"></i>

                                Dokumen Pengajuan

                            </h5>

                        </div>


                        <div class="card-body">


                            <?php if (!empty($documents)) : ?>


                                <div class="table-responsive">

                                    <table
                                        class="table table-bordered table-hover"
                                    >

                                        <thead
                                            style="
                                                background:#e8f1fb;
                                                color:#17365d;
                                            "
                                        >

                                            <tr>

                                                <th style="width:50px;">
                                                    No
                                                </th>

                                                <th>
                                                    Persyaratan
                                                </th>

                                                <th>
                                                    Nama File
                                                </th>

                                                <th style="width:100px;">
                                                    Aksi
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            <?php foreach (
                                                $documents
                                                as $index => $document
                                            ) : ?>

                                                <tr>

                                                    <td>
                                                        <?= $index + 1 ?>
                                                    </td>


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
                                                            class="fas fa-file-alt text-primary mr-1"
                                                        ></i>

                                                        <?= esc(
                                                            $document[
                                                                'original_name'
                                                            ]
                                                            ?? $document[
                                                                'file_name'
                                                            ]
                                                            ?? '-'
                                                        ) ?>

                                                    </td>


                                                    <td>

                                                        <?php
                                                        $filePath =
                                                            $document['file_path']
                                                            ?? '';
                                                        ?>

                                                        <?php if ($filePath) : ?>

                                                            <a
                                                                href="<?= base_url(
                                                                    $filePath
                                                                ) ?>"
                                                                target="_blank"
                                                                class="btn btn-sm btn-primary"
                                                            >

                                                                <i
                                                                    class="fas fa-eye mr-1"
                                                                ></i>

                                                                Lihat

                                                            </a>

                                                        <?php else : ?>

                                                            <span
                                                                class="text-muted"
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


                            <?php else : ?>


                                <div class="text-center py-5">

                                    <i
                                        class="fas fa-file-circle-xmark fa-3x"
                                        style="color:#94a3b8;"
                                    ></i>

                                    <p
                                        class="text-muted mt-3 mb-0"
                                    >
                                        Tidak ada dokumen yang
                                        diunggah.
                                    </p>

                                </div>


                            <?php endif; ?>


                        </div>

                    </div>


                    <!-- =========================================
                         BALASAN
                    ========================================== -->

                    <div
                        class="card shadow-sm mb-4"
                        style="
                            border-radius:15px;
                            border:none;
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-radius:15px 15px 0 0;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-reply mr-2"></i>

                                Balasan Anda

                            </h5>

                        </div>


                        <div class="card-body">


                            <?php if (!empty($ticket['balasan'])) : ?>

                                <div class="alert alert-success mb-3">

                                    <strong>

                                        <i class="fas fa-user mr-1"></i>

                                        Anda

                                    </strong>

                                    <p class="mb-0 mt-2">

                                        <?= esc(
                                            $ticket['balasan']
                                        ) ?>

                                    </p>

                                </div>

                            <?php endif; ?>


                            <form
                                action="<?= base_url(
                                    'dosen/ticket/reply/' .
                                    ($ticket['id'] ?? 0)
                                ) ?>"
                                method="post"
                            >

                                <?= csrf_field() ?>


                                <div class="mb-3">

                                    <label class="form-label">
                                        Tulis Balasan
                                    </label>

                                    <textarea
                                        name="balasan"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Tulis balasan atau tanggapan Anda..."
                                        required
                                    ></textarea>

                                </div>


                                <div class="text-right">

                                    <button
                                        type="submit"
                                        class="btn"
                                        style="
                                            background:#0b3d91;
                                            color:white;
                                            font-weight:600;
                                        "
                                    >

                                        <i
                                            class="fas fa-paper-plane mr-1"
                                        ></i>

                                        Kirim Balasan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>


                <!-- =============================================
                     KOLOM KANAN
                ============================================== -->

                <div class="col-lg-4">


                    <!-- =========================================
                         RIWAYAT STATUS
                    ========================================== -->

                    <div
                        class="card shadow-sm"
                        style="
                            border-radius:15px;
                            border:none;
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-radius:15px 15px 0 0;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-history mr-2"></i>

                                Riwayat Status

                            </h5>

                        </div>


                        <div class="card-body">


                            <div class="timeline">


                                <div class="mb-4">

                                    <div>

                                        <i
                                            class="fas fa-paper-plane text-primary mr-2"
                                        ></i>

                                        <strong>
                                            Pengajuan Dikirim
                                        </strong>

                                    </div>

                                    <small class="text-muted ml-4">

                                        Pengajuan berhasil dikirim
                                        oleh dosen.

                                    </small>

                                </div>


                                <div class="mb-4">

                                    <div>

                                        <i
                                            class="fas fa-check-circle text-secondary mr-2"
                                        ></i>

                                        <strong>
                                            Diverifikasi
                                        </strong>

                                    </div>

                                    <small class="text-muted ml-4">

                                        Pengajuan telah diverifikasi
                                        petugas.

                                    </small>

                                </div>


                                <div class="mb-4">

                                    <div>

                                        <i
                                            class="fas fa-building text-secondary mr-2"
                                        ></i>

                                        <strong>
                                            Diteruskan ke Unit
                                        </strong>

                                    </div>

                                    <small class="text-muted ml-4">

                                        Tiket telah diteruskan ke
                                        unit terkait.

                                    </small>

                                </div>


                                <div class="mb-4">

                                    <div>

                                        <i
                                            class="fas fa-spinner text-secondary mr-2"
                                        ></i>

                                        <strong>
                                            Sedang Diproses
                                        </strong>

                                    </div>

                                    <small class="text-muted ml-4">

                                        Unit sedang memproses
                                        pengajuan.

                                    </small>

                                </div>


                                <div class="mb-4">

                                    <div>

                                        <i
                                            class="fas fa-check text-secondary mr-2"
                                        ></i>

                                        <strong>
                                            Selesai
                                        </strong>

                                    </div>

                                    <small class="text-muted ml-4">

                                        Pengajuan telah selesai
                                        diproses.

                                    </small>

                                </div>


                                <div>

                                    <div>

                                        <i
                                            class="fas fa-lock text-secondary mr-2"
                                        ></i>

                                        <strong>
                                            Ditutup
                                        </strong>

                                    </div>

                                    <small class="text-muted ml-4">

                                        Tiket telah ditutup.

                                    </small>

                                </div>


                            </div>

                        </div>

                    </div>


                    <!-- =========================================
                         BANTUAN
                    ========================================== -->

                    <div
                        class="card mt-4 shadow-sm"
                        style="
                            border-left:4px solid #0b3d91;
                            border-radius:10px;
                        "
                    >

                        <div class="card-body">

                            <h5
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                <i class="fas fa-headset mr-2"></i>

                                Butuh Bantuan?

                            </h5>

                            <p class="text-muted mb-0">

                                Jika ada kendala terkait pengajuan,
                                silakan balas catatan petugas.

                            </p>

                        </div>

                    </div>


                </div>

            </div>


            <!-- =================================================
                 KEMBALI
            ================================================== -->

            <div class="mb-4">

                <a
                    href="<?= base_url(
                        'dosen/ticket/history'
                    ) ?>"
                    class="btn btn-secondary"
                >

                    <i class="fas fa-arrow-left mr-1"></i>

                    Kembali ke Tracking Tiket

                </a>

            </div>


        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>