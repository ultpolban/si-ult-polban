<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_tendik'); ?>

<?php
$profile = $profile ?? [];
?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-user-edit mr-2"></i>

                        Edit Profil Tendik

                    </h1>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CONTENT
    ====================================================== -->
    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-xl-9 col-lg-10">


                    <!-- =================================================
                         ALERT ERROR
                    ================================================== -->

                    <?php if (session()->getFlashdata('error')): ?>

                        <div
                            class="
                                alert
                                alert-danger
                                alert-dismissible
                                fade
                                show
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-exclamation-circle
                                    mr-2
                                "
                            ></i>

                            <?= esc(
                                session()->getFlashdata('error')
                            ) ?>

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                            >
                                &times;
                            </button>

                        </div>

                    <?php endif; ?>


                    <!-- =================================================
                         ALERT SUCCESS
                    ================================================== -->

                    <?php if (session()->getFlashdata('success')): ?>

                        <div
                            class="
                                alert
                                alert-success
                                alert-dismissible
                                fade
                                show
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-check-circle
                                    mr-2
                                "
                            ></i>

                            <?= esc(
                                session()->getFlashdata('success')
                            ) ?>

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                            >
                                &times;
                            </button>

                        </div>

                    <?php endif; ?>


                    <!-- =================================================
                         FORM
                    ================================================== -->

                    <form
                        action="<?= base_url('tendik/profile/update') ?>"
                        method="post"
                        enctype="multipart/form-data"
                    >

                        <?= csrf_field() ?>


                        <div
                            class="card shadow-sm"
                            style="
                                border-radius:15px;
                                border-top:5px solid #0b3d91;
                            "
                        >


                            <!-- CARD HEADER -->

                            <div
                                class="card-header"
                                style="
                                    background:#0b3d91;
                                    color:white;
                                "
                            >

                                <h3 class="card-title">

                                    <i
                                        class="
                                            fas
                                            fa-user-edit
                                            mr-2
                                        "
                                    ></i>

                                    Edit Informasi Profil

                                </h3>

                            </div>


                            <!-- CARD BODY -->

                            <div class="card-body">


                                <!-- =================================================
                                     FOTO PROFILE
                                ================================================== -->

                                <div
                                    class="
                                        text-center
                                        mb-4
                                    "
                                >

                                    <?php if (!empty($profile['foto'])): ?>

                                        <img
                                            id="previewFoto"
                                            src="<?= base_url(
                                                'uploads/profile/' .
                                                $profile['foto']
                                            ) ?>"
                                            alt="Foto Profil"
                                            style="
                                                width:170px;
                                                height:170px;
                                                object-fit:cover;
                                                border-radius:50%;
                                                border:5px solid #0b3d91;
                                                box-shadow:
                                                    0 5px 15px
                                                    rgba(0,0,0,.15);
                                            "
                                        >

                                    <?php else: ?>

                                        <div
                                            id="previewDefault"
                                            style="
                                                width:170px;
                                                height:170px;
                                                margin:auto;
                                                border-radius:50%;
                                                background:#0b3d91;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                                color:white;
                                                font-size:70px;
                                            "
                                        >

                                            <i class="fas fa-user-tie"></i>

                                        </div>

                                        <img
                                            id="previewFoto"
                                            src=""
                                            alt="Preview Foto"
                                            style="
                                                display:none;
                                                width:170px;
                                                height:170px;
                                                object-fit:cover;
                                                border-radius:50%;
                                                border:5px solid #0b3d91;
                                            "
                                        >

                                    <?php endif; ?>


                                    <div class="mt-3">

                                        <label
                                            for="foto"
                                            class="btn btn-primary"
                                        >

                                            <i
                                                class="
                                                    fas
                                                    fa-camera
                                                    mr-1
                                                "
                                            ></i>

                                            Pilih Foto Profil

                                        </label>

                                        <input
                                            type="file"
                                            name="foto"
                                            id="foto"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            style="display:none;"
                                        >

                                    </div>


                                    <small
                                        class="
                                            text-muted
                                            d-block
                                            mt-2
                                        "
                                    >

                                        Format:
                                        JPG, JPEG, PNG, WEBP.

                                        <br>

                                        Maksimal 2 MB.

                                    </small>

                                </div>


                                <hr>


                                <!-- =================================================
                                     DATA PRIBADI
                                ================================================== -->

                                <h4
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-user
                                            mr-2
                                        "
                                    ></i>

                                    Data Pribadi

                                </h4>


                                <div class="row mt-4">


                                    <!-- NAMA -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="nama"
                                            class="font-weight-bold"
                                        >

                                            Nama Lengkap

                                            <span class="text-danger">
                                                *
                                            </span>

                                        </label>

                                        <input
                                            type="text"
                                            name="nama"
                                            id="nama"
                                            class="form-control"
                                            value="<?= old(
                                                'nama',
                                                $profile['nama'] ?? ''
                                            ) ?>"
                                            required
                                        >

                                    </div>


                                    <!-- NIK -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="nik"
                                            class="font-weight-bold"
                                        >

                                            NIK

                                        </label>

                                        <input
                                            type="text"
                                            name="nik"
                                            id="nik"
                                            class="form-control bg-light"
                                            value="<?= esc(
                                                $profile['nik'] ?? ''
                                            ) ?>"
                                            readonly
                                        >

                                        <small class="text-muted">

                                            <i class="fas fa-lock mr-1"></i>

                                            NIK tidak dapat diubah.

                                        </small>

                                    </div>


                                    <!-- NIP -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="nip"
                                            class="font-weight-bold"
                                        >

                                            NIP

                                        </label>

                                        <input
                                            type="text"
                                            name="nip"
                                            id="nip"
                                            class="form-control bg-light"
                                            value="<?= esc(
                                                $profile['nip'] ?? ''
                                            ) ?>"
                                            readonly
                                        >

                                        <small class="text-muted">

                                            <i class="fas fa-lock mr-1"></i>

                                            NIP tidak dapat diubah.

                                        </small>

                                    </div>


                                    <!-- EMAIL -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="email"
                                            class="font-weight-bold"
                                        >

                                            Email

                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control bg-light"
                                            value="<?= esc(
                                                $profile['email'] ?? ''
                                            ) ?>"
                                            readonly
                                        >

                                        <small class="text-muted">

                                            <i class="fas fa-lock mr-1"></i>

                                            Email tidak dapat diubah.

                                        </small>

                                    </div>


                                    <!-- JENIS KELAMIN -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="jenis_kelamin"
                                            class="font-weight-bold"
                                        >

                                            Jenis Kelamin

                                        </label>

                                        <?php
                                        $gender =
                                            $profile['jenis_kelamin']
                                            ?? '';

                                        $genderLabel = '';

                                        if ($gender === 'L') {
                                            $genderLabel = 'Laki-laki';
                                        } elseif ($gender === 'P') {
                                            $genderLabel = 'Perempuan';
                                        } else {
                                            $genderLabel = $gender;
                                        }
                                        ?>

                                        <input
                                            type="text"
                                            name="jenis_kelamin"
                                            id="jenis_kelamin"
                                            class="form-control bg-light"
                                            value="<?= esc(
                                                $genderLabel
                                            ) ?>"
                                            readonly
                                        >

                                        <small class="text-muted">

                                            <i class="fas fa-lock mr-1"></i>

                                            Jenis kelamin tidak dapat diubah.

                                        </small>

                                    </div>


                                    <!-- NOMOR HP -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="no_hp"
                                            class="font-weight-bold"
                                        >

                                            Nomor HP

                                        </label>

                                        <input
                                            type="text"
                                            name="no_hp"
                                            id="no_hp"
                                            class="form-control"
                                            value="<?= old(
                                                'no_hp',
                                                $profile['no_hp'] ?? ''
                                            ) ?>"
                                            maxlength="20"
                                        >

                                    </div>


                                    <!-- ALAMAT -->

                                    <div class="col-md-12 mb-3">

                                        <label
                                            for="alamat"
                                            class="font-weight-bold"
                                        >

                                            Alamat

                                        </label>

                                        <textarea
                                            name="alamat"
                                            id="alamat"
                                            rows="4"
                                            class="form-control"
                                        ><?= old(
                                            'alamat',
                                            $profile['alamat'] ?? ''
                                        ) ?></textarea>

                                    </div>

                                </div>


                                <hr class="my-4">


                                <!-- =================================================
                                     INFORMASI KEPEGAWAIAN
                                ================================================== -->

                                <h4
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-briefcase
                                            mr-2
                                        "
                                    ></i>

                                    Informasi Kepegawaian

                                </h4>


                                <div class="row mt-4">


                                    <!-- JABATAN -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="jabatan"
                                            class="font-weight-bold"
                                        >

                                            Jabatan

                                        </label>

                                        <input
                                            type="text"
                                            name="jabatan"
                                            id="jabatan"
                                            class="form-control"
                                            value="<?= old(
                                                'jabatan',
                                                $profile['jabatan']
                                                ?? 'Tendik'
                                            ) ?>"
                                        >

                                    </div>


                                    <!-- STATUS -->

                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="status"
                                            class="font-weight-bold"
                                        >

                                            Status

                                        </label>

                                        <input
                                            type="text"
                                            id="status"
                                            class="form-control bg-light"
                                            value="<?= esc(
                                                $profile['status']
                                                ?? 'Aktif'
                                            ) ?>"
                                            readonly
                                        >

                                        <small class="text-muted">

                                            <i class="fas fa-lock mr-1"></i>

                                            Status mengikuti status akun pengguna.

                                        </small>

                                    </div>

                                </div>


                            </div>


                            <!-- =================================================
                                 CARD FOOTER
                            ================================================== -->

                            <div
                                class="
                                    card-footer
                                    d-flex
                                    justify-content-between
                                "
                            >

                                <a
                                    href="<?= base_url(
                                        'tendik/profile'
                                    ) ?>"
                                    class="
                                        btn
                                        btn-secondary
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-arrow-left
                                            mr-1
                                        "
                                    ></i>

                                    Kembali

                                </a>


                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >

                                    <i
                                        class="
                                            fas
                                            fa-save
                                            mr-1
                                        "
                                    ></i>

                                    Simpan Perubahan

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>


<!-- =====================================================
     PREVIEW FOTO
====================================================== -->

<script>

document
    .getElementById('foto')
    .addEventListener(
        'change',
        function(event) {

            const file =
                event.target.files[0];

            if (!file) {
                return;
            }

            const reader =
                new FileReader();

            reader.onload =
                function(e) {

                    const preview =
                        document.getElementById(
                            'previewFoto'
                        );

                    const defaultIcon =
                        document.getElementById(
                            'previewDefault'
                        );

                    preview.src =
                        e.target.result;

                    preview.style.display =
                        'block';

                    if (defaultIcon) {

                        defaultIcon.style.display =
                            'none';

                    }

                };

            reader.readAsDataURL(file);

        }
    );

</script>


<?= $this->include('layouts/footer'); ?>