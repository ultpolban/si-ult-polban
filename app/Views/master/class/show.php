<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail Kelas

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">Program Studi</th>

                <td><?= esc($class['study_program_name']) ?></td>

            </tr>

            <tr>

                <th>Kode Kelas</th>

                <td><?= esc($class['code']) ?></td>

            </tr>

            <tr>

                <th>Nama Kelas</th>

                <td><?= esc($class['name']) ?></td>

            </tr>

            <tr>

                <th>Tingkat</th>

                <td><?= esc($class['level']) ?></td>

            </tr>

            <tr>

                <th>Kelas Paralel</th>

                <td><?= esc($class['parallel_class']) ?></td>

            </tr>

            <tr>

                <th>Tahun Masuk</th>

                <td><?= esc($class['entry_year']) ?></td>

            </tr>

            <tr>

                <th>Deskripsi</th>

                <td>

                    <?= !empty($class['description'])
                        ? nl2br(esc($class['description']))
                        : '-' ?>

                </td>

            </tr>

            <tr>

                <th>Urutan</th>

                <td><?= esc($class['sort_order']) ?></td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <?php if ($class['is_active']) : ?>

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

                <th>Dibuat Pada</th>

                <td><?= esc($class['created_at']) ?></td>

            </tr>

            <tr>

                <th>Diubah Pada</th>

                <td><?= esc($class['updated_at']) ?></td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('master/classes') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="<?= site_url('master/classes/edit/' . $class['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>