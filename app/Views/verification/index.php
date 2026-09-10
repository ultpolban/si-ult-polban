<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .verification-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,.08);
    }

    .verification-card .card-header {
        background: #2d3e8f;
        color: #fff;
        border-radius: 10px 10px 0 0;
        padding: 16px 20px;
    }

    .verification-card .card-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .table thead th {
        background: #2d3e8f;
        color: #fff;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .ticket-number {
        font-weight: 600;
        color: #222;
    }

    .badge-status {
        display: inline-block;
        padding: 5px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-submitted {
        background: #ff9800;
        color: #fff;
    }

    .badge-normal {
        background: #6c757d;
        color: #fff;
    }

    .badge-high {
        background: #dc3545;
        color: #fff;
    }

    .badge-medium {
        background: #ffc107;
        color: #212529;
    }

    .badge-low {
        background: #28a745;
        color: #fff;
    }

    .btn-detail {
        background: #17a2b8;
        color: #fff;
        border: none;
    }

    .btn-detail:hover {
        background: #138496;
        color: #fff;
    }

    .btn-verify {
        background: #28a745;
        color: #fff;
        border: none;
    }

    .btn-verify:hover {
        background: #218838;
        color: #fff;
    }

    .action-buttons {
        white-space: nowrap;
    }

    .empty-state {
        padding: 40px 20px;
        text-align: center;
        color: #6c757d;
    }

    .filter-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-box label {
        margin: 0;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .filter-box {
            margin-top: 10px;
        }

        .table {
            font-size: 13px;
        }
    }
</style>

<div class="container-fluid">

    <!-- JUDUL HALAMAN -->
    <div class="mb-3">
        <h4 class="mb-0">
            <i class="fas fa-check-circle mr-2"></i>
            Verifikasi Tiket
        </h4>
    </div>

    <!-- PESAN SUCCESS -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>
            <?= esc(session()->getFlashdata('success')) ?>

            <button type="button"
                    class="close"
                    data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- PESAN ERROR -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?= esc(session()->getFlashdata('error')) ?>

            <button type="button"
                    class="close"
                    data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- ========================================================= -->
    <!-- DAFTAR TIKET -->
    <!-- ========================================================= -->

    <div class="card verification-card">

        <div class="card-header">

            <div class="d-flex justify-content-between align-items-center">

                <h3>
                    <i class="fas fa-list mr-2"></i>
                    Daftar Tiket Menunggu Verifikasi
                </h3>

                <div class="filter-box">

                    <label for="filterStatus">
                        Filter Status:
                    </label>

                    <select id="filterStatus"
                            class="form-control form-control-sm"
                            style="width: 160px;"
                            onchange="filterStatus()">

                        <option value="Submitted" selected>
                            Submitted
                        </option>

                    </select>

                </div>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover mb-0">

                    <thead>

                        <tr>
                            <th width="60">No</th>
                            <th>Nomor Tiket</th>
                            <th>Layanan</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal Pengajuan</th>
                            <th width="220">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if (!empty($tickets)): ?>

                        <?php $no = 1; ?>

                        <?php foreach ($tickets as $ticket): ?>

                            <?php
                                $status = strtolower(
                                    trim($ticket['status'] ?? 'submitted')
                                );

                                $priority = strtolower(
                                    trim($ticket['priority'] ?? 'normal')
                                );

                                /*
                                 * Nama layanan
                                 */
                                $serviceName =
                                    $ticket['service_name']
                                    ?? $ticket['service']
                                    ?? '-';

                                /*
                                 * Tanggal pengajuan
                                 */
                                $submittedAt =
                                    $ticket['submitted_at']
                                    ?? $ticket['created_at']
                                    ?? null;
                            ?>

                            <tr>

                                <!-- NO -->
                                <td>
                                    <?= $no++ ?>
                                </td>

                                <!-- NOMOR TIKET -->
                                <td>

                                    <span class="ticket-number">

                                        <?= esc(
                                            $ticket['ticket_number']
                                            ?? '-'
                                        ) ?>

                                    </span>

                                </td>

                                <!-- LAYANAN -->
                                <td>
                                    <?= esc($serviceName) ?>
                                </td>

                                <!-- PRIORITAS -->
                                <td>

                                    <?php if (
                                        $priority === 'high' ||
                                        $priority === 'tinggi'
                                    ): ?>

                                        <span class="badge-status badge-high">
                                            <?= esc(
                                                $ticket['priority'] ?? 'High'
                                            ) ?>
                                        </span>

                                    <?php elseif (
                                        $priority === 'medium' ||
                                        $priority === 'sedang'
                                    ): ?>

                                        <span class="badge-status badge-medium">
                                            <?= esc(
                                                $ticket['priority'] ?? 'Medium'
                                            ) ?>
                                        </span>

                                    <?php elseif (
                                        $priority === 'low' ||
                                        $priority === 'rendah'
                                    ): ?>

                                        <span class="badge-status badge-low">
                                            <?= esc(
                                                $ticket['priority'] ?? 'Low'
                                            ) ?>
                                        </span>

                                    <?php else: ?>

                                        <span class="badge-status badge-normal">
                                            <?= esc(
                                                $ticket['priority'] ?? 'Normal'
                                            ) ?>
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <?php if ($status === 'submitted'): ?>

                                        <span class="badge-status badge-submitted">
                                            Submitted
                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-secondary">
                                            <?= esc(
                                                $ticket['status'] ?? '-'
                                            ) ?>
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- TANGGAL -->
                                <td>

                                    <?php if (!empty($submittedAt)): ?>

                                        <?= esc(
                                            date(
                                                'Y-m-d H:i:s',
                                                strtotime($submittedAt)
                                            )
                                        ) ?>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </td>

                                <!-- ================================================= -->
                                <!-- AKSI -->
                                <!-- ================================================= -->
                                <td class="action-buttons">

                                    <!-- DETAIL -->
                                    <a
                                        href="<?= base_url(
                                            'verification/detail/' .
                                            $ticket['id']
                                        ) ?>"
                                        class="btn btn-sm btn-info">

                                        <i class="fas fa-eye"></i>
                                        Detail

                                    </a>


                                    <!-- ================================================= -->
                                    <!-- VERIFIKASI -->
                                    <!--
                                        PENTING:
                                        Sekarang TIDAK menggunakan POST.

                                        Klik tombol:
                                        1. Muncul konfirmasi
                                        2. Jika OK -> masuk ke halaman form verifikasi
                                        3. Belum mengubah status tiket
                                    -->
                                    <!-- ================================================= -->

                                    <a
                                        href="<?= base_url(
                                            'verification/verify/' .
                                            $ticket['id']
                                        ) ?>"
                                        class="btn btn-sm btn-success"
                                        onclick="return confirm(
                                            'Apakah data tiket ini sudah lengkap dan benar?'
                                        )">

                                        <i class="fas fa-check"></i>
                                        Verifikasi

                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7">

                                <div class="empty-state">

                                    <i class="fas fa-inbox fa-3x mb-3"></i>

                                    <h5>
                                        Tidak Ada Tiket
                                    </h5>

                                    <p class="mb-0">
                                        Belum ada tiket yang menunggu verifikasi.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>


            <!-- ========================================================= -->
            <!-- PAGINATION -->
            <!-- ========================================================= -->

            <?php if (!empty($tickets)): ?>

                <div class="d-flex justify-content-between align-items-center mt-3">

                    <div class="text-muted">

                        Menampilkan

                        <strong>
                            <?= count($tickets) ?>
                        </strong>

                        tiket menunggu verifikasi.

                    </div>

                    <div>

                        <button class="btn btn-sm btn-light border">
                            &laquo;
                        </button>

                        <button class="btn btn-sm btn-primary">
                            1
                        </button>

                        <button class="btn btn-sm btn-light border">
                            &raquo;
                        </button>

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>


<script>
function filterStatus() {

    const status =
        document.getElementById('filterStatus').value;

    if (status === 'Submitted') {

        window.location.href =
            "<?= base_url('verification') ?>";

    }

}
</script>

<?= $this->endSection() ?>