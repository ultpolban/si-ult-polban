<?= $validation->listErrors() ?>

<div class="card shadow-sm">

    <div class="card-header">

        <h5 class="mb-0">

            <?= empty($role) ? 'Tambah Role' : 'Edit Role' ?>

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= empty($role)
                        ? base_url('roles/store')
                        : base_url('roles/update/' . $role['id']) ?>"
            method="post">

            <?= csrf_field() ?>

            <!-- Nama Role -->

            <div class="mb-3">

                <label class="form-label fw-semibold">

                    Nama Role <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="role_name"
                    class="form-control <?= session('errors.role_name') ? 'is-invalid' : '' ?>"
                    value="<?= old('role_name', $role['role_name'] ?? '') ?>"
                    placeholder="Masukkan nama role">

                <?php if (session('errors.role_name')) : ?>

                    <div class="invalid-feedback">

                        <?= session('errors.role_name') ?>

                    </div>

                <?php endif; ?>

            </div>

            <!-- Deskripsi -->

            <div class="mb-4">

                <label class="form-label fw-semibold">

                    Deskripsi

                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control <?= session('errors.description') ? 'is-invalid' : '' ?>"
                    placeholder="Masukkan deskripsi role"><?= old('description', $role['description'] ?? '') ?></textarea>

                <?php if (session('errors.description')) : ?>

                    <div class="invalid-feedback">

                        <?= session('errors.description') ?>

                    </div>

                <?php endif; ?>

            </div>

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= base_url('roles') ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-save me-1"></i>

                    <?= empty($role) ? 'Simpan' : 'Update' ?>

                </button>

            </div>

        </form>

    </div>

</div>