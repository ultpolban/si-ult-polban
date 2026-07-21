<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-person-lines-fill text-primary"></i>

                Detail User

            </h2>

            <p class="text-muted mb-0">

                Informasi lengkap pengguna SI-ULT POLBAN

            </p>

        </div>

        <div>

            <a
                href="<?= base_url('users/edit/' . $user['id']) ?>"
                class="btn btn-warning">

                <i class="bi bi-pencil-square"></i>

                Edit

            </a>

            <a
                href="<?= base_url('users') ?>"
                class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>



    <!-- PROFIL -->

    <div class="card border-0 shadow mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-2 text-center">

                    <?php if (!empty($user['photo'])): ?>

                        <img
                            src="<?= base_url('uploads/users/' . $user['photo']) ?>"
                            class="rounded-circle border shadow"
                            width="140"
                            height="140"
                            style="object-fit:cover;">

                    <?php else: ?>

                        <img
                            src="https://ui-avatars.com/api/?name=<?= urlencode($user['full_name']) ?>&background=0D6EFD&color=fff&size=256"
                            class="rounded-circle border shadow"
                            width="140"
                            height="140">

                    <?php endif; ?>

                </div>

                <div class="col-md-10">

                    <h3 class="fw-bold">

                        <?= esc($user['full_name']) ?>

                    </h3>

                    <p class="text-muted mb-2">

                        <?= esc($user['role_name']) ?>

                    </p>

                    <?php if ($user['is_active']) : ?>

                        <span class="badge bg-success">

                            User Aktif

                        </span>

                    <?php else : ?>

                        <span class="badge bg-danger">

                            User Non Aktif

                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>



    <!-- DATA AKUN -->

    <div class="card border-0 shadow mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-person-badge-fill"></i>

                Data Akun

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Role

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['role_name']) ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Unit Kerja

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['unit_name']) ?>"
                        readonly>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Email Pribadi

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['personal_email']) ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Email Institusi

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['institution_email']) ?>"
                        readonly>

                </div>

            </div>

        </div>

    </div>



    <!-- ==========================
DATA PRIBADI
========================== -->

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

                    <label class="form-label fw-bold">

                        Nama Lengkap

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['full_name']) ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Jenis Kelamin

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= $user['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>"
                        readonly>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Nomor HP

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['phone']) ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        NIP

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['nip']) ?>"
                        readonly>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        NIDN

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['nidn']) ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Status

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= $user['is_active'] ? 'Aktif' : 'Non Aktif' ?>"
                        readonly>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Tempat Lahir

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['birth_place']) ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-bold">

                        Tanggal Lahir

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc($user['birth_date']) ?>"
                        readonly>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">

                    Alamat

                </label>

                <textarea
                    class="form-control"
                    rows="4"
                    readonly><?= esc($user['address']) ?></textarea>

            </div>

        </div>

    </div>


    <!-- Tombol -->

    <div class="d-flex justify-content-between">

        <a
            href="<?= base_url('users') ?>"
            class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left-circle"></i>

            Kembali

        </a>

        <a
            href="<?= base_url('users/edit/' . $user['id']) ?>"
            class="btn btn-warning">

            <i class="bi bi-pencil-square"></i>

            Edit User

        </a>

    </div>

</div>

<?= $this->endSection() ?>