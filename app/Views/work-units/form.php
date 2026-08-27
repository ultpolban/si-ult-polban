<?= $validation->listErrors() ?>

<div class="card shadow-sm">

    <div class="card-header">

        <h5 class="mb-0">

            <?= empty($workUnit) ? 'Tambah Unit Kerja' : 'Edit Unit Kerja' ?>

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= empty($workUnit)
                        ? base_url('work-units/store')
                        : base_url('work-units/update/' . $workUnit['id']) ?>"
            method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label class="form-label fw-semibold">

                        Kode Unit

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="code"
                        class="form-control <?= session('errors.code') ? 'is-invalid' : '' ?>"
                        value="<?= old('code', $workUnit['code'] ?? '') ?>">

                    <?php if (session('errors.code')) : ?>

                        <div class="invalid-feedback">

                            <?= session('errors.code') ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="col-md-9 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Unit Kerja

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>"
                        value="<?= old('name', $workUnit['name'] ?? '') ?>">

                    <?php if (session('errors.name')) : ?>

                        <div class="invalid-feedback">

                            <?= session('errors.name') ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= base_url('work-units') ?>"
                    class="btn btn-secondary">

                    Kembali

                </a>

                <button
                    class="btn btn-primary">

                    <?= empty($workUnit) ? 'Simpan' : 'Update' ?>

                </button>

            </div>

        </form>

    </div>

</div>
