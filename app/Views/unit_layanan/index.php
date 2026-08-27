<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0">Master Unit Layanan</h4>
        <small class="text-muted">Kelola data master unit layanan.</small>
    </div>
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
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div class="w-100 me-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari unit layanan...">
                <button class="btn btn-primary" type="button" style="width: 100px;">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
            </div>
        </div>
        <button class="btn btn-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg me-1"></i> Tambah Unit Layanan
        </button>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($units)) : ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada unit layanan.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($units as $key => $row) : ?>
                            <tr>
                                <td class="ps-4"><?= $key + 1 ?></td>
                                <td><?= esc($row['kode']) ?></td>
                                <td><?= esc($row['nama']) ?></td>
                                <td><?= esc($row['email']) ?></td>
                                <td><?= esc($row['telepon']) ?></td>
                                <td>
                                    <?php 
                                        $bg = 'bg-danger';
                                        if ($row['status'] == 'Aktif') $bg = 'bg-success';
                                    ?>
                                    <span class="badge <?= $bg ?>"><?= $row['status'] ?></span>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-info text-white btn-view"
                                            data-kode="<?= esc($row['kode']) ?>"
                                            data-nama="<?= esc($row['nama']) ?>"
                                            data-email="<?= esc($row['email']) ?>"
                                            data-telepon="<?= esc($row['telepon']) ?>"
                                            data-status="<?= esc($row['status']) ?>"
                                            title="View" data-bs-toggle="modal" data-bs-target="#modalView">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning text-dark btn-edit" 
                                            data-id="<?= $row['id'] ?>"
                                            data-kode="<?= esc($row['kode']) ?>"
                                            data-nama="<?= esc($row['nama']) ?>"
                                            data-email="<?= esc($row['email']) ?>"
                                            data-telepon="<?= esc($row['telepon']) ?>"
                                            data-status="<?= $row['status'] ?>"
                                            title="Edit" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="<?= base_url('unit-layanan/delete/' . $row['id']) ?>" class="btn btn-danger" title="Delete" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
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
                <h5 class="modal-title" id="modalViewLabel">Detail Unit Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Kode</dt><dd class="col-sm-8" id="view_kode">-</dd>
                    <dt class="col-sm-4">Nama</dt><dd class="col-sm-8" id="view_nama">-</dd>
                    <dt class="col-sm-4">Email</dt><dd class="col-sm-8" id="view_email">-</dd>
                    <dt class="col-sm-4">Telepon</dt><dd class="col-sm-8" id="view_telepon">-</dd>
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
            <form action="<?= base_url('unit-layanan/store') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Unit Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Unit</label>
                        <input type="text" name="kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Unit</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control">
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
                    <h5 class="modal-title">Edit Unit Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Unit</label>
                        <input type="text" name="kode" id="edit_kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Unit</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" id="edit_telepon" class="form-control">
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
            document.getElementById('view_kode').textContent = this.dataset.kode || '-';
            document.getElementById('view_nama').textContent = this.dataset.nama || '-';
            document.getElementById('view_email').textContent = this.dataset.email || '-';
            document.getElementById('view_telepon').textContent = this.dataset.telepon || '-';
            document.getElementById('view_status').textContent = this.dataset.status || '-';
        });
    });

    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const form = document.getElementById('formEdit');
            form.action = '<?= base_url('unit-layanan/update') ?>/' + id;
            
            document.getElementById('edit_kode').value = this.getAttribute('data-kode');
            document.getElementById('edit_nama').value = this.getAttribute('data-nama');
            document.getElementById('edit_email').value = this.getAttribute('data-email');
            document.getElementById('edit_telepon').value = this.getAttribute('data-telepon');
            document.getElementById('edit_status').value = this.getAttribute('data-status');
        });
    });
});
</script>

<?= $this->endSection() ?>
