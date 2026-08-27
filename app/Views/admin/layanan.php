<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0 text-primary">Master Layanan</h4>
        <small class="text-muted">Kelola data master layanan.</small>
    </div>
    <div>
        <button class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
        </button>
    </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div class="w-100">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari layanan...">
                <button class="btn btn-primary" type="button" style="width: 100px;">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Unit Layanan</th>
                        <th>Kategori</th>
                        <th>Kode</th>
                        <th>Nama Layanan</th>
                        <th>SLA (Jam)</th>
                        <th>Online</th>
                        <th>Status</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($layanan)) : ?>
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                Belum ada data layanan.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($layanan as $key => $row) : ?>
                            <tr>
                                <td class="ps-4"><?= $key + 1 ?></td>
                                <td><?= esc($row['unit_nama'] ?? '-') ?></td>
                                <td><?= esc($row['kategori_nama'] ?? '-') ?></td>
                                <td><?= esc($row['kode'] ?? $row['code'] ?? '-') ?></td>
                                <td><?= esc($row['nama'] ?? $row['name'] ?? '-') ?></td>
                                <td><?= esc($row['sla'] ?? $row['service_hours'] ?? 0) ?> Jam</td>
                                <td>
                                    <?php 
                                        $on = 'bg-secondary';
                                        if (($row['online'] ?? (($row['is_online'] ?? 0) ? 'Online' : 'Offline')) == 'Online') $on = 'bg-primary';
                                    ?>
                                    <span class="badge <?= $on ?>"><?= esc($row['online'] ?? (($row['is_online'] ?? 0) ? 'Online' : 'Offline')) ?></span>
                                </td>
                                <td>
                                    <?php 
                                        $bg = 'bg-danger';
                                        if (($row['status'] ?? (($row['is_active'] ?? 0) ? 'Aktif' : 'Nonaktif')) == 'Aktif') $bg = 'bg-success';
                                    ?>
                                    <span class="badge <?= $bg ?>"><?= esc($row['status'] ?? (($row['is_active'] ?? 0) ? 'Aktif' : 'Nonaktif')) ?></span>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-info text-white btn-view"
                                            data-unit="<?= esc($row['unit_nama'] ?? '-') ?>"
                                            data-kategori="<?= esc($row['kategori_nama'] ?? '-') ?>"
                                            data-kode="<?= esc($row['kode'] ?? $row['code'] ?? '-') ?>"
                                            data-nama="<?= esc($row['nama'] ?? $row['name'] ?? '-') ?>"
                                            data-sla="<?= esc($row['sla'] ?? $row['service_hours'] ?? 0) ?> Jam"
                                            data-online="<?= esc($row['online'] ?? (($row['is_online'] ?? 0) ? 'Online' : 'Offline')) ?>"
                                            data-status="<?= esc($row['status'] ?? (($row['is_active'] ?? 0) ? 'Aktif' : 'Nonaktif')) ?>"
                                            title="View" data-bs-toggle="modal" data-bs-target="#modalView">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning text-dark btn-edit"
                                            data-id="<?= $row['id'] ?>"
                                            data-unit="<?= $row['unit_layanan_id'] ?>"
                                            data-kategori="<?= $row['kategori_layanan_id'] ?>"
                                            data-kode="<?= esc($row['kode'] ?? $row['code'] ?? '-') ?>"
                                            data-nama="<?= esc($row['nama'] ?? $row['name'] ?? '-') ?>"
                                            data-sla="<?= esc($row['sla'] ?? $row['service_hours'] ?? 0) ?>"
                                            data-online="<?= esc($row['online'] ?? (($row['is_online'] ?? 0) ? 'Online' : 'Offline')) ?>"
                                            data-status="<?= esc($row['status'] ?? (($row['is_active'] ?? 0) ? 'Aktif' : 'Nonaktif')) ?>"
                                            title="Edit" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="<?= base_url('layanan/delete/' . $row['id']) ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="modalViewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewLabel">Detail Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Unit</dt><dd class="col-sm-8" id="view_unit">-</dd>
                    <dt class="col-sm-4">Kategori</dt><dd class="col-sm-8" id="view_kategori">-</dd>
                    <dt class="col-sm-4">Kode</dt><dd class="col-sm-8" id="view_kode">-</dd>
                    <dt class="col-sm-4">Nama</dt><dd class="col-sm-8" id="view_nama">-</dd>
                    <dt class="col-sm-4">SLA</dt><dd class="col-sm-8" id="view_sla">-</dd>
                    <dt class="col-sm-4">Tipe</dt><dd class="col-sm-8" id="view_online">-</dd>
                    <dt class="col-sm-4">Status</dt><dd class="col-sm-8" id="view_status">-</dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('layanan/store') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Unit Layanan</label>
                        <select name="unit_layanan_id" class="form-select" required>
                            <option value="">Pilih Unit...</option>
                            <?php foreach ($units as $u) : ?>
                                <option value="<?= $u['id'] ?>"><?= esc($u['nama'] ?? $u['name'] ?? '-') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Layanan</label>
                        <select name="kategori_layanan_id" class="form-select" required>
                            <option value="">Pilih Kategori...</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= esc($k['nama'] ?? $k['name'] ?? '-') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Layanan</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SLA (Jam)</label>
                        <input type="number" name="sla" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Online</label>
                        <select name="online" class="form-select" required>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="formEdit">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Unit Layanan</label>
                        <select name="unit_layanan_id" id="edit_unit" class="form-select" required>
                            <option value="">Pilih Unit...</option>
                            <?php foreach ($units as $u) : ?>
                                <option value="<?= $u['id'] ?>"><?= esc($u['nama'] ?? $u['name'] ?? '-') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Layanan</label>
                        <select name="kategori_layanan_id" id="edit_kategori" class="form-select" required>
                            <option value="">Pilih Kategori...</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= esc($k['nama'] ?? $k['name'] ?? '-') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Layanan</label>
                        <input type="text" name="kode" id="edit_kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SLA (Jam)</label>
                        <input type="number" name="sla" id="edit_sla" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Online</label>
                        <select name="online" id="edit_online" class="form-select" required>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_status" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.btn-view');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            ['unit', 'kategori', 'kode', 'nama', 'sla', 'online', 'status'].forEach(field => {
                document.getElementById('view_' + field).textContent = this.dataset[field] || '-';
            });
        });
    });

    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const form = document.getElementById('formEdit');
            form.action = '<?= base_url('layanan/update') ?>/' + id;
            
            document.getElementById('edit_unit').value = this.getAttribute('data-unit');
            document.getElementById('edit_kategori').value = this.getAttribute('data-kategori');
            document.getElementById('edit_kode').value = this.getAttribute('data-kode');
            document.getElementById('edit_nama').value = this.getAttribute('data-nama');
            document.getElementById('edit_sla').value = this.getAttribute('data-sla');
            document.getElementById('edit_online').value = this.getAttribute('data-online');
            document.getElementById('edit_status').value = this.getAttribute('data-status');
        });
    });
});
</script>

<?= $this->endSection() ?>
