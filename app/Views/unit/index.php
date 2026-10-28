<?= $this->extend('layouts/template') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
<style>
    .unit-process-popup {
        border-radius: 1rem;
        box-shadow: 0 1rem 3rem rgba(30, 39, 104, .2);
        padding: 1.75rem;
    }

    .unit-process-popup .swal2-title {
        color: #1e2768;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .unit-process-popup .swal2-html-container {
        color: #596579;
        font-size: 1rem;
    }

    .unit-process-confirm,
    .unit-process-cancel {
        border-radius: .6rem !important;
        font-weight: 600 !important;
        padding: .7rem 1.1rem !important;
    }

    .unit-process-confirm {
        background: #2b3990 !important;
    }

    .unit-process-confirm:hover {
        background: #1e2768 !important;
    }

    @media (max-width: 480px) {
        .unit-process-popup {
            padding: 1.25rem;
            width: calc(100% - 2rem) !important;
        }

        .unit-process-popup .swal2-title {
            font-size: 1.25rem;
        }

        .unit-process-popup .swal2-actions {
            flex-direction: column-reverse;
            width: 100%;
        }

        .unit-process-popup .swal2-actions button {
            margin: .25rem 0;
            width: 100%;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Daftar Tiket Unit</h3>

        <div class="card-tools">

            <a href="<?= base_url('unit/dashboard') ?>" class="btn btn-primary btn-sm">

                <i class="fas fa-home me-1"></i> Dashboard

            </a>

            <a href="<?= base_url('unit/laporan') ?>" class="btn btn-outline-primary btn-sm">

                <i class="fas fa-chart-bar me-1"></i> Laporan

            </a>

            <!-- EXPORT -->
            <div class="btn-group">

                <button
                    type="button"
                    class="btn btn-outline-primary btn-sm dropdown-toggle"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >

                    <i class="fas fa-download mr-1"></i> Export

                </button>

                <div class="dropdown-menu dropdown-menu-right">

                    <a
                        class="dropdown-item"
                        href="<?= base_url('unit/tiket/export/pdf') ?>"
                    >

                        <i class="fas fa-file-pdf text-danger mr-2"></i>

                        Export PDF

                    </a>

                    <a
                        class="dropdown-item"
                        href="<?= base_url('unit/tiket/export/excel') ?>"
                    >

                        <i class="fas fa-file-excel text-success mr-2"></i>

                        Export Excel

                    </a>

                    <a
                        class="dropdown-item"
                        href="<?= base_url('unit/tiket/export/csv') ?>"
                    >

                        <i class="fas fa-file-csv text-primary mr-2"></i>

                        Export CSV

                    </a>

                </div>

            </div>

        </div>

    </div>

    <div class="card-body">

        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>

        <?php endif; ?>


        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>
                        <th>No</th>
                        <th>No Tiket</th>
                        <th>Pemohon</th>
                        <th>Layanan</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php if (!empty($tickets)): ?>

                    <?php foreach ($tickets as $i => $t): ?>

                        <?php
                        $status = strtolower(trim($t['status'] ?? ''));
                        ?>

                        <tr>

                            <td>
                                <?= $i + 1 ?>
                            </td>


                            <td>
                                <strong>
                                    <a href="<?= base_url('unit/detail/' . $t['id']) ?>">
                                        <?= esc($t['ticket_number'] ?? '-') ?>
                                    </a>
                                </strong>
                            </td>


                            <td>
                                <?= esc($t['applicant_name'] ?? '-') ?>
                            </td>


                            <td>
                                <?= esc($t['service_display_name'] ?? '-') ?>
                            </td>


                            <td>
                                <?= esc($t['unit_name'] ?? '-') ?>
                            </td>


                            <td>

                                <?php if ($status === 'assigned'): ?>

                                    <span class="badge bg-warning text-dark">
                                        Assigned
                                    </span>

                                <?php elseif ($status === 'processing'): ?>

                                    <span class="badge bg-info">
                                        Processing
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-secondary">
                                        <?= esc($t['status'] ?? '-') ?>
                                    </span>

                                <?php endif; ?>

                            </td>


                            <td>

                                <a
                                    href="<?= base_url('unit/detail/' . $t['id']) ?>"
                                    class="btn btn-info btn-sm"
                                >
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </a>

                                <?php if ($status === 'assigned'): ?>

                                    <a
                                        href="<?= base_url('unit/process/' . $t['id']) ?>"
                                        class="btn btn-warning btn-sm"
                                    >
                                        <i class="fas fa-play"></i>
                                        Proses
                                    </a>

                                <?php elseif ($status === 'processing'): ?>

                                    <a
                                        href="<?= base_url('unit/complete/' . $t['id']) ?>"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Tandai tiket ini sebagai selesai?')"
                                    >
                                        <i class="fas fa-check"></i>
                                        Selesai
                                    </a>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="7"
                            class="text-center text-muted"
                        >
                            Belum ada tiket yang didisposisikan ke unit.
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<?= $this->endSection() ?>