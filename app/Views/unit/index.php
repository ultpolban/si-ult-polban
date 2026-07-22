<?= $this->extend('layouts/template') ?>
<?= $this->section('content'); ?>

<h3>Data Unit Layanan</h3>

<a href="<?= base_url('unit/create'); ?>" class="btn btn-primary mb-3">
    Tambah Unit
</a>


<table class="table table-bordered table-striped">

    <thead class="table-dark">

        <tr>
            <th width="60">No</th>
            <th>Nama Unit</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th width="170">Aksi</th>
        </tr>

    </thead>


    <tbody>


    <?php if(empty($unit)): ?>

        <tr>
            <td colspan="5" class="text-center">
                Belum ada data unit.
            </td>
        </tr>


    <?php else: ?>


        <?php $no=1; ?>


        <?php foreach($unit as $u): ?>


        <tr>

            <td><?= $no++; ?></td>


            <td>
                <?= esc($u['nama_unit']); ?>
            </td>


            <td>
                <?= esc($u['deskripsi']); ?>
            </td>


            <td>
                <?= esc($u['status']); ?>
            </td>


            <td>


                <a href="<?= base_url('unit/edit/'.$u['id']); ?>"
                class="btn btn-warning btn-sm">

                    Edit

                </a>


                <a href="<?= base_url('unit/delete/'.$u['id']); ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin hapus data?')">

                    Hapus

                </a>


            </td>


        </tr>


        <?php endforeach; ?>


    <?php endif; ?>


    </tbody>


</table>


<?= $this->endSection(); ?>