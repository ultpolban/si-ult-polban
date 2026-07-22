<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Daftar Tiket Unit</h3>
    </div>

    <div class="card-body">

        <?php if(session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>

        <?php endif ?>

        <table class="table table-bordered">

            <thead>

            <tr>

                <th>No</th>

                <th>No Tiket</th>

                <th>Pemohon</th>

                <th>Unit</th>

                <th>Status</th>

                <th>Aksi</th>

            </tr>

            </thead>

            <tbody>

            <?php foreach($tickets as $i=>$t): ?>

            <tr>

                <td><?= $i+1 ?></td>

                <td><?= esc($t['ticket_number']) ?></td>

                <td><?= esc($t['applicant_name']) ?></td>

                <td><?= esc($t['assigned_unit']) ?></td>

                <td>
                    <span class="badge bg-info">
                        <?= esc($t['status']) ?>
                    </span>
                </td>

                <td>

                    <a href="<?= base_url('unit/process/'.$t['id']) ?>"
                       class="btn btn-warning btn-sm">

                        Proses

                    </a>

                    <a href="<?= base_url('unit/complete/'.$t['id']) ?>"
                       class="btn btn-success btn-sm">

                        Selesai

                    </a>

                </td>

            </tr>

            <?php endforeach ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>