<?= $validation->listErrors() ?>

<div class="card shadow-sm">

    <div class="card-header">

        <h5 class="mb-0">

            <?= empty($department) ? 'Tambah Jurusan' : 'Edit Jurusan' ?>

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= empty($department)
                        ? base_url('departments/store')
                        : base_url('departments/update/' . $department['id']) ?>"
            method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label class="form-label fw-semibold">

                        Kode Jurusan
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="department_code"
                        class="form-control <?= session('errors.department_code') ? 'is-invalid' : '' ?>"
                        value="<?= old('department_code', $department['department_code'] ?? '') ?>"
                        placeholder="Contoh : TI">

                    <?php if (session('errors.department_code')) : ?>

                        <div class="invalid-feedback">

                            <?= session('errors.department_code') ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="col-md-9 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Jurusan
                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="department_name"
                        class="form-control <?= session('errors.department_name') ? 'is-invalid' : '' ?>"
                        value="<?= old('department_name', $department['department_name'] ?? '') ?>"
                        placeholder="Masukkan nama jurusan">

                    <?php if (session('errors.department_name')) : ?>

                        <div class="invalid-feedback">

                            <?= session('errors.department_name') ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= base_url('departments') ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-save me-1"></i>

                    <?= empty($department) ? 'Simpan' : 'Update' ?>

                </button>

            </div>

        </form>

    </div>

</div>