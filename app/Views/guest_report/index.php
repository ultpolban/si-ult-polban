<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Laporan Tamu (Walk In)</h1>
    </div>
</div>

<div class="card">

    <div class="card-header">

        <a href="<?= base_url('guest-report/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Laporan
        </a>

    </div>

    <div class="card-body">

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form method="get">

            <div class="row mb-3">

                <div class="col-md-5">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari Nomor Tiket / Nama / NIM"
                        value="<?= $_GET['keyword'] ?? '' ?>">
                </div>

                <div class="col-md-3">

                    <select name="status" class="form-control">

                        <option value="">Semua Status</option>

                        <?php
                        $statusList = [
                            'Submitted',
                            'Verified',
                            'Assigned',
                            'In Progress',
                            'Completed',
                            'Need Revision',
                            'Rejected'
                        ];

                        foreach($statusList as $s):
                        ?>

                        <option value="<?= $s ?>"
                            <?= (($_GET['status'] ?? '') == $s) ? 'selected' : '' ?>>
                            <?= $s ?>
                        </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="<?= base_url('guest-report') ?>" class="btn btn-secondary btn-block">
                        Reset
                    </a>
                </div>

            </div>

        </form>

        <table class="table table-bordered table-striped">

            <thead style="background:#293582;color:#fff;">

                <tr>
                    <th>No</th>
                    <th>No Tiket</th>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="300">Aksi</th>
                </tr>

            </thead>

            <tbody>

            <?php if(empty($tickets)): ?>

                <tr>
                    <td colspan="7" class="text-center">
                        Tidak ada data.
                    </td>
                </tr>

            <?php else: ?>

                <?php
                $no = 1;
                foreach($tickets as $ticket):
                ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td><?= esc($ticket['ticket_number']) ?></td>

                    <td><?= esc($ticket['applicant_name']) ?></td>

                    <td><?= esc($ticket['service_name']) ?></td>

                    <td><?= esc($ticket['status']) ?></td>

                    <td><?= date('d-m-Y H:i', strtotime($ticket['submitted_at'])) ?></td>

                    <td>

                        <a href="<?= base_url('guest-report/detail/'.$ticket['id']) ?>"
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="<?= base_url('verification/detail/'.$ticket['id']) ?>"
                           class="btn btn-success btn-sm">
                            <i class="fas fa-user-check"></i>
                        </a>

                        <a href="<?= base_url('disposition/detail/'.$ticket['id']) ?>"
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-share-square"></i>
                        </a>

                        <a href="<?= base_url('guest-report/edit/'.$ticket['id']) ?>"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a href="<?= base_url('guest-report/delete/'.$ticket['id']) ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus data?')">
                            <i class="fas fa-trash"></i>
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

        <div class="mt-3">
            <?= $pager->links() ?>
        </div>

    </div>

</div>

<?= $this->endSection() ?>