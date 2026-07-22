<?= $this->extend('layouts/template') ?>
<?= $this->section('content'); ?>

<h3>Data Kategori Layanan</h3>

<a href="<?= base_url('kategori/create'); ?>" class="btn btn-primary mb-3">
    Tambah Kategori
</a>

<table class="table table-bordered table-striped">

    <thead class="table-dark">

        <tr>
            <th width="60">No</th>
            <th>Nama Kategori</th>
            <th>Unit Layanan</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th width="170">Aksi</th>
        </tr>

    </thead>

    <tbody>

    <?php if(empty($kategori)): ?>

        <tr>
            <td colspan="6" class="text-center">
                Belum ada data kategori.
            </td>
        </tr>

    <?php else: ?>

        <?php $no=1; ?>

        <?php foreach($kategori as $k): ?>

        <tr>

            <td><?= $no++; ?></td>

            <td><?= esc($k['nama_kategori']); ?></td>

            <td><?= esc($k['nama_unit']); ?></td>

            <td><?= esc($k['deskripsi']); ?></td>

            <td><?= esc($k['status']); ?></td>

            <td>

                <a href="<?= base_url('kategori/edit/'.$k['id']); ?>"
                class="btn btn-warning btn-sm">

                    Edit

                </a>

                <a href="<?= base_url('kategori/delete/'.$k['id']); ?>"
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