<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-pencil-square text-warning"></i>

                Edit User

            </h2>

            <p class="text-muted mb-0">

                Perbarui informasi pengguna SI-ULT POLBAN

            </p>

        </div>

        <a
            href="<?= base_url('users') ?>"
            class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>


    <?php if (session()->getFlashdata('errors')) : ?>

        <div class="alert alert-danger shadow-sm">

            <h6 class="mb-2">

                <i class="bi bi-exclamation-triangle-fill"></i>

                Terjadi Kesalahan

            </h6>

            <ul class="mb-0">

                <?php foreach (session()->getFlashdata('errors') as $error): ?>

                    <li><?= esc($error) ?></li>

                <?php endforeach ?>

            </ul>

        </div>

    <?php endif; ?>


    <form
        action="<?= base_url('users/update/' . $user['id']) ?>"
        method="post">

        <?= csrf_field() ?>


        <!-- =========================
DATA AKUN
========================= -->

        <div class="card border-0 shadow mb-4">

            <div class="card-header bg-warning">

                <h5 class="mb-0">

                    <i class="bi bi-shield-lock-fill"></i>

                    Data Akun

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Role

                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="role_id"
                            class="form-select"
                            required>

                            <?php foreach ($roles as $role): ?>

                                <option
                                    value="<?= $role['id'] ?>"
                                    <?= $role['id'] == $user['role_id'] ? 'selected' : '' ?>>

                                    <?= esc($role['role_name']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Unit Kerja

                        </label>

                        <select
                            name="work_unit_id"
                            class="form-select">

                            <option value="">

                                Pilih Unit Kerja

                            </option>

                            <?php foreach ($workUnits as $unit): ?>

                                <option
                                    value="<?= $unit['id'] ?>"
                                    <?= $unit['id'] == $user['work_unit_id'] ? 'selected' : '' ?>>

                                    <?= esc($unit['unit_name']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

            </div>

        </div>



        <!-- =========================
DATA PRIBADI
========================= -->

        <div class="card border-0 shadow mb-4">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    <i class="bi bi-person-vcard-fill"></i>

                    Data Pribadi

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nama Lengkap

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="text"
                            name="full_name"
                            class="form-control"
                            value="<?= esc($user['full_name']) ?>"
                            placeholder="Masukkan nama lengkap"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Jenis Kelamin

                            <span class="text-danger">*</span>

                        </label>

                        <select
                            name="gender"
                            class="form-select"
                            required>

                            <option
                                value="L"
                                <?= $user['gender'] == 'L' ? 'selected' : '' ?>>

                                Laki-laki

                            </option>

                            <option
                                value="P"
                                <?= $user['gender'] == 'P' ? 'selected' : '' ?>>

                                Perempuan

                            </option>

                        </select>

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nomor HP

                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="<?= esc($user['phone']) ?>"
                            placeholder="08xxxxxxxxxx">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Email Pribadi

                        </label>

                        <input
                            type="email"
                            name="personal_email"
                            class="form-control"
                            value="<?= esc($user['personal_email']) ?>"
                            placeholder="email@gmail.com">

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Email Institusi

                        </label>

                        <input
                            type="email"
                            name="institution_email"
                            class="form-control"
                            value="<?= esc($user['institution_email']) ?>"
                            placeholder="nama@polban.ac.id">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            NIP

                        </label>

                        <input
                            type="text"
                            name="nip"
                            class="form-control"
                            value="<?= esc($user['nip']) ?>">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            NIDN

                        </label>

                        <input
                            type="text"
                            name="nidn"
                            class="form-control"
                            value="<?= esc($user['nidn']) ?>">

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tempat Lahir

                        </label>

                        <input
                            type="text"
                            name="birth_place"
                            class="form-control"
                            value="<?= esc($user['birth_place']) ?>"
                            placeholder="Contoh : Bandung">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tanggal Lahir

                        </label>

                        <input
                            type="date"
                            name="birth_date"
                            class="form-control"
                            value="<?= $user['birth_date'] ?>">

                    </div>

                </div>


                <div class="mb-3">

                    <label class="form-label">

                        Alamat

                    </label>

                    <textarea
                        name="address"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan alamat lengkap"><?= esc($user['address']) ?></textarea>

                </div>

            </div>

        </div>


        <!-- =========================
PASSWORD & STATUS
========================= -->

        <div class="card border-0 shadow mb-4">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">

                    <i class="bi bi-key-fill"></i>

                    Password & Status

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Password Baru

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Kosongkan jika tidak diubah">

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword()">

                                <i
                                    id="passwordIcon"
                                    class="bi bi-eye"></i>

                            </button>

                        </div>

                        <small class="text-muted">

                            Kosongkan jika password tidak ingin diubah.

                        </small>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Status User

                        </label>

                        <select
                            name="is_active"
                            class="form-select">

                            <option
                                value="1"
                                <?= $user['is_active'] ? 'selected' : '' ?>>

                                Aktif

                            </option>

                            <option
                                value="0"
                                <?= !$user['is_active'] ? 'selected' : '' ?>>

                                Non Aktif

                            </option>

                        </select>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between flex-wrap gap-2">

                    <a
                        href="<?= base_url('users') ?>"
                        class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-left-circle"></i>

                        Kembali

                    </a>

                    <div>

                        <button
                            type="reset"
                            class="btn btn-outline-warning me-2">

                            <i class="bi bi-arrow-clockwise"></i>

                            Reset

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-check-circle-fill"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

<script>
    function togglePassword() {

        let password = document.getElementById('password');

        let icon = document.getElementById('passwordIcon');

        if (password.type === "password") {

            password.type = "text";

            icon.classList.remove("bi-eye");

            icon.classList.add("bi-eye-slash");

        } else {

            password.type = "password";

            icon.classList.remove("bi-eye-slash");

            icon.classList.add("bi-eye");

        }

    }
</script>

<?= $this->endSection() ?>