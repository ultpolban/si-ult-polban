<div class="card">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover">

            <thead class="table-light">

                <tr>

                    <th width="60">No</th>

                    <th>Unit Layanan</th>

                    <th>Kode</th>

                    <th>Nama Kategori</th>

                    <th>Icon</th>

                    <th>Color</th>

                    <th width="120">Status</th>

                    <th width="180" class="text-center">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($serviceCategories)) : ?>

                    <?php

                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                    ?>

                    <?php foreach ($serviceCategories as $row) : ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>

                                <?= esc($row['service_unit_name']) ?>

                            </td>

                            <td>

                                <?= esc($row['code']) ?>

                            </td>

                            <td>

                                <?= esc($row['name']) ?>

                            </td>

                            <td>

                                <?php if (!empty($row['icon'])) : ?>

                                    <i class="<?= esc($row['icon']) ?>"></i>

                                    <small class="ms-1">

                                        <?= esc($row['icon']) ?>

                                    </small>

                                <?php else : ?>

                                    -

                                <?php endif; ?>

                            </td>

                            <td>

                                <?php if (!empty($row['color'])) : ?>

                                    <span
                                        class="badge"
                                        style="background:<?= esc($row['color']) ?>">

                                        <?= esc($row['color']) ?>

                                    </span>

                                <?php else : ?>

                                    -

                                <?php endif; ?>

                            </td>

                            <td>

                                <?php if ($row['is_active']) : ?>

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                <?php else : ?>

                                    <span class="badge bg-danger">

                                        Nonaktif

                                    </span>

                                <?php endif ?>

                            </td>

                            <td class="text-center">

                                <a
                                    href="<?= site_url('master/service-categories/show/' . $row['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="<?= site_url('master/service-categories/edit/' . $row['id']) ?>"
                                    class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm btn-delete"
                                    data-id="<?= $row['id'] ?>"
                                    data-name="<?= esc($row['name']) ?>">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php else : ?>

                    <tr>

                        <td
                            colspan="8"
                            class="text-center text-muted">

                            Belum ada data kategori layanan.

                        </td>

                    </tr>

                <?php endif ?>

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        <?= $pager->links() ?>

    </div>

</div>