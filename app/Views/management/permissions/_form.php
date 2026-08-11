<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label>Module</label>

                <input
                    type="text"
                    name="module"
                    class="form-control"
                    value="<?= old('module', $permission['module'] ?? '') ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label>Kode Permission</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    value="<?= old('code', $permission['code'] ?? '') ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label>Nama Permission</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= old('name', $permission['name'] ?? '') ?>">

            </div>

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                class="form-control"
                rows="4"
                name="description"><?= old('description', $permission['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-6">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $permission['sort_order'] ?? 0) ?>">

            </div>

            <div class="col-md-6">

                <label>Status</label>

                <select
                    name="is_active"
                    class="form-control">

                    <option value="1"
                        <?= old('is_active', $permission['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option value="0"
                        <?= old('is_active', $permission['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-primary">

            Simpan

        </button>

        <a
            href="<?= site_url('permissions') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>