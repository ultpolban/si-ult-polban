<div class="card">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-light">

                <tr>

                    <th width="60">No</th>

                    <th>Layanan</th>

                    <th>Persyaratan</th>

                    <th>Tipe File</th>

                    <th>Ukuran</th>

                    <th>Wajib</th>

                    <th>Status</th>

                    <th width="170" class="text-center">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (! empty($requirements)) : ?>

                    <?php
                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                    ?>

                    <?php foreach ($requirements as $row) : ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($row['service_name']) ?></td>

                            <td><?= esc($row['name']) ?></td>

                            <td><?= esc($row['file_type']) ?></td>

                            <td><?= esc($row['max_file_size']) ?> MB</td>

                            <td>

                                <?php if ($row['is_required']) : ?>

                                    <span class="badge bg-primary">

                                        Wajib

                                    </span>

                                <?php else : ?>

                                    <span class="badge bg-secondary">

                                        Opsional

                                    </span>

                                <?php endif ?>

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
                                    href="<?= site_url('master/service-requirements/show/' . $row['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="<?= site_url('master/service-requirements/edit/' . $row['id']) ?>"
                                    class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button
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

                        <td colspan="8" class="text-center">

                            Belum ada data.

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