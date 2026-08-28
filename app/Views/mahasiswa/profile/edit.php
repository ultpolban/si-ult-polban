<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_mahasiswa'); ?>

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
                        ">
                        <i
                            class="
                                fas
                                fa-user-edit
                                mr-2
                            "></i>

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
                    ">

                    <!-- =================================================
                         ALERT ERROR
                    ================================================== -->
                    <?php if (
                        session()->getFlashdata('error')
                    ): ?>

                        <div
                            class="
                                alert
                                alert-danger
                                alert-dismissible
                                fade
                                show
                            ">

                            <i
                                class="
                                    fas
                                    fa-exclamation-circle
                                    mr-2
                                "></i>

                            <?= esc(
                                session()->getFlashdata('error')
                            ) ?>

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert">
                                &times;
                            </button>

                        </div>

                    <?php endif; ?>


                    <!-- =================================================
                         ALERT SUCCESS
                    ================================================== -->
                    <?php if (
                        session()->getFlashdata('success')
                    ): ?>

                        <div
                            class="
                                alert
                                alert-success
                                alert-dismissible
                                fade
                                show
                            ">

                            <i
                                class="
                                    fas
                                    fa-check-circle
                                    mr-2
                                "></i>

                            <?= esc(
                                session()->getFlashdata('success')
                            ) ?>

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert">
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
                        enctype="multipart/form-data">

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
                            ">

                            <!-- CARD HEADER -->
                            <div
                                class="card-header"
                                style="
                                    background:#0b3d91;
                                    color:white;
                                ">

                                <h3
                                    class="card-title">

                                    <i
                                        class="
                                            fas
                                            fa-user-edit
                                            mr-2
                                        "></i>

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
                                    ">

                                    <?php if (
                                        !empty($profile['foto']
                                            ?? null)
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
                                            ">

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
                                            ">

                                            <i
                                                class="
                                                    fas
                                                    fa-user-graduate
                                                "></i>

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
                                            ">

                                    <?php endif; ?>


                                    <div class="mt-3">

                                        <label
                                            for="foto"
                                            class="
                                                btn
                                                btn-primary
                                            ">

                                            <i
                                                class="
                                                    fas
                                                    fa-camera
                                                    mr-1
                                                "></i>

                                            Pilih Foto Profil

                                        </label>

                                        <input
                                            type="file"
                                            name="foto"
                                            id="foto"
                                            accept=".jpg,.jpeg,.png,.webp"
                                            style="display:none;">

                                    </div>


                                    <small
                                        class="
                                            text-muted
                                            d-block
                                            mt-2
                                        ">

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
                                    ">

                                    <i
                                        class="
                                            fas
                                            fa-user
                                            mr-2
                                        "></i>

                                    Data Pribadi

                                </h4>


                                <div
                                    class="
                                        row
                                        mt-4
                                    ">


                                    <!-- NAMA -->
                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        ">

                                        <label
                                            for="nama"
                                            class="font-weight-bold">

                                            Nama Lengkap

                                            <span
                                                class="text-danger">
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
                                            required>

                                    </div>


                                    <!-- NIM -->
                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        ">

                                        <label
                                            class="font-weight-bold">
                                            NIM
                                        </label>

                                        <input
                                            type="text"
                                            class="
                                                form-control
                                                bg-light
                                            "
                                            value="<?= esc(
                                                        $profile['nim']
                                                            ?? ''
                                                    ) ?>"
                                            readonly>

                                        <small
                                            class="text-muted">
                                            NIM tidak dapat diubah.
                                        </small>

                                    </div>


                                    <!-- EMAIL -->
                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        ">

                                        <label
                                            for="email"
                                            class="font-weight-bold">

                                            Email

                                            <span
                                                class="text-danger">
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
                                            required>

                                    </div>

<div class="mb-3">
    <label class="form-label">
        Jenis Kelamin
    </label>

    <input
        type="text"
        class="form-control"
        value="<?= ($profile['jenis_kelamin'] ?? '') === 'L'
            ? 'Laki-laki'
            : (($profile['jenis_kelamin'] ?? '') === 'P'
                ? 'Perempuan'
                : '-') ?>"
        readonly
    >

    <small class="text-muted">
        Jenis kelamin tidak dapat diubah melalui halaman ini.
    </small>
</div>

                                    <!-- NOMOR HP -->
                                    <div
                                        class="
                                            col-md-6
                                            mb-3
                                        ">

                                        <label
                                            for="no_hp"
                                            class="font-weight-bold">

                                            Nomor HP

                                            <span
                                                class="text-danger">
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
                                            required>

                                    </div>


                                    <!-- ALAMAT -->
                                    <div
                                        class="
                                            col-md-12
                                            mb-3
                                        ">

                                        <label
                                            for="alamat"
                                            class="font-weight-bold">

                                            Alamat

                                            <span
                                                class="text-danger">
                                                *
                                            </span>

                                        </label>

                                        <textarea
                                            name="alamat"
                                            id="alamat"
                                            rows="4"
                                            class="form-control"
                                            required><?= esc(
                                                            $profile['alamat']
                                                                ?? ''
                                                        ) ?></textarea>

                                    </div>

                                </div>


                                <hr class="my-4">


                                <!-- =================================================
     INFORMASI AKADEMIK
================================================== -->

                                <h4
                                    style="
        color:#0b3d91;
        font-weight:700;
    ">

                                    <i
                                        class="
            fas
            fa-graduation-cap
            mr-2
        "></i>

                                    Informasi Akademik

                                </h4>


                                <div
                                    class="
        row
        mt-4
    ">


                                    <!-- PROGRAM STUDI -->
                                    <div
                                        class="
            col-md-6
            mb-3
        ">

                                        <label
                                            class="font-weight-bold">
                                            Program Studi
                                        </label>

                                        <input
                                            type="text"
                                            class="
                form-control
                bg-light
            "
                                            value="<?= esc(
                                                        $profile['prodi']
                                                            ?? ''
                                                    ) ?>"
                                            readonly>

                                        <small
                                            class="text-muted">
                                            Data akademik tidak dapat
                                            diubah melalui halaman ini.
                                        </small>

                                    </div>


                                    <!-- JURUSAN -->
                                    <div
                                        class="
            col-md-6
            mb-3
        ">

                                        <label
                                            class="font-weight-bold">
                                            Jurusan
                                        </label>

                                        <input
                                            type="text"
                                            class="
                form-control
                bg-light
            "
                                            value="<?= esc(
                                                        $profile['jurusan']
                                                            ?? ''
                                                    ) ?>"
                                            readonly>

                                    </div>


                                    <!-- KELAS -->
                                    <div
                                        class="
            col-md-6
            mb-3
        ">

                                        <label
                                            class="font-weight-bold">
                                            Kelas
                                        </label>

                                        <input
                                            type="text"
                                            class="
                form-control
                bg-light
            "
                                            value="<?= esc(
                                                        $profile['nama_kelas']
                                                            ?? ''
                                                    ) ?>"
                                            readonly>

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
                                ">

                                <a
                                    href="<?= base_url(
                                                'mahasiswa/profile'
                                            ) ?>"
                                    class="
                                        btn
                                        btn-secondary
                                    ">

                                    <i
                                        class="
                                            fas
                                            fa-arrow-left
                                            mr-1
                                        "></i>

                                    Kembali

                                </a>


                                <button
                                    type="submit"
                                    class="
                                        btn
                                        btn-success
                                    ">

                                    <i
                                        class="
                                            fas
                                            fa-save
                                            mr-1
                                        "></i>

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