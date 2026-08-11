<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Jurusan <span class="text-danger">*</span>
                </label>

                <select
                    name="department_id"
                    class="form-control <?= validation_show_error('department_id') ? 'is-invalid' : '' ?>"
                    required>

                    <option value="">-- Pilih Jurusan --</option>

                    <?php foreach ($departments as $department) : ?>

                        <option
                            value="<?= $department['id'] ?>"
                            <?= old('department_id', $studyProgram['department_id'] ?? '') == $department['id'] ? 'selected' : '' ?>>

                            <?= esc($department['name']) ?>

                        </option>

                    <?php endforeach ?>

                </select>

                <div class="invalid-feedback">

                    <?= validation_show_error('department_id') ?>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Kode

                </label>

                <input
                    type="text"
                    name="code"
                    class="form-control <?= validation_show_error('code') ? 'is-invalid' : '' ?>"
                    value="<?= old('code', $studyProgram['code'] ?? '') ?>">

                <div class="invalid-feedback">

                    <?= validation_show_error('code') ?>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Jenjang

                </label>

                <select
                    name="degree"
                    class="form-control <?= validation_show_error('degree') ? 'is-invalid' : '' ?>">

                    <option value="">-- Pilih --</option>

                    <?php

                    $degrees = [
                        'D1',
                        'D2',
                        'D3',
                        'D4',
                        'S1',
                        'S2',
                        'Profesi'
                    ];

                    foreach ($degrees as $degree) :

                    ?>

                        <option
                            value="<?= $degree ?>"
                            <?= old('degree', $studyProgram['degree'] ?? '') == $degree ? 'selected' : '' ?>>

                            <?= $degree ?>

                        </option>

                    <?php endforeach ?>

                </select>

                <div class="invalid-feedback">

                    <?= validation_show_error('degree') ?>

                </div>

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Nama Program Studi

            </label>

            <input
                type="text"
                name="name"
                class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>"
                value="<?= old('name', $studyProgram['name'] ?? '') ?>">

            <div class="invalid-feedback">

                <?= validation_show_error('name') ?>

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Nama Singkat

            </label>

            <input
                type="text"
                name="short_name"
                class="form-control"
                value="<?= old('short_name', $studyProgram['short_name'] ?? '') ?>">

        </div>

        <div class="mb-3">

            <label class="form-label">

                Deskripsi

            </label>

            <textarea
                name="description"
                rows="4"
                class="form-control"><?= old('description', $studyProgram['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-6">

                <label class="form-label">

                    Urutan

                </label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $studyProgram['sort_order'] ?? 0) ?>">

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Status

                </label>

                <select
                    name="is_active"
                    class="form-control">

                    <option
                        value="1"
                        <?= old('is_active', $studyProgram['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option
                        value="0"
                        <?= old('is_active', $studyProgram['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a
            href="<?= site_url('master/study-programs') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>