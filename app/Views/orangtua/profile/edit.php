<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<?php

// =====================================================
// DATA PROFILE
// =====================================================

$nama =
    $profile['nama']
    ?? '';

$nik =
    $profile['nik']
    ?? '';

$email =
    $profile['email']
    ?? '';

$noHp =
    $profile['no_hp']
    ?? '';

$alamat =
    $profile['alamat']
    ?? '';

$hubungan =
    $profile['hubungan']
    ?? '';

$foto =
    $profile['foto']
    ?? null;


// =====================================================
// DATA MAHASISWA
// =====================================================

$studentName =
    $profile['student_name']
    ?? '';

$nim =
    $profile['nim']
    ?? '';

$prodi =
    $profile['prodi']
    ?? '';

$jurusan =
    $profile['jurusan']
    ?? '';

?>


<div class="content-wrapper">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            font-weight:700;
                            color:#0b3d91;
                        "
                    >

                        <i class="fas fa-user-edit mr-2"></i>

                        Edit Profil

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url(
                                    'dashboard-orangtua'
                                ) ?>"
                            >

                                Dashboard

                            </a>

                        </li>


                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url(
                                    'orangtua/profile'
                                ) ?>"
                            >

                                Profil

                            </a>

                        </li>


                        <li class="breadcrumb-item active">

                            Edit Profil

                        </li>

                    </ol>

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

                <div class="col-lg-9">


                    <!-- =================================================
                         CARD
                    ================================================== -->

                    <div
                        class="card shadow-sm"
                        style="
                            border-radius:15px;
                            overflow:hidden;
                        "
                    >


                        <!-- CARD HEADER -->

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-bottom:4px solid #f28c28;
                                padding:18px 22px;
                            "
                        >

                            <h5 class="mb-0">

                                <i
                                    class="
                                        fas
                                        fa-user-edit
                                        mr-2
                                    "
                                ></i>

                                Edit Informasi Profil

                            </h5>

                        </div>


                        <!-- CARD BODY -->

                        <div class="card-body p-4">


                            <!-- =================================================
                                 FLASH SUCCESS
                            ================================================== -->

                            <?php if (
                                session()->getFlashdata(
                                    'success'
                                )
                            ) : ?>

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
                                        session()->getFlashdata(
                                            'success'
                                        )
                                    ) ?>


                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="alert"
                                    >

                                        <span>&times;</span>

                                    </button>

                                </div>

                            <?php endif; ?>


                            <!-- =================================================
                                 FLASH ERROR
                            ================================================== -->

                            <?php if (
                                session()->getFlashdata(
                                    'error'
                                )
                            ) : ?>

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

                                        <span>&times;</span>

                                    </button>

                                </div>

                            <?php endif; ?>


                            <!-- =================================================
                                 VALIDATION ERROR
                            ================================================== -->

                            <?php if (
                                session()->getFlashdata(
                                    'errors'
                                )
                            ) : ?>

                                <div
                                    class="
                                        alert
                                        alert-danger
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-exclamation-triangle
                                            mr-2
                                        "
                                    ></i>

                                    <?= esc(
                                        session()->getFlashdata(
                                            'errors'
                                        )
                                    ) ?>

                                </div>

                            <?php endif; ?>


                            <!-- =================================================
                                 FORM
                            ================================================== -->

                            <form
                                action="<?= base_url(
                                    'orangtua/profile/update'
                                ) ?>"
                                method="post"
                                enctype="multipart/form-data"
                            >

                                <?= csrf_field() ?>


                                <!-- =========================================
                                     FOTO PROFILE
                                ========================================== -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-camera
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Foto Profil

                                    </label>


                                    <div
                                        class="
                                            d-flex
                                            align-items-center
                                            flex-wrap
                                        "
                                    >

                                        <?php if (
                                            !empty($foto)
                                        ) : ?>

                                            <img
                                                src="<?= base_url(
                                                    'uploads/profile/' .
                                                    $foto
                                                ) ?>"
                                                alt="Foto Profil"
                                                class="
                                                    img-circle
                                                    elevation-2
                                                    mr-3
                                                    mb-2
                                                "
                                                style="
                                                    width:90px;
                                                    height:90px;
                                                    object-fit:cover;
                                                "
                                                onerror="
                                                    this.onerror=null;
                                                    this.src='<?= base_url(
                                                        'assets/img/default-user.png'
                                                    ) ?>';
                                                "
                                            >

                                        <?php else : ?>

                                            <img
                                                src="<?= base_url(
                                                    'assets/img/default-user.png'
                                                ) ?>"
                                                alt="Foto Profil"
                                                class="
                                                    img-circle
                                                    elevation-2
                                                    mr-3
                                                    mb-2
                                                "
                                                style="
                                                    width:90px;
                                                    height:90px;
                                                    object-fit:cover;
                                                "
                                            >

                                        <?php endif; ?>


                                        <div>

                                            <input
                                                type="file"
                                                name="foto"
                                                class="form-control-file"
                                                accept="
                                                    .jpg,
                                                    .jpeg,
                                                    .png,
                                                    .webp
                                                "
                                            >

                                            <small
                                                class="
                                                    form-text
                                                    text-muted
                                                "
                                            >

                                                Format:
                                                JPG, JPEG, PNG, WEBP.

                                                <br>

                                                Ukuran maksimal:
                                                2 MB.

                                            </small>

                                        </div>

                                    </div>

                                </div>


                                <hr>


                                <!-- =========================================
                                     DATA PRIBADI
                                ========================================== -->

                                <h5
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

                                </h5>


                                <p class="text-muted small">

                                    Data di bawah merupakan data
                                    profil Orangtua/Wali yang terdaftar.

                                </p>


                                <!-- NAMA -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-user
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Nama Lengkap

                                    </label>


                                    <input
                                        type="text"
                                        name="nama"
                                        class="form-control"
                                        value="<?= esc($nama) ?>"
                                        required
                                    >

                                </div>


                                <!-- NIK -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-id-card
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        NIK

                                    </label>


                                    <input
                                        type="text"
                                        name="nik"
                                        class="form-control"
                                        value="<?= esc($nik) ?>"
                                        readonly
                                    >


                                    <small
                                        class="
                                            form-text
                                            text-muted
                                        "
                                    >

                                        NIK merupakan identitas
                                        yang digunakan saat pendaftaran
                                        Orangtua/Wali dan tidak dapat
                                        diubah dari halaman ini.

                                    </small>

                                </div>


                                <!-- EMAIL -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-envelope
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Email

                                    </label>


                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="<?= esc($email) ?>"
                                        required
                                    >

                                </div>


                                <!-- NOMOR HP -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-phone
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Nomor HP

                                    </label>


                                    <input
                                        type="text"
                                        name="no_hp"
                                        class="form-control"
                                        value="<?= esc($noHp) ?>"
                                        required
                                    >

                                </div>


                                <!-- ALAMAT -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-map-marker-alt
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Alamat

                                    </label>


                                    <textarea
                                        name="alamat"
                                        class="form-control"
                                        rows="4"
                                        required
                                    ><?= esc($alamat) ?></textarea>

                                </div>


                                <hr class="my-4">


                                <!-- =========================================
                                     DATA MAHASISWA
                                ========================================== -->

                                <h5
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-user-graduate
                                            mr-2
                                        "
                                    ></i>

                                    Data Mahasiswa

                                </h5>


                                <p class="text-muted small">

                                    Data mahasiswa merupakan data
                                    mahasiswa yang diwakili oleh akun
                                    Orangtua/Wali.

                                </p>


                                <!-- NAMA MAHASISWA -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        Nama Mahasiswa

                                    </label>


                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc(
                                            $studentName
                                        ) ?>"
                                        readonly
                                    >

                                </div>


                                <!-- NIM -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        NIM Mahasiswa

                                    </label>


                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc($nim) ?>"
                                        readonly
                                    >

                                </div>


                                <!-- PRODI -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        Program Studi

                                    </label>


                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc($prodi) ?>"
                                        readonly
                                    >

                                </div>


                                <!-- JURUSAN -->

                                <div class="form-group">

                                    <label
                                        class="
                                            font-weight-bold
                                        "
                                    >

                                        Jurusan

                                    </label>


                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc($jurusan) ?>"
                                        readonly
                                    >

                                </div>


                                <hr class="my-4">


                                <!-- =========================================
                                     BUTTON
                                ========================================== -->

                                <div
                                    class="
                                        d-flex
                                        justify-content-between
                                        flex-wrap
                                    "
                                >

                                    <a
                                        href="<?= base_url(
                                            'orangtua/profile'
                                        ) ?>"
                                        class="
                                            btn
                                            btn-secondary
                                            mb-2
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-arrow-left
                                                mr-2
                                            "
                                        ></i>

                                        Kembali

                                    </a>


                                    <button
                                        type="submit"
                                        class="
                                            btn
                                            mb-2
                                        "
                                        style="
                                            background:#0b3d91;
                                            color:white;
                                            font-weight:600;
                                            border-radius:8px;
                                            padding:10px 25px;
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-save
                                                mr-2
                                            "
                                        ></i>

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


<?= $this->include('layouts/footer') ?>