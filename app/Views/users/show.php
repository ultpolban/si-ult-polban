<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow">

    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">

            Detail User

        </h4>

        <a href="<?= base_url('users') ?>" class="btn btn-light">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="card-body">

        <div class="row">

            <!-- FOTO -->

            <div class="col-md-3 text-center">

                <?php if (!empty($user['photo'])) : ?>

                    <img
                        src="<?= base_url('uploads/users/' . $user['photo']) ?>"
                        class="img-fluid rounded shadow"
                        style="max-height:250px;">

                <?php else : ?>

                    <img
                        src="<?= base_url('assets/images/default-user.png') ?>"
                        class="img-fluid rounded shadow"
                        style="max-height:250px;">

                <?php endif; ?>

            </div>

            <!-- DATA -->

            <div class="col-md-9">

                <table class="table table-bordered">

                    <tr>
                        <th width="250">Nama Lengkap</th>
                        <td><?= esc($user['full_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td><?= esc($user['role_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Jenis Pemohon</th>
                        <td><?= esc($user['type_name'] ?? '-') ?></td>
                    </tr>

                    <tr>
                        <th>Email Personal</th>
                        <td><?= esc($user['personal_email']) ?></td>
                    </tr>

                    <tr>
                        <th>Email Institusi</th>
                        <td><?= esc($user['institution_email']) ?></td>
                    </tr>

                    <tr>
                        <th>No HP</th>
                        <td><?= esc($user['phone']) ?></td>
                    </tr>

                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= esc($user['gender']) ?></td>
                    </tr>

                    <tr>
                        <th>Tempat Lahir</th>
                        <td><?= esc($user['birth_place']) ?></td>
                    </tr>

                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?= esc($user['birth_date']) ?></td>
                    </tr>

                    <tr>
                        <th>Alamat</th>
                        <td><?= esc($user['address']) ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>

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

                </table>

            </div>

        </div>

        <hr>

        <h5 class="mb-3">

            Informasi Tambahan

        </h5>

        <table class="table table-bordered">

            <?php if (!empty($user['nim'])) : ?>

                <tr>

                    <th width="250">

                        NIM

                    </th>

                    <td>

                        <?= esc($user['nim']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['nip'])) : ?>

                <tr>

                    <th>

                        NIP

                    </th>

                    <td>

                        <?= esc($user['nip']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['nidn'])) : ?>

                <tr>

                    <th>

                        NIDN

                    </th>

                    <td>

                        <?= esc($user['nidn']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['department_name'])) : ?>

                <tr>

                    <th>

                        Jurusan

                    </th>

                    <td>

                        <?= esc($user['department_name']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['program_name'])) : ?>

                <tr>

                    <th>

                        Program Studi

                    </th>

                    <td>

                        <?= esc($user['program_name']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['class_name'])) : ?>

                <tr>

                    <th>

                        Kelas

                    </th>

                    <td>

                        <?= esc($user['class_name']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['unit_name'])) : ?>

                <tr>

                    <th>

                        Unit Kerja

                    </th>

                    <td>

                        <?= esc($user['unit_name']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['position'])) : ?>

                <tr>

                    <th>

                        Jabatan

                    </th>

                    <td>

                        <?= esc($user['position']) ?>

                    </td>

                </tr>

            <?php endif; ?>

            <?php if (!empty($user['graduation_year'])) : ?>

                <tr>

                    <th>

                        Tahun Lulus

                    </th>

                    <td>

                        <?= esc($user['graduation_year']) ?>

                    </td>

                </tr>

            <?php endif; ?>

        </table>

    </div>

</div>

<?= $this->endSection() ?>