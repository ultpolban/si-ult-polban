<?= $this->extend('layouts/template') ?>


<?= $this->section('content') ?>



<h3 class="fw-bold mb-4">

Dashboard Unit Layanan

</h3>




<div class="row g-4">



<div class="col-md-3">

<div class="stat-card bg-primary">


<h2>

<?= $total ?>

</h2>


<p>

Total Tiket

</p>


<i class="fas fa-ticket"></i>


</div>

</div>





<div class="col-md-3">


<div class="stat-card bg-warning">


<h2>

<?= $menunggu ?>

</h2>


<p>

Menunggu

</p>


<i class="fas fa-clock"></i>


</div>


</div>






<div class="col-md-3">


<div class="stat-card bg-info">


<h2>

<?= $diproses ?>

</h2>


<p>

Diproses

</p>


<i class="fas fa-spinner"></i>


</div>


</div>






<div class="col-md-3">


<div class="stat-card bg-success">


<h2>

<?= $selesai ?>

</h2>


<p>

Selesai

</p>


<i class="fas fa-check"></i>


</div>


</div>



</div>






<div class="card mt-4">


<div class="card-header bg-white">


<h5 class="fw-bold mb-0">

Tiket Terbaru

</h5>


</div>



<div class="card-body">



<div class="table-responsive">


<table class="table table-hover">


<thead>

<tr>

<th>No Tiket</th>

<th>Judul</th>

<th>Status</th>

<th>Aksi</th>


</tr>


</thead>



<tbody>



<?php foreach($tiket as $t): ?>

<tr>


<td>

<?= $t['no_tiket'] ?>

</td>



<td>

<?= $t['judul'] ?>

</td>




<td>


<?php


$badge="secondary";


if($t['status']=="Menunggu")
$badge="warning";


elseif($t['status']=="Diproses")
$badge="primary";


elseif($t['status']=="Selesai")
$badge="success";


elseif($t['status']=="Ditolak")
$badge="danger";


?>


<span class="badge bg-<?= $badge ?>">

<?= $t['status'] ?>

</span>


</td>



<td>


<a href="<?= base_url('unit-layanan/detail/'.$t['id']) ?>"
class="btn btn-primary btn-sm">


<i class="fas fa-eye"></i>

Detail


</a>


</td>



</tr>


<?php endforeach; ?>



</tbody>


</table>


</div>


</div>


</div>




<?= $this->endSection() ?>