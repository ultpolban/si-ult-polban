<div class="card card-premium">
    <div class="card-body table-responsive p-0">
        <table class="table table-premium mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Unit Layanan</th>
                    <th>Kategori</th>
                    <th>Kode</th>
                    <th>Nama Layanan</th>
                    <th>SLA (Jam)</th>
                    <th>Online</th>
                    <th>Status</th>
                    <th class="text-center" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)) : ?>
                    <?php $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage()); ?>
                    <?php foreach ($services as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($row['service_unit_name']) ?></td>
                            <td><?= esc($row['category_name']) ?></td>
                            <td><?= esc($row['code']) ?></td>
                            <td><?= esc($row['name']) ?></td>
                            <td><?= esc($row['service_hours']) ?> Jam</td>
                            <td><?= $row['is_online'] ? '<span class="badge bg-primary">Online</span>' : '<span class="badge bg-secondary">Offline</span>' ?></td>
                            <td><?= $row['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Nonaktif</span>' ?></td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="<?= site_url('master/services/show/' . $row['id']) ?>" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="<?= site_url('master/services/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id'] ?>" data-name="<?= esc($row['name']) ?>" title="Hapus"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr><td colspan="9" class="text-center py-4 text-muted">Belum ada data layanan.</td></tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white border-top">
        <?= $pager->links() ?>
    </div>
</div>
