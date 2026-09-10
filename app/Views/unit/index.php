<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Daftar Tiket Unit</h3>
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
                                    <?= esc($t['ticket_number'] ?? '-') ?>
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

                                <?php if ($status === 'assigned'): ?>

                                    <a
                                        href="<?= base_url('unit/process/' . $t['id']) ?>"
                                        class="btn btn-warning btn-sm"
                                        onclick="return confirm('Mulai proses tiket ini?')"
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