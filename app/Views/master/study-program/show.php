<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail Program Studi

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

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

    <div class="card-footer">

        <a
            href="<?= site_url('master/study-programs') ?>"
            class="btn btn-secondary">

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