<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>Unit Layanan</label>

                <select
                    name="service_unit_id"
                    class="form-control">

                    <option value="">-- Pilih Unit --</option>

                    <?php foreach ($serviceUnits as $unit): ?>

                        <option
                            value="<?= $unit['id'] ?>"
                            <?= old('service_unit_id', $service['service_unit_id'] ?? '') == $unit['id'] ? 'selected' : '' ?>>

                            <?= esc($unit['name']) ?>

                        </option>

                    <?php endforeach ?>

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label>Kategori Layanan</label>

                <select
                    name="service_category_id"
                    class="form-control">

                    <option value="">-- Pilih Kategori --</option>

                    <?php foreach ($serviceCategories as $category): ?>

                        <option
                            value="<?= $category['id'] ?>"
                            <?= old('service_category_id', $service['service_category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>

                            <?= esc($category['name']) ?>

                        </option>

                    <?php endforeach ?>

                </select>

            </div>

        </div>

        <div class="row">

            <div class="col-md-4 mb-3">

                <label>Kode</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    value="<?= old('code', $service['code'] ?? '') ?>">

            </div>

            <div class="col-md-8 mb-3">

                <label>Nama Layanan</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= old('name', $service['name'] ?? '') ?>">

            </div>

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="description"
                rows="4"
                class="form-control"><?= old('description', $service['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-3">

                <label>Estimasi (Jam)</label>

                <input
                    type="number"
                    name="service_hours"
                    class="form-control"
                    value="<?= old('service_hours', $service['service_hours'] ?? 1) ?>">

            </div>

            <div class="col-md-3">

                <label>Ukuran File (MB)</label>

                <input
                    type="number"
                    name="max_file_size"
                    class="form-control"
                    value="<?= old('max_file_size', $service['max_file_size'] ?? 5) ?>">

            </div>

            <div class="col-md-2">

                <label>Online</label>

                <select
                    name="is_online"
                    class="form-control">

                    <option value="1">Ya</option>

                    <option value="0">Tidak</option>

                </select>

            </div>

            <div class="col-md-2">

                <label>Status</label>

                <select
                    name="is_active"
                    class="form-control">

                    <option value="1">Aktif</option>

                    <option value="0">Nonaktif</option>

                </select>

            </div>

            <div class="col-md-2">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $service['sort_order'] ?? 0) ?>">

            </div>

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a
            href="<?= site_url('master/services') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>