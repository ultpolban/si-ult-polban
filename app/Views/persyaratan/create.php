<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<h3>
Tambah Persyaratan Layanan
</h3>



<form action="<?=base_url('persyaratan/store')?>"
method="post">


<?= csrf_field() ?>


<div class="mb-3">

<label>
Layanan
</label>


<select name="layanan_id"
class="form-control">


<option>
-- pilih layanan --
</option>


<?php foreach($layanan as $l): ?>


<option value="<?=$l['id']?>">

<?=$l['nama_layanan']?>

</option>


<?php endforeach ?>


</select>

</div>




<div class="mb-3">

<label>
Nama Persyaratan
</label>


<input type="text"
name="nama_persyaratan"
class="form-control"
placeholder="Contoh : Scan KTP">


</div>





<div class="mb-3">

<label>
Keterangan
</label>


<textarea 
name="keterangan"
class="form-control">

</textarea>


</div>




<div class="mb-3">

<label>
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




<button class="btn btn-success">

Simpan

</button>


</form>


<?= $this->endSection() ?>