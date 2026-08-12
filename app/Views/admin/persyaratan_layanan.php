<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0 text-primary">Master Persyaratan Layanan</h4>
        <small class="text-muted">Kelola persyaratan setiap layanan.</small>
    </div>
    <div>
        <button class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Persyaratan
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
                <input type="text" class="form-control" placeholder="Cari persyaratan...">
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
                        <th>Layanan</th>
                        <th>Persyaratan</th>
                        <th>Tipe File</th>
                        <th>Ukuran</th>
                        <th>Wajib</th>
                        <th>Status</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($persyaratan)) : ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Belum ada data persyaratan.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($persyaratan as $key => $row) : ?>
                            <tr>
                                <td class="ps-4"><?= $key + 1 ?></td>
                                <td><?= esc($row['layanan_nama'] ?? '-') ?></td>
                                <td><?= esc($row['persyaratan'] ?? $row['name'] ?? '-') ?></td>
                                <td><?= esc($row['tipe_file'] ?? $row['file_type'] ?? '-') ?></td>
                                <td><?= esc($row['ukuran'] ?? $row['max_file_size'] ?? 0) ?></td>
                                <td>
                                    <?php 
                                        $on = 'bg-secondary';
                                        if (($row['wajib'] ?? (($row['is_required'] ?? 0) ? 'Wajib' : 'Opsional')) == 'Wajib') $on = 'bg-primary';
                                    ?>
                                    <span class="badge <?= $on ?> rounded-pill px-3"><?= esc($row['wajib'] ?? (($row['is_required'] ?? 0) ? 'Wajib' : 'Opsional')) ?></span>
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
                                        <button type="button" class="btn btn-info text-white" title="View"><i class="bi bi-eye"></i></button>
                                        <button type="button" class="btn btn-warning text-dark btn-edit"
                                            data-id="<?= $row['id'] ?>"
                                            data-layanan="<?= $row['layanan_id'] ?>"
                                            data-persyaratan="<?= esc($row['persyaratan'] ?? $row['name'] ?? '-') ?>"
                                            data-tipe="<?= esc($row['tipe_file'] ?? $row['file_type'] ?? '-') ?>"
                                            data-ukuran="<?= esc($row['ukuran'] ?? $row['max_file_size'] ?? 0) ?>"
                                            data-wajib="<?= esc($row['wajib'] ?? (($row['is_required'] ?? 0) ? 'Wajib' : 'Opsional')) ?>"
                                            data-status="<?= esc($row['status'] ?? (($row['is_active'] ?? 0) ? 'Aktif' : 'Nonaktif')) ?>"
                                            title="Edit" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="<?= base_url('persyaratan-layanan/delete/' . $row['id']) ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('persyaratan-layanan/store') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Persyaratan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Layanan</label>
                        <select name="layanan_id" class="form-select" required>
                            <option value="">Pilih Layanan...</option>
                            <?php foreach ($layanans as $l) : ?>
                                <option value="<?= $l['id'] ?>"><?= esc($l['nama'] ?? $l['name'] ?? '-') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Persyaratan</label>
                        <input type="text" name="persyaratan" class="form-control" placeholder="Contoh: Bukti Pembayaran" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe File</label>
                        <input type="text" name="tipe_file" class="form-control" placeholder="Contoh: pdf, png, jpg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ukuran Maksimal (MB)</label>
                        <input type="text" name="ukuran" class="form-control" placeholder="Contoh: 4096 MB" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Wajib</label>
                        <select name="wajib" class="form-select" required>
                            <option value="Wajib">Wajib</option>
                            <option value="Opsional">Opsional</option>
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
                    <h5 class="modal-title">Edit Persyaratan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Layanan</label>
                        <select name="layanan_id" id="edit_layanan" class="form-select" required>
                            <option value="">Pilih Layanan...</option>
                            <?php foreach ($layanans as $l) : ?>
                                <option value="<?= $l['id'] ?>"><?= esc($l['nama'] ?? $l['name'] ?? '-') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Persyaratan</label>
                        <input type="text" name="persyaratan" id="edit_persyaratan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe File</label>
                        <input type="text" name="tipe_file" id="edit_tipe" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ukuran Maksimal</label>
                        <input type="text" name="ukuran" id="edit_ukuran" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Wajib</label>
                        <select name="wajib" id="edit_wajib" class="form-select" required>
                            <option value="Wajib">Wajib</option>
                            <option value="Opsional">Opsional</option>
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
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const form = document.getElementById('formEdit');
            form.action = '<?= base_url('persyaratan-layanan/update') ?>/' + id;
            
            document.getElementById('edit_layanan').value = this.getAttribute('data-layanan');
            document.getElementById('edit_persyaratan').value = this.getAttribute('data-persyaratan');
            document.getElementById('edit_tipe').value = this.getAttribute('data-tipe');
            document.getElementById('edit_ukuran').value = this.getAttribute('data-ukuran');
            document.getElementById('edit_wajib').value = this.getAttribute('data-wajib');
            document.getElementById('edit_status').value = this.getAttribute('data-status');
        });
    });
});
</script>

<?= $this->endSection() ?>