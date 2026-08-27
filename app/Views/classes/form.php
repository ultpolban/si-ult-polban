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

                            <?= esc($studyProgram['education_level'] ?? $studyProgram['degree'] ?? '') ?>

                            -

                            <?= esc($studyProgram['program_name'] ?? $studyProgram['name'] ?? '') ?>

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
                    name="name"
                    class="form-control"
                    value="<?= old('name', $class['name'] ?? '') ?>"
                    placeholder="Contoh : 1A"
                    required>

            </div>

            <div class="col-md-6">

                <label class="form-label">

                    Status

                </label>

                <select
                    name="is_active"
                    class="form-select">

                    <option
                        value="1"
                        <?= old('is_active', $class['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option
                        value="0"
                        <?= old('is_active', $class['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>

    </div>

</div>
