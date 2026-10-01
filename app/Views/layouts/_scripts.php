<?php
/**
 * =====================================================================
 *  SCRIPTS TUNGGAL — SI ULT POLBAN
 * =====================================================================
 *
 *  Daftar JavaScript terpusat. Semua dependensi dimuat dari folder
 *  lokal (tidak ada CDN) supaya halaman admin, pemohon, dan unit
 *  memakai versi pustaka yang sama.
 */
?>
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Drop-down searchable (Select2) + tema ULT -->
<script src="<?= base_url('assets/adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/select2/js/i18n/id.js') ?>"></script>

<script src="<?= base_url('assets/adminlte/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>
<script src="<?= base_url('assets/js/petugas.js') ?>"></script>
<script src="<?= base_url('assets/js/ult-select.js') ?>"></script>

<!-- Pustaka grafik & ekspor dimuat dari ASET LOKAL (tanpa CDN) supaya:
     1. semua dashboard memakai versi Chart.js yang sama,
     2. halaman tetap jalan tanpa koneksi internet.
     Chart.js sudah disertakan AdminLTE; SheetJS diunduh sekali
     lewat tools/fetch_vendor.php. -->
<script src="<?= base_url('assets/adminlte/plugins/chart.js/Chart.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/xlsx.full.min.js') ?>"></script>

<script>
    /* ------------------------------------------------------------------
       Tandai halaman sebagai "JavaScript aktif".
       CSS memakai .js-ready untuk menyalakan animasi reveal. Tanpa baris
       ini, elemen .reveal-item tetap terlihat (aman), hanya tidak
       beranimasi.
    ------------------------------------------------------------------ */
    document.documentElement.classList.add('js-ready');

    /* ------------------------------------------------------------------
       Toast global (flash message CodeIgniter)
    ------------------------------------------------------------------ */
    (function () {
        const container = () => document.getElementById('toast-container-custom');

        if (!container()) {
            return;
        }

        window.showToast = function (type, title, message) {
            const box = container();
            if (!box) {
                return;
            }

            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle',
            };

            const toast = document.createElement('div');
            toast.className = 'custom-toast ' + type;
            toast.innerHTML =
                '<div class="toast-icon"><i class="' + (icons[type] || icons.info) + '"></i></div>' +
                '<div class="toast-content">' +
                    '<div class="toast-title">' + title + '</div>' +
                    '<div class="toast-message">' + message + '</div>' +
                '</div>' +
                '<button class="toast-close" onclick="removeToast(this.parentElement)">' +
                    '<i class="fas fa-times"></i>' +
                '</button>' +
                '<div class="toast-progress"><div class="toast-progress-bar"></div></div>';

            box.appendChild(toast);
            setTimeout(function () { toast.classList.add('show'); }, 50);

            const timer = setTimeout(function () { removeToast(toast); }, 4500);

            toast.addEventListener('mouseenter', function () { clearTimeout(timer); });
        };

        window.removeToast = function (toast) {
            if (!toast) {
                return;
            }
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(function () { toast.remove(); }, 400);
        };

        /* ------------------------------------------------------------------
           SIDEBAR: scroll balik ke atas + menu aktif selalu terlihat
        ------------------------------------------------------------------ */
        (function () {
            const side  = document.querySelector('.main-sidebar .sidebar');
            const menu  = document.querySelector('.main-sidebar .ult-menu');
            const links = menu ? menu.querySelectorAll('.nav-link') : [];

            /* 1. Saat menu diklik, posisi scroll sidebar dikembalikan ke atas
                  supaya halaman berikutnya tidak menampilkan menu "melayang". */
            Array.prototype.forEach.call(links, function (link) {
                link.addEventListener('click', function () {
                    if (! side) {
                        return;
                    }

                    // smooth supaya tidak terlihat "melompat"
                    if (typeof side.scrollTo === 'function') {
                        side.scrollTo({ top: 0, behavior: 'smooth' });
                    }

                    // fallback untuk browser lama
                    setTimeout(function () { side.scrollTop = 0; }, 320);
                });
            });

            /* 2. Saat halaman baru dimuat, menu yang aktif digeser ke area
                  terlihat (tidak terpotong atas maupun bawah). */
            document.addEventListener('DOMContentLoaded', function () {
                if (! side || ! menu) {
                    return;
                }

                const active = menu.querySelector('.nav-link.active');

                if (! active) {
                    return;
                }

                const sideBox = side.getBoundingClientRect();
                const itemBox = active.getBoundingClientRect();
                const offset  = itemBox.top - sideBox.top;

                // hanya geser kalau menu aktif berada di luar area terlihat
                if (offset < 0 || offset > sideBox.height - itemBox.height - 12) {
                    side.scrollTop = side.scrollTop + offset - sideBox.height / 2 + itemBox.height / 2;
                }
            });
        })();


        document.addEventListener('DOMContentLoaded', function () {
            const flash = <?= json_encode([
                'success' => session()->getFlashdata('success'),
                'error'   => session()->getFlashdata('error'),
                'warning' => session()->getFlashdata('warning'),
                'info'    => session()->getFlashdata('info'),
            ]) ?>;

            if (flash.success) { window.showToast('success', 'Berhasil!', flash.success); }
            if (flash.error)   { window.showToast('error', 'Gagal!', flash.error); }
            if (flash.warning) { window.showToast('warning', 'Perhatian!', flash.warning); }
            if (flash.info)    { window.showToast('info', 'Informasi', flash.info); }
        });
    })();
</script>

<?= $this->renderSection('scripts') ?>
