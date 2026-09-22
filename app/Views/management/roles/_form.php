<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label>Kode Role</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    value="<?= old('code', $role['code'] ?? '') ?>">

            </div>

            <div class="col-md-8 mb-3">

                <label>Nama Role</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= old('name', $role['name'] ?? '') ?>">

            </div>

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="description"
                rows="4"
                class="form-control"><?= old('description', $role['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-6">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $role['sort_order'] ?? 0) ?>">

            </div>

            <div class="col-md-6">

                <label>Status</label>

                <select
                    name="is_active"
                    class="form-control">

                    <option value="1"
                        <?= old('is_active', $role['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option value="0"
                        <?= old('is_active', $role['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

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
            href="<?= site_url('roles') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>