<div class="card card-premium">

    <div class="card-body table-responsive p-0">

        <table class="table table-premium mb-0">

            <thead class="table-light">

                <tr>

                    <th width="60">No</th>

                    <th>Nama</th>

                    <th>Jenis Kelamin</th>

                    <th>Email</th>

                    <th>NIK</th>

                    <th>Role</th>

                    <th>Status</th>

                    <th width="170" class="text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($items)) : ?>

                    <?php
                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                    ?>

                    <?php foreach ($items as $row) : ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($row['full_name'] ?? '-') ?></td>

                            <td>
                                <?php if (!empty($row['gender'])) : ?>
                                    <?= $row['gender'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                <?php else : ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td><?= esc($row['email'] ?? '-') ?></td>

                            <td><?= esc($row['identity_number'] ?? '-') ?></td>

                            <td><?= esc($row['role_name'] ?? '-') ?></td>

                            <td>

                                <?php if (!empty($row['is_active'])) : ?>

                                    <span class="badge bg-success">Aktif</span>

                                <?php else : ?>

                                    <span class="badge bg-danger">Nonaktif</span>

                                <?php endif; ?>

                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-1">

                                    <a
                                        href="<?= site_url('users/show/' . $row['id']) ?>"
                                        class="btn btn-info btn-sm"
                                        title="Detail">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <a
                                        href="<?= site_url('users/edit/' . $row['id']) ?>"
                                        class="btn btn-warning btn-sm"
                                        title="Edit">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <?php if (in_array($row['role_code'] ?? '', ['SUPER_ADMIN', 'ADMIN_ULT'], true)) : ?>
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-sm"
                                            disabled
                                            title="Tidak bisa dihapus">

                                            <i class="fas fa-lock"></i>

                                        </button>
                                    <?php else : ?>
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm btn-delete-user"
                                            data-id="<?= $row['id'] ?>"
                                            data-name="<?= esc($row['full_name'] ?? '-') ?>"
                                            title="Hapus">

                                            <i class="fas fa-trash"></i>

                                        </button>
                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>

                        <td colspan="8" class="text-center py-4">

                            Tidak ada data pengguna.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <?php if (!empty($pager)) : ?>

        <div class="card-footer">

            <?= $pager->links() ?>

        </div>

    <?php endif; ?>

</div>
