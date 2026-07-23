<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">

        <h1>Edit Laporan Tamu</h1>

    </div>
</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            <?= esc($ticket['ticket_number']) ?>
        </h3>

    </div>

    <form action="<?= base_url('guest-report/update/'.$ticket['id']) ?>" method="post" enctype="multipart/form-data">

        <?= csrf_field() ?>

        <div class="card-body">

            <div class="form-group">
                <label>Nama Pemohon</label>
                <input type="text" name="applicant_name" class="form-control"
                    value="<?= esc($ticket['applicant_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Jenis Pemohon</label>

                <select name="applicant_type" class="form-control">

                    <option value="Mahasiswa"
                        <?= $ticket['applicant_type']=='Mahasiswa'?'selected':'' ?>>
                        Mahasiswa
                    </option>

                    <option value="Dosen"
                        <?= $ticket['applicant_type']=='Dosen'?'selected':'' ?>>
                        Dosen
                    </option>

                    <option value="Tendik"
                        <?= $ticket['applicant_type']=='Tendik'?'selected':'' ?>>
                        Tendik
                    </option>

                    <option value="Masyarakat"
                        <?= $ticket['applicant_type']=='Masyarakat'?'selected':'' ?>>
                        Masyarakat
                    </option>

                </select>

            </div>

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" class="form-control"
                    value="<?= esc($ticket['nim']) ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= esc($ticket['email']) ?>">
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="phone" class="form-control"
                    value="<?= esc($ticket['phone']) ?>">
            </div>

            <div class="form-group">
                <label>Layanan</label>
                <input type="text" name="service_name" class="form-control"
                    value="<?= esc($ticket['service_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Judul Tiket</label>
                <input type="text" name="ticket_title" class="form-control"
                    value="<?= esc($ticket['ticket_title']) ?>" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>

                <textarea name="ticket_description"
                    class="form-control"
                    rows="5"
                    required><?= esc($ticket['ticket_description']) ?></textarea>

            </div>

            <div class="form-group">

                <label>Ganti Lampiran (Opsional)</label>

                <input type="file"
                    name="attachment"
                    class="form-control">

            </div>

            <?php if(!empty($ticket['attachment'])): ?>

            <div class="form-group">

                <label>Lampiran Saat Ini</label><br>

                <a href="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                    target="_blank">

                    <?= esc($ticket['attachment']) ?>

                </a>

            </div>

            <?php endif; ?>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan Perubahan

            </button>

            <a href="<?= base_url('guest-report') ?>"
                class="btn btn-secondary">

                Batal

            </a>

        </div>

    </form>

</div>

<?= $this->endSection() ?>