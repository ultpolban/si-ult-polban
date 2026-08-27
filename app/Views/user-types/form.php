<?= $validation->listErrors() ?>

<div class="card shadow-sm">

    <div class="card-header">

        <h5 class="mb-0">

            <?= empty($type) ? 'Tambah Jenis Pemohon' : 'Edit Jenis Pemohon' ?>

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= empty($type)
                        ? base_url('user-types/store')
                        : base_url('user-types/update/' . $type['id']) ?>"
            method="post">

            <?= csrf_field() ?>

            <!-- Nama Jenis Pemohon -->

            <div class="mb-3">

                <label class="form-label fw-semibold">

                    Nama Jenis Pemohon
                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>"
                    value="<?= old('name', $type['name'] ?? '') ?>"
                    placeholder="Contoh: Mahasiswa">

                <?php if (session('errors.name')) : ?>

                    <div class="invalid-feedback">

                        <?= session('errors.name') ?>

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
                    placeholder="Masukkan deskripsi"><?= old('description', $type['description'] ?? '') ?></textarea>

                <?php if (session('errors.description')) : ?>

                    <div class="invalid-feedback">

                        <?= session('errors.description') ?>

                    </div>

                <?php endif; ?>

            </div>

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= base_url('user-types') ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-save me-1"></i>

                    <?= empty($type) ? 'Simpan' : 'Update' ?>

                </button>

            </div>

        </form>

    </div>

</div>
