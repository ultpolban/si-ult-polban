<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Tambah Laporan Tamu (Walk In)</h1>
    </div>
</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Form Laporan Tamu</h3>
    </div>

    <form action="<?= base_url('guest-report/store') ?>" method="post" enctype="multipart/form-data">

        <?= csrf_field() ?>

        <div class="card-body">

            <?php if(session()->getFlashdata('errors')): ?>

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        <?php foreach(session()->getFlashdata('errors') as $error): ?>

                            <li><?= esc($error) ?></li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>

            <?php if(session()->getFlashdata('success')): ?>

                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>

            <?php endif; ?>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label>Nama Pemohon</label>
                        <input type="text"
                               name="applicant_name"
                               class="form-control"
                               value="<?= old('applicant_name') ?>"
                               required>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Jenis Pemohon</label>

                        <select name="applicant_type" class="form-control" required>

                            <option value="">-- Pilih --</option>
                            <option>Mahasiswa</option>
                            <option>Dosen</option>
                            <option>Tendik</option>
                            <option>Masyarakat</option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label>NIM / NIP</label>
                        <input type="text"
                               name="nim"
                               class="form-control"
                               value="<?= old('nim') ?>">
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="<?= old('phone') ?>">
                    </div>

                </div>

            </div>

            <div class="form-group">
                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="<?= old('email') ?>">
            </div>

            <div class="form-group">

                <label>Jenis Layanan</label>

                <input type="text"
                       name="service_name"
                       class="form-control"
                       value="<?= old('service_name') ?>"
                       required>

            </div>

            <div class="form-group">

                <label>Judul Tiket</label>

                <input type="text"
                       name="ticket_title"
                       class="form-control"
                       value="<?= old('ticket_title') ?>"
                       required>

            </div>

            <div class="form-group">

                <label>Deskripsi</label>

                <textarea name="ticket_description"
                          class="form-control"
                          rows="5"
                          required><?= old('ticket_description') ?></textarea>

            </div>

            <div class="form-group">

                <label>Lampiran (PDF/JPG/PNG maks.5MB)</label>

                <input type="file"
                       name="attachment"
                       class="form-control">

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <button type="reset" class="btn btn-warning">

                <i class="fas fa-redo"></i>

                Reset

            </button>

            <a href="<?= base_url('guest-report') ?>" class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </form>

</div>

<?= $this->endSection() ?>