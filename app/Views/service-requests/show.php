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

                    <tr>

                        <th>Diajukan Pada</th>

                        <td><?= esc($request['submitted_at'] ?? '-') ?></td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Aksi</h3>

            </div>

            <div class="card-body">

                <a href="<?= site_url('service-requests') ?>"
                    class="btn btn-secondary btn-block mb-2">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

                <a href="<?= site_url('service-requests/edit/' . $request['id']) ?>"
                    class="btn btn-warning btn-block mb-2">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="<?= site_url('service-requests/delete/' . $request['id']) ?>"
                    class="btn btn-danger btn-block"
                    onclick="return confirm('Yakin ingin menghapus pengajuan ini?')">

                    <i class="fas fa-trash"></i>

                    Hapus

                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>