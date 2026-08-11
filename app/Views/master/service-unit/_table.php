<div class="card">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($serviceUnits)) : ?>

                    <?php $no = 1; ?>

                    <?php foreach ($serviceUnits as $row) : ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($row['code']) ?></td>

                            <td><?= esc($row['name']) ?></td>

                            <td><?= esc($row['email']) ?></td>

                            <td><?= esc($row['phone']) ?></td>

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

                            <td>

                                <a
                                    href="<?= site_url('master/service-units/show/' . $row['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="<?= site_url('master/service-units/edit/' . $row['id']) ?>"
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

    <div class="card-footer">

        <?= $pager->links() ?>

    </div>

</div>