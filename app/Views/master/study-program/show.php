<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4"><h4 class="fw-bold text-dark mb-1"><?= esc($pageTitle ?? 'Detail Data') ?></h4><p class="text-muted">Informasi lengkap data.</p></div>

<div class="card card-premium">

    <div class="card-header">

        <h3 class="card-title">

            Detail Program Studi

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-premium mb-0">

            <tr>
                <th width="250">Jurusan</th>
                <td><?= esc($studyProgram['department_name']) ?></td>
            </tr>

            <tr>
                <th>Kode</th>
                <td><?= esc($studyProgram['code']) ?></td>
            </tr>

            <tr>
                <th>Nama</th>
                <td><?= esc($studyProgram['name']) ?></td>
            </tr>

            <tr>
                <th>Nama Singkat</th>
                <td><?= esc($studyProgram['short_name']) ?></td>
            </tr>

            <tr>
                <th>Jenjang</th>
                <td><?= esc($studyProgram['degree']) ?></td>
            </tr>

            <tr>
                <th>Deskripsi</th>
                <td><?= nl2br(esc($studyProgram['description'])) ?></td>
            </tr>

            <tr>
                <th>Urutan</th>
                <td><?= esc($studyProgram['sort_order']) ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    <?= $studyProgram['is_active']
                        ? '<span class="badge badge-success">Aktif</span>'
                        : '<span class="badge badge-danger">Nonaktif</span>' ?>

                </td>
            </tr>

        </table>

    </div>

    <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4 text-end">

        <a
            href="<?= site_url('master/study-programs') ?>"
            class="btn btn-light px-4">

            Kembali

        </a>

        <a
            href="<?= site_url('master/study-programs/edit/' . $studyProgram['id']) ?>"
            class="btn btn-warning">

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>

