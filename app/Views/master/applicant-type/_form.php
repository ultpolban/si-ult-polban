<?= csrf_field() ?>

<div class="card card-premium">

    <div class="card-body">

        <div class="mb-3">

            <label>Kode</label>

            <input
                type="text"
                name="code"
                class="form-control"
                value="<?= old('code', $applicantType['code'] ?? '') ?>">

        </div>

        <div class="mb-3">

            <label>Nama Jenis Pemohon</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="<?= old('name', $applicantType['name'] ?? '') ?>">

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="description"
                rows="4"
                class="form-control"><?= old('description', $applicantType['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-6">

                <label>Jenis</label>

                <select
                    name="is_internal"
                    class="form-control">

                    <option value="1"
                        <?= old('is_internal', $applicantType['is_internal'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Internal

                    </option>

                    <option value="0"
                        <?= old('is_internal', $applicantType['is_internal'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Eksternal

                    </option>

                </select>

            </div>

            <div class="col-md-3">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $applicantType['sort_order'] ?? 0) ?>">

            </div>

            <div class="col-md-3">

                <label>Status</label>

                <select
                    name="is_active"
                    class="form-control">

                    <option value="1"
                        <?= old('is_active', $applicantType['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option value="0"
                        <?= old('is_active', $applicantType['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>

    </div>

    <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4 text-end">

        <button class="btn btn-primary px-4 shadow-sm">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a
            href="<?= site_url('master/applicant-types') ?>"
            class="btn btn-light px-4">

            Kembali

        </a>

    </div>

</div>
