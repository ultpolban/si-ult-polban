<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<?php

// =====================================================
// DATA PROFILE
// =====================================================

$nama =
    $profile['nama']
    ?? '-';

$nik =
    $profile['nik']
    ?? '-';

$email =
    $profile['email']
    ?? '-';

$noHp =
    $profile['no_hp']
    ?? '-';

$alamat =
    $profile['alamat']
    ?? '-';

$hubungan =
    $profile['hubungan']
    ?? '-';

$foto =
    $profile['foto']
    ?? null;


// =====================================================
// DATA MAHASISWA
// =====================================================

$studentName =
    $profile['student_name']
    ?? '-';

$nim =
    $profile['nim']
    ?? '-';

$prodi =
    $profile['prodi']
    ?? '-';

$jurusan =
    $profile['jurusan']
    ?? '-';

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

                        <i class="fas fa-user mr-2"></i>

                        Profil Orang Tua

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
                 FLASH MESSAGE
            ================================================== -->

            <?php if (
                session()->getFlashdata('success')
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
                        session()->getFlashdata('success')
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


            <?php if (
                session()->getFlashdata('error')
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
                        session()->getFlashdata('error')
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
                 PROFILE CARD
            ================================================== -->

            <div
                class="card shadow-sm"
                style="
                    border-radius:15px;
                    overflow:hidden;
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
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <div
                        class="
                            d-flex
                            justify-content-between
                            align-items-center
                        "
                    >

                        <h4 class="mb-0">

                            <i
                                class="
                                    fas
                                    fa-id-card
                                    mr-2
                                "
                            ></i>

                            Informasi Profil Orang Tua

                        </h4>


                        <a
                            href="<?= base_url(
                                'orangtua/profile/edit'
                            ) ?>"
                            class="btn"
                            style="
                                background:#f28c28;
                                color:white;
                                font-weight:600;
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-edit
                                    mr-2
                                "
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


                        <!-- =============================================
                             PROFILE SUMMARY
                        ============================================== -->

                        <div
                            class="
                                col-lg-4
                                text-center
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
                                    class="
                                        img-circle
                                        elevation-3
                                    "
                                    style="
                                        width:180px;
                                        height:180px;
                                        object-fit:cover;
                                        border:6px solid #0b3d91;
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
                                    class="
                                        img-circle
                                        elevation-3
                                    "
                                    style="
                                        width:180px;
                                        height:180px;
                                        object-fit:cover;
                                        border:6px solid #0b3d91;
                                    "
                                >

                            <?php endif; ?>


                            <h2
                                class="mt-4"
                                style="
                                    font-weight:700;
                                    color:#0b3d91;
                                "
                            >

                                <?= esc($nama) ?>

                            </h2>


                            <h5 class="text-muted">

                                Orang Tua / Wali

                            </h5>


                            <span
                                class="
                                    badge
                                    badge-success
                                "
                                style="
                                    font-size:15px;
                                    padding:10px 18px;
                                "
                            >

                                Aktif

                            </span>

                        </div>


                        <!-- =============================================
                             DATA PRIBADI
                        ============================================== -->

                        <div class="col-lg-8">

                            <h2
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
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

                            </h2>


                            <hr>


                            <table
                                class="
                                    table
                                    table-borderless
                                "
                            >


                                <!-- NAMA -->

                                <tr>

                                    <th width="35%">

                                        <i
                                            class="
                                                fas
                                                fa-user
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Nama Lengkap

                                    </th>


                                    <td>

                                        <?= esc($nama) ?>

                                    </td>

                                </tr>


                                <!-- NIK -->

                                <tr>

                                    <th>

                                        <i
                                            class="
                                                fas
                                                fa-id-card
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        NIK

                                    </th>


                                    <td>

                                        <?= esc($nik) ?>

                                    </td>

                                </tr>


                                <!-- EMAIL -->

                                <tr>

                                    <th>

                                        <i
                                            class="
                                                fas
                                                fa-envelope
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Email

                                    </th>


                                    <td>

                                        <?= esc($email) ?>

                                    </td>

                                </tr>


                                <!-- HP -->

                                <tr>

                                    <th>

                                        <i
                                            class="
                                                fas
                                                fa-phone
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Nomor HP

                                    </th>


                                    <td>

                                        <?= esc($noHp) ?>

                                    </td>

                                </tr>


                                <!-- ALAMAT -->

                                <tr>

                                    <th>

                                        <i
                                            class="
                                                fas
                                                fa-map-marker-alt
                                                text-primary
                                                mr-2
                                            "
                                        ></i>

                                        Alamat

                                    </th>


                                    <td>

                                        <?= esc($alamat) ?>

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>


                    <hr>


                    <!-- =================================================
                         DATA MAHASISWA
                    ================================================== -->

                    <h2
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

                    </h2>


                    <div class="row mt-4">


                        <!-- =============================================
                             NAMA MAHASISWA
                        ============================================== -->

                        <div class="col-md-6">

                            <div
                                class="
                                    info-box
                                    shadow-sm
                                "
                            >

                                <span
                                    class="
                                        info-box-icon
                                    "
                                    style="
                                        background:#0b3d91;
                                        color:white;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-user-graduate
                                        "
                                    ></i>

                                </span>


                                <div
                                    class="
                                        info-box-content
                                    "
                                >

                                    <span
                                        class="
                                            info-box-text
                                        "
                                    >

                                        Nama Mahasiswa

                                    </span>


                                    <span
                                        class="
                                            info-box-number
                                        "
                                        style="
                                            font-size:17px;
                                        "
                                    >

                                        <?= esc(
                                            $studentName
                                        ) ?>

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- =============================================
                             NIM
                        ============================================== -->

                        <div class="col-md-6">

                            <div
                                class="
                                    info-box
                                    shadow-sm
                                "
                            >

                                <span
                                    class="
                                        info-box-icon
                                    "
                                    style="
                                        background:#f28c28;
                                        color:white;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-id-badge
                                        "
                                    ></i>

                                </span>


                                <div
                                    class="
                                        info-box-content
                                    "
                                >

                                    <span
                                        class="
                                            info-box-text
                                        "
                                    >

                                        NIM

                                    </span>


                                    <span
                                        class="
                                            info-box-number
                                        "
                                    >

                                        <?= esc($nim) ?>

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- =============================================
                             PROGRAM STUDI
                        ============================================== -->

                        <div class="col-md-6">

                            <div
                                class="
                                    info-box
                                    shadow-sm
                                "
                            >

                                <span
                                    class="
                                        info-box-icon
                                    "
                                    style="
                                        background:#0b3d91;
                                        color:white;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-university
                                        "
                                    ></i>

                                </span>


                                <div
                                    class="
                                        info-box-content
                                    "
                                >

                                    <span
                                        class="
                                            info-box-text
                                        "
                                    >

                                        Program Studi

                                    </span>


                                    <span
                                        class="
                                            info-box-number
                                        "
                                    >

                                        <?= esc($prodi) ?>

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- =============================================
                             JURUSAN
                        ============================================== -->

                        <div class="col-md-6">

                            <div
                                class="
                                    info-box
                                    shadow-sm
                                "
                            >

                                <span
                                    class="
                                        info-box-icon
                                    "
                                    style="
                                        background:#f28c28;
                                        color:white;
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-school
                                        "
                                    ></i>

                                </span>


                                <div
                                    class="
                                        info-box-content
                                    "
                                >

                                    <span
                                        class="
                                            info-box-text
                                        "
                                    >

                                        Jurusan

                                    </span>


                                    <span
                                        class="
                                            info-box-number
                                        "
                                    >

                                        <?= esc($jurusan) ?>

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <hr class="mt-4">


                    <!-- =================================================
                         BUTTON
                    ================================================== -->

                    <div class="text-right">


                        <a
                            href="<?= base_url(
                                'dashboard-orangtua'
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
                                    mr-2
                                "
                            ></i>

                            Kembali

                        </a>


                        <a
                            href="<?= base_url(
                                'orangtua/profile/edit'
                            ) ?>"
                            class="btn"
                            style="
                                background:#0b3d91;
                                color:white;
                                font-weight:600;
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-edit
                                    mr-2
                                "
                            ></i>

                            Edit Profil

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>