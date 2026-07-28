<div
    id="orangtua-section"
    class="user-type-section"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-danger text-white">

            <h5 class="mb-0">

                <i class="bi bi-people-fill me-2"></i>

                Data Orang Tua / Wali

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- ==========================================
                HUBUNGAN
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Hubungan

                    </label>

                    <select
                        name="relationship"
                        class="form-select">

                        <option value="">

                            -- Pilih Hubungan --

                        </option>

                        <?php

                        $relationships = [

                            'Ayah',
                            'Ibu',
                            'Wali'

                        ];

                        foreach ($relationships as $relationship):

                        ?>

                            <option
                                value="<?= $relationship ?>"
                                <?= old('relationship', $user['relationship'] ?? '') == $relationship ? 'selected' : '' ?>>

                                <?= $relationship ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- ==========================================
                NAMA MAHASISWA
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Mahasiswa

                    </label>

                    <input
                        type="text"
                        name="student_name"
                        class="form-control"
                        value="<?= old('student_name', $user['student_name'] ?? '') ?>">

                </div>

                <!-- ==========================================
                NIM MAHASISWA
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        NIM Mahasiswa

                    </label>

                    <input
                        type="text"
                        name="student_nim"
                        class="form-control"
                        value="<?= old('student_nim', $user['student_nim'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>