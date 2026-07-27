<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


<div class="card">


<div class="card-header">

<h3 class="card-title">
Detail Tiket
</h3>

</div>



<div class="card-body">


<div class="row">


<div class="col-md-6">


<table class="table table-borderless">


<tr>
    <th width="150">
        No Tiket
    </th>

    <td>
        :
        <?= $tiket['no_tiket'] ?>
    </td>
</tr>


<tr>
    <th>
        Tanggal Masuk
    </th>

    <td>
        :
        <?= $tiket['created_at'] ?>
    </td>
</tr>


</table>


</div>


</div>




<hr>



<h5>
Pemohon
</h5>


<table class="table table-borderless">


<tr>

<th width="150">
Nama
</th>

<td>
:
<?= $tiket['nama_pemohon'] ?>
</td>

</tr>


<tr>

<th>
NIM
</th>

<td>
:
<?= $tiket['nim'] ?>
</td>

</tr>


<tr>

<th>
Email
</th>

<td>
:
<?= $tiket['email'] ?>
</td>

</tr>


</table>




<hr>




<h5>
Layanan
</h5>


<table class="table table-borderless">


<tr>

<th width="150">
Kategori
</th>

<td>
:
<?= $tiket['nama_kategori'] ?>
</td>

</tr>


<tr>

<th>
Layanan
</th>

<td>
:
<?= $tiket['nama_layanan'] ?>
</td>

</tr>


</table>




<hr>




<h5>
Deskripsi
</h5>


<div class="border rounded p-3">

<?= $tiket['deskripsi'] ?>

</div>




<br>




<h5>
Persyaratan
</h5>


<ul>


<?php foreach($persyaratan as $p): ?>


<li>

✓ <?= $p['nama_persyaratan'] ?>

</li>


<?php endforeach; ?>


</ul>




<hr>




<h5>
Status
</h5>


<?php if($tiket['status']=="Selesai"): ?>


<span class="badge bg-success">
Selesai
</span>


<?php elseif($tiket['status']=="Diproses"): ?>


<span class="badge bg-warning">
Diproses
</span>


<?php else: ?>


<span class="badge bg-secondary">
<?= $tiket['status'] ?>
</span>


<?php endif; ?>




<br><br>



<a href="<?= base_url('petugas-unit') ?>"
class="btn btn-secondary">

Kembali

</a>



</div>


</div>


</div>


<?= $this->endSection() ?>