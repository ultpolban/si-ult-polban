<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


<h3>
    Data Persyaratan Layanan
</h3>


<hr>


<a href="<?= base_url('persyaratan/create') ?>"
class="btn btn-primary mb-3">

Tambah Persyaratan

</a>



<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>No</th>
<th>Layanan</th>
<th>Nama Persyaratan</th>
<th>Keterangan</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>


<tbody>


<?php if(!empty($persyaratan)): ?>

<?php $no = 1; ?>

<?php foreach($persyaratan as $p): ?>


<tr>

<td>
<?= $no++ ?>
</td>


<td>
<?= $p['nama_layanan']; ?>
</td>


<td>
<?= $p['nama_persyaratan']; ?>
</td>


<td>
<?= $p['keterangan']; ?>
</td>


<td>

<?php if($p['status']=="Aktif"): ?>

<span class="badge bg-success">
Aktif
</span>

<?php else: ?>

<span class="badge bg-danger">
Tidak Aktif
</span>

<?php endif; ?>


</td>


<td>


<a href="<?= base_url('persyaratan/edit/'.$p['id']) ?>"
class="btn btn-warning btn-sm">

Edit

</a>



<a href="<?= base_url('persyaratan/delete/'.$p['id']) ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>


</td>


</tr>



<?php endforeach; ?>


<?php else: ?>


<tr>

<td colspan="6" class="text-center">

Belum ada data persyaratan

</td>

</tr>


<?php endif; ?>


</tbody>


</table>



</div>


<?= $this->endSection() ?>