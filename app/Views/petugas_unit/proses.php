<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


<div class="card">


<div class="card-header">

<h3 class="card-title">
Proses Tiket
</h3>

</div>



<div class="card-body">


<form method="post"
action="<?= base_url('petugas-unit/update/'.$tiket['id']) ?>"
enctype="multipart/form-data">



<div class="form-group mb-3">

<label>Status</label>


<select name="status" class="form-control">


<option value="Diproses">
Diproses
</option>


<option value="Menunggu Pemohon">
Menunggu Pemohon
</option>


<option value="Selesai">
Selesai
</option>


</select>


</div>




<div class="form-group mb-3">


<label>Catatan</label>


<textarea name="catatan"
class="form-control"
rows="4"></textarea>


</div>




<div class="form-group mb-3">


<label>Upload Hasil</label>


<input type="file"
name="file_hasil"
class="form-control">


</div>




<button type="submit"
class="btn btn-success">

<i class="fas fa-save"></i>
Simpan

</button>



<a href="<?= base_url('petugas-unit') ?>"
class="btn btn-secondary">

Kembali

</a>



</form>



</div>


</div>


</div>


<?= $this->endSection() ?>