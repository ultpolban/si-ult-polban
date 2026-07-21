<form action="<?= base_url('api/v1/register') ?>" method="post">

    <input type="hidden" name="user_type_id" value="1">

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim">
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Jurusan</label>

            <select class="form-select" name="department_id">

                <option value="">Pilih Jurusan</option>

                <?php foreach ($departments as $department): ?>

                    <option value="<?= $department['id'] ?>">

                        <?= $department['department_name'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">Program Studi</label>

            <select class="form-select" name="study_program_id">

                <option value="">Pilih Program Studi</option>

                <?php foreach ($studyPrograms as $study): ?>

                    <option value="<?= $study['id'] ?>">

                        <?= $study['program_name'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

    </div>

    <hr>

    <?= $this->include('register/partials/common') ?>

    <button class="btn btn-success">
        Daftar Sebagai Mahasiswa
    </button>

</form>