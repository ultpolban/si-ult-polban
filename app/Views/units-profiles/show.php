<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card">
<div class="card-header"><h3 class="card-title">Deskripsi Unit - <?= esc($profile['unit_name'] ?? '') ?></h3></div>
<div class="card-body"><table class="table table-bordered">
<tr><th width="220">Unit Layanan</th><td><?= esc(($profile['unit_code'] ?? '') . ' - ' . ($profile['unit_name'] ?? '')) ?></td></tr>
<tr><th>Deskripsi Lengkap</th><td><?= !empty($profile['description']) ? nl2br(esc($profile['description'])) : '-' ?></td></tr>
<tr><th>Status</th><td><?= $profile['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Nonaktif</span>' ?></td></tr>
<tr><th>Dibuat</th><td><?= esc($profile['created_at'] ?? '-') ?></td></tr>
<tr><th>Diubah</th><td><?= esc($profile['updated_at'] ?? '-') ?></td></tr>
</table></div>
<div class="card-footer">
<a href="<?= site_url('units-profiles') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
<a href="<?= site_url('units-profiles/edit/' . $profile['id']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
</div></div>
<?= $this->endSection() ?>