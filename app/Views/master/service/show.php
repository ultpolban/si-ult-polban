<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4"><h4 class="fw-bold text-dark mb-1"><?= esc($pageTitle ?? 'Detail Data') ?></h4><p class="text-muted">Informasi lengkap data.</p></div>

<div class="card card-premium">

    <div class="card-header">

        <h3 class="card-title">

            Detail Layanan

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-premium mb-0">

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

                <th>Jenis Pemohon yang Dapat Mengakses</th>

                <td>

                    <?php if (!empty($allowedApplicantTypes)): ?>

                        <?php foreach ($allowedApplicantTypes as $at): ?>

                            <span class="badge bg-success mr-1">
                                <?= esc($at['name'] ?? '-') ?>
                            </span>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <span class="text-muted">
                            Semua jenis pemohon
                        </span>

                    <?php endif; ?>

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

    <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4 text-end">

        <a
            href="<?= site_url('master/services') ?>"
            class="btn btn-light px-4">

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

