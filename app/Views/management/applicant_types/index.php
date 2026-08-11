<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0"><?= esc($title) ?></h4>
        <small class="text-muted">
            Kelola jenis-jenis pemohon yang tersedia
        </small>
    </div>
    <a href="<?= site_url('management/applicant-types/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i>
        Tambah Jenis Pemohon
    </a>
</div>

<?= $this->include('components/alert') ?>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types as $i => $type): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($type['code']) ?></td>
                    <td><?= esc($type['name']) ?></td>
                    <td><?= esc($type['description'] ?? '-') ?></td>
                    <td>
                        <a href="<?= site_url('management/applicant-types/edit/' . $type['id']) ?>" 
                           class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= site_url('management/applicant-types/delete/' . $type['id']) ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Hapus jenis pemohon ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>