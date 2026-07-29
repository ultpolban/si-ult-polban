<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">

        <h2 class="mb-2">
            Pengajuan Layanan Online
        </h2>

        <p class="text-muted">
            Silakan isi formulir berikut untuk mengajukan layanan secara online.
        </p>

    </div>
</div>

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">
            Form Pengajuan Online
        </h3>

    </div>

    <form action="<?= base_url('online/store') ?>" method="post" enctype="multipart/form-data">

        <?= csrf_field() ?>

        <div class="card-body">

            <div class="form-group">

                <label>Jenis Pemohon</label>

                <select
                    name="applicant_type"
                    id="applicant_type"
                    class="form-control"
                    required>

                    <option value="">-- Pilih --</option>

                    <option>Mahasiswa</option>
                    <option>Dosen</option>
                    <option>Tendik</option>
                    <option>Orang Tua</option>
                    <option>Alumni</option>
                    <option>Mitra</option>
                    <option>Public</option>
                    <option>Masyarakat</option>

                </select>

            </div>

           <div class="form-group">

    <label>Nama Lengkap</label>

    <input
        type="text"
        name="applicant_name"
        class="form-control"
        required>

</div>

<div class="form-group">

    <label>NIM / NIP / NIK</label>

    <input
        type="text"
        name="nim"
        class="form-control"
        required>

</div>

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    required>

            </div>

            <div class="form-group">

                <label>No HP</label>

                <input
                    type="text"
                    name="phone"
                    class="form-control">

            </div>

            <div class="form-group">

                <label>Layanan</label>

                <select
                    name="service_name"
                    class="form-control"
                    required>

                    <option value="">Pilih Layanan</option>

                    <option>Surat Aktif Kuliah</option>
                    <option>Legalisir</option>
                    <option>Pengaduan</option>
                    <option>Informasi Akademik</option>
                    <option>Layanan Administrasi</option>

                </select>

            </div>

            <div class="form-group">

                <label>Judul Tiket</label>

                <input
                    type="text"
                    name="ticket_title"
                    class="form-control"
                    required>

            </div>

            <div class="form-group">

                <label>Deskripsi</label>

                <textarea
                    name="ticket_description"
                    rows="5"
                    class="form-control"
                    required></textarea>

            </div>

            <div class="form-group">

                <label>Lampiran</label>

                <input
                    type="file"
                    name="attachment"
                    class="form-control">

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                <i class="fas fa-paper-plane"></i>

                Kirim Pengajuan

            </button>

        </div>

    </form>

</div>

<?= $this->endSection() ?>