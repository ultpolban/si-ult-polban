<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>


<style>

/* =========================================
   HALAMAN NOTIFIKASI DOSEN
========================================= */

.notification-page {
    background: #f4f7fb;
    min-height: calc(100vh - 57px);
    padding-bottom: 40px;
}


/* =========================================
   JUDUL
========================================= */

.page-title {
    color: #0b3d91;
    font-weight: 700;
}

.page-subtitle {
    color: #64748b;
}


/* =========================================
   CARD UTAMA
========================================= */

.notification-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
}

.notification-card .card-header {
    background: #0b3d91;
    color: white;
    padding: 20px 25px;
    border: none;
}

.notification-card .card-header h3 {
    margin: 0;
    font-size: 21px;
    font-weight: 700;
}


/* =========================================
   NOTIFIKASI ITEM
========================================= */

.notification-item {
    display: flex;
    align-items: flex-start;
    gap: 18px;

    padding: 20px;

    border-bottom: 1px solid #e2e8f0;

    transition: .2s;

    background: white;
}

.notification-item:hover {
    background: #f8fafc;
}

.notification-item:last-child {
    border-bottom: none;
}


/* =========================================
   ICON
========================================= */

.notification-icon {
    min-width: 50px;
    width: 50px;
    height: 50px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 21px;
}


/* WARNA ICON */

.icon-info {
    background: #e0ecff;
    color: #0b3d91;
}

.icon-warning {
    background: #fff1df;
    color: #f28c28;
}

.icon-success {
    background: #dcfce7;
    color: #16a34a;
}

.icon-danger {
    background: #fee2e2;
    color: #dc2626;
}


/* =========================================
   ISI NOTIFIKASI
========================================= */

.notification-content {
    flex: 1;
}

.notification-title {
    color: #17365d;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 5px;
}

.notification-message {
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 7px;
}

.notification-time {
    color: #94a3b8;
    font-size: 13px;
}


/* =========================================
   BADGE UNREAD
========================================= */

.notification-unread {
    border-left: 5px solid #f28c28;
    background: #fffaf4;
}

.unread-badge {
    background: #f28c28;
    color: white;
    padding: 5px 9px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 700;
}


/* =========================================
   AKSI
========================================= */

.notification-action {
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-notification {
    border-radius: 7px;
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;
}


/* =========================================
   EMPTY STATE
========================================= */

.empty-state {
    text-align: center;
    padding: 70px 20px;
}

.empty-state i {
    font-size: 65px;
    color: #94a3b8;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #475569;
    font-weight: 700;
}

.empty-state p {
    color: #64748b;
}


/* =========================================
   INFO CARD
========================================= */

.info-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,.07);
    overflow: hidden;
}

.info-card .card-header {
    background: #f28c28;
    color: white;
    font-weight: 700;
    padding: 15px 20px;
}

.info-card .card-body {
    color: #475569;
    line-height: 1.7;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 768px) {

    .notification-item {
        flex-wrap: wrap;
    }

    .notification-action {
        width: 100%;
        margin-left: 68px;
    }

}

</style>


<div class="content-wrapper notification-page">


    <!-- =====================================
         HEADER
    ====================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <h1 class="page-title">

                <i class="fas fa-bell"></i>

                Notifikasi

            </h1>

            <p class="page-subtitle">

                Informasi terbaru mengenai pengajuan layanan Anda.

            </p>

        </div>

    </section>



    <!-- =====================================
         CONTENT
    ====================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- =================================
                 NOTIFICATION CARD
            ================================== -->

            <div class="card notification-card">


                <!-- HEADER -->

                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <h3>

                            <i class="fas fa-bell me-2"></i>

                            Notifikasi Anda

                        </h3>


                        <?php if (!empty($notifications)): ?>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                onclick="markAllAsRead()"
                            >

                                <i class="fas fa-check-double me-1"></i>

                                Tandai Semua Dibaca

                            </button>

                        <?php endif; ?>

                    </div>

                </div>



                <!-- BODY -->

                <div class="card-body p-0">


                    <?php if (!empty($notifications)): ?>


                        <?php foreach ($notifications as $notification): ?>


                            <?php

                            /*
                            =====================================
                            DATA NOTIFIKASI
                            =====================================
                            */

                            $type =
                                $notification['type']
                                ?? 'info';


                            $isRead =
                                $notification['is_read']
                                ?? false;


                            $title =
                                $notification['title']
                                ?? 'Notifikasi';


                            $message =
                                $notification['message']
                                ?? '';


                            $createdAt =
                                $notification['created_at']
                                ?? '-';


                            $ticketId =
                                $notification['ticket_id']
                                ?? null;



                            /*
                            =====================================
                            ICON
                            =====================================
                            */

                            $icon =
                                'fa-info-circle';


                            if (
                                $type === 'warning'
                            ) {

                                $icon =
                                    'fa-exclamation-triangle';

                            }

                            elseif (
                                $type === 'success'
                            ) {

                                $icon =
                                    'fa-check-circle';

                            }

                            elseif (
                                $type === 'danger'
                            ) {

                                $icon =
                                    'fa-times-circle';

                            }

                            ?>


                            <div
                                class="
                                    notification-item
                                    <?= !$isRead
                                        ? 'notification-unread'
                                        : '' ?>
                                "
                            >


                                <!-- ICON -->

                                <div
                                    class="
                                        notification-icon
                                        icon-<?= esc($type) ?>
                                    "
                                >

                                    <i
                                        class="fas <?= $icon ?>"
                                    ></i>

                                </div>



                                <!-- CONTENT -->

                                <div class="notification-content">


                                    <div class="d-flex align-items-center gap-2">


                                        <div class="notification-title">

                                            <?= esc($title) ?>

                                        </div>


                                        <?php if (!$isRead): ?>

                                            <span class="unread-badge">

                                                BARU

                                            </span>

                                        <?php endif; ?>


                                    </div>



                                    <div class="notification-message">

                                        <?= esc($message) ?>

                                    </div>



                                    <div class="notification-time">

                                        <i class="far fa-clock me-1"></i>

                                        <?= esc($createdAt) ?>

                                    </div>


                                </div>



                                <!-- ACTION -->

                                <?php if ($ticketId): ?>


                                    <div class="notification-action">


                                        <a
                                            href="<?= base_url(
                                                'dosen/ticket/detail/' .
                                                $ticketId
                                            ) ?>"
                                            class="btn btn-outline-primary btn-notification"
                                        >

                                            <i class="fas fa-eye me-1"></i>

                                            Lihat Tiket

                                        </a>


                                    </div>


                                <?php endif; ?>


                            </div>


                        <?php endforeach; ?>


                    <?php else: ?>


                        <!-- =================================
                             EMPTY STATE
                        ================================== -->

                        <div class="empty-state">


                            <i class="far fa-bell-slash"></i>


                            <h4>

                                Belum Ada Notifikasi

                            </h4>


                            <p>

                                Saat ada informasi terbaru mengenai pengajuan layanan Anda,
                                notifikasi akan muncul di halaman ini.

                            </p>


                            <a
                                href="<?= base_url('dosen/dashboard') ?>"
                                class="btn btn-primary"
                            >

                                <i class="fas fa-home me-1"></i>

                                Kembali ke Dashboard

                            </a>


                        </div>


                    <?php endif; ?>


                </div>


            </div>



            <!-- =================================
                 INFO
            ================================== -->

            <div class="card info-card mt-4">


                <div class="card-header">

                    <i class="fas fa-info-circle me-2"></i>

                    Informasi Notifikasi

                </div>


                <div class="card-body">


                    <p>

                        <i class="fas fa-paper-plane text-primary me-2"></i>

                        Notifikasi akan muncul ketika pengajuan layanan berhasil dikirim.

                    </p>


                    <p>

                        <i class="fas fa-spinner text-info me-2"></i>

                        Anda akan mendapatkan informasi ketika status tiket berubah.

                    </p>


                    <p>

                        <i class="fas fa-comment-dots text-warning me-2"></i>

                        Notifikasi juga akan muncul jika petugas memberikan catatan atau meminta revisi.

                    </p>


                    <p class="mb-0">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Anda akan mendapatkan pemberitahuan ketika layanan telah selesai diproses.

                    </p>


                </div>


            </div>


        </div>

    </section>

</div>



<script>

/* =========================================
   TANDAI SEMUA NOTIFIKASI DIBACA
========================================= */

function markAllAsRead() {

    if (
        !confirm(
            'Tandai semua notifikasi sebagai sudah dibaca?'
        )
    ) {

        return;

    }


    /*
    =========================================
    BACKEND BELUM AKTIF

    Nanti bisa diarahkan ke:

    /dosen/notification/read-all

    =========================================
    */

    alert(
        'Fitur tandai semua dibaca akan aktif setelah backend notifikasi selesai dibuat.'
    );

}

</script>


<?= $this->include('layouts/footer') ?>