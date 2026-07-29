<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_mahasiswa'); ?>

<?php

$profile =
    $profile
    ?? [];

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

                        <i
                            class="
                                fas
                                fa-user-edit
                                mr-2
                            "
                        ></i>

                        Edit Profil Mahasiswa

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

                <div
                    class="
                        col-xl-9
                        col-lg-10
                    "
                >


                    <!-- =================================================
                         ALERT ERROR
                    ================================================== -->

                    <?php if (
                        session()->getFlashdata(
                            'error'
                        )
                    ): ?>

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
                                session()->getFlashdata(
                                    'error'
                                )
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
                        action="<?= base_url(
                            'mahasiswa/profile/update'
                        ) ?>"
                        method="post"
                        enctype="multipart/form-data"
                    >

                        <?= csrf_field() ?>


                        <div
                            class="
                                card
                                shadow-sm
                            "
                            style="
                                border-radius:15px;
                                border-top:
                                    5px solid #0b3d91;
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

                                <h3
                                    class="card-title"
                                >

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

                                    <?php if (
                                        !empty(
                                            $profile['foto']
                                            ?? null
                                        )
                                    ): ?>

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

                                            <i
                                                class="
                                                    fas
                                                    fa-user-graduate
                                                "
                                            ></i>

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


                                    <div
                                        class="mt-3"
                                    >

                                        <label
                                            for="foto"
                                            class="
                                                btn
                                                btn-primary
                                            "
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
                                            accept="
                                                .jpg,
                                                .jpeg,
                                                .png,
                                                .webp
                                            "
                                            style="
                                                display:none;
                                            "
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


                                <div
                                    class="
                                        row
                                        mt-4
                                    "
                                >


                                    <!-- NAMA -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            for="nama"
                                            class="font-weight-bold"
                                        >

                                            Nama Lengkap

                                            <span
                                                class="
                                                    text-danger
                                                "
                                            >
                                                *
                                            </span>

                                        </label>

                                        <input
                                            type="text"
                                            name="nama"
                                            id="nama"
                                            class="form-control"
                                            value="<?= esc(
                                                $profile['nama']
                                                ?? ''
                                            ) ?>"
                                            required
                                        >

                                    </div>


                                    <!-- NIK -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            for="nik"
                                            class="font-weight-bold"
                                        >

                                            NIK

                                            <span
                                                class="
                                                    text-danger
                                                "
                                            >
                                                *
                                            </span>

                                        </label>

                                        <input
                                            type="text"
                                            name="nik"
                                            id="nik"
                                            class="form-control"
                                            value="<?= esc(
                                                $profile['nik']
                                                ?? ''
                                            ) ?>"
                                            maxlength="16"
                                            minlength="16"
                                            pattern="[0-9]{16}"
                                            placeholder="
                                                Masukkan 16 digit NIK
                                            "
                                            required
                                        >

                                        <small
                                            class="
                                                text-muted
                                            "
                                        >

                                            NIK harus terdiri dari
                                            16 digit angka.

                                        </small>

                                    </div>


                                    <!-- NIM -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            class="font-weight-bold"
                                        >

                                            NIM

                                        </label>

<input
    type="text"
    name="nim"
    id="nim"
    class="form-control"
    value="<?= esc(
        $profile['nim']
        ?? ''
    ) ?>"
    required
>

                                    </div>


                                    <!-- EMAIL -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            for="email"
                                            class="font-weight-bold"
                                        >

                                            Email

                                            <span
                                                class="
                                                    text-danger
                                                "
                                            >
                                                *
                                            </span>

                                        </label>

                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            class="form-control"
                                            value="<?= esc(
                                                $profile['email']
                                                ?? ''
                                            ) ?>"
                                            required
                                        >

                                    </div>


                                    <!-- NOMOR HP -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            for="no_hp"
                                            class="font-weight-bold"
                                        >

                                            Nomor HP

                                            <span
                                                class="
                                                    text-danger
                                                "
                                            >
                                                *
                                            </span>

                                        </label>

                                        <input
                                            type="text"
                                            name="no_hp"
                                            id="no_hp"
                                            class="form-control"
                                            value="<?= esc(
                                                $profile['no_hp']
                                                ?? ''
                                            ) ?>"
                                            required
                                        >

                                    </div>


                                    <!-- JENIS KELAMIN -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            for="jenis_kelamin"
                                            class="font-weight-bold"
                                        >

                                            Jenis Kelamin

                                            <span
                                                class="
                                                    text-danger
                                                "
                                            >
                                                *
                                            </span>

                                        </label>

                                        <select
                                            name="jenis_kelamin"
                                            id="jenis_kelamin"
                                            class="form-control"
                                            required
                                        >

                                            <option
                                                value=""
                                            >

                                                --
                                                Pilih Jenis Kelamin
                                                --

                                            </option>

                                            <option
                                                value="Laki-laki"
                                                <?= (
                                                    (
                                                        $profile[
                                                            'jenis_kelamin'
                                                        ]
                                                        ?? ''
                                                    )
                                                    ===
                                                    'Laki-laki'
                                                )
                                                    ? 'selected'
                                                    : ''
                                                ?>
                                            >

                                                Laki-laki

                                            </option>

                                            <option
                                                value="Perempuan"
                                                <?= (
                                                    (
                                                        $profile[
                                                            'jenis_kelamin'
                                                        ]
                                                        ?? ''
                                                    )
                                                    ===
                                                    'Perempuan'
                                                )
                                                    ? 'selected'
                                                    : ''
                                                ?>
                                            >

                                                Perempuan

                                            </option>

                                        </select>

                                    </div>


                                    <!-- ALAMAT -->

                                    <div
                                        class="
                                            col-md-12
                                            mb-3
                                        "
                                    >

                                        <label
                                            for="alamat"
                                            class="font-weight-bold"
                                        >

                                            Alamat

                                            <span
                                                class="
                                                    text-danger
                                                "
                                            >
                                                *
                                            </span>

                                        </label>

                                        <textarea
                                            name="alamat"
                                            id="alamat"
                                            rows="4"
                                            class="form-control"
                                            required
                                        ><?= esc(
                                            $profile['alamat']
                                            ?? ''
                                        ) ?></textarea>

                                    </div>

                                </div>


                                <hr
                                    class="my-4"
                                >


                                <!-- =================================================
                                     INFORMASI AKADEMIK
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
                                            fa-graduation-cap
                                            mr-2
                                        "
                                    ></i>

                                    Informasi Akademik

                                </h4>


                                <div
                                    class="
                                        row
                                        mt-4
                                    "
                                >


                                    <!-- PROGRAM STUDI -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            class="font-weight-bold"
                                        >

                                            Program Studi

                                        </label>

<input
    type="text"
    name="prodi"
    id="prodi"
    class="form-control"
    value="<?= esc(
        $profile['prodi']
        ?? ''
    ) ?>"
    required
>

                                    </div>


                                    <!-- FAKULTAS -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            class="font-weight-bold"
                                        >

                                            Fakultas

                                        </label>

<input
    type="text"
    name="fakultas"
    id="fakultas"
    class="form-control"
    value="<?= esc(
        $profile['fakultas']
        ?? ''
    ) ?>"
    required
>

                                    </div>


                                    <!-- JURUSAN -->

                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        "
                                    >

                                        <label
                                            class="font-weight-bold"
                                        >

                                            Jurusan

                                        </label>

<input
    type="text"
    name="jurusan"
    id="jurusan"
    class="form-control"
    value="<?= esc(
        $profile['jurusan']
        ?? ''
    ) ?>"
    required
>

                                    </div>


                                    <!-- SEMESTER -->

                                    <div
                                        class="
                                            col-md-3
                                            mb-3
                                        "
                                    >

                                        <label
                                            class="font-weight-bold"
                                        >

                                            Semester

                                        </label>

<input
    type="number"
    name="semester"
    id="semester"
    class="form-control"
    value="<?= esc(
        $profile['semester']
        ?? ''
    ) ?>"
    min="1"
    max="14"
    required
>

                                    </div>


                                    <!-- ANGKATAN -->

                                    <div
                                        class="
                                            col-md-3
                                            mb-3
                                        "
                                    >

                                        <label
                                            class="font-weight-bold"
                                        >

                                            Angkatan

                                        </label>

<input
    type="number"
    name="angkatan"
    id="angkatan"
    class="form-control"
    value="<?= esc(
        $profile['angkatan']
        ?? ''
    ) ?>"
    min="2000"
    max="2100"
    required
>

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
                                        'mahasiswa/profile'
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
                                    class="
                                        btn
                                        btn-success
                                    "
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
                        document
                            .getElementById(
                                'previewFoto'
                            );

                    const defaultIcon =
                        document
                            .getElementById(
                                'previewDefault'
                            );

                    preview.src =
                        e.target.result;

                    preview.style.display =
                        'block';

                    if (
                        defaultIcon
                    ) {

                        defaultIcon.style.display =
                            'none';

                    }

                };

            reader.readAsDataURL(
                file
            );

        }
    );

</script>


<?= $this->include('layouts/footer'); ?>