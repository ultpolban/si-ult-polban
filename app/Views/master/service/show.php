<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail Layanan

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">Unit Layanan</th>

                <td><?= esc($service['service_unit_name']) ?></td>

            </tr>

            <tr>

                <th>Kategori Layanan</th>

                <td><?= esc($service['category_name']) ?></td>

            </tr>

            <tr>

                <th>Kode</th>

                <td><?= esc($service['code']) ?></td>

            </tr>

            <tr>

                <th>Nama Layanan</th>

                <td><?= esc($service['name']) ?></td>

            </tr>

            <tr>

                <th>Deskripsi</th>

                <td>

                    <?= !empty($service['description'])
                        ? nl2br(esc($service['description']))
                        : '-' ?>

                </td>

            </tr>

            <tr>

                <th>Estimasi Layanan</th>

                <td>

                    <?= esc($service['service_hours']) ?> Jam

                </td>

            </tr>

            <tr>

                <th>Maksimum Upload</th>

                <td>

                    <?= esc($service['max_file_size']) ?> MB

                </td>

            </tr>

            <tr>

                <th>Layanan Online</th>

                <td>

                    <?= $service['is_online'] ? 'Ya' : 'Tidak' ?>

                </td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <?= $service['is_active'] ? 'Aktif' : 'Nonaktif' ?>

                </td>

            </tr>

            <tr>

                <th>Urutan</th>

                <td>

                    <?= esc($service['sort_order']) ?>

                </td>

            </tr>

            <tr>

                <th>Dibuat</th>

                <td>

                    <?= esc($service['created_at']) ?>

                </td>

            </tr>

            <tr>

                <th>Diubah</th>

                <td>

                    <?= esc($service['updated_at']) ?>

                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('master/services') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

        <a
            href="<?= site_url('master/services/edit/' . $service['id']) ?>"
            class="btn btn-warning">

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>