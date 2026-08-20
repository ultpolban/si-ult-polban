<!-- ========================================================================= -->
<!-- NAVBAR UTAMA - SI-ULT POLBAN (COSMIC-TIER ENTERPRISE EDITION)              -->
<!-- ========================================================================= -->
<nav class="main-header navbar navbar-expand shadow-lg border-0" style="background: linear-gradient(135deg, #0d1242 0%, #1a237e 50%, #2B2E83 100%); min-height: 70px; transition: all 0.3s ease;">

    <!-- Tombol Toggle Sidebar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white px-3 py-2 rounded-pill ml-2" data-widget="pushmenu" href="#" role="button" style="background: rgba(255, 255, 255, 0.08); transition: all 0.25s ease;" onmouseover="this.style.background='rgba(255,255,255,0.18)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                <i class="fas fa-bars fa-lg"></i>
            </a>
        </li>
    </ul>

    <!-- Brand / Judul Sistem Interaktif -->
    <ul class="navbar-nav ml-3 d-none d-md-flex align-items-center">
        <li class="nav-item d-flex align-items-center">
            <div class="brand-logo-glow mr-2 p-1 rounded-circle" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(5px);">
                <img src="<?= base_url('assets/img/logo-polban.png') ?>" width="36" height="36" alt="Logo Polban" style="object-fit: contain;">
            </div>
            <div>
                <span class="font-weight-bold text-white d-block" style="font-size: 1.05rem; letter-spacing: 0.8px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                    Sistem Informasi Unit Layanan Terpadu
                </span>
                <span class="d-block text-light" style="font-size: 0.7rem; opacity: 0.8; letter-spacing: 0.5px;">
                    Politeknik Negeri Bandung • Enterprise Dashboard
                </span>
            </div>
        </li>
    </ul>

    <!-- Right Navbar Menu (Notifikasi & Profil) -->
    <ul class="navbar-nav ml-auto align-items-center mr-3">

        <?php
        // Logika Pengambilan Data Notifikasi Tiket Masuk (Submitted)
        $notifCount = 0;
        $latestNotifs = [];

        if (isset($tiket_list) && is_array($tiket_list)) {
            foreach ($tiket_list as $t) {
                if (strtolower(trim($t['status'] ?? '')) === 'submitted') {
                    $notifCount++;
                    if (count($latestNotifs) < 8) {
                        $latestNotifs[] = $t;
                    }
                }
            }
        }
        ?>

        <!-- STYLING CSS LEVEL DEWA DI ATAS DEWA (NAVBAR NOTIFICATION) -->
        <style>
        /* Dropdown Cosmic Glassmorphism */
        .cosmic-notif-dropdown .dropdown-menu {
            width: 440px !important;
            max-width: 96vw !important;
            border-radius: 22px !important;
            border: 1px solid rgba(255, 255, 255, 0.35) !important;
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(30px) saturate(210%);
            -webkit-backdrop-filter: blur(30px) saturate(210%);
            box-shadow: 0 30px 60px -15px rgba(13, 18, 66, 0.5), 0 0 20px rgba(79, 70, 229, 0.15) !important;
            transform-origin: top right;
            animation: cosmicDropdownIn 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            padding: 0 !important;
            margin-top: 16px !important;
        }

        @keyframes cosmicDropdownIn {
            0% { opacity: 0; transform: scale(0.9) translateY(-15px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* Tombol Lonceng Interaktif */
        .cosmic-bell-container {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .cosmic-notif-dropdown:hover .cosmic-bell-container,
        .cosmic-notif-dropdown.show .cosmic-bell-container {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }

        .cosmic-bell-icon {
            color: #ffffff;
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .cosmic-notif-dropdown:hover .cosmic-bell-icon {
            animation: cosmicBellShake 0.6s ease-in-out infinite alternate;
        }

        @keyframes cosmicBellShake {
            0% { transform: rotate(0deg); }
            20% { transform: rotate(20deg); }
            40% { transform: rotate(-20deg); }
            60% { transform: rotate(14deg); }
            80% { transform: rotate(-10deg); }
            100% { transform: rotate(0deg); }
        }

        /* Efek Gelombang Radar / Pulse Ring */
        .cosmic-pulse-ring {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 9px;
            height: 9px;
            background-color: #ef4444;
            border-radius: 50%;
            z-index: 2;
        }

        .cosmic-pulse-ring::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border: 2px solid #ef4444;
            border-radius: 50%;
            animation: cosmicPulseWave 1.8s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }

        @keyframes cosmicPulseWave {
            0% { transform: scale(0.4); opacity: 1; }
            80% { transform: scale(2.5); opacity: 0; }
            100% { transform: scale(3); opacity: 0; }
        }

        .cosmic-badge-count {
            font-size: 0.68rem;
            font-weight: 900;
            padding: 0.35em 0.65em;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: 2px solid #1a237e;
            border-radius: 50rem;
            box-shadow: 0 3px 10px rgba(239, 68, 68, 0.5);
        }

        /* Header Notifikasi Gradient Megah */
        .cosmic-header-box {
            background: linear-gradient(135deg, #0d1242 0%, #1a237e 60%, #312e81 100%);
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            position: relative;
            overflow: hidden;
        }

        .cosmic-header-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
            pointer-events: none;
        }

        .cosmic-filter-tab {
            font-size: 0.76rem;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .cosmic-filter-tab:hover {
            background: rgba(255, 255, 255, 0.22);
            color: #ffffff;
        }

        .cosmic-filter-tab.active {
            background: #ffffff;
            color: #1a237e;
            font-weight: 800;
            border-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .cosmic-btn-readall {
            font-size: 0.75rem;
            font-weight: 700;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            border: 1px solid rgba(255, 255, 255, 0.25);
            display: inline-flex;
            align-items: center;
        }

        .cosmic-btn-readall:hover {
            background: rgba(255, 255, 255, 0.3);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* Item Baris Notifikasi */
        .cosmic-notif-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 5px solid transparent;
            text-decoration: none !important;
            background: #ffffff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            position: relative;
        }

        .cosmic-notif-item.unread {
            background: rgba(26, 35, 126, 0.04);
            border-left-color: #4f46e5;
        }

        .cosmic-notif-item:hover {
            background-color: rgba(79, 70, 229, 0.07) !important;
            transform: translateX(3px);
        }

        .cosmic-avatar-box {
            width: 45px;
            height: 45px;
            border-radius: 15px;
            background: linear-gradient(135deg, #1a237e 0%, #4f46e5 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(26, 35, 126, 0.3);
        }

        .cosmic-ticket-pill {
            background: rgba(79, 70, 229, 0.08);
            color: #4f46e5;
            font-weight: 700;
            font-size: 0.74rem;
            padding: 3px 10px;
            border-radius: 7px;
            border: 1px solid rgba(79, 70, 229, 0.15);
        }

        .cosmic-dot-indicator {
            width: 9px;
            height: 9px;
            background: #4f46e5;
            border-radius: 50%;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 0 8px rgba(79, 70, 229, 0.6);
        }

        .cosmic-scroll-area {
            max-height: 380px;
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        .cosmic-scroll-area::-webkit-scrollbar {
            width: 6px;
        }

        .cosmic-scroll-area::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .cosmic-scroll-area::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .cosmic-scroll-area::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        </style>

        <!-- Dropdown Menu Lonceng Navbar -->
        <li class="nav-item dropdown cosmic-notif-dropdown mx-2">
            <a class="nav-link position-relative px-2 d-flex align-items-center" href="#" id="cosmicNotifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Pusat Notifikasi Tiket">
                <div class="cosmic-bell-container">
                    <i class="fas fa-bell cosmic-bell-icon"></i>
                    
                    <?php if ($notifCount > 0): ?>
                        <span class="cosmic-pulse-ring" id="cosmicPulseRing"></span>
                        <span class="position-absolute top-0 start-100 translate-middle badge cosmic-badge-count text-white" id="cosmicBadgeCount">
                            <?= $notifCount ?>
                        </span>
                    <?php endif; ?>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right border-0 py-0 shadow-lg" aria-labelledby="cosmicNotifDropdown">
                
                <!-- Header Card Notifikasi -->
                <div class="cosmic-header-box text-white">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="font-weight-bold mb-0 text-white d-flex align-items-center" style="font-size: 1rem;">
                            <i class="fas fa-satellite-dish mr-2" style="color: #a5b4fc;"></i> Pusat Notifikasi Tiket
                        </h6>
                        <?php if ($notifCount > 0): ?>
                            <span class="cosmic-btn-readall" id="cosmicBtnMarkAll" onclick="cosmicMarkAllAsRead(event)" title="Tandai seluruhnya telah dibaca">
                                <i class="fas fa-check-double mr-1.5"></i> Baca Semua
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="cosmic-filter-tab active mr-1" onclick="cosmicFilter('all', this, event)">Semua</button>
                            <button type="button" class="cosmic-filter-tab" onclick="cosmicFilter('unread', this, event)">
                                Baru <span id="cosmicUnreadTabCount">(<?= $notifCount ?>)</span>
                            </button>
                        </div>
                        <span class="badge text-primary font-weight-bold px-2.5 py-1" id="cosmicHeaderStatusCount" style="border-radius: 8px; font-size: 0.74rem; background: #ffffff; color: #1a237e !important;">
                            <?= $notifCount ?> Belum Dibaca
                        </span>
                    </div>
                </div>

                <!-- Konten List Notifikasi -->
                <div class="list-group list-group-flush cosmic-scroll-area" id="cosmicNotifListContainer">
                    <?php if (!empty($latestNotifs)): ?>
                        <?php foreach ($latestNotifs as $index => $notif): ?>
                            <?php 
                                $namaPemohon = esc($notif['nama_pemohon'] ?? 'Mahasiswa / Tamu');
                                $inisial = strtoupper(substr($namaPemohon, 0, 1));
                            ?>
                            <a href="<?= base_url('petugas/detail/' . ($notif['id'] ?? 1)) ?>" 
                               class="list-group-item list-group-item-action p-3.5 cosmic-notif-item unread" 
                               data-index="<?= $index ?>"
                               onclick="cosmicMarkSingleAsRead(this)">
                                <div class="d-flex align-items-start">
                                    <div class="cosmic-avatar-box mr-3">
                                        <?= $inisial ?>
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex w-100 justify-content-between align-items-center mb-1.5">
                                            <span class="cosmic-ticket-pill">
                                                <i class="fas fa-ticket-alt mr-1"></i><?= esc($notif['nomor_tiket'] ?? 'ULT-00X') ?>
                                            </span>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted mr-2 font-weight-semibold" style="font-size: 0.72rem;">
                                                    <i class="far fa-clock mr-1"></i>Baru Saja
                                                </small>
                                                <span class="cosmic-dot-indicator" title="Belum dibaca"></span>
                                            </div>
                                        </div>
                                        <p class="mb-0 text-dark" style="font-size: 0.85rem; line-height: 1.5;">
                                            <strong><?= $namaPemohon ?></strong> mengajukan permohonan 
                                            <span class="text-primary font-weight-bold"><?= esc($notif['layanan'] ?? 'Layanan ULT Polban') ?></span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5 px-3" id="cosmicEmptyState">
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 65px; height: 65px; color: #94a3b8; font-size: 1.6rem;">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <h6 class="font-weight-bold text-dark mb-1" style="font-size: 0.95rem;">Semua Tiket Telah Ditinjau</h6>
                            <p class="text-muted mb-0" style="font-size: 0.78rem;">Tidak ada notifikasi tiket masuk baru yang tertunda saat ini.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Footer Dropdown -->
                <div class="p-2.5 text-center bg-light border-top">
                    <a href="<?= base_url('petugas/tiket') ?>" class="text-primary font-weight-bold d-block py-1" style="font-size: 0.84rem; text-decoration: none; transition: color 0.2s ease;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#007bff'">
                        Kelola Seluruh Data Tiket Masuk <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </li>

        <!-- Dropdown Profil Petugas (Diperindah) -->
        <li class="nav-item dropdown ml-2">
            <a class="nav-link text-white d-flex align-items-center px-2.5 py-1.5 rounded-pill" data-toggle="dropdown" href="#" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); transition: all 0.25s ease;">
                <img src="https://ui-avatars.com/api/?name=Petugas+ULT&background=4f46e5&color=fff" class="img-circle elevation-1" width="34" height="34" alt="Avatar Petugas" style="object-fit: cover;">
                <span class="ml-2 font-weight-bold d-none d-lg-inline text-white" style="font-size: 0.9rem;">Petugas ULT</span>
                <i class="fas fa-chevron-down ml-2 text-white-50" style="font-size: 0.7rem;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow-lg py-2 mt-2" style="border-radius: 16px; width: 220px;">
                <div class="px-3 py-2 border-bottom mb-1">
                    <span class="d-block font-weight-bold text-dark" style="font-size: 0.88rem;">Operator ULT</span>
                    <span class="d-block text-muted" style="font-size: 0.72rem;">petugas@polban.ac.id</span>
                </div>
                <a href="<?= base_url('petugas/profile') ?>" class="dropdown-item px-3 py-2 text-dark font-weight-semibold rounded mx-1 my-0.5" style="font-size: 0.85rem; transition: background 0.2s;">
                    <i class="fas fa-user-circle mr-2 text-primary"></i> Profil Saya
                </a>
                <a href="<?= base_url('petugas/tiket') ?>" class="dropdown-item px-3 py-2 text-dark font-weight-semibold rounded mx-1 my-0.5" style="font-size: 0.85rem; transition: background 0.2s;">
                    <i class="fas fa-ticket-alt mr-2 text-info"></i> Manajemen Tiket
                </a>
                <div class="dropdown-divider my-1"></div>
                <a href="<?= base_url('logout') ?>" class="dropdown-item px-3 py-2 text-danger font-weight-semibold rounded mx-1 my-0.5" style="font-size: 0.85rem; transition: background 0.2s;">
                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar Sistem
                </a>
            </div>
        </li>

    </ul>
</nav>

<!-- JAVASCRIPT ENGINE LEVEL DEWA - INTERAKTIVITAS MAKSIMAL -->
<script>
// Sintetis Efek Suara Audio Web API (Cosmic Chime)
function playCosmicAudioChime() {
    try {
        const AudioCtx = window.AudioContext || window.webkitAudioContext;
        if (!AudioCtx) return;
        const ctx = new AudioCtx();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        
        osc.type = 'sine';
        osc.frequency.setValueAtTime(587.33, ctx.currentTime); // Nada D5
        osc.frequency.exponentialRampToValueAtTime(880.00, ctx.currentTime + 0.2); // Nada A5
        
        gain.gain.setValueAtTime(0.12, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.3);
        
        osc.connect(gain);
        gain.connect(ctx.destination);
        
        osc.start();
        osc.stop(ctx.currentTime + 0.3);
    } catch (err) {
        console.log("Audio Context prevented or not supported.");
    }
}

// Tandai Satu Notifikasi Dibaca
function cosmicMarkSingleAsRead(item) {
    if (item.classList.contains('unread')) {
        item.classList.remove('unread');
        const dot = item.querySelector('.cosmic-dot-indicator');
        if (dot) {
            dot.style.transform = 'scale(0)';
            dot.style.opacity = '0';
        }
        cosmicUpdateCounters();
        
        // Sinkronisasi otomatis pengurangan badge di Sidebar secara real-time
        syncSidebarNotificationCounters();
    }
}

// Tandai Semua Notifikasi Dibaca
function cosmicMarkAllAsRead(e) {
    if (e) e.stopPropagation();
    playCosmicAudioChime();

    const items = document.querySelectorAll('.cosmic-notif-item.unread');
    items.forEach((item, index) => {
        setTimeout(() => {
            item.classList.remove('unread');
            const dot = item.querySelector('.cosmic-dot-indicator');
            if (dot) {
                dot.style.transform = 'scale(0)';
                dot.style.opacity = '0';
            }
        }, index * 40);
    });

    setTimeout(() => {
        cosmicUpdateCounters(true);
        syncSidebarNotificationCounters(true);
    }, items.length * 40 + 100);
}

// Update Penghitung Counter secara Dinamis
function cosmicUpdateCounters(allCleared = false) {
    const unreadList = document.querySelectorAll('.cosmic-notif-item.unread');
    const remainingCount = allCleared ? 0 : unreadList.length;

    const badge = document.getElementById('cosmicBadgeCount');
    const pulse = document.getElementById('cosmicPulseRing');
    const headerStatus = document.getElementById('cosmicHeaderStatusCount');
    const unreadTab = document.getElementById('cosmicUnreadTabCount');
    const btnReadAll = document.getElementById('cosmicBtnMarkAll');

    if (remainingCount === 0) {
        if (badge) {
            badge.style.transform = 'scale(0)';
            setTimeout(() => badge.style.display = 'none', 250);
        }
        if (pulse) pulse.style.display = 'none';
        if (headerStatus) headerStatus.innerText = '0 Belum Dibaca';
        if (unreadTab) unreadTab.innerText = '(0)';
        if (btnReadAll) {
            btnReadAll.style.opacity = '0';
            setTimeout(() => btnReadAll.style.display = 'none', 250);
        }
    } else {
        if (badge) badge.innerText = remainingCount;
        if (headerStatus) headerStatus.innerText = remainingCount + ' Belum Dibaca';
        if (unreadTab) unreadTab.innerText = '(' + remainingCount + ')';
    }
}

// Filter Interaktif Notifikasi (Semua / Baru)
function cosmicFilter(type, tabBtn, e) {
    if (e) e.stopPropagation();

    const tabs = document.querySelectorAll('.cosmic-filter-tab');
    tabs.forEach(t => t.classList.remove('active'));
    tabBtn.classList.add('active');

    const items = document.querySelectorAll('.cosmic-notif-item');
    let visibleTotal = 0;

    items.forEach(item => {
        if (type === 'all') {
            item.style.display = 'block';
            visibleTotal++;
        } else if (type === 'unread') {
            if (item.classList.contains('unread')) {
                item.style.display = 'block';
                visibleTotal++;
            } else {
                item.style.display = 'none';
            }
        }
    });

    const emptyBox = document.getElementById('cosmicEmptyState');
    if (emptyBox) {
        emptyBox.style.display = (visibleTotal === 0) ? 'block' : 'none';
    }
}

// Sinkronisasi Interaktif dengan Badge Sidebar
function syncSidebarNotificationCounters(forceZero = false) {
    const sidebarVerifBadge = document.getElementById('sidebar-badge-verifikasi');
    if (sidebarVerifBadge) {
        let currentVal = parseInt(sidebarVerifBadge.innerText) || 0;
        if (forceZero) {
            sidebarVerifBadge.innerText = '0';
            sidebarVerifBadge.style.transform = 'scale(1.2)';
            setTimeout(() => sidebarVerifBadge.style.transform = 'scale(1)', 200);
        } else if (currentVal > 0) {
            let newVal = currentVal - 1;
            sidebarVerifBadge.innerText = newVal;
            sidebarVerifBadge.style.transform = 'scale(1.2)';
            setTimeout(() => sidebarVerifBadge.style.transform = 'scale(1)', 200);
        }
    }
}
</script>