<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-history"></i>

            Activity Log

        </h3>

    </div>

    <div class="card-body">

        <form action="<?= site_url('activity-logs') ?>" method="get" class="mb-3">

            <div class="input-group input-group-sm" style="width:300px;">

                <input type="text" name="keyword"
                    class="form-control"
                    placeholder="Cari aksi / modul..."
                    value="<?= esc($keyword ?? '') ?>">

                <span class="input-group-append">

                    <button type="submit" class="btn btn-default">

                        <i class="fas fa-search"></i>

                    </button>

                </span>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover table-sm">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>User</th>

                        <th>Aksi</th>

                        <th>Modul</th>

                        <th>Tanggal</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($logs)): ?>

                        <tr>

                            <td colspan="6" class="text-center text-muted">

                                Belum ada aktivitas.

                            </td>

                        </tr>

                    <?php else: ?>

                        <?php $no = 1; ?>

                        <?php foreach ($logs as $log): ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td><?= esc($log['full_name'] ?? '-') ?></td>

                                <td><?= esc($log['action']) ?></td>

                                <td><?= esc($log['module']) ?></td>

                                <td><?= esc($log['created_at'] ?? '-') ?></td>

                                <td>

                                    <a href="<?= site_url('activity-logs/show/' . $log['id']) ?>"
                                        class="btn btn-info btn-xs">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <?php if (isset($pager)): ?>

            <div class="mt-3">

                <?= $pager->links() ?>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>