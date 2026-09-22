<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h5 class="mb-0">

            Detail Role

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">Kode Role</th>

                <td><?= esc($role['code']) ?></td>

            </tr>

            <tr>

                <th>Nama Role</th>

                <td><?= esc($role['name']) ?></td>

            </tr>

            <tr>

                <th>Deskripsi</th>

                <td>

                    <?= nl2br(esc($role['description'])) ?>

                </td>

            </tr>

            <tr>

                <th>Urutan</th>

                <td>

                    <?= esc($role['sort_order']) ?>

                </td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <?php if ($role['is_active']): ?>

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

                <td>

                    <?= esc($role['created_at']) ?>

                </td>

            </tr>

            <tr>

                <th>Diubah</th>

                <td>

                    <?= esc($role['updated_at']) ?>

                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('roles') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="<?= site_url('roles/edit/' . $role['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>