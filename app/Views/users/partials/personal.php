<div class="card shadow-sm mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            Data Pribadi

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <!-- FOTO -->

            <div class="col-md-3 text-center mb-3">

                <?php

                $photo = old('photo', $user['photo'] ?? '');

                ?>

                <img
                    id="preview-photo"
                    src="<?= !empty($photo) ? base_url('uploads/users/' . $photo) : 'https://placehold.co/180x220?text=Foto' ?>"
                    class="img-thumbnail mb-2"
                    style="width:180px;height:220px;object-fit:cover;">

                <input
                    type="file"
                    name="photo"
                    id="photo"
                    class="form-control"
                    accept=".jpg,.jpeg,.png">

                <small class="text-muted">

                    JPG, JPEG, PNG (Maks. 2 MB)

                </small>

            </div>

            <div class="col-md-9">

                <div class="row">

                    <!-- Jenis Kelamin -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Jenis Kelamin

                        </label>

                        <select
                            name="gender"
                            class="form-select">

                            <option value="">Pilih</option>

                            <option
                                value="L"
                                <?= old('gender', $user['gender'] ?? '') == 'L' ? 'selected' : '' ?>>

                                Laki-laki

                            </option>

                            <option
                                value="P"
                                <?= old('gender', $user['gender'] ?? '') == 'P' ? 'selected' : '' ?>>

                                Perempuan

                            </option>

                        </select>

                    </div>

                    <!-- HP -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="<?= old('phone', $user['phone'] ?? '') ?>">

                    </div>

                    <!-- Tempat -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tempat Lahir

                        </label>

                        <input
                            type="text"
                            name="birth_place"
                            class="form-control"
                            value="<?= old('birth_place', $user['birth_place'] ?? '') ?>">

                    </div>

                    <!-- Tanggal -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tanggal Lahir

                        </label>

                        <input
                            type="date"
                            name="birth_date"
                            class="form-control"
                            value="<?= old('birth_date', $user['birth_date'] ?? '') ?>">

                    </div>

                </div>

            </div>

        </div>

        <hr>

        <div class="row">

            <!-- Alamat -->

            <div class="col-md-12 mb-3">

                <label class="form-label">

                    Alamat Lengkap

                </label>

                <textarea
                    name="address"
                    class="form-control"
                    rows="4"><?= old('address', $user['address'] ?? '') ?></textarea>

            </div>

        </div>

    </div>

</div>