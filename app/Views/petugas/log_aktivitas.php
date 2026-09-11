<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root {
    --polban-navy: #1a237e;
    --polban-blue: #005bac;
    --polban-orange: #ff8c00;
    --polban-yellow: #f4c400;
    --polban-green: #117a43;
    --soft-bg: #f4f6f9;
    --text-dark: #263238;
    --text-muted: #6c757d;
}

body,
.container-fluid {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    color: var(--text-dark);
}

.log-page {
    animation: pageFadeIn .45s ease;
}

.log-title {
    color: var(--polban-navy);
    font-weight: 800;
    letter-spacing: -.4px;
}

.log-subtitle {
    color: #718096;
    font-size: .95rem;
}

/* =========================
   STATISTIC CARDS
========================= */

.stat-tamu-card {
    border-radius: 18px;
    border: none;
    color: #ffffff;
    transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.stat-tamu-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -30%;
    width: 180px;
    height: 180px;
    background: rgba(255, 255, 255, 0.12);
    border-radius: 50%;
    z-index: -1;
    transition: transform .5s ease;
}

.stat-tamu-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, .15) !important;
}

.stat-tamu-card:hover::before {
    transform: scale(1.25);
}

.bg-tamu-navy {
    background: linear-gradient(135deg, #1a237e 0%, #283593 100%) !important;
}

.bg-tamu-orange {
    background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%) !important;
}

.bg-tamu-yellow {
    background: linear-gradient(135deg, #f4c400 0%, #fb8c00 100%) !important;
}

.bg-tamu-green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
}

.icon-tamu-circle {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: rgba(255, 255, 255, .22);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    box-shadow: inset 0 0 12px rgba(255, 255, 255, .25);
}

/* =========================
   FILTER
========================= */

.filter-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, .04);
    border: 1px solid #edf0f4;
    position: relative;
    z-index: 50;
    overflow: visible !important;
}

.filter-control {
    border-radius: 8px;
    border: 1px solid #dcdfe6;
    padding: 8px 12px;
    font-size: .875rem;
    color: #4a5568;
    height: 42px;
    width: 100%;
}

.filter-control:focus {
    border-color: var(--polban-blue);
    box-shadow: 0 0 0 3px rgba(0, 91, 172, .15);
    outline: none;
}

.search-input-group {
    position: relative;
    width: 100%;
}

.search-input-group .search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #1e293b;
    font-size: .95rem;
    z-index: 5;
}

.search-input-group input {
    padding-left: 38px;
}

.btn-polban-filter {
    background-color: #121970;
    color: #ffffff;
    font-weight: 600;
    border-radius: 8px;
    height: 42px;
    padding: 0 20px;
    border: none;
    font-size: .9rem;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-polban-filter:hover {
    background-color: #0a0e4a;
    color: #ffffff;
}

.btn-reset {
    background-color: #64748b;
    color: #ffffff;
    border-radius: 8px;
    height: 42px;
    width: 42px;
    padding: 0;
    border: none;
    font-size: .95rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-reset:hover {
    background-color: #475569;
    color: #ffffff;
}

/* =========================
   TABLE
========================= */

.log-card {
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0, 0, 0, .07);
    background: #fff;
    position: relative;
    z-index: 1;
}

.log-table-header {
    background: #fff;
    padding: 18px 20px;
    border-bottom: 1px solid #edf0f4;
}

.log-table-title {
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 800;
}

.log-table-title i {
    color: var(--polban-blue);
}

.log-table {
    margin-bottom: 0;
    width: 100%;
}

.log-table thead {
    background: var(--polban-navy);
}

.log-table thead th {
    color: #fff;
    border: 0;
    font-size: .85rem;
    font-weight: 700;
    padding: 14px 16px;
    white-space: nowrap;
}

.log-table tbody td {
    padding: 16px;
    vertical-align: middle;
    border-color: #edf0f4;
    font-size: .9rem;
}

.log-table tbody tr:hover {
    background-color: #f8f9ff;
}

.time-date {
    font-weight: 700;
    color: #263238;
}

.time-sub {
    font-size: .8rem;
    color: #6c757d;
}

.actor-name {
    font-weight: 700;
    color: #263238;
}

/* =========================
   BADGES
========================= */

.badge-activity {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: .8rem;
    font-weight: 700;
}

.badge-disposisi {
    background-color: #ffe8cc;
    color: #d97706;
}

.badge-verifikasi {
    background-color: #d1e7dd;
    color: #0f5132;
}

.badge-export {
    background-color: #e2d9f3;
    color: #432874;
}

.badge-login {
    background-color: #cff4fc;
    color: #055160;
}

.ticket-link {
    font-weight: 700;
    color: var(--polban-blue);
    text-decoration: none;
}

.ticket-link:hover {
    text-decoration: underline;
}

/* =========================
   EMPTY
========================= */

.empty-log {
    padding: 45px 20px;
    text-align: center;
    color: #94a3b8;
}

.empty-log i {
    font-size: 2.5rem;
    margin-bottom: 12px;
}

/* =========================
   PAGINATION
========================= */

.pagination-wrapper {
    padding: 16px 20px;
    border-top: 1px solid #edf0f4;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.pagination-info {
    font-size: .85rem;
    color: #64748b;
}

.pagination-custom {
    display: flex;
    gap: 5px;
}

.pagination-custom a,
.pagination-custom span {
    min-width: 34px;
    height: 34px;
    padding: 0 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 7px;
    text-decoration: none;
    border: 1px solid #e2e8f0;
    color: #475569;
    background: #fff;
    font-size: .85rem;
    font-weight: 600;
}

.pagination-custom a:hover {
    background: #f1f5f9;
}

.pagination-custom .active {
    background: var(--polban-navy);
    color: #fff;
    border-color: var(--polban-navy);
}

.pagination-custom .disabled {
    color: #cbd5e1;
    pointer-events: none;
}

/* =========================
   ANIMATION
========================= */

@keyframes pageFadeIn {
    from {
        opacity: 0;
        transform: translateY(8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.reveal-item {
    opacity: 0;
    transform: translateY(12px);
}

.reveal-item.show {
    opacity: 1;
    transform: translateY(0);
    transition: all .4s ease;
}
</style>

<div class="container-fluid px-4 py-4 log-page">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1 log-title" style="font-size:1.75rem;">
                Log Aktivitas Sistem
            </h1>

            <p class="log-subtitle mb-0">
                Pantau seluruh riwayat aktivitas pengguna dan perubahan data sistem.
            </p>
        </div>
    </div>

    <!-- STATISTIC CARDS -->
    <div class="row g-3 mb-4">

        <!-- TOTAL LOG -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Total Log
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= esc($totalLog ?? 0) ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-history"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGIN -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            User Login
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= esc($totalLogin ?? 0) ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGOUT -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            User Logout
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= esc($totalLogout ?? 0) ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- OTHER -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Aktivitas Lainnya
                        </span>

                        <h2 class="fw-extrabold mb-0 text-white mt-1">
                            <?= esc($totalLainnya ?? 0) ?>
                        </h2>
                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-database"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- FILTER -->
    <div class="filter-card mb-4 reveal-item">

        <form action="<?= base_url('log-aktivitas') ?>" method="GET">

            <div class="row g-2 align-items-center">

                <!-- SEARCH -->
                <div class="col-md-3">
                    <div class="search-input-group">

                        <i class="fas fa-search search-icon"></i>

                        <input
                            type="text"
                            name="keyword"
                            class="form-control filter-control"
                            placeholder="Cari nama / aksi / referensi..."
                            value="<?= esc($keyword ?? '') ?>"
                        >

                    </div>
                </div>

                <!-- ROLE -->
                <div class="col-md-2">

                    <select name="role" class="form-select filter-control">

                        <option value="">
                            Semua Role
                        </option>

                        <option value="Admin"
                            <?= ($role ?? '') === 'Admin' ? 'selected' : '' ?>>
                            Admin
                        </option>

                        <option value="Petugas"
                            <?= ($role ?? '') === 'Petugas' ? 'selected' : '' ?>>
                            Petugas
                        </option>

                        <option value="Pengguna"
                            <?= ($role ?? '') === 'Pengguna' ? 'selected' : '' ?>>
                            Pengguna
                        </option>

                    </select>

                </div>

                <!-- AKSI -->
                <div class="col-md-2">

                    <select name="aksi" class="form-select filter-control">

                        <option value="">
                            Semua Aksi
                        </option>

                        <option value="User Login"
                            <?= ($aksi ?? '') === 'User Login' ? 'selected' : '' ?>>
                            User Login
                        </option>

                        <option value="User Logout"
                            <?= ($aksi ?? '') === 'User Logout' ? 'selected' : '' ?>>
                            User Logout
                        </option>

                        <option value="Aktivitas Data"
                            <?= ($aksi ?? '') === 'Aktivitas Data' ? 'selected' : '' ?>>
                            Aktivitas Data
                        </option>

                    </select>

                </div>

                <!-- LIMIT -->
                <div class="col-md-1" style="max-width:90px;">

                    <input
                        type="number"
                        name="limit"
                        class="form-control filter-control text-center"
                        value="<?= esc($limit ?? 10) ?>"
                        min="1"
                        max="100"
                    >

                </div>

                <!-- BUTTON -->
                <div class="col-md-2 d-flex gap-1">

                    <button type="submit" class="btn btn-polban-filter">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>

                    <a
                        href="<?= base_url('log-aktivitas') ?>"
                        class="btn btn-reset"
                        title="Reset Filter"
                    >
                        <i class="fas fa-redo-alt"></i>
                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="card log-card reveal-item">

        <div class="log-table-header d-flex justify-content-between align-items-center">

            <div>

                <div class="log-table-title">
                    <i class="fas fa-history me-2"></i>
                    Riwayat Log Aktivitas
                </div>

                <small class="text-muted">
                    Menampilkan catatan aktivitas yang tersimpan di dalam sistem
                </small>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table log-table align-middle">

                    <thead>

                        <tr>
                            <th class="text-center" style="width:60px;">
                                No
                            </th>

                            <th>
                                Waktu & Tanggal
                            </th>

                            <th>
                                Aktor / Pelaku
                            </th>

                            <th>
                                Role
                            </th>

                            <th>
                                Jenis Aksi
                            </th>

                            <th>
                                Referensi
                            </th>

                            <th>
                                Detail Catatan Aktivitas
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if (!empty($logs)): ?>

                        <?php foreach ($logs as $idx => $log): ?>

                            <?php
                            $nomor = (($currentPage ?? 1) - 1) * ($limit ?? 10)
                                + $idx + 1;
                            ?>

                            <tr>

                                <!-- NO -->
                                <td class="text-center fw-bold text-muted">
                                    <?= $nomor ?>
                                </td>

                                <!-- WAKTU -->
                                <td>

                                    <div class="time-date">
                                        <?= esc($log['tanggal'] ?? '-') ?>
                                    </div>

                                    <div class="time-sub">
                                        <?= esc($log['jam'] ?? '-') ?> WIB
                                    </div>

                                </td>

                                <!-- AKTOR -->
                                <td>

                                    <div class="actor-name">
                                        <?= esc($log['aktor'] ?? 'User') ?>
                                    </div>

                                    <?php if (!empty($log['username'])): ?>

                                        <small class="text-muted">
                                            @<?= esc($log['username']) ?>
                                        </small>

                                    <?php endif; ?>

                                </td>

                                <!-- ROLE -->
                                <td>

                                    <span
                                        class="badge bg-light text-dark border px-2 py-1"
                                        style="border-radius:6px;font-size:.75rem;"
                                    >
                                        <?= esc($log['role'] ?? '-') ?>
                                    </span>

                                </td>

                                <!-- AKSI -->
                                <td>

                                    <span class="badge-activity <?= esc($log['aksi_class'] ?? 'badge-login') ?>">

                                        <i class="fas <?= esc($log['aksi_icon'] ?? 'fa-database') ?>"></i>

                                        <?= esc($log['aksi_label'] ?? 'Aktivitas') ?>

                                    </span>

                                </td>

                                <!-- REFERENSI -->
                                <td>

                                    <?php if (($log['referensi'] ?? '-') !== '-'): ?>

                                        <span class="ticket-link">
                                            <?= esc($log['referensi']) ?>
                                        </span>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- DETAIL -->
                                <td>

                                    <span class="text-dark">
                                        <?= esc($log['detail'] ?? '-') ?>
                                    </span>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7">

                                <div class="empty-log">

                                    <i class="fas fa-history"></i>

                                    <div class="fw-bold">
                                        Belum ada log aktivitas
                                    </div>

                                    <small>
                                        Data aktivitas akan muncul setelah terdapat aktivitas di sistem.
                                    </small>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- PAGINATION -->
        <?php if (($totalFiltered ?? 0) > 0): ?>

            <div class="pagination-wrapper">

                <div class="pagination-info">

                    Menampilkan
                    <strong><?= esc($startData ?? 0) ?></strong>
                    -
                    <strong><?= esc($endData ?? 0) ?></strong>

                    dari
                    <strong><?= esc($totalFiltered ?? 0) ?></strong>
                    log

                </div>

                <?php if (($totalPages ?? 1) > 1): ?>

                    <div class="pagination-custom">

                        <?php if (($currentPage ?? 1) > 1): ?>

                            <a href="<?= base_url('log-aktivitas?' . http_build_query([
                                'keyword' => $keyword ?? '',
                                'role'    => $role ?? '',
                                'aksi'    => $aksi ?? '',
                                'limit'   => $limit ?? 10,
                                'page'    => ($currentPage ?? 1) - 1
                            ])) ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>

                        <?php else: ?>

                            <span class="disabled">
                                <i class="fas fa-chevron-left"></i>
                            </span>

                        <?php endif; ?>

                        <?php
                        $startPage = max(1, ($currentPage ?? 1) - 2);
                        $endPage   = min(($totalPages ?? 1), ($currentPage ?? 1) + 2);
                        ?>

                        <?php for ($p = $startPage; $p <= $endPage; $p++): ?>

                            <?php if ($p == ($currentPage ?? 1)): ?>

                                <span class="active">
                                    <?= $p ?>
                                </span>

                            <?php else: ?>

                                <a href="<?= base_url('log-aktivitas?' . http_build_query([
                                    'keyword' => $keyword ?? '',
                                    'role'    => $role ?? '',
                                    'aksi'    => $aksi ?? '',
                                    'limit'   => $limit ?? 10,
                                    'page'    => $p
                                ])) ?>">
                                    <?= $p ?>
                                </a>

                            <?php endif; ?>

                        <?php endfor; ?>

                        <?php if (($currentPage ?? 1) < ($totalPages ?? 1)): ?>

                            <a href="<?= base_url('log-aktivitas?' . http_build_query([
                                'keyword' => $keyword ?? '',
                                'role'    => $role ?? '',
                                'aksi'    => $aksi ?? '',
                                'limit'   => $limit ?? 10,
                                'page'    => ($currentPage ?? 1) + 1
                            ])) ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>

                        <?php else: ?>

                            <span class="disabled">
                                <i class="fas fa-chevron-right"></i>
                            </span>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>

            </div>

        <?php endif; ?>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    setTimeout(function () {

        document
            .querySelectorAll('.reveal-item')
            .forEach(function (item) {
                item.classList.add('show');
            });

    }, 100);

});
</script>

<?= $this->endSection() ?>