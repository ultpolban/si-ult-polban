<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>Layanan</label>

                <select
                    name="service_id"
                    class="form-control">

                    <option value="">-- Pilih Layanan --</option>

                    <?php foreach ($services as $service): ?>

                        <option
                            value="<?= $service['id'] ?>"
                            <?= old('service_id', $requirement['service_id'] ?? '') == $service['id'] ? 'selected' : '' ?>>

                            <?= esc($service['name']) ?>

                        </option>

                    <?php endforeach ?>

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label>Nama Persyaratan</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= old('name', $requirement['name'] ?? '') ?>">

            </div>

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="description"
                rows="3"
                class="form-control"><?= old('description', $requirement['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-3">

                <label>Tipe File</label>

                <input
                    type="text"
                    name="file_type"
                    class="form-control"
                    value="<?= old('file_type', $requirement['file_type'] ?? '') ?>">

            </div>

            <div class="col-md-3">

                <label>Maks File (MB)</label>

                <input
                    type="number"
                    name="max_file_size"
                    class="form-control"
                    value="<?= old('max_file_size', $requirement['max_file_size'] ?? 5) ?>">

            </div>

            <div class="col-md-3">

                <label>Ekstensi</label>

                <input
                    type="text"
                    name="allowed_extensions"
                    class="form-control"
                    placeholder="pdf,jpg,png"
                    value="<?= old('allowed_extensions', $requirement['allowed_extensions'] ?? '') ?>">

            </div>

            <div class="col-md-3">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $requirement['sort_order'] ?? 0) ?>">

            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-6">

                <label>Wajib Upload</label>

                <select
                    name="is_required"
                    class="form-control">

                    <option value="1">Ya</option>

                    <option value="0">Tidak</option>

                </select>

            </div>

            <div class="col-md-6">

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

            Simpan

        </button>

        <a
            href="<?= site_url('master/service-requirements') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>