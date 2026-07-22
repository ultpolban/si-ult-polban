<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


<h2>
Tambah Persyaratan Layanan
</h2>


<form action="<?= base_url('persyaratan/store') ?>" method="post">


<?= csrf_field() ?>



<div class="mb-3">

<label>
Layanan
</label>


<select name="layanan_id" class="form-control">


<option value="">
-- Pilih Layanan --
</option>


<?php foreach($layanan as $l): ?>

<option value="<?= $l['id'] ?>">

<?= $l['nama_layanan'] ?>

</option>


<?php endforeach; ?>


</select>


</div>





<div class="mb-3">

<label>
Nama Persyaratan
</label>


<input 
type="text"
name="nama_persyaratan"
class="form-control"
required>


</div>





<div class="mb-3">


<label>
Keterangan
</label>


<textarea
name="keterangan"
class="form-control"
rows="4"></textarea>


</div>





<div class="mb-3">


<label>
Status
</label>


<select name="status" class="form-control">


<option value="Aktif">
Aktif
</option>


<option value="Tidak Aktif">
Tidak Aktif
</option>


</select>


</div>




<button class="btn btn-primary">

Simpan

</button>



<a href="<?= base_url('persyaratan') ?>"
class="btn btn-secondary">

Kembali

</a>



</form>



</div>


<?= $this->endSection() ?>