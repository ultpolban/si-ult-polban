/* ==========================================================
   SI ULT POLBAN - STUB NOTIFIKASI
   Menampilkan flash message CI4 sebagai toast ringkas.
   Di-src-kan pada layout admin (layouts/template.php).
   ========================================================== */

(function () {
    'use strict';

    var MESSAGES = {
        success: { cls: 'success', icon: 'fa-check-circle' },
        error:   { cls: 'error',   icon: 'fa-times-circle' },
        warning: { cls: 'warning', icon: 'fa-exclamation-triangle' },
        info:    { cls: 'info',    icon: 'fa-info-circle' }
    };

    function ensureContainer() {
        var id = 'toast-container-custom';
        var el = document.getElementById(id);

        if (! el) {
            el = document.createElement('div');
            el.id = id;
            document.body.appendChild(el);
        }

        return el;
    }

    function showToast(type, title, message) {
        var conf = MESSAGES[type] || MESSAGES.info;
        var box = document.createElement('div');

        box.className = 'custom-toast ' + conf.cls;
        box.setAttribute('role', 'alert');
        box.innerHTML =
            '<div class="toast-body">' +
            '<i class="fas ' + conf.icon + '"></i> ' +
            '<strong>' + (title || '') + '</strong> ' + (message || '') +
            '</div>' +
            '<div class="toast-progress-bar"></div>';

        ensureContainer().appendChild(box);

        window.setTimeout(function () {
            box.style.transition = 'opacity .4s ease';
            box.style.opacity = '0';

            window.setTimeout(function () {
                if (box.parentNode) {
                    box.parentNode.removeChild(box);
                }
            }, 400);
        }, 6000);
    }

    function showFlash() {
        if (typeof window.flashMessages === 'undefined' || ! window.flashMessages) {
            return;
        }

        window.flashMessages.forEach(function (item) {
            showToast(item.type, item.title, item.message);
        });
    }

    document.addEventListener('DOMContentLoaded', showFlash);

    // Jangan timpa showToast yang sudah ada (dipakai layouts/template.php)
    if (typeof window.showToast === 'undefined') {
        window.showToast = showToast;
    }
})();
