<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Program Studi <span class="text-danger">*</span>

                </label>

                <select
                    name="study_program_id"
                    class="form-select"
                    required>

                    <option value="">

                        -- Pilih Program Studi --

                    </option>

                    <?php foreach ($studyPrograms as $studyProgram): ?>

                        <option
                            value="<?= $studyProgram['id'] ?>"
                            <?= old('study_program_id', $class['study_program_id'] ?? '') == $studyProgram['id'] ? 'selected' : '' ?>>

                            <?= esc($studyProgram['education_level']) ?>

                            -

                            <?= esc($studyProgram['program_name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Nama Kelas

                </label>

                <input
                    type="text"
                    name="class_name"
                    class="form-control"
                    value="<?= old('class_name', $class['class_name'] ?? '') ?>"
                    placeholder="Contoh : 1A"
                    required>

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Status

                </label>

                <select
                    name="status"
                    class="form-select">

                    <option
                        value="1"
                        <?= old('status', $class['status'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option
                        value="0"
                        <?= old('status', $class['status'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>

    </div>

</div>