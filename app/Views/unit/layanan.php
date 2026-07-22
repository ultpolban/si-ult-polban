<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <h2>Layanan Unit Kerja : <?= esc($unit['nama_unit']) ?></h2>

    <hr>

<div class="mb-3">

    <a href="<?= base_url('unit') ?>" class="btn btn-secondary">
        ← Kembali
    </a>

    <a href="<?= base_url('layanan/create/'.$unit['id']) ?>" class="btn btn-success">
        + Tambah Layanan
    </a>

</div>

    <?php if(session()->getFlashdata('success')): ?>

        <div class="alert alert-success">

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif; ?>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

                <th width="5%">No</th>

                <th>Nama Layanan</th>

                <th>Deskripsi</th>

                <th>Status</th>

                <th width="220">Aksi</th>

            </tr>

        </thead>

        <tbody>

        <?php if(!empty($layanan)): ?>

            <?php $no=1; ?>

            <?php foreach($layanan as $l): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= esc($l['nama_layanan']) ?></td>

                <td><?= esc($l['deskripsi']) ?></td>

                <td>

                    <?php if($l['status']=='Aktif'): ?>

                        <span class="badge bg-success">

                            Aktif

                        </span>

                    <?php else: ?>

                        <span class="badge bg-danger">

                            Nonaktif

                        </span>

                    <?php endif; ?>

                </td>

                <td>


                    <a href="<?= base_url('layanan/edit/'.$l['id']) ?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="<?= base_url('layanan/delete/'.$l['id']) ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin ingin menghapus?')">
                        Hapus
                    </a>

                </td>

            </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="5" class="text-center">

                    Belum ada layanan.

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

<?= $this->endSection() ?>