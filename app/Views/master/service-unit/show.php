<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail Unit Layanan

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="250">Kode</th>
                <td><?= esc($serviceUnit['code']) ?></td>
            </tr>

            <tr>
                <th>Nama Unit Layanan</th>
                <td><?= esc($serviceUnit['name']) ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td>
                    <?= $serviceUnit['email']
                        ? esc($serviceUnit['email'])
                        : '-' ?>
                </td>
            </tr>

            <tr>
                <th>Nomor Telepon</th>
                <td>
                    <?= $serviceUnit['phone']
                        ? esc($serviceUnit['phone'])
                        : '-' ?>
                </td>
            </tr>

            <tr>
                <th>Lokasi</th>
                <td>
                    <?= $serviceUnit['location']
                        ? esc($serviceUnit['location'])
                        : '-' ?>
                </td>
            </tr>

            <tr>
                <th>Website</th>
                <td>

                    <?php if (!empty($serviceUnit['website'])) : ?>

                        <a
                            href="<?= esc($serviceUnit['website']) ?>"
                            target="_blank">

                            <?= esc($serviceUnit['website']) ?>

                        </a>

                    <?php else : ?>

                        -

                    <?php endif; ?>

                </td>
            </tr>

            <tr>
                <th>Logo</th>
                <td>

                    <?php if (!empty($serviceUnit['logo'])) : ?>

                        <img
                            src="<?= base_url($serviceUnit['logo']) ?>"
                            alt="Logo"
                            class="img-thumbnail"
                            style="max-height:120px;">

                    <?php else : ?>

                        -

                    <?php endif; ?>

                </td>
            </tr>

            <tr>
                <th>Deskripsi</th>
                <td>

                    <?= !empty($serviceUnit['description'])
                        ? nl2br(esc($serviceUnit['description']))
                        : '-' ?>

                </td>
            </tr>

            <tr>
                <th>Urutan</th>
                <td><?= esc($serviceUnit['sort_order']) ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    <?php if ($serviceUnit['is_active']) : ?>

                        <span class="badge bg-success">

                            Aktif

                        </span>

                    <?php else : ?>

                        <span class="badge bg-danger">

                            Nonaktif

                        </span>

                    <?php endif ?>

                </td>
            </tr>

            <tr>
                <th>Dibuat</th>
                <td><?= esc($serviceUnit['created_at']) ?></td>
            </tr>

            <tr>
                <th>Terakhir Diubah</th>
                <td><?= esc($serviceUnit['updated_at']) ?></td>
            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('master/service-units') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="<?= site_url('master/service-units/edit/' . $serviceUnit['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>