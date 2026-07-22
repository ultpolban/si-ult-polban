<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Master Program Studi</h3>

        <a href="<?= base_url('study-programs/create') ?>" class="btn btn-primary">
            Tambah Program Studi
        </a>

    </div>

    <?php if (session()->getFlashdata('success')) : ?>

        <div class="alert alert-success">

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif; ?>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Jurusan</th>
                        <th>Kode</th>
                        <th>Program Studi</th>
                        <th>Jenjang</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php $no = 1; ?>

                    <?php foreach ($studyPrograms as $program): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($program['department_name']) ?></td>

                            <td><?= esc($program['program_code']) ?></td>

                            <td><?= esc($program['program_name']) ?></td>

                            <td><?= esc($program['education_level']) ?></td>

                            <td><?= esc($program['status']) ?></td>

                            <td>

                                <a href="<?= base_url('study-programs/edit/' . $program['id']) ?>" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="<?= base_url('study-programs/delete/' . $program['id']) ?>"
                                    onclick="return confirm('Hapus data ini?')"
                                    class="btn btn-danger btn-sm">

                                    Hapus

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>