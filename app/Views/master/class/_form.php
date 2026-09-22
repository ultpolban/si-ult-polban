<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>Program Studi <span class="text-danger">*</span></label>

                <select
                    name="study_program_id"
                    class="form-control <?= validation_show_error('study_program_id') ? 'is-invalid' : '' ?>">

                    <option value="">-- Pilih Program Studi --</option>

                    <?php foreach ($studyPrograms as $studyProgram) : ?>

                        <option
                            value="<?= $studyProgram['id'] ?>"
                            <?= old('study_program_id', $class['study_program_id'] ?? '') == $studyProgram['id'] ? 'selected' : '' ?>>

                            <?= esc($studyProgram['name']) ?>

                        </option>

                    <?php endforeach ?>

                </select>

                <div class="invalid-feedback">

                    <?= validation_show_error('study_program_id') ?>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <label>Kode</label>

                <input
                    type="text"
                    name="code"
                    class="form-control"
                    value="<?= old('code', $class['code'] ?? '') ?>">

            </div>

            <div class="col-md-3 mb-3">

                <label>Nama</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="<?= old('name', $class['name'] ?? '') ?>">

            </div>

        </div>

        <div class="row">

            <div class="col-md-3 mb-3">

                <label>Tingkat</label>

                <input
                    type="number"
                    name="level"
                    class="form-control"
                    value="<?= old('level', $class['level'] ?? '') ?>">

            </div>

            <div class="col-md-3 mb-3">

                <label>Kelas</label>

                <input
                    type="text"
                    name="parallel_class"
                    class="form-control"
                    value="<?= old('parallel_class', $class['parallel_class'] ?? '') ?>">

            </div>

            <div class="col-md-3 mb-3">

                <label>Angkatan</label>

                <input
                    type="number"
                    name="entry_year"
                    class="form-control"
                    value="<?= old('entry_year', $class['entry_year'] ?? date('Y')) ?>">

            </div>

            <div class="col-md-3 mb-3">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $class['sort_order'] ?? 0) ?>">

            </div>

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="description"
                rows="4"
                class="form-control"><?= old('description', $class['description'] ?? '') ?></textarea>

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select name="is_active" class="form-control">

                <option value="1" <?= old('is_active', $class['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                    Aktif

                </option>

                <option value="0" <?= old('is_active', $class['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

                    Nonaktif

                </option>

            </select>

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a href="<?= site_url('master/classes') ?>" class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>