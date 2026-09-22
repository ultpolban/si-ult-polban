<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-paper-plane"></i>

            Daftar Pengajuan Layanan

        </h3>

        <div class="card-tools">

            <a href="<?= site_url('service-requests/create') ?>"
                class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>

                Buat Pengajuan

            </a>

        </div>

    </div>

    <div class="card-body">

        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success alert-dismissible">

                <button type="button" class="close" data-dismiss="alert">&times;</button>

                <?= esc(session()->getFlashdata('success')) ?>

            </div>

        <?php endif; ?>

        <form action="<?= site_url('service-requests') ?>" method="get" class="mb-3">

            <div class="input-group input-group-sm" style="width:300px;">

                <input type="text" name="keyword"
                    class="form-control"
                    placeholder="Cari tiket / judul..."
                    value="<?= esc($keyword) ?>">

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

                        <th>Tiket</th>

                        <th>Judul</th>

                        <th>Layanan</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($requests)): ?>

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                Belum ada pengajuan.

                            </td>

                        </tr>

                    <?php else: ?>

                        <?php $no = 1; ?>

                        <?php foreach ($requests as $r): ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td><span class="badge badge-info"><?= esc($r['ticket_number'] ?? '-') ?></span></td>

                                <td><?= esc($r['title'] ?? '-') ?></td>

                                <td><?= esc($r['service_name'] ?? '-') ?></td>

                                <td>

                                    <?php
                                    $statusMap = [
                                        'draft'       => ['secondary', 'Draft'],
                                        'submitted'   => ['warning', 'Diajukan'],
                                        'verification' => ['info', 'Verifikasi'],
                                        'revision'    => ['secondary', 'Revisi'],
                                        'processing'  => ['primary', 'Diproses'],
                                        'completed'   => ['success', 'Selesai'],
                                        'rejected'    => ['danger', 'Ditolak'],
                                        'cancelled'   => ['danger', 'Dibatalkan'],
                                    ];
                                    $status = $r['status'] ?? '';
                                    [$badge, $label] = $statusMap[$status] ?? ['secondary', ucfirst(str_replace('_', ' ', $status))];
                                    ?>

                                    <span class="badge badge-<?= $badge ?>"><?= esc($label) ?></span>

                                </td>

                                <td><?= esc($r['created_at'] ?? '-') ?></td>

                                <td>

                                    <a href="<?= site_url('service-requests/show/' . $r['id']) ?>"
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