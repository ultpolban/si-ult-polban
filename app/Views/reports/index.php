<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-file-alt"></i>

            Laporan Pengajuan

        </h3>

        <div class="card-tools">

            <a href="<?= site_url('reports/export?' . http_build_query(array_filter($filters))) ?>"

                class="btn btn-success btn-sm">

                <i class="fas fa-download"></i>

                Export CSV

            </a>

        </div>

    </div>

    <div class="card-body">

        <form action="<?= site_url('reports') ?>" method="get" class="mb-3">

            <div class="row">

                <div class="col-md-3 mb-2">

                    <select name="status" class="form-control">

                        <option value="">Semua Status</option>

                        <?php foreach ($statusMap as $key => $label): ?>

                            <option value="<?= $key ?>" <?= ($filters['status'] ?? '') === $key ? 'selected' : '' ?>>

                                <?= esc($label) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3 mb-2">

                    <select name="unit_id" class="form-control">

                        <option value="">Semua Unit</option>

                        <?php foreach ($units as $unit): ?>

                            <option value="<?= $unit['id'] ?>" <?= ($filters['unit_id'] ?? '') == $unit['id'] ? 'selected' : '' ?>>

                                <?= esc($unit['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3 mb-2">

                    <select name="applicant_type_id" class="form-control">

                        <option value="">Semua Jenis Pemohon</option>

                        <?php foreach ($applicantTypes as $type): ?>

                            <option value="<?= $type['id'] ?>" <?= ($filters['applicant_type_id'] ?? '') == $type['id'] ? 'selected' : '' ?>>

                                <?= esc($type['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3 mb-2">

                    <div class="input-group">

                        <input type="date" name="date_from" class="form-control" value="<?= esc($filters['date_from'] ?? '') ?>">

                        <div class="input-group-prepend">

                            <span class="input-group-text">s/d</span>

                        </div>

                        <input type="date" name="date_to" class="form-control" value="<?= esc($filters['date_to'] ?? '') ?>">

                    </div>

                </div>

            </div>

            <div class="row mt-2">

                <div class="col-md-12">

                    <button type="submit" class="btn btn-primary btn-sm">

                        <i class="fas fa-filter"></i> Filter

                    </button>

                    <a href="<?= site_url('reports') ?>" class="btn btn-secondary btn-sm">

                        <i class="fas fa-undo"></i> Reset

                    </a>

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-hover table-sm">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>No. Tiket</th>

                        <th>Judul</th>

                        <th>Layanan</th>

                        <th>Unit</th>

                        <th>Pemohon</th>

                        <th>Jenis Pemohon</th>

                        <th>Status</th>

                        <th>Prioritas</th>

                        <th>Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($tickets)): ?>

                        <tr>

                            <td colspan="10" class="text-center text-muted">Tidak ada data.</td>

                        </tr>

                    <?php else: ?>

                        <?php $no = 1; ?>

                        <?php foreach ($tickets as $r): ?>

                            <?php [$badge, $label] = $statusMap[$r['status'] ?? ''] ?? ['secondary', 'Diajukan']; ?>

                            <tr>

                                <td><?= $no++ ?></td>

                                <td><span class="badge badge-info"><?= esc($r['ticket_number']) ?></span></td>

                                <td><?= esc($r['title']) ?></td>

                                <td><?= esc($r['service_name']) ?></td>

                                <td><?= esc($r['service_unit_name']) ?></td>

                                <td><?= esc($r['applicant_name']) ?></td>

                                <td><?= esc($r['applicant_type'] ?? '-') ?></td>

                                <td><span class="badge badge-<?= $badge ?>"><?= esc($label) ?></span></td>

                                <td><?= esc(ucfirst($r['priority'] ?? 'normal')) ?></td>

                                <td><?= esc($r['created_at']) ?></td>

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