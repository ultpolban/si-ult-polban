<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container">


<h3>
Persyaratan Layanan
</h3>


<a href="<?=base_url('persyaratan/create')?>"
class="btn btn-primary mb-3">

Tambah Persyaratan

</a>



<table class="table table-bordered">


<tr>

<th>No</th>
<th>Layanan</th>
<th>Persyaratan</th>
<th>Keterangan</th>
<th>Status</th>
<th>Aksi</th>

</tr>



<?php $no=1; ?>


<?php foreach($persyaratan as $p): ?>


<tr>


<td>
<?= $no++ ?>
</td>


<td>
<?= $p['nama_layanan'] ?>
</td>


<td>
<?= $p['nama_persyaratan'] ?>
</td>


<td>
<?= $p['keterangan'] ?>
</td>


<td>
<?= $p['status'] ?>
</td>



<td>


<a href="<?=base_url('persyaratan/edit/'.$p['id'])?>"
class="btn btn-warning btn-sm">

Edit

</a>



<a href="<?=base_url('persyaratan/delete/'.$p['id'])?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>


</td>


</tr>


<?php endforeach ?>


</table>


</div>


<?= $this->endSection() ?>