<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">No</th>
                    <th width="250">Unit Layanan</th>
                    <th>Deskripsi</th>
                    <th width="110">Status</th>
                    <th width="170" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($profiles)) : ?>
                    <?php $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage()); ?>
                    <?php foreach ($profiles as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= esc($row['unit_name'] ?? '-') ?></strong><br><small class="text-muted"><?= esc($row['unit_code'] ?? '') ?></small></td>
                            <td><?= esc(mb_strimwidth(strip_tags($row['description'] ?? ''), 0, 150, '...')) ?></td>
                            <td>
                                <?php if ($row['is_active']) : ?><span class="badge bg-success">Aktif</span>
                                <?php else : ?><span class="badge bg-danger">Nonaktif</span><?php endif ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= site_url('units-profiles/show/' . $row['id']) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= site_url('units-profiles/edit/' . $row['id']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id'] ?>" data-name="<?= esc($row['unit_name'] ?? 'Profil') ?>"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr><td colspan="5" class="text-center text-muted">Belum ada data deskripsi unit.</td></tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer"><?= $pager->links() ?></div>
</div>
