<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-history"></i>

            Detail Activity Log

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th style="width:200px;">User</th>

                <td><?= esc($log['full_name'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Aksi</th>

                <td><?= esc($log['action'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Modul</th>

                <td><?= esc($log['module'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>IP Address</th>

                <td><?= esc($log['ip_address'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>User Agent</th>

                <td><?= esc($log['user_agent'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Tanggal</th>

                <td><?= esc($log['created_at'] ?? '-') ?></td>

            </tr>

        </table>

        <a href="<?= site_url('activity-logs') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

    </div>

</div>

<?= $this->endSection() ?>