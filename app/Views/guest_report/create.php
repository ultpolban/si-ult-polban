<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">
            Form Laporan Tamu (Walk In)
        </h3>
    </div>
<form action="<?= base_url('guest-report/store') ?>"
      method="post"
      enctype="multipart/form-data">
    

        <?= csrf_field() ?>

        <div class="card-body">

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>

            <!-- Jenis Pemohon -->
            <div class="form-group">
                <label>Jenis Pemohon <span class="text-danger">*</span></label>

                <select name="applicant_type"
                        id="applicant_type"
                        class="form-control"
                        required>

                    <option value="">-- Pilih Jenis Pemohon --</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                    <option value="Orang Tua/Wali">Orang Tua / Wali</option>
                    <option value="Alumni">Alumni</option>
                    <option value="Masyarakat Umum">Masyarakat Umum</option>
                    <option value="Instansi/Lembaga">Instansi / Lembaga</option>
                    <option value="Lainnya">Lainnya</option>

                </select>
            </div>

            <!-- Nama -->
            <div class="form-group">
                <label>Nama Pemohon <span class="text-danger">*</span></label>

                <input type="text"
                       name="applicant_name"
                       class="form-control"
                       required>
            </div>

            <!-- NIM -->
            <div class="form-group" id="nimField" style="display:none;">
                <label>NIM</label>

                <input type="text"
                       name="nim"
                       id="nim"
                       class="form-control"
                       placeholder="Masukkan NIM">
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-control">
            </div>

            <!-- No HP -->
            <div class="form-group">
                <label>No HP</label>

                <input type="text"
                       name="phone"
                       class="form-control">
            </div>

            <!-- Layanan -->
            <div class="form-group">
                <label>Jenis Layanan <span class="text-danger">*</span></label>

                <select name="service_name"
                        class="form-control"
                        required>

                    <option value="">-- Pilih Layanan --</option>
                    <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
                    <option value="Legalisir Ijazah">Legalisir Ijazah</option>
                    <option value="Beasiswa">Beasiswa</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="Kemahasiswaan">Kemahasiswaan</option>
                    <option value="Lainnya">Lainnya</option>

                </select>
            </div>

            <!-- Judul -->
            <div class="form-group">
                <label>Judul Laporan <span class="text-danger">*</span></label>

                <input type="text"
                       name="ticket_title"
                       class="form-control"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="form-group">
                <label>Deskripsi <span class="text-danger">*</span></label>

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
            class="form-control"
            accept=".pdf,.jpg,.jpeg,.png">

            <small class="text-muted">

            PDF / JPG / PNG

            </small>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Simpan Laporan
            </button>

            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </form>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const applicantType = document.getElementById("applicant_type");
    const nimField = document.getElementById("nimField");
    const nimInput = document.getElementById("nim");

    applicantType.addEventListener("change", function () {

        if (this.value === "Mahasiswa") {
            nimField.style.display = "block";
            nimInput.setAttribute("required", "required");
        } else {
            nimField.style.display = "none";
            nimInput.removeAttribute("required");
            nimInput.value = "";
        }

    });

});
</script>

<?= $this->endSection() ?>