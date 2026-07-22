<!-- ===================================================== -->
<!-- DATA PRIBADI -->
<!-- ===================================================== -->

<div class="card shadow-sm mb-4">

    <div class="card-header bg-success text-white">
        <h5 class="mb-0">Data Pribadi</h5>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Jenis Kelamin
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="gender"
                    class="form-select"
                    required>

                    <option value="">Pilih</option>

                    <option value="L" <?= old('gender') == 'L' ? 'selected' : '' ?>>
                        Laki-laki
                    </option>

                    <option value="P" <?= old('gender') == 'P' ? 'selected' : '' ?>>
                        Perempuan
                    </option>

                </select>

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Tempat Lahir
                </label>

                <input
                    type="text"
                    name="birth_place"
                    class="form-control"
                    value="<?= old('birth_place') ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">
                    Tanggal Lahir
                </label>

                <input
                    type="date"
                    name="birth_date"
                    class="form-control"
                    value="<?= old('birth_date') ?>">

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nomor HP
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="<?= old('phone') ?>"
                    required>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Foto
                </label>

                <input
                    type="file"
                    name="photo"
                    class="form-control"
                    accept=".jpg,.jpeg,.png">

                <small class="text-muted">
                    Maksimal 2 MB (JPG, JPEG, PNG)
                </small>

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Alamat
            </label>

            <textarea
                name="address"
                rows="3"
                class="form-control"><?= old('address') ?></textarea>

        </div>

    </div>

</div>