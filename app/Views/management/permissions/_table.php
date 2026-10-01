<div class="card">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th width="60">No</th>

                    <th>Module</th>

                    <th>Kode</th>

                    <th>Permission</th>

                    <th>Status</th>

                    <th width="170">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php if ($permissions): ?>

                    <?php
                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                    ?>

                    <?php foreach ($permissions as $row): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>

                                <span class="badge badge-info">

                                    <?= esc($row['module']) ?>

                                </span>

                            </td>

                            <td><?= esc($row['code']) ?></td>

                            <td><?= esc($row['name']) ?></td>

                            <td>

                                <?php if ($row['is_active']): ?>

                                    <span class="badge badge-success">

                                        Aktif

                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-danger">

                                        Nonaktif

                                    </span>

                                <?php endif ?>

                            </td>

                            <td>

                                <a
                                    href="<?= site_url('permissions/show/' . $row['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="<?= site_url('permissions/edit/' . $row['id']) ?>"
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

                <?php else: ?>

                    <tr>

                        <td colspan="6" class="text-center">

                            Tidak ada data.

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