<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h5 class="mb-0">

            Detail Permission

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">Module</th>

                <td><?= esc($permission['module']) ?></td>

            </tr>

            <tr>

                <th>Kode Permission</th>

                <td><?= esc($permission['code']) ?></td>

            </tr>

            <tr>

                <th>Nama Permission</th>

                <td><?= esc($permission['name']) ?></td>

            </tr>

            <tr>

                <th>Deskripsi</th>

                <td><?= nl2br(esc($permission['description'])) ?></td>

            </tr>

            <tr>

                <th>Urutan</th>

                <td><?= esc($permission['sort_order']) ?></td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <?php if ($permission['is_active']): ?>

                        <span class="badge badge-success">

                            Aktif

                        </span>

                    <?php else: ?>

                        <span class="badge badge-danger">

                            Nonaktif

                        </span>

                    <?php endif ?>

                </td>

            </tr>

            <tr>

                <th>Dibuat</th>

                <td><?= esc($permission['created_at']) ?></td>

            </tr>

            <tr>

                <th>Diubah</th>

                <td><?= esc($permission['updated_at']) ?></td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('permissions') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="<?= site_url('permissions/edit/' . $permission['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>