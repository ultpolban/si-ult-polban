<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">Manajemen Tiket</h4>
        <small class="text-muted">Kelola dan pantau seluruh tiket layanan.</small>
    </div>
    <a href="<?= base_url('tiket/buat') ?>" class="btn btn-primary btn-sm px-3 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Buat Tiket
    </a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <!-- Filter Bar -->
    <div class="card-header bg-white py-3 border-bottom">
        <form method="GET" action="<?= base_url('tiket/manajemen') ?>" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" 
                           name="keyword" 
                           class="form-control border-start-0 bg-light" 
                           placeholder="Cari tiket / judul / pemohon..."
                           value="<?= esc($keyword) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select bg-light text-muted">
                    <option value="">Semua Status</option>
                    <option value="submitted" <?= $status === 'submitted' ? 'selected' : '' ?>>Diajukan</option>
                    <option value="processing" <?= $status === 'processing' ? 'selected' : '' ?>>Diproses</option>
                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Selesai</option>
                    <option value="rejected" <?= $status === 'rejected' ? 'selected' : '' ?>>Ditolak</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="priority" class="form-select bg-light text-muted">
                    <option value="">Semua Prioritas</option>
                    <option value="normal" <?= $priority === 'normal' ? 'selected' : '' ?>>Normal</option>
                    <option value="high" <?= $priority === 'high' ? 'selected' : '' ?>>Penting</option>
                    <option value="urgent" <?= $priority === 'urgent' ? 'selected' : '' ?>>Mendesak</option>
                </select>
            </div>
            <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-primary shadow-sm">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 border-bottom">
                <thead class="table-light text-muted" style="font-size: 0.85rem;">
                    <tr>
                        <th class="ps-4 fw-semibold" style="width:50px;">No</th>
                        <th class="fw-semibold">No. Tiket</th>
                        <th class="fw-semibold">Judul</th>
                        <th class="fw-semibold">Pemohon</th>
                        <th class="fw-semibold">Layanan</th>
                        <th class="fw-semibold">Status</th>
                        <th class="fw-semibold">Prioritas</th>
                        <th class="fw-semibold">Tanggal</th>
                        <th class="pe-4 fw-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.9rem;">
                    <?php if (empty($tiket)) : ?>
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                                <?= ($keyword || $status || $priority) ? 'Tidak ada tiket yang sesuai kriteria pencarian.' : 'Belum ada tiket.' ?>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($tiket as $i => $t) : ?>
                            <?php
                                // Status badge mapping
                                $st = $t['status'] ?? 'submitted';
                                $statusMap = [
                                    'submitted'   => ['label' => 'Diajukan',  'class' => 'bg-warning text-dark'],
                                    'processing'  => ['label' => 'Diproses',  'class' => 'bg-info text-dark'],
                                    'verification'=> ['label' => 'Verifikasi','class' => 'bg-primary'],
                                    'revision'    => ['label' => 'Revisi',    'class' => 'bg-warning text-dark'],
                                    'completed'   => ['label' => 'Selesai',   'class' => 'bg-success'],
                                    'rejected'    => ['label' => 'Ditolak',   'class' => 'bg-danger'],
                                    'cancelled'   => ['label' => 'Dibatalkan','class' => 'bg-secondary'],
                                ];
                                $statusInfo = $statusMap[$st] ?? ['label' => ucfirst($st), 'class' => 'bg-secondary'];

                                // Priority badge mapping
                                $pr = $t['priority'] ?? 'normal';
                                $priorityMap = [
                                    'normal' => ['label' => 'Normal',   'class' => 'bg-info bg-opacity-10 text-info border border-info border-opacity-25'],
                                    'high'   => ['label' => 'Penting',  'class' => 'bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25'],
                                    'urgent' => ['label' => 'Mendesak', 'class' => 'bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25'],
                                ];
                                $priorityInfo = $priorityMap[$pr] ?? ['label' => ucfirst($pr), 'class' => 'bg-secondary'];
                                
                                $num = (($page - 1) * $perPage) + $i + 1;
                            ?>
                            <tr>
                                <td class="ps-4 text-muted"><?= $num ?></td>
                                <td>
                                    <span class="badge bg-info rounded-pill px-3 py-2 text-white shadow-sm" style="background-color: #3b82f6 !important;">
                                        <?= esc($t['ticket_number']) ?>
                                    </span>
                                </td>
                                <td class="fw-medium text-dark"><?= esc($t['title']) ?></td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= esc($t['pemohon_nama'] ?? 'Unknown') ?></div>
                                    <small class="text-muted"><?= esc($t['pemohon_tipe'] ?? '-') ?></small>
                                </td>
                                <td>
                                    <div class="text-dark"><?= esc($t['layanan_nama'] ?? '-') ?></div>
                                    <small class="text-muted"><?= esc($t['unit_nama'] ?? '-') ?></small>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 shadow-sm <?= $statusInfo['class'] ?>">
                                        <?= $statusInfo['label'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2 <?= $priorityInfo['class'] ?>">
                                        <?= $priorityInfo['label'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="text-dark"><?= date('Y-m-d H:i:s', strtotime($t['created_at'])) ?></div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button type="button" class="btn btn-sm btn-info text-white shadow-sm btn-view"
                                            data-ticket="<?= esc($t['ticket_number']) ?>"
                                            data-title="<?= esc($t['title']) ?>"
                                            data-pemohon="<?= esc($t['pemohon_nama'] ?? '-') ?>"
                                            data-layanan="<?= esc($t['layanan_nama'] ?? '-') ?>"
                                            data-status="<?= esc($statusInfo['label']) ?>"
                                            data-priority="<?= esc($priorityInfo['label']) ?>"
                                            data-created="<?= esc($t['created_at']) ?>"
                                            data-description="<?= esc($t['description'] ?? '-') ?>"
                                            title="Lihat" data-bs-toggle="modal" data-bs-target="#modalView">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-warning text-white shadow-sm btn-edit"
                                            data-id="<?= $t['id'] ?>"
                                            data-title="<?= esc($t['title']) ?>"
                                            data-description="<?= esc($t['description'] ?? '') ?>"
                                            data-status="<?= esc($st) ?>"
                                            data-priority="<?= esc($pr) ?>"
                                            title="Edit" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="<?= base_url('tiket/delete/' . $t['id']) ?>" method="post" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus tiket ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger text-white shadow-sm" title="Hapus">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
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
    <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Menampilkan <?= count($tiket) ?> dari <?= number_format($total) ?> tiket
        </small>
        <nav>
            <ul class="pagination pagination-sm mb-0 gap-1">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link rounded shadow-sm" href="?page=<?= $page - 1 ?>&keyword=<?= urlencode($keyword) ?>&status=<?= urlencode($status) ?>&priority=<?= urlencode($priority) ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for ($p = max(1, $page - 2); $p <= min($totalPages, $page + 2); $p++) : ?>
                    <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                        <a class="page-link rounded shadow-sm" href="?page=<?= $p ?>&keyword=<?= urlencode($keyword) ?>&status=<?= urlencode($status) ?>&priority=<?= urlencode($priority) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link rounded shadow-sm" href="?page=<?= $page + 1 ?>&keyword=<?= urlencode($keyword) ?>&status=<?= urlencode($status) ?>&priority=<?= urlencode($priority) ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
</div>

<!-- Modal detail tiket -->
<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="modalViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="modalViewLabel">Detail Tiket</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">No. Tiket</dt><dd class="col-sm-9" id="view_ticket">-</dd>
                    <dt class="col-sm-3">Judul</dt><dd class="col-sm-9" id="view_title">-</dd>
                    <dt class="col-sm-3">Pemohon</dt><dd class="col-sm-9" id="view_pemohon">-</dd>
                    <dt class="col-sm-3">Layanan</dt><dd class="col-sm-9" id="view_layanan">-</dd>
                    <dt class="col-sm-3">Status</dt><dd class="col-sm-9" id="view_status">-</dd>
                    <dt class="col-sm-3">Prioritas</dt><dd class="col-sm-9" id="view_priority">-</dd>
                    <dt class="col-sm-3">Tanggal</dt><dd class="col-sm-9" id="view_created">-</dd>
                    <dt class="col-sm-3">Deskripsi</dt><dd class="col-sm-9 text-break" id="view_description">-</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit tiket -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="formEditTicket">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title" id="modalEditLabel">Edit Tiket</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Judul</label><input type="text" class="form-control" name="title" id="edit_title" required></div>
                    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="description" id="edit_description" rows="3"></textarea></div>
                    <div class="row g-3">
                        <div class="col-6"><label class="form-label">Status</label><select class="form-select" name="status" id="edit_status"><option value="submitted">Diajukan</option><option value="verification">Verifikasi</option><option value="revision">Revisi</option><option value="processing">Diproses</option><option value="completed">Selesai</option><option value="rejected">Ditolak</option><option value="cancelled">Dibatalkan</option></select></div>
                        <div class="col-6"><label class="form-label">Prioritas</label><select class="form-select" name="priority" id="edit_priority"><option value="low">Rendah</option><option value="normal">Normal</option><option value="high">Penting</option><option value="urgent">Mendesak</option></select></div>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Styling khusus tabel tiket agar mirip referensi */
    .table-hover tbody tr:hover {
        background-color: #f8fafc;
        transition: all 0.2s;
    }
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.15);
    }
    .btn-primary {
        background-color: #2563eb;
        border-color: #2563eb;
    }
    .btn-primary:hover {
        background-color: #1d4ed8;
        border-color: #1e40af;
    }
    .btn-info {
        background-color: #06b6d4;
        border-color: #06b6d4;
    }
    .btn-warning {
        background-color: #f59e0b;
        border-color: #f59e0b;
    }
    .btn-danger {
        background-color: #ef4444;
        border-color: #ef4444;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-view').forEach(button => button.addEventListener('click', function () {
        ['ticket', 'title', 'pemohon', 'layanan', 'status', 'priority', 'created', 'description'].forEach(field => {
            document.getElementById('view_' + field).textContent = this.dataset[field] || '-';
        });
    }));
    document.querySelectorAll('.btn-edit').forEach(button => button.addEventListener('click', function () {
        document.getElementById('formEditTicket').action = '<?= base_url('tiket/update') ?>/' + this.dataset.id;
        document.getElementById('edit_title').value = this.dataset.title || '';
        document.getElementById('edit_description').value = this.dataset.description || '';
        document.getElementById('edit_status').value = this.dataset.status || 'submitted';
        document.getElementById('edit_priority').value = this.dataset.priority || 'normal';
    }));
});
</script>

<?= $this->endSection() ?>
