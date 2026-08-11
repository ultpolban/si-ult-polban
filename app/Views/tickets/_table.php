<?php
$statusMap = [
    'submitted' => ['warning', 'Diajukan'],
    'verification' => ['info', 'Verifikasi'],
    'revision' => ['secondary', 'Revisi'],
    'processing' => ['primary', 'Diproses'],
    'completed' => ['success', 'Selesai'],
    'rejected' => ['danger', 'Ditolak'],
    'cancelled' => ['danger', 'Dibatalkan'],
];
$priorityMap = [
    'low' => ['secondary', 'Rendah'],
    'normal' => ['info', 'Normal'],
    'high' => ['warning', 'Tinggi'],
    'urgent' => ['danger', 'Urgent'],
];
?>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>No. Tiket</th>
                <th>Judul</th>
                <th>Pemohon</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($tickets)): ?>
                <tr>
                    <td colspan="9" class="text-center text-muted">Belum ada tiket.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($tickets as $no => $t): ?>
                    <?php
                    $st = $t['status'] ?? '';
                    [$sBadge, $sLabel] = $statusMap[$st] ?? ['secondary', ucfirst(str_replace('_', ' ', $st))];
                    $pr = $t['priority'] ?? 'normal';
                    [$pBadge, $pLabel] = $priorityMap[$pr] ?? ['info', 'Normal'];
                    ?>
                    <tr>
                        <td><?= $no + 1 ?></td>
                        <td><span class="badge bg-info"><?= esc($t['ticket_number'] ?? '-') ?></span></td>
                        <td><?= esc($t['title'] ?? '-') ?></td>
                        <td><?= esc($t['applicant_name'] ?? '-') ?><?php if (!empty($t['applicant_type'])): ?><br><small class="text-muted"><?= esc($t['applicant_type']) ?></small><?php endif; ?></td>
                        <td><?= esc($t['service_name'] ?? '-') ?><?php if (!empty($t['service_unit_name'])): ?><br><small class="text-muted"><?= esc($t['service_unit_name']) ?></small><?php endif; ?></td>
                        <td><span class="badge bg-<?= $sBadge ?>"><?= esc($sLabel) ?></span></td>
                        <td><span class="badge bg-<?= $pBadge ?>"><?= esc($pLabel) ?></span></td>
                        <td><?= esc($t['created_at'] ?? '-') ?></td>
                        <td class="text-nowrap">
                            <a href="<?= site_url('tickets/show/' . $t['id']) ?>" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="<?= site_url('tickets/edit/' . $t['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete-ticket" data-id="<?= $t['id'] ?>" data-name="<?= esc($t['ticket_number'] ?? ('Tiket #' . $t['id'])) ?>" title="Hapus"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>