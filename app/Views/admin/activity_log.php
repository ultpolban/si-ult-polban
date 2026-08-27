<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold"><i class="bi bi-clock-history me-2 text-primary"></i>Activity Log</h4>
        <small class="text-muted">Riwayat aktivitas seluruh pengguna sistem</small>
    </div>
    <span class="badge bg-primary fs-6"><?= number_format($total) ?> Log</span>
</div>

<div class="card shadow-sm border-0">
    <!-- Filter Bar -->
    <div class="card-header bg-white py-3 border-bottom">
        <form method="GET" action="<?= base_url('activity-log') ?>" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" 
                           name="keyword" 
                           class="form-control border-start-0" 
                           placeholder="Cari user, aksi, atau modul..."
                           value="<?= esc($keyword) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="module" class="form-select">
                    <option value="">-- Semua Modul --</option>
                    <?php foreach ($modules as $mod) : ?>
                        <option value="<?= esc($mod) ?>" <?= $module === $mod ? 'selected' : '' ?>>
                            <?= esc(ucfirst($mod)) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <?php if ($keyword || $module) : ?>
                    <a href="<?= base_url('activity-log') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width:50px;">No</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Modul</th>
                        <th>IP Address</th>
                        <th>Tanggal & Waktu</th>
                        <th class="pe-4 text-center" style="width:80px;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)) : ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                                <?= ($keyword || $module) ? 'Tidak ada log yang cocok.' : 'Belum ada aktivitas tercatat.' ?>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($logs as $i => $log) : ?>
                            <?php
                                $action = $log['action'] ?? '';
                                $actionMap = [
                                    'login'             => ['label' => 'Login',             'icon' => 'bi-box-arrow-in-right', 'class' => 'bg-success'],
                                    'logout'            => ['label' => 'Logout',            'icon' => 'bi-box-arrow-right',    'class' => 'bg-secondary'],
                                    'create_user'       => ['label' => 'Buat User',         'icon' => 'bi-person-plus',        'class' => 'bg-primary'],
                                    'update_user'       => ['label' => 'Edit User',         'icon' => 'bi-person-gear',        'class' => 'bg-warning text-dark'],
                                    'delete_user'       => ['label' => 'Hapus User',        'icon' => 'bi-person-dash',        'class' => 'bg-danger'],
                                    'CREATE_DEPARTMENT' => ['label' => 'Buat Jurusan',      'icon' => 'bi-building-add',       'class' => 'bg-info text-dark'],
                                    'UPDATE_DEPARTMENT' => ['label' => 'Edit Jurusan',      'icon' => 'bi-building-gear',      'class' => 'bg-warning text-dark'],
                                    'create_ticket'     => ['label' => 'Buat Tiket',        'icon' => 'bi-ticket-perforated',  'class' => 'bg-primary'],
                                ];
                                $actionInfo = $actionMap[$action] ?? ['label' => ucwords(str_replace('_', ' ', $action)), 'icon' => 'bi-activity', 'class' => 'bg-secondary'];
                                
                                $num = (($page - 1) * $perPage) + $i + 1;
                            ?>
                            <tr>
                                <td class="ps-4 text-muted"><?= $num ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;min-width:36px;">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-sm"><?= esc($log['user_name'] ?? 'Unknown') ?></div>
                                            <small class="text-muted"><?= esc($log['user_email'] ?? '') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge <?= $actionInfo['class'] ?> d-inline-flex align-items-center gap-1">
                                        <i class="bi <?= $actionInfo['icon'] ?>"></i>
                                        <?= $actionInfo['label'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= esc(ucfirst($log['module'] ?? '-')) ?>
                                    </span>
                                </td>
                                <td>
                                    <code class="text-muted small"><?= esc($log['ip_address'] ?? '-') ?></code>
                                </td>
                                <td>
                                    <div class="fw-semibold small"><?= date('d M Y', strtotime($log['created_at'])) ?></div>
                                    <small class="text-muted"><?= date('H:i:s', strtotime($log['created_at'])) ?></small>
                                </td>
                                <td class="text-center pe-4">
                                    <?php if ($log['new_data'] || $log['old_data']) : ?>
                                        <button class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalDetail"
                                                data-action="<?= esc($actionInfo['label']) ?>"
                                                data-user="<?= esc($log['user_name'] ?? '') ?>"
                                                data-new="<?= esc($log['new_data'] ?? '') ?>"
                                                data-old="<?= esc($log['old_data'] ?? '') ?>"
                                                data-ip="<?= esc($log['ip_address'] ?? '') ?>"
                                                data-time="<?= esc(date('d M Y H:i:s', strtotime($log['created_at']))) ?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    <?php else : ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1) : ?>
    <div class="card-footer bg-white border-top py-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Halaman <?= $page ?> dari <?= $totalPages ?> (<?= number_format($total) ?> total)
        </small>
        <nav>
            <ul class="pagination pagination-sm mb-0 gap-1">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>&keyword=<?= urlencode($keyword) ?>&module=<?= urlencode($module) ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($p = max(1, $page - 2); $p <= min($totalPages, $page + 2); $p++) : ?>
                    <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $p ?>&keyword=<?= urlencode($keyword) ?>&module=<?= urlencode($module) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>&keyword=<?= urlencode($keyword) ?>&module=<?= urlencode($module) ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-info-circle me-2 text-primary"></i>Detail Aktivitas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="text-muted small">User</label>
                        <div class="fw-semibold" id="detail-user"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Aksi</label>
                        <div class="fw-semibold" id="detail-action"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">IP Address</label>
                        <div><code id="detail-ip"></code></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Waktu</label>
                        <div class="fw-semibold" id="detail-time"></div>
                    </div>
                </div>
                <div id="detail-new-block" class="mb-3">
                    <label class="text-muted small">Data Baru</label>
                    <pre class="bg-light p-3 rounded small" id="detail-new" style="max-height:200px;overflow:auto;"></pre>
                </div>
                <div id="detail-old-block" class="mb-2">
                    <label class="text-muted small">Data Lama</label>
                    <pre class="bg-light p-3 rounded small" id="detail-old" style="max-height:200px;overflow:auto;"></pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('modalDetail').addEventListener('show.bs.modal', function (event) {
    const btn = event.relatedTarget;
    document.getElementById('detail-user').textContent   = btn.dataset.user;
    document.getElementById('detail-action').textContent = btn.dataset.action;
    document.getElementById('detail-ip').textContent     = btn.dataset.ip;
    document.getElementById('detail-time').textContent   = btn.dataset.time;

    const newData = btn.dataset.new;
    const oldData = btn.dataset.old;

    const newBlock = document.getElementById('detail-new-block');
    const oldBlock = document.getElementById('detail-old-block');

    if (newData) {
        try { document.getElementById('detail-new').textContent = JSON.stringify(JSON.parse(newData), null, 2); }
        catch { document.getElementById('detail-new').textContent = newData; }
        newBlock.classList.remove('d-none');
    } else {
        newBlock.classList.add('d-none');
    }

    if (oldData) {
        try { document.getElementById('detail-old').textContent = JSON.stringify(JSON.parse(oldData), null, 2); }
        catch { document.getElementById('detail-old').textContent = oldData; }
        oldBlock.classList.remove('d-none');
    } else {
        oldBlock.classList.add('d-none');
    }
});
</script>

<?= $this->endSection() ?>
