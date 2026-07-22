<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


<h3>
Tambah Persyaratan Layanan
</h3>


<hr>



<form action="<?= base_url('persyaratan/store') ?>"
method="post">


<?= csrf_field(); ?>



<div class="mb-3">


<label class="form-label">
Layanan
</label>


<select name="layanan_id"
class="form-control"
required>


<option value="">
-- Pilih Layanan --
</option>


<?php foreach($layanan as $l): ?>


<option value="<?= $l['id'] ?>">

<?= $l['nama_layanan']; ?>

</option>


<?php endforeach; ?>


</select>


</div>





<div class="mb-3">


<label class="form-label">

Nama Persyaratan

</label>


<input type="text"
name="nama_persyaratan"
class="form-control"
required>


</div>





<div class="mb-3">


<label class="form-label">

Keterangan

</label>


<textarea name="keterangan"
class="form-control"></textarea>


</div>





<div class="mb-3">


<label class="form-label">

Status

</label>


<select name="status"
class="form-control">


<option value="Aktif">
Aktif
</option>


<option value="Tidak Aktif">
Tidak Aktif
</option>


</select>


</div>





<button type="submit"
class="btn btn-primary">

Simpan

</button>


<a href="<?= base_url('persyaratan') ?>"
class="btn btn-secondary">

Kembali

</a>



</form>



</div>


<?= $this->endSection() ?>