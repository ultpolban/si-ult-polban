<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($title) ?></h4>

        <small class="text-muted">

            Detail pengguna.

        </small>

    </div>

    <a href="<?= site_url('users') ?>"
        class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

</div>

<div class="card">

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th style="width:220px;">Nama</th>

                <td><?= esc($item['full_name'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Email</th>

                <td><?= esc($item['email'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Role</th>

                <td><?= esc($item['role_name'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Nomor Identitas</th>

                <td><?= esc($item['identity_number'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Nomor HP</th>

                <td><?= esc($item['phone_number'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <?php if (!empty($item['is_active'])) : ?>

                        <span class="badge badge-success">Aktif</span>

                    <?php else : ?>

                        <span class="badge badge-danger">Nonaktif</span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>Login Terakhir</th>

                <td><?= esc($item['last_login'] ?? '-') ?></td>

            </tr>

            <?php if (!empty($profile) && !empty($profile['applicant_type_id'])): ?>

                <tr>

                    <th>Jenis Pemohon</th>

                    <td><?= esc($profile['applicant_type'] ?? '-') ?></td>

                </tr>

                <tr>

                    <th>Program Studi</th>

                    <td><?= esc($profile['study_program_name'] ?? '-') ?></td>

                </tr>

                <tr>

                    <th>Kelas</th>

                    <td><?= esc($profile['class_name'] ?? '-') ?></td>

                </tr>

                <tr>

                    <th>NIM</th>

                    <td><?= esc($profile['nim'] ?? '-') ?></td>

                </tr>

                <tr>

                    <th>NIK</th>

                    <td><?= esc($profile['nik'] ?? '-') ?></td>

                </tr>

                <?php if (!empty($profile['student_name'])): ?>

                    <tr>

                        <th>Nama Mahasiswa</th>

                        <td><?= esc($profile['student_name']) ?></td>

                    </tr>

                <?php endif; ?>

                <?php if (!empty($profile['institution_name'])): ?>

                    <tr>

                        <th>Instansi / Perusahaan</th>

                        <td><?= esc($profile['institution_name']) ?></td>

                    </tr>

                <?php endif; ?>

                <?php if (!empty($profile['position'])): ?>

                    <tr>

                        <th>Jabatan</th>

                        <td><?= esc($profile['position']) ?></td>

                    </tr>

                <?php endif; ?>

                <tr>

                    <th>Alamat</th>

                    <td><?= esc($profile['address'] ?? '-') ?></td>

                </tr>

            <?php endif; ?>

        </table>

        <a
            href="<?= site_url('users/edit/' . $item['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

        <a
            href="<?= site_url('users') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

<?= $this->endSection() ?>