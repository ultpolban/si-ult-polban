<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>

<?php

    // =====================================================
    // DATA TIKET
    // =====================================================

    $ticketNumber = $ticket['ticket_number'] ?? '-';

    $serviceName = $ticket['service_name'] ?? '-';

    $status = $ticket['status'] ?? 'submitted';

    $createdAt =
        $ticket['created_at']
        ?? $ticket['submitted_at']
        ?? null;


    // =====================================================
    // FORMAT TANGGAL
    // =====================================================

    $formattedDate = '-';

    if (!empty($createdAt)) {

        $timestamp = strtotime($createdAt);

        if ($timestamp) {

            $formattedDate =
                date(
                    'd F Y, H:i',
                    $timestamp
                );

        }

    }


    // =====================================================
    // STATUS TAMPILAN
    // =====================================================

    $statusLabel =
        'Menunggu Verifikasi';

    $statusClass =
        'status-warning';


    if ($status === 'submitted') {

        $statusLabel =
            'Menunggu Verifikasi';

        $statusClass =
            'status-warning';

    } elseif ($status === 'verified') {

        $statusLabel =
            'Terverifikasi';

        $statusClass =
            'status-info';

    } elseif ($status === 'processing') {

        $statusLabel =
            'Sedang Diproses';

        $statusClass =
            'status-info';

    } elseif ($status === 'completed') {

        $statusLabel =
            'Selesai';

        $statusClass =
            'status-success';

    }

?>

<style>

    /* ==========================================
       SUCCESS PAGE
    ========================================== */

    .success-page {

        background: #f4f6f9;

        min-height:
            calc(100vh - 57px);

        padding:
            35px 20px 50px;

    }


    .success-container {

        max-width: 900px;

        margin: 0 auto;

    }


    /* ==========================================
       SUCCESS CARD
    ========================================== */

    .success-card {

        background: #ffffff;

        border-radius: 18px;

        border: none;

        box-shadow:
            0 5px 20px rgba(0, 0, 0, 0.08);

        overflow: hidden;

    }


    /* ==========================================
       SUCCESS HEADER
    ========================================== */

    .success-top {

        text-align: center;

        padding:
            45px 30px 35px;

        border-bottom:
            1px solid #eeeeee;

    }


    .success-icon {

        width: 82px;

        height: 82px;

        margin:
            0 auto 20px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #e8f7ee;

        border:
            5px solid #c8efd8;

        border-radius: 50%;

        color: #198754;

        font-size: 38px;

    }


    .success-title {

        color: #0b3d91;

        font-size: 28px;

        font-weight: 700;

        margin-bottom: 8px;

    }


    .success-subtitle {

        color: #6c757d;

        font-size: 15px;

        margin-bottom: 0;

    }


    /* ==========================================
       TICKET NUMBER
    ========================================== */

    .ticket-box {

        margin:
            30px auto 0;

        max-width: 500px;

        background: #f8faff;

        border:
            2px dashed #0b3d91;

        border-radius: 14px;

        padding: 20px;

    }


    .ticket-label {

        color: #6c757d;

        font-size: 12px;

        font-weight: 700;

        letter-spacing: 1px;

        text-transform: uppercase;

        margin-bottom: 8px;

    }


    .ticket-number-wrapper {

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 10px;

    }


    .ticket-number {

        color: #0b3d91;

        font-size: 25px;

        font-weight: 800;

        letter-spacing: 1px;

        word-break: break-word;

    }


    .copy-ticket {

        border: none;

        background: transparent;

        color: #0b3d91;

        font-size: 18px;

        cursor: pointer;

        padding: 5px 8px;

    }


    .copy-ticket:hover {

        color: #f28c28;

    }


    /* ==========================================
       INFORMATION
    ========================================== */

    .section-title {

        color: #17365d;

        font-size: 18px;

        font-weight: 700;

        margin-bottom: 18px;

    }


    .info-section {

        padding: 30px;

    }


    .info-item {

        height: 100%;

        background: #f8f9fa;

        border-radius: 12px;

        padding: 18px;

        border-left:
            4px solid #0b3d91;

    }


    .info-icon {

        width: 38px;

        height: 38px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #eaf1ff;

        border-radius: 10px;

        color: #0b3d91;

        margin-bottom: 12px;

    }


    .info-label {

        color: #6c757d;

        font-size: 12px;

        margin-bottom: 5px;

    }


    .info-value {

        color: #17365d;

        font-weight: 700;

        font-size: 15px;

        word-break: break-word;

    }


    /* ==========================================
       STATUS
    ========================================== */

    .status-badge {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        padding:
            7px 12px;

        border-radius: 20px;

        font-size: 12px;

        font-weight: 700;

    }


    .status-warning {

        background: #fff3cd;

        color: #856404;

    }


    .status-info {

        background: #cff4fc;

        color: #055160;

    }


    .status-success {

        background: #d1e7dd;

        color: #0f5132;

    }


    /* ==========================================
       TIMELINE
    ========================================== */

    .timeline-section {

        padding:
            0 30px 30px;

    }


    .timeline {

        position: relative;

        margin-top: 25px;

    }


    .timeline-item {

        position: relative;

        display: flex;

        align-items: flex-start;

        padding-bottom: 25px;

    }


    .timeline-item:last-child {

        padding-bottom: 0;

    }


    .timeline-line {

        position: absolute;

        left: 17px;

        top: 35px;

        bottom: -5px;

        width: 2px;

        background: #dee2e6;

    }


    .timeline-item:last-child .timeline-line {

        display: none;

    }


    .timeline-icon {

        position: relative;

        z-index: 2;

        width: 36px;

        height: 36px;

        flex-shrink: 0;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: #eaf1ff;

        color: #0b3d91;

    }


    .timeline-item.active .timeline-icon {

        background: #0b3d91;

        color: #ffffff;

        box-shadow:
            0 0 0 5px #eaf1ff;

    }


    .timeline-content {

        padding-left: 15px;

    }


    .timeline-title {

        color: #17365d;

        font-weight: 700;

        margin-bottom: 3px;

        font-size: 14px;

    }


    .timeline-description {

        color: #6c757d;

        font-size: 13px;

        margin-bottom: 0;

    }


    /* ==========================================
       BUTTON
    ========================================== */

    .action-section {

        padding:
            25px 30px 35px;

        border-top:
            1px solid #eeeeee;

        text-align: center;

    }


    .btn-tracking {

        background: #0b3d91;

        border:
            2px solid #0b3d91;

        color: #ffffff;

        font-weight: 600;

        border-radius: 9px;

        padding:
            11px 24px;

        min-width: 180px;

    }


    .btn-tracking:hover {

        background: #082f70;

        border-color: #082f70;

        color: #ffffff;

    }


    .btn-dashboard {

        background: #ffffff;

        border:
            2px solid #0b3d91;

        color: #0b3d91;

        font-weight: 600;

        border-radius: 9px;

        padding:
            11px 24px;

        min-width: 180px;

    }


    .btn-dashboard:hover {

        background: #0b3d91;

        color: #ffffff;

    }


    .help-text {

        margin-top: 18px;

        color: #6c757d;

        font-size: 12px;

    }


    .help-text i {

        color: #f28c28;

    }


    /* ==========================================
       RESPONSIVE
    ========================================== */

    @media (max-width: 576px) {

        .success-page {

            padding:
                20px 12px 35px;

        }


        .success-top {

            padding:
                35px 20px 30px;

        }


        .success-title {

            font-size: 23px;

        }


        .ticket-number {

            font-size: 20px;

        }


        .info-section,
        .timeline-section {

            padding-left: 20px;

            padding-right: 20px;

        }


        .action-section {

            padding-left: 20px;

            padding-right: 20px;

        }


        .btn-tracking,
        .btn-dashboard {

            width: 100%;

            margin-bottom: 10px;

        }

    }

</style>


<!-- =====================================================
     CONTENT
====================================================== -->

<div class="content-wrapper">

    <div class="success-page">

        <div class="success-container">

            <div class="success-card">


                <!-- =========================================
                     SUCCESS HEADER
                ========================================== -->

                <div class="success-top">

                    <div class="success-icon">

                        <i class="fas fa-check"></i>

                    </div>


                    <h1 class="success-title">

                        Pengajuan Berhasil Dikirim

                    </h1>


                    <p class="success-subtitle">

                        Pengajuan layanan Anda telah berhasil
                        dikirim dan tercatat dalam sistem
                        SI-ULT POLBAN.

                    </p>


                    <!-- NOMOR TIKET -->

                    <div class="ticket-box">

                        <div class="ticket-label">

                            Nomor Tiket Anda

                        </div>


                        <div class="ticket-number-wrapper">

                            <span
                                class="ticket-number"
                                id="ticketNumber">

                                <?= esc($ticketNumber) ?>

                            </span>


                            <button
                                type="button"
                                class="copy-ticket"
                                onclick="copyTicket()"
                                title="Salin nomor tiket">

                                <i class="far fa-copy"></i>

                            </button>

                        </div>

                    </div>

                </div>


                <!-- =========================================
                     INFORMASI PENGAJUAN
                ========================================== -->

                <div class="info-section">

                    <h5 class="section-title">

                        <i class="fas fa-info-circle mr-2"></i>

                        Informasi Pengajuan

                    </h5>


                    <div class="row">


                        <!-- JENIS LAYANAN -->

                        <div class="col-md-4 mb-3">

                            <div class="info-item">

                                <div class="info-icon">

                                    <i class="fas fa-list-alt"></i>

                                </div>


                                <div class="info-label">

                                    Jenis Layanan

                                </div>


                                <div class="info-value">

                                    <?= esc(
                                        $ticket['service_name']
                                        ?? '-'
                                    ) ?>

                                </div>

                            </div>

                        </div>


                        <!-- STATUS -->

                        <div class="col-md-4 mb-3">

                            <div class="info-item">

                                <div class="info-icon">

                                    <i class="fas fa-tasks"></i>

                                </div>


                                <div class="info-label">

                                    Status Pengajuan

                                </div>


                                <div class="info-value">

                                    <span
                                        class="status-badge <?= esc($statusClass) ?>">

                                        <i class="fas fa-clock"></i>

                                        <?= esc($statusLabel) ?>

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- TANGGAL -->

                        <div class="col-md-4 mb-3">

                            <div class="info-item">

                                <div class="info-icon">

                                    <i class="far fa-calendar-alt"></i>

                                </div>


                                <div class="info-label">

                                    Tanggal Pengajuan

                                </div>


                                <div class="info-value">

                                    <?= esc($formattedDate) ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =========================================
                     TIMELINE
                ========================================== -->

                <div class="timeline-section">

                    <h5 class="section-title">

                        <i class="fas fa-route mr-2"></i>

                        Tahapan Pengajuan

                    </h5>


                    <div class="timeline">


                        <!-- STEP 1 -->

                        <div class="timeline-item active">

                            <div class="timeline-line"></div>

                            <div class="timeline-icon">

                                <i class="fas fa-check"></i>

                            </div>


                            <div class="timeline-content">

                                <div class="timeline-title">

                                    Pengajuan diterima

                                </div>

                                <p class="timeline-description">

                                    Pengajuan Anda telah berhasil
                                    dikirim ke sistem SI-ULT POLBAN.

                                </p>

                            </div>

                        </div>


                        <!-- STEP 2 -->

                        <div class="timeline-item">

                            <div class="timeline-line"></div>

                            <div class="timeline-icon">

                                <i class="fas fa-user-check"></i>

                            </div>


                            <div class="timeline-content">

                                <div class="timeline-title">

                                    Menunggu verifikasi petugas

                                </div>

                                <p class="timeline-description">

                                    Petugas akan memeriksa data dan
                                    dokumen persyaratan Anda.

                                </p>

                            </div>

                        </div>


                        <!-- STEP 3 -->

                        <div class="timeline-item">

                            <div class="timeline-icon">

                                <i class="fas fa-cogs"></i>

                            </div>


                            <div class="timeline-content">

                                <div class="timeline-title">

                                    Proses layanan

                                </div>

                                <p class="timeline-description">

                                    Pengajuan akan diproses oleh
                                    unit layanan terkait.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =========================================
                     ACTION
                ========================================== -->

                <div class="action-section">


                    <a
                        href="<?= base_url('dosen/ticket/history') ?>"
                        class="btn btn-tracking mr-2">

                        <i class="fas fa-ticket-alt mr-2"></i>

                        Lihat Tracking

                    </a>


                    <a
                        href="<?= base_url('dosen/dashboard') ?>"
                        class="btn btn-dashboard">

                        <i class="fas fa-home mr-2"></i>

                        Dashboard

                    </a>


                    <div class="help-text">

                        <i class="fas fa-lightbulb mr-1"></i>

                        Simpan nomor tiket Anda untuk memudahkan
                        pengecekan status pengajuan.

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

function copyTicket() {

    const ticketElement =
        document.getElementById(
            'ticketNumber'
        );


    const ticketNumber =
        ticketElement.innerText.trim();


    if (
        navigator.clipboard &&
        window.isSecureContext
    ) {

        navigator.clipboard
            .writeText(ticketNumber)
            .then(function () {

                showCopySuccess();

            })
            .catch(function () {

                fallbackCopy(ticketNumber);

            });

    } else {

        fallbackCopy(ticketNumber);

    }

}


function showCopySuccess() {

    const button =
        document.querySelector(
            '.copy-ticket'
        );


    const original =
        button.innerHTML;


    button.innerHTML =
        '<i class="fas fa-check"></i>';


    button.style.color =
        '#198754';


    setTimeout(function () {

        button.innerHTML =
            original;

        button.style.color =
            '';

    }, 1500);

}


function fallbackCopy(text) {

    const textarea =
        document.createElement(
            'textarea'
        );


    textarea.value = text;


    textarea.style.position =
        'fixed';

    textarea.style.opacity =
        '0';


    document.body.appendChild(
        textarea
    );


    textarea.focus();

    textarea.select();


    try {

        document.execCommand(
            'copy'
        );

        showCopySuccess();

    } catch (error) {

        alert(
            'Nomor tiket: ' + text
        );

    }


    document.body.removeChild(
        textarea
    );

}

</script>


<?= $this->include('layouts/footer') ?>