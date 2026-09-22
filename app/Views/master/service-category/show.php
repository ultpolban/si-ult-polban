<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail Kategori Layanan

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="250">

                    Unit Layanan

                </th>

                <td>

                    <?= esc($serviceCategory['service_unit_name']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Kode

                </th>

                <td>

                    <?= esc($serviceCategory['code']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Nama Kategori

                </th>

                <td>

                    <?= esc($serviceCategory['name']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Icon

                </th>

                <td>

                    <?php if (!empty($serviceCategory['icon'])) : ?>

                        <i class="<?= esc($serviceCategory['icon']) ?>"></i>

                        <span class="ms-2">

                            <?= esc($serviceCategory['icon']) ?>

                        </span>

                    <?php else : ?>

                        -

                    <?php endif ?>

                </td>

            </tr>

            <tr>

                <th>

                    Color

                </th>

                <td>

                    <?php if (!empty($serviceCategory['color'])) : ?>

                        <span
                            class="badge"
                            style="background:<?= esc($serviceCategory['color']) ?>">

                            <?= esc($serviceCategory['color']) ?>

                        </span>

                    <?php else : ?>

                        -

                    <?php endif ?>

                </td>

            </tr>

            <tr>

                <th>

                    Deskripsi

                </th>

                <td>

                    <?= !empty($serviceCategory['description'])
                        ? nl2br(esc($serviceCategory['description']))
                        : '-' ?>

                </td>

            </tr>

            <tr>

                <th>

                    Urutan

                </th>

                <td>

                    <?= esc($serviceCategory['sort_order']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Status

                </th>

                <td>

                    <?php if ($serviceCategory['is_active']) : ?>

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

                <th>

                    Dibuat

                </th>

                <td>

                    <?= esc($serviceCategory['created_at']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Terakhir Diubah

                </th>

                <td>

                    <?= esc($serviceCategory['updated_at']) ?>

                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('master/service-categories') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="<?= site_url('master/service-categories/edit/' . $serviceCategory['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>