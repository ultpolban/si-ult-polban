<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Tiket Permohonan</h1>
                <small class="text-muted">
                    Kelola dan pantau seluruh tiket permohonan layanan.
                </small>
            </div>
        </div>
    </div>
</section>

<section class="content">
<div class="container-fluid">

    <div class="card card-primary card-outline">

        <div class="card-header">
            <form method="get" action="<?= base_url('datatiket') ?>">
                <div class="row">

                    <div class="col-md-5">
                        <input type="text"
                               name="keyword"
                               class="form-control"
                               placeholder="Cari No Tiket, Nama, NIM, Layanan..."
                               value="<?= esc($keyword ?? '') ?>">
                    </div>

                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="Submitted">Submitted</option>
                            <option value="Verified">Verified</option>
                            <option value="Need Revision">Need Revision</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Assigned">Assigned</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="submission_type" class="form-control">
                            <option value="">Semua Jenis</option>
                            <option value="Online">Online</option>
                            <option value="Walk In">Walk In</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i> Filter
                        </button>

                        <a href="<?= base_url('datatiket') ?>" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover mb-0">

                    <thead class="bg-primary text-white">
                        <tr>
                            <th width="60">No</th>
                            <th>No Tiket</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Layanan</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th width="170" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (!empty($tickets)): ?>

                        <?php $no = 1; ?>

                        <?php foreach ($tickets as $ticket): ?>

                        <?php

                        $badge = 'secondary';

                        switch ($ticket['status']) {
                            case 'Submitted':
                                $badge = 'warning';
                                break;

                            case 'Verified':
                                $badge = 'success';
                                break;

                            case 'Need Revision':
                                $badge = 'info';
                                break;

                            case 'Rejected':
                                $badge = 'danger';
                                break;

                            case 'Assigned':
                                $badge = 'primary';
                                break;

                            case 'Completed':
                                $badge = 'success';
                                break;
                        }

                        ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($ticket['ticket_number']) ?></td>

                            <td><?= esc($ticket['applicant_name']) ?></td>

                            <td><?= esc($ticket['nim']) ?></td>

                            <td><?= esc($ticket['service_name']) ?></td>

                            <td><?= esc($ticket['submission_type']) ?></td>

                            <td>
                                <span class="badge badge-<?= $badge ?>">
                                    <?= esc($ticket['status']) ?>
                                </span>
                            </td>

                            <td class="text-center">

                                <a href="<?= base_url('verification/detail/'.$ticket['id']) ?>"
                                   class="btn btn-info btn-sm"
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="<?= base_url('verification/detail/'.$ticket['id']) ?>"
                                   class="btn btn-success btn-sm"
                                   title="Verifikasi">
                                    <i class="fas fa-user-check"></i>
                                </a>

                                <a href="<?= base_url('disposition/detail/'.$ticket['id']) ?>"
                                   class="btn btn-warning btn-sm"
                                   title="Disposisi">
                                    <i class="fas fa-share-square"></i>
                                </a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="8" class="text-center py-4">
                                Tidak ada data tiket.
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
</section>

<?= $this->endSection() ?>