<!-- ========================================================================= -->
<!-- NAVBAR UTAMA - SI ULT POLBAN                                              -->
<!-- ========================================================================= -->

<nav class="main-header navbar navbar-expand shadow-lg border-0"
     style="background:#2b3990 !important; min-height:70px; transition:all .3s ease;">

    <!-- Tombol Toggle Sidebar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white px-3 py-2 rounded-pill ml-2"
               data-widget="pushmenu"
               href="#"
               role="button"
               style="background:rgba(255,255,255,.08); transition:all .25s ease;"
               onmouseover="this.style.background='rgba(255,255,255,.18)'"
               onmouseout="this.style.background='rgba(255,255,255,.08)'">

                <i class="fas fa-bars fa-lg"></i>
            </a>
        </li>
    </ul>


    <!-- Brand / Judul Sistem -->
    <ul class="navbar-nav ml-3 d-none d-md-flex align-items-center">

        <li class="nav-item d-flex align-items-center">

            <div class="mr-2 p-1 rounded-circle"
                 style="background:rgba(255,255,255,.12); backdrop-filter:blur(5px);">

                <img src="<?= base_url('assets/images/logo.svg') ?>"
                     width="36"
                     height="36"
                     alt="Logo Polban"
                     style="object-fit:contain;">
            </div>

            <div>

                <span class="font-weight-bold text-white d-block"
                      style="font-size:1.05rem;
                             letter-spacing:.8px;
                             text-shadow:0 2px 4px rgba(0,0,0,.3);">

                    Sistem Informasi Unit Layanan Terpadu

                </span>

                <span class="d-block text-light"
                      style="font-size:.7rem;
                             opacity:.8;
                             letter-spacing:.5px;">

                    Politeknik Negeri Bandung • Enterprise Dashboard

                </span>

            </div>

        </li>

    </ul>


    <!-- Right Navbar -->
    <ul class="navbar-nav ml-auto align-items-center mr-3">


        <?php
use App\Models\NotificationModel;

$notifCount = 0;
$latestNotifs = [];

$currentUserId = session()->get('user_id');

if (!empty($currentUserId)) {
    $notificationModel = new NotificationModel();

    // Semua notifikasi user yang sedang login
    $allNotifications = $notificationModel
        ->where('user_id', (int) $currentUserId)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    // Hanya yang belum dibaca
    $notifCount = 0;

    foreach ($allNotifications as $notification) {
        if ((int) ($notification['is_read'] ?? 0) === 0) {
            $notifCount++;
        }
    }

    // Tampilkan maksimal 8 notifikasi terbaru
    $latestNotifs = array_slice($allNotifications, 0, 8);
}
?>


        <!-- =============================================================== -->
        <!-- NOTIFIKASI -->
        <!-- =============================================================== -->

        <li class="nav-item dropdown cosmic-notif-dropdown mx-2">

            <a class="nav-link position-relative px-2 d-flex align-items-center"
               href="#"
               id="cosmicNotifDropdown"
               role="button"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false"
               title="Pusat Notifikasi Tiket">

                <div class="cosmic-bell-container">

                    <i class="fas fa-bell cosmic-bell-icon"></i>

                    <?php if ($notifCount > 0): ?>

                        <span class="cosmic-pulse-ring"></span>

                        <span class="position-absolute badge cosmic-badge-count text-white"
                              id="cosmicBadgeCount"
                              style="top:-3px; right:-5px;">

                            <?= $notifCount ?>

                        </span>

                    <?php endif; ?>

                </div>

            </a>


            <!-- Dropdown -->
            <div class="dropdown-menu dropdown-menu-right border-0 py-0 shadow-lg"
                 aria-labelledby="cosmicNotifDropdown">


                <!-- Header -->
                <div class="cosmic-header-box text-white">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h6 class="font-weight-bold mb-0 text-white"
                            style="font-size:1rem;">

                            <i class="fas fa-satellite-dish mr-2"
                               style="color:#a5b4fc;"></i>

                            Pusat Notifikasi Tiket

                        </h6>


                        <?php if ($notifCount > 0): ?>

                            <button type="button"
                                    class="cosmic-btn-readall"
                                    id="cosmicBtnMarkAll"
                                    onclick="cosmicMarkAllAsRead(event)">

                                <i class="fas fa-check-double mr-1"></i>
                                Baca Semua

                            </button>

                        <?php endif; ?>

                    </div>


                    <div class="d-flex justify-content-between align-items-center">

                        <div class="btn-group">

                            <button type="button"
                                    class="cosmic-filter-tab active mr-1"
                                    onclick="cosmicFilter('all', this, event)">

                                Semua

                            </button>

                            <button type="button"
                                    class="cosmic-filter-tab"
                                    onclick="cosmicFilter('unread', this, event)">

                                Baru
                                <span id="cosmicUnreadTabCount">
                                    (<?= $notifCount ?>)
                                </span>

                            </button>

                        </div>


                        <span class="badge font-weight-bold px-2 py-1"
                              id="cosmicHeaderStatusCount"
                              style="border-radius:8px;
                                     font-size:.74rem;
                                     background:#fff;
                                     color:#2b3990 !important;">

                            <?= $notifCount ?> Belum Dibaca

                        </span>

                    </div>

                </div>


                <!-- List Notifikasi -->
                <div class="list-group list-group-flush cosmic-scroll-area"
                     id="cosmicNotifListContainer">

                    <?php if (!empty($latestNotifs)): ?>

                       <?php foreach ($latestNotifs as $index => $notif): ?>

    <?php
    $message = $notif['message'] ?? 'Ada notifikasi baru.';

    $notificationId = $notif['id'] ?? '';

    $isUnread = (int) ($notif['is_read'] ?? 0) === 0;

    $ticketNumber = '-';

    if (preg_match('/Tiket\s+([A-Za-z0-9\-]+)/i', $message, $match)) {
        $ticketNumber = $match[1];
    }

    $namaPemohon = 'Pemohon';

    if (preg_match('/dari\s+(.+?)\s+telah masuk/i', $message, $match)) {
        $namaPemohon = trim($match[1]);
    }

    $inisial = strtoupper(
        substr(trim($namaPemohon), 0, 1)
    );
    ?>

    <a href="<?= esc($notif['url'] ?? base_url('datatiket')) ?>"
       class="list-group-item list-group-item-action p-3 cosmic-notif-item <?= $isUnread ? 'unread' : '' ?>"
       data-id="<?= esc($notificationId) ?>"
       onclick="cosmicMarkSingleAsRead(this)">

        <div class="d-flex align-items-start">

            <div class="cosmic-avatar-box mr-3">
                <?= esc($inisial) ?>
            </div>

            <div class="w-100">

                <div class="d-flex w-100 justify-content-between align-items-center mb-1">

                    <span class="cosmic-ticket-pill">
                        <i class="fas fa-ticket-alt mr-1"></i>
                        <?= esc($ticketNumber) ?>
                    </span>

                    <div class="d-flex align-items-center">

                        <small class="text-muted mr-2"
                               style="font-size:.72rem;">

                            <i class="far fa-clock mr-1"></i>

                            <?= esc($notif['created_at'] ?? '') ?>

                        </small>

                        <?php if ($isUnread): ?>
                            <span class="cosmic-dot-indicator"></span>
                        <?php endif; ?>

                    </div>

                </div>

                <p class="mb-0 text-dark"
                   style="font-size:.85rem; line-height:1.5;">

                    <strong>
                        <?= esc($notif['title'] ?? 'Notifikasi') ?>
                    </strong>

                    <br>

                    <?= esc($message) ?>

                </p>

            </div>

        </div>

    </a>

<?php endforeach; ?>


                    <?php else: ?>

                        <div class="text-center py-5 px-3"
                             id="cosmicEmptyState">

                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width:65px;
                                        height:65px;
                                        color:#94a3b8;
                                        font-size:1.6rem;">

                                <i class="fas fa-check-circle text-success"></i>

                            </div>


                            <h6 class="font-weight-bold text-dark mb-1"
                                style="font-size:.95rem;">

                                Semua Tiket Telah Ditinjau

                            </h6>


                            <p class="text-muted mb-0"
                               style="font-size:.78rem;">

                                Tidak ada notifikasi tiket masuk baru
                                yang tertunda saat ini.

                            </p>

                        </div>

                    <?php endif; ?>

                </div>


                <!-- Footer -->
                <div class="p-2 text-center bg-light border-top">

                    <a href="<?= base_url('datatiket') ?>"
                       class="font-weight-bold d-block py-1"
                       style="font-size:.84rem;
                              text-decoration:none;
                              color:#2b3990;">

                        Kelola Seluruh Data Tiket Masuk

                        <i class="fas fa-arrow-right ml-1"></i>

                    </a>

                </div>

            </div>

        </li>


        <!-- =============================================================== -->
        <!-- PROFILE -->
        <!-- =============================================================== -->

        <?php
        $namaUser = session()->get('name')
            ?? session()->get('full_name')
            ?? 'Petugas ULT';

        $inisialUser = strtoupper(
            substr(trim($namaUser), 0, 2)
        );
        ?>


        <li class="nav-item dropdown ml-2">

            <a class="nav-link text-white d-flex align-items-center px-2 py-1 rounded-pill"
               data-toggle="dropdown"
               href="#"
               style="background:rgba(255,255,255,.08);
                      border:1px solid rgba(255,255,255,.15);">

                <span class="rounded-circle d-flex align-items-center justify-content-center"
                      style="width:34px;
                             height:34px;
                             background:#4f46e5;
                             color:white;
                             font-weight:700;">

                    <?= esc($inisialUser) ?>

                </span>


                <span class="ml-2 font-weight-bold d-none d-lg-inline text-white"
                      style="font-size:.9rem;">

                    <?= esc($namaUser) ?>

                </span>


                <i class="fas fa-chevron-down ml-2 text-white-50"
                   style="font-size:.7rem;"></i>

            </a>


            <div class="dropdown-menu dropdown-menu-right border-0 shadow-lg py-2 mt-2"
                 style="border-radius:16px; width:220px;">

                <div class="px-3 py-2 border-bottom mb-1">

                    <span class="d-block font-weight-bold text-dark"
                          style="font-size:.88rem;">

                        <?= esc($namaUser) ?>

                    </span>

                    <span class="d-block text-muted"
                          style="font-size:.72rem;">

                        <?= esc(session()->get('email') ?? '') ?>

                    </span>

                </div>


                <a href="<?= base_url('profile') ?>"
                   class="dropdown-item px-3 py-2 text-dark">

                    <i class="fas fa-user-circle mr-2 text-primary"></i>

                    Profil Saya

                </a>


                <a href="<?= base_url('datatiket') ?>"
                   class="dropdown-item px-3 py-2 text-dark">

                    <i class="fas fa-ticket-alt mr-2 text-info"></i>

                    Manajemen Tiket

                </a>


                <div class="dropdown-divider my-1"></div>


                <a href="<?= base_url('logout') ?>"
                   class="dropdown-item px-3 py-2 text-danger">

                    <i class="fas fa-sign-out-alt mr-2"></i>

                    Keluar Sistem

                </a>

            </div>

        </li>

    </ul>

</nav>


<style>

/* ============================================================= */
/* COSMIC NAVBAR */
/* ============================================================= */

.cosmic-notif-dropdown .dropdown-menu {

    width:440px !important;
    max-width:96vw !important;

    border-radius:22px !important;

    border:1px solid rgba(255,255,255,.35) !important;

    background:rgba(255,255,255,.98) !important;

    backdrop-filter:blur(30px) saturate(210%);

    box-shadow:
        0 30px 60px -15px rgba(43,57,144,.5),
        0 0 20px rgba(79,70,229,.15) !important;

    overflow:hidden;

    padding:0 !important;

    margin-top:16px !important;
}


.cosmic-bell-container {

    position:relative;

    display:inline-flex;

    align-items:center;

    justify-content:center;

    width:45px;

    height:45px;

    border-radius:16px;

    background:rgba(255,255,255,.08);

    border:1px solid rgba(255,255,255,.15);

    transition:all .35s ease;

}


.cosmic-bell-container:hover {

    background:rgba(255,255,255,.22);

    border-color:rgba(255,255,255,.4);

    transform:translateY(-2px) scale(1.04);

}


.cosmic-bell-icon {

    color:#fff;

    font-size:1.3rem;

}


.cosmic-pulse-ring {

    position:absolute;

    top:5px;

    right:5px;

    width:9px;

    height:9px;

    background:#ef4444;

    border-radius:50%;

}


.cosmic-badge-count {

    font-size:.68rem;

    font-weight:900;

    padding:.35em .65em;

    background:linear-gradient(135deg,#ef4444,#dc2626);

    border:2px solid #2b3990;

    border-radius:50rem;

}


.cosmic-header-box {

    background:#2b3990 !important;

    padding:20px 24px;

}


.cosmic-filter-tab {

    font-size:.76rem;

    font-weight:700;

    padding:6px 16px;

    border-radius:25px;

    background:rgba(255,255,255,.1);

    color:rgba(255,255,255,.85);

    border:1px solid rgba(255,255,255,.18);

}


.cosmic-filter-tab.active {

    background:#fff;

    color:#2b3990;

}


.cosmic-btn-readall {

    font-size:.75rem;

    font-weight:700;

    color:#fff;

    background:rgba(255,255,255,.15);

    padding:6px 14px;

    border-radius:10px;

    border:1px solid rgba(255,255,255,.25);

}


.cosmic-notif-item {

    border-left:5px solid transparent;

    text-decoration:none !important;

    background:#fff;

    border-bottom:1px solid rgba(0,0,0,.04);

}


.cosmic-notif-item.unread {

    background:rgba(43,57,144,.04);

    border-left-color:#2b3990;

}


.cosmic-avatar-box {

    width:45px;

    height:45px;

    border-radius:15px;

    background:#2b3990;

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-weight:800;

    flex-shrink:0;

}


.cosmic-ticket-pill {

    background:rgba(43,57,144,.08);

    color:#2b3990;

    font-weight:700;

    font-size:.74rem;

    padding:3px 10px;

    border-radius:7px;

}


.cosmic-dot-indicator {

    width:9px;

    height:9px;

    background:#2b3990;

    border-radius:50%;

    display:inline-block;

}


.cosmic-scroll-area {

    max-height:380px;

    overflow-y:auto;

}

</style>


<script>

function cosmicMarkSingleAsRead(item) {

    if (!item.classList.contains('unread')) {
        return;
    }

    const notificationId = item.dataset.id;

    if (!notificationId) {
        return;
    }

    fetch('<?= base_url('notifications/read/') ?>' + notificationId, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: '<?= csrf_token() ?>=<?= csrf_hash() ?>'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal membaca notifikasi.');
        }

        return response.json();
    })
    .then(data => {

        if (!data.success) {
            return;
        }

        item.classList.remove('unread');

        const dot = item.querySelector('.cosmic-dot-indicator');

        if (dot) {
            dot.style.transform = 'scale(0)';
            dot.style.opacity = '0';
        }

        cosmicUpdateCounters();

    })
    .catch(error => {
        console.error(error);
    });
}


function cosmicMarkAllAsRead(e) {

    if (e) {
        e.stopPropagation();
    }

    fetch('<?= base_url('notifications/read-all') ?>', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: '<?= csrf_token() ?>=<?= csrf_hash() ?>'
    })
    .then(response => {

        if (!response.ok) {
            throw new Error('Gagal membaca semua notifikasi.');
        }

        return response.json();
    })
    .then(data => {

        if (!data.success) {
            return;
        }

        const items =
            document.querySelectorAll('.cosmic-notif-item.unread');

        items.forEach(item => {

            item.classList.remove('unread');

            const dot =
                item.querySelector('.cosmic-dot-indicator');

            if (dot) {
                dot.style.transform = 'scale(0)';
                dot.style.opacity = '0';
            }

        });

        cosmicUpdateCounters(true);

    })
    .catch(error => {
        console.error(error);
    });
}


function cosmicUpdateCounters(allCleared = false) {

    const unreadList =
        document.querySelectorAll('.cosmic-notif-item.unread');

    const count =
        allCleared ? 0 : unreadList.length;

    const badge =
        document.getElementById('cosmicBadgeCount');

    const pulse =
        document.querySelector('.cosmic-pulse-ring');

    const header =
        document.getElementById('cosmicHeaderStatusCount');

    const tab =
        document.getElementById('cosmicUnreadTabCount');

    if (badge) {

        badge.innerText = count;

        if (count === 0) {
            badge.style.display = 'none';
        } else {
            badge.style.display = '';
        }

    }

    if (pulse) {

        if (count === 0) {
            pulse.style.display = 'none';
        } else {
            pulse.style.display = '';
        }

    }

    if (header) {
        header.innerText = count + ' Belum Dibaca';
    }

    if (tab) {
        tab.innerText = '(' + count + ')';
    }

}

</script>
