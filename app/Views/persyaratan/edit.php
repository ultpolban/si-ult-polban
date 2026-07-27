<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container">


<h3>
Edit Persyaratan
</h3>



<form method="post"
action="<?=base_url('persyaratan/update/'.$persyaratan['id'])?>">



<div class="mb-3">

<label>
Layanan
</label>


<select name="layanan_id"
class="form-control">


<?php foreach($layanan as $l): ?>


<option value="<?= $l['id'] ?>"
<?= $l['id']==$persyaratan['layanan_id']?'selected':'' ?> >

<?= $l['nama_layanan'] ?>

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
value="<?= $persyaratan['nama_persyaratan'] ?>">


</div>




<div class="mb-3">

<label>
Keterangan
</label>


<textarea name="keterangan"
class="form-control"><?= $persyaratan['keterangan'] ?></textarea>


</div>




<div class="mb-3">

<label>
Status
</label>


<select name="status"
class="form-control">


<option value="Aktif"
<?= $persyaratan['status']=='Aktif'?'selected':'' ?>>
Aktif
</option>


<option value="Tidak Aktif"
<?= $persyaratan['status']=='Tidak Aktif'?'selected':'' ?>>
Tidak Aktif
</option>


</select>


</div>




<button class="btn btn-success">

Simpan

</button>


<a href="<?=base_url('persyaratan')?>"
class="btn btn-secondary">

Kembali

</a>


</form>


</div>


<?= $this->endSection() ?>