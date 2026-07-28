<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>


<div class="content-wrapper">

    <!-- HEADER -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-user-edit"></i>

                        Edit Profil Tendik

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('tendik/dashboard') ?>">

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('tendik/profile') ?>">

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

                <div class="col-lg-8">


                    <div class="card shadow-sm border-0">


                        <!-- HEADER -->

                        <div
                            class="card-header text-white"
                            style="
                                background:#0b3d91;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-user-edit mr-2"></i>

                                Ubah Data Profil

                            </h5>

                        </div>


                        <!-- BODY -->

                        <div class="card-body">


                            <?php if (
                                session()->getFlashdata('error')
                            ) : ?>

                                <div class="alert alert-danger">

                                    <i class="fas fa-exclamation-circle mr-2"></i>

                                    <?= esc(
                                        session()->getFlashdata('error')
                                    ) ?>

                                </div>

                            <?php endif; ?>


                            <form
                                action="<?= base_url(
                                    'tendik/profile/update'
                                ) ?>"
                                method="post"
                            >

                                <?= csrf_field() ?>


                                <!-- NAMA -->

                                <div class="form-group mb-3">

                                    <label>

                                        <strong>

                                            Nama Lengkap

                                        </strong>

                                    </label>

                                    <input
                                        type="text"
                                        name="nama"
                                        class="form-control"
                                        value="<?= esc(
                                            $user['nama']
                                            ??
                                            ''
                                        ) ?>"
                                        required
                                    >

                                </div>


                                <!-- NIP -->

                                <div class="form-group mb-3">

                                    <label>

                                        <strong>

                                            NIP

                                        </strong>

                                    </label>

                                    <input
                                        type="text"
                                        name="nip"
                                        class="form-control"
                                        value="<?= esc(
                                            $user['nip']
                                            ??
                                            ''
                                        ) ?>"
                                        required
                                    >

                                </div>


                                <!-- EMAIL -->

                                <div class="form-group mb-3">

                                    <label>

                                        <strong>

                                            Email

                                        </strong>

                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="<?= esc(
                                            $user['email']
                                            ??
                                            ''
                                        ) ?>"
                                        required
                                    >

                                </div>


                                <!-- UNIT KERJA -->

                                <div class="form-group mb-3">

                                    <label>

                                        <strong>

                                            Unit Kerja

                                        </strong>

                                    </label>

                                    <input
                                        type="text"
                                        name="unit_kerja"
                                        class="form-control"
                                        value="<?= esc(
                                            $user['unit_kerja']
                                            ??
                                            $user['unit_tujuan']
                                            ??
                                            ''
                                        ) ?>"
                                    >

                                </div>


                                <!-- JABATAN -->

                                <div class="form-group mb-3">

                                    <label>

                                        <strong>

                                            Jabatan

                                        </strong>

                                    </label>

                                    <input
                                        type="text"
                                        name="jabatan"
                                        class="form-control"
                                        value="<?= esc(
                                            $user['jabatan']
                                            ??
                                            'Tenaga Kependidikan'
                                        ) ?>"
                                    >

                                </div>


                                <!-- NOMOR HP -->

                                <div class="form-group mb-4">

                                    <label>

                                        <strong>

                                            Nomor HP

                                        </strong>

                                    </label>

                                    <input
                                        type="text"
                                        name="no_hp"
                                        class="form-control"
                                        value="<?= esc(
                                            $user['no_hp']
                                            ??
                                            $user['telepon']
                                            ??
                                            ''
                                        ) ?>"
                                    >

                                </div>



                                <!-- BUTTON -->

                                <div
                                    class="
                                        d-flex
                                        justify-content-between
                                    "
                                >


                                    <a
                                        href="<?= base_url(
                                            'tendik/profile'
                                        ) ?>"
                                        class="btn btn-secondary"
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-arrow-left
                                                mr-1
                                            "
                                        ></i>

                                        Batal

                                    </a>


                                    <button
                                        type="submit"
                                        class="btn text-white"
                                        style="
                                            background:#f28c28;
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


                            </form>


                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>