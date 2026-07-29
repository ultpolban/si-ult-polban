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

   <form action="<?= base_url('online/store') ?>" method="post" enctype="multipart/form-data">

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
            <label>Jenis Pemohon</label>

            <select name="applicant_type"
        id="applicant_type"
        class="form-control"
        required>

    <option value="">-- Pilih --</option>

    <option value="Mahasiswa">Mahasiswa</option>
    <option value="Dosen">Dosen</option>
    <option value="Tendik">Tendik</option>
    <option value="Orang Tua">Orang Tua</option>
    <option value="Alumni">Alumni</option>
    <option value="Mitra">Mitra</option>
    <option value="Public">Public</option>
    <option value="Masyarakat">Masyarakat</option>

</select>

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label id="labelNama">
                Nama Pemohon
            </label>

            <input type="text"
                   name="applicant_name"
                   class="form-control"
                   value="<?= old('applicant_name') ?>"
                   required>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="form-group">

            <label id="labelIdentitas">
                NIM / NIP / NIK
            </label>

            <input type="text"
                   name="nim"
                   class="form-control"
                   value="<?= old('nim') ?>">

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="<?= old('email') ?>">

        </div>

    </div>

</div>

<div class="row">

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
<div class="row">

    <div class="col-md-6">

        <div class="form-group">

            <label>Jenis Layanan</label>

            <select name="service_name" class="form-control" required>

                <option value="">-- Pilih Layanan --</option>

                <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>

                <option value="Legalisir Ijazah">Legalisir Ijazah</option>

                <option value="Transkrip Nilai">Transkrip Nilai</option>

                <option value="Beasiswa">Beasiswa</option>

                <option value="Kemahasiswaan">Kemahasiswaan</option>

                <option value="Keuangan">Keuangan</option>

                <option value="UPT TIK">UPT TIK</option>

                <option value="Perpustakaan">Perpustakaan</option>

            </select>

        </div>

    </div>

</div>

<hr>

<div id="formMahasiswa" style="display:none;">

    <div class="row">

        <div class="col-md-6">

            <div class="form-group">

                <label>Program Studi</label>

                <input type="text"
                       name="program_studi"
                       class="form-control">

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label>Jurusan</label>

                <input type="text"
                       name="jurusan"
                       class="form-control">

            </div>

        </div>

    </div>

    <div class="form-group">

        <label>Angkatan</label>

        <input type="number"
               name="angkatan"
               class="form-control">

    </div>

</div>

<div id="formDosen" style="display:none;">

    <div class="row">

        <div class="col-md-6">

            <div class="form-group">

                <label>Program Studi</label>

                <input type="text"
                       name="prodi_dosen"
                       class="form-control">

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label>Jabatan</label>

                <input type="text"
                       name="jabatan_dosen"
                       class="form-control">

            </div>

        </div>

    </div>

</div>

<div id="formTendik" style="display:none;">

    <div class="row">

        <div class="col-md-6">

            <div class="form-group">

                <label>Unit Kerja</label>

                <input type="text"
                       name="unit_kerja"
                       class="form-control">

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label>Jabatan</label>

                <input type="text"
                       name="jabatan_tendik"
                       class="form-control">

            </div>

        </div>

    </div>

</div>

<div id="formMasyarakat" style="display:none;">

    <div class="form-group">

        <label>Alamat</label>

        <textarea
            name="alamat"
            rows="3"
            class="form-control"></textarea>

    </div>

</div>

<div id="formOrangTua" style="display:none;">

<div class="form-group">
<label>Nama Mahasiswa</label>
<input type="text" name="nama_mahasiswa" class="form-control">
</div>

<div class="form-group">
<label>NIM Mahasiswa</label>
<input type="text" name="nim_mahasiswa" class="form-control">
</div>

<div class="form-group">
<label>Hubungan</label>

<select name="hubungan" class="form-control">

<option>Ayah</option>
<option>Ibu</option>
<option>Wali</option>

</select>

</div>

</div>

<div id="formAlumni" style="display:none;">

<div class="form-group">
<label>Program Studi</label>
<input type="text" name="prodi_alumni" class="form-control">
</div>

<div class="form-group">
<label>Tahun Lulus</label>
<input type="number" name="tahun_lulus" class="form-control">
</div>

</div>

<div id="formMitra" style="display:none;">

<div class="form-group">
<label>Nama Instansi</label>
<input type="text" name="instansi" class="form-control">
</div>

<div class="form-group">
<label>Nama PIC</label>
<input type="text" name="pic" class="form-control">
</div>

<div class="form-group">
<label>Jabatan</label>
<input type="text" name="jabatan_mitra" class="form-control">
</div>

</div>

<div id="formPublic" style="display:none;">

<div class="form-group">
<label>Instansi (Opsional)</label>
<input type="text" name="instansi_public" class="form-control">
</div>

<div class="form-group">
<label>Alamat</label>
<textarea name="alamat_public" class="form-control"></textarea>
</div>

</div>

<hr>

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

<script>
document.addEventListener("DOMContentLoaded", function(){

    const jenis = document.getElementById("applicant_type");

    const mahasiswa   = document.getElementById("formMahasiswa");
    const dosen       = document.getElementById("formDosen");
    const tendik      = document.getElementById("formTendik");
    const masyarakat  = document.getElementById("formMasyarakat");
    const orangtua    = document.getElementById("formOrangTua");
    const alumni      = document.getElementById("formAlumni");
    const mitra       = document.getElementById("formMitra");
    const publik      = document.getElementById("formPublic");

    const labelNama = document.getElementById("labelNama");
    const labelIdentitas = document.getElementById("labelIdentitas");

    function resetForm(){

        mahasiswa.style.display="none";
        dosen.style.display="none";
        tendik.style.display="none";
        masyarakat.style.display="none";
        orangtua.style.display="none";
        alumni.style.display="none";
        mitra.style.display="none";
        publik.style.display="none";

    }

    function ubahForm(){

        resetForm();

        switch(jenis.value){

            case "Mahasiswa":

                mahasiswa.style.display="block";
                labelNama.innerHTML="Nama Mahasiswa";
                labelIdentitas.innerHTML="NIM";

            break;

            case "Dosen":

                dosen.style.display="block";
                labelNama.innerHTML="Nama Dosen";
                labelIdentitas.innerHTML="NIP";

            break;

            case "Tendik":

                tendik.style.display="block";
                labelNama.innerHTML="Nama Tendik";
                labelIdentitas.innerHTML="NIP";

            break;

            case "Orang Tua":

                orangtua.style.display="block";
                labelNama.innerHTML="Nama Orang Tua";
                labelIdentitas.innerHTML="NIK";

            break;

            case "Alumni":

                alumni.style.display="block";
                labelNama.innerHTML="Nama Alumni";
                labelIdentitas.innerHTML="NIM";

            break;

            case "Mitra":

                mitra.style.display="block";
                labelNama.innerHTML="Nama Perwakilan Mitra";
                labelIdentitas.innerHTML="NIK / ID";

            break;

            case "Public":

                publik.style.display="block";
                labelNama.innerHTML="Nama Lengkap";
                labelIdentitas.innerHTML="NIK / Paspor";

            break;

            case "Masyarakat":

                masyarakat.style.display="block";
                labelNama.innerHTML="Nama Masyarakat";
                labelIdentitas.innerHTML="NIK";

            break;

            default:

                labelNama.innerHTML="Nama Pemohon";
                labelIdentitas.innerHTML="NIM / NIP / NIK";

        }
    }

    jenis.addEventListener("change", ubahForm);

    ubahForm();

});
</script>

<?= $this->endSection() ?>