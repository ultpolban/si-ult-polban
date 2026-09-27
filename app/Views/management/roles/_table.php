<div class="card">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th width="60">No</th>

                    <th>Kode</th>

                    <th>Nama Role</th>

                    <th>Status</th>

                    <th width="170">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php if ($roles): ?>

                    <?php
                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                    ?>

                    <?php foreach ($roles as $row): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($row['code']) ?></td>

                            <td><?= esc($row['name']) ?></td>

                            <td>

                                <?php if ($row['is_active']): ?>

                                    <span class="badge bg-success">Aktif</span>

                                <?php else: ?>

                                    <span class="badge bg-danger">Nonaktif</span>

                                <?php endif ?>

                            </td>

                            <td>

                                <a
                                    href="<?= site_url('roles/show/' . $row['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="<?= site_url('roles/edit/' . $row['id']) ?>"
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

                <?php else: ?>

                    <tr>

                        <td colspan="5" class="text-center">

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