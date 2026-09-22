<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    :root {
        --ult-navy: #2b3990;
        --ult-blue: #3b4cca;
        --ult-orange: #ff8c00;
        --ult-green: #10b981;
        --ult-yellow: #f59e0b;
        --ult-cyan: #06b6d4;
        --ult-bg: #f1f5f9;
        --ult-border: #e2e8f0;
        --ult-text: #0f172a;
        --ult-muted: #64748b;
        --ult-shadow: 0 4px 20px -2px rgba(43, 57, 144, 0.08);
        --ult-shadow-hover: 0 15px 30px -10px rgba(43, 57, 144, 0.15);
    }

    .disposition-page {
        font-family: 'Plus Jakarta Sans',
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            sans-serif;
        background: var(--ult-bg);
        min-height: 100%;
    }

    /* =========================
       HEADER
    ========================= */

    .disposition-header {
        background: #2b3990;
        border-radius: 20px;
        padding: 24px 28px;
        color: #fff;
        box-shadow: 0 12px 30px rgba(43, 57, 144, 0.25);
        position: relative;
        overflow: hidden;
    }

    .disposition-header::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -80px;
        top: -130px;
        border-radius: 50%;
        background: radial-gradient(
            circle,
            rgba(255,255,255,.15) 0%,
            rgba(255,255,255,0) 70%
        );
        pointer-events: none;
    }

    .page-title {
        position: relative;
        z-index: 1;
        font-size: 1.55rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: -.4px;
    }

    .page-subtitle {
        position: relative;
        z-index: 1;
        color: rgba(255,255,255,.82);
        font-size: .9rem;
        margin: 6px 0 0;
    }

    .header-icon {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        background: rgba(255,255,255,.14);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 1.1rem;
    }

    /* =========================
       ALERT
    ========================= */

    .ult-alert {
        border: 0;
        border-radius: 14px;
        padding: 15px 18px;
        box-shadow: var(--ult-shadow);
        font-weight: 500;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .ticket-card {
        background: #fff;
        border: 1px solid rgba(226,232,240,.8);
        border-radius: 20px;
        box-shadow: var(--ult-shadow);
        overflow: hidden;
    }

    .ticket-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--ult-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .section-title {
        color: var(--ult-navy);
        font-size: 1rem;
        font-weight: 800;
        margin: 0;
    }

    .ticket-count {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 13px;
        border-radius: 30px;
        background: #eef2ff;
        color: var(--ult-navy);
        font-size: .8rem;
        font-weight: 800;
    }

    .ticket-card-body {
        padding: 0;
    }

    /* =========================
       TABLE
    ========================= */

    .table-wrapper {
        overflow-x: auto;
    }

    .disposition-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .disposition-table thead th {
        background: var(--ult-navy);
        color: #fff;
        border: 0;
        padding: 15px 13px;
        font-size: .78rem;
        font-weight: 800;
        white-space: nowrap;
        vertical-align: middle;
    }

    .disposition-table thead th:first-child {
        border-top-left-radius: 0;
    }

    .disposition-table tbody td {
        padding: 16px 13px;
        border-bottom: 1px solid var(--ult-border);
        color: #334155;
        font-size: .84rem;
        vertical-align: middle;
        background: #fff;
    }

    .disposition-table tbody tr {
        transition: all .25s ease;
    }

    .disposition-table tbody tr:hover td {
        background: #f8fafc;
    }

    .ticket-number {
        color: var(--ult-navy);
        font-weight: 800;
        white-space: nowrap;
    }

    .ticket-title {
        color: var(--ult-text);
        font-weight: 700;
        min-width: 150px;
    }

    .service-name {
        color: #475569;
        font-weight: 600;
        min-width: 150px;
    }

    /* =========================
       BADGES
    ========================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        border-radius: 30px;
        padding: 7px 13px;
        font-size: .72rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-badge .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-verified {
        background: #d1fae5;
        color: #047857;
    }

    .priority-badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 8px;
        font-size: .7rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .priority-normal {
        background: #cffafe;
        color: #0e7490;
    }

    .priority-low {
        background: #e2e8f0;
        color: #475569;
    }

    .priority-high {
        background: #fef3c7;
        color: #b45309;
    }

    .priority-urgent {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* =========================
       ACTION BUTTON
    ========================= */

    .action-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        white-space: nowrap;
    }

    .btn-detail {
        background: #06a8c0;
        border: 0;
        color: #fff !important;
        border-radius: 10px;
        padding: 9px 13px;
        font-size: .75rem;
        font-weight: 800;
        text-decoration: none !important;
        transition: all .25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-detail:hover {
        background: #078da2;
        transform: translateY(-2px);
        box-shadow: 0 7px 15px rgba(6,168,192,.25);
    }

    .btn-disposition {
        background: linear-gradient(
            135deg,
            #ff9d00 0%,
            #ff7a00 100%
        );
        border: 0;
        color: #fff !important;
        border-radius: 10px;
        padding: 9px 13px;
        font-size: .75rem;
        font-weight: 800;
        text-decoration: none !important;
        transition: all .25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-disposition:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 15px rgba(255,140,0,.3);
        color: #fff !important;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        padding: 55px 20px;
        text-align: center;
        color: var(--ult-muted);
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: #f1f5f9;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        margin-bottom: 15px;
    }

    .empty-state h5 {
        color: #334155;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .empty-state p {
        margin: 0;
        font-size: .85rem;
    }

    /* =========================
       ANIMATION
    ========================= */

    .disposition-animate {
        opacity: 0;
        transform: translateY(15px);
        animation: dispositionShow .5s ease forwards;
    }

    @keyframes dispositionShow {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .disposition-header {
            padding: 20px;
            border-radius: 16px;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .ticket-card {
            border-radius: 16px;
        }

        .ticket-card-header {
            padding: 17px;
        }

        .disposition-table thead th,
        .disposition-table tbody td {
            padding: 12px 10px;
        }

        .action-group {
            flex-direction: column;
        }

        .btn-detail,
        .btn-disposition {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="disposition-page">

    <div class="container-fluid px-4 py-4">

        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div class="disposition-header disposition-animate mb-4">

            <div class="d-flex align-items-center">

                <div class="header-icon">
                    <i class="fas fa-route"></i>
                </div>

                <div>
                    <h1 class="page-title">
                        Disposisi Tiket
                    </h1>

                    <p class="page-subtitle">
                        Kelola tiket yang telah diverifikasi dan teruskan
                        ke unit layanan tujuan.
                    </p>
                </div>

            </div>

        </div>


        <!-- =====================================================
             FLASH MESSAGE
        ====================================================== -->

        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success ult-alert alert-dismissible fade show mb-4">

                <i class="fas fa-check-circle mr-2"></i>

                <?= esc(session()->getFlashdata('success')) ?>

                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                >
                    <span>&times;</span>
                </button>

            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger ult-alert alert-dismissible fade show mb-4">

                <i class="fas fa-exclamation-circle mr-2"></i>

                <?= esc(session()->getFlashdata('error')) ?>

                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                >
                    <span>&times;</span>
                </button>

            </div>

        <?php endif; ?>


        <!-- =====================================================
             INFO
        ====================================================== -->

        <div class="alert alert-info ult-alert mb-4">

            <i class="fas fa-info-circle mr-2"></i>

            Berikut adalah tiket yang sudah diverifikasi dan menunggu
            untuk didisposisikan ke unit tujuan.

        </div>


        <!-- =====================================================
             TICKET CARD
        ====================================================== -->

        <div
            class="ticket-card disposition-animate"
            style="animation-delay: .08s;"
        >

            <!-- CARD HEADER -->

            <div class="ticket-card-header">

                <div>

                    <h3 class="section-title">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        Tiket Menunggu Disposisi
                    </h3>

                </div>

                <div class="ticket-count">

                    <i class="fas fa-layer-group"></i>

                    <?= count($tickets ?? []) ?> Tiket

                </div>

            </div>


            <!-- CARD BODY -->

            <div class="ticket-card-body">

                <div class="table-wrapper">

                    <table class="disposition-table">

                        <thead>

                            <tr>

                                <th style="width: 50px;">
                                    No
                                </th>

                                <th>
                                    No. Tiket
                                </th>

                                <th>
                                    Judul
                                </th>

                                <th>
                                    Layanan
                                </th>

                                <th>
                                    Prioritas
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Waktu Verifikasi
                                </th>

                                <th style="width: 190px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (!empty($tickets)): ?>

                                <?php $no = 1; ?>

                                <?php foreach ($tickets as $ticket): ?>

                                    <?php

                                    /*
                                     * =================================================
                                     * DATA BACKEND
                                     * =================================================
                                     */

                                    $ticketId = $ticket['id'] ?? null;

                                    $ticketNumber =
                                        $ticket['ticket_number']
                                        ?? '-';

                                    $title =
                                        $ticket['title']
                                        ?? '-';

                                    $service =
                                        $ticket['service_display_name']
                                        ?? $ticket['service_name']
                                        ?? '-';

                                    $status =
                                        strtolower(
                                            trim(
                                                $ticket['status']
                                                ?? 'verified'
                                            )
                                        );

                                    $priority =
                                        strtolower(
                                            trim(
                                                $ticket['priority']
                                                ?? 'normal'
                                            )
                                        );

                                    $verifiedAt =
                                        $ticket['verified_at']
                                        ?? null;

                                    /*
                                     * PRIORITY CLASS
                                     */

                                    switch ($priority) {

                                        case 'urgent':
                                            $priorityClass = 'priority-urgent';
                                            $priorityLabel = 'URGENT';
                                            break;

                                        case 'high':
                                            $priorityClass = 'priority-high';
                                            $priorityLabel = 'HIGH';
                                            break;

                                        case 'low':
                                            $priorityClass = 'priority-low';
                                            $priorityLabel = 'LOW';
                                            break;

                                        default:
                                            $priorityClass = 'priority-normal';
                                            $priorityLabel = 'NORMAL';
                                            break;
                                    }

                                    ?>

                                    <tr>

                                        <!-- NO -->

                                        <td class="text-center">

                                            <strong>
                                                <?= $no++ ?>
                                            </strong>

                                        </td>


                                        <!-- NOMOR TIKET -->

                                        <td>

                                            <span class="ticket-number">

                                                <?= esc(
                                                    $ticketNumber
                                                ) ?>

                                            </span>

                                        </td>


                                        <!-- JUDUL -->

                                        <td>

                                            <div class="ticket-title">

                                                <?= esc(
                                                    $title
                                                ) ?>

                                            </div>

                                        </td>


                                        <!-- LAYANAN -->

                                        <td>

                                            <div class="service-name">

                                                <?= esc(
                                                    $service
                                                ) ?>

                                            </div>

                                        </td>


                                        <!-- PRIORITAS -->

                                        <td>

                                            <span
                                                class="priority-badge <?= $priorityClass ?>"
                                            >
                                                <?= esc(
                                                    $priorityLabel
                                                ) ?>
                                            </span>

                                        </td>


                                        <!-- STATUS -->

                                        <td>

                                            <span class="status-badge status-verified">

                                                <span class="dot"></span>

                                                <?= esc(
                                                    strtoupper($status)
                                                ) ?>

                                            </span>

                                        </td>


                                        <!-- WAKTU VERIFIKASI -->

                                        <td>

                                            <?php if (
                                                !empty($verifiedAt)
                                                && strtotime($verifiedAt) !== false
                                            ): ?>

                                                <div class="font-weight-bold">

                                                    <?= date(
                                                        'd-m-Y H:i',
                                                        strtotime($verifiedAt)
                                                    ) ?>

                                                </div>

                                            <?php else: ?>

                                                <span class="text-muted">
                                                    -
                                                </span>

                                            <?php endif; ?>

                                        </td>


                                        <!-- AKSI -->

                                        <td>

                                            <div class="action-group">

                                                <!-- DETAIL -->

                                                <a
                                                    href="<?= base_url(
                                                        'disposition/detail/' .
                                                        $ticketId
                                                    ) ?>"
                                                    class="btn-detail"
                                                    title="Lihat detail tiket"
                                                >

                                                    <i class="fas fa-eye"></i>

                                                    Detail

                                                </a>


                                                <!-- DISPOSISI -->

                                                <a
                                                    href="<?= base_url(
                                                        'disposition/detail/' .
                                                        $ticketId
                                                    ) ?>"
                                                    class="btn-disposition"
                                                    title="Disposisikan tiket"
                                                >

                                                    <i class="fas fa-share-square"></i>

                                                    Disposisi

                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <!-- EMPTY -->

                                <tr>

                                    <td
                                        colspan="8"
                                        class="p-0"
                                    >

                                        <div class="empty-state">

                                            <div class="empty-icon">

                                                <i class="fas fa-inbox"></i>

                                            </div>

                                            <h5>
                                                Tidak ada tiket menunggu disposisi
                                            </h5>

                                            <p>
                                                Semua tiket yang telah diverifikasi
                                                sudah diproses atau belum ada tiket baru.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>