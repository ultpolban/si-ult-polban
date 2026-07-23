<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-7">

                    <h1 class="fw-bold profile-page-title">

                        <i class="fas fa-user-edit"></i>

                        Edit Profil Mahasiswa

                    </h1>

                </div>

                <div class="col-md-5 text-md-end mt-2 mt-md-0">

                    <a
                        href="<?= base_url('mahasiswa/profile') ?>"
                        class="btn btn-outline-primary"
                    >

                        <i class="fas fa-arrow-left"></i>

                        Kembali ke Profil

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="card profile-card shadow-sm">

                        <!-- CARD HEADER -->

                        <div class="card-header profile-card-header">

                            <h3 class="card-title">

                                <i class="fas fa-user-edit"></i>

                                Form Edit Profil

                            </h3>

                        </div>


                        <!-- FORM -->

                        <form
                            action="<?= base_url('mahasiswa/profile/update') ?>"
                            method="post"
                        >

                            <?= csrf_field() ?>

                            <div class="card-body">

                                <div class="row">

                                    <!-- ================= -->
                                    <!-- DATA IDENTITAS -->
                                    <!-- ================= -->

                                    <div class="col-12">

                                        <h5 class="section-title">

                                            <i class="fas fa-id-card"></i>

                                            Data Identitas

                                        </h5>

                                    </div>


                                    <!-- NAMA -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Nama Lengkap

                                        </label>

                                        <input
                                            type="text"
                                            name="nama"
                                            class="form-control"
                                            value="<?= esc($user['nama'] ?? '') ?>"
                                            required
                                        >

                                    </div>


                                    <!-- NIM -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            NIM

                                        </label>

                                        <input
                                            type="text"
                                            name="nim"
                                            class="form-control"
                                            value="<?= esc($user['nim'] ?? '') ?>"
                                            readonly
                                        >

                                        <small class="text-muted">

                                            NIM tidak dapat diubah.

                                        </small>

                                    </div>


                                    <!-- NIK -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            NIK

                                        </label>

                                        <input
                                            type="text"
                                            name="nik"
                                            class="form-control"
                                            value="<?= esc($user['nik'] ?? '') ?>"
                                            maxlength="16"
                                        >

                                    </div>


                                    <!-- TEMPAT LAHIR -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Tempat Lahir

                                        </label>

                                        <input
                                            type="text"
                                            name="tempat_lahir"
                                            class="form-control"
                                            value="<?= esc($user['tempat_lahir'] ?? '') ?>"
                                        >

                                    </div>


                                    <!-- TANGGAL LAHIR -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Tanggal Lahir

                                        </label>

                                        <input
                                            type="date"
                                            name="tanggal_lahir"
                                            class="form-control"
                                            value="<?= esc($user['tanggal_lahir'] ?? '') ?>"
                                        >

                                    </div>


                                    <!-- JENIS KELAMIN -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Jenis Kelamin

                                        </label>

                                        <select
                                            name="jenis_kelamin"
                                            class="form-control"
                                        >

                                            <option value="">
                                                -- Pilih Jenis Kelamin --
                                            </option>

                                            <option
                                                value="Laki-laki"
                                                <?= ($user['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' ?>
                                            >
                                                Laki-laki
                                            </option>

                                            <option
                                                value="Perempuan"
                                                <?= ($user['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' ?>
                                            >
                                                Perempuan
                                            </option>

                                        </select>

                                    </div>


                                    <!-- ================= -->
                                    <!-- DATA AKADEMIK -->
                                    <!-- ================= -->

                                    <div class="col-12 mt-3">

                                        <h5 class="section-title">

                                            <i class="fas fa-graduation-cap"></i>

                                            Data Akademik

                                        </h5>

                                    </div>


                                    <!-- PROGRAM STUDI -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Program Studi

                                        </label>

                                        <input
                                            type="text"
                                            name="prodi"
                                            class="form-control"
                                            value="<?= esc($user['prodi'] ?? '') ?>"
                                            readonly
                                        >

                                    </div>


                                    <!-- FAKULTAS -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Fakultas

                                        </label>

                                        <input
                                            type="text"
                                            name="fakultas"
                                            class="form-control"
                                            value="<?= esc($user['fakultas'] ?? '') ?>"
                                            readonly
                                        >

                                    </div>


                                    <!-- ANGKATAN -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Tahun Angkatan

                                        </label>

                                        <input
                                            type="text"
                                            name="angkatan"
                                            class="form-control"
                                            value="<?= esc($user['angkatan'] ?? '') ?>"
                                            readonly
                                        >

                                    </div>


                                    <!-- STATUS -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Status Keaktifan Kuliah

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            value="<?= esc($user['status'] ?? '') ?>"
                                            readonly
                                        >

                                    </div>


                                    <!-- DOSEN WALI -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Dosen Wali

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            value="<?= esc($user['dosen_wali'] ?? '') ?>"
                                            readonly
                                        >

                                    </div>


                                    <!-- ================= -->
                                    <!-- DATA KONTAK -->
                                    <!-- ================= -->

                                    <div class="col-12 mt-3">

                                        <h5 class="section-title">

                                            <i class="fas fa-address-book"></i>

                                            Data Kontak

                                        </h5>

                                    </div>


                                    <!-- TELEPON -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Nomor Telepon

                                        </label>

                                        <input
                                            type="text"
                                            name="telepon"
                                            class="form-control"
                                            value="<?= esc($user['telepon'] ?? '') ?>"
                                        >

                                    </div>


                                    <!-- EMAIL -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Email

                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            value="<?= esc($user['email'] ?? '') ?>"
                                        >

                                    </div>


                                    <!-- ALAMAT -->

                                    <div class="col-12 mb-3">

                                        <label class="form-label">

                                            Alamat

                                        </label>

                                        <textarea
                                            name="alamat"
                                            class="form-control"
                                            rows="4"
                                        ><?= esc($user['alamat'] ?? '') ?></textarea>

                                    </div>

                                </div>

                            </div>


                            <!-- FOOTER -->

                            <div class="card-footer text-end">

                                <a
                                    href="<?= base_url('mahasiswa/profile') ?>"
                                    class="btn btn-secondary me-2"
                                >

                                    <i class="fas fa-times"></i>

                                    Batal

                                </a>


                                <button
                                    type="submit"
                                    class="btn btn-danger btn-save-profile"
                                >

                                    <i class="fas fa-save"></i>

                                    Simpan Perubahan

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<style>

/* ============================= */
/* JUDUL */
/* ============================= */

.profile-page-title {
    color: #0d47a1;
}

/* ============================= */
/* CARD */
/* ============================= */

.profile-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

/* ============================= */
/* HEADER CARD */
/* ============================= */

.profile-card-header {
    background-color: #0d47a1;
    color: white;
    padding: 15px 20px;
    border-bottom: 3px solid #f59e0b;
}

.profile-card-header .card-title {
    font-size: 19px;
    font-weight: 600;
}

/* ============================= */
/* SECTION TITLE */
/* ============================= */

.section-title {
    color: #0d47a1;
    font-weight: 700;
    border-bottom: 2px solid #0d47a1;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

/* ============================= */
/* LABEL */
/* ============================= */

.form-label {
    color: #172554;
    font-weight: 600;
}

/* ============================= */
/* FORM CONTROL */
/* ============================= */

.form-control {
    border-radius: 7px;
    border: 1px solid #cbd5e1;
    padding: 10px 12px;
}

.form-control:focus {
    border-color: #0d47a1;
    box-shadow: 0 0 0 0.2rem rgba(13, 71, 161, 0.15);
}

/* ============================= */
/* READONLY */
/* ============================= */

.form-control[readonly] {
    background-color: #f1f5f9;
    color: #64748b;
}

/* ============================= */
/* BUTTON SIMPAN */
/* ============================= */

.btn-save-profile {
    background: #0d47a1;
    border-color: #0d47a1;
    color: white;
    padding: 10px 22px;
    transition: all 0.2s ease;
}

.btn-save-profile:hover {
    background: #f59e0b;
    border-color: #f59e0b;
    color: white;
    transform: translateY(-2px);
}

/* ============================= */
/* BUTTON KEMBALI */
/* ============================= */

.btn-outline-primary {
    color: #0d47a1;
    border-color: #0d47a1;
}

.btn-outline-primary:hover {
    background: #f59e0b;
    border-color: #f59e0b;
    color: white;
}

</style>

</style>


<?= $this->include('layouts/footer') ?>