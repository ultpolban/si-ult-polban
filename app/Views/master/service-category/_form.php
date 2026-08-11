<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label>Unit Layanan</label>

                <select
                    name="service_unit_id"
                    class="form-control">

                    <option value="">-- Pilih Unit Layanan --</option>

                    <?php foreach ($serviceUnits as $unit): ?>

                        <option
                            value="<?= $unit['id'] ?>"
                            <?= old('service_unit_id', $serviceCategory['service_unit_id'] ?? '') == $unit['id'] ? 'selected' : '' ?>>

                            <?= esc($unit['name']) ?>

                        </option>

                    <?php endforeach ?>

                </select>

            </div>

            <div class="col-md-4 mb-3">

                <label>Kode</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    value="<?= old('code', $serviceCategory['code'] ?? '') ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label>Nama Kategori</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= old('name', $serviceCategory['name'] ?? '') ?>">

            </div>

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="description"
                rows="3"
                class="form-control"><?= old('description', $serviceCategory['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-4">

                <label>Icon</label>

                <input
                    type="text"
                    name="icon"
                    class="form-control"
                    value="<?= old('icon', $serviceCategory['icon'] ?? '') ?>">

            </div>

            <div class="col-md-4">

                <label>Color</label>

                <input
                    type="text"
                    name="color"
                    class="form-control"
                    value="<?= old('color', $serviceCategory['color'] ?? '') ?>">

            </div>

            <div class="col-md-2">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $serviceCategory['sort_order'] ?? 0) ?>">

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

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a
            href="<?= site_url('master/service-categories') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>