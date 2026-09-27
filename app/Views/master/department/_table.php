<div class="card">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-bordered table-hover mb-0">

                <thead class="thead-light">

                    <tr>

                        <th width="60">No</th>
                        <th width="120">Kode</th>
                        <th>Nama Jurusan</th>
                        <th width="120">Singkatan</th>
                        <th width="100">Urutan</th>
                        <th width="100">Status</th>
                        <th width="180" class="text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($departments)) : ?>

                        <?php
                        $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                        ?>

                        <?php foreach ($departments as $department) : ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td><?= esc($department['code']) ?></td>

                                <td><?= esc($department['name']) ?></td>

                                <td><?= esc($department['short_name']) ?></td>

                                <td><?= esc($department['sort_order']) ?></td>

                                <td>

                                    <?php if ($department['is_active']) : ?>

                                        <span class="badge badge-success">
                                            Aktif
                                        </span>

                                    <?php else : ?>

                                        <span class="badge badge-danger">
                                            Nonaktif
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td class="text-center">

                                    <a href="<?= site_url('master/departments/show/' . $department['id']) ?>"
                                        class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <a href="<?= site_url('master/departments/edit/' . $department['id']) ?>"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm btn-delete"
                                        data-id="<?= $department['id'] ?>"
                                        data-name="<?= esc($department['name']) ?>">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else : ?>

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                Belum ada data jurusan.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <?php if (isset($pager)) : ?>

        <div class="card-footer clearfix">

            <?= $pager->links() ?>

        </div>

    <?php endif; ?>

</div>