<?= $this->extend('layout/main') ?> <!-- Adjust layout if needed -->

<?= $this->section('content') ?>
<div class="container-fluid px-4 py-3">

    <!-- Page Title -->
    <h3 class="fw-bold mb-4">Data Tiket</h3>

    <!-- Card Search Filter -->
    <div class="card shadow-sm border-0 mb-4" style="background-color: #1e2b6b; color: white;">
        <div class="card-header bg-transparent border-0 pt-3 px-3">
            <h6 class="mb-0 fw-semibold text-white">Cari Data Tiket</h6>
        </div>
        <div class="card-body bg-white text-dark rounded-bottom">
            <form action="<?= base_url('tickets') ?>" method="get" class="row g-3 align-items-center">
                <div class="col-md-8">
                    <label for="search" class="form-label fw-bold small">Nomor Tiket / Kata Kunci</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Masukkan Nomor Tiket atau Nama Pemohon..." 
                           value="<?= esc($search ?? '') ?>">
                </div>
                <div class="col-md-2 d-flex align-items-end pt-4">
                    <button type="submit" class="btn text-white w-100" style="background-color: #1e2b6b;">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
                <div class="col-md-2 d-flex align-items-end pt-4">
                    <a href="<?= base_url('tickets') ?>" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Card Main Table & Export Button -->
    <div class="card shadow-sm border-0">
        <div class="card-header text-white fw-bold py-3" style="background-color: #1e2b6b;">
            Data Tiket
        </div>
        <div class="card-body">

            <!-- Flash Alert Success / Error -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Dropdown Export Button -->
            <div class="mb-3">
                <div class="dropdown">
                    <button class="btn text-white dropdown-toggle px-3 py-2 fw-semibold" type="button" id="dropdownExport" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1e2b6b;">
                        <i class="fas fa-download me-1"></i> Export Laporan
                    </button>
                    <ul class="dropdown-menu shadow" aria-labelledby="dropdownExport">
                        <li>
                            <a class="dropdown-item py-2" href="<?= base_url('tickets/export/pdf') ?>">
                                <i class="far fa-file-pdf text-danger me-2 fa-lg"></i> Export PDF
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="<?= base_url('tickets/export/excel') ?>">
                                <i class="far fa-file-excel text-success me-2 fa-lg"></i> Export Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="<?= base_url('tickets/export/csv') ?>">
                                <i class="fas fa-file-csv text-primary me-2 fa-lg"></i> Export CSV
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Table Data -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead style="background-color: #1e2b6b; color: white;">
                        <tr class="text-center align-middle">
                            <th style="width: 50px;">No</th>
                            <th>Nomor Tiket</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Pemohon</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Prioritas</th>
                            <th>Tanggal Pengajuan</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tickets) && is_array($tickets)) : ?>
                            <?php $no = 1; foreach ($tickets as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="fw-bold"><?= esc($row['ticket_number'] ?? $row['nomor_tiket'] ?? '-') ?></td>
                                    <td><?= esc($row['applicant_name'] ?? $row['nama_pemohon'] ?? '-') ?></td>
                                    <td class="text-center"><?= esc($row['applicant_type'] ?? $row['jenis_pemohon'] ?? '-') ?></td>
                                    <td><?= esc($row['service'] ?? $row['layanan'] ?? '-') ?></td>
                                    <td class="text-center">
                                        <?php 
                                            $status = strtolower($row['status'] ?? '');
                                            $badgeClass = 'bg-secondary';
                                            if ($status === 'verified' || $status === 'selesai') $badgeClass = 'bg-success';
                                            elseif ($status === 'assigned' || $status === 'proses') $badgeClass = 'bg-info text-dark';
                                            elseif ($status === 'pending') $badgeClass = 'bg-warning text-dark';
                                        ?>
                                        <span class="badge <?= $badgeClass ?>"><?= ucfirst(esc($row['status'] ?? '-')) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            $priority = strtolower($row['priority'] ?? $row['prioritas'] ?? 'normal');
                                            $pBadge = 'bg-secondary';
                                            if ($priority === 'high') $pBadge = 'bg-danger';
                                            elseif ($priority === 'normal') $pBadge = 'bg-primary';
                                            elseif ($priority === 'low') $pBadge = 'bg-dark';
                                        ?>
                                        <span class="badge <?= $pBadge ?>"><?= ucfirst(esc($priority)) ?></span>
                                    </td>
                                    <td class="text-center"><?= isset($row['created_at']) ? date('d-m-Y H:i', strtotime($row['created_at'])) : '-' ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('tickets/detail/' . ($row['id'] ?? '')) ?>" class="btn btn-sm btn-info text-white" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Belum ada data tiket.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>