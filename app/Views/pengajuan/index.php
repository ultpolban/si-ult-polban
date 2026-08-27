<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Pengajuan Layanan</h4>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-send-fill me-2"></i>Daftar Pengajuan Layanan</h5>
        <a href="<?= base_url('pengajuan-layanan/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Buat Pengajuan
        </a>
    </div>
    
    <div class="card-body">
        
        <div class="mb-3" style="max-width: 300px;">
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Cari tiket / judul...">
                <button class="btn btn-outline-secondary btn-sm" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tiket</th>
                        <th>Judul</th>
                        <th>Layanan</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pengajuan)) : ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada pengajuan.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($pengajuan as $key => $row) : ?>
                            <?php
                                // Status badge
                                $status = $row['status'] ?? 'submitted';
                                $statusMap = [
                                    'submitted'   => ['label' => 'Menunggu',  'class' => 'bg-warning text-dark'],
                                    'in_progress' => ['label' => 'Diproses',  'class' => 'bg-info text-dark'],
                                    'completed'   => ['label' => 'Selesai',   'class' => 'bg-success'],
                                    'rejected'    => ['label' => 'Ditolak',   'class' => 'bg-danger'],
                                    'cancelled'   => ['label' => 'Dibatalkan','class' => 'bg-secondary'],
                                ];
                                $statusInfo = $statusMap[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-secondary'];

                                // Prioritas badge
                                $priority = $row['priority'] ?? 'normal';
                                $priorityMap = [
                                    'normal' => ['label' => 'Normal',   'class' => 'bg-secondary'],
                                    'high'   => ['label' => 'Penting',  'class' => 'bg-warning text-dark'],
                                    'urgent' => ['label' => 'Mendesak', 'class' => 'bg-danger'],
                                ];
                                $priorityInfo = $priorityMap[$priority] ?? ['label' => ucfirst($priority), 'class' => 'bg-secondary'];
                            ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><span class="badge bg-dark font-monospace"><?= esc($row['ticket_number']) ?></span></td>
                                <td><?= esc($row['title']) ?></td>
                                <td><?= esc($row['layanan_nama'] ?? '-') ?></td>
                                <td><span class="badge <?= $priorityInfo['class'] ?>"><?= $priorityInfo['label'] ?></span></td>
                                <td><span class="badge <?= $statusInfo['class'] ?>"><?= $statusInfo['label'] ?></span></td>
                                <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
