<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_dosen') ?>


<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 style="font-weight:700;color:#0b3d91;">

                        <i class="fas fa-user-edit"></i>

                        Edit Profil Dosen

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dosen/dashboard') ?>">

                                Dashboard

                            </a>

                        </li>


                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dosen/profile') ?>">

                                Profil

                            </a>

                        </li>


                        <li class="breadcrumb-item active">

                            Edit

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">


            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger">

                    <i class="fas fa-exclamation-circle"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

                </div>

            <?php endif; ?>


            <div class="card shadow-sm">


                <div class="card-header bg-primary">

                    <h3 class="card-title">

                        <i class="fas fa-user-cog"></i>

                        Edit Profil

                    </h3>

                </div>


                <form
                    action="<?= base_url('dosen/profile/update') ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>


                    <div class="card-body">

                        <div class="row">


                            <!-- =========================================
                     FOTO
                ========================================== -->

                            <div class="col-md-4">

                                <div class="text-center">

                                    <?php if (! empty($profile['foto'])) : ?>

                                        <img
                                            src="<?= base_url('uploads/profile/' . $profile['foto']) ?>"
                                            class="img-circle elevation-2 mb-3"
                                            style="
                                    width:180px;
                                    height:180px;
                                    object-fit:cover;
                                ">

                                    <?php else : ?>

                                        <img
                                            src="<?= base_url('assets/img/default-user.png') ?>"
                                            class="img-circle elevation-2 mb-3"
                                            style="
                                    width:180px;
                                    height:180px;
                                    object-fit:cover;
                                ">

                                    <?php endif; ?>


                                    <div class="form-group text-left">

                                        <label>

                                            Foto Profil

                                        </label>


                                        <input
                                            type="file"
                                            name="foto"
                                            class="form-control"
                                            accept=".jpg,.jpeg,.png,.webp">


                                        <small class="text-muted">

                                            JPG / PNG / WEBP
                                            (Maks. 2MB)

                                        </small>

                                    </div>

                                </div>

                            </div>


                            <!-- =========================================
                     DATA DOSEN
                ========================================== -->

                            <div class="col-md-8">

                                <div class="row">


                                    <!-- NAMA -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Nama Lengkap
                                                <span class="text-danger">*</span>

                                            </label>


                                            <input
                                                type="text"
                                                name="nama"
                                                class="form-control"
                                                value="<?= old('nama', $profile['nama']) ?>"
                                                required>

                                        </div>

                                    </div>


                                    <!-- NIP -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                NIP
                                            </label>

                                            <input
                                                type="text"
                                                name="nip"
                                                class="form-control"
                                                value="<?= old('nip', $profile['nip'] ?? '') ?>"
                                                readonly>

                                            <small class="text-muted">
                                                NIP berasal dari data akun pengguna.
                                            </small>

                                        </div>

                                    </div>


                                    <!-- NIDN -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>
                                                NIDN
                                            </label>

                                            <input
                                                type="text"
                                                name="nidn"
                                                class="form-control"
                                                value="<?= old('nidn', $profile['nidn'] ?? '') ?>"
                                                maxlength="30"
                                                placeholder="Nomor Induk Dosen Nasional">

                                            <small class="text-muted">
                                                Nomor Induk Dosen Nasional
                                            </small>

                                        </div>

                                    </div>

                                    <!-- NIK -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                NIK

                                            </label>


                                            <input
                                                type="text"
                                                name="nik"
                                                class="form-control"
                                                value="<?= old('nik', $profile['nik']) ?>"
                                                maxlength="30">

                                        </div>

                                    </div>


                                    <!-- EMAIL -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Email
                                                <span class="text-danger">*</span>

                                            </label>


                                            <input
                                                type="email"
                                                name="email"
                                                class="form-control"
                                                value="<?= old('email', $profile['email']) ?>"
                                                required>

                                        </div>

                                    </div>


                                    <!-- HP -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Nomor HP

                                            </label>


                                            <input
                                                type="text"
                                                name="no_hp"
                                                class="form-control"
                                                value="<?= old('no_hp', $profile['no_hp']) ?>"
                                                maxlength="20"
                                                placeholder="Nomor HP / WhatsApp">

                                        </div>

                                    </div>


                                    <!-- JENIS KELAMIN -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Jenis Kelamin

                                            </label>


                                            <select
                                                name="jenis_kelamin"
                                                class="form-control">

                                                <option value="">

                                                    -- Pilih --

                                                </option>


                                                <option
                                                    value="L"
                                                    <?= old(
                                                        'jenis_kelamin',
                                                        $profile['jenis_kelamin']
                                                    ) === 'L'
                                                        ? 'selected'
                                                        : '' ?>>

                                                    Laki-laki

                                                </option>


                                                <option
                                                    value="P"
                                                    <?= old(
                                                        'jenis_kelamin',
                                                        $profile['jenis_kelamin']
                                                    ) === 'P'
                                                        ? 'selected'
                                                        : '' ?>>

                                                    Perempuan

                                                </option>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- PROGRAM STUDI -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Program Studi

                                            </label>


                                            <select
                                                name="study_program_id"
                                                class="form-control">

                                                <option value="">

                                                    -- Pilih Program Studi --

                                                </option>


                                                <?php foreach ($studyPrograms as $sp) : ?>

                                                    <?php

                                                    $selectedProgram =
                                                        old(
                                                            'study_program_id',
                                                            $profile['study_program_id']
                                                        );

                                                    ?>

                                                    <option
                                                        value="<?= esc($sp['id']) ?>"
                                                        <?= (string) $selectedProgram
                                                            === (string) $sp['id']
                                                            ? 'selected'
                                                            : '' ?>>

                                                        <?= esc($sp['name']) ?>

                                                        <?php if (! empty($sp['department_name'])) : ?>

                                                            —
                                                            <?= esc($sp['department_name']) ?>

                                                        <?php endif; ?>

                                                    </option>

                                                <?php endforeach; ?>

                                            </select>

                                        </div>

                                    </div>


                                    <!-- ALAMAT -->

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label>

                                                Alamat

                                            </label>


                                            <textarea
                                                name="alamat"
                                                rows="3"
                                                class="form-control"
                                                placeholder="Alamat lengkap"><?= old(
                                                                                    'alamat',
                                                                                    $profile['alamat']
                                                                                ) ?></textarea>

                                        </div>

                                    </div>

                                </div>


                                <hr>


                                <!-- =====================================
                         INFORMASI AKADEMIK
                    ====================================== -->

                                <h4
                                    style="font-weight:700;color:#0b3d91;">

                                    <i class="fas fa-graduation-cap"></i>

                                    Informasi Akademik

                                </h4>


                                <div class="row">


                                    <!-- PRODI -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Program Studi Saat Ini

                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                value="<?= esc($profile['prodi']) ?>"
                                                readonly>

                                            <small class="text-muted">

                                                Pilih program studi di atas untuk mengubah.

                                            </small>

                                        </div>

                                    </div>


                                    <!-- JURUSAN -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Jurusan

                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                value="<?= esc($profile['jurusan']) ?>"
                                                readonly>

                                            <small class="text-muted">

                                                Jurusan mengikuti program studi.

                                            </small>

                                        </div>

                                    </div>


                                    <!-- JABATAN -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Jabatan

                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                value="<?= esc($profile['jabatan']) ?>"
                                                readonly>

                                        </div>

                                    </div>


                                    <!-- STATUS -->

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label>

                                                Status

                                            </label>


                                            <input
                                                type="text"
                                                class="form-control"
                                                value="<?= esc($profile['status']) ?>"
                                                readonly>

                                            <small class="text-muted">

                                                Status mengikuti status akun pengguna.

                                            </small>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =========================================
             FOOTER
        ========================================== -->

                    <div class="card-footer text-right">

                        <a
                            href="<?= base_url('dosen/profile') ?>"
                            class="btn btn-secondary">

                            <i class="fas fa-arrow-left"></i>

                            Batal

                        </a>


                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="fas fa-save"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>