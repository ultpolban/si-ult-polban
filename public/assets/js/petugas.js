/* ==========================================================
   SI ULT POLBAN - JS PETUGAS
   Helper kecil untuk halaman petugas & halaman publik.
   ========================================================== */

(function () {
    'use strict';

    /* ----------------------------------------------------------
       Auto-hide flash alert (kecuali alert error)
    ---------------------------------------------------------- */
    function initFlashAutoHide() {
        var alerts = document.querySelectorAll('.alert[data-autohide="true"]');

        Array.prototype.forEach.call(alerts, function (el) {
            window.setTimeout(function () {
                el.style.transition = 'opacity .4s ease';
                el.style.opacity = '0';

                window.setTimeout(function () {
                    if (el.parentNode) {
                        el.parentNode.removeChild(el);
                    }
                }, 400);
            }, 6000);
        });
    }

    /* ----------------------------------------------------------
       Konfirmasi sebelum submit form sensitif
    ---------------------------------------------------------- */
    function initConfirmForms() {
        var forms = document.querySelectorAll('form[data-confirm]');

        Array.prototype.forEach.call(forms, function (form) {
            form.addEventListener('submit', function (e) {
                var message = form.getAttribute('data-confirm') || 'Lanjutkan aksi ini?';

                if (! window.confirm(message)) {
                    e.preventDefault();
                }
            });
        });
    }

    /* ----------------------------------------------------------
       Konfirmasi pada link/button aksi (hapus, tolak, dll)
    ---------------------------------------------------------- */
    function initConfirmLinks() {
        var links = document.querySelectorAll('[data-confirm-link]');

        Array.prototype.forEach.call(links, function (link) {
            link.addEventListener('click', function (e) {
                var message = link.getAttribute('data-confirm-link') || 'Yakin ingin melanjutkan?';

                if (! window.confirm(message)) {
                    e.preventDefault();
                }
            });
        });
    }

    /* ----------------------------------------------------------
       Kunci tombol submit agar tidak terkirim dua kali
    ---------------------------------------------------------- */
    function initSubmitLock() {
        var forms = document.querySelectorAll('form[data-lock-submit]');

        Array.prototype.forEach.call(forms, function (form) {
            form.addEventListener('submit', function () {
                var btn = form.querySelector('button[type="submit"]');

                if (btn) {
                    btn.disabled = true;
                    btn.style.opacity = '.7';
                }
            });
        });
    }

    /* ----------------------------------------------------------
       Filter tabel sederhana (cari di dalam tabel)
    ---------------------------------------------------------- */
    function initTableSearch() {
        var inputs = document.querySelectorAll('[data-table-search]');

        Array.prototype.forEach.call(inputs, function (input) {
            var target = document.getElementById(input.getAttribute('data-table-search'));

            if (! target) {
                return;
            }

            input.addEventListener('keyup', function () {
                var term = input.value.toLowerCase();
                var rows = target.querySelectorAll('tbody tr');

                Array.prototype.forEach.call(rows, function (row) {
                    row.style.display = row.textContent.toLowerCase().indexOf(term) !== -1 ? '' : 'none';
                });
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initFlashAutoHide();
        initConfirmForms();
        initConfirmLinks();
        initSubmitLock();
        initTableSearch();
    });
})();
