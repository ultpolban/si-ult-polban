<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_mahasiswa'); ?>

<?php
    // Data profile
    $profile = $profile ?? [];

    $nama =
        $profile['nama']
        ?? 'Mahasiswa';

    $nim =
        $profile['nim']
        ?? '-';

$nik =
    $profile['nik']
    ?? '-';

$jenisKelamin =
    $profile['jenis_kelamin']
    ?? '-';

$email =

    $email =
        $profile['email']
        ?? '-';

    $noHp =
        $profile['no_hp']
        ?? '-';

    $alamat =
        $profile['alamat']
        ?? '-';

    $prodi =
        $profile['prodi']
        ?? '-';

    $jurusan =
        $profile['jurusan']
        ?? '-';

    $fakultas =
        $profile['fakultas']
        ?? '-';

    $semester =
        $profile['semester']
        ?? '-';

    $angkatan =
        $profile['angkatan']
        ?? '-';

    $status =
        $profile['status']
        ?? 'Aktif';

    $foto =
        $profile['foto']
        ?? null;
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

                        <i class="fas fa-user mr-2"></i>

                        Profil Mahasiswa

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url(
                                    'dashboard-mahasiswa'
                                ) ?>"
                            >

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Profil

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


            <!-- =================================================
                 ALERT SUCCESS
            ================================================== -->

            <?php if (
                session()->getFlashdata(
                    'success'
                )
            ): ?>

                <div
                    class="alert alert-success alert-dismissible fade show"
                >

                    <i
                        class="fas fa-check-circle mr-2"
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

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 ALERT ERROR
            ================================================== -->

            <?php if (
                session()->getFlashdata(
                    'error'
                )
            ): ?>

                <div
                    class="alert alert-danger alert-dismissible fade show"
                >

                    <i
                        class="fas fa-exclamation-circle mr-2"
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
                 PROFILE CARD
            ================================================== -->

            <div
                class="card shadow-sm"
                style="
                    border-radius:15px;
                    border-top:5px solid #0b3d91;
                "
            >


                <!-- =================================================
                     CARD HEADER
                ================================================== -->

                <div
                    class="card-header"
                    style="
                        background:#0b3d91;
                        color:white;
                    "
                >

                    <div
                        class="d-flex
                               justify-content-between
                               align-items-center"
                    >

                        <h3
                            class="card-title"
                        >

                            <i
                                class="fas fa-id-card mr-2"
                            ></i>

                            Informasi Profil Mahasiswa

                        </h3>


                        <a
                            href="<?= base_url(
                                'mahasiswa/profile/edit'
                            ) ?>"
                            class="btn"
                            style="
                                background:#f28c28;
                                color:white;
                                font-weight:600;
                            "
                        >

                            <i
                                class="fas fa-edit mr-1"
                            ></i>

                            Edit Profil

                        </a>

                    </div>

                </div>


                <!-- =================================================
                     CARD BODY
                ================================================== -->

                <div class="card-body">


                    <!-- =================================================
                         DATA PRIBADI
                    ================================================== -->

                    <div class="row">


                        <!-- =================================================
                             FOTO PROFILE
                        ================================================== -->

                        <div
                            class="
                                col-lg-4
                                col-md-5
                                text-center
                                mb-4
                                mb-md-0
                            "
                        >

                            <div
                                style="
                                    padding:20px;
                                "
                            >


                                <!-- FOTO JIKA ADA -->

                                <?php if (
                                    !empty(
                                        $foto
                                    )
                                ): ?>

                                    <img
                                        src="<?= base_url(
                                            'uploads/profile/' .
                                            $foto
                                        ) ?>"
                                        alt="Foto Profil"
                                        style="
                                            width:170px;
                                            height:170px;
                                            object-fit:cover;
                                            border-radius:50%;
                                            border:6px solid #0b3d91;
                                            box-shadow:
                                                0 5px 15px
                                                rgba(
                                                    0,
                                                    0,
                                                    0,
                                                    .15
                                                );
                                        "
                                    >

                                <?php else: ?>


                                    <!-- ICON DEFAULT -->

                                    <div
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
                                            font-size:80px;
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-user-graduate
                                            "
                                        ></i>

                                    </div>

                                <?php endif; ?>


                                <!-- NAMA -->

                                <h3
                                    class="mt-3 mb-2"
                                    style="
                                        color:#0b3d91;
                                        font-weight:700;
                                    "
                                >

                                    <?= esc(
                                        $nama
                                    ) ?>

                                </h3>


                                <!-- NIM -->

                                <p
                                    class="text-muted mb-3"
                                >

                                    <i
                                        class="
                                            fas
                                            fa-id-card
                                            mr-1
                                        "
                                    ></i>

                                    <?= esc(
                                        $nim
                                    ) ?>

                                </p>


                                <!-- STATUS -->

                                <span
                                    class="badge"
                                    style="
                                        background:#28a745;
                                        color:white;
                                        padding:8px 18px;
                                        font-size:14px;
                                        border-radius:20px;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-circle
                                            mr-1
                                        "
                                        style="
                                            font-size:8px;
                                        "
                                    ></i>

                                    <?= esc(
                                        $status
                                    ) ?>

                                </span>

                            </div>

                        </div>


                        <!-- =================================================
                             INFORMASI PRIBADI
                        ================================================== -->

                        <div
                            class="
                                col-lg-8
                                col-md-7
                            "
                        >

                            <h3
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                    margin-bottom:25px;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-info-circle
                                        mr-2
                                    "
                                ></i>

                                Data Pribadi

                            </h3>


                            <!-- NAMA -->

                            <div class="row mb-3">

                                <div
                                    class="
                                        col-sm-4
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

                                </div>

                                <div class="col-sm-8">

                                    <?= esc(
                                        $nama
                                    ) ?>

                                </div>

                            </div>

                            <!-- NIM -->

                            <div class="row mb-3">

                                <div
                                    class="
                                        col-sm-4
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

                                    NIM

                                </div>

                                <div class="col-sm-8">

                                    <?= esc(
                                        $nim
                                    ) ?>

                                </div>

                            </div>

                            <!-- JENIS KELAMIN -->

<div class="row mb-3">

    <div
        class="
            col-sm-4
            font-weight-bold
        "
    >

        <i
            class="
                fas
                fa-venus-mars
                text-primary
                mr-2
            "
        ></i>

        Jenis Kelamin

    </div>

    <div class="col-sm-8">

        <?= esc(
            $jenisKelamin
        ) ?>

    </div>

</div>


                            <!-- EMAIL -->

                            <div class="row mb-3">

                                <div
                                    class="
                                        col-sm-4
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

                                </div>

                                <div class="col-sm-8">

                                    <?= esc(
                                        $email
                                    ) ?>

                                </div>

                            </div>


                            <!-- NOMOR HP -->

                            <div class="row mb-3">

                                <div
                                    class="
                                        col-sm-4
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

                                </div>

                                <div class="col-sm-8">

                                    <?= esc(
                                        $noHp
                                    ) ?>

                                </div>

                            </div>

                            <!-- ALAMAT -->

                            <div class="row mb-3">

                                <div
                                    class="
                                        col-sm-4
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

                                </div>

                                <div class="col-sm-8">

                                    <?= esc(
                                        $alamat
                                    ) ?>

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="my-4">


                    <!-- =================================================
                         INFORMASI AKADEMIK
                    ================================================== -->

                    <h3
                        style="
                            color:#0b3d91;
                            font-weight:700;
                            margin-bottom:25px;
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

                    </h3>


                    <div class="row">


                        <!-- PROGRAM STUDI -->

                        <div
                            class="
                                col-lg-6
                                col-md-6
                                mb-3
                            "
                        >

                            <div
                                style="
                                    background:#f5f8fc;
                                    padding:20px;
                                    border-left:
                                        4px solid #0b3d91;
                                    border-radius:8px;
                                    height:100%;
                                "
                            >

                                <small
                                    class="text-muted"
                                >

                                    Program Studi

                                </small>

                                <h5
                                    class="mb-0 mt-1"
                                >

                                    <?= esc(
                                        $prodi
                                    ) ?>

                                </h5>

                            </div>

                        </div>

                        <!-- JURUSAN -->

                        <div
                            class="
                                col-lg-6
                                col-md-6
                                mb-3
                            "
                        >

                            <div
                                style="
                                    background:#f5f8fc;
                                    padding:20px;
                                    border-left:
                                        4px solid #0b3d91;
                                    border-radius:8px;
                                    height:100%;
                                "
                            >

                                <small
                                    class="text-muted"
                                >

                                    Jurusan

                                </small>

                                <h5
                                    class="mb-0 mt-1"
                                >

                                    <?= esc(
                                        $jurusan
                                    ) ?>

                                </h5>

                            </div>

                        </div>


                        <!-- SEMESTER -->

                        <div
                            class="
                                col-lg-3
                                col-md-6
                                mb-3
                            "
                        >
                         <div
                                style="
                                    background:#f5f8fc;
                                    padding:20px;
                                    border-left:
                                        4px solid #f28c28;
                                    border-radius:8px;
                                    height:100%;
                                "
                            >
                                <small
                                    class="text-muted"
                                >

                                    Semester

                                </small>

                                <h5
                                    class="mb-0 mt-1"
                                >

                                    <?= esc(
                                        $semester
                                    ) ?>

                                </h5>

                            </div>

                        </div>
                        <!-- ANGKATAN -->
                        <div
                            class="
                                col-lg-3
                                col-md-6
                                mb-3
                            "
                        >
                            <div
                                style="
                                    background:#f5f8fc;
                                    padding:20px;
                                    border-left:
                                        4px solid #f28c28;
                                    border-radius:8px;
                                    height:100%;
                                "
                            >

                                <small
                                    class="text-muted"
                                >

                                    Angkatan

                                </small>

                                <h5
                                    class="mb-0 mt-1"
                                >

                                    <?= esc(
                                        $angkatan
                                    ) ?>

                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->include('layouts/footer'); ?>