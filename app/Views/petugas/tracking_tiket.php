<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

/* =========================================================
   GENERAL
========================================================= */

body,
.container-fluid {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    background: #eef3fb;
    color: #263238;
}

.tracking-page {
    padding: 28px 30px;
}

.page-title {
    font-size: 1.55rem;
    font-weight: 800;
    color: #1a237e;
}

.page-subtitle {
    color: #7b8794;
    font-size: .88rem;
}


/* =========================================================
   CARD
========================================================= */

.tracking-card {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #e0e6ef;
    box-shadow: 0 3px 12px rgba(30, 55, 90, .08);
    overflow: hidden;
}

.tracking-card-header {
    background: #29398f;
    color: #fff;
    padding: 15px 20px;
    font-size: 1rem;
    font-weight: 700;
}

.tracking-card-header i {
    margin-right: 8px;
}


/* =========================================================
   SEARCH
========================================================= */

.search-area {
    background: #fff;
    padding: 18px 20px;
    border-bottom: 1px solid #e5eaf0;
}

.search-input {
    height: 43px;
    border: 1px solid #ccd5e0;
    border-radius: 7px;
    padding-left: 42px;
    font-size: .88rem;
}

.search-input:focus {
    border-color: #29398f;
    box-shadow: 0 0 0 3px rgba(41,57,143,.10);
}

.search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #29398f;
}


/* =========================================================
   TABLE
========================================================= */

.table-tracking {
    margin-bottom: 0;
}

.table-tracking thead th {
    background: #29398f;
    color: #fff;
    border: none;
    font-size: .82rem;
    padding: 14px 16px;
    vertical-align: middle;
}

.table-tracking tbody td {
    padding: 15px 16px;
    font-size: .86rem;
    border-bottom: 1px solid #edf0f4;
    vertical-align: middle;
}

.table-tracking tbody tr:hover {
    background: #f8faff;
}

.ticket-number {
    color: #1769e0;
    font-weight: 700;
    font-family: monospace;
}

.service-tag {
    background: #eef2f8;
    color: #495057;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: .78rem;
    font-weight: 600;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 5px;
    font-size: .75rem;
    font-weight: 700;
}

.status-verified {
    background: #dff6e8;
    color: #159447;
}

.status-assigned {
    background: #e8efff;
    color: #29398f;
}

.btn-progress {
    background: #29398f;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 8px 13px;
    font-size: .78rem;
    font-weight: 600;
    transition: .2s ease;
}

.btn-progress:hover {
    background: #1d2b75;
    color: #fff;
    transform: translateY(-1px);
}


/* =========================================================
   DETAIL TRACKING
   STYLE MENYERUPAI BACKEND
========================================================= */

.detail-wrapper {
    animation: fadeIn .25s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}


/* Header */

.progress-header {
    background: #29398f;
    color: #fff;
    padding: 15px 22px;
    border-radius: 8px 8px 0 0;
}

.progress-header-title {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.progress-header-title i {
    color: #ffca28;
    margin-right: 8px;
}


/* Ticket number */

.ticket-summary {
    text-align: center;
    padding: 27px 20px 20px;
    background: #fff;
}

.ticket-label {
    color: #777;
    font-size: .78rem;
    margin-bottom: 5px;
}

.ticket-code {
    font-size: 1.25rem;
    font-weight: 800;
    color: #263238;
    margin-bottom: 8px;
}

.detail-status {
    display: inline-block;
    padding: 6px 15px;
    border-radius: 5px;
    color: #fff;
    font-size: .75rem;
    font-weight: 700;
    background: #29398f;
}


/* =========================================================
   PROGRESS STEPPER
========================================================= */

.progress-container {
    background: #fff;
    padding: 30px 6%;
    overflow-x: auto;
}

.progress-track {
    position: relative;
    min-width: 650px;
    display: flex;
    justify-content: space-between;
}

.progress-line {
    position: absolute;
    top: 22px;
    left: 6%;
    right: 6%;
    height: 4px;
    background: #dfe3e8;
    z-index: 1;
}

.progress-line-active {
    position: absolute;
    top: 22px;
    left: 6%;
    height: 4px;
    background: #2eae59;
    z-index: 2;
    transition: width .4s ease;
}

.progress-step {
    position: relative;
    z-index: 3;
    width: 20%;
    text-align: center;
}

.progress-circle {
    width: 44px;
    height: 44px;
    margin: 0 auto 9px;
    border-radius: 50%;
    background: #f1f3f5;
    border: 3px solid #e0e4e8;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #8b939b;
    font-size: .95rem;
    transition: .25s ease;
}

.progress-step.completed .progress-circle {
    background: #28b45a;
    border-color: #28b45a;
    color: #fff;
}

.progress-step.active .progress-circle {
    background: #2485e8;
    border-color: #2485e8;
    color: #fff;
    box-shadow: 0 0 0 5px rgba(36,133,232,.12);
}

.progress-step.completed .step-name {
    color: #28a852;
}

.progress-step.active .step-name {
    color: #2485e8;
}

.step-name {
    font-size: .78rem;
    font-weight: 800;
    color: #555;
    margin-bottom: 3px;
}

.step-status {
    font-size: .68rem;
    color: #8b939b;
}


/* =========================================================
   STATUS TICKET
========================================================= */

.status-section {
    background: #fff;
    margin-top: 18px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(30,55,90,.07);
}

.status-body {
    padding: 22px;
    font-size: .88rem;
    color: #444;
}


/* =========================================================
   INFORMASI TIKET
========================================================= */

.info-section {
    background: #fff;
    margin-top: 18px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(30,55,90,.07);
}

.info-body {
    padding: 25px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 80px;
    row-gap: 22px;
}

.info-item {
    min-height: 45px;
}

.info-label {
    color: #777;
    font-size: .76rem;
    margin-bottom: 5px;
}

.info-value {
    color: #263238;
    font-size: .86rem;
    font-weight: 500;
}

.info-value strong {
    font-weight: 700;
}

.info-badge {
    display: inline-block;
    background: #29398f;
    color: #fff;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: .72rem;
    font-weight: 700;
}

.info-badge-blue {
    background: #18a8ba;
}


/* =========================================================
   RIWAYAT AKTIVITAS
========================================================= */

.history-section {
    background: #fff;
    margin-top: 18px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(30,55,90,.07);
}

.history-body {
    padding: 20px 25px;
}

.history-item {
    border-left: 3px solid #2196f3;
    padding: 0 0 18px 18px;
    margin-left: 3px;
}

.history-item:last-child {
    padding-bottom: 0;
}

.history-title {
    font-weight: 700;
    font-size: .86rem;
    color: #263238;
}

.history-meta {
    font-size: .7rem;
    color: #8b939b;
    margin-top: 4px;
}

.history-meta span {
    margin-right: 14px;
}


/* =========================================================
   BUTTON BACK
========================================================= */

.btn-back {
    margin-top: 20px;
    margin-bottom: 30px;
    background: #29398f;
    color: #fff;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    font-size: .8rem;
    font-weight: 600;
}

.btn-back:hover {
    background: #1d2b75;
    color: #fff;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 768px) {

    .tracking-page {
        padding: 18px 12px;
    }

    .info-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .progress-container {
        padding-left: 15px;
        padding-right: 15px;
    }

    .progress-track {
        min-width: 600px;
    }

    .table-tracking {
        min-width: 850px;
    }
}

</style>


<div class="container-fluid tracking-page">

    <!-- =====================================================
         VIEW DAFTAR TRACKING
    ====================================================== -->

    <div id="viewIndexTracking">

        <div class="mb-4">
            <h3 class="page-title mb-1">
                <i class="fas fa-route me-2"></i>
                Tracking Status Tiket
            </h3>

            <p class="page-subtitle mb-0">
                Daftar permohonan layanan yang telah didisposisikan ke unit untuk dipantau progresnya.
            </p>
        </div>


        <div class="tracking-card">

            <div class="tracking-card-header">
                <i class="fas fa-location-arrow"></i>
                Tracking Progres Tiket
            </div>


            <div class="search-area">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div class="position-relative" style="width: 330px; max-width: 100%;">

                        <i class="fas fa-search search-icon"></i>

                        <input
                            type="text"
                            id="searchTrackingInput"
                            class="form-control search-input"
                            placeholder="Cari nomor tiket atau nama pemohon..."
                        >

                    </div>


                    <div class="fw-semibold text-muted small">

                        Total Disposisi:

                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            6 Tiket
                        </span>

                    </div>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-tracking" id="tabelTrackingIndex">

                    <thead>

                        <tr class="text-center">

                            <th width="60">No</th>

                            <th class="text-start">
                                Nomor Tiket
                            </th>

                            <th class="text-start">
                                Nama Pemohon
                            </th>

                            <th class="text-start">
                                Layanan
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="160">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php

                        $disposisiData = [

                            [
                                'ULT-20260806074739865',
                                'Asep',
                                'Keuangan',
                                'Verified',
                                'Bagian Keuangan',
                                'Dokumen pengajuan anggaran telah diverifikasi lengkap, valid, dan didisposisikan ke Bagian Keuangan.'
                            ],

                            [
                                'ULT-20260805023213577',
                                'Apin',
                                'Beasiswa',
                                'Verified',
                                'Bagian Akademik & Kemahasiswaan',
                                'Syarat administratif beasiswa memenuhi kriteria dan telah didisposisikan.'
                            ],

                            [
                                'ULT-20260730081403481',
                                'Apin',
                                'Kemahasiswaan',
                                'Assigned',
                                'Bagian Akademik & Kemahasiswaan',
                                'Tiket telah diverifikasi dan masuk tahap disposisi pimpinan unit kemahasiswaan.'
                            ],

                            [
                                'ULT-20260730080403262',
                                'Ikbal',
                                'Kemahasiswaan',
                                'Assigned',
                                'Subbag Kerjasama & Humas',
                                'Disposisi tiket diterima unit untuk koordinasi layanan tamu institusi.'
                            ],

                            [
                                'ULT-20260730002942605',
                                'Rizki AM',
                                'Beasiswa',
                                'Assigned',
                                'Bagian Keuangan',
                                'Verifikasi berkas rekening telah selesai dan didisposisikan ke petugas loket.'
                            ],

                            [
                                'ULT-20260730002841489',
                                'Adit',
                                'Informasi Akademik',
                                'Assigned',
                                'UPT TIK',
                                'Disposisi penanganan sistem informasi akademik diteruskan ke tim teknis UPT TIK.'
                            ]

                        ];


                        foreach ($disposisiData as $i => $row):

                        ?>

                        <tr
                            class="tracking-row text-center"
                            data-notiket="<?= $row[0] ?>"
                            data-nama="<?= strtolower($row[1]) ?>"
                            data-layanan="<?= strtolower($row[2]) ?>"
                        >

                            <td class="fw-bold text-muted">
                                <?= $i + 1 ?>
                            </td>


                            <td class="text-start">

                                <span class="ticket-number">
                                    <?= $row[0] ?>
                                </span>

                            </td>


                            <td class="text-start fw-bold">
                                <?= $row[1] ?>
                            </td>


                            <td class="text-start">

                                <span class="service-tag">
                                    <?= $row[2] ?>
                                </span>

                            </td>


                            <td>

                                <span class="status-badge
                                    <?= ($row[3] == 'Verified')
                                        ? 'status-verified'
                                        : 'status-assigned'
                                    ?>"
                                >

                                    <i class="fas fa-circle" style="font-size:5px;"></i>

                                    <?= $row[3] ?>

                                </span>

                            </td>


                            <td>

                                <button
                                    type="button"
                                    class="btn-progress btn-lihat-progres"
                                    data-notiket="<?= $row[0] ?>"
                                    data-nama="<?= $row[1] ?>"
                                    data-layanan="<?= $row[2] ?>"
                                    data-status="<?= $row[3] ?>"
                                    data-unit="<?= $row[4] ?>"
                                    data-catatan="<?= $row[5] ?>"
                                >

                                    <i class="fas fa-route me-1"></i>

                                    Lihat Progres

                                </button>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         VIEW DETAIL TRACKING
    ====================================================== -->

    <div id="viewDetailTracking" class="detail-wrapper d-none">

        <div class="mb-4">

            <h3 class="page-title mb-1">

                <i class="fas fa-route me-2"></i>

                Tracking Progres Tiket

            </h3>

            <p class="page-subtitle mb-0">

                Pantau dan lacak detail tahapan penyelesaian permohonan layanan secara real-time.

            </p>

        </div>


        <!-- =================================================
             CARD PROGRES
        ================================================== -->

        <div class="tracking-card">

            <div class="progress-header">

                <h5 class="progress-header-title">

                    <i class="fas fa-map-marker-alt"></i>

                    Tracking Progres Tiket

                </h5>

            </div>


            <!-- NOMOR TIKET -->

            <div class="ticket-summary">

                <div class="ticket-label">
                    Nomor Tiket
                </div>

                <div
                    id="detailNoTiket"
                    class="ticket-code"
                >
                    -
                </div>

                <span
                    id="detailBadgeStatus"
                    class="detail-status"
                >
                    Assigned
                </span>

            </div>


            <!-- =================================================
                 STEPPER
            ================================================== -->

            <div class="progress-container">

                <div class="progress-track">

                    <div class="progress-line"></div>

                    <div
                        class="progress-line-active"
                        id="dynamicProgressBar"
                    ></div>


                    <!-- STEP 1 -->

                    <div
                        class="progress-step completed"
                        id="step1"
                    >

                        <div class="progress-circle">

                            <i class="fas fa-check"></i>

                        </div>

                        <div class="step-name">
                            Diajukan
                        </div>

                        <div class="step-status">
                            Selesai
                        </div>

                    </div>


                    <!-- STEP 2 -->

                    <div
                        class="progress-step completed"
                        id="step2"
                    >

                        <div class="progress-circle">

                            <i class="fas fa-check"></i>

                        </div>

                        <div class="step-name">
                            Diverifikasi
                        </div>

                        <div class="step-status">
                            Selesai
                        </div>

                    </div>


                    <!-- STEP 3 -->

                    <div
                        class="progress-step active"
                        id="step3"
                    >

                        <div class="progress-circle">

                            <i class="fas fa-arrow-right"></i>

                        </div>

                        <div class="step-name">
                            Didisposisi
                        </div>

                        <div class="step-status">
                            Selesai
                        </div>

                    </div>


                    <!-- STEP 4 -->

                    <div
                        class="progress-step"
                        id="step4"
                    >

                        <div class="progress-circle">

                            <i class="fas fa-cog"></i>

                        </div>

                        <div class="step-name">
                            Diproses Unit
                        </div>

                        <div class="step-status">
                            Menunggu
                        </div>

                    </div>


                    <!-- STEP 5 -->

                    <div
                        class="progress-step"
                        id="step5"
                    >

                        <div class="progress-circle">

                            <i class="fas fa-check"></i>

                        </div>

                        <div class="step-name">
                            Selesai
                        </div>

                        <div class="step-status">
                            Menunggu
                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- =================================================
             STATUS TIKET
        ================================================== -->

        <div class="status-section">

            <div class="tracking-card-header">

                <i class="fas fa-circle-info"></i>

                Status Tiket

            </div>


            <div
                class="status-body"
                id="detailStatusText"
            >

                Tiket sudah didisposisikan ke unit dan menunggu diproses oleh unit.

            </div>

        </div>



        <!-- =================================================
             INFORMASI TIKET
        ================================================== -->

        <div class="info-section">

            <div class="tracking-card-header">

                <i class="fas fa-info-circle"></i>

                Informasi Tiket

            </div>


            <div class="info-body">

                <div class="info-grid">


                    <!-- KIRI -->

                    <div class="info-item">

                        <div class="info-label">
                            Nomor Tiket
                        </div>

                        <div
                            id="infoNoTiket"
                            class="info-value"
                        >
                            -
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Email
                        </div>

                        <div class="info-value">
                            zhufa@gmail.com
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Nama Pemohon
                        </div>

                        <div
                            id="infoNama"
                            class="info-value"
                        >
                            -
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Layanan
                        </div>

                        <div
                            id="infoLayanan"
                            class="info-value"
                        >
                            -
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            NIM
                        </div>

                        <div class="info-value">
                            0987665
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Sumber
                        </div>

                        <div class="info-value">
                            Online
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Nomor HP
                        </div>

                        <div class="info-value">
                            0987666
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Unit Tujuan
                        </div>

                        <div
                            id="infoUnit"
                            class="info-value"
                        >
                            <span class="info-badge">
                                <i class="fas fa-building me-1"></i>
                                -
                            </span>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Judul Tiket
                        </div>

                        <div class="info-value">
                            -
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Status
                        </div>

                        <div
                            id="infoStatus"
                            class="info-value"
                        >
                            <span class="info-badge">
                                Assigned
                            </span>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Prioritas
                        </div>

                        <div class="info-value">
                            Normal
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Lama Proses
                        </div>

                        <div class="info-value">

                            <span class="info-badge info-badge-blue">

                                17 Hari 22 Jam

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- =================================================
             RIWAYAT AKTIVITAS
        ================================================== -->

        <div class="history-section">

            <div class="tracking-card-header">

                <i class="fas fa-clock-rotate-left"></i>

                Riwayat Aktivitas

            </div>


            <div class="history-body">

                <div class="history-item">

                    <div class="history-title">
                        Aktivitas tiket
                    </div>

                    <div class="history-meta">

                        <span>
                            2026-07-27 01:10:44
                        </span>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>


                <div class="history-item">

                    <div class="history-title">
                        Aktivitas tiket
                    </div>

                    <div class="history-meta">

                        <span>
                            2026-07-27 05:18:38
                        </span>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>


                <div class="history-item">

                    <div class="history-title">
                        Aktivitas tiket
                    </div>

                    <div class="history-meta">

                        <span>
                            2026-07-27 09:46:09
                        </span>

                        <span>
                            Administrator
                        </span>

                    </div>

                </div>

            </div>

        </div>



        <!-- =================================================
             KEMBALI
        ================================================== -->

        <button
            type="button"
            id="btnKembaliIndex"
            class="btn btn-back"
        >

            <i class="fas fa-arrow-left me-1"></i>

            Kembali ke Tracking

        </button>

    </div>

</div>



<script>

document.addEventListener("DOMContentLoaded", function () {


    /* =====================================================
       ELEMENT
    ===================================================== */

    const viewIndex =
        document.getElementById('viewIndexTracking');

    const viewDetail =
        document.getElementById('viewDetailTracking');

    const buttons =
        document.querySelectorAll('.btn-lihat-progres');

    const btnBack =
        document.getElementById('btnKembaliIndex');


    /* DETAIL */

    const detailNoTiket =
        document.getElementById('detailNoTiket');

    const detailBadgeStatus =
        document.getElementById('detailBadgeStatus');


    /* INFO */

    const infoNoTiket =
        document.getElementById('infoNoTiket');

    const infoNama =
        document.getElementById('infoNama');

    const infoLayanan =
        document.getElementById('infoLayanan');

    const infoUnit =
        document.getElementById('infoUnit');

    const infoStatus =
        document.getElementById('infoStatus');


    /* STATUS */

    const detailStatusText =
        document.getElementById('detailStatusText');


    /* STEPPER */

    const step1 =
        document.getElementById('step1');

    const step2 =
        document.getElementById('step2');

    const step3 =
        document.getElementById('step3');

    const step4 =
        document.getElementById('step4');

    const step5 =
        document.getElementById('step5');

    const progress =
        document.getElementById('dynamicProgressBar');



    /* =====================================================
       FUNGSI UPDATE STEPPER
    ===================================================== */

    function resetSteps() {

        step1.className = 'progress-step';
        step2.className = 'progress-step';
        step3.className = 'progress-step';
        step4.className = 'progress-step';
        step5.className = 'progress-step';

        progress.style.width = '0%';

    }


    function setAssigned() {

        resetSteps();

        step1.className =
            'progress-step completed';

        step2.className =
            'progress-step completed';

        step3.className =
            'progress-step active';

        progress.style.width =
            '50%';

        step3.querySelector('.step-status').innerText =
            'Sedang diproses';

        step4.querySelector('.step-status').innerText =
            'Menunggu';

        step5.querySelector('.step-status').innerText =
            'Menunggu';

    }


    function setVerified() {

        resetSteps();

        step1.className =
            'progress-step completed';

        step2.className =
            'progress-step completed';

        step3.className =
            'progress-step completed';

        step4.className =
            'progress-step completed';

        step5.className =
            'progress-step completed';

        progress.style.width =
            '100%';

        step3.querySelector('.step-status').innerText =
            'Selesai';

        step4.querySelector('.step-status').innerText =
            'Selesai';

        step5.querySelector('.step-status').innerText =
            'Selesai';

    }



    /* =====================================================
       TOMBOL LIHAT PROGRES
    ===================================================== */

    buttons.forEach(function(button) {

        button.addEventListener('click', function() {


            const noTiket =
                this.dataset.notiket;

            const nama =
                this.dataset.nama;

            const layanan =
                this.dataset.layanan;

            const status =
                this.dataset.status;

            const unit =
                this.dataset.unit;


            /* DETAIL */

            detailNoTiket.innerText =
                noTiket;


            detailBadgeStatus.innerText =
                status;


            /* INFO */

            infoNoTiket.innerText =
                noTiket;

            infoNama.innerText =
                nama;

            infoLayanan.innerText =
                layanan;


            infoUnit.innerHTML =
                '<span class="info-badge">' +
                '<i class="fas fa-building me-1"></i>' +
                unit +
                '</span>';


            infoStatus.innerHTML =
                '<span class="info-badge">' +
                status +
                '</span>';


            /* STATUS TIKET */

            if (status === 'Verified') {

                detailStatusText.innerText =
                    'Tiket telah diverifikasi dan seluruh proses penanganan layanan telah diselesaikan.';

                setVerified();

                detailBadgeStatus.style.background =
                    '#28b45a';

            } else {

                detailStatusText.innerText =
                    'Tiket sudah didisposisikan ke unit dan menunggu diproses oleh unit.';

                setAssigned();

                detailBadgeStatus.style.background =
                    '#29398f';

            }


            /* PINDAH VIEW */

            viewIndex.classList.add('d-none');

            viewDetail.classList.remove('d-none');


            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

        });

    });



    /* =====================================================
       KEMBALI
    ===================================================== */

    if (btnBack) {

        btnBack.addEventListener('click', function() {

            viewDetail.classList.add('d-none');

            viewIndex.classList.remove('d-none');

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

        });

    }



    /* =====================================================
       SEARCH
    ===================================================== */

    const searchInput =
        document.getElementById('searchTrackingInput');

    const rows =
        document.querySelectorAll('.tracking-row');


    if (searchInput) {

        searchInput.addEventListener('input', function() {

            const keyword =
                this.value.toLowerCase().trim();


            rows.forEach(function(row) {

                const noTiket =
                    row.dataset.notiket.toLowerCase();

                const nama =
                    row.dataset.nama.toLowerCase();

                const layanan =
                    row.dataset.layanan.toLowerCase();


                if (
                    noTiket.includes(keyword) ||
                    nama.includes(keyword) ||
                    layanan.includes(keyword)
                ) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        });

    }

});

</script>


<?= $this->endSection() ?>