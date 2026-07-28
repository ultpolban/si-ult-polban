<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                Detail User

            </h2>

            <p class="text-muted mb-0">

                Informasi lengkap pengguna SI-ULT POLBAN

            </p>

        </div>

        <div>

            <a
                href="<?= base_url('users') ?>"
                class="btn btn-secondary">

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </a>

            <a
                href="<?= base_url('users/edit/' . $user['id']) ?>"
                class="btn btn-warning">

                <i class="bi bi-pencil-square me-2"></i>

                Edit

            </a>

        </div>

    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-3 text-center">

                    <?php if (!empty($user['photo'])) : ?>

                        <img
                            src="<?= base_url('uploads/users/' . $user['photo']) ?>"
                            class="img-thumbnail rounded-circle"
                            width="180"
                            height="180">

                    <?php else : ?>

                        <i
                            class="bi bi-person-circle text-secondary"
                            style="font-size:180px;"></i>

                    <?php endif; ?>

                </div>

                <div class="col-md-9">

                    <h3 class="fw-bold">

                        <?= esc($user['full_name']) ?>

                    </h3>

                    <p class="mb-2">

                        <?= esc($user['role_name']) ?>

                        |

                        <?= esc($user['type_name']) ?>

                    </p>

                    <?php if ($user['is_active']) : ?>

                        <span class="badge bg-success">

                            Aktif

                        </span>

                    <?php else : ?>

                        <span class="badge bg-danger">

                            Nonaktif

                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <!-- =========================
             DATA AKUN
        ========================== -->

        <div class="col-lg-6">

            <div class="card shadow-sm mb-4">

                <div class="card-header">

                    <h5 class="mb-0">

                        <i class="bi bi-person-badge-fill me-2"></i>

                        Data Akun

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>

                            <th width="180">

                                Role

                            </th>

                            <td>

                                <?= esc($user['role_name']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Jenis Pemohon

                            </th>

                            <td>

                                <?= esc($user['type_name']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email Pribadi

                            </th>

                            <td>

                                <?= esc($user['personal_email']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email Institusi

                            </th>

                            <td>

                                <?= esc($user['institution_email'] ?: '-') ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                <?php if ($user['is_active']) : ?>

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                <?php else : ?>

                                    <span class="badge bg-danger">

                                        Nonaktif

                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Login Terakhir

                            </th>

                            <td>

                                <?= !empty($user['last_login']) ? date('d M Y H:i', strtotime($user['last_login'])) : '-' ?>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <!-- =========================
             DATA PRIBADI
        ========================== -->

        <div class="col-lg-6">

            <div class="card shadow-sm mb-4">

                <div class="card-header">

                    <h5 class="mb-0">

                        <i class="bi bi-person-lines-fill me-2"></i>

                        Data Pribadi

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>

                            <th width="180">

                                Nama Lengkap

                            </th>

                            <td>

                                <?= esc($user['full_name']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Jenis Kelamin

                            </th>

                            <td>

                                <?= $user['gender'] == 'L' ? 'Laki-laki' : ($user['gender'] == 'P' ? 'Perempuan' : '-') ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Tempat Lahir

                            </th>

                            <td>

                                <?= esc($user['birth_place'] ?: '-') ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Tanggal Lahir

                            </th>

                            <td>

                                <?= !empty($user['birth_date']) ? date('d F Y', strtotime($user['birth_date'])) : '-' ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Nomor HP

                            </th>

                            <td>

                                <?= esc($user['phone'] ?: '-') ?>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Alamat

                            </th>

                            <td>

                                <?= nl2br(esc($user['address'] ?: '-')) ?>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-header">

            <h5 class="mb-0">

                <i class="bi bi-info-circle-fill me-2"></i>

                Data Khusus

            </h5>

        </div>

        <div class="card-body">

            <table class="table table-borderless mb-0">

                <?php switch ($user['user_type_id']):

                        /*
                |--------------------------------------------------------------------------
                | MAHASISWA
                |--------------------------------------------------------------------------
                */
                    case 1:
                ?>

                        <tr>
                            <th width="220">NIM</th>
                            <td><?= esc($user['nim']) ?></td>
                        </tr>

                        <tr>
                            <th>Jurusan</th>
                            <td><?= esc($user['department_name']) ?></td>
                        </tr>

                        <tr>
                            <th>Program Studi</th>
                            <td>
                                <?= esc($user['education_level']) ?>
                                -
                                <?= esc($user['program_name']) ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Kelas</th>
                            <td><?= esc($user['class_name']) ?></td>
                        </tr>

                        <tr>
                            <th>Angkatan</th>
                            <td><?= esc($user['angkatan']) ?></td>
                        </tr>

                        <tr>
                            <th>Tahun Masuk</th>
                            <td><?= esc($user['entry_year']) ?></td>
                        </tr>

                        <tr>
                            <th>Status Mahasiswa</th>
                            <td><?= esc($user['student_status']) ?></td>
                        </tr>

                        <?php break; ?>

                    <?php
                        /*
                |--------------------------------------------------------------------------
                | DOSEN
                |--------------------------------------------------------------------------
                */
                    case 2:
                    ?>

                        <tr>
                            <th width="220">NIP</th>
                            <td><?= esc($user['nip']) ?></td>
                        </tr>

                        <tr>
                            <th>NIDN</th>
                            <td><?= esc($user['nidn']) ?></td>
                        </tr>

                        <tr>
                            <th>Jurusan</th>
                            <td><?= esc($user['department_name']) ?></td>
                        </tr>

                        <tr>
                            <th>Unit Kerja</th>
                            <td><?= esc($user['unit_name']) ?></td>
                        </tr>

                        <tr>
                            <th>Jabatan Akademik</th>
                            <td><?= esc($user['academic_position']) ?></td>
                        </tr>

                        <tr>
                            <th>Jabatan Fungsional</th>
                            <td><?= esc($user['functional_position']) ?></td>
                        </tr>

                        <tr>
                            <th>Status Pegawai</th>
                            <td><?= esc($user['employee_status']) ?></td>
                        </tr>

                        <?php break; ?>

                    <?php
                        /*
                |--------------------------------------------------------------------------
                | TENDIK
                |--------------------------------------------------------------------------
                */
                    case 3:
                    ?>

                        <tr>
                            <th width="220">NIP</th>
                            <td><?= esc($user['nip']) ?></td>
                        </tr>

                        <tr>
                            <th>Unit Kerja</th>
                            <td><?= esc($user['unit_name']) ?></td>
                        </tr>

                        <tr>
                            <th>Jabatan</th>
                            <td><?= esc($user['position']) ?></td>
                        </tr>

                        <tr>
                            <th>Status Pegawai</th>
                            <td><?= esc($user['employee_status']) ?></td>
                        </tr>

                        <?php break; ?>

                    <?php
                        /*
                |--------------------------------------------------------------------------
                | ALUMNI
                |--------------------------------------------------------------------------
                */
                    case 4:
                    ?>

                        <tr>
                            <th width="220">NIM</th>
                            <td><?= esc($user['nim']) ?></td>
                        </tr>

                        <tr>
                            <th>Jurusan</th>
                            <td><?= esc($user['department_name']) ?></td>
                        </tr>

                        <tr>
                            <th>Program Studi</th>
                            <td>
                                <?= esc($user['education_level']) ?>
                                -
                                <?= esc($user['program_name']) ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Tahun Lulus</th>
                            <td><?= esc($user['graduation_year']) ?></td>
                        </tr>

                        <?php break; ?>

                    <?php
                        /*
                |--------------------------------------------------------------------------
                | ORANG TUA / WALI
                |--------------------------------------------------------------------------
                */
                    case 5:
                    ?>

                        <tr>
                            <th width="220">Nama Mahasiswa</th>
                            <td><?= esc($user['student_name']) ?></td>
                        </tr>

                        <tr>
                            <th>NIM Mahasiswa</th>
                            <td><?= esc($user['student_nim']) ?></td>
                        </tr>

                        <tr>
                            <th>Hubungan</th>
                            <td><?= esc($user['relationship']) ?></td>
                        </tr>

                        <?php break; ?>

                    <?php
                        /*
                |--------------------------------------------------------------------------
                | MITRA
                |--------------------------------------------------------------------------
                */
                    case 6:
                    ?>

                        <tr>
                            <th width="220">Nama Instansi</th>
                            <td><?= esc($user['institution_name']) ?></td>
                        </tr>

                        <tr>
                            <th>Jenis Instansi</th>
                            <td><?= esc($user['institution_type']) ?></td>
                        </tr>

                        <tr>
                            <th>Jabatan</th>
                            <td><?= esc($user['position']) ?></td>
                        </tr>

                        <tr>
                            <th>Job Title</th>
                            <td><?= esc($user['job_title']) ?></td>
                        </tr>

                        <?php break; ?>

                    <?php
                        /*
                |--------------------------------------------------------------------------
                | PUBLIK
                |--------------------------------------------------------------------------
                */
                    case 7:
                    ?>

                        <tr>
                            <th width="220">Nomor Identitas</th>
                            <td><?= esc($user['identity_number']) ?></td>
                        </tr>

                        <?php break; ?>

                    <?php
                        /*
                |--------------------------------------------------------------------------
                | DEFAULT
                |--------------------------------------------------------------------------
                */
                    default:
                    ?>

                        <tr>

                            <td colspan="2" class="text-center text-muted py-4">

                                Tidak ada data khusus.

                            </td>

                        </tr>

                <?php endswitch; ?>

            </table>

        </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mb-4">

        <a
            href="<?= base_url('users') ?>"
            class="btn btn-secondary">

            <i class="bi bi-arrow-left me-2"></i>

            Kembali

        </a>

        <a
            href="<?= base_url('users/edit/' . $user['id']) ?>"
            class="btn btn-warning">

            <i class="bi bi-pencil-square me-2"></i>

            Edit User

        </a>

    </div>

</div>

<?= $this->endSection() ?>