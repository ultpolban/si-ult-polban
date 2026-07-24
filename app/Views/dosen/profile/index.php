<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>


<style>
    .profile-page {
        background: #f4f7fb;
        min-height: calc(100vh - 57px);
        padding-bottom: 40px;
    }

    .profile-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,.08);
    }

    .profile-header {
        background: #0b3d91;
        height: 150px;
        position: relative;
    }

    .profile-photo-wrapper {
        position: absolute;
        left: 50%;
        bottom: -65px;
        transform: translateX(-50%);
    }

    .profile-photo {
        width: 135px;
        height: 135px;
        border-radius: 50%;
        object-fit: cover;
        background: #eef3f8;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,.2);
    }

    .profile-placeholder {
        width: 135px;
        height: 135px;
        border-radius: 50%;
        background: #eef3f8;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0,0,0,.2);

        display: flex;
        align-items: center;
        justify-content: center;

        color: #0b3d91;
        font-size: 60px;
    }

    .profile-body {
        padding: 90px 35px 35px;
    }

    .profile-name {
        text-align: center;
        color: #0b3d91;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-role {
        text-align: center;
        color: #64748b;
        margin-bottom: 35px;
    }

    .section-title {
        color: #0b3d91;
        font-size: 20px;
        font-weight: 700;
        border-bottom: 2px solid #f28c28;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .profile-info {
        margin-bottom: 20px;
    }

    .profile-info label {
        display: block;
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .profile-info .value {
        color: #17365d;
        font-size: 16px;
        font-weight: 600;
        background: #f8fafc;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        min-height: 45px;
    }

    .btn-edit-profile {
        background: #f28c28;
        color: white;
        border: none;
        padding: 11px 25px;
        border-radius: 8px;
        font-weight: 700;
    }

    .btn-edit-profile:hover {
        background: #d97617;
        color: white;
    }
</style>


<div class="content-wrapper profile-page">

    <!-- HEADER -->

    <section class="content-header">

        <div class="container-fluid">

            <h1 style="color:#0b3d91;font-weight:700;">

                <i class="fas fa-user-circle"></i>

                Profil Dosen

            </h1>

            <p class="text-muted">

                Informasi profil dan identitas dosen.

            </p>

        </div>

    </section>


    <!-- CONTENT -->

    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-9">

                    <div class="card profile-card">


                        <!-- BLUE HEADER -->

                        <div class="profile-header">

                            <div class="profile-photo-wrapper">

                                <?php if (!empty($user['foto'])): ?>

                                    <img
                                        src="<?= base_url('uploads/profile/' . $user['foto']) ?>"
                                        class="profile-photo"
                                        alt="Foto Profil"
                                    >

                                <?php else: ?>

                                    <div class="profile-placeholder">

                                        <i class="fas fa-user"></i>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>


                        <!-- BODY -->

                        <div class="profile-body">


                            <!-- NAMA -->

                            <div class="profile-name">

                                <?= esc($user['nama'] ?? 'Nama Dosen') ?>

                            </div>


                            <div class="profile-role">

                                <i class="fas fa-chalkboard-teacher"></i>

                                Dosen POLBAN

                            </div>


                            <!-- BUTTON -->

                            <div class="text-center mb-4">

                                <a
                                    href="<?= base_url('dosen/profile/edit') ?>"
                                    class="btn btn-edit-profile"
                                >

                                    <i class="fas fa-edit me-2"></i>

                                    Edit Profil

                                </a>

                            </div>


                            <!-- DATA PRIBADI -->

                            <div class="section-title">

                                <i class="fas fa-user me-2"></i>

                                Data Pribadi

                            </div>


                            <div class="row">


                                <!-- NIP -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            NIP / NIDN

                                        </label>

                                        <div class="value">

                                            <?= esc($user['nip'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- NIK -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            NIK

                                        </label>

                                        <div class="value">

                                            <?= esc($user['nik'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- TEMPAT LAHIR -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Tempat Lahir

                                        </label>

                                        <div class="value">

                                            <?= esc($user['tempat_lahir'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- TANGGAL LAHIR -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Tanggal Lahir

                                        </label>

                                        <div class="value">

                                            <?= esc($user['tanggal_lahir'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- JENIS KELAMIN -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Jenis Kelamin

                                        </label>

                                        <div class="value">

                                            <?= esc($user['jenis_kelamin'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- AKADEMIK -->

                            <div class="section-title mt-4">

                                <i class="fas fa-building-columns me-2"></i>

                                Informasi Akademik

                            </div>


                            <div class="row">


                                <!-- FAKULTAS -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Fakultas

                                        </label>

                                        <div class="value">

                                            <?= esc($user['fakultas'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- PRODI -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Program Studi

                                        </label>

                                        <div class="value">

                                            <?= esc($user['prodi'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- JABATAN -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Jabatan

                                        </label>

                                        <div class="value">

                                            <?= esc($user['jabatan'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- PANGKAT -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Pangkat / Golongan

                                        </label>

                                        <div class="value">

                                            <?= esc($user['pangkat'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- KONTAK -->

                            <div class="section-title mt-4">

                                <i class="fas fa-address-book me-2"></i>

                                Informasi Kontak

                            </div>


                            <div class="row">


                                <!-- TELEPON -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Nomor Telepon

                                        </label>

                                        <div class="value">

                                            <?= esc($user['telepon'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- EMAIL -->

                                <div class="col-md-6">

                                    <div class="profile-info">

                                        <label>

                                            Email

                                        </label>

                                        <div class="value">

                                            <?= esc($user['email'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>


                                <!-- ALAMAT -->

                                <div class="col-12">

                                    <div class="profile-info">

                                        <label>

                                            Alamat

                                        </label>

                                        <div class="value">

                                            <?= esc($user['alamat'] ?? '-') ?>

                                        </div>

                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>