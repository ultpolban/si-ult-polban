<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Permission</h3>
        <p class="text-muted mb-0">Daftar hak akses yang digunakan sistem.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($permissions)): ?>
                        <?php foreach ($permissions as $i => $permission): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><code><?= esc($permission['code'] ?? '-') ?></code></td>
                                <td><?= esc($permission['name'] ?? '-') ?></td>
                                <td><?= esc($permission['description'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data permission.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
