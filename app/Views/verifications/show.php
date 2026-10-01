<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-md-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-file-alt"></i>

                    Detail Pengajuan

                </h3>

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>

                        <th style="width:200px;">Nomor Tiket</th>

                        <td><span class="badge badge-info"><?= esc($request['ticket_number'] ?? '-') ?></span></td>

                    </tr>

                    <tr>

                        <th>Judul</th>

                        <td><?= esc($request['title'] ?? '-') ?></td>

                    </tr>

                    <tr>

                        <th>Layanan</th>

                        <td><?= esc($request['service_name'] ?? '-') ?></td>

                    </tr>

                    <tr>

                        <th>Pemohon</th>

                        <td><?= esc($request['applicant_name'] ?? '-') ?></td>

                    </tr>

                    <tr>

                        <th>Status</th>

                        <td>

                            <?php
                            $statusMap = [
                                'draft'       => ['secondary', 'Draft'],
                                'submitted'   => ['warning', 'Diajukan'],
                                'verification' => ['info', 'Verifikasi'],
                                'revision'    => ['secondary', 'Revisi'],
                                'processing'  => ['primary', 'Diproses'],
                                'completed'   => ['success', 'Selesai'],
                                'rejected'    => ['danger', 'Ditolak'],
                                'cancelled'   => ['danger', 'Dibatalkan'],
                            ];
                            $status = $request['status'] ?? '';
                            [$badge, $label] = $statusMap[$status] ?? ['secondary', ucfirst(str_replace('_', ' ', $status))];
                            ?>

                            <span class="badge badge-<?= $badge ?>"><?= esc($label ?: '-') ?></span>

                        </td>

                    </tr>

                    <tr>

                        <th>Prioritas</th>

                        <td>
                            <?php
                            $priorityMap = [
                                'low'    => 'Rendah',
                                'normal' => 'Normal',
                                'high'   => 'Tinggi',
                                'urgent' => 'Segera',
                            ];
                            $prio = $request['priority'] ?? '';
                            echo esc($priorityMap[$prio] ?? ucfirst(str_replace('_', ' ', $prio)) ?: '-');
                            ?>
                        </td>

                    </tr>

                    <tr>

                        <th>Deskripsi</th>

                        <td><?= nl2br(esc($request['description'] ?? '-')) ?></td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Aksi Verifikasi</h3>

            </div>

            <div class="card-body">

                <a href="<?= site_url('verifications') ?>"
                    class="btn btn-secondary btn-block mb-2">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

                <form action="<?= site_url('verifications/verify/' . $request['id']) ?>"
                    method="post" class="mb-2">

                    <?= csrf_field() ?>

                    <button type="submit" class="btn btn-success btn-block">

                        <i class="fas fa-check"></i>

                        Setujui

                    </button>

                </form>

                <form action="<?= site_url('verifications/reject/' . $request['id']) ?>"
                    method="post">

                    <?= csrf_field() ?>

                    <div class="mb-2">

                        <textarea name="note" rows="2"
                            class="form-control form-control-sm"
                            placeholder="Alasan penolakan (opsional)"></textarea>

                    </div>

                    <button type="submit" class="btn btn-danger btn-block">

                        <i class="fas fa-times"></i>

                        Tolak

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>