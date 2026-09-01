<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_dosen'); ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <h1 class="dashboard-title">

                        <i class="fas fa-home me-2"></i>

                        Dashboard Dosen

                    </h1>

                </div>

                <div class="col-sm-6 text-sm-end mt-2 mt-sm-0">

                    <a
                        href="<?= base_url('dosen/ticket/create') ?>"
                        class="btn btn-ult-orange">

                        <i class="fas fa-plus-circle me-1"></i>

                        Ajukan Layanan

                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card welcome-card shadow-sm">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <h3 class="welcome-title">

                                Selamat Datang,

                                <?= esc($user['nama'] ?? 'Dosen'); ?>

                                ! 👋

                            </h3>

                            <p class="welcome-text mb-3">

                                Selamat datang di Sistem Informasi
                                Unit Layanan Terpadu POLBAN.

                            </p>

                            <div class="student-info">

                                <div>

                                    <i class="fas fa-id-card"></i>

                                    <strong>
                                        NIP/NIDN:
                                    </strong>

                                    <?= esc($user['nip'] ?? '-') ?>
                                    /
                                    <?= esc($user['nidn'] ?? '-') ?>

                                </div>

                                <div>

                                    <i class="fas fa-graduation-cap"></i>

                                    <strong>
                                        Program Studi:
                                    </strong>

                                    <?= esc($user['prodi'] ?? '-') ?>

                                </div>

                                <div>

                                    <i class="fas fa-building"></i>

                                    <strong>
                                        Fakultas:
                                    </strong>

                                    <?= esc($user['fakultas'] ?? '-') ?>

                                </div>

                                <div>

                                    <i class="fas fa-user-tag"></i>

                                    <strong>
                                        Jabatan:
                                    </strong>

                                    <?= esc($user['jabatan'] ?? '-') ?>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 text-center mt-3 mt-md-0">

                            <div class="student-avatar">

                                <i class="fas fa-user-tie"></i>

                            </div>

                            <div class="mt-2">

                                <span class="status-active">

                                    <i class="fas fa-circle"></i>

                                    <?= esc(
                                        strtolower((string) ($user['status'] ?? 'Aktif')) === 'tidak aktif'
                                            ? 'Tidak Aktif'
                                            : ($user['status'] ?? 'Aktif')
                                    ); ?>

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-blue">

                        <div class="stat-content">

                            <h2><?= esc($statistik['total'] ?? 0); ?></h2>

                            <p>Jumlah Pengajuan</p>

                        </div>

                        <div class="stat-icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-orange">

                        <div class="stat-content">

                            <h2><?= esc($statistik['diproses'] ?? 0); ?></h2>

                            <p>Sedang Diproses</p>

                        </div>

                        <div class="stat-icon">

                            <i class="fas fa-spinner"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-warning">

                        <div class="stat-content">

                            <h2><?= esc($statistik['revisi'] ?? 0); ?></h2>

                            <p>Perlu Revisi</p>

                        </div>

                        <div class="stat-icon">

                            <i class="fas fa-edit"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6 mb-3">

                    <div class="stat-card stat-success">

                        <div class="stat-content">

                            <h2><?= esc($statistik['selesai'] ?? 0); ?></h2>

                            <p>Selesai</p>

                        </div>

                        <div class="stat-icon">

                            <i class="fas fa-check-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row mb-4">

                <div class="col-lg-4 col-md-4 mb-2">

                    <a
                        href="<?= base_url('dosen/ticket/create') ?>"
                        class="quick-action action-orange">

                        <i class="fas fa-plus-circle"></i>

                        <span>Ajukan Layanan Baru</span>

                    </a>

                </div>

                <div class="col-lg-4 col-md-4 mb-2">

                    <a
                        href="<?= base_url('dosen/ticket/history') ?>"
                        class="quick-action action-blue">

                        <i class="fas fa-history"></i>

                        <span>Tracking Tiket</span>

                    </a>

                </div>

                <div class="col-lg-4 col-md-4 mb-2">

                    <a
                        href="<?= base_url('dosen/notification') ?>"
                        class="quick-action action-blue">

                        <i class="fas fa-bell"></i>

                        <span>Notifikasi</span>

                    </a>

                </div>

            </div>

            <div class="card dashboard-card shadow-sm">

                <div class="card-header dashboard-card-header">

                    <h3 class="card-title">

                        <i class="fas fa-history me-2"></i>

                        Riwayat Pengajuan Layanan

                    </h3>

                    <a
                        href="<?= base_url('dosen/ticket/history') ?>"
                        class="btn btn-sm btn-ult-orange float-end">

                        Lihat Semua

                    </a>

                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>

                                <th>No</th>
                                <th>Nomor Tiket</th>
                                <th>Layanan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (! empty($tickets)): ?>

                                <?php $no = 1; ?>

                                <?php foreach ($tickets as $ticket): ?>

                                    <?php
                                    $statusRaw = strtolower(trim((string) ($ticket['status'] ?? '')));
                                    $statusClass = 'status-submitted';
                                    $statusLabel = $ticket['status'] ?? 'Submitted';

                                    if (in_array($statusRaw, ['in progress', 'progress', 'processing', 'processed', 'diproses'], true)) {
                                        $statusClass = 'status-progress';
                                        $statusLabel = 'Sedang Diproses';
                                    } elseif (in_array($statusRaw, ['revision', 'revisi', 'needs revision', 'perlu revisi'], true)) {
                                        $statusClass = 'status-revision';
                                        $statusLabel = 'Perlu Revisi';
                                    } elseif (in_array($statusRaw, ['completed', 'selesai'], true)) {
                                        $statusClass = 'status-completed';
                                        $statusLabel = 'Selesai';
                                    } elseif (in_array($statusRaw, ['submitted', 'verification', 'verified'], true)) {
                                        $statusClass = 'status-submitted';
                                        $statusLabel = 'Diajukan';
                                    }
                                    ?>

                                    <tr>

                                        <td><?= $no++; ?></td>

                                        <td><?= esc($ticket['nomor'] ?? '-') ?></td>

                                        <td><?= esc($ticket['layanan'] ?? '-') ?></td>

                                        <td><?= esc($ticket['tanggal'] ?? '-') ?></td>

                                        <td>

                                            <span class="ticket-status <?= $statusClass ?>">

                                                <?= esc($statusLabel) ?>

                                            </span>

                                        </td>

                                        <td>

                                            <a
                                                href="<?= base_url('dosen/ticket/detail/' . ($ticket['id'] ?? 0)) ?>"
                                                class="btn btn-sm btn-detail">

                                                <i class="fas fa-eye me-1"></i>

                                                Detail

                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="6" class="text-center text-muted py-4">

                                        <i class="fas fa-inbox fa-2x mb-2"></i>

                                        <br>

                                        Belum ada pengajuan layanan.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer'); ?>