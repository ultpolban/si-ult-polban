<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0 text-primary">Master Kategori Layanan</h4>
        <small class="text-muted">Kelola data master kategori layanan.</small>
    </div>
    <div>
        <button class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
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
                <input type="text" class="form-control" placeholder="Cari kategori layanan...">
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
                        <th>Kode</th>
                        <th>Nama Kategori</th>
                        <th>Icon</th>
                        <th>Color</th>
                        <th>Status</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kategori)) : ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Belum ada kategori layanan.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($kategori as $key => $row) : ?>
                            <tr>
                                <td class="ps-4"><?= $key + 1 ?></td>
                                <td><?= esc($row['unit_nama'] ?? '-') ?></td>
                                <td><?= esc($row['kode']) ?></td>
                                <td><?= esc($row['nama']) ?></td>
                                <td><?= esc($row['icon'] ?? '-') ?></td>
                                <td><?= esc($row['color'] ?? '-') ?></td>
                                <td>
                                    <?php 
                                        $bg = 'bg-danger';
                                        if ($row['status'] == 'Aktif') $bg = 'bg-success';
                                    ?>
                                    <span class="badge <?= $bg ?>"><?= $row['status'] ?></span>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-info text-white" title="View"><i class="bi bi-eye"></i></button>
                                        <button type="button" class="btn btn-warning text-dark btn-edit"
                                            data-id="<?= $row['id'] ?>"
                                            data-unit="<?= $row['unit_layanan_id'] ?>"
                                            data-kode="<?= esc($row['kode']) ?>"
                                            data-nama="<?= esc($row['nama']) ?>"
                                            data-icon="<?= esc($row['icon']) ?>"
                                            data-color="<?= esc($row['color']) ?>"
                                            data-status="<?= $row['status'] ?>"
                                            title="Edit" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="<?= base_url('kategori-layanan/delete/' . $row['id']) ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
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
            <form action="<?= base_url('kategori-layanan/store') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Unit Layanan</label>
                        <select name="unit_layanan_id" class="form-select" required>
                            <option value="">Pilih Unit...</option>
                            <?php foreach ($units as $u) : ?>
                                <option value="<?= $u['id'] ?>"><?= esc($u['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Kategori</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (Bootstrap Icon class)</label>
                        <input type="text" name="icon" class="form-control" placeholder="bi-file-earmark">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color (Hex/Class)</label>
                        <input type="text" name="color" class="form-control" placeholder="#ffffff or bg-primary">
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
                    <h5 class="modal-title">Edit Kategori Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Unit Layanan</label>
                        <select name="unit_layanan_id" id="edit_unit" class="form-select" required>
                            <option value="">Pilih Unit...</option>
                            <?php foreach ($units as $u) : ?>
                                <option value="<?= $u['id'] ?>"><?= esc($u['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Kategori</label>
                        <input type="text" name="kode" id="edit_kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <input type="text" name="icon" id="edit_icon" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" id="edit_color" class="form-control">
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
            form.action = '<?= base_url('kategori-layanan/update') ?>/' + id;
            
            document.getElementById('edit_unit').value = this.getAttribute('data-unit');
            document.getElementById('edit_kode').value = this.getAttribute('data-kode');
            document.getElementById('edit_nama').value = this.getAttribute('data-nama');
            document.getElementById('edit_icon').value = this.getAttribute('data-icon');
            document.getElementById('edit_color').value = this.getAttribute('data-color');
            document.getElementById('edit_status').value = this.getAttribute('data-status');
        });
    });
});
</script>

<?= $this->endSection() ?>