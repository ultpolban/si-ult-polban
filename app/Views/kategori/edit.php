<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<h2>Edit Kategori Layanan</h2>

<hr>

<form action="<?= base_url('kategori/update/'.$kategori['id']) ?>" method="post">

    <?= csrf_field(); ?>

    <div class="mb-3">

        <label class="form-label">Unit Kerja</label>

        <select name="unit_id" class="form-select" required>

            <?php foreach($unit as $u): ?>

                <option
                    value="<?= $u['id']; ?>"
                    <?= ($kategori['unit_id']==$u['id']) ? 'selected' : ''; ?>>

                    <?= $u['nama_unit']; ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">Nama Kategori</label>

        <input
            type="text"
            name="nama_kategori"
            class="form-control"
            value="<?= $kategori['nama_kategori']; ?>"
            required>

    </div>

    <div class="mb-3">

        <label class="form-label">Deskripsi</label>

        <textarea
            name="deskripsi"
            class="form-control"
            rows="4"><?= $kategori['deskripsi']; ?></textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">Status</label>

        <select name="status" class="form-select">

            <option value="Aktif"
                <?= ($kategori['status']=='Aktif') ? 'selected' : ''; ?>>
                Aktif
            </option>

            <option value="Nonaktif"
                <?= ($kategori['status']=='Nonaktif') ? 'selected' : ''; ?>>
                Nonaktif
            </option>

        </select>

    </div>

    <button type="submit" class="btn btn-primary">
        Update
    </button>

    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
        Kembali
    </a>

</form>

<?= $this->endSection() ?>