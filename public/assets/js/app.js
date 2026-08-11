// SI ULT POLBAN - Custom JS
(function () {
    'use strict';

    // Sidebar toggle (for mobile)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault();
            sidebar.classList.toggle('collapsed');
        });
    }

    // Auto-close flash alerts after 5 seconds
    document.querySelectorAll('.alert-auto-dismiss').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity .5s ease';
            alert.style.opacity = '0';
            setTimeout(function () {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Confirm dialog for delete forms
    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            const msg = form.getAttribute('data-confirm') || 'Yakin ingin melanjutkan?';
            if (!window.confirm(msg)) {
                e.preventDefault();
            }
        });
    });

    // DataTable init helper
    window.initDataTable = function (selector, options) {
        const el = document.querySelector(selector);
        if (el && window.jQuery && window.jQuery.fn && window.jQuery.fn.DataTable) {
            window.jQuery(selector).DataTable(options || {});
        }
    };

})();
