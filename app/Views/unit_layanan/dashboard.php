<?= $this->extend('layouts/template') ?>


<?= $this->section('content') ?>


<div class="container-fluid">


<h3 class="mb-4">
Dashboard Unit Layanan
</h3>



<div class="row">


<div class="col-md-3">

<div class="small-box bg-primary">

<div class="inner">

<h3>
<?= $total ?>
</h3>

<p>
Total Tiket
</p>

</div>

</div>

</div>





<div class="col-md-3">

<div class="small-box bg-warning">

<div class="inner">

<h3>
<?= $menunggu ?>
</h3>

<p>
Menunggu
</p>

</div>

</div>

</div>







<div class="col-md-3">

<div class="small-box bg-info">

<div class="inner">

<h3>
<?= $diproses ?>
</h3>

<p>
Diproses
</p>

</div>

</div>

</div>







<div class="col-md-3">

<div class="small-box bg-success">

<div class="inner">

<h3>
<?= $selesai ?>
</h3>

<p>
Selesai
</p>

</div>

</div>

</div>



</div>







<div class="card">



<div class="card-header">

<h5>
Tiket Terbaru
</h5>

</div>





<div class="card-body">



<table class="table table-bordered">



<thead>


<tr>

<th>No Tiket</th>

<th>Judul Pengajuan</th>

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


<?= $t['no_tiket'] ?>

 -
 
<b>
<?= $t['judul'] ?>
</b>


</td>





<td>



<?php

$warna = 'secondary';


if($t['status']=='Menunggu')
{
    $warna='warning';
}


elseif($t['status']=='Diproses')
{
    $warna='primary';
}


elseif($t['status']=='Selesai')
{
    $warna='success';
}


elseif($t['status']=='Ditolak')
{
    $warna='danger';
}


?>



<span class="badge bg-<?= $warna ?>">


<?= $t['status'] ?>


</span>



</td>







<td>



<a href="<?= base_url('unit-layanan/detail/'.$t['id']) ?>"
class="btn btn-primary btn-sm">


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