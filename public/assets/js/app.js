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

    // ============================================================
    // REALTIME ("data selalu berubah -> UI ikut berubah")
    // Polling ringan setiap 15 detik ke endpoint JSON.
    // ============================================================
    const RT_INTERVAL = 15000;

    const STATUS_MAP = {
        draft: ['Draft', 'secondary'],
        submitted: ['Diajukan', 'warning'],
        verification: ['Verifikasi', 'info'],
        revision: ['Revisi', 'secondary'],
        processing: ['Diproses', 'primary'],
        completed: ['Selesai', 'success'],
        rejected: ['Ditolak', 'danger'],
        cancelled: ['Dibatalkan', 'danger']
    };

    const baseMeta = document.querySelector('meta[name="base-url"]');
    const BASE_URL = ((baseMeta && baseMeta.getAttribute('content')) || '/').replace(/\/+$/, '') + '/';

    function escapeHtml(value) {
        const el = document.createElement('span');
        el.textContent = value == null ? '' : String(value);
        return el.innerHTML;
    }

    function statusBadge(status) {
        const cfg = STATUS_MAP[status] || [String(status || '').replace(/_/g, ' '), 'secondary'];
        return '<span class="badge bg-' + cfg[1] + '">' + escapeHtml(cfg[0]) + '</span>';
    }

    async function fetchJson(url) {
        const res = await fetch(url, { credentials: 'same-origin' });
        if (!res.ok) {
            throw new Error('HTTP ' + res.status);
        }
        return res.json();
    }

    function updateNotificationUi(count, items) {
        const badge = document.getElementById('rt-notif-badge');
        if (badge) {
            badge.textContent = String(count);
            badge.style.display = count > 0 ? '' : 'none';
        }

        const header = document.getElementById('rt-notif-count');
        if (header) {
            header.textContent = count + ' Notifikasi';
        }

        const box = document.getElementById('rt-notif-items');
        if (!box) {
            return;
        }

        if (!items || items.length === 0) {
            box.innerHTML = '<li><a class="dropdown-item text-muted" href="' + BASE_URL + 'notifications">' +
                '<em>Tidak ada notifikasi baru.</em></a></li>';
            return;
        }

        let html = '';
        items.forEach(function (n) {
            const url = n.url ? n.url : (BASE_URL + 'notifications');
            html += '<li><a class="dropdown-item" href="' + escapeHtml(url) + '">' +
                '<div class="d-flex justify-content-between">' +
                '<strong class="small">' + escapeHtml(n.title) + '</strong>' +
                '<small class="text-muted ms-2 text-nowrap">' + escapeHtml(n.created_at || '') + '</small>' +
                '</div>' +
                '<div class="small text-muted text-truncate" style="max-width:260px;">' + escapeHtml(n.message) + '</div>' +
                '</a></li>';
        });
        box.innerHTML = html;
    }

    async function refreshNotifications() {
        try {
            const data = await fetchJson(BASE_URL + 'realtime/notifications');
            if (data && data.status) {
                updateNotificationUi(data.data.count, data.data.items);
            }
        } catch (e) {
            // abaikan - akan dicoba lagi pada interval berikutnya
        }
    }
async function refreshDashboard() {
        try {
            const data = await fetchJson(BASE_URL + 'realtime/dashboard');
            if (data && data.status) {
                document.querySelectorAll('.rt-value[data-rt-key]').forEach(function (el) {
                    const key = el.getAttribute('data-rt-key');
                    if (key in data.data) {
                        el.textContent = data.data[key];
                    }
                });
            }
        } catch (e) {
            // abaikan
        }

        try {
            const data = await fetchJson(BASE_URL + 'realtime/tickets-last/6');
            const tbody = document.getElementById('rt-latest-tickets');

            if (!data || !data.status || !tbody) {
                return;
            }

            const tickets = data.data.tickets || [];

            if (tickets.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-4">Belum ada pengajuan.</td></tr>';
                return;
            }

            let html = '';
            tickets.forEach(function (t) {
                const url = BASE_URL + 'tracking/show/' + t.id;
                html += '<tr>' +
                    '<td><a href="' + url + '" class="fw-semibold text-decoration-none">' + escapeHtml(t.ticket_number) + '</a></td>' +
                    '<td><div class="fw-semibold">' + escapeHtml(t.title) + '</div>' +
                    '<small class="text-muted">' + escapeHtml(t.service_name || '-') + '</small></td>' +
                    '<td>' + escapeHtml(t.applicant_name || '-') + '</td>' +
                    '<td>' + statusBadge(t.status) + '</td>' +
                    '<td class="text-end"><a href="' + url + '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a></td>' +
                    '</tr>';
            });
            tbody.innerHTML = html;
        } catch (e) {
            // abaikan
        }
    }

    // Mulai polling notifikasi pada seluruh halaman
    refreshNotifications();
    setInterval(refreshNotifications, RT_INTERVAL);

    // Aktifkan polling dashboard bila elemen dashboard ada di halaman
    if (document.querySelector('.rt-value') || document.getElementById('rt-latest-tickets')) {
        refreshDashboard();
        setInterval(refreshDashboard, RT_INTERVAL);
    }

})();
