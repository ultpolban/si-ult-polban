<div class="card">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-bordered table-hover mb-0">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Jurusan</th>

                        <th>Kode</th>

                        <th>Program Studi</th>

                        <th>Jenjang</th>

                        <th>Status</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (! empty($studyPrograms)) : ?>

                        <?php $no = 1; ?>

                        <?php foreach ($studyPrograms as $row) : ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td><?= esc($row['department_name']) ?></td>

                                <td><?= esc($row['code']) ?></td>

                                <td><?= esc($row['name']) ?></td>

                                <td><?= esc($row['degree']) ?></td>

                                <td>

                                    <?php if ($row['is_active']) : ?>

                                        <span class="badge badge-success">

                                            Aktif

                                        </span>

                                    <?php else : ?>

                                        <span class="badge badge-danger">

                                            Nonaktif

                                        </span>

                                    <?php endif ?>

                                </td>

                                <td>

                                    <a href="<?= site_url('master/study-programs/show/' . $row['id']) ?>"
                                        class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <a href="<?= site_url('master/study-programs/edit/' . $row['id']) ?>"
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

                            <td colspan="7" class="text-center">

                                Belum ada data.

                            </td>

                        </tr>

                    <?php endif ?>

                </tbody>

            </table>

        </div>

    </div>

    <?php if (isset($pager)) : ?>

        <div class="card-footer">

            <?= $pager->links() ?>

        </div>

    <?php endif ?>

</div>