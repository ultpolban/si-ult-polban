<?= csrf_field() ?>
<div class="card"><div class="card-body">
<div class="mb-3"><label>Unit Layanan *</label>
<select name="service_unit_id" class="form-control">
<option value="">-- Pilih Unit --</option>
<?php foreach ($serviceUnits as $u): ?>
<option value="<?= $u['id'] ?>" <?= old('service_unit_id', $profile['service_unit_id'] ?? '') == $u['id'] ? 'selected' : '' ?>><?= esc($u['code'] . ' - ' . $u['name']) ?></option>
<?php endforeach ?></select>
<small class="text-muted">Satu unit hanya boleh punya satu deskripsi.</small></div>
<div class="mb-3"><label>Deskripsi Lengkap Unit *</label>
<textarea name="description" rows="8" class="form-control" placeholder="Tuliskan penjelasan lengkap tentang unit ini..."><?= old('description', $profile['description'] ?? '') ?></textarea></div>
<div class="col-md-3 mb-3"><label>Status *</label><select name="is_active" class="form-control">
<option value="1" <?= old('is_active', $profile['is_active'] ?? '1') == '1' ? 'selected' : '' ?>>Aktif</option>
<option value="0" <?= old('is_active', $profile['is_active'] ?? '1') == '0' ? 'selected' : '' ?>>Nonaktif</option></select></div>
</div><div class="card-footer">
<button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
<a href="<?= site_url('units-profiles') ?>" class="btn btn-secondary">Kembali</a>
</div></div>
