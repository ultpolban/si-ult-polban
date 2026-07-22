<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <h2>Edit Layanan</h2>

    <hr>

    <form action="<?= base_url('layanan/update/' . $layanan['id']) ?>" method="post">

        <?= csrf_field(); ?>

        <!-- UNIT KERJA -->
        <div class="mb-3">

            <label class="form-label">Unit Kerja</label>

<select
id="unit_id"
name="unit_id"
class="form-select">

                <option value="">-- Pilih Unit Kerja --</option>

                <?php foreach($unit as $u): ?>

                    <option
                        value="<?= $u['id']; ?>"
                        <?= ($u['id'] == $layanan['unit_id']) ? 'selected' : ''; ?>>

                        <?= esc($u['nama_unit']); ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- KATEGORI -->
        <div class="mb-3">

            <label class="form-label">Kategori Layanan</label>

            <select

id="kategori_id"
name="kategori_id"
class="form-select">

                <?php foreach($kategori as $k): ?>

                    <option
                        value="<?= $k['id']; ?>"
                        <?= ($k['id'] == $layanan['kategori_id']) ? 'selected' : ''; ?>>

                        <?= esc($k['nama_kategori']); ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- NAMA LAYANAN -->
        <div class="mb-3">

            <label class="form-label">Nama Layanan</label>

            <input
                type="text"
                name="nama_layanan"
                class="form-control"
                value="<?= esc($layanan['nama_layanan']); ?>"
                required>

        </div>

        <!-- DESKRIPSI -->
        <div class="mb-3">

            <label class="form-label">Deskripsi</label>

            <textarea
                name="deskripsi"
                class="form-control"
                rows="4"><?= esc($layanan['deskripsi']); ?></textarea>

        </div>

        <!-- STATUS -->
        <div class="mb-3">

            <label class="form-label">Status</label>

            <select
                name="status"
                class="form-select">

                <option value="Aktif"
                    <?= ($layanan['status'] == 'Aktif') ? 'selected' : ''; ?>>
                    Aktif
                </option>

                <option value="Nonaktif"
                    <?= ($layanan['status'] == 'Nonaktif') ? 'selected' : ''; ?>>
                    Nonaktif
                </option>

            </select>

        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="<?= base_url('layanan') ?>" class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>

<script>

document.getElementById('unit_id').addEventListener('change', function () {

    let unit_id = this.value;

    fetch("<?= base_url('layanan/getKategori') ?>?unit_id=" + unit_id)

    .then(response => response.json())

    .then(data => {

        let kategori = document.getElementById('kategori_id');

        kategori.innerHTML = '<option value="">-- Pilih Kategori --</option>';

        data.forEach(function(item){

            kategori.innerHTML +=
            `<option value="${item.id}">
                ${item.nama_kategori}
            </option>`;

        });

    });

});

</script>

<?= $this->endSection() ?>