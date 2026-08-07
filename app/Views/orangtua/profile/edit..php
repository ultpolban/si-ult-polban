<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 style="font-weight:700;color:#0b3d91;">
                    <i class="fas fa-user-edit mr-2"></i>
                    Edit Profil
                </h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard-orangtua') ?>">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="<?= base_url('orangtua/profile') ?>">
                            Profil
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit
                    </li>

                </ol>

            </div>

        </div>

    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow-sm"
style="border-top:5px solid #0b3d91;border-radius:15px;">

<div class="card-header"
style="
background:#0b3d91;
color:white;
">

<h4 class="mb-0">

<i class="fas fa-id-card mr-2"></i>

Form Edit Profil Orang Tua

</h4>

</div>

<div class="card-body">

<form action="#" method="post">

<?= csrf_field() ?>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Lengkap</label>

<input
type="text"
class="form-control"
value="Budi Santoso">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>NIK</label>

<input
type="text"
class="form-control"
value="3273010101040001">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input
type="email"
class="form-control"
value="budi@gmail.com">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Nomor HP</label>

<input
type="text"
class="form-control"
value="081234567890">

</div>

</div>
<div class="col-md-12">

    <div class="form-group">

        <label>Alamat</label>

        <textarea
            class="form-control"
            rows="3">Jl. Babakan Radio No. 12, Bandung</textarea>

    </div>

</div>

<div class="col-md-6">

    <div class="form-group">

        <label>Hubungan dengan Mahasiswa</label>

        <select class="form-control">

            <option selected>Ayah</option>
            <option>Ibu</option>
            <option>Wali</option>

        </select>

    </div>

</div>

<div class="col-md-6">

    <div class="form-group">

        <label>Foto Profil</label>

        <div class="custom-file">

            <input
                type="file"
                class="custom-file-input"
                id="foto">

            <label
                class="custom-file-label"
                for="foto">

                Pilih Foto...

            </label>

        </div>

        <small class="text-muted">

            Format JPG, JPEG atau PNG.
            Maksimal 2 MB.

        </small>

    </div>

</div>

<div class="col-md-6">

    <div class="form-group">

        <label>Password Baru</label>

        <input
            type="password"
            class="form-control"
            placeholder="Kosongkan jika tidak diubah">

    </div>

</div>

<div class="col-md-6">

    <div class="form-group">

        <label>Konfirmasi Password</label>

        <input
            type="password"
            class="form-control"
            placeholder="Ulangi password baru">

    </div>

</div>

</div>

<hr>

<div class="d-flex justify-content-between">

    <a
        href="<?= base_url('orangtua/profile') ?>"
        class="btn btn-secondary">

        <i class="fas fa-arrow-left mr-2"></i>

        Batal

    </a>

    <button
        type="submit"
        class="btn"
        style="
            background:#0b3d91;
            color:white;
            font-weight:600;
        ">

        <i class="fas fa-save mr-2"></i>

        Simpan Perubahan

    </button>

</div>

</form>

</div>

</div>

</div>

</section>

</div>

<script>
document.querySelector('.custom-file-input').addEventListener('change', function(e){

    this.nextElementSibling.innerHTML = e.target.files[0].name;

});
</script>

<?= $this->include('layouts/footer') ?>