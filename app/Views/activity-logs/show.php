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

            <?php
            // new_data menyimpan meta terstruktur (description/email) sebagai
            // JSON; bisa juga berupa string lama. Selalu render via esc().
            $logMeta = [];
            if (! empty($log['new_data'])) {
                $decodedMeta = json_decode((string) $log['new_data'], true);
                $logMeta     = is_array($decodedMeta) ? $decodedMeta : ['value' => $log['new_data']];
            }
            ?>

            <tr>

                <th style="width:200px;">User</th>

                <td><?= esc($log['full_name'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Role</th>

                <td><?= esc($log['role_name'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Jenis Pemohon</th>

                <td><?= esc($log['applicant_type_name'] ?? '-') ?></td>

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

                <th>Keterangan</th>

                <td><?= esc($logMeta['description'] ?? $logMeta['value'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Email Terkait</th>

                <td><?= esc($logMeta['email'] ?? '-') ?></td>

            </tr>

            <tr>

                <th>Data Lama</th>

                <td><code><?= esc($log['old_data'] ?? '-') ?></code></td>

            </tr>

            <tr>

                <th>Data Baru</th>

                <td><code><?= esc($log['new_data'] ?? '-') ?></code></td>

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