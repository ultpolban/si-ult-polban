<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <h1>Data Tiket Permohonan</h1>
        <small class="text-muted">
            Kelola dan pantau seluruh tiket permohonan layanan.
        </small>
    </div>
</section>

<section class="content">
<div class="container-fluid">

    <div class="card card-primary card-outline">

        <!-- Form Filter & Entries Limit -->
        <div class="card-header">
            <form method="get" action="<?= base_url('datatiket') ?>" id="filterForm">
                <div class="row align-items-center">

                    <div class="col-md-4">
                        <input type="text"
                               name="keyword"
                               class="form-control"
                               placeholder="Cari No Tiket, Nama, NIM, Layanan..."
                               value="<?= esc($keyword ?? '') ?>">
                    </div>

                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <?php
                            $statuses = [
                                'draft'        => 'Draft',
                                'submitted'    => 'Submitted',
                                'verification' => 'Verification',
                                'revision'     => 'Revision',
                                'processing'   => 'Processing',
                                'completed'    => 'Completed',
                                'rejected'     => 'Rejected',
                                'cancelled'    => 'Cancelled',
                            ];
                            ?>
                            <?php foreach ($statuses as $value => $label): ?>
                                <option value="<?= esc($value) ?>" <?= (($status ?? '') === $value) ? 'selected' : '' ?>>
                                    <?= esc($label) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="submission_type" class="form-control">
                            <option value="">Semua Jenis</option>
                            <option value="Online" <?= (($submission_type ?? '') === 'Online') ? 'selected' : '' ?>>
                                Online
                            </option>
                            <option value="Walk In" <?= (($submission_type ?? '') === 'Walk In') ? 'selected' : '' ?>>
                                Walk In
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary mr-1">
                            <i class="fas fa-search"></i> Filter
                        </button>

                        <a href="<?= base_url('datatiket') ?>" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>

                </div>

               <!-- Ubah tag <select> menjadi <input type="number"> -->
<div class="row mt-3 align-items-center">
    <div class="col-md-12 d-flex align-items-center">
        <span class="mr-2 text-muted">Tampilkan</span>
        
        <input type="number" 
               name="per_page" 
               class="form-control form-control-sm text-center" 
               style="width: 80px;" 
               min="1" 
               value="<?= esc($perPage ?? 10) ?>" 
               onchange="this.form.submit()"
               placeholder="10">
               
        <span class="ml-2 text-muted">data per halaman</span>
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
                            <th>Nama Pemohon</th>
                            <th>NIM / NIK</th>
                            <th>Layanan</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th>Prioritas</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($tickets)): ?>

                        <?php 
                        // Perhitungan penomoran urut otomatis berdasarkan pagination
                        $currentPage = isset($pager) ? $pager->getCurrentPage('datatiket') : 1;
                        $limitPerPage = $perPage ?? 10;
                        $no = 1 + ($limitPerPage * ($currentPage - 1)); 
                        ?>

                        <?php foreach ($tickets as $ticket): ?>

                            <?php
                            $statusBadge = match ($ticket['status'] ?? '') {
                                'draft'        => 'secondary',
                                'submitted'    => 'warning',
                                'verification' => 'info',
                                'revision'     => 'danger',
                                'processing'   => 'primary',
                                'completed'    => 'success',
                                'rejected'     => 'danger',
                                'cancelled'    => 'dark',
                                default        => 'secondary',
                            };

                            $identity = $ticket['nim'] ?: ($ticket['nik'] ?: '-');
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>

                                <td>
                                    <strong>
                                        <?= esc($ticket['ticket_number'] ?? '-') ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= esc($ticket['applicant_name'] ?? '-') ?>
                                </td>

                                <td>
                                    <?= esc($identity) ?>
                                </td>

                                <td>
                                    <?= esc($ticket['service_name'] ?? '-') ?>
                                </td>

                                <td>
                                    <?= esc($ticket['unit_name'] ?? '-') ?>
                                </td>

                                <td>
                                    <span class="badge badge-<?= $statusBadge ?>">
                                        <?= esc($ticket['status'] ?? '-') ?>
                                    </span>
                                </td>

                                <td>
                                    <?= esc($ticket['priority'] ?? '-') ?>
                                </td>

                                <td class="text-center">
                                    <a href="<?= base_url('verification/detail/' . $ticket['id']) ?>"
                                       class="btn btn-info btn-sm"
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="<?= base_url('disposition/detail/' . $ticket['id']) ?>"
                                       class="btn btn-warning btn-sm"
                                       title="Disposisi">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="9" class="text-center py-4">
                                Tidak ada data tiket.
                            </td>
                        </tr>

                    <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Footer Card: Link Navigasi Halaman -->
        <?php if (isset($pager)): ?>
            <div class="card-footer clearfix d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan <?= count($tickets) ?> data pada halaman ini
                </div>
                <div>
                    <?= $pager->links('datatiket', 'default_full') ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>
</section>

<?= $this->endSection() ?>