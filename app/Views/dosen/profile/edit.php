<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>


<style>
    .profile-edit-page {
        background: #f4f7fb;
        min-height: calc(100vh - 57px);
        padding-bottom: 40px;
    }

    .profile-edit-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
        overflow: hidden;
    }

    .profile-edit-card .card-header {
        background: #0b3d91;
        color: white;
        padding: 20px 25px;
        border: none;
    }

    .profile-edit-card .card-header h3 {
        margin: 0;
        font-size: 21px;
        font-weight: 700;
    }


    /* =========================
       FOTO PROFIL
    ========================== */

    .photo-section {
        text-align: center;
        padding: 10px 20px 30px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 30px;
    }

    .profile-photo-wrapper {
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #0b3d91;
        box-shadow: 0 5px 15px rgba(0, 0, 0, .15);
        background: #eef3f8;
    }

    .photo-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 5px solid #0b3d91;
        background: #eef3f8;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: auto;

        color: #0b3d91;
        font-size: 65px;
    }

    .photo-label {
        display: inline-block;
        background: #f28c28;
        color: white;

        padding: 10px 20px;

        border-radius: 8px;

        cursor: pointer;

        font-weight: 600;

        transition: .2s;
    }

    .photo-label:hover {
        background: #d97617;
        color: white;
    }

    .photo-info {
        color: #718096;
        font-size: 14px;
        margin-top: 10px;
    }


    /* =========================
       FORM
    ========================== */

    .section-title {
        color: #0b3d91;
        font-size: 20px;
        font-weight: 700;

        border-bottom: 2px solid #f28c28;

        padding-bottom: 10px;

        margin-bottom: 25px;
    }

    .form-label {
        color: #17365d;
        font-weight: 700;
        font-size: 16px;
    }

    .form-control,
    .form-select {
        min-height: 48px;

        border-radius: 8px;

        border: 1px solid #cbd5e1;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0b3d91;

        box-shadow:
            0 0 0 .2rem
            rgba(11, 61, 145, .12);
    }

    .readonly-input {
        background: #eef3f8;
        color: #64748b;
    }


    /* =========================
       BUTTON
    ========================== */

    .btn-save {
        background: #0b3d91;

        border: none;

        color: white;

        padding: 11px 25px;

        border-radius: 8px;

        font-weight: 700;
    }

    .btn-save:hover {
        background: #082f70;
        color: white;
    }

    .btn-cancel {
        padding: 11px 25px;

        border-radius: 8px;
    }
</style>


<div class="content-wrapper profile-edit-page">


    <!-- =========================
         HEADER
    ========================== -->

    <section class="content-header">

        <div class="container-fluid">

            <h1
                style="
                    color:#0b3d91;
                    font-weight:700;
                "
            >

                <i class="fas fa-user-edit"></i>

                Edit Profil Dosen

            </h1>

            <p class="text-muted">

                Perbarui informasi profil dan foto Anda.

            </p>

        </div>

    </section>



    <!-- =========================
         CONTENT
    ========================== -->

    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-9">


                    <div class="card profile-edit-card">


                        <!-- CARD HEADER -->

                        <div class="card-header">

                            <h3>

                                <i class="fas fa-user-circle me-2"></i>

                                Pengaturan Profil Dosen

                            </h3>

                        </div>



                        <!-- CARD BODY -->

                        <div class="card-body">


                            <!-- =========================
                                 FORM
                            ========================== -->

                            <form
                                action="<?= base_url('dosen/profile/update') ?>"
                                method="post"
                                enctype="multipart/form-data"
                            >

                                <?= csrf_field() ?>



                                <!-- =========================
                                     FOTO PROFIL
                                ========================== -->

                                <div class="photo-section">


                                    <div class="profile-photo-wrapper">


                                        <?php if (!empty($user['foto'])): ?>

                                            <img
                                                id="profilePreview"
                                                src="<?= base_url('uploads/profile/' . $user['foto']) ?>"
                                                class="profile-photo"
                                                alt="Foto Profil"
                                            >

                                            <div
                                                id="photoPlaceholder"
                                                class="photo-placeholder"
                                                style="display:none;"
                                            >

                                                <i class="fas fa-user"></i>

                                            </div>

                                        <?php else: ?>

                                            <div
                                                id="photoPlaceholder"
                                                class="photo-placeholder"
                                            >

                                                <i class="fas fa-user"></i>

                                            </div>

                                            <img
                                                id="profilePreview"
                                                class="profile-photo"
                                                style="display:none;"
                                                alt="Foto Profil"
                                            >

                                        <?php endif; ?>


                                    </div>



                                    <!-- PILIH FOTO -->

                                    <label
                                        for="foto"
                                        class="photo-label"
                                    >

                                        <i class="fas fa-camera me-2"></i>

                                        Pilih Foto Profil

                                    </label>


                                    <input
                                        type="file"
                                        id="foto"
                                        name="foto"
                                        accept="image/jpeg,image/png,image/jpg"
                                        hidden
                                    >


                                    <div class="photo-info">

                                        Format JPG atau PNG.

                                        <br>

                                        Maksimal ukuran foto 2 MB.

                                    </div>


                                </div>



                                <!-- =========================
                                     DATA PRIBADI
                                ========================== -->

                                <div class="section-title">

                                    <i class="fas fa-user me-2"></i>

                                    Data Pribadi

                                </div>


                                <div class="row">


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
                                        >

                                    </div>



                                    <!-- NIP / NIDN -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            NIP / NIDN

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control readonly-input"
                                            value="<?= esc($user['nip'] ?? '') ?>"
                                            readonly
                                        >

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
                                            class="form-select"
                                        >

                                            <option value="">

                                                -- Pilih Jenis Kelamin --

                                            </option>


                                            <option
                                                value="Laki-laki"
                                                <?= ($user['jenis_kelamin'] ?? '') === 'Laki-laki'
                                                    ? 'selected'
                                                    : '' ?>
                                            >

                                                Laki-laki

                                            </option>


                                            <option
                                                value="Perempuan"
                                                <?= ($user['jenis_kelamin'] ?? '') === 'Perempuan'
                                                    ? 'selected'
                                                    : '' ?>
                                            >

                                                Perempuan

                                            </option>

                                        </select>

                                    </div>


                                </div>



                                <!-- =========================
                                     INFORMASI AKADEMIK
                                ========================== -->

                                <div class="section-title mt-4">

                                    <i class="fas fa-building-columns me-2"></i>

                                    Informasi Akademik

                                </div>


                                <div class="row">


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
                                        >

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
                                        >

                                    </div>



                                    <!-- JABATAN -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Jabatan

                                        </label>

                                        <input
                                            type="text"
                                            name="jabatan"
                                            class="form-control"
                                            value="<?= esc($user['jabatan'] ?? '') ?>"
                                        >

                                    </div>



                                    <!-- PANGKAT -->

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Pangkat / Golongan

                                        </label>

                                        <input
                                            type="text"
                                            name="pangkat"
                                            class="form-control"
                                            value="<?= esc($user['pangkat'] ?? '') ?>"
                                        >

                                    </div>


                                </div>



                                <!-- =========================
                                     INFORMASI KONTAK
                                ========================== -->

                                <div class="section-title mt-4">

                                    <i class="fas fa-address-book me-2"></i>

                                    Informasi Kontak

                                </div>


                                <div class="row">


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



                                <!-- =========================
                                     BUTTON
                                ========================== -->

                                <div class="d-flex justify-content-end gap-2 mt-4">


                                    <a
                                        href="<?= base_url('dosen/profile') ?>"
                                        class="btn btn-secondary btn-cancel"
                                    >

                                        <i class="fas fa-arrow-left me-1"></i>

                                        Batal

                                    </a>



                                    <button
                                        type="submit"
                                        class="btn btn-save"
                                    >

                                        <i class="fas fa-save me-1"></i>

                                        Simpan Perubahan

                                    </button>


                                </div>


                            </form>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>



<!-- =========================
     PREVIEW FOTO
========================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const fotoInput =
            document.getElementById('foto');


        const preview =
            document.getElementById('profilePreview');


        const placeholder =
            document.getElementById('photoPlaceholder');



        fotoInput.addEventListener(
            'change',
            function () {


                const file =
                    this.files[0];


                if (!file) {

                    return;

                }



                /*
                =====================================
                CEK FORMAT FILE
                =====================================
                */

                const allowedTypes = [

                    'image/jpeg',

                    'image/png',

                    'image/jpg'

                ];


                if (
                    !allowedTypes.includes(
                        file.type
                    )
                ) {

                    alert(
                        'Foto harus berformat JPG atau PNG.'
                    );

                    this.value = '';

                    return;

                }



                /*
                =====================================
                CEK UKURAN MAKSIMAL 2 MB
                =====================================
                */

                if (
                    file.size >
                    2 * 1024 * 1024
                ) {

                    alert(
                        'Ukuran foto maksimal adalah 2 MB.'
                    );

                    this.value = '';

                    return;

                }



                /*
                =====================================
                PREVIEW FOTO
                =====================================
                */

                const reader =
                    new FileReader();


                reader.onload =
                    function (e) {


                        preview.src =
                            e.target.result;


                        preview.style.display =
                            'block';


                        placeholder.style.display =
                            'none';


                    };


                reader.readAsDataURL(file);


            }
        );


    }
);

</script>



<?= $this->include('layouts/footer') ?>