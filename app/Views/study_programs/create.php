<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">
                Tambah Program Studi
            </h4>

        </div>

        <div class="card-body">

            <form action="<?= base_url('study-programs/store') ?>" method="post">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        name="department_id"
                        class="form-select"
                        required>

                        <option value="">
                            -- Pilih Jurusan --
                        </option>

                        <?php foreach ($departments as $department): ?>

                            <option value="<?= $department['id'] ?>">

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
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Jenjang

                    </label>

                    <select
                        name="education_level"
                        class="form-select"
                        required>

                        <option value="">
                            Pilih Jenjang
                        </option>

                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required>

                        <option value="Aktif">

                            Aktif

                        </option>

                        <option value="Tidak Aktif">

                            Tidak Aktif

                        </option>

                    </select>

                </div>

                <button
                    class="btn btn-primary">

                    Simpan

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