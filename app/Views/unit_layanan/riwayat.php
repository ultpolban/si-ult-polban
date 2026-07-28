<!DOCTYPE html>
<html>

<head>

<title>
<?= $title ?>
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet">

</head>


<body>


<div class="container mt-4">


<h3>
Riwayat Tiket Unit Layanan
</h3>


<table class="table table-bordered">


<tr>

<th>No Tiket</th>

<th>Judul</th>

<th>Status</th>

<th>Dokumen</th>

</tr>



<?php foreach($tiket as $t): ?>


<tr>


<td>
<?= $t['no_tiket'] ?>
</td>


<td>
<?= $t['judul'] ?>
</td>



<td>

<span class="badge bg-success">

<?= $t['status'] ?>

</span>

</td>



<td>


<?php if(!empty($t['file_hasil'])): ?>


<a href="<?= base_url('uploads/hasil/'.$t['file_hasil']) ?>"
target="_blank"
class="btn btn-sm btn-primary">

Lihat File

</a>


<?php else: ?>


Tidak Ada


<?php endif; ?>


</td>



</tr>


<?php endforeach; ?>


</table>


<a href="<?= base_url('unit-layanan') ?>"
class="btn btn-secondary">

Kembali

</a>


</div>


</body>

</html>