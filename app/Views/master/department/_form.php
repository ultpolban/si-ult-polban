<?= csrf_field(); ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <!-- Kode -->
            <div class="col-md-4 mb-3">

                <label for="code" class="form-label">

                    Kode Jurusan <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="code"
                    id="code"
                    class="form-control <?= session()->getFlashdata('errors') ? 'is-invalid' : '' ?>"
                    value="<?= old('code', $department['code'] ?? '') ?>"
                    maxlength="10"
                    required>

                <div class="invalid-feedback">

                    <?= session()->getFlashdata('errors') ?>

                </div>

            </div>

            <!-- Nama -->
            <div class="col-md-8 mb-3">

                <label for="name" class="form-label">

                    Nama Jurusan <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>"
                    value="<?= old('name', $department['name'] ?? '') ?>"
                    maxlength="150"
                    required>

                <div class="invalid-feedback">

                    <?= validation_show_error('name') ?>

                </div>

            </div>

        </div>

        <div class="row">

            <!-- Singkatan -->
            <div class="col-md-4 mb-3">

                <label for="short_name" class="form-label">

                    Singkatan

                </label>

                <input
                    type="text"
                    name="short_name"
                    id="short_name"
                    class="form-control <?= validation_show_error('short_name') ? 'is-invalid' : '' ?>"
                    value="<?= old('short_name', $department['short_name'] ?? '') ?>"
                    maxlength="30">

                <div class="invalid-feedback">

                    <?= validation_show_error('short_name') ?>

                </div>

            </div>

            <!-- Urutan -->
            <div class="col-md-4 mb-3">

                <label for="sort_order" class="form-label">

                    Urutan <span class="text-danger">*</span>

                </label>

                <input
                    type="number"
                    name="sort_order"
                    id="sort_order"
                    class="form-control <?= validation_show_error('sort_order') ? 'is-invalid' : '' ?>"
                    value="<?= old('sort_order', $department['sort_order'] ?? 0) ?>"
                    min="0"
                    required>

                <div class="invalid-feedback">

                    <?= validation_show_error('sort_order') ?>

                </div>

            </div>

            <!-- Status -->
            <div class="col-md-4 mb-3">

                <label for="is_active" class="form-label">

                    Status <span class="text-danger">*</span>

                </label>

                <select
                    name="is_active"
                    id="is_active"
                    class="form-control <?= validation_show_error('is_active') ? 'is-invalid' : '' ?>">

                    <option value="1"
                        <?= old('is_active', $department['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option value="0"
                        <?= old('is_active', $department['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

                <div class="invalid-feedback">

                    <?= validation_show_error('is_active') ?>

                </div>

            </div>

        </div>

        <!-- Deskripsi -->
        <div class="mb-3">

            <label for="description" class="form-label">

                Deskripsi

            </label>

            <textarea
                name="description"
                id="description"
                rows="4"
                class="form-control <?= validation_show_error('description') ? 'is-invalid' : '' ?>"><?= old('description', $department['description'] ?? '') ?></textarea>

            <div class="invalid-feedback">

                <?= validation_show_error('description') ?>

            </div>

        </div>

    </div>

    <div class="card-footer">

        <button
            type="submit"
            class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a
            href="<?= site_url('master/departments') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

    </div>

</div>