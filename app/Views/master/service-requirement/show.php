<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h5 class="mb-0">

            Detail Persyaratan Layanan

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">Layanan</th>

                <td><?= esc($requirement['service_name']) ?></td>

            </tr>

            <tr>

                <th>Nama Persyaratan</th>

                <td><?= esc($requirement['name']) ?></td>

            </tr>

            <tr>

                <th>Deskripsi</th>

                <td><?= nl2br(esc($requirement['description'])) ?></td>

            </tr>

            <tr>

                <th>Tipe File</th>

                <td><?= esc($requirement['file_type']) ?></td>

            </tr>

            <tr>

                <th>Ekstensi</th>

                <td><?= esc($requirement['allowed_extensions']) ?></td>

            </tr>

            <tr>

                <th>Ukuran Maksimum</th>

                <td><?= esc($requirement['max_file_size']) ?> MB</td>

            </tr>

            <tr>

                <th>Wajib Upload</th>

                <td>

                    <?= $requirement['is_required'] ? 'Ya' : 'Tidak' ?>

                </td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    <?= $requirement['is_active'] ? 'Aktif' : 'Nonaktif' ?>

                </td>

            </tr>

            <tr>

                <th>Urutan</th>

                <td><?= esc($requirement['sort_order']) ?></td>

            </tr>

            <tr>

                <th>Dibuat</th>

                <td><?= esc($requirement['created_at']) ?></td>

            </tr>

            <tr>

                <th>Diubah</th>

                <td><?= esc($requirement['updated_at']) ?></td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('master/service-requirements') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

        <a
            href="<?= site_url('master/service-requirements/edit/' . $requirement['id']) ?>"
            class="btn btn-warning">

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>