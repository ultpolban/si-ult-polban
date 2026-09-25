<div class="card card-premium">
    <div class="card-body table-responsive p-0">
        <table class="table table-premium mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Program Studi</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Tingkat</th>
                    <th>Kelas</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                    <th class="text-center" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($classes)) : ?>
                    <?php $no = 1 ?>
                    <?php foreach ($classes as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($row['study_program_name']) ?></td>
                            <td><?= esc($row['code']) ?></td>
                            <td><?= esc($row['name']) ?></td>
                            <td><?= esc($row['level']) ?></td>
                            <td><?= esc($row['parallel_class']) ?></td>
                            <td><?= esc($row['entry_year']) ?></td>
                            <td>
                                <?php if ($row['is_active']) : ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge bg-danger">Nonaktif</span>
                                <?php endif ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="<?= site_url('master/classes/show/' . $row['id']) ?>" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="<?= site_url('master/classes/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id'] ?>" data-name="<?= esc($row['name']) ?>" title="Hapus"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">Belum ada data kelas.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white border-top">
        <?= $pager->links() ?>
    </div>
</div>
