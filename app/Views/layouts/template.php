<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SI ULT POLBAN</title>

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/style.css') ?>">

    <style>
        /* Modern Background Sidebar Warna Solid Sesuai Foto (#2b3990) */
        .main-sidebar {
            background: #2b3990 !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            transition: width 0.3s ease-in-out, margin-left 0.3s ease-in-out !important;
        }

        /* Nav Link Base Style */
        .nav-sidebar .nav-item .nav-link {
            border-radius: 12px !important;
            transition: all 0.2s ease;
            color: rgba(255, 255, 255, 0.85);
            padding: 10px 14px;
            margin-bottom: 4px;
        }

        /* Warna Menu Aktif: Oranye Elegan */
        .nav-sidebar .nav-item .nav-link.active {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
            font-weight: 700;
        }

        /* Fix Posisi Ikon Supaya Presisi di Tengah Saat Sidebar Ditutup */
        body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link {
            text-align: center;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link .nav-icon {
            margin-right: 0 !important;
            font-size: 1.2rem;
            width: 100% !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .user-panel {
            padding-left: 0 !important;
            padding-right: 0 !important;
            justify-content: center !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .user-panel .image {
            margin: 0 auto !important;
            float: none !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .brand-link {
            text-align: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .brand-link .brand-image {
            margin: 0 auto !important;
            float: none !important;
        }

        /* Sembunyikan Header Kategori Saat Ditutup */
        body.sidebar-collapse .main-sidebar:not(:hover) .nav-header {
            display: none !important;
        }

        /* ==========================================
           FLOATING MODERN TOAST NOTIFICATION SYSTEM
           ========================================== */
        #toast-container-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 380px;
            width: 100%;
            pointer-events: none;
        }

        .custom-toast {
            pointer-events: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12), 0 1px 8px rgba(0, 0, 0, 0.06);
            padding: 16px 18px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            position: relative;
            overflow: hidden;
            transform: translateX(120%);
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease;
            border-left: 5px solid #ccc;
        }

        .custom-toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .custom-toast.hide {
            transform: translateX(120%);
            opacity: 0;
        }

        /* Varian Jenis Notifikasi */
        .custom-toast.success { border-left-color: #10b981; }
        .custom-toast.success .toast-icon { color: #10b981; background: rgba(16, 185, 129, 0.1); }

        .custom-toast.error { border-left-color: #ef4444; }
        .custom-toast.error .toast-icon { color: #ef4444; background: rgba(239, 68, 68, 0.1); }

        .custom-toast.warning { border-left-color: #f59e0b; }
        .custom-toast.warning .toast-icon { color: #f59e0b; background: rgba(245, 158, 11, 0.1); }

        .custom-toast.info { border-left-color: #3b82f6; }
        .custom-toast.info .toast-icon { color: #3b82f6; background: rgba(59, 130, 246, 0.1); }

        .toast-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .toast-message {
            font-size: 0.875rem;
            color: #4b5563;
            line-height: 1.4;
        }

        .toast-close {
            background: transparent;
            border: none;
            color: #9ca3af;
            font-size: 1rem;
            cursor: pointer;
            padding: 0;
            transition: color 0.2s;
        }

        .toast-close:hover {
            color: #4b5563;
        }

        /* Progress Bar Waktu Mundur */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            background: rgba(0, 0, 0, 0.05);
        }

        .toast-progress-bar {
            height: 100%;
            width: 100%;
            background: currentColor;
            animation: progressCountdown 4s linear forwards;
        }

        .custom-toast.success .toast-progress-bar { background: #10b981; }
        .custom-toast.error .toast-progress-bar { background: #ef4444; }
        .custom-toast.warning .toast-progress-bar { background: #f59e0b; }
        .custom-toast.info .toast-progress-bar { background: #3b82f6; }

        @keyframes progressCountdown {
            0% { width: 100%; }
            100% { width: 0%; }
        }
    </style>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo-polban.png'); ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Container Global untuk Floating Toast Notification -->
    <div id="toast-container-custom"></div>

    <?= view('layouts/navbar') ?>
    <?= view('layouts/sidebar') ?>

    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

</div>

<!-- JavaScript Dependencies -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dummy-notif.js') ?>"></script>

<!-- Script Inisialisasi Global Toast Notification -->
<script>
    function showToast(type, title, message) {
        const container = document.getElementById('toast-container-custom');
        
        let iconClass = 'fas fa-info-circle';
        if (type === 'success') iconClass = 'fas fa-check-circle';
        else if (type === 'error') iconClass = 'fas fa-exclamation-circle';
        else if (type === 'warning') iconClass = 'fas fa-exclamation-triangle';

        const toast = document.createElement('div');
        toast.className = `custom-toast ${type}`;
        toast.innerHTML = `
            <div class="toast-icon">
                <i class="${iconClass}"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" onclick="removeToast(this.parentElement)">
                <i class="fas fa-times"></i>
            </button>
            <div class="toast-progress">
                <div class="toast-progress-bar"></div>
            </div>
        `;

        container.appendChild(toast);

        // Trigger animasi masuk
        setTimeout(() => toast.classList.add('show'), 50);

        // Auto hapus setelah 4 detik
        const timer = setTimeout(() => {
            removeToast(toast);
        }, 4000);

        // Pause timer saat mouse diarahkan ke toast
        toast.addEventListener('mouseenter', () => {
            clearTimeout(timer);
            toast.querySelector('.toast-progress-bar').style.animationPlayState = 'paused';
        });

        toast.addEventListener('mouseleave', () => {
            const resumeTimer = setTimeout(() => {
                removeToast(toast);
            }, 2000);
            toast.querySelector('.toast-progress-bar').style.animationPlayState = 'running';
        });
    }

    function removeToast(toast) {
        toast.classList.remove('show');
        toast.classList.add('hide');
        setTimeout(() => toast.remove(), 400);
    }

    // Integrasi otomatis dengan Flashdata CodeIgniter (jika ada)
    $(document).ready(function() {
        <?php if (session()->getFlashdata('success')): ?>
            showToast('success', 'Berhasil!', '<?= session()->getFlashdata('success') ?>');
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            showToast('error', 'Gagal!', '<?= session()->getFlashdata('error') ?>');
        <?php endif; ?>

        <?php if (session()->getFlashdata('warning')): ?>
            showToast('warning', 'Peringatan!', '<?= session()->getFlashdata('warning') ?>');
        <?php endif; ?>

        <?php if (session()->getFlashdata('info')): ?>
            showToast('info', 'Informasi', '<?= session()->getFlashdata('info') ?>');
        <?php endif; ?>
    });
</script>

</body>
</html>