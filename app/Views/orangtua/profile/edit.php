<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 style="
                        font-weight:700;
                        color:#0b3d91;
                    ">
                        <i class="fas fa-user-edit mr-2"></i>
                        Edit Profil
                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dashboard-orangtua') ?>">
                                Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('orangtua/profile') ?>">
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


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-9">

                    <div class="card shadow-sm"
                        style="
                            border-radius:15px;
                            overflow:hidden;
                        ">

                        <!-- HEADER CARD -->
                        <div class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-bottom:4px solid #f28c28;
                                padding:18px 22px;
                            ">

                            <h5 class="mb-0">

                                <i class="fas fa-user-edit mr-2"></i>

                                Edit Informasi Profil

                            </h5>

                        </div>


                        <!-- BODY -->
                        <div class="card-body p-4">

                            <?php if (session()->getFlashdata('success')) : ?>

                                <div class="alert alert-success">

                                    <i class="fas fa-check-circle mr-2"></i>

                                    <?= session()->getFlashdata('success') ?>

                                </div>

                            <?php endif; ?>


                            <form
                                action="<?= base_url('orangtua/profile/update') ?>"
                                method="post">

                                <?= csrf_field() ?>


                                <!-- NAMA -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        <i class="fas fa-user text-primary mr-2"></i>

                                        Nama Lengkap

                                    </label>

                                    <input
                                        type="text"
                                        name="nama"
                                        class="form-control"
                                        value="<?= esc($user['nama'] ?? 'Budi Santoso') ?>"
                                        required>

                                </div>


                                <!-- NIK -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        <i class="fas fa-id-card text-primary mr-2"></i>

                                        NIK

                                    </label>

                                    <input
                                        type="text"
                                        name="nik"
                                        class="form-control"
                                        value="<?= esc($user['nik'] ?? '3273010101040001') ?>"
                                        required>

                                </div>


                                <!-- EMAIL -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        <i class="fas fa-envelope text-primary mr-2"></i>

                                        Email

                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="<?= esc($user['email'] ?? 'budisantoso@gmail.com') ?>"
                                        required>

                                </div>


                                <!-- NOMOR HP -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        <i class="fas fa-phone text-primary mr-2"></i>

                                        Nomor HP

                                    </label>

                                    <input
                                        type="text"
                                        name="telepon"
                                        class="form-control"
                                        value="<?= esc($user['telepon'] ?? '081234567890') ?>"
                                        required>

                                </div>


                                <!-- ALAMAT -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        <i class="fas fa-map-marker-alt text-primary mr-2"></i>

                                        Alamat

                                    </label>

                                    <textarea
                                        name="alamat"
                                        class="form-control"
                                        rows="4"
                                        required><?= esc($user['alamat'] ?? 'Jl. Babakan Radio') ?></textarea>

                                </div>


                                <hr>


                                <!-- BUTTON -->
                                <div class="d-flex justify-content-between">

                                    <a
                                        href="<?= base_url('orangtua/profile') ?>"
                                        class="btn btn-secondary">

                                        <i class="fas fa-arrow-left mr-2"></i>

                                        Kembali

                                    </a>


                                    <button
                                        type="submit"
                                        class="btn"
                                        style="
                                            background:#0b3d91;
                                            color:white;
                                            font-weight:600;
                                            border-radius:8px;
                                            padding:10px 25px;
                                        ">

                                        <i class="fas fa-save mr-2"></i>

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