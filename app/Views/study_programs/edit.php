<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-warning">

            <h4 class="mb-0">
                Edit Program Studi
            </h4>

        </div>

        <div class="card-body">

            <form action="<?= base_url('study-programs/update/' . $program['id']) ?>" method="post">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        name="department_id"
                        class="form-select"
                        required>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id'] ?>"
                                <?= $program['department_id'] == $department['id'] ? 'selected' : '' ?>>

                                <?= esc($department['department_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Kode Program Studi
                    </label>

                    <input
                        type="text"
                        name="program_code"
                        class="form-control"
                        value="<?= esc($program['program_code']) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Program Studi
                    </label>

                    <input
                        type="text"
                        name="program_name"
                        class="form-control"
                        value="<?= esc($program['program_name']) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jenjang
                    </label>

                    <select
                        name="education_level"
                        class="form-select">

                        <?php

                        $levels = [
                            'D1',
                            'D2',
                            'D3',
                            'D4',
                            'S1',
                            'S2'
                        ];

                        foreach ($levels as $level):

                        ?>

                            <option
                                value="<?= $level ?>"
                                <?= $program['education_level'] == $level ? 'selected' : '' ?>>

                                <?= $level ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="Aktif"
                            <?= $program['status'] == 'Aktif' ? 'selected' : '' ?>>

                            Aktif

                        </option>

                        <option
                            value="Tidak Aktif"
                            <?= $program['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>

                            Tidak Aktif

                        </option>

                    </select>

                </div>

                <button class="btn btn-primary">

                    Update

                </button>

                <a
                    href="<?= base_url('study-programs') ?>"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>