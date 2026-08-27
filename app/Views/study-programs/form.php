<?= $validation->listErrors() ?>

<div class="card shadow-sm">

    <div class="card-header">

        <h5 class="mb-0">

            <?= empty($studyProgram) ? 'Tambah Program Studi' : 'Edit Program Studi' ?>

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= empty($studyProgram)
                        ? base_url('study-programs/store')
                        : base_url('study-programs/update/' . $studyProgram['id']) ?>"
            method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Jurusan

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="department_id"
                        class="form-select <?= session('errors.department_id') ? 'is-invalid' : '' ?>">

                        <option value="">-- Pilih Jurusan --</option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id'] ?>"
                                <?= old(
                                    'department_id',
                                    $studyProgram['department_id'] ?? ''
                                ) == $department['id'] ? 'selected' : '' ?>>

                                <?= esc($department['department_name'] ?? $department['name'] ?? '-') ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label fw-semibold">

                        Jenjang

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="degree"
                        class="form-select">

                        <option value="">-- Pilih --</option>

                        <?php

                        $levels = ['D3', 'D4', 'S2'];

                        foreach ($levels as $level):

                        ?>

                            <option
                                value="<?= $level ?>"
                                <?= old(
                                    'degree',
                                    $studyProgram['degree'] ?? ''
                                ) == $level ? 'selected' : '' ?>>

                                <?= $level ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-5 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Program Studi

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?= old(
                                    'name',
                                    $studyProgram['name'] ?? ''
                                ) ?>">

                </div>

            </div>

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= base_url('study-programs') ?>"
                    class="btn btn-secondary">

                    Kembali

                </a>

                <button
                    class="btn btn-primary">

                    <?= empty($studyProgram) ? 'Simpan' : 'Update' ?>

                </button>

            </div>

        </form>

    </div>

</div>
