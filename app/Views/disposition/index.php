<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Disposisi Tiket</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Pemohon</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php if (empty($tickets)): ?>

                <tr>
                    <td colspan="6" class="text-center">
                        Tidak ada tiket yang perlu didisposisikan.
                    </td>
                </tr>

            <?php else: ?>

                <?php $no = 1; ?>
                <?php foreach ($tickets as $ticket): ?>

                    <tr>
                        <td><?= $no++ ?></td>

                        <td><?= esc($ticket['ticket_number']) ?></td>

                        <td><?= esc($ticket['applicant_name']) ?></td>

                        <td><?= esc($ticket['service_name']) ?></td>

                        <td>
                            <span class="badge badge-success">
                                <?= esc($ticket['status']) ?>
                            </span>
                        </td>

<!-- DETAIL TIKET -->
<td class="text-nowrap">

    <a href="<?= base_url('verification/detail/' . $ticket['id']) ?>"
       class="btn btn-info btn-sm mr-1">
        <i class="fas fa-eye"></i> Detail Tiket
    </a>

    <a href="<?= base_url('disposition/detail/' . $ticket['id']) ?>"
       class="btn btn-primary btn-sm">
        <i class="fas fa-share"></i> Disposisi
    </a>

</td>
                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>