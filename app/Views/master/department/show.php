<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail Jurusan

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="220">Kode Jurusan</th>

                <td><?= esc($department['code']) ?></td>

            </tr>

            <tr>

                <th>Nama Jurusan</th>

                <td><?= esc($department['name']) ?></td>

            </tr>

            <tr>

                <th>Singkatan</th>

                <td><?= esc($department['short_name']) ?></td>

            </tr>

            <tr>

                <th>Deskripsi</th>

                <td>

                    <?= nl2br(esc($department['description'])) ?>

                </td>

            </tr>

            <tr>

                <th>Urutan</th>

                <td><?= esc($department['sort_order']) ?></td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <?php if ($department['is_active']) : ?>

                        <span class="badge badge-success">

                            Aktif

                        </span>

                    <?php else : ?>

                        <span class="badge badge-danger">

                            Nonaktif

                        </span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>Dibuat</th>

                <td><?= esc($department['created_at']) ?></td>

            </tr>

            <tr>

                <th>Diubah</th>

                <td><?= esc($department['updated_at']) ?></td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('master/departments') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="<?= site_url('master/departments/edit/' . $department['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>